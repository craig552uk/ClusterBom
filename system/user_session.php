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
     * Create a user session, providing their details
     *
     * @param string $email  User email
     * @param string $name   User real name
     * @param array  $extras Array of extra vaues to store
     */
    public function create($email, $name, $extras=array()){
        $_SESSION['auth']['state'] = 'AUTHENTICATED';
        $_SESSION['auth']['email'] = $email;
        $_SESSION['auth']['name']  = $name;
        $_SESSION['auth']['time']  = time();
        foreach($extras as $k=>$v){
            $_SESSION['auth'][$k] = $v;
        }
    }
           
    /**
     * End the current user session
     */
    public function end(){
        unset($_SESSION['auth']);
    }
    
    /*
     * Is a session established
     *
     * @return boolean  True if a user session is established
     */
    public function isAuth()
    {
        return isset($_SESSION['auth']['state']) && $_SESSION['auth']['state'] == 'AUTHENTICATED';
    }
    
    /*
     * Is session error
     *
     * @return boolean  True if a user session is established
     */
    public function isError()
    {
        return isset($_SESSION['auth']['state']) && $_SESSION['auth']['state'] == 'ERROR';
    }
    
    /**
     * Set error code
     */
    public function setErrorCode($code='UNKNOWN')
    {
        $_SESSION['auth']['state'] = 'ERROR';
        $_SESSION['auth']['error_code'] = $code;
    }
       
    /**
     * Direct access to stored data
     */
    public function __get($param){
        if(isset($_SESSION['auth'][$param])){
            return $_SESSION['auth'][$param];
        }
        return false;
    }
    
    /**
     * Direct access to stored data
     */
    public function __set($param, $value){
        if(!isset($_SESSION['auth'])){
            $_SESSION['auth'] = array();
        }
        switch($param){
            case 'error_code':
                $_SESSION['auth']['state']      = 'ERROR';
                $_SESSION['auth']['error_code'] = $code;
                break;
            default:
                $_SESSION['auth'][$param]       = $value;
        }
    }

}
