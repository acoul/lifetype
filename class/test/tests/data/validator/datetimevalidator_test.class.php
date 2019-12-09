<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/data/validator/datetimevalidator.class.php" );

	/**
	 * \ingroup Test
	 *
	 * Test case for the ArrayValidator class
	 */
	class DateTimeValidator_Test extends LifeTypeTestCase
	{
		function testDate()
		{
			// create a username validator
			$v = new DateTimeValidator( '%Y%m%d' );
			$this->assertTrue( $v->validate( '20070813' ) );
			$this->assertFalse( $v->validate( '07813' ) );
		}
		
		function testDateTime()
		{
			// create a username validator
			$v = new DateTimeValidator( '%Y-%m-%d %G:%i' );
			$this->assertTrue( $v->validate( '2007-08-13 23:37' ) );
			$this->assertFalse( $v->validate( '2007-08-13 23' ) );
		}
	}
?>