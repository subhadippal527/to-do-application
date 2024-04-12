<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('todo_model');
        $this->load->library(array('form_validation', "upload"));
    }

	public function index()
	{
		$this->load->view('admin/registration');
	}
    public function register_form()
	{

        $param['name']=$this->input->post('name');
        $param['email']=$this->input->post('email');
        $param['phone']=$this->input->post('phone');
        $param['password']=md5($this->input->post('confirm_password'));
        $csrf_token = $this->security->get_csrf_hash();

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric|is_unique[user.phone]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            // Form validation failed, set error messages
            $flag = 0;
            $msg = validation_errors();
            $req = '';
        } else {

        $getResult = $this->todo_model->form_data_insert($param);
    
        if ($getResult) {
            $flag = 1;
            $msg = 'Thank You. You Register successfully.';
            $req = base_url('login');
        } 
        else 
        {
            $flag = 0;
            $msg = 'Something wrong! Please try again.';
            $req = '';
        }
    }
        echo json_encode(array('csrf_token' => $csrf_token,'flag' => $flag, 'msg' => $msg,'req' => $req));
        exit();
	}

    public function login()
	{
        if($this->session->userdata('user_data') != 0){
            redirect('home');  
        }else{
		$this->load->view('admin/login');
        }
	}
    
    public function login_form() {
        $email_phone = $this->input->post('email_phone');
        $password = $this->input->post('password');

        $this->form_validation->set_rules('email_phone', 'Email/Phone', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            // Form validation failed, set error messages
            $flag = 0;
            $msg = validation_errors();
            $req = '';
        } else {

           // $getResult=$this->todo_model->login($email_phone, $password);
        
            if ($this->todo_model->login($email_phone, $password)) {
                $flag = 1;
                $msg = 'Thank You. You Register successfully.';
                $req = base_url('home');
            } 
            else 
            {
                $flag = 0;
                $msg = 'Invalid email/phone or password';
                $req = '';
            }
        }
        echo json_encode(array('flag' => $flag, 'msg' => $msg,'req' => $req));
        exit();
    }
    public function home()
	{
        // echo 'eqwfw'; exit;
        if ($this->session->userdata('user_data')) {

            $data['login_data'] = $this->session->userdata('user_data');
            $data['list_data'] = $this->todo_model->list_data($data['login_data'][0]['id']);
            //print_r($data['list_data']); exit;
            $this->load->view('admin/home', $data);
        } else {
            redirect('login');
        }
    }

    public function add_tesk()
	{
        // echo 'eqwfw'; exit;
        if ($this->session->userdata('user_data')) {

            $param['task_add']=$this->input->post('task_add');
            $param['user_id']=$this->input->post('user_id');
    
            $this->form_validation->set_rules('task_add', 'task_add', 'required');
            if ($this->form_validation->run() == FALSE) {
                // Form validation failed, set error messages
                $flag = 0;
                $msg = validation_errors();
            } else {
    
            $getResult = $this->todo_model->insert_tesk($param);
        
            if ($getResult) {
                $flag = 1;
                $msg = 'Thank You. Your task added successfully.';
            } 
            else 
            {
                $flag = 0;
                $msg = 'Something wrong! Please try again.';
            }
        }
            echo json_encode(array('flag' => $flag, 'msg' => $msg));
            exit();
        } else {
            redirect('login');
        }
    }

    public function edit_tesk()
	{
        // echo 'eqwfw'; exit;
        if ($this->session->userdata('user_data')) {

            $param['task_add']=$this->input->post('task_add');
            $id=$this->input->post('hidden_id');
    
            $this->form_validation->set_rules('task_add', 'task_add', 'required');
            if ($this->form_validation->run() == FALSE) {
                // Form validation failed, set error messages
                $flag = 0;
                $msg = validation_errors();
            } else {
    
            $getResult = $this->todo_model->update_tesk($id,$param);
        
            if ($getResult) {
                $flag = 1;
                $msg = 'Thank You. Your task added successfully.';
            } 
            else 
            {
                $flag = 0;
                $msg = 'Something wrong! Please try again.';
            }
        }
            echo json_encode(array('flag' => $flag, 'msg' => $msg));
            exit();
        } else {
            redirect('login');
        }
    }

    public function status()
    {
        if ($this->session->userdata('user_data')) {
        $status = 0;
        $id = $this->input->post('id');
        // echo  $id; exit;
        $status_value = $this->input->post('status_value');
        $data = array('status' => $status_value);
        $statusvalue = $this->todo_model->updateStatus($id,$data);
        //echo $statusvalue; exit;
        //$csrf_token = $this->security->get_csrf_hash();
        if($statusvalue > 0)
        {
            $status = 1;
        }
        else{
            $status = 1;
        }

        echo json_encode(array('status'=>$status));
        exit();

        } else {
            redirect('login');
        }
    }

    public function delete($id)
    {
        if ($this->session->userdata('user_data')) {
            $data = $this->todo_model->delete_task($id);
            redirect(base_url().'home');
        } else {
            redirect('login');
        }
    }
    public function edit($id)
    {
        if ($this->session->userdata('user_data')) {    
            $data = $this->todo_model->edit_task($id);
            //print_r($data);exit;
            echo json_encode($data);
            exit();
            
        } else {
            redirect('login');
        }
    }

    public function logout() {
        $this->session->unset_userdata('user_data');
        redirect('login');
    }


}

