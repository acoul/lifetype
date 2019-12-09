<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/testtools.class.php" );
	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/config/config.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/blogs.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/articlecategories.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/articlecategory.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/articles.class.php" );
	lt_include( PLOG_CLASS_PATH."class/net/xmlrpc/IXR_Library.lib.php" );
	lt_include( PLOG_CLASS_PATH."class/net/url.class.php" );
	lt_include( PLOG_CLASS_PATH."class/locale/ltlocales.class.php" );	

	/**
	 * Unit test cases for xmlrpc.php
	 */
	class XmlRpcServer_Test extends LifeTypeTestCase
	{
		var $blog;
		var $user;
		var $cat;
        var $url;
        
		function setUp()
		{
			$this->user = TestTools::createUser();
			$this->blog = TestTools::createBlog( $this->user->getId());
            $articlecategories = new ArticleCategories();
			$arr = $articlecategories->getBlogCategories($this->blog->getId());
            $this->cat = $arr[0];
            
			// load a UTF-8 locale
			$zhLocale =& LTLocales::getLocale( "zh_CN" );

			$blogs = new Blogs();
			$this->blog->setLocale( $zhLocale );
			if(!$blogs->updateBlog( $this->blog )) {
				print "Error adding test blog!";
				return;
			}
			
			// get the URL pointing to xmlrpc.php
			$config =& Config::getConfig();
			$this->url = $config->getValue( "base_url" )."/xmlrpc.php";
		}
		
		function tearDown()
		{
            $articles = new Articles();
            $articles->deleteBlogPosts($this->blog->getId());
            
			TestTools::deleteDaoTestData(
                Array($this->cat, $this->user)
			);
			TestTools::deleteBlog( $this->blog );
        }

		/**
		 * test the blogger.newPost method call
		 */
		function testBloggerNewPost()
		{
			$c = new IXR_Client( $this->url );
			$res = $c->query( "blogger.newPost", 
			           "appkey", 
					   $this->blog->getId(), 
					   $this->user->getUsername(), 
					   "password", 
					   "blah blah", 
					   true );
					
			// see that the call was successful
			$this->assertTrue( $res, "Unable to query ".$this->url." with method blogger.newPost" );
			
			// get the post id and check it in the db
			$artId = $c->getResponse();
			$articles = new Articles();
			$article = $articles->getArticle( $artId );
			$this->assertTrue( $article, "Could not load article with id = ".$artId );
			if( !$article )
				return;
			// check that the post has the expected values
			$this->assertEquals( "blah blah", $article->getText());
			$this->assertEquals( "blah blah", $article->getTopic());
			
			// delete the article
			$articles->deleteArticle( $artId, $this->user->getId(), $this->blog->getId(), true );

			// get the response and see that it has the right encoding			
			$this->assertTrue( $this->checkResponseEncoding( $c->message->rawmessage, $this->blog), 
			                   "The blog encoding and the response of the XMLRPC request did not match!" );

			/** test the embedded topic feature **/
			$res = $c->query( "blogger.newPost", 
			           "appkey", 
					   $this->blog->getId(), 
					   $this->user->getUsername(), 
					   "password", 
					   "topic\nblah blah", 
					   true );

			// see that the call was successful
			$this->assertTrue( $res, "Unable to query ".$this->url." with method blogger.newPost" );

			// get the post id and check it in the db
			$artId = $c->getResponse();
			$articles = new Articles();
			$article = $articles->getArticle( $artId );
			$this->assertTrue( $article, "Could not load article with id = ".$artId );
			if( !$article )
				return;
			// check that the post has the expected values
			$this->assertEquals( "blah blah", $article->getText());
			$this->assertEquals( "topic", $article->getTopic());

			// delete the article
			$articles->deleteArticle( $artId, $this->user->getId(), $this->blog->getId(), true );

			// get the response and see that it has the right encoding			
			$this->assertTrue( $this->checkResponseEncoding( $c->message->rawmessage, $this->blog), 
			                   "The blog encoding and the response of the XMLRPC request did not match!" );
			
			/** test the extended text  feature **/
			$res = $c->query( "blogger.newPost", 
			           "appkey", 
					   $this->blog->getId(), 
					   $this->user->getUsername(), 
					   "password", 
					   "topic\n" . "Intro text" . POST_EXTENDED_TEXT_MODIFIER . "Extended text", 
					   true );

			// see that the call was successful
			$this->assertTrue( $res, "Unable to query ".$this->url." with method blogger.newPost" );

			// get the post id and check it in the db
			$artId = $c->getResponse();
			$articles = new Articles();
			$article = $articles->getArticle( $artId );
			$this->assertTrue( $article, "Could not load article with id = ".$artId );
			if( !$article )
				return;
			// check that the post has the expected values
			$this->assertEquals( "topic", $article->getTopic());
			$this->assertEquals( "Intro textExtended text", $article->getText());
			$this->assertEquals( "Intro text" . POST_EXTENDED_TEXT_MODIFIER . "Extended text", $article->getText(false));
			$this->assertEquals( "Intro text", $article->getIntroText());
			$this->assertEquals( "Extended text", $article->getExtendedText());

			// delete the article
			$articles->deleteArticle( $artId, $this->user->getId(), $this->blog->getId(), true );

			// get the response and see that it has the right encoding			
			$this->assertTrue( $this->checkResponseEncoding( $c->message->rawmessage, $this->blog), 
			                   "The blog encoding and the response of the XMLRPC request did not match!" );
			
		}
		
		/**
		 * test the blogger.getUserInfo method cal
		 */
		function testBloggerGetUserInfo()
		{
			$c = new IXR_Client( $this->url );
			$res = $c->query( "blogger.getUserInfo", 
			           "appkey", 
					   $this->user->getUsername(), 
					   "password" );
					
			// see that the call was successful
			$this->assertTrue( $res, "Unable to query ".$this->url." with method blogger.getUserInfo" );
			
			// and check the data in the response
			$userData = $c->getResponse();
			
			$this->assertEquals( $this->user->getUsername(), $userData["nickname"], "The user nickname did not match!" );
			$this->assertEquals( $this->user->getUsername(), $userData["firstname"], "The user firstname did not match!" );
			$this->assertEquals( $this->user->getEmail(), $userData["email"], "The user email address did not match!" );
			$this->assertEquals( $this->user->getId(), $userData["userid"], "The user id did not match!" );			

			// get the response and see that it has the right encoding
			$this->assertTrue( $this->checkResponseEncoding( $c->message->rawmessage, $this->blog ), 
			                   "The blog encoding and the response of the XMLRPC request did not match!" );			
		}
		
		/**
		 * test the blogger.getUserInfo method call
		 */
		function testBloggerGetUsersBlogs()
		{
			$c = new IXR_Client( $this->url );
			$res = $c->query( "blogger.getUsersBlogs", 
			           "appkey", 
					   $this->user->getUsername(), 
					   "password" );
					
			// see that the call was successful
			$this->assertTrue( $res, "Unable to query ".$this->url." with method blogger.getUsersBlogs" );
			
			// and check the data in the response
			$blogs = $c->getResponse();
			// there should be only one blog			
			$this->assertEquals( $this->blog->getId(), $blogs[0]["blogid"] );
			$this->assertEquals( $this->blog->getBlog(), $blogs[0]["blogName"] );
			$url = $this->blog->getBlogRequestGenerator();
			$this->assertEquals( $url->blogLink(), $blogs[0]["url"] );			

			// get the response and see that it has the right encoding
			$this->assertTrue( $this->checkResponseEncoding( $c->message->rawmessage, $this->blog ), 
			                   "The blog encoding and the response of the XMLRPC request did not match!" );			
		}		
		
		/**
		 * test the metaWeblog.getUsersBlogs method call
		 */
		function testMetaweblogGetUsersBlogs()
		{
			$c = new IXR_Client( $this->url );
			$res = $c->query( "metaWeblog.getUsersBlogs", 
			           "appkey", 
					   $this->user->getUsername(), 
					   "password" );
					
			// see that the call was successful
			$this->assertTrue( $res, "Unable to query ".$this->url." with method blogger.getUsersBlogs" );
			
			// and check the data in the response
			$blogs = $c->getResponse();
			// there should be only one blog			
			$this->assertEquals( $this->blog->getId(), $blogs[0]["blogid"] );
			$this->assertEquals( $this->blog->getBlog(), $blogs[0]["blogName"] );
			$url = $this->blog->getBlogRequestGenerator();
			$this->assertEquals( $url->blogLink(), $blogs[0]["url"] );			

			// get the response and see that it has the right encoding
			$this->assertTrue( $this->checkResponseEncoding( $c->message->rawmessage, $this->blog ), 
			                   "The blog encoding and the response of the XMLRPC request did not match!" );			
		}		
		
		/**
		 * test the blogger.editPost method call
		 */
		function testBloggerEditPost()
		{
			// create a new post first
			$article = new Article(
				"topic",
				"text",
				Array( $this->cat->getId()),
				$this->user->getId(),
				$this->blog->getId(),
				POST_STATUS_PUBLISHED,
				0
				);
			$articles = new Articles();
			$this->assertTrue( $articles->addArticle( $article ), "Unable to add a new article" );
			
			// make the method call
			$c = new IXR_Client( $this->url );
			$res = $c->query( "blogger.editPost", 
			           "appkey", 
					   $article->getId(),
					   $this->user->getUsername(), 
					   "password", 
					   "updated text", 
					   true );
					
			// see that the call was successful
			$this->assertTrue( $res, "Unable to query ".$this->url." with method blogger.editPost" );
			
			// check the data in the response and make sure we got a 'true'
			$success = $c->getResponse();
			$this->assertTrue( $success, "XMLRPC server returned error while updating the post" );
			
			// check that the post was successfully updated
			$updatedArticle = $articles->getArticle( $article->getId());
			// check that the text is the updated version
			$this->assertEquals( "updated text", $updatedArticle->getText());
			$this->assertEquals( "updated text", $updatedArticle->getTopic());

			// get the response and see that it has the right encoding
			$this->assertTrue( $this->checkResponseEncoding( $c->message->rawmessage, $this->blog ), 
			                   "The blog encoding and the response of the XMLRPC request did not match!" );
			
			/*** test the embedded topic feature ***/	
					
			// make the method call
			$c = new IXR_Client( $this->url );
			$res = $c->query( "blogger.editPost", 
			           "appkey", 
					   $article->getId(),
					   $this->user->getUsername(), 
					   "password", 
					   "topic\nupdated text", 
					   true );
					
			// see that the call was successful
			$this->assertTrue( $res, "Unable to query ".$this->url." with method blogger.editPost" );
			
			// check the data in the response and make sure we got a 'true'
			$success = $c->getResponse();
			$this->assertTrue( $success, "XMLRPC server returned error while updating the post" );
			
			// check that the post was successfully updated
			$updatedArticle = $articles->getArticle( $article->getId());
			// check that the text is the updated version
			$this->assertEquals( "updated text", $updatedArticle->getText(), "Article text did not mach the expected text!" );
			$this->assertEquals( "topic", $updatedArticle->getTopic(), "Article topic was not set correctly" );

			// get the response and see that it has the right encoding
			$this->assertTrue( $this->checkResponseEncoding( $c->message->rawmessage, $this->blog ), 
			                   "The blog encoding and the response of the XMLRPC request did not match!" );	
			
			// delete the post
			$articles->deleteArticle( $updatedArticle->getId(), $this->user->getId(), $this->blog->getId());	
		}
		
		/**
		 * Test case the blogger.deletePost method call
		 */
		function testBloggerDeletePost()
		{
			// create a new post first
			$article = new Article(
				"topic",
				"text",
				Array( $this->cat->getId()),
				$this->user->getId(),
				$this->blog->getId(),
				POST_STATUS_PUBLISHED,
				0
				);
			$articles = new Articles();
			$this->assertTrue( $articles->addArticle( $article ), "Unable to add a new test article" );
			
			// make the method call
			$c = new IXR_Client( $this->url );
			$res = $c->query( "blogger.deletePost", 
			           "appkey", 
					   $article->getId(),
					   $this->user->getUsername(), 
					   "password", 
					   true );
					
			// see that the call was successful
			$this->assertTrue( $res, "Unable to query ".$this->url." with method blogger.deletePost" );
			
			// make sure that the call returned ok
			$response = $c->getResponse();
			$this->assertTrue( $response, "blogger.deletePost did not return true" );
			
			// check that the post was marked as 'deleted' in the database
			$updatedArticle = $articles->getArticle( $article->getId());
			$this->assertEquals( $updatedArticle->getStatus(), 
			                     POST_STATUS_DELETED, 
			                     "Article was not properly deleted after calling blogger.deletePost" );
			
			// get the response and see that it has the right encoding
			$this->assertTrue( $this->checkResponseEncoding( $c->message->rawmessage, $this->blog ), 
			                   "The blog encoding and the response of the XMLRPC request did not match!" );				
		}
		
		/**
		 * test case for blogger.getRecentPosts
		 */
		function testBloggerGetRecentPosts()
		{
			// create a new post first
			$article = new Article(
				"topic",
				"text",
				Array( $this->cat->getId()),
				$this->user->getId(),
				$this->blog->getId(),
				POST_STATUS_PUBLISHED,
				0
				);
			$articles = new Articles();
			$this->assertTrue( $articles->addArticle( $article ), "Unable to add the first test article" );
			$article2 = new Article(
				"topic 2",
				"text 2",
				Array( $this->cat->getId()),
				$this->user->getId(),
				$this->blog->getId(),
				POST_STATUS_PUBLISHED,
				0
				);
			$this->assertTrue( $articles->addArticle( $article ), "Unable to add the second test article" );
						
			// make the method call
			$c = new IXR_Client( $this->url );
			$res = $c->query( "blogger.getRecentPosts", 
			           "appkey", 
					   $this->blog->getId(),	
					   $this->user->getUsername(), 
					   "password", 
					   10 );
					
			// see that the call was successful
			$this->assertTrue( $res, "Unable to query ".$this->url." with method blogger.getRecentPosts" );
			
			// make sure that the call returned ok
			$response = $c->getResponse();
			$this->assertTrue( $response, "blogger.getRecentPosts did not return a valid response" );
			// and make sure that we got two articles
			$this->assertEquals( 2, count($response), "The number of articles returned by blogger.getRecentPosts is not correct" );
			
			// get the response and see that it has the right encoding
			$this->assertTrue( $this->checkResponseEncoding( $c->message->rawmessage, $this->blog ), 
			                   "The blog encoding and the response of the XMLRPC request did not match!" );
			
			// delete the articles
			$articles->deleteArticle( $article->getId(), $this->user->getId(), $this->blog->getId(), true );
			$articles->deleteArticle( $article2->getId(), $this->user->getId(), $this->blog->getId(), true );			
		}
		
		/**
		 * test case for blogger.getPost
		 */
		function testBloggerGetPost()
		{
			// create a new post first
			$article = new Article(
				"topic",
				"text",
				Array( $this->cat->getId()),
				$this->user->getId(),
				$this->blog->getId(),
				POST_STATUS_PUBLISHED,
				0
				);
			$articles = new Articles();
			$this->assertTrue( $articles->addArticle( $article ), "Unable to add a new test article" );
			
			// make the method call
			$c = new IXR_Client( $this->url );
			$res = $c->query( "blogger.getPost", 
			           "appkey", 
					   $article->getId(),
					   $this->user->getUsername(), 
					   "password" );
					
			// see that the call was successful
			$this->assertTrue( $res, "Unable to query ".$this->url." with method blogger.getPost" );
			
			// make sure that the call returned ok
			$response = $c->getResponse();
			$this->assertTrue( $response, "blogger.getPost did not return a valid response" );
			
			// and now compare that the returned values match with what we expected
			$this->assertEquals( $this->user->getId(), $response["userid"], "The user id of the article does not match" );
			$this->assertEquals( "topic\ntext", $response["content"] );
			$this->assertEquals( $article->getId(), $response["postid"] );

			$this->assertTrue( $articles->deleteArticle( $article->getId(), $this->user->getId(), $this->blog->getId(), true ),
			                   "Error deleting article" );
			
			// get the response and see that it has the right encoding
			$this->assertTrue( $this->checkResponseEncoding( $c->message->rawmessage, $this->blog ), 
			                   "The blog encoding and the response of the XMLRPC request did not match!" );			

            // (extended text)
			// create a new post first
			$article = new Article(
				"topic",
				"Intro text" . POST_EXTENDED_TEXT_MODIFIER . "Extended text",
				Array( $this->cat->getId()),
				$this->user->getId(),
				$this->blog->getId(),
				POST_STATUS_PUBLISHED,
				0
				);
				
			$this->assertTrue( $articles->addArticle( $article ), "Unable to add a new test article" );
			// make the method call
			$c = new IXR_Client( $this->url );
			$res = $c->query( "blogger.getPost", 
			           "appkey", 
					   $article->getId(),
					   $this->user->getUsername(), 
					   "password" );
					
			// see that the call was successful
			$this->assertTrue( $res, "Unable to query ".$this->url." with method blogger.getPost" );
			
			// make sure that the call returned ok
			$response = $c->getResponse();

			$this->assertTrue( $response, "blogger.getPost did not return a valid response" );
			
			// and now compare that the returned values match with what we expected
			$this->assertEquals( $this->user->getId(), $response["userid"], "The user id of the article does not match" );
			$this->assertEquals( "topic\nIntro text[@more@]Extended text", $response["content"] );
			$this->assertEquals( $article->getId(), $response["postid"] );

			$this->assertTrue( $articles->deleteArticle( $article->getId(), $this->user->getId(), $this->blog->getId(), true ),
			                   "Error deleting article" );
			
			// get the response and see that it has the right encoding
			$this->assertTrue( $this->checkResponseEncoding( $c->message->rawmessage, $this->blog ), 
			                   "The blog encoding and the response of the XMLRPC request did not match!" );			


		}
		
		/** 
		 * test case for the metaWeblog.getPost method call
		 */
		function testMetaWeblogNewPost()
		{
			// create 3 test categories
			$cat1 = TestTools::createArticleCategory( $this->blog->getId());
			$cat2 = TestTools::createArticleCategory( $this->blog->getId());
			$cat3 = TestTools::createArticleCategory( $this->blog->getId());			
			
			$c = new IXR_Client( $this->url );
            $content  = array();
            $content["title"] = "topic";
            $content["description"] = "body text";
			$content["categories"] = Array( $cat1->getName(), $cat2->getName(), $cat3->getName());

			$res = $c->query( "metaWeblog.newPost", 
					   $this->blog->getId(), 
					   $this->user->getUsername(), 
					   "password", 
					   $content, 
					   true );
					
			// see that the call was successful
			$this->assertTrue( $res, "Unable to query ".$this->url." with method blogger.newPost" );
			
			// get the post id and check it in the db
			$artId = $c->getResponse();
			$articles = new Articles();
			$article = $articles->getArticle( $artId );
			$this->assertTrue( $article, "Could not load article with id = ".$artId );
			if( !$article ){
                TestTools::deleteDaoTestData( Array( $cat1, $cat2, $cat3 ));
				return;
            }
			// check that the post has the expected values
			$this->assertEquals( "body text", $article->getText(false));
			$this->assertEquals( "topic", $article->getTopic());
			// check that the categories are correct
			$cats = Array( $cat1->getName(), $cat2->getName(), $cat3->getName());
			$postCats = $article->getCategories();
			
			$this->assertEquals( count( $cats ), count( $postCats ), "The post did not have as many categories as expected!" );
			
			// delete the article
			$articles->deleteArticle( $artId, $this->user->getId(), $this->blog->getId(), true );

			// get the response and see that it has the right encoding			
			$this->assertTrue( $this->checkResponseEncoding( $c->message->rawmessage, $this->blog), 
			                   "The blog encoding and the response of the XMLRPC request did not match!" );

			/** test the extended text  feature **/
            $content  = array();
            $content["title"] = "topic";
            $content["description"] = "Intro text" . POST_EXTENDED_TEXT_MODIFIER . "Extended text";
			$content["categories"] = Array( $cat1->getName(), $cat2->getName(), $cat3->getName());
			$res = $c->query( "metaWeblog.newPost", 
					   $this->blog->getId(), 
					   $this->user->getUsername(), 
					   "password", 
					   $content, 
					   true );

			// see that the call was successful
			$this->assertTrue( $res, "Unable to query ".$this->url." with method blogger.newPost" );

			// get the post id and check it in the db
			$artId = $c->getResponse();
			$articles = new Articles();
			$article = $articles->getArticle( $artId );
			$this->assertTrue( $article, "Could not load article with id = ".$artId );
			if( !$article )
				return;
			// check that the post has the expected values
			$this->assertEquals( "topic", $article->getTopic());
			$this->assertEquals( "Intro textExtended text", $article->getText());
			$this->assertEquals( "Intro text" . POST_EXTENDED_TEXT_MODIFIER . "Extended text", $article->getText(false));
			$this->assertEquals( "Intro text", $article->getIntroText());
			$this->assertEquals( "Extended text", $article->getExtendedText());

			// delete the article
			$articles->deleteArticle( $artId, $this->user->getId(), $this->blog->getId(), true );

			// get the response and see that it has the right encoding			
			$this->assertTrue( $this->checkResponseEncoding( $c->message->rawmessage, $this->blog), 
			                   "The blog encoding and the response of the XMLRPC request did not match!" );
			
			/** test the extended text  feature through MovableType**/
            $content  = array();
            $content["title"] = "topic";
            $content["description"] = "Intro text";
            $content["mt_text_more"] = "Extended text";
			$res = $c->query( "metaWeblog.newPost", 
					   $this->blog->getId(), 
					   $this->user->getUsername(), 
					   "password", 
					   $content, 
					   true );

			// see that the call was successful
			$this->assertTrue( $res, "Unable to query ".$this->url." with method blogger.newPost" );

			// get the post id and check it in the db
			$artId = $c->getResponse();
			$articles = new Articles();
			$article = $articles->getArticle( $artId );
			$this->assertTrue( $article, "Could not load article with id = ".$artId );
			if( !$article ){
                TestTools::deleteDaoTestData( Array( $cat1, $cat2, $cat3 ));
				return;
            }
			// check that the post has the expected values
			$this->assertEquals( "topic", $article->getTopic());
			$this->assertEquals( "Intro textExtended text", $article->getText());
			$this->assertEquals( "Intro text" . POST_EXTENDED_TEXT_MODIFIER . "Extended text", $article->getText(false));
			$this->assertEquals( "Intro text", $article->getIntroText());
			$this->assertEquals( "Extended text", $article->getExtendedText());

			// delete the article
			$articles->deleteArticle( $artId, $this->user->getId(), $this->blog->getId(), true );

			// get the response and see that it has the right encoding			
			$this->assertTrue( $this->checkResponseEncoding( $c->message->rawmessage, $this->blog), 
			                   "The blog encoding and the response of the XMLRPC request did not match!" );
			
			// delete the test data
			TestTools::deleteDaoTestData( Array( $cat1, $cat2, $cat3 ));
		}
		

		
		/** 
		 * test case for the metaWeblog.getPost method call
		 */
		function testMetaWeblogGetPost()
		{
			// create a new post first
			$article = new Article(
				"topic",
				"text",
				Array( $this->cat->getId()),
				$this->user->getId(),
				$this->blog->getId(),
				POST_STATUS_PUBLISHED,
				0
				);
			$articles = new Articles();
			$this->assertTrue( $articles->addArticle( $article ), "Unable to add a new test article" );
			
			// make the method call
			$c = new IXR_Client( $this->url );
			$res = $c->query( "metaWeblog.getPost",
					   $article->getId(),
					   $this->user->getUsername(), 
					   "password" );
					
			// see that the call was successful
			$this->assertTrue( $res, "Unable to query ".$this->url." with method metaweblog.getPost" );
			
			// make sure that the call returned ok
			$response = $c->getResponse();
			$this->assertTrue( $response, "metaWeblog.getPost did not return a valid response" );
			
			// and now compare that the returned values match with what we expected
			$this->assertEquals( $this->user->getId(), $response["userid"], "The user id of the article does not match" );
			$this->assertEquals( "topic", $response["title"], "The topic of the post does not match" );
			$this->assertEquals( "text", $response["description"], "The text of the article does not match" );
			$this->assertEquals( $article->getId(), $response["postid"] );
			$url = $this->blog->getBlogRequestGenerator();
			$this->assertEquals( $url->postLink( $article ), $response["link"], "The post permalink does not match" );
			$this->assertEquals( $url->postPermalink( $article ), $response["permaLink"], "The post permalink does not match" );
			
			$this->assertTrue( $articles->deleteArticle( $article->getId(), $this->user->getId(), $this->blog->getId(), true ),
			                   "Error deleting article" );
			
			// get the response and see that it has the right encoding
			$this->assertTrue( $this->checkResponseEncoding( $c->message->rawmessage, $this->blog ), 
			                   "The blog encoding and the response of the XMLRPC request did not match!" );			

            // EXTENDED TEXT
			// create a new post first
			$article = new Article(
				"topic",
				"Intro text" . POST_EXTENDED_TEXT_MODIFIER . "Extended text",
				Array( $this->cat->getId()),
				$this->user->getId(),
				$this->blog->getId(),
				POST_STATUS_PUBLISHED,
				0
				);
				
				
			$this->assertTrue( $articles->addArticle( $article ), "Unable to add a new test article" );
			
			// make the method call
			$c = new IXR_Client( $this->url );
			$res = $c->query( "metaWeblog.getPost",
					   $article->getId(),
					   $this->user->getUsername(), 
					   "password" );
					
			// see that the call was successful
			$this->assertTrue( $res, "Unable to query ".$this->url." with method metaweblog.getPost" );
			
			// make sure that the call returned ok
			$response = $c->getResponse();
			$this->assertTrue( $response, "metaWeblog.getPost did not return a valid response" );
			
			// and now compare that the returned values match with what we expected
			$this->assertEquals( $this->user->getId(), $response["userid"], "The user id of the article does not match" );
			$this->assertEquals( "topic", $response["title"], "The topic of the post does not match" );
			$this->assertEquals( "Intro text", $response["description"], "The text of the article does not match" );
			$this->assertEquals( $article->getId(), $response["postid"] );
			$url = $this->blog->getBlogRequestGenerator();
			$this->assertEquals( $url->postLink( $article ), $response["link"], "The post permalink does not match" );
			$this->assertEquals( $url->postPermalink( $article ), $response["permaLink"], "The post permalink does not match" );
			
			$this->assertTrue( $articles->deleteArticle( $article->getId(), $this->user->getId(), $this->blog->getId(), true ),
			                   "Error deleting article" );
			
			// get the response and see that it has the right encoding
			$this->assertTrue( $this->checkResponseEncoding( $c->message->rawmessage, $this->blog ), 
			                   "The blog encoding and the response of the XMLRPC request did not match!" );			



            // EXTENDED TEXT, with extended text in mt_more_text
			// create a new post first
			$article = new Article(
				"topic",
				"Intro text" . POST_EXTENDED_TEXT_MODIFIER . "Extended text",
				Array( $this->cat->getId()),
				$this->user->getId(),
				$this->blog->getId(),
				POST_STATUS_PUBLISHED,
				0
				);
				
			// Store the setting that mt_more_text should be used
			$blogSettings = $this->blog->getSettings();
            $blogSettings->setValue( "xmlrpc_movabletype_enabled", true );
            $this->blog->setSettings( $blogSettings ); 
            $blogs = new Blogs();
            $blogs->updateBlog( $this->blog );

				
			$this->assertTrue( $articles->addArticle( $article ), "Unable to add a new test article" );
			
			// make the method call
			$c = new IXR_Client( $this->url );
			$res = $c->query( "metaWeblog.getPost",
					   $article->getId(),
					   $this->user->getUsername(), 
					   "password" );
					
			// see that the call was successful
			$this->assertTrue( $res, "Unable to query ".$this->url." with method metaweblog.getPost" );
			
			// make sure that the call returned ok
			$response = $c->getResponse();
			$this->assertTrue( $response, "metaWeblog.getPost did not return a valid response" );
			
			// and now compare that the returned values match with what we expected
			$this->assertEquals( $this->user->getId(), $response["userid"], "The user id of the article does not match" );
			$this->assertEquals( "topic", $response["title"], "The topic of the post does not match" );
			$this->assertEquals( "Intro text", $response["description"], "The text of the article does not match" );
			$this->assertEquals( "Extended text", $response["mt_text_more"], "The text of the extended text does not match" );
			$this->assertEquals( $article->getId(), $response["postid"] );
			$url = $this->blog->getBlogRequestGenerator();
			$this->assertEquals( $url->postLink( $article ), $response["link"], "The post permalink does not match" );
			$this->assertEquals( $url->postPermalink( $article ), $response["permaLink"], "The post permalink does not match" );
			
			$this->assertTrue( $articles->deleteArticle( $article->getId(), $this->user->getId(), $this->blog->getId(), true ),
			                   "Error deleting article" );
			
			// get the response and see that it has the right encoding
			$this->assertTrue( $this->checkResponseEncoding( $c->message->rawmessage, $this->blog ), 
			                   "The blog encoding and the response of the XMLRPC request did not match!" );			

			// Restore the setting
			$blogSettings = $this->blog->getSettings();
            $blogSettings->setValue( "xmlrpc_movabletype_enabled", false );
            $this->blog->setSettings( $blogSettings ); 
            $blogs->updateBlog( $this->blog );


		}
		
		/** 
		 * Test the metaWeblog.getCategories
		 */
		function testMetaWeblogGetCategories()
		{
			// make the method call
			$c = new IXR_Client( $this->url );
			$res = $c->query( "metaWeblog.getCategories",
					   $this->blog->getId(),
					   $this->user->getUsername(), 
					   "password" );
					
			// see that the call was successful
			$this->assertTrue( $res, "Unable to query ".$this->url." with method metaweblog.getCategories" );
			
			// make sure that the call returned ok
			$response = $c->getResponse();
			$this->assertTrue( $response, "metaWeblog.getCategories did not return a valid response" );
						
			// there should only be one category
			$this->assertEquals(1, count($response), "There should only be one category returned by metaWeblog.getCategories" );
			
			// check that the category settings are correct
			$this->assertEquals( $this->cat->getName(), key($response), "The category name did not match" );
			$this->assertEquals( $this->cat->getDescription(), $response["Default Category"]["description"], 
                                 "The category description did not match" );
			$url = $this->blog->getBlogRequestGenerator();
			$url->setXHTML( false );
			$this->assertEquals( $url->categoryLink( $this->cat ), $response["Default Category"]["htmlUrl"],
                                 "The category link did not match" );
			
			// get the response and see that it has the right encoding
			$this->assertTrue( $this->checkResponseEncoding( $c->message->rawmessage, $this->blog ), 
			                   "The blog encoding and the response of the XMLRPC request did not match!" );			
		}
		
		function testMTGetCategoryList()
		{
			// make the method call
			$c = new IXR_Client( $this->url );
			$res = $c->query( "mt.getCategoryList",
					   $this->blog->getId(),
					   $this->user->getUsername(), 
					   "password" );
					
			// see that the call was successful
			$this->assertTrue( $res, "Unable to query ".$this->url." with method mt.getCategoryList" );
			
			// make sure that the call returned ok
			$response = $c->getResponse();
			$this->assertTrue( $response, "mt.getCategoryList did not return a valid response" );
						
			// there should only be one category
			$this->assertEquals(1, count($response), "There should only be one category returned by mt.getCategoryList" );
			
			// check that the category settings are correct
			$this->assertEquals( $this->cat->getName(), $response[0]["categoryName"], "The category name did not match" );
			$this->assertEquals( $this->cat->getId(), $response[0]["categoryId"], "The category description did not match" );
			
			// get the response and see that it has the right encoding
			$this->assertTrue( $this->checkResponseEncoding( $c->message->rawmessage, $this->blog ), 
			                   "The blog encoding and the response of the XMLRPC request did not match!" );			
		}
		
		function testMetaWeblogGetRecentPosts()
		{
			// create a new post first
			$article = new Article(
				"topic",
				"text",
				Array( $this->cat->getId()),
				$this->user->getId(),
				$this->blog->getId(),
				POST_STATUS_PUBLISHED,
				0
				);
			$articles = new Articles();
			$this->assertTrue( $articles->addArticle( $article ), "Unable to add the first tet article" );
			$article2 = new Article(
				"topic 2",
				"text 2",
				Array( $this->cat->getId()),
				$this->user->getId(),
				$this->blog->getId(),
				POST_STATUS_PUBLISHED,
				0
				);
			$this->assertTrue( $articles->addArticle( $article ), "Unable to add the second test article" );
						
			// make the method call
			$c = new IXR_Client( $this->url );
			$res = $c->query( "metaWeblog.getRecentPosts", 
					   $this->blog->getId(),	
					   $this->user->getUsername(), 
					   "password", 
					   10 );
					
			// see that the call was successful
			$this->assertTrue( $res, "Unable to query ".$this->url." with method metaWeblog.getRecentPosts" );
			
			// make sure that the call returned ok
			$response = $c->getResponse();
			$this->assertTrue( $response, "metaWeblog.getRecentPosts did not return a valid response" );
			// and make sure that we got two articles
			$this->assertEquals( 2, count($response), "The number of articles returned by metaWeblog.getRecentPosts is not correct" );
			
			// get the response and see that it has the right encoding
			$this->assertTrue( $this->checkResponseEncoding( $c->message->rawmessage, $this->blog ), 
			                   "The blog encoding and the response of the XMLRPC request did not match!" );
			
			// delete the articles
			$articles->deleteArticle( $article->getId(), $this->user->getId(), $this->blog->getId(), true );
			$articles->deleteArticle( $article2->getId(), $this->user->getId(), $this->blog->getId(), true );			
			
		}
		
		
        function testMTSupportedTextFilters()
		{
			// make the method call
			$c = new IXR_Client( $this->url );
			$res = $c->query( "mt.supportedTextFilters");
					
			// see that the call was successful
			$this->assertTrue( $res, "Unable to query ".$this->url." with method mt.supportedTextFilters" );
			
			// make sure that the call returned ok
			// there should be no filters
			$response = $c->getResponse();
			$this->assertFalse( $response, "mt.supportedTextFilters return an unexpected response" );
									
		}
		
		function testMTGetPostCategories()
		{
			// create a new post first
			$article = new Article(
				"topic",
				"text",
				Array( $this->cat->getId()),
				$this->user->getId(),
				$this->blog->getId(),
				POST_STATUS_PUBLISHED,
				0
				);
			$articles = new Articles();
			$this->assertTrue( $articles->addArticle( $article ), "Unable to add a new test article" );
			
			// make the method call
			$c = new IXR_Client( $this->url );
			$res = $c->query( "mt.getPostCategories",
					   $article->getId(),
					   $this->user->getUsername(), 
					   "password" );
					
			// see that the call was successful
			$this->assertTrue( $res, "Unable to query ".$this->url." with method mt.getPostCategories" );
			
			// make sure that the call returned ok
			$response = $c->getResponse();
			$this->assertTrue( $response, "mt.getPostCategories did not return a valid response" );
			
			
			// There should only be one category
			$this->assertEquals( 1, count($response), "The number of categories returned by mt.getPostCategories is not correct" );
			
			// and now compare that the returned values match with what we expected
			$this->assertEquals( $this->cat->getName(), $response[0]["categoryName"], "The category name did not match" );
			$this->assertEquals( $this->cat->getId(), $response[0]["categoryId"], "The category description did not match" );
			
			$this->assertTrue( $articles->deleteArticle( $article->getId(), $this->user->getId(), $this->blog->getId(), true ),
			                   "Error deleting article" );
			
			// get the response and see that it has the right encoding
			$this->assertTrue( $this->checkResponseEncoding( $c->message->rawmessage, $this->blog ), 
			                   "The blog encoding and the response of the XMLRPC request did not match!" );			
		}

		
		function testMTSetPostCategories()
		{
			// create a new post first, with no category
			$article = new Article(
				"topic",
				"text",
				Array( $this->cat->getId()),
				$this->user->getId(),
				$this->blog->getId(),
				POST_STATUS_PUBLISHED,
				0
				);
			$articles = new Articles();
			$this->assertTrue( $articles->addArticle( $article ), "Unable to add a new test article" );
			
			// another category
			$cat2 = new ArticleCategory( "General2", 
			                              "Description for category General2",
										  $this->blog->getId(),
										  true );			
			$cats = new ArticleCategories();
			if( !$cats->addArticleCategory( $cat2 )) {
				print "Error adding test category!";
                return;
			}		  
			
			// Construct the Category Struct
			$categories = Array();
			$theCategory = Array();
			$theCategory["categoryName"] = $cat2->getName();
			$theCategory["categoryId"] = $cat2->getId();
			$categories[] = $theCategory;
			
			// make the method call
			$c = new IXR_Client( $this->url );
			$res = $c->query( "mt.setPostCategories",
					   $article->getId(),
					   $this->user->getUsername(), 
					   "password",
					   $categories
					   );
					
			// see that the call was successful
			$this->assertTrue( $res, "Unable to query ".$this->url." with method mt.setPostCategories" );
			
			// make sure that the call returned ok
			$response = $c->getResponse();
			$this->assertTrue( $response, "mt.setPostCategories did not return a valid response" );
						
			// check that the post was successfully updated
			$updatedArticle = $articles->getArticle( $article->getId());
			$this->assertEquals( $cat2->getId(), $updatedArticle->_categoryIds[0]);


			$this->assertTrue( $cats->deleteCategory( $cat2->getId(), $this->blog->getId()),
                               "Couldn't erase/cleanup category");

			// get the response and see that it has the right encoding
			$this->assertTrue( $this->checkResponseEncoding( $c->message->rawmessage, $this->blog ), 
			                   "The blog encoding and the response of the XMLRPC request did not match!" );			
		}


		
		/**
		 * @private
		 */
		function checkResponseEncoding( $response, $blog )
		{
			// check the character encoding in the response
			$numMatches = preg_match( "/<\\?xml.*version=\"1.0\".*encoding=\"(.*)\".*\?>.*/i", 
			                        $response,
			                        $matches );
			if( $numMatches != 1 )
				return false;
				
			$encoding = $matches[1];
			
			// check that the blog encoding and what we got in the response is the same
			$locale = $this->blog->getLocale();
			$blogEncoding = $locale->getCharSet();
			
			return( $locale->getCharset() == $encoding );
		}		
	}
?>