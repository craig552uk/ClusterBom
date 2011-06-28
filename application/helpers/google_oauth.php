<?php
/**
 * Google OAuth Class
 *
 * @author Craig Russell
 */
/**
 * Class Name GoogleOAuth
 */
include('curl.php');

class Google_oAuth 
{
    /* Internal params */
    private $params;
    private $error_code;
    
    /* Public params */
    public $code;
    public $access_token;
    public $refresh_token;
    
    /* Curl object */
    private $curl;
    
    /**
     * Constructor
     *
     * @param string $client_id     Client Identifier
     * @param string $client_secret client secret key
     * @param string $redirect_uri  URI to redirect back to after authentication
     * @param string $scope         Scope of request
     */
    public function construct ($client_id, $client_secret, $redirect_uri, $scope)
    {
        $this->params['auth_uri']       = 'https://accounts.google.com/o/oauth2/auth';
        $this->params['token_uri']      = 'https://accounts.google.com/o/oauth2/token';
        $this->params['client_id']      = urlencode($client_id);
        $this->params['client_secret']  = urlencode($client_secret);
        $this->params['redirect_uri']   = urlencode($redirect_uri);
        $this->params['scope']          = urlencode($scope);
        $this->params['response_type']  = 'code';
        $this->code = '';               // TODO populate with values from
        $this->access_token = '';       // TODO session if available
        $this->refresh_token = '';      // TODO
        $this->curl = new Curl();
    }

    /*
     * Function getAuthURL
     *
     * @return string   Authentication Request URL
     */
    public function getAuthURL()
    {
        $return  =                    $this->params['auth_uri']     . '?';
        $return .= 'client_id='     . $this->params['client_id']    . '&';
        $return .= 'redirect_uri='  . $this->params['redirect_uri'] . '&';
        $return .= 'scope='         . $this->params['scope']        . '&';
        $return .= 'response_type=' . $this->params['response_type'];        
        return $return;
    }
    
    /*
     * Function isError
     *
     * @return boolean  Has an error occurred
     */
    public function isError()
    {
        if( isset($_GET['error']) ){
            $this->error_code = $_GET['error'];
            return 1;
        }
        return 0;
    }
    
    /*
     * Function getLastError
     *
     * @return string   The code of the last error to have occurred
     */
    public function getLastError()
    {
        $this->isError();
        return $this->error_code;
    }
    
    /*
     * Function isValidResponse
     *
     * @return boolean  Has the initial request returned a valid response
     */
    public function isValidResponse()
    {
        return isset($_GET['code']);
    }
    
    /*
     * Function getTokens
     *
     * @return string   Access token
     */
    public function getToken()
    {
        if($this->isValidResponse()){
            
            // Get and store authorisation code
            $this->code = $_GET['code'];
            
            // Create data string
            $data[] = 'code='          . $this->code;
            $data[] = 'client_id='     . $this->params['client_id'];
            $data[] = 'client_secret=' . $this->params['client_secret'];
            $data[] = 'redirect_uri='  . $this->params['redirect_uri'];
            $data[] = 'grant_type='    . 'authorization_code';

            // Execute, get response and close
            $response = $this->curl->post($this->params['token_uri'], $data);
            $response = json_decode($response);
            
            echo '<pre>';
            print_r($response);
            echo '</pre>';
            
            // Verify response
            if ( isset($response->error)){
                // Error
                $this->error_code = $response->error;
                return 0;
            }else{
                // OK
                $this->access_token = $response->access_token;
                $this->refresh_token = $response->refresh_token;
                
                return $response->access_token;
            }
        }
        return '';
    }
    
    /*
     * Function refreshToken
     *
     * @return string   Access Token
     */
    public function refreshToken($refresh_token)
    {
        $this->refresh_token = $refresh_token;
                        
        // Create data string
        $data[] = 'client_id='     . $this->params['client_id'];
        $data[] = 'client_secret=' . $this->params['client_secret'];
        $data[] = 'refresh_token=' . $this->refresh_token;
        $data[] = 'grant_type='    . 'refresh_token';
        
        // Execute, get response and close
        $response = $this->curl->post($this->params['token_uri'], $data);
        
        $response = json_decode($response);
        
        // Verify response
        if ( isset($response->error)){
            // Error
            $this->error_code = $response->error;
            return 0;
        }else{
            // OK
            $this->access_token = $response->access_token;
            return $response->access_token;
        }
    }

    /*
     * Function getParams
     *
     * @return array    All configuration parameters
     */
    public function getParams()
    {
        $return = $this->params;
        $return['code'] = $this->code;
        $return['access_token'] = $this->access_token;
        $return['refresh_token'] = $this->refresh_token;
        return $return;
    }
}
