<?php
/**
 * Auth Controller Class 
 *
 * This is the authentication controller
 *
 */
class Auth extends Controller {
	
    /**
     * Default controller function
     */
	public function index()
    {
        $this->login();
	}
	
	/*
	 * Function login
	 *
	 */
	public function login()
	{
	    try{
	        echo "Loading, Please wait...";
	        // Create OpenID object
	        $openid = $this->load->helper('LightOpenID');
	        
	        if(!$openid->mode) {
	            // Build and send request
	            $openid->identity = 'https://www.google.com/accounts/o8/id';
	            $openid->required = array('namePerson/first', 'namePerson/last', 'contact/email');
	            header('Location: ' . $openid->authUrl());
	        }else{
	            if($openid->validate()){
	                // Valid response
	                session_regenerate_id(true);
	                // Start session
	                $this->session->create($openid->identity, $openid->getAttributes());
	            }
	        }
	        // Close popup
	        echo '<script type="text/javascript">window.close();</script>';
	        
	    }catch(ErrorException $e) {
	        // Catch exception and display error
            $template = $this->load->view('sys/error');
		    $template->set('title','Authentication Error');
		    $template->set('message',$e->getMessage());
            $template->render();
        }
	}
	
	/*
	 * Function logout
	 *
	 */
	public function logout()
	{
	    // End session
	    $this->session->end();
	    // Redirect back home
	    $this->session->goHome();
	}
    
}

