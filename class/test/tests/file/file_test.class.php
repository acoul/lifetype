<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/file/file.class.php" );

	/**
	 * \ingroup Test
	 *
	 * Test case for the File class 
	 */
	class File_Test extends LifeTypeTestCase
	{
		function testBasename()
		{
			// test for chinese file name
			$this->assertEquals("中文檔名.jpg", File::basename( "./gallery/1/中文檔名.jpg"));
			$this->assertEquals("中文檔名.jpg", File::basename( ".\\gallery\\1\\中文檔名.jpg"));
			// test for english file name
			$this->assertEquals("english.jpg", File::basename( "./gallery/1/english.jpg"));
			$this->assertEquals("english.jpg", File::basename( ".\\gallery\\1\\english.jpg"));
			$this->assertEquals("english.jpg", File::basename( ".\\gallery\1\english.jpg"));
			// test for file name with space
			$this->assertEquals("中文 name.jpg", File::basename("./gallery/1/中文 name.jpg"));
			$this->assertEquals("中文 name.jpg", File::basename( ".\\gallery\\1\\中文 name.jpg"));
			// test for multiple slashes
			$this->assertEquals("中文 name.jpg", File::basename( "/./////gallery/////1/中文 name.jpg"));
			$this->assertEquals("中文 name.jpg", File::basename( "\.\\\\\gallery\\\\\1\中文 name.jpg"));
			$this->assertEquals("中文 name.jpg", File::basename( "\.\\\\\gallery\\\\\1\\中文 name.jpg"));
		}
		
		function testExpandPath()
		{
			$this->assertEquals( "path", File::expandPath( "./path" ));
			$this->assertEquals( "a", File::expandPath( "./path/../a" ));
			$this->assertEquals( "/path", File::expandPath( "/path" ));
			$this->assertEquals( "/path", File::expandPath( "/path/././././" ));			
		}
	}
?>