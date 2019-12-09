<?php

	lt_include( PLOG_CLASS_PATH."class/test/helpers/lifetypetestcase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/net/url.class.php" );

	/**
	 * \ingroup Test
	 *
	 * Test case for the Url class
	 */
	class Url_Test extends LifeTypeTestCase
	{
		var $url;
			
		function setUp()
		{
			$this->url = new Url( "http://user:password@www.test-server.com:8080/path/to/script/test.php?param1=value1&param2=value2#fragment" );
		}
		
		function testGetHost()
		{
			$this->assertEquals( "www.test-server.com", $this->url->getHost());
		}
		
		function testGetUser()
		{
			$this->assertEquals( "user", $this->url->getUser());
		}
		
		function testGetPass()
		{
			$this->assertEquals( "password", $this->url->getPass());
		}
		
		function testGetPort()
		{
			$this->assertEquals( "8080", $this->url->getPort());
		}
		
		function testGetPath()
		{
			$this->assertEquals( "/path/to/script/test.php", $this->url->getPath());
		}
		
		function testGetQuery()
		{
			$this->assertEquals( "param1=value1&param2=value2", $this->url->getQuery());
		}
		
		function testGetFragment()
		{
			$this->assertEquals( "fragment", $this->url->getFragment());
		}
		
		function testSetHost()
		{
			$this->url->setHost( "www.lifetype.net" );
			$this->assertEquals( "www.lifetype.net", $this->url->getHost());
		}
		
		function testSetQuery()
		{
			$this->url->setQuery( "a=b&c=d" );
			$this->assertEquals( "a=b&c=d", $this->url->getQuery());
		}
		
		function testSetPath()
		{
			$this->url->setPath( "/blog.php/development_blog" );
			$this->assertEquals( "/blog.php/development_blog", $this->url->getPath());
		}
	}
?>