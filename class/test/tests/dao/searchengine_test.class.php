<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/test/helpers/testtools.class.php" );	
	lt_include( PLOG_CLASS_PATH."class/dao/searchengine.class.php" );

	/**
	 * \ingroup Test
	 *
	 * Test cases for the SearchEngine class
	 */
	class SearchEngine_Test extends LifeTypeTestCase
	{
		var $user;
		var $blog;
		var $articles;
		var $cat;
		var $art1;
		var $art2;
		
		/**
		 * @private
		 * Set up the test data
		 */
		function setUp()
		{
			// create the test data
			$this->user = TestTools::createUser();
			$this->blog = TestTools::createBlog( $this->user->getId());
			$this->cat  = TestTools::createArticleCategory( $this->blog->getId());
			
			// create a post with current date
			$this->art1 = TestTools::createArticle( $this->blog->getId(), $this->user->getId(), Array( $this->cat->getId()));
			// and one with future date
			$t = new Timestamp();
			$t->addSeconds( 60 * 60 * 10 );
			$this->art2 = TestTools::createArticle( $this->blog->getId(), $this->user->getId(), Array( $this->cat->getId()), POST_STATUS_PUBLISHED, $t );

            sleep(1); // have to sleep, otherwise the search for "time < NOW()" will return false
                // for all articles.  Alternatively, the searchengine could use "time <= NOW()"
		}
		
		/**
		 * @private
		 * Delete the test data
		 */		
		function tearDown()
		{
			TestTools::deleteDaoTestData(
                Array( $this->art1, $this->art2, $this->cat, $this->user)
			);
			TestTools::deleteBlog( $this->blog );
		}
		
		/**
		 * make sure that future posts are not returned as search results
		 */
		function testSearchIgnoreFuturePosts()
		{
                // check that when searching for this specific string, we only get one match (there should only be one test article)
			$searchEngine = new SearchEngine();
			$results = $searchEngine->search( $this->blog->getId(), "test article", POST_STATUS_PUBLISHED, false );
			$this->assertEquals( 1, count( $results ), "There should only be one article in the search results" );
			
			// check that the article with the future date is not part of the results
			foreach( $results as $result ) {
				if( $result->getType() == SEARCH_RESULT_ARTICLE ) {
					$article = $result->getArticle();
					$this->assertFalse( ($article->getId() == $this->art2->getId()), "The future article was found as part of the search results!" );
				}
			}
			
			// and finally check that the amount of search results returned is valid
			$this->assertEquals( 1, $searchEngine->getNumSearchResults( $this->blog->getId(), "test article", POST_STATUS_PUBLISHED, false ),
			                     "SearchEngine::getNumSearchResults() returned additional articles???" );
		}
		
		/**
		 * make sure that future posts are not returned as search results when
		 * doing site-wide searches
		 */
		function testSiteSearchIgnoreFuturePosts()
		{
                // check that when searching for this specific string,
                // we only get one match (there should only be one test article)
			$searchEngine = new SearchEngine();
			$results = $searchEngine->siteSearch("test article", SEARCH_ARTICLE,
                                                  POST_STATUS_PUBLISHED, false);
			$this->assertEquals( 1, count( $results ), "There should only be one article in the search results" );
			// check that the article with the future date is not part of the results
			foreach( $results as $result ) {
				if( $result->getType() == SEARCH_RESULT_ARTICLE ) {
					$article = $result->getArticle();
					$this->assertFalse( ($article->getId() == $this->art2->getId()), "The future article was found as part of the search results!" );
				}
			}
			
			// and finally check that the amount of search results returned is valid
            $numResults = $searchEngine->getNumSiteSearchResults(
                "test article", SEARCH_ARTICLE, POST_STATUS_PUBLISHED, false );
            $this->assertEquals(1, $numResults,
                                "The future article was counted by getNumSiteSearchResults()!");
		}
	}
?>