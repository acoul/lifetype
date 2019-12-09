<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/data/filter/filterbase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/data/filter/htmlfilter.class.php" );

	/**
	 * \ingroup Test
	 *
	 * Test case for the FilterBase class
	 */
	class FilterBase_Test extends LifeTypeTestCase
	{
		function setUp()
		{
			// create a username validator
			$this->f = new FilterBase();
		}
		
		function testAddFilter()
		{
			/**
			 * :TODO:
			 * This test should be improved!
			 */
			
			// add two filters to the chain
			$this->f->addFilter( new HtmlFilter());
			$this->f->addFilter( new HtmlFilter());
			// and make sure that they're really there
			$this->assertEquals( 2, count( $this->f->_filters ));
		}
	}
?>