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
        if($this->session->isAuth()) { header('Location: '.BASE_URL); }
        
        // Load view
        $template = $this->load->view('app/dummy');
        $template->set('title','Visualizations');
        $template->set('message', "Show all Visualizations");
        $template->set('session', $this->session);
        $template->render();
	}
	
	/**
     * Create a Visualization
     */
	public function add()
    {
        // Secure access only
        if($this->session->isAuth()) { header('Location: '.BASE_URL); }
        
        // Load view
        $template = $this->load->view('app/dummy');
        $template->set('title','Visualizations');
        $template->set('message', "Import a Visualization");
        $template->set('session', $this->session);
        $template->render();
	}
	
	/**
     * View a Visualization
     */
	public function view()
    {
        // Secure access only
        if($this->session->isAuth()) { header('Location: '.BASE_URL); }
        
        // Load view
        $template = $this->load->view('app/dummy');
        $template->set('title','Visualizations');
        $template->set('message', "View a Visualization");
        $template->set('session', $this->session);
        $template->render();
	}
    
}

