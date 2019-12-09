<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/config/properties.class.php" );		

	/**
	 * \ingroup Test
	 *
	 * Test cases for the Properties class
	 */
	class Properties_Test extends LifeTypeTestCase
	{
		var $p;
		
		function setUp()
		{
			$this->p = new Properties();
			$this->p->setValue( "test", "<b>this</b> has some <h1>HTML</h1> in it!" );
		}
		
		/**
		 * Tests the Properties::getValue() method using a filter class as a third
		 * parameter
		 */
		function testGetValueWithFilterClass()
		{
			// when not using a filter class, we should get the value as is
			$this->assertEquals( "<b>this</b> has some <h1>HTML</h1> in it!", $this->p->getValue( "test" ));
			
			// when using a filter class, the value should be returned filtered
			lt_include( PLOG_CLASS_PATH."class/data/filter/htmlfilter.class.php" );
			$this->assertEquals( "this has some HTML in it!", $this->p->getValue( "test", null, new HtmlFilter()));
		}
		
		function testRegisterFilter()
		{
			// when not using a filter class, we should get the value as is
			$this->assertEquals( "<b>this</b> has some <h1>HTML</h1> in it!", $this->p->getValue( "test" ));			
			
			// now register a filter for this key and check that the output is filtered
			$this->p->registerFilter( "test", new HtmlFilter());
			$this->assertEquals( "this has some HTML in it!", $this->p->getValue( "test" ));
		}
	}
?>