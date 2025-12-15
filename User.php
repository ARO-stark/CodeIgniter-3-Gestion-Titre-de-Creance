<?php
    class User extends CI_controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('User_model');
        }
        function add()
        {
            if($_SERVER['REQUEST_METHOD']=='POST')
            {
                $username = $this->input->post('username');
                $email = $this->input->post('email');
                $address = $this->input->post('address');
                $mobile = $this->input->post('mobile');
                $data = array(
                    'username' => $username,
                    'email' => $email,
                    'address' => $address,
                    'mobile' => $mobile
                    
                );

            
                $status = $this->User_model->insertUser($data);
                if($status == true)
                {
                    $this->session->set_flashdata('success', 'Successfully added');
                    redirect(base_url('index.php/user/add'));
                }else
                {
                    $this->session->set_flashdata('error', 'Error');
                    $this->load->view('user/add_user');
                }
              
                
            }else{
                $this->load->view('user/add_user');
            }
        }


        function index()
        {
            $data['users'] = $this->User_model->getUsers(); 
            $this->load->view('user/index', $data);
            
        }
        function edit($id)
        {
            $data['user'] = $this->User_model->getUser($id);
            $data['id'] = $id;
            if($_SERVER['REQUEST_METHOD']=='POST')
            {
                $data['user'] = $this->User_model->getUser($id);
                $username = $this->input->post('username');
                $email = $this->input->post('email');
                $address = $this->input->post('address');
                $mobile = $this->input->post('mobile');
                $data = array(
                    'username' => $username,
                    'email' => $email,
                    'address' => $address,
                    'mobile' => $mobile
                    
                );

            
                $status = $this->User_model->updateUser($data,$id);
                if($status == true)
                {
                    $this->session->set_flashdata('success', 'Successfully updated');
                    redirect(base_url('index.php/user/edit/'.$id));
                }else
                {
                    $this->session->set_flashdata('error', 'Error');
                    $this->load->view('user/edit_user');
                }
              
                
            }
            $this->load->view('user/edit_user', $data);
            
        }
        function delete($id){
            if(is_numeric($id))
            {
                $status = $this->User_model->deleteUser($id);
                if($status == true)
                {
                    $this->session->set_flashdata('success', 'Successfully delete');
                    redirect(base_url('index.php/user/index/'));
                }
                else
                {
                    $this->session->set_flashdata('error', 'Error');
                    redirect(base_url('index.php/user/index/'));
                }
            }
        }
            
    }
        