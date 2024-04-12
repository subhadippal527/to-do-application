<?php
class AuthMiddleware {
    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
    }

    public function checkAuth() {
        // Check if the user is logged in
        if (!$this->CI->session->userdata('logged_in')) {
            // Redirect to the login page or display an error message
            redirect('login');
        }
    }
}
