<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/misc/glob.class.php" );	

	/**
	 * \ingroup Test
	 *
	 * Test cases for the Glob class.
	 */
	class Glob_Test extends LifeTypeTestCase
	{
		function testmyFnMatch()
		{
			// incorrect match
			$this->assertFalse( Glob::_myFnmatch( "*.index.template.*", "index.template.php" ) );

			// valid match
			$this->assertTrue( Glob::_myFnmatch( "*index.template.*", "index.template.php" ) );		
		}

		function testfnmatch()
		{
			// case sensitive check => false
			$this->assertFalse( Glob::fnmatch( "*index.template.PHP", "index.template.php", true ) );

			// case insensitive check => true
			$this->assertTrue( Glob::fnmatch( "*index.template.PHP", "index.template.php", false ) );

			// default is case-insensitive => true
			$this->assertTrue( Glob::fnmatch( "*index.template.PHP", "index.template.php" ) );
		}		
	}
?>