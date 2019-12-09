<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/data/filter/htmlfilter.class.php" );

	/**
	 * \ingroup Test
	 *
	 * Test case for the HtmlFilter class
	 */
	class HtmlFilter_Test extends LifeTypeTestCase
	{
		function setUp()
		{
			// create a username validator
			$this->f = new HtmlFilter();
		}
		
		function testFilter()
		{
			$data = Array(
				"input" => "input",
				"<b>input</b>" => "input",
				"<script>window.alert();</script>" => "window.alert();",
				"\"><script>alert(1)</script>" => "\">alert(1)"
			);
			
			foreach( $data as $input => $output ) {
				$this->assertEquals( $output, $this->f->filter( $input ));
			}
		}
		
		/**
		 * Test that HTML entities are converted when the first parameter
		 * passed to the constructor is set to 'true'
		 */
		function testFilterWithHtmlFilterEnabled()
		{
			$f = new HtmlFilter( true );
			$this->assertEquals( "&quot;&gt;alert(1)", $f->filter( "\"><script>alert(1)</script>" ));
		}
	}
?>