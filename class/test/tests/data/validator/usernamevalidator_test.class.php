<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/data/validator/usernamevalidator.class.php" );

	/**
	 * \ingroup Test
	 *
	 * Test case for the UsernameValidator class
	 */
	class UsernameValidator_Test extends LifeTypeTestCase
	{
		function setUp()
		{
			// create a username validator
			$this->u = new UsernameValidator();
		}
		
		/**
		 * tests that an empty username does not validate
		 */
		function testEmptyUsername()
		{
			$this->assertFalse( $this->u->validate( "" ), "An empty username did not generate an error!" );
		}
		
		/**
		 * tests a username longer than 15 characters
		 */
		function testTooLongUsername()
		{
			$this->assertFalse( $this->u->validate( "12345678901234567890" ), "Username was longer than 15 characters!" );
		}
		
		/**
		 * tests that a forbidden username does not validate
		 */
		function testForbiddenUsername()
		{
			// get the list of forbidden words, based on our configuration settings
			lt_include( PLOG_CLASS_PATH."class/config/config.class.php" );
			$config =& Config::getConfig();

			$forbiddenUsernames = $config->getValue( "forbidden_usernames" );
			$forbiddenUsernamesArray = explode( " ", $forbiddenUsernames );
			$tmp = array_pop( $forbiddenUsernamesArray );
			
			$this->assertFalse( $this->u->validate( $tmp ), "A forbidden username should not be accepted as valid!" );
		}
		
		/**
		 * test a username with upper-case characters
		 */
		function testUpperCase()
		{
			$this->assertFalse( $this->u->validate( "wHAtevEr" ), "An invalid username was accepted!" );
		}
		
		/**
		 * tests a valid username
		 */
		function testValidUsername()
		{
			$this->assertTrue( $this->u->validate( "whatever" ), "A valid username was not accepted!" );
		}
	}
?>