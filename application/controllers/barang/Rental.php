<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rental extends CI_Controller {

	function __construct()
	{
    
    parent::__construct();
        //validasi jika user belum login
    if($this->session->userdata('masuk') != TRUE){
            $url=base_url();
            redirect($url);
        }
        $this->load->model('rental_model');
        $this->load->model('unit_model');
    }



    //data master unit rental
    function unit_rental()
    {
	   	$unit_rental = $this->rental_model->data_unit_rental();   
	    $data['unit_rental'] = $unit_rental;
	    $this->load->view('rental/data_rental', $data);
    }

    //data list rental
    function list_rental()
    {
    	$data = array(
			'dd_model_id' => $this->rental_model->dd_model_id(),
            'model_id_selected' => $this->input->post('model') ? $this->input->post('model') : '$row->model_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi

            'dd_customer' => $this->unit_model->dd_customer(),
            'customer_selected' => $this->input->post('nama_customer') ? $this->input->post('nama_customer') : '$row->customer_id',

            'dd_unit_rental' => $this->rental_model->dd_unit_rental(),
            'unit_rental_selected' => $this->input->post('model') ? $this->input->post('model') : '$row->id',
		);
		$this->load->view('rental/unit_rental', $data);
    }

	public function index()
	{
		$data = array(
			'dd_model_id' => $this->rental_model->dd_model_id(),
            'model_id_selected' => $this->input->post('model') ? $this->input->post('model') : '$row->model_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi

            'dd_customer' => $this->unit_model->dd_customer(),
            'customer_selected' => $this->input->post('nama_customer') ? $this->input->post('nama_customer') : '$row->customer_id',           
		);
		$this->load->view('rental/read', $data);
		
	}

	function data_unit_rental()
	{
		$data = $this->rental_model->data_unit_rental();
		echo json_encode($data);
	}

	function data_rental()
	{
		$data = $this->rental_model->data_rental();
		echo json_encode($data);
	}

    function save_unit_rental()
    {
       
        $model_id = $this->input->post('model_id');
        $pressure = $this->input->post('pressure');
        $serial_number = $this->input->post('serial_number');
        $keterangan_unit = $this->input->post('keterangan_unit');  
        $created_by = $this->input->post('created_by');
        $created_at = $this->input->post('created_at');  
       
        
       $data = $this->rental_model->save_unit_rental($model_id, $pressure, $serial_number, $keterangan_unit, $created_by, $created_at);
       echo json_encode($data);
           // redirect('barang/unit/unit_dipesan');  
    }
    
	 function save_rental()
    {
       
        $unit_rental_id = $this->input->post('unit_rental_id');
        $customer_id = $this->input->post('customer_id');
        $nomor_po = $this->input->post('nomor_po');
        $tanggal_kirim = $this->input->post('tanggal_kirim');
        $keterangan = $this->input->post('keterangan');
        $created_by = $this->input->post('created_by');
        $created_at = $this->input->post('created_at');
       
        
       $data = $this->rental_model->save_rental($unit_rental_id, $customer_id, $nomor_po, $tanggal_kirim, $keterangan, $created_by, $created_at);
       echo json_encode($data);
           // redirect('barang/unit/unit_dipesan');  
  }

  	function get_unit_rental()
  	{
  		$id = $this->input->get('id');
  		$data = $this->rental_model->get_unit_rental($id);
  		echo json_encode($data);
  	}

	function get_rental()
	{
		$id = $this->input->get('id');
        $data = $this->rental_model->get_rental($id);
        echo json_encode($data);
	}

	function update_unit_rental()
	{
		$id = $this->input->post('id');
        $model_id = $this->input->post('model_id');
        $pressure = $this->input->post('pressure');
        $serial_number = $this->input->post('serial_number');
        $keterangan_unit = $this->input->post('keterangan_unit');
        $updated_by = $this->input->post('updated_by');
        $updated_at = $this->input->post('updated_at');

        $data = $this->rental_model->update_unit_rental($id, $model_id, $pressure, $serial_number, $keterangan_unit, $updated_by, $updated_at);
        echo json_encode($data);
	}

	function update_status_unit_rental()
	{
		$id = $this->input->post('id');
        $status_rental = $this->input->post('status_rental');
        $updated_by = $this->input->post('updated_by');
        $updated_at = $this->input->post('updated_at');

        $data = $this->rental_model->update_status_unit_rental($id, $status_rental, $updated_by, $updated_at);
        echo json_encode($data);
	}

	function update_rental()
	{
		$id = $this->input->post('id');
		$unit_rental_id = $this->input->post('unit_rental_id');
		$customer_id = $this->input->post('customer_id');       
        $nomor_po = $this->input->post('nomor_po');
        $tanggal_kirim = $this->input->post('tanggal_kirim');       
        $keterangan = $this->input->post('keterangan');
        $updated_by = $this->input->post('updated_by');
        
        $updated_at = $this->input->post('updated_at');
        
        $data = $this->rental_model->update_rental($id, $unit_rental_id, $customer_id, $nomor_po, $tanggal_kirim, $keterangan, $updated_by, $updated_at);
        echo json_encode($data);
	}

	function update_rental_kembali()
	{
		$id = $this->input->post('id');
		$tanggal_kembali = $this->input->post('tanggal_kembali');
		$kondisi = $this->input->post('kondisi');       
        $keterangan = $this->input->post('keterangan');
        $updated_by = $this->input->post('updated_by');
        
        $updated_at = $this->input->post('updated_at');
        
        $data = $this->rental_model->update_rental_kembali($id, $tanggal_kembali, $kondisi, $keterangan, $updated_by, $updated_at);
        echo json_encode($data);
	}

	function delete_rental()
  	{
    if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2')
        {
        $id=$this->input->post('id');
        $data=$this->rental_model->delete_rental($id);
        echo json_encode($data);
        }else{
                echo "Anda tidak berhak mengakses halaman ini";
             }
  	}


  	//detail rental dan history
  	function detail_unit_rental($model_id)
  	{

	    $detail = $this->rental_model->detail_unit_rental($model_id);
	   
	    $data['detail_unit_rental'] = $detail;
	    $this->load->view('rental/detail_unit_rental', $data);
  	}

  	/*function detail_unit_rental()
  	{
  		$model_id = $this->input->post('unit_rental_id');
  		$data = $this->rental_model->detail_unit_rental($unit_rental_id);
  		echo json_encode($data);
  	}*/


//rental monitoring



	public function rental_monitoring()
	{
		$this->load->view('barang/rental_monitoring');
	}

	function data_rental_monitoring()
	{
		$data = $this->rental_model->data_rental_monitoring();
		echo json_encode($data);
	}

	function save_rental_monitoring()
	{       
        $rental_id = $this->input->post('rental_id');
        $tanggal = $this->input->post('tanggal');
        $perihal = $this->input->post('perihal');
        $penggantian = $this->input->post('penggantian');
        $teknisi = $this->input->post('teknisi');
        $ket = $this->input->post('ket');
        $created_by = $this->input->post('created_by');
        $created_at = $this->input->post('created_at');
       
        
       $data = $this->rental_model->save_rental_monitoring($rental_id, $tanggal, $perihal, $penggantian, $teknisi, $ket, $created_by, $created_at);
       echo json_encode($data);
           // redirect('barang/unit/unit_dipesan');  
	}

	function get_rental_monitoring()
	{
		$id = $this->input->get('id');
        $data = $this->rental_model->get_rental_monitoring($id);
        echo json_encode($data);
	}

	function update_rental_monitoring()
	{
		$id = $this->input->post('id');
        $rental_id = $this->input->post('rental_id');
        $tanggal = $this->input->post('tanggal');
        $perihal = $this->input->post('perihal');
        $penggantian = $this->input->post('penggantian');
        $teknisi = $this->input->post('teknisi');
        $ket = $this->input->post('ket');
        $updated_by = $this->input->post('updated_by');
        
        $data = $this->rental_model->update_rental_monitoring($id, $rental_id, $tanggal, $perihal, $penggantian, $teknisi, $ket, $updated_by);
        echo json_encode($data);
	}

	function delete_rental_monitoring()
  	{
    if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2')
        {
        $id=$this->input->post('id');
        $data=$this->rental_model->delete_rental($id);
        echo json_encode($data);
        }else{
                echo "Anda tidak berhak mengakses halaman ini";
             }
  	}



}

/* End of file rental.php */
/* Location: ./application/controllers/rental.php */