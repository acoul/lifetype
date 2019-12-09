<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/test/helpers/testtools.class.php" );	
	lt_include( PLOG_CLASS_PATH."class/dao/articlecategory.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/articlecategories.class.php" );

	/**
	 * \ingroup Test
	 *
	 * Test cases for the ArticleCategories class
	 */
	class ArticleCategories_Test extends LifeTypeTestCase
	{
        function setUp(){
			// create the test data
			$this->data = TestTools::createBlogScenario(
                Array( "num_articles" => 5, "num_categories" => 3 ));

			$this->article = TestTools::createArticle( $this->data["blog"]->getId(),
                                                       $this->data["user"]->getId(),
                                                       Array( $this->data["categories"][0]->getId()),
                                                       POST_STATUS_DRAFT );
        }

        function tearDown(){
			// delete the test data
			TestTools::deleteDaoTestData( $this->data["articles"] );
			TestTools::deleteDaoTestData( $this->data["categories"] );
            TestTools::deleteDaoTestData( Array( $this->article,
                                                 $this->data["user"] ));
            TestTools::deleteBlog($this->data["blog"]);
        }
        
		/**
		 * Regression test for Mantis case http://bugs.lifetype.net/view.php?id=1100 -- category
		 * counters getting out of sync.
		 */
		function testArticleCategoriesCounters()
		{
			// add an article to one of the categories

			$this->assertTrue( $this->article, "Error creating test article!" );
			
			// check that the counter has been updated
			$articleCategories = new ArticleCategories();
			$updatedCat = $articleCategories->getCategory( $this->data["categories"][0]->getId());
			$this->assertTrue( $updatedCat->getNumArticles( POST_STATUS_ALL ) == ($this->data["categories"][0]->getNumArticles() + 1 ), "Article category counters are not valid!" );
			
			// now let's mess up the database a little
			$db =& Db::getDb();
			$db->Execute( "UPDATE ".Db::getPrefix().
			              "articles_categories SET num_published_articles = 234234, num_articles = 2342 ".
			              "WHERE id = ".$this->data["categories"][1]->getId());
			// trigger a cache reset
			$articleCategories->_cache->removeData( $this->data["categories"][1]->getId(), CACHE_ARTICLE_CATEGORIES );
			// update the category, reload it and check that the counters are correct again
			$tmp = $this->data["categories"][1];
			$articleCategories->updateCategory( $tmp );
			$updatedCat2 = $articleCategories->getCategory( $this->data["categories"][1]->getId());
			$this->assertTrue( $updatedCat2->getNumArticles( POST_STATUS_ALL ) == $this->data["categories"][1]->getNumArticles( POST_STATUS_ALL ), "Article category counters do not match!" );
			$this->assertTrue( $updatedCat2->getNumPublishedArticles() == $this->data["categories"][1]->getNumPublishedArticles(), "Article category counters do not match!" );

		}
	}
?>