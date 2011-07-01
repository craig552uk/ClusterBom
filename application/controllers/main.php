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
        // Get congig array in scope;
        global $config;
        
        if($this->session->isAuth()){
        
            // Load authenticated view
		    $template = $this->load->view('app/dashboard');

		    // Inject user data
		    $template->set('session', $this->session);
		    $template->set('tab','DASH');
		}else{
		    // Load unauthenticated view
		    $template = $this->load->view('index');
		}
		
		// Render View
		$template->set('title','Welcome to ClusterBom');
        $template->render();
	}
}

