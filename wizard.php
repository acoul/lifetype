<?php

    if (!defined( "PLOG_CLASS_PATH" )) {
        define( "PLOG_CLASS_PATH", dirname(__FILE__)."/");
    }

    set_time_limit (5 * 3600);

    //
    // enable this for debugging purposes
    //
    define( "DB_WIZARD_DEBUG", false );

    //
    // in case you're having problems with time outs while upgrading (probably too
    // many records) lower this figure
    //
    define( "WIZARD_MAX_RECORDS_PER_STEP", 75 );
    
    //
    // minimum php version required
    //
    define( "MIN_PHP_VERSION", "4.2.0" );
    
    //
    // whether data transformers should fail on error by default
    // It might be convenient to set this to 'false' if we're running
    // the wizard on top of an already updated installation
    //
    define( "DATABASE_DATA_TRANSFORMER_FAIL_ON_ERROR_DEFAULT", true );

    // many hosts don't have this enabled and we, for the time being, need it...
    ini_set("arg_seperator.output", "&amp;");

    include_once( PLOG_CLASS_PATH."class/bootstrap.php" );
    lt_include( PLOG_CLASS_PATH."class/controller/controller.class.php" );
    lt_include( PLOG_CLASS_PATH."class/template/templateservice.class.php" );
    lt_include( PLOG_CLASS_PATH."class/action/action.class.php" );
    lt_include( PLOG_CLASS_PATH."class/database/db.class.php" );
    lt_include( PLOG_CLASS_PATH."class/template/template.class.php" );
    lt_include( PLOG_CLASS_PATH."class/view/view.class.php" );
    lt_include( PLOG_CLASS_PATH."class/data/validator/usernamevalidator.class.php" );
    lt_include( PLOG_CLASS_PATH."class/data/validator/stringvalidator.class.php" );
    lt_include( PLOG_CLASS_PATH."class/data/validator/integervalidator.class.php" );
    lt_include( PLOG_CLASS_PATH."class/data/validator/emailvalidator.class.php" );
    lt_include( PLOG_CLASS_PATH."class/data/validator/passwordvalidator.class.php" );
    lt_include( PLOG_CLASS_PATH."class/data/timestamp.class.php" );    
    lt_include( PLOG_CLASS_PATH."class/net/http/httpvars.class.php" );
    lt_include( PLOG_CLASS_PATH."class/misc/version.class.php" );
    lt_include( PLOG_CLASS_PATH."class/file/file.class.php" );
    lt_include( PLOG_CLASS_PATH."class/file/finder/filefinder.class.php" );
    lt_include( PLOG_CLASS_PATH."class/gallery/resizers/gddetector.class.php" );
    lt_include( PLOG_CLASS_PATH."class/config/configfilestorage.class.php" );
    lt_include( PLOG_CLASS_PATH."class/data/textfilter.class.php" );
    lt_include( PLOG_CLASS_PATH."class/locale/ltlocales.class.php" );
    lt_include( PLOG_CLASS_PATH."class/locale/ltlocalefinder.class.php" );
    lt_include( PLOG_CLASS_PATH."class/template/templatesets/templatesets.class.php" );
    lt_include( PLOG_CLASS_PATH."class/dao/bloginfo.class.php" );
    lt_include( PLOG_CLASS_PATH."class/dao/users.class.php" );
    lt_include( PLOG_CLASS_PATH."class/dao/blogs.class.php" );
    lt_include( PLOG_CLASS_PATH."class/dao/articlecategories.class.php" );
    lt_include( PLOG_CLASS_PATH."class/dao/articles.class.php" );
    lt_include( PLOG_CLASS_PATH."class/dao/mylinkscategories.class.php" );
    lt_include( PLOG_CLASS_PATH."class/dao/userpermissions.class.php" );
    lt_include( PLOG_CLASS_PATH."class/dao/blogcategories.class.php" );
    lt_include( PLOG_CLASS_PATH."class/dao/globalarticlecategories.class.php" );
    lt_include( PLOG_CLASS_PATH."class/gallery/dao/galleryalbums.class.php" );     
	lt_include( PLOG_CLASS_PATH."class/dao/permissions.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/userpermissions.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/permission.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/userpermission.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/userinfo.class.php" );
	lt_include( PLOG_CLASS_PATH."class/misc/integritychecker.class.php" );
    
    // table schemas
    include( PLOG_CLASS_PATH."install/dbschemas.properties.php" );
    // default configuration values for 1.1
    include( PLOG_CLASS_PATH."install/defaultconfig.properties.php" );

    define( "TEMP_FOLDER", "./tmp" );

    // maps used to map requests with actions
    $_actionMap["Checks"] = "WizardChecks";
    $_actionMap["Default"] = "WizardChecks";
    $_actionMap["Intro"] = "WizardIntro";
    $_actionMap["Step1"] = "WizardStepOne";
    $_actionMap["Step2"] = "WizardStepTwo";
    $_actionMap["Step3"] = "WizardStepThree";
    $_actionMap["Step4"] = "WizardStepFour";
    $_actionMap["Step5"] = "WizardStepFive";
    $_actionMap["Update1"] = "UpdateStepOne";
    $_actionMap["Update2"] = "UpdateStepTwo";
    $_actionMap["Update3"] = "UpdateStepThree";
    $_actionMap["Fix120"] = "Fix120StepOne";


    /**
     * Open a connection to the database
     */
     function connectDb( $ignoreError = false , $selectDatabase = true )
     {
        $config = new ConfigFileStorage();
        // open a connection to the database
        //$db = NewADOConnection('mysql');
        $db = PDb::getDriver('mysql');
        
        if ( $selectDatabase ) {
            $res = $db->Connect($config->getValue( "db_host" ), $config->getValue( "db_username" ), $config->getValue( "db_password" ), $config->getValue( "db_database" ), $config->getValue( "db_character_set" ));
        } else {
            $res = $db->Connect($config->getValue( "db_host" ), $config->getValue( "db_username" ), $config->getValue( "db_password" ), null, $config->getValue( "db_character_set" ));
        }

        if( DB_WIZARD_DEBUG )
            $db->debug = true;

        // return error
        if( $ignoreError )
            return $db;

        if( !$res )
            return false;

        return $db;
    }

    /**
     * Returns the database prefix
     */
    function getDbPrefix()
    {
        $config = new ConfigFileStorage();
        return $config->getValue( "db_prefix" );
    }

    /**
     * some useful little functions
     */
    class WizardTools
    {
       /**
        * returns true if plog has already been installed before or
        * false otherwise
        */
       function isNewInstallation()
       {
           $configFile = new ConfigFileStorage();
           // if plog hasn't been installed, this file will have empty settings
           if( $configFile->getValue( "db_host") == "" && $configFile->getValue( "db_username") == "" &&
               $configFile->getValue( "db_database") == "" && $configFile->getValue( "db_prefix" ) == "" &&
               $configFile->getValue( "db_password" ) == "" )
               $isNew = true;
           else
               $isNew = false;

           return( $isNew );
       }

		/**
		 * Clean up the default temporary folder
		 */
		function cleanTmpFolder()
		{
			// remove the files recursively, but only files, do not do anything to directories
			File::deleteDir( TEMP_FOLDER, true, true, array(".svn", ".htaccess") );
		}
    }

    /**
     * Renders a template file.
     */
    class WizardView extends View
    {

        var $_templateName;

        function WizardView( $templateName )
        {
            $this->View();
            $this->_templateName = $templateName;
        }

        function render()
        {
            // build the file name
            $templateFileName = "wizard/".$this->_templateName.".template";

            //$t = new Template( $templateFileName, "" );
            $t = new Smarty();
            $v = new Version();
            $this->_params->setValue( "version", $v->getVersion());
            $this->_params->setValue( "projectPage", $v->getProjectPage());
            $this->_params->setValue( "safeMode", ini_get("safe_mode"));
            $t->assign( $this->_params->getAsArray());
            $t->template_dir    = "./templates";
            $t->compile_dir     = TEMP_FOLDER;
            $t->cache_dir       = TEMP_FOLDER;
            $t->use_sub_dirs    = false;
            $t->caching = false;

            print $t->fetch( $templateFileName );
        }
    }
    
    class WizardAction extends Action
    {
        function WizardAction( $actionInfo, $request )
        {
            $this->Action( $actionInfo, $request );
        }
    }    
    
    class WizardValidator
    {
        var $_desc;
        var $_critical;
        var $_valid;
        var $_solution;
    
        function WizardValidator( $desc = "", $solution = "", $critical = true )
        {            
            $this->_desc = $desc;
            $this->_critical = $critical;
            $this->_valid = false;
            $this->_solution = $solution;
        }
        
        function isCritical()
        {
            return( $this->_critical );
        }
        
        function getDesc()
        {
            return( $this->_desc );
        }
        
        function isValid()
        {
            return( $this->_valid );
        }
        
        function getSolution()
        {
            return( $this->_solution );
        }
        
        function validate() 
        {
            return( $this->_valid );
        }        
    }
    
    class WizardPhpVersionValidator extends WizardValidator
    {
        function WizardPhpVersionValidator( $minVersion = MIN_PHP_VERSION )
        {
            $this->WizardValidator( "Checking if the installed <b>PHP</b> version is at least $minVersion", 
                                    "Please upgrade your version of PHP to $minVersion or newer",
                                    true );
            $this->_minVersion = $minVersion;
        }
    
        function validate()
        {
            $this->_valid = version_compare( phpversion(), $this->_minVersion ) >= 0;
            return( parent::validate());
        }
    }
    
    class WizardWritableFileValidator extends WizardValidator
    {
        var $_file;
        
        function WizardWritableFileValidator( $file )
        {
            $this->WizardValidator( "Checking if file/folder <b>$file</b> is writable", 
                                    "Please make sure that the file is writable by the web server",
                                    true );
            $this->_file = $file;
        }
    
        function validate()
        {
            $this->_valid = File::isWritable( $this->_file );
            return( parent::validate());
        }
    }
    
    class WizardSessionFunctionsAvailableValidator extends WizardValidator
    {
        function WizardSessionFunctionsAvailableValidator()
        {
            $this->WizardValidator( "Checking if <b>session</b> functions are available", 
                                    "LifeType requires support for sessions to be part of your PHP installation",
                                    true );
        }
    
        function validate()
        {
            $this->_valid = function_exists( "session_start" ) &&
                            function_exists( "session_destroy" ) &&
                            function_exists( "session_cache_limiter" ) &&
                            function_exists( "session_name" ) &&
                            function_exists( "session_set_cookie_params" ) &&
                            function_exists( "session_save_path" );
            return( parent::validate());            
        }
    }

    class WizardSessionSettingsValidator extends WizardValidator
    {
        function WizardSessionSettingsValidator()
        {
            $this->WizardValidator( "Checking if <b>session.auto_start</b> is disabled", 
                                    "LifeType can only run when session.auto_start is disabled.",           
                                    true );
        }    
    
        function validate()
        {
            $this->_valid = (ini_get( "session.auto_start" ) == "0");
            return( parent::validate());    
        }
    }
       
    class WizardMySQLFunctionsAvailableValidator extends WizardValidator
    {
        function WizardMySQLFunctionsAvailableValidator()
        {
            $this->WizardValidator( "Checking if <b>MySQL</b> functions are available", 
                                    "LifeType requires support for MySQL to be part of your PHP installation",
                                    true );
        }
    
        function validate()
        {
            $this->_valid = function_exists( "mysql_select_db" ) &&
                            function_exists( "mysql_query" ) &&
                            function_exists( "mysql_connect" ) &&
                            function_exists( "mysql_fetch_assoc" ) &&
                            function_exists( "mysql_num_rows" ) &&
                            function_exists( "mysql_free_result" );
            return( parent::validate());                            
        }        
    }
    
    class WizardXmlFunctionsAvailableValidator extends WizardValidator
    {
        function WizardXmlFunctionsAvailableValidator()
        {
            $this->WizardValidator( "Checking if <b>XML</b> functions are available", 
                                    "LifeType requires support for XML to be part of your PHP installation",
                                    true );
        }    
    
        function validate()
        {
            $this->_valid = function_exists( "xml_set_object" ) &&
                            function_exists( "xml_set_element_handler" ) &&
                            function_exists( "xml_parser_create" ) &&
                            function_exists( "xml_parser_set_option" ) &&
                            function_exists( "xml_parse" ) &&
                            function_exists( "xml_parser_free" );
            return( parent::validate());                            
        }        
    }

    class WizardTokenizerFunctionsAvailableValidator extends WizardValidator
    {
        function WizardTokenizerFunctionsAvailableValidator()
        {
            $this->WizardValidator( "Checking if <b>Tokenizer</b> functions are available", 
                                    "LifeType requires support for the Tokenizer to be part of your PHP installation",
                                    true );
        }    
    
        function validate()
        {
            $this->_valid = function_exists( "token_get_all" );
            return( parent::validate());                            
        }        
    }
    
    class WizardSafeModeValidator extends WizardValidator
    {
        function WizardSafeModeValidator()
        {
            $this->WizardValidator( "Checking if <b>safe mode</b> is disabled", 
                                    "LifeType can run when PHP's safe mode is enabled, but it may cause some problems.",           
                                    false );
        }    
    
        function validate()
        {
            $this->_valid = (ini_get( "safe_mode" ) == "");
            return( parent::validate());    
        }
    }

    class WizardIconvFunctionsAvailableValidator extends WizardValidator
    {
        function WizardIconvFunctionsAvailableValidator()
        {
            $this->WizardValidator( "Checking if <b>iconv</b> functions are available", 
                                    "LifeType requires support for some resource metadata conversion and some LifeType plugins requires support for multi-byte language encoding/decoding.",
                                    false );
        }
    
        function validate()
        {
            $this->_valid = function_exists( "iconv" );
            return( parent::validate());                            
        }        
    }

    class WizardMbstringFunctionsAvailableValidator extends WizardValidator
    {
        function WizardMbstringFunctionsAvailableValidator()
        {
            $this->WizardValidator( "Checking if <b>mbstring</b> functions are available", 
                                    "Some LifeType plugins requires support for multi-byte language encoding/decoding.",
                                    false );
        }
    
        function validate()
        {
            $this->_valid = function_exists( "mb_convert_encoding" );
            return( parent::validate());                            
        }        
    }

    class WizardGdFunctionsAvailableValidator extends WizardValidator
    {
        function WizardGdFunctionsAvailableValidator()
        {
            $this->WizardValidator( "Checking if <b>gd</b> or <b>gd2</b> functions are available", 
                                    "LifeType requires support for generating image thumbnail.",
                                    false );
        }
    
        function validate()
        {
            $this->_valid = function_exists( "imagecopyresampled" ) &&
            				function_exists( "imagecopyresized" );
            return( parent::validate());                            
        }        
    }
    
    class WizardFileUploadsValidator extends WizardValidator
    {
        function WizardFileUploadsValidator()
        {
            $this->WizardValidator( "Checking if <b>file_uploads</b> is enabled", 
                                    "LifeType requires support for uploading resources.",
                                    true );
        }    
    
        function validate()
        {
            $this->_valid = (ini_get( "file_uploads" ) == 1);
            return( parent::validate());    
        }
    }

    class WizardFileIntegrityValidator extends WizardValidator
    {
        function WizardFileIntegrityValidator()
        {
            $this->WizardValidator( "Checking that all files have been correctly uploaded", 
                                    "will be set later on...",
                                    false );
        }    
    
        function validate()
        {
			include( PLOG_CLASS_PATH."install/files.properties.php");
			
			$result = IntegrityChecker::checkIntegrity( 
				$data
			);	
	
		
            $this->_valid = ( count( $result ) == 0 );
			if( !$this->_valid ) {
				/* let's modify a private attribute... */
				$fileList = implode( "<br/>", array_keys( $result ));
				$this->_solution = "The current version of the following is not the expected one. Installation can proceed but please make sure that all files were uploaded correctly:"."<br/>".$fileList;				
			}

            return( parent::validate());
        }
    }
    
    class WizardCtypeFunctionsAvailableValidator extends WizardValidator
    {
        function WizardCtypeFunctionsAvailableValidator()
        {
            $this->WizardValidator( "Checking if <b>ctype</b> functions are available", 
                                    "Some LifeType plugins requires support for variable type validation.",
                                    false );
        }
    
        function validate()
        {
            $this->_valid = function_exists( "ctype_digit" );
            return( parent::validate());                            
        }        
    }               
    
    class WizardChecks extends WizardAction
    {        
        function perform()
        {
            // build the array with checks
            $checkGroups['File checks'] = Array(
               "writeConfigFile" => new WizardWritableFileValidator( "config/config.properties.php" ),
               "writeTmpFolder" => new WizardWritableFileValidator( "tmp" ),
               "writeGalleryFolder" => new WizardWritableFileValidator( "gallery" ),
			   "fileVersionCheck" => new WizardFileIntegrityValidator()
            );
            
            $checkGroups['PHP version checking'] = Array(
               "php" => new WizardPhpVersionValidator()
            );

            $checkGroups['PHP configuration checking'] = Array(
               "sessionSettings" => new WizardSessionSettingsValidator(),
               "safemode" => new WizardSafeModeValidator(),
               "fileUploads" => new WizardFileUploadsValidator()
            );
            
            $checkGroups['PHP functions availability checking'] = Array(
               "sessions" => new WizardSessionFunctionsAvailableValidator(),
               "mysql" => new WizardMySQLFunctionsAvailableValidator(),
               "xml" => new WizardXmlFunctionsAvailableValidator(),
               "tokenizer" => new WizardTokenizerFunctionsAvailableValidator(),
               "iconv" => new WizardIconvFunctionsAvailableValidator(),
               "mbstring" => new WizardMbstringFunctionsAvailableValidator(),
               "gd" => new WizardGdFunctionsAvailableValidator(),
               "ctype" => new WizardCtypeFunctionsAvailableValidator()
            );                                    
            
            // run the checks
            $ok = true;
            foreach( $checkGroups as $checkGroup => $checks ) {
	            foreach( $checks as $id => $check ) {
	                $valid = $checkGroups[$checkGroup][$id]->validate();
	                // if it doesn't validate but it's not critical, then we can proced too
	                if( !$checkGroups[$checkGroup][$id]->isCritical())
	                    $valid = true;  
	                $ok = ($ok && $valid);
	            }
	        }
            
            // create the view and pass the results
            $this->_view = new WizardView( "checks" );
            $this->_view->setValue( "ok", $ok );
            $this->_view->setValue( "checkGroups", $checkGroups );
            
            if( WizardTools::isNewInstallation())
                $this->_view->setValue( "mode", "install" );
            else
                $this->_view->setValue( "mode", "update" );

            return true;
        }
    }
    
    class WizardPagedAction extends WizardAction
    {
        var $willRefresh;
    
        function WizardPagedAction( $actionInfo, $request ) 
        {
            $this->WizardAction( $actionInfo, $request );
            
            $this->willRefresh = false;
        }
        
        /**
         * @private
         */
        function getPageFromRequest()
        {
            lt_include( PLOG_CLASS_PATH."class/data/validator/integervalidator.class.php");    	
			// get the value from the request
			$page = HttpVars::getRequestValue( "page" );
			// but first of all, validate it
			$val = new IntegerValidator();
			if( !$val->validate( $page ))
				$page = 1;			
							
			return $page;        
        }
        
        /**
         * @private
         */
        function willRefresh()
        {
            return( $this->willRefresh );
        }
    }

    /**
     * Gets the information about the database from the user.
     */
    class WizardIntro extends WizardAction
    {
        function WizardIntro( $actionInfo, $request )
        {
            $this->WizardAction( $actionInfo, $request );
        }

        function perform()
        {
            WizardTools::cleanTmpFolder();
            
                // we can detect whether plog is already installed or not and direct users to the right
            // place
            if( WizardTools::isNewInstallation())
                $this->_view = new WizardView( "intro" );
            else {
                Controller::setForwardAction( "Update1" );
                return false;
            }

            $this->setCommonData();
            return true;
        }
    }

    /**
     *
     * Saves data to the configuration file
     *
     */
    class WizardStepOne extends WizardAction
    {

        var $_dbServer;
        var $_dbUser;
        var $_dbPassword;
        var $_dbName;
        var $_dbPrefix;
        var $_connection;

        function WizardStepOne( $actionInfo, $request )
        {
            $this->WizardAction( $actionInfo, $request );

            // data validation
            $this->registerFieldValidator( "dbServer", new StringValidator());
            $this->registerFieldValidator( "dbUser", new StringValidator());
            $this->registerFieldValidator( "dbPassword",  new StringValidator(), true );
            $this->registerFieldValidator( "dbName", new StringValidator());
            $this->registerFieldValidator( "dbPrefix", new StringValidator(), true );
            $errorView = new WizardView( "intro" );
            $errorView->setErrorMessage( "Some data was incorrect or missing." );
            $this->setValidationErrorView( $errorView );
        }

        function perform()
        {
            // fetch the data needed from the request
            $this->_dbServer   = $this->_request->getValue( "dbServer" );
            $this->_dbUser     = $this->_request->getValue( "dbUser" );
            $this->_dbPassword = $this->_request->getValue( "dbPassword" );
            $this->_dbName     = $this->_request->getValue( "dbName" );
            $this->_skipThis   = $this->_request->getValue( "skipDbInfo" );
            $this->_dbPrefix   = $this->_request->getValue( "dbPrefix", DEFAULT_DB_PREFIX );

            // we should now save the data to the configuration file, just before
            // we read it
            $configFile = new ConfigFileStorage();

            // we expect everything to be fine
            $errors = false;

            // before doing anything, we should check of the configuration file is
            // writable by this script, or else, throw an error and bail out gracefully
            $configFileName = $configFile->getConfigFileName();
            if( !File::exists( $configFileName )) {
                if (! File::touch( $configFileName ) ) {
                    $this->_view = new WizardView( "intro" );
                    $message = "Could not create the LifeType configuration file $configFileName. Please make sure
                                that the file can be created by the user running the webserver. It is needed to
                                store the database configuration settings.";
                    $this->_view->setErrorMessage( $message );
                    $this->setCommonData( true );
                    return false;
                } else {
                    ConfigFileStorage::createConfigFile( $configFileName );
                }
            }
            if( File::exists( $configFileName ) && !File::isWritable( $configFileName )) {
                $this->_view = new WizardView( "intro" );
                $message = "Please make sure that the file $configFileName can be written by this script during
                            the installation process. It is needed to store the database configuration settings. Once the
                            installation is complete, please revert the permissions to no writing possible.";
                $this->_view->setErrorMessage( $message );
                $this->setCommonData( true );
                return false;
            }

            // continue if everything went fine
            if( !$configFile->saveValue( "db_username", $this->_dbUser ) ||
                !$configFile->saveValue( "db_password", $this->_dbPassword ) ||
                !$configFile->saveValue( "db_host", $this->_dbServer ) ||
                !$configFile->saveValue( "db_database", $this->_dbName ) ||
                !$configFile->saveValue( "db_prefix", $this->_dbPrefix )) {
                $errors = true;
            }

            if( $errors ) {
                $message = "Could not save values to the configuration file. Please make sure it is available and
                            that has write permissions for the user under your web server is running.";
                $this->_view = new WizardView( "intro" );
                $this->_view->setErrorMessage( $message );

                return( false );
            }
            else {
                $connectionEsablished = false;

                $this->_connection = @mysql_connect( $this->_dbServer, $this->_dbUser, $this->_dbPassword );
                if( $this->_connection ) {
                    $connectionEsablished = true;
                } else {
                    $connectionEsablished = false;
                    $message = "There was an error connecting to the database. Please check your settings.";
                }

                if ( !$connectionEsablished ) {
                    $this->_view = new WizardView( "step1" );
                    $this->_view->setErrorMessage( $message );
                    $this->setCommonData( true );
                    return false;
                } else {
                	$this->_view = new WizardView( "step1" );
	                $availableCharacterSets = $this->getAvailableCharacterSets();
	                $defaultCharacterSet = $this->getDatabaseCharacterSet();
	                $createDatabase = false;
	                if( empty( $defaultCharacterSet ) )
	                {
	                	$defaultCharacterSet = $this->getServerCharacterSet();
	                	$createDatabase = true;
	                }
	                $this->_view->setValue( "availableCharacterSets", $availableCharacterSets );
	                $this->_view->setValue( "defaultCharacterSet", $defaultCharacterSet );
	                $this->_view->setValue( "createDatabase", $createDatabase );
	                // now we better read the information from the config file to make sure that
	                // it has been correctly saved
	                $this->setCommonData( true );
	                return true;
	            }
            }
        }

	    function getAvailableCharacterSets()
	    {
	        // check mysql version first. Version lower than 4.1 doesn't support utf8
	        $serverVersion = mysql_get_server_info( $this->_connection );
	        $version = explode( '.', $serverVersion );
	        if ( $version[0] < 4 ) return false;
	        if ( ( $version[0] == 4 ) && ( $version[1] == 0 ) ) return false;
	        
	        // check if utf8 support was compiled in
	        $result = mysql_query( "SHOW CHARACTER SET", $this->_connection );
	        if( $result )
	        {
		        if( mysql_num_rows($result) > 0 ) {
		            // iterate through resultset
		            $availableCharacterSets = array();
		            while( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) )
		            {
						array_push( $availableCharacterSets, $row['Charset'] );
		            }
		            return $availableCharacterSets;
		        }
		    }
	        return false;
	    }
	    
	    function getDatabaseCharacterSet()
	    {
			if( !@mysql_select_db( $this->_dbName, $this->_connection ) ) {
				return false;
			}
	        
	        // We use a SHOW CREATE DATABASE command to show the original
	        // SQL character set when DB was created.
	        $result = mysql_query( "SHOW CREATE DATABASE `".$this->_dbName."`", $this->_connection );
	        if( $result )
	        {
		        if( mysql_num_rows( $result ) < 0 ) {
		            // The specified db name is wrong!
		            return false;
		        }
		        $dbInfo = mysql_fetch_row( $result );
		        $pattern = '/40100 DEFAULT CHARACTER SET (\w+) /';
		        if( ( preg_match( $pattern, $dbInfo[1], $match ) > 0 ) ) {
		            return $match[1];
		        }
		    }
	        return false;
	    }
	
	    function getServerCharacterSet(){
	        // We use a SHOW CREATE DATABASE command to show the original
	        // SQL character set when DB was created.
	        $result = mysql_query( "SHOW VARIABLES LIKE 'character_set_server'", $this->_connection );
	        if( $result )
	        {
		        if( mysql_num_rows( $result ) > 0 ) {
		            $row = mysql_fetch_array( $result, MYSQL_ASSOC );
		            return $row['Value'];
		        }
			}
	        return false;
	    }
    }

    /**
     *
     * Second step where we connect to the database and create the tables.
     *
     */
    class WizardStepTwo extends WizardAction
    {

        var $_db;
        var $_database;
        var $_dbCharacterSet;
        var $_createDatabase;

        function setDbConfigValues( &$view )
        {
            $configFile = new ConfigFileStorage();
            $configFile->reload();
            $view->setValue( "dbUser", $configFile->getValue( "db_username" ));
            $view->setValue( "dbPassword", $configFile->getValue( "db_password" ));
            $view->setValue( "dbServer", $configFile->getValue( "db_host" ));
            $view->setValue( "dbName", $configFile->getValue( "db_database" ));
            $view->setValue( "dbPrefix", $configFile->getValue( "db_prefix" ));
            $view->setValue( "dbCharacterSet", $configFile->getValue( "db_character_set" ));
            return true;
        }

        function perform()
        {
            global $Tables;
            global $Inserts;

			$this->_dbCharacterSet = $this->_request->getValue( "dbCharacterSet" );
            $configFile = new ConfigFileStorage();
			$configFileName = $configFile->getConfigFileName();
            
            if( File::exists( $configFileName ) && !File::isWritable( $configFileName )) {
                $this->_view = new WizardView( "step1" );
                $message = "Please make sure that the file $configFileName can be written by this script during
                            the installation process. It is needed to store the database configuration settings. Once the
                            installation is complete, please revert the permissions to no writing possible.";
                $this->_view->setErrorMessage( $message );
                $this->setCommonData( true );
                return false;
            }

            // continue if everything went fine
            if( !$configFile->saveValue( "db_character_set", $this->_dbCharacterSet ) ) {
                $message = "Could not save values to the configuration file. Please make sure it is available and
                            that has write permissions for the user under your web server is running.";
                $this->_view = new WizardView( "step1" );
                $this->_view->setErrorMessage( $message );

                return false;
            }
            
            $createDb = $this->_request->getValue( "createDatabase" );
            $message = '';

            // only check for errors in case the database table should already exist!
            if( !$createDb ) {
                $connectionEsablished = false;

                // Lets check the 'everything is fine' case first..
                $this->_db = connectDb();
                if( $this->_db ) {
                     $connectionEsablished = true;
                } else {
                     $connectionEsablished = false;
                     $message = "There was an error selecting the database. Please verify the database was already created or check the 'Create database' checkbox.";
                }

                // We were unable to connect to the db and select the right db.. lets try
                // just to connect.. maybe the database needs to be created (even though the
                // user did not check the appropriate box).
                if ( !$connectionEsablished ) {
                    $this->_db = connectDb( true, false );
                    if( !$this->_db ) {
                         $message = "There was an error connecting to the database. Please check your settings.";
                    }
                }

                if ( !$connectionEsablished ) {
                    $this->_view = new WizardView( "step1" );
                    $this->setDbConfigValues( $this->_view );
                    $this->_view->setErrorMessage( $message );
                    $this->setCommonData( true );
                    return false;
                }
            }

            $config = new ConfigFileStorage();
            $this->_database = $config->getValue( "db_database" );
            $this->_dbPrefix = $config->getValue( "db_prefix" );

            // create the database
            if( $createDb ) {
                $this->_db = connectDb( false, false );
				if( !$this->_db ) {
                    $this->_view = new WizardView( "step1" );
                    $this->setDbConfigValues( $this->_view );
                    $this->_view->setErrorMessage( $message );
                    $this->setCommonData( true );
                    return false;					
				}
                if( !$this->_db->Execute( "CREATE DATABASE ".$this->_database )) {
                    $message = "Error creating the database: ".$this->_db->ErrorMsg();
					$message .= "<br/><br/>If the database already exists, go back to Step 2 and use a new database name.";
                    $this->_view = new WizardView( "step1" );
                    $this->setDbConfigValues( $this->_view );
                    $this->_view->setErrorMessage( $message );
                    $this->setCommonData( true );
                    return false;
                } else {
                    $message = "Database created successfully.<br/>";
                }
            }

            // reconnect using the new database.
            $config = new ConfigFileStorage();
            $this->_db->Connect( $config->getValue( "db_host" ), 
                                 $config->getValue( "db_username" ), 
                                 $config->getValue( "db_password" ), 
                                 $config->getValue( "db_database" ));
                                 
            // create a data dictionary to give us the right sql code needed to create the tables
            $dict = NewPDbDataDictionary( $this->_db );

           // create the tables
            $errors = false;            
            
            foreach( $Tables as $name => $table ) {
            	$upperName = $dict->upperName;
            	$tableSchema = $table["schema"];
            	if ( isset( $table["options"] ) )
            	{
            		$tableOptions = $table["options"];
            		$options = array ( $upperName => $tableOptions );
            	} else {
            		$options = array ();
                }
                $sqlarray = $dict->CreateTableSQL( $this->_dbPrefix.$name, $tableSchema, $options );

                // each table may need more than one sql query because of indexes, triggers, etc...
                $ok = true;
                foreach( $sqlarray as $sql ) {
                    $ok = ( $ok && $this->_db->Execute( $sql ));
                }
                
                if( $ok )
                    $message .= "Table <strong>$name</strong> created successfully.<br/>";
                else {
                    $message .= "Error creating table $name: ".$this->_db->ErrorMsg()."<br/>";
                    $errors = true;
                }                    
            }

            if( $errors ) {
                $message = "There was an error creating the tables in the database. Please make sure that the user chosen to connect to the database has enough permissions to create tables.<br/><br/>$message";
                $this->_view = new WizardView( "step1" );
                $this->_view->setErrorMessage( $message );
                $this->setDbConfigValues( $this->_view );
                $this->setCommonData();
                return false;
            }

             // try to guess the url where plog is running
             $httpProtocol = (array_key_exists("HTTPS", $_SERVER) && $_SERVER["HTTPS"] == "on") ? "https://" : "http://";
             $httpHost = $_SERVER["HTTP_HOST"];
             $requestUrl = $_SERVER["REQUEST_URI"];
             $requestUrl = str_replace( "/wizard.php", "", $requestUrl );
             $plogUrl = $httpProtocol.$httpHost.$requestUrl;

            // Find some of the tools we are going to need (last one is for os x, with fink installed)
            // TBD: support for Windows specific directories
            $folders = Array( "/bin/", "/usr/bin/", "/usr/local/bin/", "/sw/bin/" );
            $finder = new FileFinder();
            $pathToUnzip = $finder->findBinary( "unzip", $folders );
            $pathToTar = $finder->findBinary( "tar", $folders);
            $pathToGzip = $finder->findBinary( "gzip", $folders);
            $pathToBzip2 = $finder->findBinary( "bzip2", $folders);
            $pathToConvert = $finder->findBinary( "convert", $folders);

            // and execute some insert's
            foreach( $Inserts as $insert ) {
                $query = str_replace( "{dbprefix}", $this->_dbPrefix, $insert );
                $query = str_replace( "{plog_base_url}", $plogUrl, $query );
                // replace also the placeholders for the paths to the tools
                $query = str_replace( "{path_to_tar}", $pathToTar, $query );
                $query = str_replace( "{path_to_unzip}", $pathToUnzip, $query );
                $query = str_replace( "{path_to_bz2}", $pathToBzip2, $query );
                $query = str_replace( "{path_to_gzip}", $pathToGzip, $query );
                $query = str_replace( "{path_to_convert}", $pathToConvert, $query );
                $query = str_replace( "{path_to_convert}", $pathToConvert, $query );
                if( !$this->_db->Execute( $query )) {
                    $message .= "Error executing code: ".$this->_db->ErrorMsg()."<br/>";
                    $errors = true;
                }
            }

            //
            // show some information regarding the helper tools we're going to need
            // and wether they were found or not
            //
            $message .= "<br/><b>-- Helper tools --</b><br/>";
            if( $pathToTar == "" )
                $message .= "The helper tool 'tar' was not found<br/>";
            else
                $message .= "The helper tool 'tar' was found in $pathToTar<br/>";
            if( $pathToGzip == "" )
                $message .= "The helper tool 'gzip' was not found<br/>";
            else
                $message .= "The helper tool 'gzip' was found in $pathToGzip<br/>";
            if( $pathToUnzip == "" )
                $message .= "The helper tool 'unzip' was not found<br/>";
            else
                $message .= "The helper tool 'unzip' was found in $pathToUnzip<br/>";
            if( $pathToBzip2 == "" )
                $message .= "The helper tool 'bzip2' was not found<br/>";
            else
                $message .= "The helper tool 'bzip2' was found in $pathToTar<br/>";
            if( $pathToConvert == "" )
                $message .= "The helper tool 'convert' (from the ImageMagick package) was not found<br/>";
            else
                $message .= "The helper tool 'convert' (from the ImageMagick package) was found in $pathToConvert<br/>";

            // Scan for locales
            $locales = new LTLocales();
            // find all the new locales that we have not yet stored
            $f = new LTLocaleFinder();
            $newLocaleCodes = $f->find();
            foreach( $newLocaleCodes as $newLocaleCode ) {
                $res = $locales->addLocale( $newLocaleCode );
            }

			// load the core permissions
		    include( PLOG_CLASS_PATH."install/corepermissions.properties.php" );

		    // process permissions
		    $total = 0;		
		    foreach( $permissions as $perm ) {
			    // check if it already exists
			    $query = "SELECT * FROM ".Db::getPrefix()."permissions WHERE permission = '".$perm[0]."'";
			    $result = $this->_db->Execute( $query );
			    if( !$result || $result->RowCount() < 1 ) {
				   	// permission needs to be added
					$corePerm = ( $perm[2] == true ? 1 : 0 );
					$adminOnly = ( $perm[3] == true ? 1 : 0 );

					$query = "INSERT INTO ".Db::getPrefix()."permissions (permission,description,core_perm,admin_only) ".
					          "VALUES ('".$perm[0]."','".$perm[1]."','".$corePerm."','".$adminOnly."')";

					$this->_db->Execute( $query );
					$total++;
			    }
		    }

			// show some feedback
            if( $errors ) {
                $this->_view = new WizardView( "step1" );
                $this->setDbConfigValues( $this->_view );
                $message = "There was an error initializing some of the tables. Please make sure that the user chosen to connect to the database has enough permissions to add records to the database.<br/><br/>$message";
                $this->_view->setErrorMessage( $message );
                $this->setCommonData();
            }
            else {
                $this->_view = new WizardView( "step2" );
                $this->_view->setValue( "message", $message );
            }
        }
    }

    /**
     *
     * this action only shows some feedback
     *
     */
    class WizardStepThree extends WizardAction
    {
        function perform()
        {
            $this->_view = new WizardView( "step3" );
            $this->setCommonData();
        }
    }

    /**
     *
     * Create the first user in the database
     *
     */
    class WizardStepFour extends WizardAction
    {

        var $_userName;
        var $_userPassword;
        var $_confirmPassword;
        var $_userEmail;
        var $_userFullName;

        function WizardStepFour( $actionInfo, $request )
        {
            $this->WizardAction( $actionInfo, $request );

            $this->registerFieldValidator( "userName", new UsernameValidator());
            $this->registerFieldValidator( "userPassword", new PasswordValidator());
            $this->registerFieldValidator( "userPasswordCheck", new PasswordValidator());
            $this->registerFieldValidator( "userEmail", new EmailValidator());
            $this->registerField( "userFullName" );
            $view = new WizardView( "step3" );
            $view->setErrorMessage( "Some data is missing or incorrect" );
            $this->setValidationErrorView( $view );
        }

        // creates the user
        function perform()
        {
            $this->_userName = $this->_request->getValue( "userName" );
            $this->_userPassword = $this->_request->getValue( "userPassword" );
            $this->_confirmPassword = $this->_request->getValue( "userPasswordCheck" );
            $this->_userEmail = $this->_request->getValue( "userEmail" );
            $this->_userFullName = $this->_request->getValue( "userFullName" );

            $db = connectDb();

            if( !$db ) {
                $this->_view = new WizardView( "step3" );
                $this->_view->setErrorMessage( "There was an error connecting to the database. Please check your settings." );
                $this->setCommonData();
                return false;
            }

            if( $this->_confirmPassword != $this->_userPassword ) {
                $this->_view = new WizardView( "step3" );
                $this->_form->setFieldValidationStatus( "userPasswordCheck", false );
                $this->setCommonData( true );
                return false;
            }

            $dbPrefix = Db::getPrefix();

            $users = new Users();
            $user = new UserInfo( $this->_userName,
                                  $this->_userPassword,
                                  $this->_userEmail,
                                  "",
                                  $this->_userFullName);
			// set the user as an administrator
			$user->setSiteAdmin( true );
			// and add this record to the db
            $userId = $users->addUser( $user );
            if( !$userId ) {
                $this->_view = new WizardView( "step3" );
				$db =& Db::getDb();
                $message = "There was an error adding the user. Make sure that the user does not already exist in the database (".$db->ErrorMsg().")";
                $this->_view->setErrorMessage( $message );
                $this->setCommonData();
                return false;
            }

			// since this user is an administrator, he must be granted all the administrator
			// permissions available
			$perms = new Permissions();
			$userPerms = new UserPermissions();
			foreach( $perms->getAllPermissions() as $perm ) {
				if( $perm->isAdminOnlyPermission()) {
					// if it's an admin permission, add it
					$p = new UserPermission( $userId, 0, $perm->getId());
					$userPerms->grantPermission( $p );
					//print("granting permission: ".$perm->getName()."<br/>");
				}
			}

            $this->_view = new Wizardview( "step4" );
            $this->_view->setValue( "ownerid", $userId );
            $this->_view->setValue( "siteLocales", LTLocales::getLocales());
            $this->_view->setValue( "defaultLocale", LTLocales::getDefaultLocale());
            $ts = new TemplateSets();
            $this->_view->setValue( "siteTemplates", $ts->getGlobalTemplateSets());
            $this->setCommonData();
            return true;
        }

    }

    class WizardStepFive extends WizardAction
    {

        var $_blogName;
        var $_ownerId;
        var $_blogProperties;

        function WizardStepFive( $actionInfo, $request )
        {
              $this->WizardAction( $actionInfo, $request );

              $this->registerFieldValidator( "blogName", new StringValidator());
              $this->registerFieldValidator( "ownerid", new IntegerValidator());
              $this->registerFieldValidator( "blogTemplate", new StringValidator());
              $this->registerFieldValidator( "blogLocale", new StringValidator());			  
              $view = new WizardView( "step4" );
              $view->setErrorMessage( "Some data is missing or incorrect" );
              $view->setValue( "siteLocales", LTLocales::getLocales());
			  $view->setValue( "defaultLocale", LTLocales::getDefaultLocale());
              $ts = new TemplateSets();
              $view->setValue( "siteTemplates", $ts->getGlobalTemplateSets());
              $this->setValidationErrorView( $view );
        }

        function perform()
        {
            // Before we add a new blog, we need to add blog category and global article category first
            // add blog category
            $blogCategories = new BlogCategories();
            $blogCategory = new BlogCategory( "General", "General" );
            $blogCategoryId = $blogCategories->addBlogCategory( $blogCategory );

            // add global article category
            $globalArticleCategories = new GlobalArticleCategories();
            $globalArticleCategory = new GlobalArticleCategory( "General", "General" );
            $globalArticleCategoryId = $globalArticleCategories->addGlobalArticleCategory( $globalArticleCategory );
            
            // retrieve the values from the view
            $this->_blogName = $this->_request->getValue( "blogName" );
            $this->_ownerId  = $this->_request->getValue( "ownerid" );
            $this->_blogProperties = $this->_request->getValue( "properties" );
            $this->_blogTemplate = $this->_request->getValue( "blogTemplate" );
            $this->_blogLocale = $this->_request->getValue( "blogLocale" );

            // configure the blog
            $blogs = new Blogs();
            $blog = new BlogInfo( $this->_blogName, $this->_ownerId, "", "" );
            // set the default BlogCategory id to blog
            $blog->setBlogCategoryId( $blogCategoryId );
            $blog->setProperties( $this->_blogProperties );
            $blog->setStatus( BLOG_STATUS_ACTIVE );
            $blogSettings = $blog->getSettings();
            $blogSettings->setValue( "locale", $this->_blogLocale );
            $blogSettings->setValue( "template", $this->_blogTemplate );
            $blog->setSettings( $blogSettings );

            // and now save it to the database
            $newblogId = $blogs->addBlog( $blog );
            if( !$newblogId ) {
                $this->_view = new WizardView( "step4" );
                $this->_view->setValue( "siteLocales", LTLocales::getLocales());
                $ts = new TemplateSets();
                $this->_view->setValue( "siteTemplates", $ts->getGlobalTemplateSets());
                $this->_view->setErrorMessage( "There was an error creating the new blog" );
                $this->setCommonData( true );
                return false;
            }

            // if the blog was created, we can add some basic information
            // add a category
            $articleCategories = new ArticleCategories();
            $articleCategory = new ArticleCategory( "General", "General", $newblogId, true );
            $catId = $articleCategories->addArticleCategory( $articleCategory );

            // load the right locale
            $locale =& LTLocales::getLocale( $this->_blogLocale );
            // and load the right text
            $articleTopic = $locale->tr( "register_default_article_topic" );
            $articleText  = $locale->tr( "register_default_article_text" );
            $article = new Article( $articleTopic, $articleText, Array( $catId ), $this->_ownerId, $newblogId, POST_STATUS_PUBLISHED, 0, Array(), "welcome" );
            // set the default ArticleGlobalCategory id to article
            $article->setGlobalCategoryId( $globalArticleCategoryId );
            // set the current time to article
            $t = new Timestamp();
            $article->setDateObject( $t );
            $articles = new Articles();
            $articles->addArticle( $article );

            // add a new first album so that users can start uploading stuff right away
            $t = new Timestamp();
            $album = new GalleryAlbum( $newblogId,
                                       "General",
                                       "General",
                                       GALLERY_RESOURCE_PREVIEW_AVAILABLE,
                                       0,
                                       $t->getTimestamp(),
                                       Array(),
                                       true );
            $albums = new GalleryAlbums();
            $albums->addAlbum( $album );
            
            // add a new default mylinkscategory
            $linksCategory = new MyLinksCategory( "General", $newblogId );
            $linksCategories = new MyLinksCategories();
            $linksCategories->addMyLinksCategory( $linksCategory );         

            // save a few things in the default configuration
            $config =& Config::getConfig();
            // default blog id
            $config->saveValue( "default_blog_id", (int)$newblogId );
            // default locale
            $config->saveValue( "default_locale", $this->_blogLocale );
            // and finally, the default template
            $config->saveValue( "default_template", $this->_blogTemplate );

            //
            // detect wether we have GD available and set the blog to use it
            //
            if( GdDetector::detectGd()) {
                $config->saveValue( "thumbnail_method", "gd" );
                $message = "GD has been detected and set as the backend for dealing with images.";
            }
            else {
                $pathToConvert = $config->getValue( "path_to_convert" );
                if( $pathToConvert ) {
                    $config->saveValue( "thumbnail_method", "imagemagick" );
                    $message = "ImageMagick has been detected and set as the backend for dealing with images.";
                }
                else {
                    // nothing was found, so we'll have to do away with the 'null' resizer...
                    $config->saveValue( "thumbnail_method", "null" );
                    $message = "Neither GD nor ImageMagick have been detected in this host so it will not be possible to generate thumbnails from images.";
                }
            }
            
            // clean the data cache to avoid problems when we're done
            lt_include( PLOG_CLASS_PATH."class/cache/cachemanager.class.php" );
            $cache =& CacheManager::getCache();
            $cache->clearCache();

            WizardTools::cleanTmpFolder();

            $this->_view = new WizardView( "step5" );
            $this->_view->setValue( "message", $message );
            return true;
        }
    }

    class UpdateStepOne extends WizardAction
    {

        function perform()
        {
            $this->_view = new WizardView( "update1" );
            WizardStepTwo::setDbConfigValues( $this->_view );
            $this->setCommonData();
        }
    }

    class UpdateStepTwo extends WizardAction
    {
        function perform()
        {
			lt_include( PLOG_CLASS_PATH."class/config/config.class.php" );
			$config =& Config::getConfig();
			$resourcesNamingRule = $config->getValue( "resources_naming_rule", "original_file_name" );
			
            $this->_view = new WizardView( "update2" );
            $this->_view->setValue( "resourcesNamingRule", $resourcesNamingRule );
            $this->setCommonData();
        }
    }
    
    /**
     * Generic class that performs data updates on the database
     */
    class DatabaseDataTransformer extends Model
    {
        /**
         * @public
         * Public fields, may be accessed by other classes
         */
        var $updatedRecords;
        var $message;
        var $errorRecords;
        var $notModifiedRecords;
        var $failOnError;
        var $page;
        var $itemsPerPage;
        var $dbPrefix;
    
        function DatabaseDataTransformer( $page = -1, $itemsPerPage = WIZARD_MAX_RECORDS_PER_STEP )
        {
            $this->Model();
            
            $this->updatedRecords = 0;
            $this->errorRecords   = 0;
            $this->notModifiedRecords = 0;
            $this->addedRecords = 0;
            $this->deletedRecords = 0;
            $this->failOnError = DATABASE_DATA_TRANSFORMER_FAIL_ON_ERROR_DEFAULT;
            $this->message = "";
            
            $this->page = $page;
            $this->itemsPerPage = $itemsPerPage;
            
            $this->dbPrefix = $this->getPrefix();
        }
        
        /**
         * Rerforms the transformation. Returns true if the step was successful or false otherwise.
         * Upon finalization, please check the $message string to get more information. Use the $updatedRecords,
         * $errorRecords, $notModifiedRecords, $addedRecords and $deletedRecords for some figures regarding the 
         * previous step
         */
        function perform()
        {
            // must be implemented by child classes
            return true;        
        }
        
        /**
         * Returns true if there is no more data for this transformer to upgrade, or false otherwise
         *
         * @return True if ready or false if not
         */
        function isComplete()
        {
            return( $this->getNumSteps() <= $this->page );
        }
        
        /**
         * returns the number of steps needed to process this data
         */
        function getNumSteps( $table = "" )
        {
            // if there is a table name, we can take a shortcut or else we expect child
            // classes to reimplement this method
            if( $table ) {
                $numItems = $this->getNumItems( $this->getPrefix().$table );
                
                $numSteps = ceil( $numItems / $this->itemsPerPage );
            }
            else {
                $numSteps = 0;
            }
            
            return( $numSteps );
        }
        
        /**
         * returns the total number of records processed so far based on the current page and the
         * number of items per page
         */
        function getTotalProcessedRecords()
        {
            return( $this->page * $this->itemsPerPage );
        }
        
        /**
         * returns an approximate percentage of records processed so far
         */
        function getPercentProcessed()
        {
            $processed = $this->getTotalProcessedRecords();
            return((int)($processed / ( $this->getNumSteps() * $this->itemsPerPage ) * 100 ));
        }
    }

	/**
	 * This step takes care of transforming the database schema, one
	 * table at a time.
	 */
	class DatabaseSchemaDataTransformer extends DatabaseDataTransformer
	{		
		function getNumSteps()
		{
			global $Tables;			
			return( count( $Tables ) - 1);
		}
		
		function perform()
		{
			global $Tables;
			
			$tablesArray = array_keys( $Tables );
			$curTable = $tablesArray[$this->page-1];
						
			$db =& Db::getDb();
            $dict = NewPDbDataDictionary( $db );
            $errors = false;

			$this->message = "Performing changes to the dabase schema, please wait (step %s of %s)<br/>";

			$errorMessage = "";
			$table_errors = false;
			$upperName = $dict->upperName;
			$tableSchema = $Tables[$curTable]["schema"];
			if ( isset( $Tables[$curTable]["options"] )) {
				$tableOptions = $Tables[$curTable]["options"];
				$options = array ( $upperName => $tableOptions );
			} 
			else {
				$options = array ();
			}

			// generate the code with the changes for the table
			$sqlarray = $dict->ChangeTableSQL( $this->getPrefix().$curTable, $tableSchema, $options );

			foreach( $sqlarray as $sql ) {
				// and run the query
				//print( "sql: ".$sql."<br/>" );
				if( !$this->Execute( $sql )) {
					$table_errors = true;
					$errors = true;
					$errorMessage .= $this->_db->ErrorMsg()."<br/>";
				}
			}

			if( !$table_errors ) {
				$this->message .= "Changes to table <strong>$curTable</strong> executed successfully.<br/>";
				$result = true;
			}
			else {
				$this->message .= "Error modifying table $curTable: ".$errorMessage;
				$result = false;
			}

			return( $result ); 
		}
	}
    
    /**
	 * Processes all users and grants the appropriate permissions
     */
    class UserPermissionsDataTransformer extends DatabaseDataTransformer
    {        
        function getNumSteps()
        {
            return( parent::getNumSteps( "tmp_users_permissions" ));
        }
    
        function perform()
        {
            $this->message = "Updating user permissions (step %s of %s)<br/>";        
        
            $query3 = "SELECT * FROM ".Db::getPrefix()."tmp_users_permissions";
            $res3 = $this->Execute( $query3, $this->page, $this->itemsPerPage );
            if( $res3->RecordCount() == 0 ) {
				$this->message .= "No more records to process";
				$this->Execute("DROP TABLE ".Db::getPrefix()."tmp_users_permissions");
				return( true );
			}
			
			$permissions = new Permissions();
			$userPermissions = new UserPermissions();
			$allPerms = $permissions->getAllPermissions();
			$blogOwnerOnlyPerms = Array( "update_blog", 
			                             "add_blog_user", 
			                             "update_blog_user", 
			                             "view_blog_users", 
			                             "view_blog_stats", 
			                             "add_blog_template",
										 "view_blog_templates",
										 "view_blog_stats" );
			
            while( $row = $res3->FetchRow()) {
            	// grant all the non-admin permissions so that users can still access the blogs to where they still had permissions
				if( $row["permission_id"] != 3) {
					foreach( $allPerms as $perm ) {
						if( !$perm->isAdminOnlyPermission() && !in_array( $perm->getName(), $blogOwnerOnlyPerms )) {
							//print( "granting perm: ".$perm->getName()." - user: ".$row["user_id"]." - blog id: ".$row["blog_id"]."<br/>");							
							$perm = new UserPermission( $row["user_id"], $row["blog_id"], $perm->getId());
							$userPermissions->grantPermission( $perm );
						}
					}
				}
				
				$this->updatedRecords++;
            }
      
            $this->message .= "{$this->updatedRecords} users updated (".$this->getPercentProcessed()."%%)<br/>";

            return true;
        }
    }

	class PermissionLoader extends DatabaseDataTransformer
	{
		
		//
		// load the new list of permissions
		//		
		function getNumSteps()
		{
			return( 0 );
		}
		
		function perform()
		{
			// initial message, no errors yet
            $this->message = "Loading new permissions (step %s of %s)<br/>";			
			$errors = false;
			
			// load the core permissions
		    include( PLOG_CLASS_PATH."install/corepermissions.properties.php" );	

		    // process permissions
		    $total = 0;		
		    foreach( $permissions as $perm ) {
			    // check if it already exists
			    $query = "SELECT * FROM ".$this->dbPrefix."permissions WHERE permission = '".$perm[0]."'";
			    $result = $this->Execute( $query );
			    if( !$result || $result->RowCount() < 1 ) {				
				   	// permission needs to be added
					$corePerm = ( $perm[2] == true ? 1 : 0 );
					$adminOnly = ( $perm[3] == true ? 1 : 0 );
					$query = "INSERT INTO ".$this->dbPrefix."permissions (permission,description,core_perm,admin_only) ".
					          "VALUES ('".$perm[0]."','".$perm[1]."','".$corePerm."','".$adminOnly."')";
					$this->_db->Execute( $query );
					$total++;
			    }
		    }
		
			//
			// prepare the users_permissions table for the next step
			//

            // make sure we are starting with an empty table
            $this->Execute("DELETE FROM ".Db::getPrefix()."tmp_users_permissions");
            
			if( !$this->Execute( "INSERT INTO ".$this->dbPrefix."tmp_users_permissions SELECT * FROM ".$this->dbPrefix."users_permissions WHERE blog_id != 0 AND permission_id != 1" )) {
				$this->message .= "Error preparing the users_permissions table for transformation";
				$errors = true;
			}
			else {
				$this->Execute( "DELETE FROM ".$this->dbPrefix."users_permissions" );
				$this->message .= count($permissions)." permissions successfully loaded";
				$errors = false;
			}				
			
			return( !$errors );			
		}	
	}

	class ConfigDataTransformer extends DatabaseDataTransformer
	{
		function getNumSteps()
		{
			return( 0 );
		}
		
		function perform()
		{
		    global $Inserts;	
			
            $this->message = "Adding new configuration parameters (step %s of %s)<br/>";
			$errors = false;
			
            // Find some of the tools we are going to need (last one is for os x, with fink installed), this will be needed later on
            $folders = Array( "/bin/", "/usr/bin/", "/usr/local/bin/", "/sw/bin/" );
            $finder = new FileFinder();
            $pathToUnzip = $finder->findBinary( "unzip", $folders );
            $pathToTar = $finder->findBinary( "tar", $folders);
            $pathToGzip = $finder->findBinary( "gzip", $folders);
            $pathToBzip2 = $finder->findBinary( "bzip2", $folders);
            $pathToConvert = $finder->findBinary( "convert", $folders);

            // check the configuration and add the new configuration settings that were added for 1.2
            foreach( $Inserts as $key => $insert ) {
				$checkKeyQuery = "SELECT * FROM ".$this->dbPrefix."config WHERE config_key ='".$key."';";
				$result = $this->Execute($checkKeyQuery);
                if(!$result){
                    $this->message .= "Error executing code: ".$this->_db->ErrorMsg()."<br/>";
                    $errors = true;
                }
				else{
                    if ($result->RecordCount() == 0) {	
                        // replace the prefix
                        $query = str_replace( "{dbprefix}", $this->dbPrefix, $insert );
                        // replace also the placeholders for the paths to the tools
                        $query = str_replace( "{path_to_tar}", $pathToTar, $query );
                        $query = str_replace( "{path_to_unzip}", $pathToUnzip, $query );
                        $query = str_replace( "{path_to_bz2}", $pathToBzip2, $query );
                        $query = str_replace( "{path_to_gzip}", $pathToGzip, $query );
                        $query = str_replace( "{path_to_convert}", $pathToConvert, $query );
                        $query = str_replace( "{path_to_convert}", $pathToConvert, $query );
                        if( !$this->Execute( $query )) {
                            $this->message .= "Error executing code: ".$this->_db->ErrorMsg()."<br/>";
                            $errors = true;
                        }
                    }
                    $result->Close();
                }
            }
                // check to see if we need to remove duplicates and the id index
            $query = "SELECT id FROM ".$this->dbPrefix."config LIMIT 1";
            $result = $this->Execute($query);
                // if $result is false, id column has already been removed
            if($result){
                $result->Close();           
                    // remove all duplicates in plog_config table
                    
                    // first create temp table without the duplicates
                $query = "CREATE TEMPORARY TABLE tmptable ".
                         "SELECT * FROM ".$this->dbPrefix."config WHERE 1 GROUP BY config_key";
                $result = $this->Execute($query);
                if($result){
                    //$result->Close();
                        // Now delete the old table
                    $query = "DELETE FROM ".$this->dbPrefix."config";
                    $result = $this->Execute($query);
                    if($result) {
                        //$result->Close();
                        // Insert the unique rows into the old table
                        $query = "INSERT INTO ".$this->dbPrefix."config SELECT * FROM tmptable";
                        $result = $this->Execute($query);
                    }
                }
                /*if(!$result){
                    $this->message .= "Error removing duplicates in config table<br/>";
                    $errors = true;
                }*/

                if($result){

                    // remove index id field, we don't need it any more!
                    $query = "ALTER TABLE ".$this->dbPrefix."config DROP COLUMN id";
                    $result = $this->Execute($query);
                    if(!$result){
                        $this->message .= "Error removing old id column from config table: ".$this->_db->ErrorMsg()."<br/>";
                        $errors = true;
                    }
                }
            }			

			if( !$errors ) {
				$this->message .= "Configuration settings updated successfully";
			}
			
			return( !$errors );
		}		
	}

    /**
	 * Processes all admin users and grants the appropriate permissions
     */
    class AdminUserPermissionsDataTransformer extends DatabaseDataTransformer
    {        
        function getNumSteps()
        {
            return( parent::getNumSteps( "users" ));
        }
    
        function perform()
        {
            $this->message = "Updating admin user permissions (step %s of %s)<br/>";        
        
            // load each one of the categories and update them
            // list of categories
            /*$query3 = "SELECT id, site_admin FROM ".$this->dbPrefix."users";
            $res3 = $this->Execute( $query3, $this->page, $this->itemsPerPage );
            if( $res3->RecordCount() == 0 ) {
				$this->message .= "No more records to process";
				return( true );
			}*/
			
			$users = new Users();
			$allUsers = $users->getAllUsers( USER_STATUS_ALL, "", "", $this->page, $this->itemsPerPage );
			
			$permissions = new Permissions();
			$userPermissions = new UserPermissions();
			$loginPerm = $permissions->getPermissionByName( "login_perm" );
			$allPerms = $permissions->getAllPermissions();
			
            //while( $row = $res3->FetchRow()) {
			foreach( $allUsers as $user ) {
				//print("Processing user: ".$user->getUsername()."<br/>");
            	//if( $row["site_admin"] > 0 ) {
				if( $user->isSiteAdmin()) {
					// it's an admin, let's grant all the appropriate permissions
					foreach( $allPerms as $perm ) {
						if( $perm->isAdminOnlyPermission() && $perm->getName() != "login_perm" ) {
							//$userPerm = new UserPermission( $row["id"], 0, $perm->getId());
							$userPerm = new UserPermission( $user->getId(), 0, $perm->getId());
							$userPermissions->grantPermission( $userPerm );
						}
					}
				}
				// grant the login_perm permission or else users won't be able to log in
				$newPerm = new UserPermission( $user->getId(), 0, $loginPerm->getId());
				$userPermissions->grantPermission( $newPerm );
				
				$this->updatedRecords++;
            }
        
            $this->message .= "{$this->updatedRecords} users updated (".$this->getPercentProcessed()."%%)<br/>";
            return true;        
        }
    }
    
    /**
     * processes all resource files and renames the files to their "real" names
     */
    class ResourcesOriginalFileNameDataTransformer extends DatabaseDataTransformer
    {
        function getNumSteps()
        {
            return( parent::getNumSteps( "gallery_resources" ));
        }
    
        function perform()
        {
            $this->message = "Updating resource files with original file naming rule (step %s of %s)<br/>";        
        
            $query1 = "SELECT id, owner_id, file_name, resource_type, thumbnail_format FROM ".$this->dbPrefix."gallery_resources";

			$config =& Config::getConfig();
			$galleryFolder = $config->getValue( "resources_folder" );

            // total number of comments
            $res1 = $this->Execute( $query1, $this->page, $this->itemsPerPage );
            if( !$res1 ) {
                $this->message .= "Error performing loading resource data";
                return false;
            }
            if( $res1->RecordCount() == 0 ) {
				$this->message .= "No more records to process";
				return( true );            
            }
            $numComments = Array();
            while( $row = $res1->FetchRow()) {
				//
				// process each one of the rows and rename the main file
				//
				
				// get the file extension
				if(( $extPos = strrpos( $row["file_name"], "." )) !== false ) {					
					$fileExt = substr( $row["file_name"], $extPos+1, strlen( $row["file_name"] ));
				}
				else {
					$fileExt = "";
				}
								
				$fileName = $galleryFolder.$row["owner_id"]."/".$row["owner_id"]."-".$row["id"].".".$fileExt;
				$destFileName = $galleryFolder.$row["owner_id"]."/".$row["file_name"];
				
                    //print( "Renaming file: $fileName --- $destFileName<br/>" );

                    // skip the rename if we already did it
				if( File::exists( $fileName )) {
	                if( !File::exists( $destFileName)) {
	                    if( !File::rename( $fileName, $destFileName )) {
	                        $this->message .= "Error updating resource file with id ".$row["id"].", while attempting to rename file from $fileName to $destFileName<br/>";
	                    }
					}
				}
				
				// if it's an image, we also need to process the previews
				if( $row["resource_type"] == "1" ) {
					// calculate the extension of the preview file, depending on how it was saved
					if( $row["thumbnail_format"] == "same" ) {
						$previewExt = strtolower( $fileExt );
						$destFileName = $row["file_name"];
					}
					else {
						$previewExt = $row["thumbnail_format"];
						// remove the old extension and put the new one in place
						//print("file name = ".$row["file_name"]." - file ext = $fileExt - previewExt = $previewExt" );
						$destFileName = str_replace( $fileExt, $previewExt, $row["file_name"] );
					}
						
					// file names for the preview and medium preview
					$previewFileName = $galleryFolder.$row["owner_id"]."/previews/".$row["owner_id"]."-".$row["id"].".".$previewExt;
					$medPreviewFileName = $galleryFolder.$row["owner_id"]."/previews-med/".$row["owner_id"]."-".$row["id"].".".$previewExt;					
					// destination file names for the preview and medium preview
					$destPreviewFileName = $galleryFolder.$row["owner_id"]."/previews/".$destFileName;
					$destMedPreviewFileName = $galleryFolder.$row["owner_id"]."/previews-med/".$destFileName;
					
					//print(" -- renaming preview: $previewFileName -- $destPreviewFileName<br/>");
					//print(" -- renaming medium preview: $medPreviewFileName -- $destMedPreviewFileName<br/>");					
					
					if( File::exists( $previewFileName )) {
                    	if( !File::exists( $destPreviewFileName)) {
                        	File::rename( $previewFileName, $destPreviewFileName );
                    	}
					}
					if( File::exists( $medPreviewFileName )) {
	                    if( !File::exists( $destMedPreviewFileName)) {
	                        File::rename( $medPreviewFileName, $destMedPreviewFileName );
	                    }
					}
				}

                $this->updatedRecords++;
            }
            $res1->Close();
            $this->message .= "{$this->updatedRecords} resource files updated, ".$this->getTotalProcessedRecords()." processed so far (".$this->getPercentProcessed()."%%)<br/>";
            return true;        
        }        
    }

    /**
     * processes all resource files and renames the files to their "encoded" names
     */
    class ResourcesEncodedFileNameDataTransformer extends DatabaseDataTransformer
    {
        function getNumSteps()
        {
            return( parent::getNumSteps( "gallery_resources" ));
        }
    
        function perform()
        {
            $this->message = "Updating resource files with encoded file naming rule (step %s of %s)<br/>";        
        
            $query1 = "SELECT id, owner_id, file_name, resource_type, thumbnail_format FROM ".$this->dbPrefix."gallery_resources";

			$config =& Config::getConfig();
			$galleryFolder = $config->getValue( "resources_folder" );

            // total number of comments
            $res1 = $this->Execute( $query1, $this->page, $this->itemsPerPage );
            if( !$res1 ) {
                $this->message .= "Error performing loading resource data";
                return false;
            }
            if( $res1->RecordCount() == 0 ) {
				$this->message .= "No more records to process";
				return( true );            
            }
            $numComments = Array();
            while( $row = $res1->FetchRow()) {
				//
				// process each one of the rows and rename the main file
				//
				
				// get the file extension
				if(( $extPos = strrpos( $row["file_name"], "." )) !== false ) {					
					$fileExt = substr( $row["file_name"], $extPos+1, strlen( $row["file_name"] ));
				}
				else {
					$fileExt = "";
				}
								
				$fileName = $galleryFolder.$row["owner_id"]."/".$row["owner_id"]."-".$row["id"].".".$fileExt;
				$destFileName = $galleryFolder.$row["owner_id"]."/".$row["owner_id"]."-".$row["id"].".".strtolower($fileExt);
				
				if( $fileName != $destFileName ) {
					if( File::exists( $fileName )) {
		                if( !File::exists( $destFileName)) {
		                    if( !File::rename( $fileName, $destFileName )) {
		                        $this->message .= "Error updating resource file with id ".$row["id"].", while attempting to rename file from $fileName to $destFileName<br/>";
		                    }
						}
					}
				}	

                $this->updatedRecords++;
            }
            $res1->Close();
            $this->message .= "{$this->updatedRecords} resource files updated, ".$this->getTotalProcessedRecords()." processed so far (".$this->getPercentProcessed()."%%)<br/>";
            return true;        
        }        
    }

    /**
     * processes all resource files that we did not convert correctly in 1.2.0
     */
    class ResourcesFix120FileNameDataTransformer extends DatabaseDataTransformer
    {
        function getNumSteps()
        {
            return( parent::getNumSteps( "gallery_resources" ));
        }
    
        function perform()
        {
            $this->message = "Fixing resource files with original file naming rule (step %s of %s)<br/>";        
        
            $query1 = "SELECT id, owner_id, file_name, resource_type, thumbnail_format FROM ".$this->dbPrefix."gallery_resources";

			$config =& Config::getConfig();
			$galleryFolder = $config->getValue( "resources_folder" );

            // total number of comments
            $res1 = $this->Execute( $query1, $this->page, $this->itemsPerPage );
            if( !$res1 ) {
                $this->message .= "Error performing loading resource data";
                return false;
            }
            if( $res1->RecordCount() == 0 ) {
				$this->message .= "No more records to process";
				return( true );            
            }
            $numComments = Array();
            while( $row = $res1->FetchRow()) {
				//
				// process each one of the rows and rename the main file
				//
				
				// get the file extension
				if(( $extPos = strrpos( $row["file_name"], "." )) !== false ) {					
					$fileExt = substr( $row["file_name"], $extPos+1, strlen( $row["file_name"] ));
				}
				else {
					$fileExt = "";
				}

				// Only convert the preview file name if the file extension does not lower case
				if( strtolower( $fileExt ) != $fileExt ) {
					// if it's an image, we also need to process the previews
					if( $row["resource_type"] == "1" ) {
						// calculate the extension of the preview file, depending on how it was saved
						if( $row["thumbnail_format"] == "same" ) {
							$previewExt = strtolower( $fileExt );
							$destFileName = $row["file_name"];
						}
						else {
							$previewExt = $row["thumbnail_format"];
							// remove the old extension and put the new one in place
							//print("file name = ".$row["file_name"]." - file ext = $fileExt - previewExt = $previewExt" );
							$destFileName = str_replace( $fileExt, $previewExt, $row["file_name"] );
						}
							
						// file names for the preview and medium preview
						$previewFileName = $galleryFolder.$row["owner_id"]."/previews/".$row["owner_id"]."-".$row["id"].".".$previewExt;
						$medPreviewFileName = $galleryFolder.$row["owner_id"]."/previews-med/".$row["owner_id"]."-".$row["id"].".".$previewExt;					
						// destination file names for the preview and medium preview
						$destPreviewFileName = $galleryFolder.$row["owner_id"]."/previews/".$destFileName;
						$destMedPreviewFileName = $galleryFolder.$row["owner_id"]."/previews-med/".$destFileName;
						
						//print(" -- renaming preview: $previewFileName -- $destPreviewFileName<br/>");
						//print(" -- renaming medium preview: $medPreviewFileName -- $destMedPreviewFileName<br/>");					
						
						if( File::exists( $previewFileName )) {
	                    	if( !File::exists( $destPreviewFileName)) {
	                        	File::rename( $previewFileName, $destPreviewFileName );
	                    	}
						}
						if( File::exists( $medPreviewFileName )) {
		                    if( !File::exists( $destMedPreviewFileName)) {
		                        File::rename( $medPreviewFileName, $destMedPreviewFileName );
		                    }
						}
					}
				}

                $this->updatedRecords++;
            }
            $res1->Close();
            $this->message .= "{$this->updatedRecords} resource files updated, ".$this->getTotalProcessedRecords()." processed so far (".$this->getPercentProcessed()."%%)<br/>";
            return true;        
        }        
    }    

	// Dummy Transformer
	class DummyDataTransformer extends DatabaseDataTransformer
	{
		function getNumSteps()
		{
			return( 0 );
		}
		
		function perform()
		{
			return true;
		}
	}
    
    /**
     * This class is basically now a "data transformer runner", because now it works
     * like class that executes data transformers, collects their results and refreshes
     * the page to execute the next step of the transformer. If the current transformer
     * reported that its processing is complete, this class will continue with the next
     * transformer unless there are no more transformer to run.
     *
     * In order to coordinate the current step and the current transformer, two parameters
     * are needed in each request:
     *
     * - page
     * - transformerId
     *
     * The 'page' parameter holds the current page, while 'transformerId' is the index of 
     * the current transformer in the $this->transformers array.
     *
     * In order to add new transformers, follow these steps:
     *
     * - Create your own transfomer class by extending DatabaseDataTransformer and implementing
     * the methods DatabaseDataTransformer::perform() and DatabaseDataTransformer::getNumSteps(). The
     * first does the data processing while the second one returns the number of needed steps to the
     * class running the transformer.
     * - Add the name of the transformer class to the the UpdateStepThree::transformers array,
     * and the class will take care of everything else. 
     */
    class UpdateStepThree extends WizardPagedAction
    {
        var $resourcesNamingRule;
        var $message;  
        var $currentTransformerId;
        var $totalTransformers;
    
        function UpdateStepThree( $actionInfo, $httpRequest )
        {
            $this->WizardPagedAction( $actionInfo, $httpRequest );
            // data validation
            $this->registerFieldValidator( "resourcesNamingRule", new StringValidator());
			$errorView = new WizardView( "update2" );
            $errorView->setErrorMessage( "Some data was incorrect or missing." );
            $this->setValidationErrorView( $errorView );
            
            /**
             * array with the data transformers that will be run
             */
			$this->resourcesNamingRule = $this->_request->getValue( "resourcesNamingRule" );
			if( $this->resourcesNamingRule == 'encoded_file_name' ) {
	            $this->transformers = Array(
					"DatabaseSchemaDataTransformer",
					"PermissionLoader",
					"AdminUserPermissionsDataTransformer",
					"UserPermissionsDataTransformer",
					"ConfigDataTransformer",
					"ResourcesEncodedFileNameDataTransformer",
					"DummyDataTransformer"
	            );
	        }
	        else {
	            $this->transformers = Array(
					"DatabaseSchemaDataTransformer",
					"PermissionLoader",
					"AdminUserPermissionsDataTransformer",
					"UserPermissionsDataTransformer",
					"ConfigDataTransformer",
					"ResourcesOriginalFileNameDataTransformer",
					"DummyDataTransformer"
	            );
	    	}

            $this->currentTransformerId = $this->getTransformerIdFromRequest();
            $this->totalTransformers = count( $this->transformers ) - 1;
        }
        
        /**
         * gets the id of the transformer from the request. If it is not available, it
         * will return the id of the first transformer available (which is '0')
         *
         * @private
         */
        function getTransformerIdFromRequest()
        {    	
			$id = HttpVars::getRequestValue( "transformerId" );
			$val = new IntegerValidator();
			if( !$val->validate( $id ))
				$id = 0;
							
			return $id;        
        }        

       function perform()
       {
            $step = $this->getPageFromRequest();
            
            // get the current transformer class so that we can continue where we left
            $transformerClass = $this->transformers[$this->currentTransformerId];
            $transformer = new $transformerClass( $step );
            $result = $transformer->perform();
            $complete = $transformer->isComplete();
            $message = $transformer->message;
            $message = sprintf( $message, $this->currentTransformerId + 1, $this->totalTransformers );
            
            //print("transformer = $transformerClass<br/>");
             
            // error during processing and the processor is configured
            // to fail on error   
            if( !$result && $transformer->failOnError ) {
                //print("Error in step = $step<br/>");
                $this->_view = new WizardView( "update3" );
                $this->_view->setValue( "resourcesNamingRule", $this->resourcesNamingRule );
                // current and next step
                $this->_view->setValue( "currentStep", $step );
                $this->_view->setValue( "nextStep", $step+1 );                
                // whether this transformer is ready
                $this->_view->setValue( "complete", $complete );
                // transformer id
                $this->_view->setValue( "transformerId", $this->currentTransformerId );            
                $this->_view->setValue( "error", true );
                if( $transformer->DbError() != "" ) {
                    $message .= "<br/>The database error message was: ".$transformer->DbError()."<br/>";
                }

                $this->_view->setErrorMessage( $message );
            }                
            else {
                if( !$complete ) {
                    //print("it's not complete! step = $step<br/>");
                    $this->_view = new WizardView( "update3" );
                    $this->_view->setValue( "resourcesNamingRule", $this->resourcesNamingRule );
                    // current and next step
                    $this->_view->setValue( "currentStep", $step );
                    $this->_view->setValue( "nextStep", $step+1 );                
                    // whether this transformer is ready
                    $this->_view->setValue( "complete", $complete );
                    // transformer id
                    $this->_view->setValue( "transformerId", $this->currentTransformerId );
                }            
                else {
                    // have we already been through all transformers?
                    //print("transformer complete! - num transformers = ".count($this->transformers)."<br/>");
                    $moreTransformers = ( $this->currentTransformerId+1 < count( $this->transformers ));
                    if( $moreTransformers ) {
                        //print("Starting new transformer!<br/>");
                        $this->_view = new WizardView( "update3" );
                        $this->_view->setValue( "resourcesNamingRule", $this->resourcesNamingRule );
                        // current and next step
                        $this->_view->setValue( "currentStep", 0 );
                        $this->_view->setValue( "nextStep", 1 );  
                        // whether this transformer is ready
                        $this->_view->setValue( "complete", false );
                        // transformer id
                        $this->_view->setValue( "transformerId", $this->currentTransformerId+1 );
                    }
                    else {
                        // no more data to transform, we can finalize the installation!
						// delete the contents of the temporary folder
						lt_include( PLOG_CLASS_PATH."class/config/config.class.php" );
						$config =& Config::getConfig();
						$tmpFolder = $config->getValue( "temp_folder", TEMP_FOLDER );
                        WizardTools::cleanTmpFolder();
                        
                        // save the resources naming rule to config table
						$config->saveValue( "resources_naming_rule", $this->resourcesNamingRule );

                        $this->_view = new WizardView( "update4" );
                    }
                }
            }

            $this->_view->setValue( "message", $message );            

            return true;
        }
    }

	// Fix those resources that we did not convert correctly in 1.2.0
    class Fix120StepOne extends WizardPagedAction
    {
        var $message;  
        var $currentTransformerId;
        var $totalTransformers;
    
        function Fix120StepOne( $actionInfo, $httpRequest )
        {
            $this->WizardPagedAction( $actionInfo, $httpRequest );
            
            /**
             * array with the data transformers that will be run
             */
            $this->transformers = Array(
				"ResourcesFix120FileNameDataTransformer",
				"DummyDataTransformer"
            );

            $this->currentTransformerId = $this->getTransformerIdFromRequest();
            $this->totalTransformers = count( $this->transformers ) - 1;
        }
        
        /**
         * gets the id of the transformer from the request. If it is not available, it
         * will return the id of the first transformer available (which is '0')
         *
         * @private
         */
        function getTransformerIdFromRequest()
        {    	
			$id = HttpVars::getRequestValue( "transformerId" );
			$val = new IntegerValidator();
			if( !$val->validate( $id ))
				$id = 0;
							
			return $id;        
        }        

       function perform()
       {
            $step = $this->getPageFromRequest();
            
            // get the current transformer class so that we can continue where we left
            $transformerClass = $this->transformers[$this->currentTransformerId];
            $transformer = new $transformerClass( $step );
            $result = $transformer->perform();
            $complete = $transformer->isComplete();
            $message = $transformer->message;
            $message = sprintf( $message, $this->currentTransformerId + 1, $this->totalTransformers );
            
            //print("transformer = $transformerClass<br/>");
             
            // error during processing and the processor is configured
            // to fail on error   
            if( !$result && $transformer->failOnError ) {
                //print("Error in step = $step<br/>");
                $this->_view = new WizardView( "update3" );
                // current and next step
                $this->_view->setValue( "currentStep", $step );
                $this->_view->setValue( "nextStep", $step+1 );                
                // whether this transformer is ready
                $this->_view->setValue( "complete", $complete );
                // transformer id
                $this->_view->setValue( "transformerId", $this->currentTransformerId );            
                $this->_view->setValue( "error", true );
                if( $transformer->DbError() != "" ) {
                    $message .= "<br/>The database error message was: ".$transformer->DbError()."<br/>";
                }

                $this->_view->setErrorMessage( $message );
            }                
            else {
                if( !$complete ) {
                    //print("it's not complete! step = $step<br/>");
                    $this->_view = new WizardView( "fix120" );
                    // current and next step
                    $this->_view->setValue( "currentStep", $step );
                    $this->_view->setValue( "nextStep", $step+1 );                
                    // whether this transformer is ready
                    $this->_view->setValue( "complete", $complete );
                    // transformer id
                    $this->_view->setValue( "transformerId", $this->currentTransformerId );
                }            
                else {
                    // have we already been through all transformers?
                    //print("transformer complete! - num transformers = ".count($this->transformers)."<br/>");
                    $moreTransformers = ( $this->currentTransformerId+1 < count( $this->transformers ));
                    if( $moreTransformers ) {
                        //print("Starting new transformer!<br/>");
                        $this->_view = new WizardView( "fix120" );
                        // current and next step
                        $this->_view->setValue( "currentStep", 0 );
                        $this->_view->setValue( "nextStep", 1 );  
                        // whether this transformer is ready
                        $this->_view->setValue( "complete", false );
                        // transformer id
                        $this->_view->setValue( "transformerId", $this->currentTransformerId+1 );
                    }
                    else {
                        // no more data to transform, we can finalize the installation!
						// delete the contents of the temporary folder
						lt_include( PLOG_CLASS_PATH."class/config/config.class.php" );
						$config =& Config::getConfig();
						$tmpFolder = $config->getValue( "temp_folder", TEMP_FOLDER );
                        WizardTools::cleanTmpFolder();

                        // User upgrade LifeType from 1.1.x to 1.2.0, they have to use "original_file_name",
                        // becasue there is no option for user to choose he want to use encoded file name
                        // or original file name.
                        // save the resources naming rule to config table
						$config->saveValue( "resources_naming_rule", "original_file_name" );

                        $this->_view = new WizardView( "update4" );
                    }
                }
            }

            $this->_view->setValue( "message", $message );            

            return true;
        }
    }

    // check if the "./tmp" folder is writable by us, otherwise
    // throw an error before the user gets countless errors
    // from Smarty
    if( !File::isWritable( TEMP_FOLDER ) || !File::isDir( TEMP_FOLDER )) {
        print("<span style=\"color:red; font-size: 14px;\">Error</span><br/><br/>This wizard needs the ".TEMP_FOLDER." folder to be writable by the web server user.<br/><br/>Please correct it and try again.");
        die();
    }

    //// main part ////
    $controller = new Controller( $_actionMap, "nextStep" );
    $controller->process( HttpVars::getRequest());
?>
