<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/userinfo.class.php" );		
	lt_include( PLOG_CLASS_PATH."class/dao/users.class.php" );	
	lt_include( PLOG_CLASS_PATH."class/dao/userstatus.class.php" );	
	lt_include( PLOG_CLASS_PATH."class/summary/data/summarytools.class.php" );

	/**
	 * \ingroup Test
	 *
	 * Test case for the SummaryTools class
	 */
	class SummaryTools_Test extends LifeTypeTestCase
	{
		function setUp()
		{
			// build a dummy user									
			$this->u = new UserInfo( "test", // username
			                         "test", // password 
			                         "test@test.com", // email
			                         "", // about myself 
			                         "full name" // full name
			                       );
			$users = new Users();
			$users->addUser( $this->u );
		}
		
		function tearDown()
		{
			$users = new Users();
			$users->deleteUser( $this->u->getId());
		}
		
		/**
		 * Mantis case 1035: http://bugs.lifetype.net/view.php?id=1035
		 * Users can reactive themselves by clicking the confirmation link that was sent to them
		 * via email.
		 * This test case sets our user as disabled and makes sure that SummaryTools::VerifyRequest()
		 * returns false
		 */
		function testVerifyRequestIgnoreNonActiveUsers()
		{
			// update the user
			$this->u->setStatus( USER_STATUS_DISABLED );
			$users = new Users();
			$users->updateUser( $this->u );
			
			// make sure it isn't returned
			$userNameHash = md5($this->u->getUserName());
			$requestHash  = SummaryTools::calculatePasswordResetHash( $this->u );
			$this->assertFalse( SummaryTools::VerifyRequest( $userNameHash, $requestHash ));
		}		
		
		/**
		 * Make sure that active users are included
		 */
		function testVerifyRequestActiveUsers()
		{
			// update the user
			$this->u->setStatus( USER_STATUS_ACTIVE );
			$users = new Users();
			$users->updateUser( $this->u );
			
			// make sure it isn't returned
			$userNameHash = md5($this->u->getUserName());
			$requestHash  = SummaryTools::calculatePasswordResetHash( $this->u );
			$this->assertTrue( SummaryTools::VerifyRequest( $userNameHash, $requestHash ));
		}		
	}
?>