<?php

	lt_include( PLOG_CLASS_PATH."class/logger/LogUtil.php" );
	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );

	class LoggerUtil_Test extends LifeTypeTestCase 
	{
	    function testFormat() 
		{			
	        // test integer
	        $var = 1;
	        $this->assertEquals("1", LogUtil::format($var));

	        // test string
	        $var = "test";
	        $this->assertEquals("test",LogUtil::format($var));

	        // test boolean
	        $var = true;
	        $this->assertEquals("TRUE",LogUtil::format($var));
	    }
	}
?>

