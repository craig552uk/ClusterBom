<?php
/**
 * Dataset Controller Class 
 *
 * This is the default controller
 *
 */
class Dataset extends Controller {
	
    /**
     * Default controller function
     */
	public function index()
    {
        // Default view
        $this->showall();
	}
	
	/**
     * Show all data sets
     */
	public function showall()
    {
        $template = $this->load->view('app/dummy');
        $template->set('message', "Show all data sets");
        $template->set('userdata', $this->session->getData());
        $template->render();
	}
	
	/**
     * Edit a data set
     */
	public function edit()
    {
        $template = $this->load->view('app/dummy');
        $template->set('message', "Edit a dataset");
        $template->set('userdata', $this->session->getData());
        $template->render();
	}
	
	/**
     * Import a data set
     */
	public function add()
    {
        $template = $this->load->view('app/dummy');
        $template->set('message', "Import a dataset");
        $template->set('userdata', $this->session->getData());
        $template->render();
	}
    
}

