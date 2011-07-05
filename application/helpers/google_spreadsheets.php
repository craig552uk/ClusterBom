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
            
            // Track size
            $max_col = 'A';
            $max_row = 0;
            
            // Extract data
            foreach($xml as $entry){
                if (isset($entry->id)){
                    // Get cell name and split in to row & col values
                    $k= $entry->title .'';
                    $row = preg_replace('/[A-Z]/', '', $k);
                    $col = preg_replace('/[0-9]/', '', $k);
                    
                    // Convert row letters to integer
                    $col = $this->colIndex($col);
                    
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
                    
                    // Increment max size
                    $max_col = ($col>$max_col) ? $col : $max_col;
                    $max_row = ($row>$max_row) ? $row : $max_row;
                }
            }
            
            // Append max lengths to array
            $return['meta'] = array();
            $return['meta']['max_row'] = $max_row;
            $return['meta']['max_col'] = $max_col;
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
    
    /**
     * convert alphabetic column notation to integer
     */
    public function colIndex($col){
	    // Column values
	    $cols = array(
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ',
        'BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ',
        'CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ',
        'DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ',
        'EA','EB','EC','ED','EE','EF','EG','EH','EI','EJ','EK','EL','EM','EN','EO','EP','EQ','ER','ES','ET','EU','EV','EW','EX','EY','EZ',
        'FA','FB','FC','FD','FE','FF','FG','FH','FI','FJ','FK','FL','FM','FN','FO','FP','FQ','FR','FS','FT','FU','FV','FW','FX','FY','FZ',
        'GA','GB','GC','GD','GE','GF','GG','GH','GI','GJ','GK','GL','GM','GN','GO','GP','GQ','GR','GS','GT','GU','GV','GW','GX','GY','GZ',
        'HA','HB','HC','HD','HE','HF','HG','HH','HI','HJ','HK','HL','HM','HN','HO','HP','HQ','HR','HS','HT','HU','HV','HW','HX','HY','HZ',
        'IA','IB','IC','ID','IE','IF','IG','IH','II','IJ','IK','IL','IM','IN','IO','IP','IQ','IR','IS','IT','IU','IV','IW','IX','IY','IZ',
        'JA','JB','JC','JD','JE','JF','JG','JH','JI','JJ','JK','JL','JM','JN','JO','JP','JQ','JR','JS','JT','JU','JV','JW','JX','JY','JZ',
        'KA','KB','KC','KD','KE','KF','KG','KH','KI','KJ','KK','KL','KM','KN','KO','KP','KQ','KR','KS','KT','KU','KV','KW','KX','KY','KZ',
        'LA','LB','LC','LD','LE','LF','LG','LH','LI','LJ','LK','LL','LM','LN','LO','LP','LQ','LR','LS','LT','LU','LV','LW','LX','LY','LZ',
        'MA','MB','MC','MD','ME','MF','MG','MH','MI','MJ','MK','ML','MM','MN','MO','MP','MQ','MR','MS','MT','MU','MV','MW','MX','MY','MZ',
        'NA','NB','NC','ND','NE','NF','NG','NH','NI','NJ','NK','NL','NM','NN','NO','NP','NQ','NR','NS','NT','NU','NV','NW','NX','NY','NZ',
        'OA','OB','OC','OD','OE','OF','OG','OH','OI','OJ','OK','OL','OM','ON','OO','OP','OQ','OR','OS','OT','OU','OV','OW','OX','OY','OZ',
        'PA','PB','PC','PD','PE','PF','PG','PH','PI','PJ','PK','PL','PM','PN','PO','PP','PQ','PR','PS','PT','PU','PV','PW','PX','PY','PZ',
        'QA','QB','QC','QD','QE','QF','QG','QH','QI','QJ','QK','QL','QM','QN','QO','QP','QQ','QR','QS','QT','QU','QV','QW','QX','QY','QZ',
        'RA','RB','RC','RD','RE','RF','RG','RH','RI','RJ','RK','RL','RM','RN','RO','RP','RQ','RR','RS','RT','RU','RV','RW','RX','RY','RZ',
        'SA','SB','SC','SD','SE','SF','SG','SH','SI','SJ','SK','SL','SM','SN','SO','SP','SQ','SR','SS','ST','SU','SV','SW','SX','SY','SZ',
        'TA','TB','TC','TD','TE','TF','TG','TH','TI','TJ','TK','TL','TM','TN','TO','TP','TQ','TR','TS','TT','TU','TV','TW','TX','TY','TZ',
        'UA','UB','UC','UD','UE','UF','UG','UH','UI','UJ','UK','UL','UM','UN','UO','UP','UQ','UR','US','UT','UU','UV','UW','UX','UY','UZ',
        'VA','VB','VC','VD','VE','VF','VG','VH','VI','VJ','VK','VL','VM','VN','VO','VP','VQ','VR','VS','VT','VU','VV','VW','VX','VY','VZ',
        'WA','WB','WC','WD','WE','WF','WG','WH','WI','WJ','WK','WL','WM','WN','WO','WP','WQ','WR','WS','WT','WU','WV','WW','WX','WY','WZ',
        'XA','XB','XC','XD','XE','XF','XG','XH','XI','XJ','XK','XL','XM','XN','XO','XP','XQ','XR','XS','XT','XU','XV','XW','XX','XY','XZ',
        'YA','YB','YC','YD','YE','YF','YG','YH','YI','YJ','YK','YL','YM','YN','YO','YP','YQ','YR','YS','YT','YU','YV','YW','YX','YY','YZ',
        'ZA','ZB','ZC','ZD','ZE','ZF','ZG','ZH','ZI','ZJ','ZK','ZL','ZM','ZN','ZO','ZP','ZQ','ZR','ZS','ZT','ZU','ZV','ZW','ZX','ZY','ZZ');
	    
	    return array_search($col, $cols);
	}
}
