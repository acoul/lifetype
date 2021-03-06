<?php

	lt_include( PLOG_CLASS_PATH."class/action/admin/adminaction.class.php" );
    lt_include( PLOG_CLASS_PATH."class/view/admin/admintemplatedview.class.php" );

    /**
     * \ingroup Action
     * @private
     *
     * Action that shows a form to add a link for the blogroll feature
     */
    class AdminNewLinkCategoryAction extends AdminAction 
    {

    	/**
         * Constructor. If nothing else, it also has to call the constructor of the parent
         * class, BlogAction with the same parameters
         */
        function AdminNewLinkCategoryAction( $actionInfo, $request )
        {
        	$this->AdminAction( $actionInfo, $request );

			$this->requirePermission( "add_link_category" );
        }
        
        /**
         * Carries out the specified action
         */
        function perform()
        {
        	$this->_view = new AdminTemplatedView( $this->_blogInfo, "newlinkcategory" );
            $this->setCommonData();

            // better to return true if everything fine
            return true;
        }
    }
?>
