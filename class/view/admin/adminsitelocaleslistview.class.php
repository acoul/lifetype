<?php

	lt_include( PLOG_CLASS_PATH."class/view/admin/admintemplatedview.class.php" );
    lt_include( PLOG_CLASS_PATH."class/locale/ltlocales.class.php" );	
	
    /**
     * \ingroup View
     * @private
     */	
	class AdminSiteLocalesListView extends AdminTemplatedView
	{
	
		function AdminSiteLocalesListView( $blogInfo )
		{
			$this->AdminTemplatedView( $blogInfo, "sitelocales" );
		}
		
		function render()
		{
            // load all the locale files
            $locales = new LTLocales();
            $siteLocales = $locales->getLocales();
            $this->setValue( "locales", $siteLocales );
		
			parent::render();
		}
	}
?>