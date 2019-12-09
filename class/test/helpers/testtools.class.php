<?php

	lt_include( PLOG_CLASS_PATH."class/dao/blogs.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/bloginfo.class.php" );		
	lt_include( PLOG_CLASS_PATH."class/dao/articles.class.php" );	
	lt_include( PLOG_CLASS_PATH."class/dao/article.class.php" );		
	lt_include( PLOG_CLASS_PATH."class/dao/users.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/userinfo.class.php" );	
	lt_include( PLOG_CLASS_PATH."class/dao/articlecategories.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/articlecategory.class.php" );		
	lt_include( PLOG_CLASS_PATH."class/dao/permissions.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/userpermissions.class.php" );

	/**
	 * \ingroup Test
	 *
	 * Several used methods that are used throughout the test cases
	 */
	class TestTools
	{
		/** 
		 * Creates a temporary blog
		 *
		 * @param ownerId Id of the owner
		 * @return A BlogInfo object if successful or false otherwise
		 */
		function createBlog( $ownerId )
		{
			$blog = new BlogInfo(
				"Test blog ".md5(time()),
				$ownerId,
				"About test blog",
				""
			);
			
			$blogs = new Blogs();
			if(!$blogs->addBlog($blog))
                return false;

                // every blog needs an article category, otherwise,
                // other things don't work (like posting, which is our check
                // to see if we successfully logged in)

            // add a default category
            $articleCategories = new ArticleCategories();
            $articleCategory = new ArticleCategory( "Default Category",
                                                    "",
                                                    $blog->getId(),
                                                    true,
                                                    "This is an uninteresting description");
            $catId = $articleCategories->addArticleCategory( $articleCategory );

            if(!$catId)
                print "Couldn't create default category for blog";

            return $blog;
		}

        /**
         * Delete a blog and the default category
         * (Note: Why doesn't a blog erase relevant stuff when it is erased?
         *  Maybe the blogs->deleteBlog should be a private function,
         *  and outside folks always call purgeBlog instead??)
         */
         function deleteBlog( $blog ){
            $articleCategories = new ArticleCategories();
            $articleCategories->deleteBlogCategories( $blog->getId() );
            
            TestTools::deleteDaoTestData(Array($blog));
        }
        
		/**
		 * Creates a temporary user with minimal (login only) permissions
		 *
		 * @return A UserInfo object if successful or false otherwise
		 */
		function createUser()
		{
			$user = new UserInfo(
				TestTools::getRandomWord( 15, false, false ),
				"password",
				"test@user.com",
				"About test user",
				"Test User"				
			);

			$users = new Users();
			if(!$users->addUser($user))
                return false;
            
            $userPerms = new UserPermissions();
            
            $perms = new Permissions();
            $loginAccess = $perms->getPermissionByName( "login_perm" );
            if($loginAccess === false){
                print "Error getting login permission id";
                return false;
            }
            
                // Give user login privileges
            $userPerm = new UserPermission( $user->getId(), 0, $loginAccess->getId() );
            if(!$userPerm){
                print "Error creating UserPermission(login) for user";
                return false;
            }
            if(!$userPerms->grantPermission( $userPerm )){
                print "Error granting login permissions to user";
                return false;
            }
            
            return $user;
		}
		
		/**
		 * Creates a temporary admin user, with default admin privileges
		 *
		 * @return A UserInfo object if successful or false otherwise
		 */
		function createAdminUser()
		{
            $user = TestTools::createUser();
            if(!$user)
                return false;

			$user->setSiteAdmin( true );
            $userPerms = new UserPermissions();
            
            $perms = new Permissions();
            $allPerms = $perms->getAllPermissions();
            foreach($allPerms as $perm){
                if($perm->isAdminOnlyPermission()){
                    $userPerm = new UserPermission( $user->getId(), 0, $perm->getId() );
                    if(!$userPerm){
                        print "Error creating UserPermission(".$perm->getId().") for user";
                    }
                    if(!$userPerms->grantPermission($userPerm)){
                        print "Error granting UserPermission(".$perm->getId().") for user";
                    }
                }
            }
            
                // save user
			$users = new Users();
			if(!$users->updateUser($user)){
                print "Couldn't update admin privileges for user";
                return $user;  // return a user, since he has already been created
            }
            return $user;
		}		
		
		/**
		 * Create a temporary article
		 *
		 * @param blogId Id of the blog to which this article belongs
		 * @param categories An array with category ids
		 * @param status A valid status for the article, POST_STATUS_PUBLISHED if none specified
		 * @param date A Timestamp, the current date will be used if none specified
		 * @return An Article object if successful or false otherwise
		 */
		function createArticle( $blogId, $userId, $categoryIds, $status = POST_STATUS_PUBLISHED, $date = null )
		{
			$article = new Article(
				"Topic of test article",
				"Text of test article",
				$categoryIds,
				$userId,
				$blogId,
				$status,
				0				
			);
			if( $date != null ) {
				$article->setDateObject( $date );
			}
			
			$articles = new Articles();
			if( $articles->addArticle( $article ))
				return( $article );
			else
				return( false );
		}
		
		/**
		 * Create a temporary article category
		 *
		 * @param blogId 
		 * @return An ArticleCategory object or false otherwise
		 */
		function createArticleCategory( $blogId )
		{
			$cat = new ArticleCategory(
				"Test category ".md5(rand()),
				"",
				$blogId,
				true
			);
			
			$cats = new ArticleCategories();
			if( $cats->addArticleCategory( $cat )) 
				return( $cat );
			else
				return( false );
		}
		
		/**
		 * Creates a clean scenario for tests, including one blog, one user, one or more different articles and
		 * one or more different article categories
		 *
		 * @param params An array
		 * @return Returns an array with several different fields containing the user (owner), blog, categories
		 * and articles.
		 */
		function createBlogScenario( $params = Array())
		{
			$numArticles = isset( $params["num_articles"] ) ? $params["num_articles"] : 1;
			$numCategories = isset( $params["num_categories"] ) ? $params["num_categories"] : 1;
			
			// create the user
			$user = TestTools::createUser();
			// create the blog
			$blog = TestTools::createBlog( $user->getId());
			// create the categories
			$i = 0;
			$categories = Array();
			while( $i < $numCategories ) {
				$categories[$i] = TestTools::createArticleCategory( $blog->getId());
				$i++;				
			}
			// create the articles
			$i = 0;

			while( $i < $numArticles ) {
				// select the categories
				if( $numCategories == 1 )
					$catIds = Array( $categories[0]->getId());
				else {
					// pick a random number between 1 and $numCategories
					$maxNum = rand( 1, $numCategories );
					$j = 0;
					while( $j < $maxNum ) {
						$pos = rand( 0, $numCategories-1 );
						$catIds[] = $categories[$pos]->getId();
						$j++;
					}
				}
				$articles[$i] = TestTools::createArticle( $blog->getId(), $user->getId(), $catIds, POST_STATUS_PUBLISHED );
				$i++;
				$catIds = Array();
			}
			
			$result = Array();
			$result["user"] = $user;
			$result["blog"] = $blog;
			$i = 0;
			// need to reload the category so that the article counters are correct
			$articleCategories = new ArticleCategories();
			foreach( $categories as $cat ) {
				$result["categories"][$i] = $articleCategories->getCategory( $cat->getId());
				$i++;				
			}
			$result["articles"] = $articles;
			
			return( $result );
		}
		
		/**
		 * Deletes any test data created
		 *
		 * @param data An array with DAO objects
		 */
		function deleteDaoTestData( $data )
		{
			foreach( $data as $item ) {
				// check the item class and act accordingly
				$className = strtolower( get_class( $item ));
				if( $className == "article" ) {
					$articles = new Articles();
					$articles->deleteArticle( $item->getId(), $item->getUserId(), $item->getBlogId(), true );
				}
				elseif( $className == "bloginfo" ) {
					$blogs = new Blogs();
					$blogs->deleteBlog( $item->getId());
				}
				elseif( $className == "articlecategory" ) {
					$cats = new ArticleCategories();
					$cats->deleteCategory( $item->getId(), $item->getBlogId());
				}
				elseif( $className == "userinfo" ) {
					$users = new Users();
					$users->deleteUser( $item->getId());
				}
				elseif( $className == "usercomment" || $className == "trackback" ) {
					$comments = new ArticleComments();
					$comments->deleteComment( $item->getId());
				}
				else {
					print("<br/><br/>Unrecognized object of class $className" );
					print_r( $item );
				}
			}
		}
		
		/**
		 * Generate random words
		 */
		function getRandomWord($length, $uppercase = false, $html = true) 
		{
		    $newcode_length = 0;
		    $newcode = "";
		    while($newcode_length < $length) {
		        $a=97;
		        $b=122;
		        if ($newcode_length == 0) {
		            if (rand(1,4) == 1 && $uppercase) {
		                $a=65;
		                $b=90;
		            }
		        }
		        $code_part=chr(rand($a,$b));
		        $newcode_length++;
		        $newcode = $newcode.$code_part;
		    }
		    if ($html && rand(1, 50) == 1) {
		        return "<a href=\"http://www.lifetype.net\">$newcode</a>";
		    }
		    return $newcode;
		}
		
	}
?>