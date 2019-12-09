<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/config/config.class.php" );

	/**
	 * \ingroup Test
	 *
	 * Regression test for the SQL injection vulnerabilities that were fixed
	 * in LT 1.0.5 and 1.0.6.
	 */
	class SQLInjection_Test extends LifeTypeTestCase
	{
		var $url;
		
		function setUp()
		{
			// get the base url of the current installation
			$config =& Config::getConfig();
			$this->url = $config->getValue( "base_url" )."/index.php";
		}
		
		function testArticleIdInjection()
		{
			// this one should return a page with an error message
			$url = $this->url."?op=ViewArticle&blogId=1&articleId=".urlencode("9999/**/UNION/**/SELECT/**/password, 1,1,1,1,1,1,1/**/FROM/**/lt_users/**/WHERE/**/id=1/*");
			
			$this->assertHTTPResponseContains( $url, "The article you specified could not be found" );
		}		
	}	
?>