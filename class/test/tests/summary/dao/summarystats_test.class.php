<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/test/helpers/testtools.class.php" );	
	lt_include( PLOG_CLASS_PATH."class/dao/articles.class.php" );
	lt_include( PLOG_CLASS_PATH."class/summary/dao/summarystats.class.php" );

	/**
	 * Unit test cases for the SummaryStats class
	 */
	class SummaryStats_Test extends LifeTypeTestCase
	{
		var $blog;
		var $user;
		var $cat;
		
		function setUp()
		{
			$this->user = TestTools::createUser();
			$this->blog = TestTools::createBlog( $this->user->getId());
			$this->cat  = TestTools::createArticleCategory( $this->blog->getId());
		}
		
		function tearDown()
		{
			TestTools::deleteDaoTestData(Array($this->cat, $this->user));
			TestTools::deleteBlog( $this->blog );
        }
		
		/**
		 * Test case for SummaryStats::getRecentArticles and mantis case 1052 
		 * (http://bugs.lifetype.net/view.php?id=1052)
		 */
		function testGetRecentArticlesIgnoreFuturePosts()
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
			// set the date within 5 minutes
			//$t = Timestamp::getTimestampWithOffset( new Timestamp(), 2 );
			$t = new Timestamp();
			$t->addSeconds( 5 * 60 );
			$article->setDateObject( $t );

			// save the article and check
			$articles = new Articles();
			$this->assertTrue( $articles->addArticle( $article ), "Unable to add a new test article" );

			// load the list of recent posts and check that the one we've just added, which
			// has a date in the future, isn't there
			$stats = new SummaryStats();
			$posts = $stats->getRecentArticles();
			$i = 0;
			$found = false;				
			while( $i < count( $posts ) && !$found ) {
				$found = ($posts[$i]->getId() == $article->getId());
				$i++;
			}
			
			$this->assertFalse( $found, "A post with date in the future was returned by getRecentPosts" );
			
			$this->assertTrue(
                $articles->deleteArticle( $article->getId(),
                                          $this->user->getId(),
                                          $this->blog->getId(),
                                          true),
                              "Could not delete article!");
		}
	}
?>