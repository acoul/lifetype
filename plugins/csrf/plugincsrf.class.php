<?php

lt_include( PLOG_CLASS_PATH."class/plugin/pluginbase.class.php" );

define("CSRF_TOKEN_NAME", "CsrfToken");

class PluginCSRF extends PluginBase
{
    function PluginCSRF($source){
        $this->PluginBase($source);
        
        $this->id = "csrf";
        $this->author = "Jon Daley";
        $this->version = "20100804";
        $this->desc = "Protects the administrators and blog editors from CSRF attacks.";

            // this plugin only cares about the administration side
        if($source == "admin"){
            $this->registerNotification(EVENT_LOGIN_SUCCESS);
            $this->registerNotification(EVENT_PROCESS_BLOG_ADMIN_TEMPLATE_OUTPUT);
            lt_include(PLOG_CLASS_PATH."plugins/csrf/class/security/csrffilter.class.php");
			$this->registerFilter( "CsrfFilter" );
        }
    }
	
    function process($eventType, $params){
        $session = HttpVars::getSession();
        $sessioninfo = $session["SessionInfo"];

        switch($eventType){
          case EVENT_PROCESS_BLOG_ADMIN_TEMPLATE_OUTPUT:
            lt_include(PLOG_CLASS_PATH."plugins/csrf/class/dao/csrfurls.class.php");

                // Handle all GET/links
                // TODO: don't modify any links that are going outside the domain
                // TODO: only modify links that we explicitly care about?
            $protectedOps = CsrfUrls::getProtectedOps();
            foreach($protectedOps as $key => $op){
                $protectedOps[$key] = "/(op=$op)(\W)/";
            }
            $params['content'] = preg_replace($protectedOps, '$1' .
                                              '&amp;'.CSRF_TOKEN_NAME.'='.
                                              $sessioninfo->getValue(CSRF_TOKEN_NAME).'$2',
                                              $params['content']);

                // Handle all POST/forms
            $element = '<input type="hidden" name="'.CSRF_TOKEN_NAME.
                '" value="'.$sessioninfo->getValue(CSRF_TOKEN_NAME).'" />';
            $params['content'] = preg_replace('/<form[^>]*>/i', '$0' . $element, $params['content']);

            break;
            
          case EVENT_LOGIN_SUCCESS:
            $sessioninfo->setValue(CSRF_TOKEN_NAME, md5(rand().time().filectime(__FILE__)));
//            print "Token: ".$sessioninfo->getValue(CSRF_TOKEN_NAME)."<br/>\n";
            break;

          default:
            return false;
        }
        return true;
    }
}
