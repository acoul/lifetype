<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/data/validator/blognamevalidator.class.php" );

	/**
	 * \ingroup Test
	 *
	 * Test case for the BlogNameValidator class
	 */
	class BlogNameValidator_Test extends LifeTypeTestCase
	{
		function setUp()
		{
			// create a username validator
			$this->b = new BlogNameValidator();
		}
		
		/**
		 * tests that an empty username does not validate
		 */
		function testEmptyBlogname()
		{
			$this->assertFalse( $this->b->validate( "" ), "An empty blogname did not generate an error!" );
		}
		
		/**
		 * tests that a forbidden username does not validate
		 */
		function testForbiddenBlognameRegexps()
		{
			// get the list of forbidden words, based on our configuration settings
			lt_include( PLOG_CLASS_PATH."class/config/config.class.php" );
			$config =& Config::getConfig();
			
			// blog names starting with 'a' and ending with 'b'
			$forbiddenBlognames = $config->setValue( "forbidden_blognames", "^a.*" );
			
			$b = new BlogNameValidator();			
			$this->assertFalse( $b->validate( "a-this should not work" ), "A forbidden blogname should not be accepted as valid!" );
			$this->assertTrue( $b->validate( "-this should work" ), "A valid blogname was not accepted as valid!" );
		}
		
		/**
		 * tests a valid username
		 */
		function testValidBlogname()
		{
			$this->assertTrue( $this->b->validate( "whatever" ), "A valid blogname was not accepted!" );
		}
		
		/**
		 * test a blog name that one domainized will return empty
		 */
		function testInvalidBlogName()
		{
			if( Subdomains::getSubdomainsEnabled() )
				$this->assertFalse( $this->b->validate( "//::--", "The domainized() version of the blog name returned empty but the name not accepted." ));
			else
				$this->assertTrue( $this->b->validate( "//::--", "The domainized() version of the blog name returned empty but the name was accepted as valid." ));
		}
		
		/**
		 * Test a blog name whose contents if pure HTML
		 */
		function testHTMLBlogNameOnly()
		{
			$this->assertFalse( $this->b->validate( "<h1></h1>", "A blog name containing HTML code only was accepted as valid" ));
		}

		/**
		 * Test a blog name with double byte characters, like Chinese
		 */
		function testDoubleByteBlogNameOnly()
		{
			if( Subdomains::getSubdomainsEnabled() )
				$this->assertFalse( $this->b->validate( "台北教會", "A blog name containing double byte characters was not accepted." ));
			else
				$this->assertTrue( $this->b->validate( "台北教會", "A blog name containing double byte characters was accepted as valid." ));
		}
	}
?>