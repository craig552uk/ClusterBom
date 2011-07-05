<?php
/**
 * Dataset Controller Class 
 *
 */
class Dataset extends Controller {
	
    /**
     * Default controller function
     */
	public function index()
    {
        // Default view
        $this->all();
	}
	
	/**
     * Show all data sets
     */
	public function all()
    {
        // Secure access only
        if(!$this->session->isAuth()) { header('Location: '.BASE_URL); }
        
        // Get user ID
        $user = $this->load->model('User');
        $user->loadByEmail($this->session->email);
        
        // Create dataset object
        $dataset_list = $this->load->model('DataSetList');
        $dataset_list->buildList($user->id);
        
        // Get dataset lists
        $public_list = $dataset_list->getPublic();
        $user_list   = $dataset_list->getUser();
        
        // Load view
        $template = $this->load->view('app/dataset-list');
        $template->set('public_list', $public_list);
        $template->set('user_list', $user_list);
        $template->set('session', $this->session);
        $template->set('tab','DATA');
        $template->render();
	}
	
	/**
     * Edit a data set
     */
	public function edit()
    {
        // Secure access only
        if(!$this->session->isAuth()) { header('Location: '.BASE_URL); }
        
        // Load view
        $template = $this->load->view('app/dummy');
        $template->set('title','Datasets');
        $template->set('tab','DATA');
        $template->set('message', "Edit a dataset");
        $template->set('session', $this->session);
        $template->render();
	}
	
	/**
     * Import a data set
     */
	public function add()
    {
        // Secure access only
        if(!$this->session->isAuth()) { header('Location: '.BASE_URL); }
        
        // Default step
        $step = (isset($_POST['import-step'])) ? $_POST['import-step'] : 1;
        
        switch($step){
            case 1:
                $view = $this->load->view('app/dataset-add-1');
                break;
            case 2:
                $view = $this->load->view('app/dataset-add-2');
                $worksheet_uri = (isset($_POST['worksheet-uri'])) ? $_POST['worksheet-uri'] : '';
                $view->set('worksheet_uri', $worksheet_uri);
                break;
            case 3:
                // TODO Get headings data from POST and save in session
                $headings = array();
                // Get header labels
                foreach($_POST as $k=>$v){
                    $arr = explode('-', $k);
                    if(isset($arr[0]) && $arr[0]=='head'){
                        switch($arr[1]){
                            case 'label':
                                $headings[$arr[2]]->label = $v;
                                break;
                            case 'type':
                                $headings[$arr[2]]->type = $v;
                                break;
                        }
                    }
                }
                
                // Save in session
                $_SESSION['headings'] = $headings;
                
                $view = $this->load->view('app/dataset-add-3');
                $worksheet_uri = (isset($_POST['worksheet-uri'])) ? $_POST['worksheet-uri'] : '';
                $view->set('worksheet_uri', $worksheet_uri);
                break;
            case 4:
                $view = $this->load->view('app/dataset-add-4');
                break;
            case 5:
                // Import data so no view required
                break;
            default: // Same as 1
                $view = $this->load->view('app/dataset-add-1');
        }
        
        if($step < 5){
            // Pass data to view
            $view->set('title','Import a Dataset');
            $view->set('tab','DATA');
            $view->set('session', $this->session);
            
            
            // Check if we have tokens to access spreadsheets
            if( ($this->session->access_token !== false)
             && ($this->session->refresh_token) !== false ){
                $view->set('hastokens', true);
            }else{
                $view->set('hastokens', false);
            }
            
            // Render view
            $view->render();
        }else{
            // Final step
            header('Location: '.BASE_URL.'dataset/');
        }
	}
	
	/**
     * View a data set
     */
	public function view()
    {
        // Secure access only
        if(!$this->session->isAuth()) { header('Location: '.BASE_URL); }
        
        // Load view
        $template = $this->load->view('app/dummy');
        $template->set('title','Datasets');
        $template->set('message', "View a dataset");
        $template->set('session', $this->session);
        $template->set('tab','DATA');
        $template->render();
	}
	
	/**
	 * Load spreadsheets from google
	 * Assumes tokens exist in session
	 */
	public function spreadsheets(){
	
	    // Get config data in scope
        global $config;
        
        // Create Google oAuth object
        $ga = $this->load->helper('Google_oAuth');
        $ga->construct($config['oauth']['client_id'], 
                       $config['oauth']['client_secret'], 
                       $config['oauth']['redirect_uri'], 
                       $config['oauth']['scope']);
                       
        // Create Google Spreadsheet object
        $gss = $this->load->helper('Google_Spreadsheets');
        $gss->setToken($this->session->access_token);
        
        // Track attempts
        $attempt = 0;
        while($attempt<3){
            // Try to get data
            $spreadsheets = $gss->spreadsheets();

            // Test success
            if (!$gss->success()){
                // Refresh token
                $token = $ga->refreshToken($this->session->refresh_token);
                $gss->setToken($token);
                $attempt++;
            }else{
                $attempt=99;
            }
        }
        
        // Load and display view
        $view = $this->load->view('app/dataset-add-spreadsheets');
        $view->set('spreadsheets', $spreadsheets);
        $view->render(false); // No head or tail on ajax requests
	}
	
	/**
	 *
	 */
	public function worksheets(){
	    // Get config data in scope
        global $config;
        
        // Create Google oAuth object
        $ga = $this->load->helper('Google_oAuth');
        $ga->construct($config['oauth']['client_id'], 
                       $config['oauth']['client_secret'], 
                       $config['oauth']['redirect_uri'], 
                       $config['oauth']['scope']);
                       
	    // Get URI from url
	    $url = explode('/', $_SERVER['REQUEST_URI']);
	    $uri = urldecode(urldecode(array_pop($url)));
	    
	    // Create Gogole Spreadsheet object
	    $gss = $this->load->helper('Google_Spreadsheets');
        $gss->setToken($this->session->access_token);
        
        // Track attempts
        $attempt = 0;
        while($attempt<3){
            // Try to get data
            $worksheets = $gss->worksheets($uri);

            // Test success
            if (!$gss->success()){
                // Refresh token
                $token = $ga->refreshToken($this->session->refresh_token);
                $gss->setToken($token);
                $attempt++;
            }else{
                $attempt=99;
            }
        }
        
        // Load and display view
        $view = $this->load->view('app/dataset-add-worksheets');
        $view->set('worksheets', $worksheets);
        $view->render(false); // No head or tail on ajax requests
        
	}
	
	/**
	 * Asynchronously load worksheet to edit headings
	 */
	public function headings(){
	    // Get config data in scope
        global $config;
        
        // Create Google oAuth object
        $ga = $this->load->helper('Google_oAuth');
        $ga->construct($config['oauth']['client_id'], 
                       $config['oauth']['client_secret'], 
                       $config['oauth']['redirect_uri'], 
                       $config['oauth']['scope']);
                       
	    // Get URI from url
	    $url = explode('/', $_SERVER['REQUEST_URI']);
	    $uri = urldecode(urldecode(array_pop($url)));
	    
	    // Create Gogole Spreadsheet object
	    $gss = $this->load->helper('Google_Spreadsheets');
        $gss->setToken($this->session->access_token);
        
        // Track attempts
        $attempt = 0;
        while($attempt<3){
            // Try to get data
            $cells = $gss->cells($uri, true);

            // Test success
            if (!$gss->success()){
                // Refresh token
                $token = $ga->refreshToken($this->session->refresh_token);
                $gss->setToken($token);
                $attempt++;
            }else{
                $attempt=99;
            }
        }
	    
	    // Get max row and col values
	    $max_row = $cells['meta']['max_row'];
	    $max_col = $cells['meta']['max_col'];
	    
	    // Store cells data in session
	    $_SESSION['cells'] = $cells;
	    
	    // Load and render view
	    $view = $this->load->view('app/dataset-add-headings');
	    $view->set('max_row', $max_row);
	    $view->set('max_col', $max_col);
	    $view->set('cells', $cells);
	    $view->set('parent', $this);
	    $view->render(false);
	    
	}
	
	/**
	 * Asynchronously load worksheet cells
	 */
	public function cells(){
	    // Get cell data from session
	    $cells = $_SESSION['cells'];
	    
	    // Get max row and col values
	    $max_row = $cells['meta']['max_row'];
	    $max_col = $cells['meta']['max_col'];
	    
	    // Load and render view
	    $view = $this->load->view('app/dataset-add-cells');
	    $view->set('max_row', $max_row);
	    $view->set('max_col', $max_col);
	    $view->set('cells', $cells);
	    $view->set('parent', $this);
	    $view->set('headings', $_SESSION['headings']);
	    $view->render(false);
	    
	}
	
	/**
	 * Increment column value return next in sequence
	 */
	public function nextCol($col){
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
        'ZA','ZB','ZC','ZD','ZE','ZF','ZG','ZH','ZI','ZJ','ZK','ZL','ZM','ZN','ZO','ZP','ZQ','ZR','ZS','ZT','ZU','ZV','ZW','ZX','ZY','ZZ',);
	    
	    $k = array_search($col, $cols)+1;
        return $cols[$k];
	}
	
    
}

