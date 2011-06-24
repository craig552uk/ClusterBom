<?php
/**
 * Visualisation Controller Class 
 *
 * This is the default controller
 *
 */
class Visualisation extends Controller {
	
    /**
     * Default controller function
     */
	public function index()
    {
        // Default view
        $this->showall();
	}
	
	/**
     * Show all Visualisations
     */
	public function showall()
    {
        $template = $this->load->view('app/dummy');
        $template->set('message', "Show all Visualisations");
        $template->set('userdata', $this->session->getData());
        $template->render();
	}
	
	/**
     * Create a Visualisation
     */
	public function add()
    {
        $template = $this->load->view('app/dummy');
        $template->set('message', "Import a Visualisation");
        $template->set('userdata', $this->session->getData());
        $template->render();
	}
	
	/**
     * View a Visualisation
     */
	public function view()
    {
        $template = $this->load->view('app/dummy');
        $template->set('message', "View a Visualisation");
        $template->set('userdata', $this->session->getData());
        $template->render();
	}
    
}

