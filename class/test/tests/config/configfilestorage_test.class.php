<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/config/configfilestorage.class.php" );		

	/**
	 * \ingroup Test
	 *
	 * Test cases for the ConfigFileStorage class.
	 *
	 * It includes regression test for svn revisions 3768 and 3799 
	 */
	class ConfigFileStorage_Test extends LifeTypeTestCase
	{
		/**
		 * Creates a temporary test configuration file using both single quotes
		 * and double quotes
		 */
		function setUp()
		{
			lt_include( PLOG_CLASS_PATH."class/config/config.class.php" );
			
			
			$config =& Config::getConfig();
			$tmpFolder = $config->getValue( "temp_folder" );
			
			$this->file1 = str_replace( "\\", "/", PLOG_CLASS_PATH ).$tmpFolder."/file1.properties.php";
			
			// create the first file
            $data1 = '<?php
            #
            # this is one comment
            #
            $config[\'test_key_1\'] = \'\';
            $config[\'test_key_2\'] = \'some value\';
			# 
			# this is
			# another
			# comment
			#
			$config["test_key_3"] = "value for test_key_3";
			#
			# an empty value
			#
			$config[\'test_empty_key\'] = \'\';
            ?>';
          	
            $this->createFile( $this->file1, $data1 );             
		}
		
		/**
		 * delete the temporary file that was created
		 */
		function tearDown()
		{
			lt_include( PLOG_CLASS_PATH."class/file/file.class.php" );			
			File::delete( $this->file1 );	
		}
		
		/**
		 * @private
		 */
		function createFile( $file, $data )
		{
			lt_include( PLOG_CLASS_PATH."class/file/file.class.php" );
            $file = new File( $file );
            $writable = $file->open( 'w' );
            if ($writable) {
                $file->write( $data );
                $file->close();
                return true;
            }
            else {
                return false;
            }
		}
		
		/**
		 * Check if the file was loaded properly and loads a value from a line
		 * with single quotes
		 */
		function testGetSingleQuotesValue()
		{
			// open and load the file
			$cf = new ConfigFileStorage( Array( "file" => $this->file1 ));
			
			$this->assertEquals( "some value", $cf->getValue( "test_key_2" ), 
			                     "Error loading test_key_2 key from file ".$this->file1 );
		}
		
		/**
		 * Check if the file was loaded properly and loads a value from a line
		 * with double quotes
		 */
		function testGetDoubleQuotesValue()
		{
			// open and load the file
			$cf = new ConfigFileStorage( Array( "file" => $this->file1 ));
			
			$this->assertEquals( "value for test_key_3", $cf->getValue( "test_key_3" ), 
			                     "Error loading test_key_3 key from file ".$this->file1 );
		}
		
		/**
		 * test whether new values are kept properly after loading the file
		 */
		function testSetNewValue()
		{
			// open and load the file
			$cf = new ConfigFileStorage( Array( "file" => $this->file1 ));
			
			// add a new key
			$newValue = "This is the value for test_key_new";
			$newKey = "test_key_new";
			$cf->setValue( $newKey, $newValue );
			
			$this->assertEquals( $newValue, $cf->getValue( $newKey ), "Error fetching $newKey" );
		}
		
		/**
		 * test whether new values for keys defined with single quotes are saved properly back to the file
		 */
		function testSaveValue()
		{
			lt_include( PLOG_CLASS_PATH."class/file/file.class.php" );			
			
			// open and load the file
			$cf = new ConfigFileStorage( Array( "file" => $this->file1 ));			
			
			// and save a new one
			$newValue = "This is the value for test_empty_key";
			$newKey = "test_empty_key";
			$cf->setValue( $newKey, $newValue );
			$cf->save();
			
			// reopen and load the file
			$cf2 = new ConfigFileStorage( Array( "file" => $this->file1 ));
			$this->assertEquals( $newValue, $cf2->getValue( $newKey ),
			                     "$newKey was not saved properly to file ".$this->file1 );			                     			                    
		}
		
		/**
		 * test whether new values for keys defined with double quotes are saved properly back to the file
		 */
		function testSaveDoubleQuotesValue()
		{		
			// open and load the file
			$cf = new ConfigFileStorage( Array( "file" => $this->file1 ));			
			
			// and save a new one
			$newValue = "This is the value for test_key_3";
			$newKey = "test_key_3";
			$cf->setValue( $newKey, $newValue );
			$cf->save();
			
			// reopen and load the file
			$cf2 = new ConfigFileStorage( Array( "file" => $this->file1 ));
			$this->assertEquals( $newValue, $cf2->getValue( $newKey ),
			                     "$newKey was not saved properly to file ".$this->file1 );			                     
		}
		
		/**
		 * Saves a value with single quotes, to check whether they're being escaped properly
		 */
		function testSaveValueWithSingleQuotes()
		{
			// open and load the file
			$cf = new ConfigFileStorage( Array( "file" => $this->file1 ));			
			
			// and save a new one
			$newValue = "This 'key' has plenty of 'single' quotes";
			$newKey = "test_key_3";
			$cf->setValue( $newKey, $newValue );
			$cf->save();
			
			// reopen and load the file
			$cf2 = new ConfigFileStorage( Array( "file" => $this->file1 ));
			$this->assertEquals( $newValue, $cf2->getValue( $newKey ),
			                     "$newKey was not saved properly to file ".$this->file1 );			                     
		}
		
		/**
		 * Saves a value with double quotes, to check whether they're being escaped properly
		 */
		function testSaveValueWithDoubleQuotes()
		{
			// open and load the file
			$cf = new ConfigFileStorage( Array( "file" => $this->file1 ));			
			
			// and save a new one
			$newValue = "This \"key\" has plenty of \"single\" quotes";
			$newKey = "test_key_3";
			$cf->setValue( $newKey, $newValue );
			$cf->save();
			
			// reopen and load the file
			$cf2 = new ConfigFileStorage( Array( "file" => $this->file1 ));
			$this->assertEquals( $newValue, $cf2->getValue( $newKey ),
			                     "$newKey was not saved properly to file ".$this->file1 );			                     			
		}
		
		/**
		 * Saves a value with a dollar sign
		 */
		function testSaveValueWithDollarSign()
		{
			// open and load the file
			$cf = new ConfigFileStorage( Array( "file" => $this->file1 ));			
			
			// and save a new one
			$newValue = "This key has a dollar sign $";
			$newKey = "test_key_3";
			$cf->setValue( $newKey, $newValue );
			$cf->save();
			
			// reopen and load the file
			$cf2 = new ConfigFileStorage( Array( "file" => $this->file1 ));
			$this->assertEquals( $newValue, $cf2->getValue( $newKey ),
			                     "$newKey was not saved properly to file ".$this->file1 );			                     			
		}		
		
		/** 
		 * regression test for svn revision 3726. It basically tests whether the ConfigFileStorage::getValue()
		 * method will return the default value specified as the second parameter when the provided
		 * key doesn't exist.
		 */
		function testGetValueWithDefaultValue()
		{
			$cf = new ConfigFileStorage( Array( "file" => $this->file1 ));	
			
			// request a bogus key and see if we get the default value
			$defaultValue = "333";
			$value = $cf->getValue( "this_key_should_really_really_not_exist", $defaultValue );
			
			// check if they're equal (they should!)
			$this->assertEquals( $defaultValue, $value, "getValue() did not return the default value when a non-existant key was requested, please see svn revision 3726" );
		}		
	}
?>