<?php
/*
 * Model representing the set of datasets accessible to the user
 * Including those uploaded by the user and publicly accessible sets
 *
 */
class DataSetList extends ModelDB{
    
    /**
     * User id
     */
    private $user_id;
    
    /**
     * Array of public data set meta data objects
     */
    private $dataset_p;
    
    /**
     * Array of user-owned data set meta data objects
     */
    private $dataset_u;

    /** 
     * Build list of datasets for user_id
     *
     * @param int ID of user record in DB
     */
    public function buildList($user_id){
        
        // Store user id
        $this->user_id = $this->escapeString($user_id);
        
        // Build queries
        $query_p = 'SELECT pk_dataset_id, name, description, date_uploaded, '
                 . 'goog_owner_name, goog_owner_email, date_last_accessed '
                 . 'FROM dataset WHERE public=TRUE';                 
        $query_u = 'SELECT pk_dataset_id, name, description, date_uploaded, '
                 . 'goog_owner_name, goog_owner_email, date_last_accessed '
                 . 'FROM dataset WHERE fk_cust_id='.$this->user_id;
        
        // Execute queries and save data
        $this->dataset_p = $this->query($query_p);
        $this->dataset_u = $this->query($query_u);
        
    }
    
    /**
     * Get public dataset meta data
     */
    public function getPublic(){
        return $this->dataset_p;
    }
    
    /**
     * Get user-owned dataset meta data
     */
    public function getUser(){
        return $this->dataset_u;
    }

}
