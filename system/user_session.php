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
    
    /**
     * Check current authentication, if not established redirect to base
     */
    public function tryRedirect(){
        if(!$this->established()){
            header('Location: '.BASE_URL);
        }
    }
    
    /*
     * Create a user session, providing their details
     *
     * @param string $email  User email
     * @param string $uri    Users google uri
     */
    public function create($email, $uri){
        $_SESSION['auth']['state'] = 'AUTHENTICATED';
        $_SESSION['auth']['email'] = $email;
        $_SESSION['auth']['uri']   = $uri;
        $_SESSION['auth']['time']  = time();
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
            $obj->uri   = $_SESSION['auth']['uri'];
            $obj->time  = $_SESSION['auth']['time'];
        }
        return $obj;
    }

}
