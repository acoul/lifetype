<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/data/validator/integervalidator.class.php" );

	/**
	 * \ingroup Test
	 *
	 * Test case for the IntegerValidator class
	 */
	class IntegerValidator_Test extends LifeTypeTestCase
	{
		function setUp()
		{
			// a signed and an unsigned validator
			$this->v = new IntegerValidator();
			$this->signed = new IntegerValidator( true );
		}
		
		function testUnsigned()
		{
			$this->assertTrue( $this->v->validate( "145" ));
		}

		function testSignedPositive()
		{
			$this->assertTrue( $this->signed->validate( "+332" ));
		}

		function testSignedNegative()
		{
			$this->assertTrue( $this->signed->validate( "-21" ));
		}
		
		function testSignedNoSign()
		{
			$this->assertTrue( $this->signed->validate( "21" ));			
		}
		
		function testSignedNotInteger()
		{
			$this->assertFalse( $this->v->validate( "+221adsf" ));			
		}
		
		function testNotInteger()
		{
			$this->assertFalse( $this->v->validate( "443.23" ));
		}
		
		function testString()
		{
			$this->assertFalse( $this->v->validate( "not_an_integer" ));
		}		
	}
?>