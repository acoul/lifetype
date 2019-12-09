<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/file/unpacker/zipunpacker.class.php" );
	lt_include( PLOG_CLASS_PATH."class/config/config.class.php" );
	
	define( "PCLZIP_TEST_FILE", PLOG_CLASS_PATH."class/test/tests/file/unpacker/pclziptest.zip" );

	/**
	 * \ingroup Test
	 *
	 * Test case for the PCLZip library, used by the ZipUnpacker class
	 */
	class ZipUnpacker_Test extends LifeTypeTestCase
	{
		function setUp()
		{
			// make sure that our test file is there
			if( !File::isReadable( PCLZIP_TEST_FILE ))
				die( "Can't continue with ZipUnpacker_Test: Please make sure that ".PCLZIP_TEST_FILE." is available" );
				
			$this->u = new ZipUnpacker();
		}
		
		function testMissingFile()
		{
			$this->assertFalse( $this->u->unpackNative( "whatever", "./anyfolder" ));
		}
		
		function testUnpack()
		{
			// create a temporary folder and unzip the file there
			$config =& Config::getConfig();
			
			$tmpFolder = $config->getTempFolder()."/".md5(time());
			File::createDir( $tmpFolder );
			$this->assertTrue( $this->u->unpackNative( PCLZIP_TEST_FILE, $tmpFolder ));
			
			// check that the two files exist and are readable
			$this->assertTrue( File::isReadable( $tmpFolder."/test.txt" ));
			$this->assertTrue( File::isReadable( $tmpFolder."/test2.txt" ));
		}
	}
?>