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
        $this->session->tryRedirect();
        // Load view
        $template = $this->load->view('app/dummy');
        $template->set('message', "Account Profile");
        $template->set('userdata', $this->session->getData());
        $template->render();
	}
	
	/**
     * Account payment plan
     */
	public function plan()
    {
        // Secure access only
        $this->session->tryRedirect();
        // Load view
        $template = $this->load->view('app/dummy');
        $template->set('message', "Account Payment Plan");
        $template->set('userdata', $this->session->getData());
        $template->render();
	}
	
	/**
     * help
     */
	public function help()
    {
        // Secure access only
        $this->session->tryRedirect();
        // Load view
        $template = $this->load->view('app/dummy');
        $template->set('message', "Help");
        $template->set('userdata', $this->session->getData());
        $template->render();
	}
    
}

