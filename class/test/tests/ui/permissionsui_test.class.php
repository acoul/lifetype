<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/test/helpers/testtools.class.php" );	
	lt_include( PLOG_CLASS_PATH."class/dao/permissions.class.php" );
	
	/**
	 * \ingroup Test
	 */
	class PermissionsUI_Test extends LifeTypeTestCase
	{
		var $user;
		var $blog;
		
		function setUp()
		{
			$this->user = TestTools::createAdminUser();

			$this->blog = TestTools::createBlog( $this->user->getId());
		}
		
		function tearDown()
		{
			TestTools::deleteDaoTestData( Array( $this->user ));
			TestTools::deleteBlog( $this->blog );
		}
		
		/**
		 * Test that core permissions cannot be deleted via the user interface
		 */
		function testCorePermissions()
		{
			$permName = "perm_".TestTools::getRandomWord( 20, false, false );

			// login
			$this->assertUIScript(
				Array(
					"login" => Array(
						"url" => $this->getAdminUrl(),
						"type" => "post",
						"params" => Array(
							"userName" => $this->user->getUserName(),
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
					)
				)
			);
			
			// go the "new permission" page and add a new one
			$this->assertUIScript(
				Array(			
					"new_permission" => Array(
						"url" => $this->getAdminUrl(),
						"type" => "get",
						"params" => Array( "op" => "newPermission" ),
						"expected" => "Unique name for the permission",
						"message" => "The form to input a new permission was not successfully displayed"
					),
					"create_permission" => Array(
						"url" => $this->getAdminUrl(),
						"type" => "post",
						"params" => Array( "permissionName" => $permName, "permissionDescription" => "$permName description", "corePermission" => "1", "op" => "addPermission" ),
						"expected" => "Permission added",
						"message" => "The test permission was not successully added"
					)
				)
			);
			
			// find the permission in the db...
			$perms = new Permissions();
			$perm = $perms->getPermissionByName( $permName );
			
			if( !$perm ) {
                print "FATAL: The permission was not successfully added and the test cannot continue";
                return;
			}
			
			// ...and delete it via the UI
			$this->assertUIScript(
				Array(
					"delete_permission" => Array(
						"url" => $this->getAdminUrl(),
						"type" => "get",
						"params" => Array( "permId" => $perm->getId(), "op" => "deletePermission" ),
						"expected" => "Permission \"".$perm->getName()."\" cannot be deleted",
						"message" => "The user interface allowed to delete a core permission!"
					)					
				)
			);
			
			// delete the permission via the API
			$res = $perms->deletePermission( $perm->getId() );
            $this->assertTrue($res, "Couldn't delete core permission via API");
		}
		
		/**
		 * Test permissions
		 */
		function testPermissions()
		{
			$permName = "perm_".TestTools::getRandomWord( 20 );
			
			// login
			$this->assertUIScript(
				Array(
					"login" => Array(
						"url" => $this->getAdminUrl(),
						"type" => "post",
						"params" => Array(
							"userName" => $this->user->getUserName(),
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
					)
				)
			);
			
			// go the "new permission" page and add a new one
			$this->assertUIScript(
				Array(			
					"new_permission" => Array(
						"url" => $this->getAdminUrl(),
						"type" => "get",
						"params" => Array( "op" => "newPermission" ),
						"expected" => "Unique name for the permission",
						"message" => "The form to input a new permission was not successfully displayed"						
					),
					"create_permission" => Array(
						"url" => $this->getAdminUrl(),
						"type" => "post",
						"params" => Array( "permissionName" => $permName, "permissionDescription" => "$permName description", "adminOnlyPermission" => "1", "op" => "addPermission" ),
						"expected" => "Permission added",
						"message" => "The test permission was not successully added"
					)
				)
			);
			
			// find the permission in the db...
			$perms = new Permissions();
			$perm = $perms->getPermissionByName( $permName );
			
			if( !$perm ) {
				print "FATAL: The permission was not successfully added and the test cannot continue";
                return;
			}
			
			// ...and delete it via the UI
			$this->assertUIScript(
				Array(
					"delete_permission" => Array(
						"url" => $this->getAdminUrl(),
						"type" => "get",
						"params" => Array( "permId" => $perm->getId(), "op" => "deletePermission" ),
						"expected" => "Permission \"".$perm->getName()."\" was deleted",
						"message" => "The permission was not deleted!"
					),
					"delete_permission_again" => Array(
						"url" => $this->getAdminUrl(),
						"type" => "get",
						"params" => Array( "permId" => $perm->getId(), "op" => "deletePermission" ),
						"expected" => "There was an error deleting permission",
						"message" => "The user interface allowed to delete the test permission twice"
					)										
				)
			);
		}		
	}
?>