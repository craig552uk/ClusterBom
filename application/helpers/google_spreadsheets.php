<?php
/**
 * Class to read data from Google Spreadsheets
 *
 * @author Craig Russell
 */
include_once('curl.php');

class Google_Spreadsheets{

    /* API Token */
    public $token;
    
    /* Request URIs */
    private $spreadsheets_uri = 'https://spreadsheets.google.com/feeds/spreadsheets/private/full';
    private $worksheets_uri   = 'https://spreadsheets.google.com/feeds/worksheets/KEY/private/values';
    private $cells_uri        = 'https://spreadsheets.google.com/feeds/cells/KEY/od6/private/values';
       
    /* Curl object */
    private $curl;
    
    /**
     * Constructor
     */
    public function setToken($token){
    
        // Store token
        $this->token = $token;
        
        $this->curl = new Curl();
    }
    
    
    
    /**
     * Get spreadsheets data
     */
    public function spreadsheets(){
    
        $return = array();
        
        // Request headers
        $headers[] = 'GData-Version: 3.0';
        $headers[] = "Authorization: OAuth ".$this->token;
        
        // Get response data
        $response = $this->curl->get($this->spreadsheets_uri, $headers);
        
        if($this->curl->responseCode() == 200){
        
            // Convert XMl Response
            $xml = simplexml_load_string($response);
            
            // Extract data
            foreach($xml as $entry){
                if (isset($entry->id)){
                    $s = null;
                    $s->title = $entry->title .'';
                    $s->uri = $entry->content->attributes()->src . '';
                    $s->updated = $this->ago(strtotime($entry->updated . ''));
                    $s->author->name = $entry->author->name .'';
                    $s->author->email = $entry->author->email .'';
                    // Append to array
                    $return[] = $s;
                }
            }
        }
        return $return;
    }

    /**
     * Get worksheets data
     */
    public function worksheets($uri){
    
        $return = array();
        
        // Request headers
        $headers[] = 'GData-Version: 3.0';
        $headers[] = "Authorization: OAuth ".$this->token;
        
        // Get response data
        $response = $this->curl->get($uri, $headers);
        
        if($this->curl->responseCode() == 200){
        
            // Convert XMl Response
            $xml = simplexml_load_string($response);
            
            // Extract data
            foreach($xml as $entry){
                if (isset($entry->id)){
                    $w = null;
                    $w->title = $entry->title .'';
                    $w->uri = str_replace('list', 'cells', $entry->content->attributes()->src . '');
                    $w->parent = $uri;
                    $w->updated = $this->ago(strtotime($entry->updated . ''));
                    // Append to array
                    $return[] = $w;
                }
            }
        }
        return $return;
    }
    
    /**
     * Get cells data
     */
    public function cells($uri, $invert=false){
    
        $return = array();
        
        // Request headers
        $headers[] = 'GData-Version: 3.0';
        $headers[] = "Authorization: OAuth ".$this->token;
        
        // Get response data
        $response = $this->curl->get($uri, $headers);
        
        if($this->curl->responseCode() == 200){
        
            // Convert XMl Response
            $xml = simplexml_load_string($response);
            
            // Extract data
            foreach($xml as $entry){
                if (isset($entry->id)){
                    // Get cell name and split in to row & col values
                    $k= $entry->title .'';
                    $row = preg_replace('/[0-9]/', '', $k);
                    $col = preg_replace('/[A-Z]/', '', $k);
                    
                    // Get cell value and filter
                    $val = $entry->content .'';
                    $val = filter_var($val, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
                    $val = filter_var($val, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
                    
                    // Append to 2D array
                    if(!$invert){
                        $return[$row][$col] = $val;
                    }else{
                        $return[$col][$row] = $val;
                    }
                }
            }
        }
        return $return;
    }
    
    /**
     * Returns false if an error has occured
     * Most likely the token has expired an must be renewed
     */
    public function success(){
        return $this->curl->responseCode() == 200;
    }
    
    /**
     * Date time ago
     * From http://www.zachstronaut.com/posts/2009/01/20/php-relative-date-time-string.html
     */
    private function ago($ptime){
        $etime = time() - $ptime;
    
        if ($etime < 1) {
            return '0 seconds';
        }
        
        $a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
                    30 * 24 * 60 * 60       =>  'month',
                    24 * 60 * 60            =>  'day',
                    60 * 60                 =>  'hour',
                    60                      =>  'minute',
                    1                       =>  'second'
                    );
        
        foreach ($a as $secs => $str) {
            $d = $etime / $secs;
            if ($d >= 1) {
                $r = round($d);
                return 'Last updated ' . $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
            }
        }
    }
}
