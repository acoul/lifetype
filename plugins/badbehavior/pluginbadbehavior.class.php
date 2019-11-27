<?php

	lt_include( PLOG_CLASS_PATH."class/plugin/pluginbase.class.php" );
	lt_include( PLOG_CLASS_PATH."class/database/db.class.php" );
	
	/**
	 * The Bad Behaviour Plugin
	 * TODO: some useful documentation here
	 */
	class PluginBadBehavior extends PluginBase
	{
		var $_logTable;
		var $_displayStatus;
		
		function PluginBadBehavior()
		{
			$this->PluginBase();
			
			$this->id = "badbehavior";
			$this->desc = "Bad Behavior for LifeType";
			$this->author = "The Lifetype Project";
			$this->db =& Db::getDb();
            $this->version = "20120301";
		
			$config =& Config::getConfig();
			$prefix = Db::getPrefix();
			$this->_logTable = $prefix . $config->getValue( 'bb2_log_table' );
			$this->_displayStatus = $config->getValue( 'bb2_display_stats' );
		}

		/**
		 * show bb2 javascript
		 *
		 * @return the bb2 javascript
		 */
        function showBB2JavaScript()
        {
			global $bb2_javascript;
			return $bb2_javascript;
        }

		/**
		 * show bb2 timer
		 *
		 * @return the bb2 timer
		 */
        function showBB2Timer()
        {
			global $bb2_timer_total;
			return "<!-- Bad Behavior 2 " . BB2_VERSION . " run time: " . number_format(1000 * $bb2_timer_total, 3) . " ms -->";
        }

		/**
		 * show bb2 status
		 *
		 * @return the bb2 status
		 */
        function showBB2Status()
        {
			if( !$this->_displayStatus )
				return false;
			
			$query = "SELECT COUNT(id) as counter FROM " . $this->_logTable . " WHERE `key` NOT LIKE '00000000'";
        	
        	$result = $this->db->Execute($query);
	    	if(!$result || ($result->RecordCount() == 0))
            	return false;

            // get the information from the article
        	$row = $result->FetchRow();

			// get current user locale
			$locale =& $this->blogInfo->getLocale();

			return $locale->pr( 'bb2_status', $row['counter'] );
        }
	}
?>
