<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/data/validator/arrayvalidator.class.php" );

	/**
	 * \ingroup Test
	 *
	 * Test case for the ArrayValidator class
	 */
	class ArrayValidator_Test extends LifeTypeTestCase
	{
		function setUp()
		{
			// create a username validator
			$this->v = new ArrayValidator();
		}
		
		function testEmptyArray()
		{
			$this->assertTrue( $this->v->validate(Array()));
		}
		
		function testNotArray()
		{
			$this->assertFalse( $this->v->validate( "" ));
		}
		
		/**
		 * checks that by providing a validator object as the element validator,
		 * all elements in the array are validated using the given class
		 */
		function testElementValidator()
		{
			lt_include( PLOG_CLASS_PATH."class/data/validator/integervalidator.class.php" );
			lt_include( PLOG_CLASS_PATH."class/data/validator/emailvalidator.class.php" );
			
			// valid array with integers
			$intArrayValid = Array( 1, 2, 6, 10, 44 );
			$v = new ArrayValidator( new IntegerValidator());
			$this->assertTrue( $v->validate( $intArrayValid ));
			
			// invalid array with integers			
			$intArrayNotValid = Array( 1, "4", "afasdf", 44 );			
			$this->assertFalse( $v->validate( $intArrayNotValid ));
		}
	}
?>