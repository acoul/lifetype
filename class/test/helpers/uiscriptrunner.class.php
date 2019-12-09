<?php

	lt_include( PLOG_CLASS_PATH."class/net/http/httpclient.class.php" );

	/**
	 * \ingroup Test
	 *
	 * This is a helper class that allows to execute scripts (defined as a PHP array with certain values)
	 * to test user interfaces. Scripts are quite simple and are based on the idea of fetching a URL
	 * (or submitting a form) and expecting to find a certain value in the resulting page.
	 *
	 * Scripts are fairly simple with only a small subsets of properties. The following is an
	 * example of a script that logs in, selects a blog and logs out:
	 *
	 * <pre>
	 *	Array(
	 *		"login" => Array(
	 *			"url" => "http://localhost/lt/admin.php",
	 *			"type" => "post",
	 *			"params" => Array(
	 *				"userName" => "user",
	 *				"userPassword" => "password",
	 *				"op" => "Login"
	 *			),
	 *			"expected" => "Dashboard",
	 *			"message" => "The dashboard did not appear when logging in"
	 *		 ),
	 *		"select_blog" => Array(
	 *			"url" => "http://localhost/lt/admin.php",
	 *			"type" => "get",
	 *			"params" => Array(
	 *				"op" => "blogSelect",
	 *				"blogId" => "1"
	 * 			),
	 *			"expected" => "New Post",
	 *			"message" => "The blog could not be selected after the dashboard"
	 *		),
	 *		"logout" => Array(
	 *			"url" => "http://localhost/lt/admin.php",
	 *			"type" => "get",
	 *			"params" => Array( "op" => "Logout" ),
	 *			"expected" => "You have been successfully logged out",
	 *			"message" => "The logout screen was not displayed correctly"
	 *		)
	 *	);
	 * </pre>
	 *
	 * Handling of HTTP requests is handled via the HttpClient class, and cookies are kept 
	 * accross requests.
	 * 
	 * In order to incorporate these in your tests scripts, please use the method
	 * LifeTypeTestCase::assertUIScript()
	 */
	class UIScriptRunner
	{
		var $c;
		var $failedStep;
		var $failedStepErrorMessage;
		var $debug;
		
		function UIScriptRunner()
		{
			$this->c = new HttpClient();
			
			$this->debug = false;
		}
		
		/**
		 * Runs a UI script from an array
		 */
		function run( $script )
		{
			$result = false;
			foreach( $script as $stepName => $step ) {
				$result = $this->_runStep( $step );
				if( !$result ) {
					$this->failedStep = "$stepName";
					$this->failedStepErrorMessage = $step["message"];
					break;
				}
			}
			
			return( $result );
		}
		
		/**
		 * If UIStepRunner::run() returns false, this method will return the name of the
		 * step that failed.
		 *
		 * @return A String
		 */
		function getFailedStep()
		{
			return( $this->failedStep );
		}
		
		/**
		 * If UIStepRunner::run() returns false, this method will return the name of the
		 * step that failed.
		 *
		 * @return A String
		 */		
		function getFailedStepErrorMessage()
		{
			return( $this->failedStepErrorMessage );
		}
		
		/**
		 * @private
		 */
		function _runStep( $step )
		{
			// get the url
			$url = $step["url"];
			
			// build the parameters depending on the type of request
			$type = $step["type"];
			if( $type == "get" ) {
				if( isset( $step["params"] )) {
					$params = $step["params"];
					$query = "";
					foreach( $params as $var => $value ) {
						$query .= $var."=".urlencode( $value )."&";
					}				
					$query = $url."?".$query;
				}
				else {
					$query = $url;
				}
				
				// execute the query
				$result = $this->c->fetch( $query );
			}
			else {
				$result = $this->c->submit( $url, $step["params"] );
			}
			
			// force the HttpClient to store its own cookies so that we can get some sort of
			// stateful navigation
			$this->c->setcookies();			
						
			// if the request was not possible, return error
			if( !$result ) 
				return false;
				
			if( $this->debug ) {
				print($this->c->results);
				print("<hr/>");
			}
				
			// if an HTTP response code was specified, check if it matches
			if( isset( $step["httpcode"] )) {
				if( $this->c->response_code != $step["httpcode"] )					
					return false;
			}
				
			// and if the response did not contain the expected content, return error too
			if( isset( $step["expected"] )) {
				$expected = $step["expected"];
				if( is_array( $expected )) {
					foreach( $expected as $string ) {
						if( !strstr( $this->c->results, $string )) 
							return false;						
					}
				}
				else {
					if( !strstr( $this->c->results, $expected ))
						return false;					
				}
			}

			// additionally, check if there is something that should not be there
			if( isset( $step["notexpected"] )) {
				$expected = $step["notexpected"];
				if( is_array( $expected )) {
					foreach( $expected as $string ) {
						if( strstr( $this->c->results, $string )) 
							return false;						
					}
				}
				else {
					if( strstr( $this->c->results, $expected ))
						return false;					
				}
			}
			
				
			return true;
		}
	}
?>