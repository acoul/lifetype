<?php

	lt_include( PLOG_CLASS_PATH."class/cache/basecacheprovider.class.php" );


	/**
	 * \ingroup Cache
	 *
	 * Support for caching via xcache
	 */
    class LtXCache extends BaseCacheProvider
    {
        
        var $lifeTime;

        function LtXCache( $cacheProperties )
        {
			$this->BaseCacheProvider();
            $this->lifeTime = $cacheProperties['life_time'];
        }

		function setLifeTime( $lifeTime )
		{
			$this->lifeTime = $lifeTime;
		}

        function setData( $id, $group, $data )
        {
			$key = $this->getKey( $id, $group );
            return xcache_set( $key, serialize($data), $this->lifeTime );
        }
		
		/** 
		 * Works in the same way as Cache::setData does, but instead of setting single values,
		 * it assumes that the value we're setting for the given key is part of an array of values. This
		 * method is useful for data which we know is not unique.
		 */
		function setMultipleData( $id, $group, $data )
		{
			$currentData = $this->getData( $id, $group );
			if( !$currentData ) $currentData = Array();

			/**
			* :TODO:
			* It's clear that we're only going to cache DbObjects using this method
			* but what happens if we don't? Should we force developers to provide a method
			* to uniquely identify their own objects? We definitely need a unique id here so that
			* the array doesn't grow forever...
			*/
			$currentData[$data->getId()] = $data;

			return $this->setData( $id, "$group", $currentData );
		}

        function getData( $id, $group )
        {
			$key = $this->getKey( $id, $group );
			if (!xcache_isset($key)) {
				return false;
			}
			$data = xcache_get($key);
			return unserialize($data);
        }

        function removeData( $id, $group )
        {
			$key = $this->getKey( $id, $group );
			return xcache_unset($key);
        }

        function clearCacheByGroup( $group )
        {
            return true;
        }

        function clearCache()
        {
           return xcache_unset_by_prefix();
        }

		function getCacheStats()
		{
				return array();
		}
		
		function getKey( $id, $group )
		{
			return $group.':'.$id;	
		}
    }
?>