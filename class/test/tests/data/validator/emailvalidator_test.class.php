<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/data/validator/emailvalidator.class.php" );

	/**
	 * \ingroup Test
	 *
	 * Test case for the EmailValidator class
	 */
	class EmailValidator_Test extends LifeTypeTestCase
	{
		function setUp()
		{
			// a signed and an unsigned validator
			$this->v = new EmailValidator();
		}
		
		/**
		 * domain with only numbers
		 */
		function testDomainOnlyNumbers()
		{
			$this->assertTrue( $this->v->validate( "whatever@123.com" ));
		}
		
		/**
		 * blanks in the address without double quotes
		 */
		function testWithBlanksInAddressWithoutQuotes()
		{
			$this->assertFalse( $this->v->validate( "this does not@work.com" ));
		}
		
		/**
		 * blanks in the address without double quotes
		 */
		function testWithBlanksInAddressWithQuotes()
		{
			$this->assertTrue( $this->v->validate( "\"this should \"@work.com" ));
		}		
		
		/**
		 * normal address
		 */
		function testNormal()
		{
			$this->assertTrue( $this->v->validate( "normal@address.com" ));			
		}
		
		/**
		 * domain is an IP address
		 */
		function testDomainWithIPAddress()
		{
			$this->assertTrue( $this->v->validate( "address@124.33.12.10" ));
			$this->assertTrue( $this->v->validate( "address@[124.33.12.10]" ));			
		}
		
		/**
		 * domain is not a valid IP address
		 */
		function testDomainWithInvalidIPAddress()
		{
			$this->assertFalse( $this->v->validate( "address@259.445.343.4" ));
			$this->assertFalse( $this->v->validate( "address@259.445.343.4]" ));			
			$this->assertFalse( $this->v->validate( "address@[259.445.343.4]" ));
		}
		
		/**
		 * domain has dashes in the name
		 */
		function testDomainWithDashes()
		{
			$this->assertTrue( $this->v->validate( "address@my-domain-with-dashes.com" ));
			$this->assertFalse( $this->v->validate( "address@my-domain-with-dashes-.com" ));
			$this->assertFalse( $this->v->validate( "address@-my-domain-with-dashes.com" ));
		}
		
		/**
		 * address with dashes
		 */
		function testAddressWithDashes()
		{
			$this->assertTrue( $this->v->validate( "address-with-dashes@domain.com" ));
			$this->assertTrue( $this->v->validate( "address-with-dashes-@domain.com" ));
		}
		
		/**
		 * domain has several subdomains
		 */
		function testDomainWithSeveralSubdomains()
		{
			$this->assertTrue( $this->v->validate( "address@my.domain.with.several.subdomains.com" ));
		}
		
		/**
		 * test an empty address
		 */
		function testEmptyAddress()
		{
			$this->assertFalse( $this->v->validate( "\" \"@domain.com" ));
			$this->assertFalse( $this->v->validate( " @domain.com" ));			
		}
	}
?>