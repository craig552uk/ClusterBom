<?php
/**
 * Dataset Controller Class 
 *
 */
class Dataset extends Controller {
	
    /**
     * Default controller function
     */
	public function index()
    {
        // Default view
        $this->all();
	}
	
	/**
     * Show all data sets
     */
	public function all()
    {
        // Secure access only
        $this->session->tryRedirect();
        
        // Create dataset object
        $dataset_list = $this->load->model('DataSetList');
        $dataset_list->buildList($this->session->id);
        
        // Get dataset lists
        $public_list = $dataset_list->getPublic();
        $user_list   = $dataset_list->getUser();
        
        // Load view
        $template = $this->load->view('app/dataset-list');
        $template->set('public_list', $public_list);
        $template->set('user_list', $user_list);
        $template->set('session', $this->session->getData());
        $template->render();
	}
	
	/**
     * Edit a data set
     */
	public function edit()
    {
        // Secure access only
        $this->session->tryRedirect();
        // Load view
        $template = $this->load->view('app/dummy');
        $template->set('title','Datasets');
        $template->set('message', "Edit a dataset");
        $template->set('session', $this->session->getData());
        $template->render();
	}
	
	/**
     * Import a data set
     */
	public function add()
    {
        // Secure access only
        $this->session->tryRedirect();
        // Load view
        $template = $this->load->view('app/dummy');
        $template->set('title','Datasets');
        $template->set('message', "Import a dataset");
        $template->set('session', $this->session->getData());
        $template->render();
	}
	
	/**
     * View a data set
     */
	public function view()
    {
        // Secure access only
        $this->session->tryRedirect();
        // Load view
        $template = $this->load->view('app/dummy');
        $template->set('title','Datasets');
        $template->set('message', "View a dataset");
        $template->set('session', $this->session->getData());
        $template->render();
	}
    
}

