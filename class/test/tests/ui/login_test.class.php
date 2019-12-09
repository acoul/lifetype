<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/test/helpers/testtools.class.php" );	
    lt_include( PLOG_CLASS_PATH."class/dao/userpermissions.class.php" );
    lt_include( PLOG_CLASS_PATH."class/dao/permissions.class.php" );
	
	/**
	 * \ingroup Test
	 */
	class Login_Test extends LifeTypeTestCase
	{
		function setUp()
		{
			$this->user = TestTools::createUser();
			$this->user2 = TestTools::createUser();
			$this->user3 = TestTools::createUser();

			$userPerms = new UserPermissions();

            $perms = new Permissions();
            $loginAccess = $perms->getPermissionByName( "login_perm" );
            if($loginAccess === false){
				print "Error getting login permission id";
                return;
            }

                // Revoke user login privileges
            if(!$userPerms->revokePermission( $this->user->getId(), 0, $loginAccess->getId())){
				print "Error revoking login permissions from user";
            }

            $this->blog = TestTools::createBlog( $this->user2->getId());
		}
		
		function tearDown()
		{
			TestTools::deleteDaoTestData( Array( $this->user, $this->user2, $this->user3 ));
			TestTools::deleteBlog( $this->blog );
		}
		
		/**
		 * check that the login page is working as expected
		 */
		function testLoginPage()
		{
			$this->assertUIScript(
				Array(
					"login_page" => Array(
						"url" => $this->getAdminUrl(),
						"type" => "get",
						"expected" => "Welcome to LifeType",
						"message" => "The login screen did not display the right message"
					)
				)
			);
		}
		
		/**
		 * Test that a user without login privileges cannot login
		 */
		function testUserDoesntHaveLoginPrivileges()
		{
			$this->assertUIScript(
				Array(
					"login_page" => Array(
						"url" => $this->getAdminUrl(),
						"type" => "post",
						"params" => Array(
							"userName" => $this->user->getUserName(),
							"userPassword" => "password",
							"op" => "Login"
						),
						"expected" => "you are not allowed to log in",
						"message" => "User was able to login without login privileges!!"
					)
				)
			);			
		}

        		/**
		 * Test that a user without a blog cannot login
		 */
		function testUserHasNoBlog()
		{
			$this->assertUIScript(
				Array(
					"login_page" => Array(
						"url" => $this->getAdminUrl(),
						"type" => "post",
						"params" => Array(
							"userName" => $this->user3->getUserName(),
							"userPassword" => "password",
							"op" => "Login"
						),
						"expected" => "you do not belong to any blog yet",
						"message" => "User was not warned that he did not belong to any blog yet"
					)
				)
			);			
		}

		/**
		 * Test the whoe login and logout process
		 */
		function testLoginLogout()
		{
			$this->assertUIScript(
				Array(
					"login" => Array(
						"url" => $this->getAdminUrl(),
						"type" => "post",
						"params" => Array(
							"userName" => $this->user2->getUserName(),
							"userPassword" => "password",
							"op" => "Login"
						),
						"expected" => "Dashboard",
						"message" => "The dashboard did not appear when logging in"
					 ),
					"select_blog" => Array(
						"url" => $this->getAdminUrl(),
						"type" => "get",
						"params" => Array(
							"op" => "blogSelect",
							"blogId" => $this->blog->getId()
						),
                        "expected" => "<b><a href=\"?op=newPost\">New Post",
						"message" => "The blog could not be selected after the dashboard"
					),
					"logout" => Array(
						"url" => $this->getAdminUrl(),
						"type" => "get",
						"params" => Array( "op" => "Logout" ),
						"expected" => "You have been successfully logged out",
						"message" => "The logout screen was not displayed correctly"
					)
				)
			);						
		}
	}
?>