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
        
        // Get user ID
        $user = $this->load->model('User');
        $user->loadByEmail($this->session->email);
        
        // Create dataset object
        $dataset_list = $this->load->model('DataSetList');
        $dataset_list->buildList($user->id);
        
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
        $template = $this->load->view('app/dataset-add-1');
        $template->set('title','Import a Dataset');
        $template->set('tab','DATA');
        $template->set('message', "Choose a worksheet from your Google Docs account");
        $template->set('session', $this->session);
        
        
        // Check if we have tokens to access spreadsheets
        if( ($this->session->access_token !== false)
         && ($this->session->refresh_token) !== false ){
            $template->set('hastokens', true);
        }else{
            $template->set('hastokens', false);
        }
        
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
	
	/**
	 * Load spreadsheets from google
	 * Assumes tokens exist in session
	 */
	public function spreadsheets(){
	
	    // Get config data in scope
        global $config;
        
        // Create Google oAuth object
        $ga = $this->load->helper('Google_oAuth');
        $ga->construct($config['oauth']['client_id'], 
                       $config['oauth']['client_secret'], 
                       $config['oauth']['redirect_uri'], 
                       $config['oauth']['scope']);
                       
        // Create Google Spreadsheet object
        $gss = $this->load->helper('Google_Spreadsheets');
        $gss->setToken($this->session->access_token);
        
        // Track attempts
        $attempt = 0;
        while($attempt<3){
            // Try to get data
            $spreadsheets = $gss->spreadsheets();

            // Test success
            if (!$gss->success()){
                // Refresh token
                $token = $ga->refreshToken($this->session->refresh_token);
                $gss->setToken($token);
                $attempt++;
            }else{
                $attempt=99;
            }
        }
        
        // Load and display view
        $view = $this->load->view('app/dataset-add-spreadsheets');
        $view->set('spreadsheets', $spreadsheets);
        $view->render(false); // No head or tail on ajax requests
	}
	
	/**
	 *
	 */
	public function worksheets(){
	    // Get config data in scope
        global $config;
        
        // Create Google oAuth object
        $ga = $this->load->helper('Google_oAuth');
        $ga->construct($config['oauth']['client_id'], 
                       $config['oauth']['client_secret'], 
                       $config['oauth']['redirect_uri'], 
                       $config['oauth']['scope']);
                       
	    // Get URI from url
	    $url = explode('/', $_SERVER['REQUEST_URI']);
	    $uri = urldecode(urldecode(array_pop($url)));
	    
	    // Create Gogole Sopreadsheet object
	    $gss = $this->load->helper('Google_Spreadsheets');
        $gss->setToken($this->session->access_token);
        
        // Track attempts
        $attempt = 0;
        while($attempt<3){
            // Try to get data
            $worksheets = $gss->worksheets($uri);

            // Test success
            if (!$gss->success()){
                // Refresh token
                $token = $ga->refreshToken($this->session->refresh_token);
                $gss->setToken($token);
                $attempt++;
            }else{
                $attempt=99;
            }
        }
        
        // Display data
        foreach($worksheets as $w){
            echo '<li class="worksheet clearfix" ';
            echo 'data-uri="'.$w->uri.'">';
            echo '<span class="title">'.$w->title.'</span>';
            //echo $w->uri;
            //echo $w->parent;
            //echo '<span class="date">'.$w->updated.'</span>';
            echo '</li>';
        }
	}
	
    
}

