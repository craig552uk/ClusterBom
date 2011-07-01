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
        if(!$this->session->isAuth()) { header('Location: '.BASE_URL); }
        
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
        $template->set('session', $this->session);
        $template->set('tab','DATA');
        $template->render();
	}
	
	/**
     * Edit a data set
     */
	public function edit()
    {
        // Secure access only
        if(!$this->session->isAuth()) { header('Location: '.BASE_URL); }
        
        // Load view
        $template = $this->load->view('app/dummy');
        $template->set('title','Datasets');
        $template->set('tab','DATA');
        $template->set('message', "Edit a dataset");
        $template->set('session', $this->session);
        $template->render();
	}
	
	/**
     * Import a data set
     */
	public function add()
    {
        // Secure access only
        if(!$this->session->isAuth()) { header('Location: '.BASE_URL); }
        
        // Load view
        $template = $this->load->view('app/dataset-add');
        $template->set('title','Import a Dataset');
        $template->set('tab','DATA');
        $template->set('message', "Choose a worksheet from your Google Docs account");
        $template->set('session', $this->session);
        
        /*
        // Check if we have tokens to access spreadsheets
        if($this->session->checkTokens()){
            // Get spreadsheet data
            $gss = $this->load->helper('Google_Spreadsheets');
            $gss->setToken($this->session->access_token);
            $spreadsheets = $gss->spreadsheets();
            
            // Set vars in view
            $template->set('hastokens', true);
            $template->set('spreadsheets', $spreadsheets);
        
        }else{
            // Set vars in view
            $template->set('hastokens', false);
        }
        */
        // Render view
        $template->render();
	}
	
	/**
     * View a data set
     */
	public function view()
    {
        // Secure access only
        if(!$this->session->isAuth()) { header('Location: '.BASE_URL); }
        
        // Load view
        $template = $this->load->view('app/dummy');
        $template->set('title','Datasets');
        $template->set('message', "View a dataset");
        $template->set('session', $this->session);
        $template->set('tab','DATA');
        $template->render();
	}
    
}

