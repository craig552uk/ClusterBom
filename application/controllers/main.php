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
        
        if($this->session->established()){
        
            // Load authenticated view
		    $template = $this->load->view('app/dashboard');

		    // Inject user data
		    $template->set('userdata', $this->session->getData());
		}elseif($this->session->error()){
		    // Load unauthenticated view
		    $template = $this->load->view('index');
		    // Send error message to view
		    $template->set('error', $config['str']['error'][$this->session->getError()]);
		}else{
		    // Load unauthenticated view
		    $template = $this->load->view('index');
		}
		
		// Render View
		$template->set('title','Welcome to ClusterBom');
        $template->render();
	}
	
	public function test(){
	
	    $user = $this->load->model('User');
	    
	    $user->loadByEmail('me@me.com');
	    $user->incLoginCount();
	    $user->load();
	    
	    
	    echo '<pre>';
	    print_r($user->dump());
	    echo '</pre>';
	    
	}
    
}

