<?php

	lt_include( PLOG_CLASS_PATH."class/test/PHPUnit/TestResult.php" );
	lt_include( PLOG_CLASS_PATH."class/test/PHPUnit/TestListener.php" );	

	/**
	 * \ingroup Test
	 *
	 * Reporter class that generates output suitable for a terminal console
	 */
	class ConsoleReporter
	{
		var $_result;
		
		function ConsoleReporter( $result )
		{
			$this->_result = $result;
		}
		
		function _getHeader()
		{
			return("\nFailed tests\n------------\n");
		}
		
		function _getFooter()
		{
			return( $this->_getStats());
		}
		
		function _cleanGroupName( $group )
		{
			$group = strtolower( $group );
			$group = str_replace( "_test", "", $group );
			return( $group );
		}
		
		function _getPassed( $test, $group = "" )
		{
			return( "[".$this->_cleanGroupName($group)."] ".$test->getName()." => PASSED\n" );
		}
		
		function _getFailed( $test, $group = "" )
		{
			return( "[".$this->_cleanGroupName($group)."] ".$test->_failedTest->getName()." => FAILED: ".$test->_thrownException."\n" );
		}
		
		function _getStats()
		{
return( "
Test Stats
----------
* Number of tests: ".$this->_result->runCount()."
* Number of tests passed: ".($this->_result->runCount() - $this->_result->failureCount())."
* Number of tests failed: ".$this->_result->failureCount()."\n"
);
		}
		
		function generate()
		{
			$groups = $this->_prepare();
			
	        $result = $this->_getHeader();
	
			foreach( $groups as $group => $tests ) {
				foreach( $tests as $test ) {
					if( isset( $test->_failedTest )) {
						$result .= $this->_getFailed( $test, $group );
					}
					/*else {
						$result .= $this->_getPassed( $test, $group );
					}*/
				}
			}

	        $result .= $this->_getFooter();
			return( $result );
		}
		
		function _prepare()
		{
			$groups = Array();
	        foreach ($this->_result->_passedTests as $passedTest) {
				$groups[get_class($passedTest)][] = $passedTest;
	        }				
	        foreach ($this->_result->_failures as $failedTest) {
				$groups[get_class($failedTest->_failedTest)][] = $failedTest;
	        }
	
			return( $groups );
		}
	}
	
	/**
	 * A listener class to do "live" reporting to the console
	 */
	class ConsoleReporterListener extends PHPUnit_TestListener
	{
		function startTest(&$test) {
			print( "Executing test [".ConsoleReporter::_cleanGroupName(get_class($test))."] ".$test->getName()." ... " );
		}		

		function endTest(&$test) {
			if( !$test->_failed )
				print( "DONE\n" );
		}

		function addFailure(&$test)
		{
			print("FAILED\n");
			$test->_failed = true;
		}
	}
?>