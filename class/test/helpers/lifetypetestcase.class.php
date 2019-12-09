<?php

	lt_include( PLOG_CLASS_PATH."class/test/PHPUnit/TestCase.php");
	lt_include( PLOG_CLASS_PATH."class/test/helpers/uiscriptrunner.class.php");	
	lt_include( PLOG_CLASS_PATH."class/net/http/httpclient.class.php" );
	
	/**
	 * \ingroup Test
	 *
	 * Extends the PHPUnit's TestCase class to provide support for using asserts
	 * with HTTP requests. All test suites in LifeType must extend this class instead of
	 * PHPUnit_TestCase.
	 *
	 * Please see http://wiki.lifetype.net/index.php/Unit_Testing_in_LifeType for more
	 * information on how unit testing has been implemented in LifeType and how to create your
	 * own test cases.
	 */
	class LifeTypeTestCase extends PHPUnit_TestCase
	{		
		/** 
		 * An HTTP client
		 */
		var $c;
		
		/**
		 * makes the given HTTP request and checks that the HTTP response code
		 * matches with the expected once
		 *
		 * @param url
		 * @param expected
		 * @param message
		 */
		function assertHTTPResponseCodeEquals( $url, $expected, $message = '' )
		{
			$c = new HTTPClient();
			$result = $c->fetch( $url );
			
			// check i page loaded correctly
			$this->assertTrue( $result, "Could not fetch $url" );
			
			// get the code from the response and see if the expected one
			// is even there			
			if( !strpos( $c->response_code, $expected )) {
				$message = $message." expected '$expected', actual '".$c->response_code."'";
				$this->fail( $message );
			}
		}
		
		/**
		 * Finds the expected string in the content of the response after fetching the given
		 * url, and raises an error if not there. 
		 *
		 * @param url
		 * @param expected
		 * @param message
		 */
		function assertHTTPResponseContains( $url, $expected, $message = '' )
		{
			// fetch the url
			$c = new HTTPClient();
			$result = $c->fetch( $url );		
			
			$this->assertTrue( $result, "Could not fetch $url" );
			
			// see if the string we're looking for is in the contents of the page
			if( !strstr( $c->results, $expected )) {
				$message = $message." expecting '$expected'";
				return( $this->fail( $message ));
			}
		}
		
		/**
		 * Returns a list with all the available test methods in the class (a test method is 
		 * a method whose name starst with "test")
		 *
		 * @return An array with all the test methods available
		 */
		function getTestMethods()
		{
			$testMethods = Array();
			
			foreach( get_class_methods( $this ) as $method ) {
				if( substr( $method, 0, strlen( "test" )) == "test" ) {
					$testMethods[] = $method;
				}
			}
			
			return( $testMethods );
		}
		
		/**
		 * Returns a string identifying the suite
		 *
		 * @return A string
		 */
		function getSuiteName()
		{
			return( str_replace( "_test", "", get_class( $this )));
		}

		/**
		 * Finds the expected string in the content of the response after fetching the given
		 * url via a POST request
		 *
		 * @param url
		 * @param form An array that will be used as the variables of the form to be POSTed
		 * @param expected
		 * @param message
		 */
		function assertHTTPPostResponseContains( $url, $form, $expected, $message = '' )
		{			
			// fetch the url
			$c = new HTTPClient();
			$result = $c->submit( $url, $form );
			
			$this->assertTrue( $result, "Could not fetch $url" );
			
			// see if the string we're looking for is in the contents of the page
			if( !strstr( $c->results, $expected )) {
				$message = $message." expecting '$expected'";
				return( $this->fail( $message ));
			}
		}

		/**
		 * Returns the admin url
		 */
		function getAdminUrl()
		{
			$config =& Config::getConfig();
			return( $config->getValue( "base_url" )."/admin.php" );
		}
		
		/**
		 * Assert method that executes the given UI script and assert an error if the
		 * script was not successfully executed
		 *
		 * @param script A UI script
		 * @see UIScriptRunner
		 */
		function assertUIScript( $script )
		{	
			// keep this object as static so that its state is carried accross calls to this method
			static $ui;
			if(!isset($ui)) {
				$ui = new UIScriptRunner();
			}
			
			$result = $ui->run( $script );			
						
			if( !$result ) {
				$message = "Error executing step ".$ui->getFailedStep().": ".$ui->getFailedStepErrorMessage();
				return( $this->fail( $message ));
			}
			
			return( true );
		}
	}
?>
