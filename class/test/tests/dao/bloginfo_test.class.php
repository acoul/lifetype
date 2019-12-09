<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/bloginfo.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/blogs.class.php" );	
	lt_include( PLOG_CLASS_PATH."class/data/timestamp.class.php" );		

	/**
	 * \ingroup Test
	 *
	 * Test cases for the BlogInfo class
	 */
	class BlogInfo_Test extends LifeTypeTestCase
	{
		/** 
		 * regression test for mantis case 978 (http://bugs.lifetype.net/view.php?id=978)
		 */
		function testGetUpdateDateObject()
		{
			$blogs = new Blogs();
			// let's hope that blog '1' exists... if not throw an assert error
			$blog = $blogs->getBlogInfo( 1 );
			$this->assertTrue( $blog, "Couldn't load blog with id '1', make sure it exists!" );
			
			// test the getUpdateDateObject() method to make sure it does not return the current date
			$now = new Timestamp();
			$blogUpdateDate = $blog->getUpdateDateObject();
			
			// check that the dates are different
			$sameDate = ( $now->getIsoDate() == $blogUpdateDate->getIsoDate());
			
			$this->assertFalse( $sameDate, "Please see Mantis case 978 <a href='http://bugs.lifetype.net/view.php?id=978'>here</a>." );
		}
		
		/**
		 * no html allowed in the blog name
		 */
		function testSetBlogNoHtmlAllowed()
		{
			lt_include( PLOG_CLASS_PATH."class/data/textfilter.class.php" );
			$blogNameHtml = "<h1>This is</h1>some <script type=\"text/javascript\">window.alert('hello!');</script>HTML!";
			
        	$blog = new BlogInfo( "blah", 1, "blah blah", new BlogSettings());

			$blog->setBlog( $blogNameHtml );
			
            $tf = new Textfilter();
			$this->assertEquals( $tf->filterAllHTML($blogNameHtml), $blog->getBlog());
		}
		
		/**
		 * regression test for mantis case 1006 (http://bugs.lifetype.net/view.php?id=1006)
		 * BlogInfo::setMangledBlogName() should re-run Textfilter::domainize() on blog names
		 */
		function testSetMangledBlogName()
		{
			// when set to 'true', the second parameter modifies the blog name
			$blogName = "this_is_a_blog____  name";			
        	$blog = new BlogInfo( "blah", 1, "blah blah", new BlogSettings());
			$blog->setMangledBlogName( $blogName, true );			
			$this->assertEquals( Textfilter::domainize( $blogName ), $blog->getMangledBlogName());
			// and went set to 'false' (default value) it won't
			$blogName = "this_is_a_blog____  name";			
        	$blog2 = new BlogInfo( "blah", 1, "blah blah", new BlogSettings());
			$blog2->setMangledBlogName( $blogName, false );
			$this->assertEquals( "this_is_a_blog____  name", $blog2->getMangledBlogName());			
		}
	}
?>