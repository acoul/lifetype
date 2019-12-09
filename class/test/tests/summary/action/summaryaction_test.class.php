<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );

	/**
	 * \ingroup Test
	 *
	 * Test case for the SummaryAction class, such as verifying that setting the
	 * language based on the "lang" parameter in summary.php works as expected
	 */
	class SummaryAction_Test extends LifeTypeTestCase
	{
		/**
		 * Mantis case 985: http://bugs.lifetype.net/view.php?id=985
		 * Verifies that the "lang" parameter works also in the front page. It checks
		 * this by requesting summary.php using the es_ES locale and checking that
		 * the returned content contains one particular string (that is part of the
		 * Spanish locale)
		 */
		function testLanguageChangeViaLangParameterInRequest()
		{
			lt_include( PLOG_CLASS_PATH."class/config/config.class.php" );
			$config =& Config::getConfig();
			
			$url = $config->getValue( "base_url" )."/summary.php";
			
			// first set it to Spanish
			$this->assertHTTPResponseContains( $url."?lang=es_ES", "Bitácoras nuevas", "Unable to change the locale in summary.php via the 'lang' parameter!" );
			// and then back to english again
			$this->assertHTTPResponseContains( $url."?lang=en_UK", "Newest Blogs", "Unable to change the locale in summary.php via the 'lang' parameter!" );
		}		
	}
?>