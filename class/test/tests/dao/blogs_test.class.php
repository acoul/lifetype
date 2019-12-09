<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/bloginfo.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/blogs.class.php" );

	/**
	 * \ingroup Test
	 *
	 * Test cases for the Blogs class
	 */
	class Blogs_Test extends LifeTypeTestCase
	{
		/** 
		 * regression test for Mantis 1005 (http://bugs.lifetype.net/view.php?id=1005)
		 */
		function testAddBlogUniqueMangledBlog()
		{
			$blogs = new Blogs();
			
			// create two blogs, both with the same name. The mangled_blog field should be 'xxx' for the first
			// one that was added and 'xxx2' for the second one. If not, throw an error.
			
			// an absolutely random name
			$randomName = md5(time());
			
			// add the blogs
			$blog1 = new BlogInfo( $randomName, 1, "About blog 1", new BlogSettings());
			$blog2 = new BlogInfo( $randomName, 1, "About blog 2", new BlogSettings());
			$blog3 = new BlogInfo( $randomName, 1, "About blog 3", new BlogSettings());			
			$blogs->addBlog( $blog1 );
			$blogs->addBlog( $blog2 );
			$blogs->addBlog( $blog3 );			
			
			// compare the mangled names
			$this->assertEquals( $randomName, $blog1->getMangledBlogName());
			$this->assertEquals( $randomName."2", $blog2->getMangledBlogName());
			$this->assertEquals( $randomName."3", $blog3->getMangledBlogName());		
			
			// delete the temporary blogs
			$blogs->deleteBlog( $blog1->getId());
			$blogs->deleteBlog( $blog2->getId());
			$blogs->deleteBlog( $blog3->getId());
		}
		
		/** 
		 * regression test for Mantis 1005 (http://bugs.lifetype.net/view.php?id=1005)
		 * Blog names ("mangled names") should be kept unique accross blog updates!
		 */
		function testUpdateBlogUniqueMangledBlog()
		{
			$blogs = new Blogs();
			
			// create two blogs, both with the same name. The mangled_blog field should be 'xxx' for the first
			// one that was added and 'xxx2' for the second one. If not, throw an error.
			
			// an absolutely random name
			$randomName = md5(time());
			
			// add the blogs
			$blog1 = new BlogInfo( $randomName, 1, "About blog 1", new BlogSettings());
			$blog2 = new BlogInfo( $randomName, 1, "About blog 2", new BlogSettings());
			$blog3 = new BlogInfo( $randomName, 1, "About blog 3", new BlogSettings());			
			$blogs->addBlog( $blog1 );
			$blogs->addBlog( $blog2 );
			$blogs->addBlog( $blog3 );
			
			// update the name and the mangled blog name, in the same way it is done in
			// class/action/admin/adminupdateblogsettingsaction.class.php
			$blog1->setBlog( $randomName );
			$blog1->setMangledBlogName( $randomName, true );
			$blogs->updateBlog( $blog1 );
			$blog2->setMangledBlogName( $randomName, true );
			$blog2->setBlog( $randomName );
			$blog2->setMangledBlogName( $randomName, true );
			$blogs->updateBlog( $blog2 );
			$blog3->setMangledBlogName( $randomName, true );
			$blog3->setBlog( $randomName );	
			$blogs->updateBlog( $blog3 );
			
			// compare the mangled names
			$this->assertEquals( $randomName, $blog1->getMangledBlogName());
			$this->assertEquals( $randomName."2", $blog2->getMangledBlogName());
			$this->assertEquals( $randomName."3", $blog3->getMangledBlogName());		
			
			// delete the temporary blogs
			$blogs->deleteBlog( $blog1->getId());
			$blogs->deleteBlog( $blog2->getId());
			$blogs->deleteBlog( $blog3->getId());
		}

		
	}
?>