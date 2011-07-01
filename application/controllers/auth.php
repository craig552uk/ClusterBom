<?php
/**
 * Auth Controller Class 
 *
 * This is the authentication controller
 *
 */
class Auth extends Controller {
	
    /**
     * Default controller function
     */
	public function index()
    {
        // José Martí was a clever bloke
        echo "<style>blockquote{font-style: italic;} cite{font-weight: bold; font-style: none;}</style>";
        echo "<blockquote>&#8220;To be ahead of the rest, you need to see more than they do.&#8221;<br/>"
            ."<cite align=\"right\">Jos&eacute; Mart&iacute;</cite></blockquote>";
        // No default function, else OpenID response breaks
	}
	
	/**
	 * Login form
	 */
	public function signin(){
	    if(isset($_POST['submit'])){
	        // Process submission
	        $this->signin_submit();
	    }else{
	        // Load form
            $template = $this->load->view('app/signin');
            $template->set('title','Sign In');
            $template->render();
        }
	}
	
	/**
	 * End point for login form submission
	 */
    private function signin_submit(){
        
        // Get params from submitted form
        $email    = (isset($_POST['email']))    ? $_POST['email'] : '';
        $password = (isset($_POST['password'])) ? $_POST['password'] : '';
        $remember = (isset($_POST['remember'])) ? true : false;
        
        // Error missing values
        if(($email == '') || ($password == '')){
            $login_error = 'Unknown email/password';
        }
        
        // Error user failure
        $user = $this->load->model('User');
        if(!$user->loadByEmail( $email )){
            $login_error = 'Unknown email/password';
        }
        
        // Error password failure
        $password = sha1('RdGBEe8scaJx'.$user->id.$password);
        if($user->password != $password ){
            $login_error = 'Unknown email/password';
        }
        
        // Test for errors
        if(isset($login_error)){
            // Login Error
            $view = $this->load->view('app/signin');
            $view->set('login_error', $login_error);
            $view->render();
        }else{
            // Create session
            $this->session->create($email, $user->name);
            // Increment count
            $user->login_count++;   // Increment login count
            $user->save();
            // TODO store data in cookie to remember login
            // Go home
            header('Location: '.BASE_URL);
        }
                
    }
	
	/**
	 * Sign up form
	 */
	public function signup(){
	
	    if(isset($_POST['submit'])){
	        // Process submission
	        $this->signup_submit();
	    }else{
	        // Load form
            $template = $this->load->view('app/signup');
            $template->set('title','Sign Up');
            $template->render();
        }
	}
	
	/**
	 * Endpoint for sign up form submission
	 */
	private function signup_submit(){
	
	    // Get params from submitted form
	    $name     = (isset($_POST['name']))     ? $_POST['name'] : '';
        $email    = (isset($_POST['email']))    ? $_POST['email'] : '';
        $password = (isset($_POST['password'])) ? $_POST['password'] : '';
        
        // Create user model
        $user = $this->load->model('User');
        
        // Sanity check
        if(($name==='')||($email==='')||($password==='')){
            $signup_error = 'All fields are required';
        }
        
        // Email validity TODO better email check
        elseif(strpos($email, '@') === false){
            $signup_error = 'Email must be valid';
        }
        
        // Password Length TODO use decent policy
        elseif(strlen($password) < 8){
            $signup_error = 'Password must be at least 8 characters';
        }
        
        // Error user exists
        elseif($user->loadByEmail( $email )){
            $signup_error = 'Email already taken';
        }
        
        // Form validation
        if(isset($signup_error)){
            // Error
            $view = $this->load->view('app/signup');
            $view->set('signup_error', $signup_error);
            $view->render();
        }else{
            // Create account
            $user = $this->load->model('User');
            $user->name = $name;
            $user->email = $email;
            $user->save();          // Save to get id
            $user->password = sha1('RdGBEe8scaJx'.$user->id.$password);
            // Create session
            $this->session->create($email, $name);
            // Increment count
            $user->login_count++;   // Increment login count
            $user->save();
            // Go home
            header('Location: '.BASE_URL);
        }
	}

	
	/**
     * Authenticate with oAuth2.0 against Google
     */
	public function oauth2()
    {
        // Get config data in scope
        global $config;
        
        // Create Google oAuth object
        $ga = $this->load->helper('Google_oAuth');
        $ga->construct($config['oauth']['client_id'], 
                       $config['oauth']['client_secret'], 
                       $config['oauth']['redirect_uri'], 
                       $config['oauth']['scope']);
        
        // Do we already have our tokens?
        if( ($this->session->access_token === false)
         && ($this->session->refresh_token) === false ){
            // No, so let's go get them
                                                // Have I just received a valid auth response?
            if( $ga->isValidResponse()){        // Yes, so get the tokens
            
                // Fetch persistant tokens
                $ga->getToken();
                
                // Save them in the session
                $this->session->access_token  = $ga->access_token;
                $this->session->refresh_token = $ga->refresh_token;
                
                // Close popup
    	        echo '<script type="text/javascript">window.close();</script>';
            }else{                              // No, initiate request
                header('Location: '.$ga->getAuthURL());
            }
        }else{
            // Close popup
	        echo '<script type="text/javascript">window.close();</script>';
        }
	}
	
	/*
	 * End current session
	 *
	 */
	public function logout()
	{
	    // End session
	    $this->session->end();
	    // Redirect back home
	    header('Location: '.BASE_URL);
	}
    
}

