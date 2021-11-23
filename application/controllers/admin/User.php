<?php
class User extends CI_Controller
{
	function __construct()
	{
        parent::__construct();
        //validasi jika user belum login
    if($this->session->userdata('masuk') != TRUE){
            $url=base_url();
            redirect($url);
        }
        $this->load->model('user_model');
    }


    function user()
    {
    	if($this->session->userdata('akses')=='1'){
    		$this->load->view('user/user');
    	}else{
      			echo "Anda tidak berhak mengakses halaman ini";
    		}
    }

    function data_user()
    {
    	$data = $this->user_model->get_user();
        echo json_encode($data);
    }

    function save_user()
    {
    	$nip = $this->input->post('nip');
    	$nama = $this->input->post('nama');
    	$pass = $this->input->post('pass');

    	$data = $this->user_model->save_user($nip, $nama, $pass);
        echo json_encode($data);
    }

    function get_user()
    {
    	$nip=$this->input->get('nip');
        $data=$this->user_model->get_user_by_id($nip);
        echo json_encode($data);
    }

    function update_user()
  	{
        
        $nip=$this->input->post('nip');
        $nama=$this->input->post('nama');
        $pass = $this->input->post('pass');
        
        $data=$this->user_model->update_user($nip, $nama, $pass);
        echo json_encode($data);

    }

    function delete_user()
    {
        $nip=$this->input->post('nip');
        $data=$this->user_model->delete_user($nip);
        echo json_encode($data);
    }


//admin
    function admin()
    {
    	if($this->session->userdata('akses')=='1'){
    		$this->load->view('user/admin');
    	}else{
      			echo "Anda tidak berhak mengakses halaman ini";
    		}
    }

    function data_admin()
    {
    	$data = $this->user_model->get_admin();
        echo json_encode($data);
    }

    function save_admin()
    {
    	$nip = $this->input->post('nip');
    	$nama = $this->input->post('nama');
    	$pass = $this->input->post('pass');
    	$level = $this->input->post('level');

    	$data = $this->user_model->save_admin($nip, $nama, $pass, $level);
        echo json_encode($data);
    }

    function get_admin()
    {
    	$nip=$this->input->get('nip');
        $data=$this->user_model->get_admin_by_id($nip);
        echo json_encode($data);
    }

    function update_admin()
  	{
        
        $nip = $this->input->post('nip');
        $nama = $this->input->post('nama');
        $pass = $this->input->post('pass');
        $level = $this->input->post('level');
        
        $data=$this->user_model->update_admin($nip, $nama, $pass, $level);
        echo json_encode($data);

    }

    function delete_admin()
    {
        $nip=$this->input->post('nip');
        $data=$this->user_model->delete_admin($nip);
        echo json_encode($data);
    }

    
}