<?php
	class Installation
	{
	    function check()
	    {
	    	include_once( PLOG_CLASS_PATH."config/config.properties.php" );
	
		    if ( $config["db_host"] == '' || $config["db_username"] == '' || $config["db_database"] == '' ) {
		    	// If those parameters are empty
		    	echo 'LifeType has not been installed yet, you\'ll have to <font color="red"><b><a href="wizard.php" title="Install LifeType">Install LifeType</a></b></font> first!';
		    } else {
		    	echo 'The <font color="red"><b>wizard.php</b></font> has to be removed after the installation process. Please remove it first to <font color="green"><b><a href="'.$_SERVER['PHP_SELF'].'" title="'.end( split( "/", $_SERVER['PHP_SELF'] ) ).'">continue</a></b></font>.';
		    }
	    
	    	die();
	    }
	}
?>