<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/permission.class.php" );
	lt_include( PLOG_CLASS_PATH."class/dao/permissions.class.php" );

	/**
	 * \ingroup Test
	 *
	 * Test cases for the Permissions class
	 */
	class Permissions_Test extends LifeTypeTestCase
	{
		function testAddPermission()
		{
			$perm = new Permission( "test_perm", "test_perm_desc" );
			$perm->setAdminOnlyPermission( false );
			$perm->setCorePermission( true );
			$perms = new Permissions();
			
			// check that it was correctly added
			$this->assertTrue( $perms->addPermission( $perm ), "Error adding new permission" );
			
			// check that the object got its id set correctly
			$this->assertTrue( ($perm->getId() != -1 ), "New permission still has id = -1" );
			
			// check that it can be loaded from the database
			$newPerm = $perms->getPermission( $perm->getId());
			$this->assertTrue( $newPerm, "Error loading the new category from the database" );
			
			// and that the object contains the same values
			$this->assertEquals( $perm->getName(), $newPerm->getName(), "new permission is not the same as original" );
			$this->assertEquals( $perm->getDescription(), $newPerm->getDescription(), "new permission is not the same as original" );
			$this->assertEquals( $perm->isAdminOnlyPermission(), $newPerm->isAdminOnlyPermission(), "new permission is not the same as original" );
			$this->assertEquals( $perm->isCorePermission(), $newPerm->isCorePermission(), "new permission is not the same as original" );

			$this->assertTrue( $perms->deletePermission( $perm->getId()), "There was an error deleting the permission" );			

		}
		
		function testGetPermission()
		{
			// first part of the test is the same as testAddPermission
			$this->testAddPermission();
			
			// while in the second half we test for errors
			$perms = new Permissions();
			$this->assertFalse( $perms->getPermission( 12312312311 ), "Permission should not have been found" );	
			$this->assertFalse( $perms->getPermission( "blah" ), "Permission should not have been found" );				
		}
		
		function testGetPermissions()
		{
			// load all permissions and check at least that it's an array
			// :TODO: We could probably improve this test
			$perm = new Permission( "to_be_deleted", "this will be deleted" );
			$perms = new Permissions();
			
			// check that it was correctly added
			$this->assertTrue( $perms->addPermission( $perm ), "Error adding new permission" );
			
			// try to load all permissions, there should at least be one member in the array
			$allPerms = $perms->getAllPermissions();
			$this->assertTrue( (count($allPerms) > 0 ), "getAllPermissions did not return all permissions" );
			// make sure that the one we just got is one of them
			$found = false;
			$i = 0;
			while( !$found && $i < count($allPerms)) {
				$found = ($allPerms[$i]->getId() == $perm->getId());
				$i++;
			}
			$this->assertTrue( $found, "Could not locate new permission after calling getAllPermissions" );
			
			// we don't need it anymore, let's delete it
			$this->assertTrue( $perms->deletePermission( $perm->getId()), "There was an error deleting the permission" );			
		}
		
		function testDeletePermission()
		{
			$perm = new Permission( "to_be_deleted", "this will be deleted" );
			$perms = new Permissions();
			
			// check that it was correctly added
			$this->assertTrue( $perms->addPermission( $perm ), "Error adding new permission" );			
			
			// now try to delete it
			$this->assertTrue( $perms->deletePermission( $perm->getId()), "There was an error deleting the permission" );
			
			// and finally check that it isn't there anymore
			$this->assertFalse( $perms->getPermission( $perm->getId(), "Deleted permission was still loaded again" ));	
		}
		
		function testGetPermissionByName()
		{
			// test that a non-existant permission returns false
			$perms = new Permissions();
			$this->assertFalse( $perms->getPermissionByName( "afadsfasdfasfasdfasfs" ), "This permission should not exist" );	
			
			// add a test permission and see that it can be retrieved later on by name
			$perm = new Permission( "to_be_retrieved", "this will be deleted" );
			$perms = new Permissions();
			
			// check that it was correctly added
			$this->assertTrue( $perms->addPermission( $perm ), "Error adding new permission" );			
			
			// retrieve it by name
			$newPerm = $perms->getPermissionByName( "to_be_retrieved" );
			$this->assertTrue( $newPerm, "It was not possible to retrieve the permission by name" );
			
			// check that it is the same
			$this->assertEquals( $perm->getId(), $newPerm->getId(), "Permission retrieved by name did not match" );
			
			// and delete it
			$this->assertTrue( $perms->deletePermission( $perm->getId()), "There was an error deleting the permission" );			
		}
	}
?>