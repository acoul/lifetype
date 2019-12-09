<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/misc/version.class.php" );	

	/**
	 * \ingroup Test
	 *
	 * Test cases for the Version class.
	 */
	class Version_Test extends LifeTypeTestCase
	{
		var $_data;
		
		function setUp()
		{
			$this->_data = Array(
				Array( "lifetype-1.2.3", "1.2.4", -1 ),
				Array( "lifetype-1.2.3", "1.3", -1 ),
				Array( "1.2", "1.1.2", 1 ),
				Array( "1.2.3", "lifetype-1.2.3", 0 ),		// they are the same
				Array( "1.2.3-dev", "lifetype-1.2.3", -1 ),		// a stable release is always newer than the same number in "dev" mode
				Array( "lifetype-1.2.3-dev", "lifetype-1.2.3", -1 ),
				Array( "1.2.3-dev", "1.2.3", -1 ),
				Array( "1.2.3", "1.2.3-dev", 1 ),
				Array( "1.3-dev", "1.2.3-dev", 1 ),		// dev in 1.3 is newer than dev in 1.2.3
				Array( "1.3-dev", "1.2.4", 1 ),
				Array( "lifetype-1.2-r4455", "lifetype-1.2.3-r5443", -1 ),   // using an svn revision number
				Array( "lifetype-1.2.3-r5443", "lifetype-1.2.3-r5444", -1 ),
				Array( "lifetype-1.2.3-r5444", "lifetype-1.2.3-r5443", 1 ),
				Array( "1.2.4-dev", "lifetype-1.2.3-r5444", 1 ),
				Array( "1.2.3-dev", "lifetype-1.2.4-r6665", -1 ),
				Array( "lifetype-1.2.4", "lifetype-1.2.4_r5443", -1 ), // with svn revision is not older, maybe equal
				Array( "lifetype-1.2.4_r5444", "lifetype-1.2.4", 1 ),
				Array( "lifetype-1.2.4_r5444", "lifetype-1.2.4_r5443", 1 ),
				Array( "lifetype-1.2.4", "lifetype-1.2.4-r5443", -1 ), // same 3 tests as above but with dash (-)
				Array( "lifetype-1.2.4-r5444", "lifetype-1.2.4", 1 ),
				Array( "lifetype-1.2.4-r5444", "lifetype-1.2.4-r5443", 1 ),
				Array( "lifetype-1.2.4-r5444", "lifetype-1.2.4-r5444", 0 )
			);			
		}
		
		function testVersionCompare()
		{
			foreach( $this->_data as $version ) {
				$this->assertEquals( $version[2], Version::compare( $version[0], $version[1] ),
				                     "Error comparing <b>$version[0]</b> with <b>$version[1]</b>" ); 
			}
		}
		
		function testIsNewer()
		{
			foreach( $this->_data as $version ) {
				if( $version[2] == -1 ) 
					$this->assertTrue( Version::isNewer( $version[1], $version[0] ));
				else
					$this->assertFalse( Version::isNewer( $version[1], $version[0] ));
			}			
		}
	}
?>
