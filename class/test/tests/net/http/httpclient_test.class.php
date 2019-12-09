<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/net/http/httpclient.class.php" );
	lt_include( PLOG_CLASS_PATH."class/config/config.class.php" );	

	/**
	 * \ingroup Test
	 *
	 * Test case for the Snoopy HTTP client library. It could do with a lot more tests
	 * but we're only testing the features that we really need in LT (namely some basic
	 * HTTP fetching stuff)
	 */
	class HttpClient_Test extends LifeTypeTestCase
	{
		var $c;
		
		function setUp()
		{
			$this->c = new HttpClient();
		}
		
		function testFetch()
		{
			// let's fetch our own base URL
			$config =& Config::getConfig();
			$url = $config->getValue( "base_url" )."/index.php";
			
			$result = $this->c->fetch( $url );
			
			// check that it returned true
			$this->assertTrue( $result );
			
			// and that there was content
			$this->assertTrue(( $this->c->results != "" ));
		}
		
		function testWrongUrl()
		{
			$result = $this->c->fetch( "http://www.4523453h42345lhlk.com" );
			
			// check that it returned true
			$this->assertFalse( $result );
			
			// and that there was content
			$this->assertTrue(( $this->c->results == "" ));			
		}
	}
?>