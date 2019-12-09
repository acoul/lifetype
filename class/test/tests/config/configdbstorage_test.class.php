<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/config/configdbstorage.class.php" );		

	/**
	 * \ingroup Test
	 *
	 * Test cases for the Config class, but only the database-based backend, not the file backend
	 */
	class ConfigDbStorage_Test extends LifeTypeTestCase
	{
		/** 
		 * regression test for svn revision 3726. It basically tests whether the ConfigDbStorage::getValue()
		 * method will return the default value specified as the second parameter when the provided
		 * key doesn't exist.
		 */
		function testGetValueWithDefaultValue()
		{
			$config = new ConfigDbStorage();
			
			// request a bogus key and see if we get the default value
			$defaultValue = "333";
			$value = $config->getValue( "this_key_should_really_really_not_exist", $defaultValue );
			
			// check if they're equal (they should!)
			$this->assertEquals( $defaultValue, $value, "getValue() did not return the default value when a non-existant key was requested, please see svn revision 3726" );
		}
	}
?>