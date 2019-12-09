<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/data/textfilter.class.php" );
	lt_include( PLOG_CLASS_PATH."class/config/config.class.php" );

	/**
	 * \ingroup Test
	 *
	 * Test cases for the Textfilter class
	 */
	class Textfilter_Test extends LifeTypeTestCase
	{
		function setup()
		{
			$this->tf = new Textfilter();
		}
		
		/**
		 * Verifies the 'slugify' method
		 */
		function testSlugify()
		{
			// load the value of the default separator
			$config =& Config::getConfig();
            $sep = $config->getValue( "urlize_word_separator", URLIZE_WORD_SEPARATOR_DEFAULT );			
			
			$tests = Array(  // associative array where the key is the input and the value is the expected output
				"simple" => "simple",
				"two words" => "two{$sep}words",
				"two  spaces" => "two{$sep}spaces",
				"   leadingblanks" => "leadingblanks",
				"trailingblanks  " => "trailingblanks",
				"!@#extraseparators'''" => "extraseparators",
				"<a>html</a><b>is</b><h1>not</h1><p>allowed</p>"
                 => "htmlisnotallowed",
				"unclosed < html</a><b >shouldn't </b>be<h1> <p>stripped</p>"
                 => "unclosed{$sep}htmlshouldn{$sep}t{$sep}be{$sep}stripped",
                "SOME uppercase CHARAcTERS" => "some{$sep}uppercase{$sep}characters" );
				
			// process each one of them
			foreach( $tests as $input => $output ) {
				$result = $this->tf->slugify( $input );
				$this->assertEquals( $output, $result );
			}
		}
		
		/**
		 * Verifies the domainize() method
		 */
		function testDomainize()
		{
			// load the value of the default separator
			$config =& Config::getConfig();
            $sep = $config->getValue( "urlize_word_separator", URLIZE_WORD_SEPARATOR_DEFAULT );			
			
			// set of input values and their expected output
			$tests = Array(
				"TesT BlOg" => "test{$sep}blog",
				"test-blog" => "test{$sep}blog",
				"test_blog" => "test{$sep}blog",
				"test.blog" => "test.blog",
				"??test//blog" => "test{$sep}blog",
				"==================test blog" => "test{$sep}blog",
				"this.has.dots_and-hyphens----and   spaces		    " => "this.has.dots{$sep}and{$sep}hyphens{$sep}and{$sep}spaces"
			);
			
			foreach( $tests as $input => $output ) {
				$result = $this->tf->domainize( $input );
				$this->assertEquals( $output, $result, "input was: $input" );
			}
		}

		/**
		 * Verifies the urlize() method
		 */
		function testUrlize()
		{
			// load the value of the default separator
			$config =& Config::getConfig();
            $sep = $config->getValue( "urlize_word_separator", URLIZE_WORD_SEPARATOR_DEFAULT );			
			
			// set of input values and their expected output
			$tests = Array(
				"teSt blog" => "test{$sep}blog",
				"test-blog" => "test-blog",
				"test_blog" => "test_blog",
				"test.blog" => "test.blog",
				"??test//blog" => "test{$sep}blog",
				"==================test blog" => "test{$sep}blog",
				"this.has.dots_and-hyphens----and   spaces		    " => "this.has.dots_and-hyphens{$sep}and{$sep}spaces",
				"multiple__underscores______" => "multiple__underscores______"
			);
			
			foreach( $tests as $input => $output ) {
				$result = $this->tf->urlize( $input );
				$this->assertEquals( $output, $result, "input was: $input" );
			}
		}

        
		/**
		 * tests the htmlDecode() method
		 */
		function testHtmlDecode()
		{
			// array with strings and the expected result, the key is the
			// input and the value is the expected output, add more if needed
			$tests = Array(
				"&lt;" => "<",
				"&amp;" => "&",
				"test" => "test",
				"&aacute;&eacute;" => "áé",
				"&auml;&Uuml;" => "äÜ"
			);
			
			foreach( $tests as $input => $output ) {
				// check that the input is equal to the output after processing it with TextFilter::htmlDecode
				$this->assertEquals( $output, TextFilter::htmlDecode( $input ), "Error htmlDecode()-ing string: $input" );
				// and that htmlDecode and filterHTMLEntities are really the opposite of each other
				$this->assertEquals( $input, Textfilter::htmlDecode( TextFilter::filterHTMLEntities( $input )));
				$this->assertEquals( $output, Textfilter::htmlDecode( TextFilter::filterHTMLEntities( $output )));
			}
		}

		/**
		 * tests the htmlDecode() method
		 */
		function testHtmlFilter()
		{
			// array with strings and the expected result, the key is the
			// input and the value is the expected output, add more if needed
			$tests = Array(
				" this is  a plain text comment " => " this is  a plain text comment ",
				"some <a>html</a><b>is</b><h1>not</h1><p>allowed</p>" =>
                   "some <a>html</a><b>is</b>not<p>allowed</p>",
				"1 non-html like < is ok" => "1 non-html like < is ok",
				"2 non-html like > is ok" => "2 non-html like > is ok",
				"3 non-html like <are unfortunately not ok due to strip_tags" => "3 non-html like ",
				"4 non-html like >is ok" => "4 non-html like >is ok",
				"5 non-html like<are unfortunately not ok due to strip_tags" => "5 non-html like",
				"6 non-html like>is ok" => "6 non-html like>is ok",
				"<3 is fine." => "&lt;3 is fine.",
				"so is <31231." => "so is &lt;31231.",
				"Unclosed tags should be <i> closed" => "Unclosed tags should be <i> closed</i>",
				"Unclosed tags should be <p>closed" => "Unclosed tags should be <p>closed</p>",
				"NULL tags <> shouldn't be removed" => "NULL tags &lt;&gt; shouldn't be removed",
				"Empty tags < > should not crash." => "Empty tags &lt; &gt; should not crash.",
				"Weird tags <asd > aren't ok." => "Weird tags  aren't ok.",
				"Weird tags <asd> aren't ok." => "Weird tags  aren't ok.",
				"Other HTML is not <h1> <p>allowed</p></h1>" => "Other HTML is not  <p>allowed</p>",
				"HTML comments?<!-- aren't allowed" => "HTML comments?",
				"Things that look like HTML comments?< !-- are ok." => "Things that look like HTML comments?< !-- are ok.",
				"&amp;" => "&amp;",
			);
			
			foreach( $tests as $input => $output ) {
				$this->assertEquals( $output, TextFilter::filterHtml( $input ) );
			}
		}

    }
?>