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
	 * Login function
	 * Alias for different methods
	 */
	public function login(){
	    // Use OpenID
	    $this->openid();
	}
	
	/*
	 * Authenticate with openID against Google
	 *
	 */
	public function openid()
	{
	    try{
	        echo "Loading, Please wait...";
	        // Create OpenID object
	        $openid = $this->load->helper('LightOpenID');
	        
	        if(!$openid->mode) {
	            // Build and send request
	            $openid->identity = 'https://www.google.com/accounts/o8/id';
	            $openid->required = array('namePerson/first', 'namePerson/last', 'contact/email');
	            header('Location: ' . $openid->authUrl());
	        }else{
	            if($openid->validate()){
	                // Valid response
	                session_regenerate_id(true);
                    $goog_data = $openid->getAttributes();
                    $goog_id   = $openid->identity;    

	                // Create empty user object
	                $user = $this->load->model('User');
	                // Look up email
	                if($user->loadByEmail($goog_data['contact/email'])){
	                    // User exists
	                    if($user->enabled){
	                        // Authenticated
	                        // Update details from google
	                        $user->fname = $goog_data['namePerson/first'];
	                        $user->sname = $goog_data['namePerson/last'];
	                        $user->goog_id = $goog_id;
	                        $user->login_count++;   // Increment login count
	                        $user->save();          // Save changes
	                        
	                        // Pass user ID to session
	                        $goog_data['clusterbom/pk_cust_id'] = $user->id;
	                    
	                        // Start session
        	                $this->session->create($goog_id, $goog_data);
	                    }else{
	                        // Account disabled
	                        $this->session->setError('ACCOUNT_DISABLED');
	                    }
	                }else{
	                    // User does not exist
	                    $user->fname = $goog_data['namePerson/first'];
                        $user->sname = $goog_data['namePerson/last'];
	                    $user->email = $goog_data['contact/email'];
                        $user->goog_id = $goog_id;
	                    $user->login_count = 1;
	                    $user->save();          // Create user record
	                    
	                    // Pass user ID to session
	                    $goog_data['clusterbom/pk_cust_id'] = $user->id;
	                    
	                    // Start session
    	                $this->session->create($goog_id, $goog_data);
	                }
	            }else{
	                // Not validated by Google
	                $this->session->setError('GOOGLE_ACCOUNT_INVALID');
	            }
	        }
	        // Close popup
	        echo '<script type="text/javascript">window.close();</script>';
	        
	    }catch(ErrorException $e) {
	        // Catch exception and display error
            $template = $this->load->view('sys/error');
		    $template->set('title','Authentication Error');
		    $template->set('message',$e->getMessage());
            $template->render();
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
        if( !$this->session->checkTokens() ){
            // No, so let's go get them
                                                // Have I just received a valid auth response?
            if( $ga->isValidResponse()){        // Yes, so get the tokens
            
                // Fetch persistant tokens
                $ga->getToken();
                
                // Save them in the session
                $this->session->setTokens($ga->access_token, $ga->refresh_token);
                
                // Close popup
    	        echo '<script type="text/javascript">window.close();</script>';
            }else{                              // No, initiate request
                header('Location: '.$ga->getAuthURL());
            }
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
	    $this->session->goHome();
	}
    
}

