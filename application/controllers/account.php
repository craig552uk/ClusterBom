<?php
/**
 * Account Controller Class 
 *
 * This is the default controller
 *
 */
class Account extends Controller {
	
    /**
     * Default controller function
     */
	public function index()
    {
        // Default view
        $this->profile();
	}
	
	/**
     * Account profile
     */
	public function profile()
    {
        // Secure access only
        if($this->session->isAuth()) { header('Location: '.BASE_URL); }
        
        // Get user data
        $user = $this->load->model('User');
        $user->loadByEmail( $this->session->email );
        
        // Load view
        $template = $this->load->view('app/user-profile');
        $template->set('title','Account');
        $template->set('message', "Account Profile");
        $template->set('session', $this->session);
        $template->set('account', $user);
        $template->render();
	}
	
	/**
     * Account payment plan
     */
	public function plan()
    {
        // Secure access only
        if($this->session->isAuth()) { header('Location: '.BASE_URL); }
        
        // Load view
        $template = $this->load->view('app/dummy');
        $template->set('title','Account');
        $template->set('message', "Account Payment Plan");
        $template->set('session', $this->session);
        $template->render();
	}
	
	/**
     * help
     */
	public function help()
    {
        // Secure access only
        if($this->session->isAuth()) { header('Location: '.BASE_URL); }
        
        // Load view
        $template = $this->load->view('app/dummy');
        $template->set('title','Account');
        $template->set('message', "Help");
        $template->set('session', $this->session);
        $template->render();
	}
	
	/**
	 * Sign up for account
	 */
	public function register(){
	
	    echo '<pre>';
	    print_r($_POST);
	    echo '</pre>';
	    
	    // Get params from submitted form
	    $name     = (isset($_POST['name']))     ? $_POST['name'] : '';
        $email    = (isset($_POST['email']))    ? $_POST['email'] : '';
        $password = (isset($_POST['password'])) ? $_POST['password'] : '';
        
        echo $name.' '.$email.' '.$password.'</br>';
        echo strpos($email, '@').'</br>';
        echo strlen($password).'</br>';
        
        // Sanity check
        if(($name==='')||($email==='')||($password==='')){
            $signup_error = 'All fields are required';
        }
        
        // Email validity TODO better email check
        elseif(strpos($email, '@') === false){
            $signup_error = 'Email must be valid';
        }
        
        // Password Length TODO use decent policy
        elseif(strlen($password) < 8){
            $signup_error = 'Password must be at least 8 characters';
        }
        
        // Form validation
        if(isset($signup_error)){
            // Error
            $view = $this->load->view('index');
            $view->set('signup_error', $signup_error);
            $view->render();
        }else{
            // Create account
            $user = $this->load->model('User');
            $user->name = $name;
            $user->email = $email;
            $user->save();          // Save to get id
            $user->password = sha1('RdGBEe8scaJx'.$user->id.$password);
            // Create session
            $this->session->create($email, $name);
            // Increment count
            $user->login_count++;   // Increment login count
            $user->save();
            // Go home
            header('Location: '.BASE_URL);
        }
	}
    
}

