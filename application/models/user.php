<?php
/**
 * User Model 
 *
 * Model representing a user in the system
 */
class User extends ModelTable {
	
    /**
     * Constructor
     */
    public function __construct(){
    
        // Define Database Fields
        $field['pk_cust_id']      = array('type'=>'NUM', 'pk'=>true, 'alias'=>'id');
	    $field['name']            = array('type'=>'STR');
	    $field['email']           = array('type'=>'STR');
	    $field['password']        = array('type'=>'STR');
	    $field['account_created'] = array('type'=>'DATETIME');
	    $field['last_login']      = array('type'=>'DATETIME');
	    $field['account_enabled'] = array('type'=>'BOOL', 'alias'=>'enabled');
	    $field['login_count']     = array('type'=>'NUM');
	    $field['fk_plan_id']      = array('type'=>'NUM', 'alias'=>'plan_id');
	    $field['credit']          = array('type'=>'NUM');
	    
	    // Create object
	    parent::__construct('customer', $field);
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
        $query = 'SELECT pk_cust_id FROM customer WHERE email=\''.$email.'\'';
        $result = $this->query($query);
        
        if(isset($result[0])){
            $this->id = $result[0]->pk_cust_id;
            $this->load();
            return true;
        }
        return false;
    }
}

