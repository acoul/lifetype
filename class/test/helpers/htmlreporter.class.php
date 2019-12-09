<?php

	lt_include( PLOG_CLASS_PATH."class/test/PHPUnit/TestResult.php" );

	/**
	 * \ingroup Test
	 *
	 * A nicer test reporter that generates readable HTML output out of the results
	 * of running a test suite, see runtests.php and the TestRunner class for more
	 * information.
	 */
	class HTMLReporter
	{
		var $_result;
		
		function HTMLReporter( $result )
		{
			$this->_result = $result;
		}
		
		function _getHeader()
		{
			return('
			        <h1>Test Report</h1>
			        <table cols="4" border="1" width="100%">
			        <thead style="text-align:left">
			         <th width="20%">Group</th>
			         <th width="20%">Test</th>
			         <th width="10%">Status</th>
			         <th width="50%">Message</th>
			        </thead>
			        <tbody>
			      ');
		}
		
		function _getFooter()
		{
			return( '</tbody>
			         </table>
					<a href="javascript:history.go(0)">Run Again</a>&nbsp;
					<a href="?suite=">Back to List</a>
			        '.$this->_getStats().'
			      ');
		}
		
		function _cleanGroupName( $group )
		{
			$group = strtolower( $group );
			$group = str_replace( "_test", "", $group );
			return( $group );
		}
		
		function _getPassed( $test, $group = "" )
		{
			return( '<tr>
			          <td><b>'.$this->_cleanGroupName($group).'</b></td>			
			          <td>'.$test->getName().'</td>
			          <td style="background-color:green">PASSED</td>
			          <td></td>
			         ');
		}
		
		function _getFailed( $test, $group = "" )
		{
			return( '<tr>
			          <td><b>'.$this->_cleanGroupName($group).'</b></td>
			          <td>'.$test->_failedTest->getName().'</td>
			          <td style="background-color:red">FAILED</td>
			          <td>'.$test->_thrownException.'</td>
			         ');			
		}
		
		function _getStats()
		{
			return( '<h1>Test Stats</h1>
			         <b>Number of tests: </b>'.$this->_result->runCount().'<br/>
			         <b>Number of tests passed: </b>'.($this->_result->runCount() - $this->_result->failureCount()).'<br/>
			         <b>Number of tests failed: </b>'.$this->_result->failureCount().'<br/>
			       ');
		}
		
		function generate()
		{
			$groups = $this->_prepare();
			
	        $result = $this->_getHeader();
	
			foreach( $groups as $group => $tests ) {
				$i=0;
				foreach( $tests as $test ) {
					$i++;
					$i == 1 ? $groupName = $group : $groupName = "";
					if( isset( $test->_failedTest )) {
						$result .= $this->_getFailed( $test, $groupName );
					}
					else {
						$result .= $this->_getPassed( $test, $groupName );
					}
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
?>