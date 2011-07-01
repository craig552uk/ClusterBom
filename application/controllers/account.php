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
        if(!$this->session->isAuth()) { header('Location: '.BASE_URL); }
        
        if(isset($_POST['submit'])){
            $this->update_account();
        }else{
            // Get user data
            $user = $this->load->model('User');
            $user->loadByEmail( $this->session->email );
            
            // Load view
            $template = $this->load->view('app/user-profile');
            $template->set('title','Account');
            $template->set('message', "Account Profile");
            $template->set('session', $this->session);
            $template->set('account', $user);
            $template->set('tab', 'ACC');
            $template->render();
        }
	}

	/**
	 * Save changes to account
	 */
	private function update_account(){
	    // Get data from post
	    $name     = (isset($_POST['name']))     ? $_POST['name'] : '';
        $email    = (isset($_POST['email']))    ? $_POST['email'] : '';
        $old_pass = (isset($_POST['old_pass'])) ? $_POST['old_pass'] : '';
        $new_pass = (isset($_POST['new_pass'])) ? $_POST['new_pass'] : '';
        
        // Create user object
        $user = $this->load->model('User');
        $user->loadByEmail( $this->session->email );
        
        // Prepare view
        $view = $this->load->view('app/user-profile');
        
        /* Account Update */
        if(($name != $user->name) || ($email != $user->email)){
            // Sanity check
            if(($name=='') || ($email=='')){
                $details_error = 'Name and email cannot be empty';
            }
            // Email validity TODO better email check
            elseif(strpos($email, '@') === false){
                $details_error = 'Email must be valid';
            }
            
            // Handle errors
            if(isset($details_error)){
                $view->set('details_error', $details_error);
            }else{
                $view->set('details_success', 'Changes successfully saved');
                // Save changes
                $user->name = $name;
                $user->email = $email;
                $user->save();
            }
        }
        
        /* Password Change */
        if(($old_pass=='') && ($new_pass=='')){
            // do nowt
        }else{
            // Password changing
        
            // Error password failure
            $old_pass = sha1('RdGBEe8scaJx'.$user->id.$old_pass);
            if($user->password != $old_pass ){
                $password_error = 'Current password incorrect';
            }
            // Password Length TODO use decent policy
            elseif(strlen($new_pass) < 8){
                $password_error = 'New password must be at least 8 characters';
            }
            
            // Handle errors
            if(isset($password_error)){
                $view->set('password_error', $password_error);
            }else{
                $view->set('password_success', 'Password successfully changed');
                $user->password = sha1('RdGBEe8scaJx'.$user->id.$new_password);
                $user->save();
            }
        }
        
        // Render view
        $view->set('title','Account');
        $view->set('message', "Account Profile");
        $view->set('session', $this->session);
        $view->set('account', $user);
        $template->set('tab', 'ACC');
        $view->render();
        
	}
		
	/**
     * Account payment plan
     */
	public function plan()
    {
        // Secure access only
        if(!$this->session->isAuth()) { header('Location: '.BASE_URL); }
        
        // Load view
        $template = $this->load->view('app/dummy');
        $template->set('title','Plan');
        $template->set('message', "Account Payment Plan");
        $template->set('session', $this->session);
        $template->set('tab', 'PLAN');
        $template->set('settings', true); // Just for dummy view
        $template->render();
	}
	
	/**
     * help
     */
	public function help()
    {
        // Secure access only
        if(!$this->session->isAuth()) { header('Location: '.BASE_URL); }
        
        // Load view
        $template = $this->load->view('app/dummy');
        $template->set('title','Help');
        $template->set('message', "Help");
        $template->set('session', $this->session);
        $template->set('tab', 'HELP');
        $template->set('settings', true); // Just for dummy view
        $template->render();
	}
    
}

