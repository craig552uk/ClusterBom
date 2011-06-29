<?php
/**
 * Visualization Controller Class 
 *
 * This is the default controller
 *
 */
class Visualization extends Controller {
	
    /**
     * Default controller function
     */
	public function index()
    {
        // Default view
        $this->showall();
	}
	
	/**
     * Show all Visualizations
     */
	public function showall()
    {
        // Secure access only
        $this->session->tryRedirect();
        // Load view
        $template = $this->load->view('app/dummy');
        $template->set('title','Visualiszations');
        $template->set('message', "Show all Visualizations");
        $template->set('session', $this->session->getData());
        $template->render();
	}
	
	/**
     * Create a Visualization
     */
	public function add()
    {
        // Secure access only
        $this->session->tryRedirect();
        // Load view
        $template = $this->load->view('app/dummy');
        $template->set('title','Visualizations');
        $template->set('message', "Import a Visualization");
        $template->set('session', $this->session->getData());
        $template->render();
	}
	
	/**
     * View a Visualization
     */
	public function view()
    {
        // Secure access only
        $this->session->tryRedirect();
        // Load view
        $template = $this->load->view('app/dummy');
        $template->set('title','Visualizations');
        $template->set('message', "View a Visualization");
        $template->set('session', $this->session->getData());
        $template->render();
	}
    
}

