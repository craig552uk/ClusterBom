<?php
/**
 * A simple Curl wrapper class
 *
 * @author Craig Russell
 */
class Curl{

    /* Curl Connection */
    private $c;
    
    /* HTTP Response Code */
    private $http_code;
       
    /**
     * Issue an HTTP GET request
     */
    public function get($uri, $headers=array()){
    
        $this->c = curl_init();
        
        curl_setopt($this->c, CURLOPT_URL, $uri);
        curl_setopt($this->c, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($this->c, CURLOPT_RETURNTRANSFER,1);
        
        $response = curl_exec ($this->c);
        $this->http_code = curl_getinfo($this->c, CURLINFO_HTTP_CODE);
        curl_close ($this->c);
        return $response;
    }
    
    /**
     * Issue an HTTP POST request
     */
    public function post($uri, $params=array()){
    
        $params = implode('&', $params);
        $this->c = curl_init();
    
        curl_setopt($this->c, CURLOPT_URL, $uri);
        curl_setopt($this->c, CURLOPT_POST, 1);
        curl_setopt($this->c, CURLOPT_POSTFIELDS, $params);
        curl_setopt($this->c, CURLOPT_RETURNTRANSFER,1);
        
        $response = curl_exec ($this->c);
        $this->http_code = curl_getinfo($this->c, CURLINFO_HTTP_CODE);
        curl_close ($this->c);
        return $response;
    }
    
    /**
     * Get HTTP Code
     */
    public function responseCode(){
        return $this->http_code;
    }

}
