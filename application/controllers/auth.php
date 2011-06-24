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
	    // TODO Some authentication
	    // Start session
	    $this->session->create('craig@craig-russell.co.uk', 'SOMEUID');
	    // Redirect back home
	    $this->session->goHome();
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

