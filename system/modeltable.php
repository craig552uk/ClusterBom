<?php
/**
 * Model base class for single table objects
 *
 * This is the base class for a model object
 *
 * @author Gilbert Pellegrom
 * @package PIP
 */
class ModelTable extends ModelDB{
       
    /**
     * Table name
     * @access private
     */
    private $table;
    
	/**
	 * Database Field definitions
	 * @access private
	 */
	private $field;

    /**
     * The primary key field
     * @access protected
     */
    protected $pk;
    
	/**
	 * Field Aliases
	 * Map values to keys
	 * @access private
	 */
	private $alias;
	
    /**
     * Constructor
     * Initiates connection to MySQL DB
     * Must provide the table name and a description of the fields
     *
     * Fields are defined as an array like...
     *
     * $fields['pk_uid'] = array('type'='NUM', 'pk'=true, 'alias'='uid');
     * $fields['name']   = array('value'='Jim', 'type'='STR');
     *
     * Array key is field name as in DB
     * Sub-array 'value' is default value [Optional]
     * Sub-array 'type' is data type. One of STR NUM BOOL DATE TIME DATETIME [Required]
     * Sub-array 'pk' is true for the primary key field [required for one field only]
     * Sub-array 'alias' is alias for field when accessed from outside object [Optional]
     *
     * @global array $config Configuration parameter array
     * @param string Table name
     * @param array  Array describing DB fields
     */
	public function __construct($table, $field=array())
	{
	    // Call modelDB constructor
		parent::__construct();
        
        // Set table neame
        $this->table = $table;
        
        // Set field definitions
        $this->field = $field;
        
        // Build alias list
        // Find primary key
	    foreach($this->field as $f=>$def){
            // Test for primary key	    
	        if(isset($def['pk']) && $def['pk']){
	            $this->pk = $f;
	        }
	        // Test for alias
	        if(isset($def['alias']) && $def['alias']){
	            $this->alias[$def['alias']] = $f;
	        }
	        // Set empty value if not defined
	        if(!isset($def['value'])){
	            $this->field[$f]['value'] = '';
	        }
	    }
	}
	
	/**
     * Get a field value
     * Fields must be defined in construction
     * Aliases can be used
     *
     * @param string Field name
     */
    public function __get($name){
        // Map alias
        $name = (isset($this->alias[$name])) ? $this->alias[$name] : $name;
        // Return field value
        return $this->field[$name]['value'];
    }
	
	/**
	 * Set a field value
	 * Fields must be defined in construction
	 * Aliases can be used
	 *
	 * @param string Field name
	 * @param mixed  Field value
	 */
	public function __set($name, $val){
	    // Map alias
        $name = (isset($this->alias[$name])) ? $this->alias[$name] : $name;
        // Set field value
        return $this->field[$name]['value'] = $val;
	}
	
	/**
	 * Load object data from DB
	 * Primary key must be set before calling
	 */
	public function load(){
	    // Get id value
        $id = $this->field[$this->pk]['value'];
        
        if($id){
            // Sanitize input
            $id = $this->escapeString($id);
            // Build Query
            $query = 'SELECT * FROM '.$this->table.' WHERE '.$this->pk.'=\''.$id.'\'';
            // Send query
            $result = $this->query($query);
            
            // Save result in fields array
            foreach( $result[0] as $k => $v){
                if(isset($this->field[$k])){
                    // Convert data formats
                    switch($this->field[$k]['type']){
                        case 'DATE':
                        case 'TIME':
                        case 'DATETIME':
                            $this->field[$k]['value'] = strtotime($v);
                            break;
                        default: // STRING or NUM or BOOL
                            $this->field[$k]['value'] = $v;
                    }
            
                }
            }
        }
	}
	
	/**
	 * Save data to the database
     * Object is updated with primary key on DB INSERT only
	 */
	public function save(){
	    // Sanitize Input
	    $params = $this->escapeArray($this->field);
	    // UPDATE or INSERT
	    $query = ($this->field[$this->pk]['value']) ? 'UPDATE ' : 'INSERT INTO ';
	    
	    // Build query
	    $query .= $this->table.' SET ';
	    foreach($this->field as $k => $f){
	    
	        // Skip empty values
	        if(!$f['value']) {continue;}
	        
	        // Skip primary key
	        if($this->pk == $k) {continue;}
	        
	        // Convert data formats
	        switch($f['type']){
                case 'NUM':
                    $query .= $k.'='.$f['value'].',';
                    break;
                case 'BOOL':
                    $query .= $k.'='.$this->to_bool($f['value']).',';
                    break;
                case 'DATE':
                    $query .= $k.'=\''.$this->to_date($f['value']).'\',';
                    break;
                case 'TIME':
                    $query .= $k.'=\''.$this->to_time($f['value']).'\',';
                    break;
                case 'DATETIME':
                    $query .= $k.'=\''.$this->to_datetime($f['value']).'\',';
                    break;
                default: // STRING
                    $query .= $k.'=\''.$f['value'].'\',';
	        }
	        
	    }
	    $query = trim($query, ',');
	    
	    // Append WHERE clause to UPDATE
	    $query .= ($this->field[$this->pk]['value']) ? ' WHERE '.$this->pk.'='.$this->field[$this->pk]['value'] : '';

    echo $query;

	    // Execute query
	    $this->execute($query);
	    
	    // Get and store last insert id on INSERT
	    if(!$this->field[$this->pk]['value']) {
    	    $this->field[$this->pk]['value'] = $this->last_insert_id();
	    }
	    
	}

    /**
	 * Dump object data as an array
	 *
	 * @return array of object data
	 */
	public function dump(){
	    $return = array();
	    foreach($this->field as $k=>$v){
	        $return[$k] = $v['value'];
	    }
	    return $return;
	}
}

