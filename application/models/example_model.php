<?php
/**
 * Example Model 
 *
 * This is an example model showing how to extend the base model class
 *
 * @author Gilbert Pellegrom
 * @package PIP
 */
class Example_model extends Model {
	
	
	/**
     * Constructor
     */
    public function __construct(){
    
        // Define Database Fields
        $field['pk_uid']  = array('type'=>'NUM', 'pk'=>true, 'alias'=>'id');
	    $field['name']    = array('type'=>'STR');
	    
	    // Create object
	    parent::__construct('user', $field);
    }
    
    /**
     * A sample function to retieve data from the data base
     * @param string $id An arbitrary identifier
     * @param array
     */
	public function getSomething($id)
	{
		$id = $this->escapeString($id);
		$result = $this->query('SELECT * FROM something WHERE id="'. $id .'"');
		return $result;
	}

}

