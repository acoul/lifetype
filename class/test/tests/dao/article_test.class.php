<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/test/helpers/testtools.class.php" );	
	lt_include( PLOG_CLASS_PATH."class/dao/usercomment.class.php" );

	/**
	 * \ingroup Test
	 *
	 * Test cases for the Article class
	 */
	class Article_Test extends LifeTypeTestCase
	{
		function setUp()
		{
			// create the scenario
			$this->user = TestTools::createUser();
			$this->blog = TestTools::createBlog( $this->user->getId());
			$this->cat  = TestTools::createArticleCategory( $this->blog->getId());
			$this->article = TestTools::createArticle( $this->blog->getId(), $this->user->getId(),
                                                       Array( $this->cat->getId()));
		}

        function tearDown(){
			TestTools::deleteDaoTestData(Array($this->article, $this->cat, $this->user));
			TestTools::deleteBlog( $this->blog );
        }
        
		/** 
		 * regression test for mantis case 986 (http://bugs.lifetype.net/view.php?id=986)
		 * and for method Article::hasExtendedText in general
		 */
		function testHasExtendedText()
		{
			// set some normal extended text, it should return true
			$this->article->setExtendedText( "this is a test" );
			$this->assertTrue( $this->article->hasExtendedText(), "Extended text was set but hasExtendedText returned false!" );
			
			// remove the text and try again
			$this->article->setExtendedText( "" );
			$this->assertFalse( $this->article->hasExtendedText(), "there is no text set but hasExtendedText did not return false!" );			
			
			// set some text that should work as empty
			foreach( Array( "<br/>", "<br />", "<p/>", "<p />", "" ) as $emptyText ) {
				$this->article->setExtendedText( $emptyText );
				$this->assertFalse( $this->article->hasExtendedText(), 
				                    "extended text set to ".htmlspecialchars($emptyText).", which should count as no extended text ".
				                    "but hasExtendedText did not return false!" );						
			}
		}
		
		/**
		 * Test case for mantis issue http://bugs.lifetype.net/view.php?id=1244,
		 * Articles::setComments() not using the same internal array used by
		 * Articles::getComments()
		 */
		function testSetCommentsAndGetComments()
		{
			// create a dummy comment
			$c = new UserComment( $this->article->getId(), 
								  $this->article->getBlogId(), 
								  0, 
								  "topic", 
								  "text"
			     );
			
			$cSpam = new UserComment( $this->article->getId(), 
								  $this->article->getBlogId(), 
								  0, 
								  "topic spam", 
								  "text spam"
			     );
			$cSpam->setStatus( COMMENT_STATUS_SPAM );
			
			// now calling Article::getComments() after Article::setComments() with the dummy comment above
			// should not return the same
			$this->article->setComments( Array( $c ));
			$this->article->setComments( Array( $cSpam ), COMMENT_STATUS_SPAM );
			$this->assertEquals( Array( $c ), $this->article->getComments());
			$this->assertEquals( Array( $cSpam ), $this->article->getComments( COMMENT_STATUS_SPAM ));
		}
	}
?>