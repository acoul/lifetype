<?php
	
	/**
	 * \defgroup Test
	 *
	 * Unit testing in LifeType is implemented based on PHPUnit and provides a mechanism for users
	 * who write customizations or work with the LifeType core to make sure that their changes
	 * do not break the behaviour of the code being modified.
	 *
	 * Please see http://wiki.lifetype.net/index.php/Unit_Testing_in_LifeType for more information on
	 * how unit testing works with LifeType and how to create your own test cases. If you're only interested
	 * in running the included test cases, please use the runtest.php which you can get from Subversion (it
	 * is not included in final releases as it is only meaningful for developers)
	 */		
	
	lt_include( PLOG_CLASS_PATH."class/misc/glob.class.php" );
	lt_include( PLOG_CLASS_PATH."class/file/file.class.php" );	
	lt_include( PLOG_CLASS_PATH."class/test/PHPUnit.php" );
	
	/**
	 * base folder where all test cases are located
	 */
	define( "TEST_CLASS_FOLDER", PLOG_CLASS_PATH."class/test/tests" );
	
	/**
	 * pattern for test class names
	 */
	define( "TEST_CLASS_NAME_PATTERN", "*_test.class.php" );

	/**
	 * Exclude folders, seperated by comma
	 **/
	define( "EXCLUDE_FOLDERS_LIST", ".svn" );


	/**
	 * \ingroup Test
	 *
	 * This class takes care of running all unit tests in LifeType, as many as there are. This class
	 * process the contents of the class/test/tests/ folder and loads all the classes whose name
	 * ends with "_test.class.php" and uses PHPUnit to process them.
	 *
	 * The correct way to use this class is as follows:
	 *
	 * <pre>	
	 *  $r = new TestRunner();
	 *  $result = $r->run();
     *  print( $result->toHTML());
     * </pre>
     *
	 * In order to add new test cases, please reproduce the class/ structure in the class/test/tests folder
	 * (so that it is easier to tell which class each one of the tests is taking care of) and call your class
	 * ClassThatIsBeingTested_test.class.php. The TestRunner class will load them automatically and execute any
	 * methods whose name starts with "test". Please the PHPUnit documentation for more details on how to
	 * implement test cases.
	 */
	class TestRunner
	{
		var $folder;
		var $pattern;
		var $files;
		var $suite;
		var $excludeFolders;
		var $listener;
		
		/**
		 * Constructor.
		 *
		 * @param folder Where test suites are stored. Defaults to class/test/tests (relative
		 * to PLOG_CLASS_PATH)
		 * @param pattern Pattern that will be used to check whether a file in folder $folder
		 * this this work. The default value is 'false'
		 * is a test suite. Defaults to "*_test.class.php"
		 */
		function TestRunner( $folders = TEST_CLASS_FOLDER, $pattern = TEST_CLASS_NAME_PATTERN )
		{
			if( !is_array( $folders )) 
				$folders = Array( $folders );
				
			$this->folders = $folders;
			$this->pattern = $pattern;
			$this->excludeFolders = explode( ",", EXCLUDE_FOLDERS_LIST );
			
			$this->files = $this->_findClasses( $this->folders, $this->pattern );
			
			$this->listener = NULL;
		}
		
		/** 
		 * Adds a test listener
		 *
		 * @see PHPUnit_TestResult::addListener
		 */
		function addListener( &$listener )
		{
			$this->listener = $listener;
		}
		
		/**
		 * Runs a test suite, or all of them if no test suite name is given
		 *
		 * @param suite The suite name, "all" or empty to run all suites
		 * @return Returns a PHPUnit_TestResult object containing information about which
		 * test suites were run and their results. Please use the HtmlReporter class to obtain
		 * a nicer report.
		 */
		function run( $suite = Array( "all" ))
		{			
			// process all the classes and add them to the test suite
			$this->suite = new PHPUnit_TestSuite();			
			foreach( $this->files as $file ) {
				// build the class name
				$className = str_replace( ".class.php", "", basename( $file ));				
				// load the class file
				//if( $suite == "all" || $suite == $className || $suite == str_replace( "_test", "", $className )) {
				if( in_array( "all", $suite ) || in_array( $className, $suite ) || in_array( str_replace( "_test", "", $className ), $suite )) {
					// add the current suite only if we're either loading them all or if
					// the current one is the one we want to load
					lt_include( $file );
					// and create an instance of it
					$this->suite->addTestSuite( $className );
				}
			}			
			
			// after adding all the tests, run the suite and return the result
	        $result = new PHPUnit_TestResult();	
			if( $this->listener !== NULL ) {			
				$result->addListener( $this->listener );
			}
	        $this->suite->run( $result );

			return( $result );
		}
		
		/**
		 * Returns an associative array with the names of all test suites available. The
		 * name of a test suite consists of its class name minus the "_test" suffix, although
		 * The TestRunner::run() method can take both naming schemes (with and without suffix)
		 *
		 * @return An associative array with the name of all suites
		 */
		function getTestSuites()
		{
			$suites = Array();
			foreach( $this->files as $file ) {
				//$suites[] = str_replace( "_test.class.php", "", basename( $file ));
				
				// load the class file and create a new instance
				lt_include( $file );
				$className = str_replace( ".class.php", "", basename( $file ));
				$instance = new $className();
				
				$suites[] = $instance;				
			}
			
			return( $suites );
		}
		
		/**
		 * @private
		 *
		 * Returns a list of all the files in the given folder that match the given pattern. In this case
		 * it is used to easily find all the test classes. Later on these classes will be loaded, instantiated
		 * and a test suite will be automatically created.
		 */
		function _findClasses( $folders, $pattern = "*" )
		{
			$list = Array();
			
			// load all test cases included in core code
			foreach( $folders as $folder ) {
				$files = Glob::myGlob( $folder , "*" );
				foreach( $files as $file ) {
					// recursive call
					if( File::isDir( $file )) {
						if( array_search( basename( $file ), $this->excludeFolders ) === false )
						{
							$res = $this->_findClasses( Array( $file ), $pattern );
							foreach( $res as $f ) {
								$list[] = $f;
							}
						}
					}
					else {
						if ( File::isReadable( $file )) {						
							if( Glob::fnmatch( $pattern, $file )) {
								// add the file only if it matched our pattern
								$list[] = $file;
							}
						}
					}					
				}
			}
						
			return( $list );
		}
	}
?>