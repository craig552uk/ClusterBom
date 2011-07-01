<?php
/**
 * Account Controller Class 
 *
 * This is the default controller
 *
 */
class Account extends Controller {
	
    /**
     * Default controller function
     */
	public function index()
    {
        // Default view
        $this->profile();
	}
	
	/**
     * Account profile
     */
	public function profile()
    {
        // Secure access only
        if(!$this->session->isAuth()) { header('Location: '.BASE_URL); }
        
        // Get user data
        $user = $this->load->model('User');
        $user->loadByEmail( $this->session->email );
        
        // Load view
        $template = $this->load->view('app/user-profile');
        $template->set('title','Account');
        $template->set('message', "Account Profile");
        $template->set('session', $this->session);
        $template->set('account', $user);
        $template->render();
	}
	
	/**
     * Account payment plan
     */
	public function plan()
    {
        // Secure access only
        if(!$this->session->isAuth()) { header('Location: '.BASE_URL); }
        
        // Load view
        $template = $this->load->view('app/dummy');
        $template->set('title','Account');
        $template->set('message', "Account Payment Plan");
        $template->set('session', $this->session);
        $template->render();
	}
	
	/**
     * help
     */
	public function help()
    {
        // Secure access only
        if(!$this->session->isAuth()) { header('Location: '.BASE_URL); }
        
        // Load view
        $template = $this->load->view('app/dummy');
        $template->set('title','Account');
        $template->set('message', "Help");
        $template->set('session', $this->session);
        $template->render();
	}
	
	
    
}

