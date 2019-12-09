<?php

lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
lt_include( PLOG_CLASS_PATH."class/test/helpers/testtools.class.php" );	
lt_include( PLOG_CLASS_PATH."class/config/config.class.php" );

	/**
	 * \ingroup Test
	 *
	 * Tests the user interface to work with article categories
	 */
	class ArticleCategoriesUI_Test extends LifeTypeTestCase
	{
		function setUp()
		{
			$this->user = TestTools::createUser();
			$this->blog = TestTools::createBlog( $this->user->getId());
		}
		
		function tearDown()
		{
			TestTools::deleteDaoTestData( Array( $this->user ));
			TestTools::deleteBlog( $this->blog );
		}
		
		/**
		 * Test the whoe login and logout process
		 */
		function testArticleCategories()
		{
            $config =& Config::getConfig();

			$this->assertUIScript(
				Array(
					"login" => Array(
						"url" => $this->getAdminUrl(),
						"type" => "post",
						"params" => Array(
							"userName" => $this->user->getUserName(),
							"userPassword" => "password",
							"op" => "Login"
						),
						"expected" => "Dashboard",
						"message" => "The dashboard did not appear when logging in"
					 ),
					"select_blog" => Array(
						"url" => $this->getAdminUrl(),
						"type" => "get",
						"params" => Array(
							"op" => "blogSelect",
							"blogId" => $this->blog->getId()
						),
						"expected" => "<b><a href=\"?op=newPost\">New Post",
						"message" => "The blog could not be selected after the dashboard"
					),
					"new_category" => Array(
						"url" => $this->getAdminUrl(),
						"type" => "get",
						"params" => Array( "op" => "newArticleCategory" ),
						"expected" => "Name that will be used to display the category",
						"message" => "The form to input a new category was not successfully displayed"
					),
					"create_category" => Array(
						"url" => $this->getAdminUrl(),
						"type" => "post",
						"params" => Array( "categoryName" => "test category", "categoryDescription" => "description", "categoryInMainPage" => "1" , "op" => "addArticleCategory" ),
						"expected" => "Category \"test category\" was successfully added to the blog",
						"message" => "The test category was not successully added"
					)
				)
			);
			
			// find the category in the db...
			$cats = new ArticleCategories();
			$cat = $cats->getCategoryByName( "test".$config->getValue( "urlize_word_separator" )."category",
                                             $this->blog->getId());
			$this->assertTrue($cat != NULL, "Category \"test category\" was added but now cannot be found");

            if($cat){
                    // ...and delete it via the UI
                $this->assertUIScript(
                    Array(
                        "delete_category" => Array(
                            "url" => $this->getAdminUrl(),
                            "type" => "get",
                            "params" => Array( "categoryId" => $cat->getId(),
                                               "op" => "deleteArticleCategory" ),
                            "expected" => "Category \"".$cat->getName()."\" deleted successfully",
                            "message" => "The test category was not successully deleted"
                            ),
                        "delete_category_again" => Array(
                            "url" => $this->getAdminUrl(),
                            "type" => "get",
                            "params" => Array( "categoryId" => $cat->getId(),
                                               "op" => "deleteArticleCategory" ),
                            "expected" => "There was an error deleting category with identifier \"".
                                               $cat->getId()."\"",
                            "message" => "Attempting to delete the same category twice did not ".
                                               "generate the expected error message"
                            )
                        )
                    );
            }
		}
	}
?>