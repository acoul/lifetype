<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/test/helpers/testtools.class.php" );	
	lt_include( PLOG_CLASS_PATH."class/dao/userinfo.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/users.class.php" );	

	class UserInfo_Test extends LifeTypeTestCase
	{
		/**
		 * Test case for Mantis issue 1139 (http://bugs.lifetype.net/view.php?id=1139):
		 * "confirmation code is invalid"
		 *
		 * This test case will make sure that empty values of UserInfo::_siteAdmin() will always be loaded
		 * and mapped to '0' when saving to the database. It should also check that when 'false' is used
		 * in addition to '0' for this attribute, the class behaves in exactly the same way
		 */
		function testConfirmationCodeIsInvalid()
		{
			// user1, let's not set the isSiteAdmin flag and check that we return a zero and a false
			$user1 = new UserInfo( md5(rand()), "user1pwd", "user1@test.com", "", "User One" );
			$this->assertEquals( 0, $user1->isSiteAdmin(), "UserInfo::isSiteAdmin() did not return zero!" );
			$this->assertFalse( $user1->isSiteAdmin(), "UserInfo::isSiteAdmin() did not return false!" );
			
			// save this user to the database and make sure that the flag was saved as expected
			$users = new Users();
			$users->addUser( $user1 );
			// load the user
			$newUser1 = $users->getUserInfoFromId( $user1->getId());
			$this->assertEquals( 0, $newUser1->isSiteAdmin(), "UserInfo::isSiteAdmin() did not return zero after saving the user!" );
			$this->assertFalse( $newUser1->isSiteAdmin(), "UserInfo::isSiteAdmin() did not return false after saving the user!" );		
		
			// delete the test data
			TestTools::deleteDaoTestData( Array( $user1 ));
		}
	}
?>