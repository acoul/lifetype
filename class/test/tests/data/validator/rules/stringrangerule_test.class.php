<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/data/validator/rules/stringrangerule.class.php" );

	/**
	 * \ingroup Test
	 *
	 * Test cases for the StringRangeRule class
	 */
	class StringRangeRule_Test extends LifeTypeTestCase
	{
		/** 
		 * creates a StringRangeRule object with a length up to 10 characters and then attempt to 
		 * validate a string with 11 characters
		 */
		function testTooLongString()
		{
			$r = new StringRangeRule( 0, 10 );
			
			// check that the rule returned false
			$this->assertFalse( $r->validate( "12345678901" ), "StringRangeRule up to 10 characters, 11-character string accepted!" );
			// and that the error code was correct
			$this->assertEquals( ERROR_RULE_STRING_TOO_LARGE, $r->getError(), "Error code was not ERROR_RULE_STRING_TOO_LARGE" );
		}
		
		/** 
		 * creates a StringRangeRule object with a length of at least 5 characters and then attempt to 
		 * validate a string with 13 characters
		 */
		function testTooShortString()
		{
			$r = new StringRangeRule( 5, 10 );
			
			// check that the rule returned false
			$this->assertFalse( $r->validate( "123" ), "StringRangeRule of at least 5 characters, 3-character string accepted!" );
			// and that the error code was correct
			$this->assertEquals( ERROR_RULE_STRING_TOO_SMALL, $r->getError(), "Error code was not ERROR_RULE_STRING_TOO_SMALL" );
		}		
		
		/**
		 * tests a range rule with no upper limit
		 */
		function testUnlimitedLength()
		{
			$r = new StringRangeRule( 5, 0 );
			
			// check that the rule returned false
			$this->assertTrue( $r->validate( "123456789011231231" ), "StringRangeRule should allow unlimited length" );
		}
		
		/**
		 * tests a string within the defined boundaries
		 */
		function testValidString()
		{
			$r = new StringRangeRule( 5, 40 );
			
			// check that the rule returned false
			$this->assertTrue( $r->validate( "123456789011231231" ), "StringRangeRule should allow up to 40 characters!" );
		}
	}
?>