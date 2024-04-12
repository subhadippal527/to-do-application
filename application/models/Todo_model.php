<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo_model extends CI_Model {


    public function form_data_insert($param) {
        $data=$this->db->insert('user',$param);
        return $data;
    }
    public function login($email_phone, $password) {

        $this->db->select('*');
        $this->db->from('user');
        $this->db->group_start();
        $this->db->where('email', $email_phone)->or_where('phone', $email_phone);
        $this->db->group_end();
        $this->db->where('password', md5($password));
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $result = $query->result_array();
            $this->session->set_userdata('user_data', $result);
            return true;
            
        }
        return false;
    }
    public function insert_tesk($param) {
        $data=$this->db->insert('task',$param);
        return $data;
    }
    public function list_data($id) {
        $data=$this->db->where('user_id', $id)->order_by("id", "desc")->get('task')->result_array();
        return $data;
    }
    function updateStatus($id,$data)
    {

        $data=$this->db->where('id',$id)->update('task',$data);
        return $data;
    }
    function delete_task($id)
    {
        $data=$this->db->where('id',$id)->delete('task');
        return $data;
    }
    public function edit_task($id) {
        $data=$this->db->where('id', $id)->get('task')->result_array();
        return $data;
    }
    
    function update_tesk($id,$param)
    {

        $data=$this->db->where('id',$id)->update('task',$param);
        return $data;
    }
    
}