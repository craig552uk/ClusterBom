<?php
/**
 * Main Controller Class 
 *
 * This is the default controller
 *
 */
class Main extends Controller {
	
    /**
     * Default controller function
     */
	public function index()
    {
        if($this->session->established()){
        
            // Load authenticated view
		    $template = $this->load->view('app/dashboard');

		    // Inject user data
		    $userdata = $this->session->getData();
		    $template->set('userdata', $userdata);
		}else{
		    // Load unauthenticated view
		    $template = $this->load->view('index');
		}
		
		// Render View
		$template->set('title','Welcome to ClusterBom');
        $template->render();
	}
    
}

