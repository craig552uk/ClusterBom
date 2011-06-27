<?php
/**
 * User Model 
 *
 * Model representing a user in the system
 */
class User extends Model {
	
    /**
     * Constructor
     */
    public function __construct(){
    
        // Define Database Fields
        $field['pk_cust_id']      = array('type'=>'NUM', 'pk'=>true, 'alias'=>'id');
	    $field['goog_id']         = array('type'=>'STR');
	    $field['fname']           = array('type'=>'STR');
	    $field['sname']           = array('type'=>'STR');
	    $field['email']           = array('type'=>'STR');
	    $field['administrator']   = array('type'=>'BOOL');
	    $field['account_enabled'] = array('type'=>'BOOL', 'alias'=>'enabled');
	    $field['login_count']     = array('type'=>'NUM');
	    $field['fk_plan_id']      = array('type'=>'NUM', 'alias'=>'plan_id');
	    $field['credit']          = array('type'=>'NUM');
	    $field['unpaid_alert']    = array('type'=>'BOOL');
	    
	    // Create object
	    parent::__construct('user', $field);
    }
    
    /**
     * Load user data by email address
     *
     * @param string email
     * @retrun boolean true on success false otherwise 
     */
    public function loadByEmail($email){
        // Sanitise input
        $email = $this->escapeString($email);
        
        // Build and execute query
        $query = 'SELECT pk_cust_id FROM user WHERE email=\''.$email.'\'';
        $result = $this->query($query);
        
        if(isset($result[0])){
            $this->id = $result[0]->pk_cust_id;
            $this->load();
            return true;
        }
        return false;
    }
    
}

