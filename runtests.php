<?php

    define("ENABLE_TESTS", false);

	define( "INCLUDE_PLUGIN_TESTS", true );

    if(ENABLE_TESTS !== TRUE && ENABLE_TESTS != $_SERVER["REMOTE_ADDR"]){
        print "You must change <b>define(\"ENABLE_TESTS\", <font color=\"blue\">false</font>)</b> to<br/>".
            "<b>define(\"ENABLE_TESTS\", <font color=\"red\">\"".$_SERVER["REMOTE_ADDR"]."\"</font>)</b> (lock down to your IP address) OR<br/>".
            "<b>define(\"ENABLE_TESTS\", <font color=\"red\">true</font>)</b><br/>".
            " at the top of runtests.php to enable the test runner, since it could represent a security risk.";
        die;
    }

	if (!defined( "PLOG_CLASS_PATH" )) {
	   define( "PLOG_CLASS_PATH", dirname(__FILE__)."/");
	}

	include_once( PLOG_CLASS_PATH."class/bootstrap.php" );
	lt_include( PLOG_CLASS_PATH."class/test/testrunner.class.php" );
	lt_include( PLOG_CLASS_PATH."class/test/helpers/htmlreporter.class.php" );	
	lt_include( PLOG_CLASS_PATH."class/test/helpers/consolereporter.class.php" );	
	lt_include( PLOG_CLASS_PATH."class/net/http/httpvars.class.php" );

	// if plugins should also be included when testing, let's load them now
	$folders = Array( TEST_CLASS_FOLDER ); 
	if( INCLUDE_PLUGIN_TESTS ) {
		lt_include( PLOG_CLASS_PATH."class/plugin/pluginmanager.class.php" );
	
		$pm =& PluginManager::getPluginManager();
		$plugins = $pm->getPluginListFromFolder();
	
		foreach( $plugins as $plugin ) {
			$folders[] = PLOG_CLASS_PATH."plugins/".$plugin."/class/tests";
		}
	}
	
	// create a new TestRunner class, which will take care of loading all our
	// tests cases, instantiate them and tell PHPUnit to run the tests specified
	// in the request
	$r = new TestRunner( $folders );	

	// check if we're running from the command line
	$commandLine = isset( $argv );

	if( $commandLine ) {
		if( count( $argv ) < 2 ) {
			// if running from command line and we have no parameters, show the list of available suites			
			print("\nPlease specify the name of a test suite to run, or 'all' to run all tests in one batch\n\n" );
			foreach( $r->getTestSuites() as $suite ) {
				print( "* [".$suite->getSuiteName()."]: " );
				foreach( $suite->getTestMethods() as $method ) {
					print( $method.", ");
				}
				print( "\n" );
			}
		}
		else {
			// run the given suite
			$r->addListener( new ConsoleReporterListener );
			$result = $r->run( $argv );

			// check the results when ready
			$reporter = new ConsoleReporter( $result );
			print($reporter->generate());			
		}	
	}
	else {
?>
<html>
	<head>
		<title>LifeType Test Suite</title>
	</head>
	<body>
<?php

	// get the suite name from the request or run all of them if no parameter specified
	$request = HttpVars::getRequest();
	$suiteName = isset( $request["suite"] ) ? strtolower($request["suite"]) : "";
	
	if( $suiteName == "" ) {
		// no suite name was specified, let's just show what we have
		$suites = $r->getTestSuites();
?>
<h1>Available Test Suites</h1>
<p>Plese select a test suite to run or click "All" to run all the test suites together.</p>
<table border="1">
	<thead>
		<th>Suite</th>
		<th>Run</th>
		<th>Available methods</th>
	</thead>
	<?php foreach( $suites as $suite ) { ?>
	<tr>
		<td><?php print( $suite->getSuiteName()) ?></td>
		<td><a href="?suite=<?php print( $suite->getSuiteName()) ?>">Run</a></td>
		<td><?php foreach( $suite->getTestMethods() as $method ) { print( $method.", " ); } ?></td>
	</tr>
	<?php } ?>
	<tr>
		<td>ALL</td>
		<td><a href="?suite=all">Run</a></td>
		<td>&nbsp;</td>
	</tr>
</table>
<?php
	}
	else {
		$result = $r->run( Array( $suiteName ));
	
		// check the results when ready
		$reporter = new HTMLReporter( $result );
		print($reporter->generate());
	}
?>
</body>
</html>
<?php } ?>
