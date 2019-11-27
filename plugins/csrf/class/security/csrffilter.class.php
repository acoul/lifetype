<?php
lt_include( PLOG_CLASS_PATH."class/security/pipelinefilter.class.php" );

class CsrfFilter extends PipelineFilter 
{
    function CsrfFilter($pipelineRequest){
        $this->PipelineFilter($pipelineRequest);
    }
    
    function filter(){
        $request  = $this->_pipelineRequest->getHttpRequest();
        $op = $request->getValue("op");

            // Check if this operation needs to be blocked
        lt_include(PLOG_CLASS_PATH."plugins/csrf/class/dao/csrfurls.class.php");
        if(!$op || !CsrfUrls::getProtectedOps($op))
            return new PipelineResult();

            // Get our token from the session
        $session = HttpVars::getSession();
        $sessioninfo = $session["SessionInfo"];
        $saved_token = $sessioninfo->getValue(CSRF_TOKEN_NAME);
        $token = $request->getValue(CSRF_TOKEN_NAME);
            
        if(!empty($saved_token) && $token == $saved_token){
                // it's not empty and it matches, yay.
            return new PipelineResult();
        }
        else{
                // too bad. a hacker, or some bad coding/output filtering...
            $blogInfo = $this->_pipelineRequest->getBlogInfo();
            $locale = $blogInfo->getLocale();
            return new PipelineResult(false, 0, $locale->tr("error_csrf_token_incorrect"));
        }
    }
}
