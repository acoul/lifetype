<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/trackbackclient.class.php" );

	/**
	 * \ingroup Test
	 *
	 * Test cases for the TrackbackClient class
	 */
	class TrackbackClient_Test extends LifeTypeTestCase
	{
		function setUp()
		{
			// definition of our test pages
			
			$this->page = '
<html><body>			
!-- <rdf:RDF xmlns="http://web.resource.org/cc/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
<Work rdf:about="">
	<license rdf:resource="http://creativecommons.org/licenses/by-nc-sa/2.5/" />
	<dc:type rdf:resource="http://purl.org/dc/dcmitype/Text" />
</Work>
<License rdf:about="http://creativecommons.org/licenses/by-nc-sa/2.5/"><permits rdf:resource="http://web.resource.org/cc/Reproduction"/>
	<permits rdf:resource="http://web.resource.org/cc/Distribution"/><requires rdf:resource="http://web.resource.org/cc/Notice"/>
	<requires rdf:resource="http://web.resource.org/cc/Attribution"/><prohibits rdf:resource="http://web.resource.org/cc/CommercialUse"/>
	<permits rdf:resource="http://web.resource.org/cc/DerivativeWorks"/><requires rdf:resource="http://web.resource.org/cc/ShareAlike"/></License>
</rdf:RDF> -->
<p>blah blah blah</p>
<!-- <rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
      xmlns:dc="http://purl.org/dc/elements/1.1/"
      xmlns:trackback="http://madskills.com/public/xml/rss/module/trackback/">
	<rdf:Description rdf:about="http://www.lifetype.net/blog/lifetype%2Ddevelopment%2Djournal/2007/02/14/critical%2Dsecurity%2Dissue%2Dlifetype%2D1.1.6%2Dand%2Dlifetype%2D1.2%2Dbeta2%2Dreleased"          dc:identifier="http://www.lifetype.net/blog/lifetype%2Ddevelopment%2Djournal/2007/02/14/critical%2Dsecurity%2Dissue%2Dlifetype%2D1.1.6%2Dand%2Dlifetype%2D1.2%2Dbeta2%2Dreleased"
	dc:title="Critical security issue: Lifetype 1.1.6 and Lifetype 1.2\-beta2 released"
	trackback:ping="http://www.lifetype.net/trackback.php?id=193"/></rdf:RDF> -->
</body></html>
';

			// this one has three different trackback links
			$this->page2 = '
<html><body>			
!-- <rdf:RDF xmlns="http://web.resource.org/cc/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
<Work rdf:about="">
	<license rdf:resource="http://creativecommons.org/licenses/by-nc-sa/2.5/" />
	<dc:type rdf:resource="http://purl.org/dc/dcmitype/Text" />
</Work>
<License rdf:about="http://creativecommons.org/licenses/by-nc-sa/2.5/"><permits rdf:resource="http://web.resource.org/cc/Reproduction"/>
	<permits rdf:resource="http://web.resource.org/cc/Distribution"/><requires rdf:resource="http://web.resource.org/cc/Notice"/>
	<requires rdf:resource="http://web.resource.org/cc/Attribution"/><prohibits rdf:resource="http://web.resource.org/cc/CommercialUse"/>
	<permits rdf:resource="http://web.resource.org/cc/DerivativeWorks"/><requires rdf:resource="http://web.resource.org/cc/ShareAlike"/></License>
</rdf:RDF> -->
<p>blah blah blah</p>
<!-- <rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
      xmlns:dc="http://purl.org/dc/elements/1.1/"
      xmlns:trackback="http://madskills.com/public/xml/rss/module/trackback/">
	<rdf:Description rdf:about="http://www.lifetype.net/blog/lifetype%2Ddevelopment%2Djournal/2007/02/14/critical%2Dsecurity%2Dissue%2Dlifetype%2D1.1.6%2Dand%2Dlifetype%2D1.2%2Dbeta2%2Dreleased"          dc:identifier="http://www.lifetype.net/blog/lifetype%2Ddevelopment%2Djournal/2007/02/14/critical%2Dsecurity%2Dissue%2Dlifetype%2D1.1.6%2Dand%2Dlifetype%2D1.2%2Dbeta2%2Dreleased"
	dc:title="Critical security issue: Lifetype 1.1.6 and Lifetype 1.2\-beta2 released"
	trackback:ping="http://www.lifetype.net/trackback.php?id=194"/></rdf:RDF> -->
	<!-- <rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
	      xmlns:dc="http://purl.org/dc/elements/1.1/"
	      xmlns:trackback="http://madskills.com/public/xml/rss/module/trackback/">
		<rdf:Description rdf:about="http://www.lifetype.net/blog/lifetype%2Ddevelopment%2Djournal/2007/02/14/critical%2Dsecurity%2Dissue%2Dlifetype%2D1.1.6%2Dand%2Dlifetype%2D1.2%2Dbeta2%2Dreleased"          dc:identifier="http://www.lifetype.net/blog/lifetype%2Ddevelopment%2Djournal/2007/02/14/critical%2Dsecurity%2Dissue%2Dlifetype%2D1.1.6%2Dand%2Dlifetype%2D1.2%2Dbeta2%2Dreleased"
		dc:title="Critical security issue: Lifetype 1.1.6 and Lifetype 1.2\-beta2 released"
		trackback:ping="http://www.lifetype.net/trackback.php?id=193"/></rdf:RDF> -->
		<!-- <rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
		      xmlns:dc="http://purl.org/dc/elements/1.1/"
		      xmlns:trackback="http://madskills.com/public/xml/rss/module/trackback/">
			<rdf:Description rdf:about="http://www.lifetype.net/blog/lifetype%2Ddevelopment%2Djournal/2007/02/14/critical%2Dsecurity%2Dissue%2Dlifetype%2D1.1.6%2Dand%2Dlifetype%2D1.2%2Dbeta2%2Dreleased"          dc:identifier="http://www.lifetype.net/blog/lifetype%2Ddevelopment%2Djournal/2007/02/14/critical%2Dsecurity%2Dissue%2Dlifetype%2D1.1.6%2Dand%2Dlifetype%2D1.2%2Dbeta2%2Dreleased"
			dc:title="Critical security issue: Lifetype 1.1.6 and Lifetype 1.2\-beta2 released"
			trackback:ping="http://www.lifetype.net/trackback.php?id=195"/></rdf:RDF> -->			
</body></html>
';

			// this one has no valid trackback tags
			$this->page3 = '
<html><body>			
!-- <rdf:RDF xmlns="http://web.resource.org/cc/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
<Work rdf:about="">
	<license rdf:resource="http://creativecommons.org/licenses/by-nc-sa/2.5/" />
	<dc:type rdf:resource="http://purl.org/dc/dcmitype/Text" />
</Work>
<License rdf:about="http://creativecommons.org/licenses/by-nc-sa/2.5/"><permits rdf:resource="http://web.resource.org/cc/Reproduction"/>
	<permits rdf:resource="http://web.resource.org/cc/Distribution"/><requires rdf:resource="http://web.resource.org/cc/Notice"/>
	<requires rdf:resource="http://web.resource.org/cc/Attribution"/><prohibits rdf:resource="http://web.resource.org/cc/CommercialUse"/>
	<permits rdf:resource="http://web.resource.org/cc/DerivativeWorks"/><requires rdf:resource="http://web.resource.org/cc/ShareAlike"/></License>
</rdf:RDF> -->
<p>blah blah blah</p>
</body></html>
';

		}
		
		function testGetTrackbackLinks()
		{	
			// get the trackback links from the given page
			$links = TrackbackClient::getTrackbackLinks( $this->page );
			
			// there should only be one link
			$this->assertEquals( 1, count( $links ), "There was more than one trackback link detected in the test page!" );
			
			// and that it is equal to the value that we're expecting
			$this->assertEquals( "http://www.lifetype.net/trackback.php?id=193", $links[0], "The returned trackback link was not the expected one!" );
		}
		
		function testGetMultipleTrackbackLinks()
		{
			// get the trackback links from the given page
			$links = TrackbackClient::getTrackbackLinks( $this->page2 );
			
			// there should only be one link
			$this->assertEquals( 3, count( $links ), "There was not 3 trackback links detected in the test page!" );
			
			// and that it is equal to the value that we're expecting
			$this->assertEquals( "http://www.lifetype.net/trackback.php?id=194", $links[0], "The returned trackback link was not the expected one!" );
			$this->assertEquals( "http://www.lifetype.net/trackback.php?id=193", $links[1], "The returned trackback link was not the expected one!" );			
			$this->assertEquals( "http://www.lifetype.net/trackback.php?id=195", $links[2], "The returned trackback link was not the expected one!" );						
		}
		
		function testNoTrackbackLinks()
		{
			// get the trackback links from the given page
			$links = TrackbackClient::getTrackbackLinks( $this->page3 );
			
			// there should only be one link
			$this->assertEquals( 0, count( $links ), "There shouldn't be any trackback links detected in this page!" );			
		}
		
		function testTrackbackLinksWithDashes()
		{
			// get the trackback links from the given page
			$links = TrackbackClient::getTrackbackLinks( $this->page, "http://www.lifetype.net/blog/lifetype-development-journal/2007/02/14/critical-security-issue-lifetype-1.1.6-and-lifetype-1.2-beta2-released" );
			
			// there should only be one link
			$this->assertEquals( 1, count( $links ), "There was more than one trackback link detected in the test page!" );
			
			// and that it is equal to the value that we're expecting
			$this->assertEquals( "http://www.lifetype.net/trackback.php?id=193", $links[0], "The returned trackback link was not the expected one!" );			
		}
	}
?>