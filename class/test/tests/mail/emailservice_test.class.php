<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/mail/emailservice.class.php" );

	/**
	 * \ingroup Test
	 *
	 * Test LifeType's email sending functionality
	 */
	class EmailService_Test extends LifeTypeTestCase
	{
		function setUp()
		{
			$this->service = new EmailService();
		}
		
		function testSend()
		{
			// build and email message and see that it is set correctly
			$m = new EmailMessage();
			$m->setFrom( "lifetype-test@lifetype.net" );
			$m->setSubject( "Test message" );
			$m->addTo( "please_set@please.set" );
			$m->setBody( "This is a test message!" );
			$m->setCharset( "iso-8859-1" );
			
			$this->assertTrue( $this->service->sendMessage( $m ), $this->service->getLastErrorMessage());
		}
	}
?>