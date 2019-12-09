<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/data/validator/httpurlvalidator.class.php" );

	/**
	 * \ingroup Test
	 *
	 * Test cases for the HttpUrlValidator_Test class
	 */
	class HttpUrlValidator_Test extends LifeTypeTestCase
	{
		var $r;
		
		function setUp()
		{
			$this->v = new HttpUrlValidator();
		}
		
		function testValidUrls()
		{
			$urls = Array(
				"http://www.lifetype.net",
				"http://www.lifetype.net/index.php?op=Default&blogId=3",
				"http://www.lifetype.net/#anchortest",
				"http://localhost/",
				"http://localhost",
				"http://127.22.45.44",
				"http://user:password@www.server.com",
				"http://user@23.44.22.12:8050/my/very/long/server/folder/.with.several.dots",
				"http://www.fi",
                "https://www.microsoft.com",
                "ftp://jondaley:password@lala.net/asd/qwe/../",
                "mailto:jondaley@test.com",
                "http://surprisingly/%20valid.too",
				"http://crazy.that.this.is.valid.too/index.php&param1=value&param2&param3",
				"http://and.me.too/index.php?param1?param2?param3",
				"http://user@badpassword@server.com",
			);
			
			foreach( $urls as $url ) {
				$this->assertTrue( $this->v->validate( $url ), "URL $url did not validate, although it is a valid one!" );
			}
		}
		
		function testInvalidUrls()
		{
			$urls = Array(
				"http://",
				"http:///",
				"http://www.....com",
				"htttp://www.server.com",
                    // we don't check for valid email addresses
                    // "mailto:jonda@ley@test.com",
                "http:notvalid.com",
                "http:///////////////canthaveconsecutiveslashesinresource.com",
                "http:notvalid.com/",
                "httzp:notvalid.com/",
                "http:/notvalid.com/",
                "http:/notvalid.com/\"",
                "http:/notvalid.com/>",
			);
			
			foreach( $urls as $url ) {
				$this->assertFalse( $this->v->validate( $url ), "URL $url was validated, although it is an invalid one!" );
			}			
		}
	}
?>