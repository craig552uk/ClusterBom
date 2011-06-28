<?php
/**
 * Main authentication class
 * Used to query the authentication state of the user
 * Authentication state and user data is stored in the $_SESSION variable
 *
 * @author Craig Russell
 */
class UserSession 
{
    
    /*
     * Is a session established
     *
     * @return boolean  True if a user session is established
     */
    public function established()
    {
        return isset($_SESSION['auth']['state']) && $_SESSION['auth']['state'] == 'AUTHENTICATED';
    }
    
    /*
     * Is session error
     *
     * @return boolean  True if a user session is established
     */
    public function error()
    {
        return isset($_SESSION['auth']['state']) && $_SESSION['auth']['state'] == 'ERROR';
    }
    
    /**
     * Set error code
     */
    public function setError($code='UNKNOWN')
    {
        $_SESSION['auth']['state'] = 'ERROR';
        $_SESSION['auth']['error_code'] = $code;
    }
    
    /**
     * Get error code
     */
    public function getError()
    {
        return $_SESSION['auth']['error_code'];
    }
    
    /**
     * Check current authentication, if not established redirect to base
     */
    public function tryRedirect(){
        if(!$this->established()){
            $this->goHome();
        }
    }
    
    /**
     * Redirect back home
     */
    public function goHome(){
        header('Location: '.BASE_URL);
    }
    
    /*
     * Create a user session, providing their details
     *
     * @param string $email  User email
     * @param string $uri    Users google uri
     */
    public function create($uri, $userData){
        $_SESSION['auth']['state'] = 'AUTHENTICATED';
        $_SESSION['auth']['email'] = $userData['contact/email'];
        $_SESSION['auth']['fname'] = $userData['namePerson/first'];
        $_SESSION['auth']['sname'] = $userData['namePerson/last'];
        $_SESSION['auth']['uri']   = $uri;
        $_SESSION['auth']['id']    = $userData['clusterbom/pk_cust_id'];
        $_SESSION['auth']['time']  = time();
    }
    
    /**
     * Set oauth2.0 tokens in session
     */
    public function setTokens($access_token, $refresh_token){
        $_SESSION['auth']['oauth2']['access_token']  = $access_token;
        $_SESSION['auth']['oauth2']['refresh_token'] = $refresh_token;
        
        // Unset if blank
        if($access_token == '' || $refresh_token == '')
        {
            unset($_SESSION['auth']['oauth2']);
        }
    }
    
    /**
     * Get oauth2.0 tokens
     */
    public function getTokens(){
        return $_SESSION['auth']['oauth2'];
    }
    
    /**
     * Check if session tokens are set
     */
    public function checkTokens(){
        return     isset($_SESSION['auth']['oauth2']['access_token'])
                && isset($_SESSION['auth']['oauth2']['refresh_token']);
    }
    
    /**
     * End the current user session
     */
    public function end(){
        unset($_SESSION['auth']);
    }
    
    /**
     * Get data for logged in user
     * 
     * @return object   Object of user session data
     */
    public function getData(){
        $obj = null;
        if(isset($_SESSION['auth'])){
            $obj->email = $_SESSION['auth']['email'];
            $obj->fname = $_SESSION['auth']['fname'];
            $obj->sname = $_SESSION['auth']['sname'];
            $obj->uri   = $_SESSION['auth']['uri'];
            $obj->time  = $_SESSION['auth']['time'];
        }
        return $obj;
    }
    
    /**
     * Direct access to stored data
     */
    public function __get($param){
        if(isset($_SESSION['auth'][$param])){
            return $_SESSION['auth'][$param];
        }
        return 0;
    }

}
