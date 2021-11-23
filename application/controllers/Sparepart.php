<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sparepart extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("sparepart_model");
		$this->load->model("transaksi_model");
		$this->load->library('form_validation');
	}


   

    public function edit($id)
    {
         $this->load->helper('form_helper');

         
         $data = array (                      
             //dropdown part number dari item sprpart
            'dd_barang' => $this->transaksi_model->dd_barang(),
            'barang_selected' => $this->input->post('kode_barang') ? $this->input->post('kode_barang') : '$row->kode_barang', // 
            
            'dd_customer' => $this->transaksi_model->dd_customer(),
            'customer_selected' => $this->input->post('nama_customer') ? $this->input->post('nama_customer') : '$row->customer_id', // untuk edit ganti 
            );

        $data['sp_dipesan'] = $this->sparepart_model->getById($id);
        $data['customer'] = $this->sparepart_model->get_customer();
        $this->load->view('sparepart/edit_sp_dipesan', $data);
    }

    public function update_po_dipesan()
    {
        // $this->form_validation->set_rules('nama_departemen', 'Nama Departemen', 'trim|required');
        // if ($this->form_validation->run()==true)
        // {
            $id = $this->input->post('id');
            $data['kode_barang'] = $this->input->post('kode_barang');
            $data['customer_id'] = $this->input->post('customer_id');
            $data['jumlah'] = $this->input->post('jumlah');
            $data['tanggal_order'] = $this->input->post('tanggal_order');
            $data['nomor_po'] = $this->input->post('nomor_po');
            $data['keterangan'] = $this->input->post('keterangan');
            $data['updated_at'] = $this->updated_at = date('Y-m-d H:i:s'); 
            $data['updated_by'] = $this->updated_by = $this->session->userdata('ses_id');
            
            $this->sparepart_model->update($data, $id);
            $this->session->set_flashdata('update', 'Data Berhasil Diubah');
            redirect('sparepart/sp_dipesan');
        //}else{
            /*$id = $this->input->post('id_dept');
            $data['departemen'] = $this->Dept_model->getDeptById($id);
            
            $this->load->view('departemen/edit', $data);*/
        //}
    }

    //Sparepart Po Ke Supplier
    public function po_supplier()
    {
        $data['po_supplier'] = $this->sparepart_model->getPoSupplier();
        $this->load->view('sparepart/po_supplier', $data);
    }

    public function add_po_supplier()
    {
        $this->load->helper('form_helper');
        $data = array (                      
            //dropdown part number dari sprpart masuk
            'kode_barang' => $this->transaksi_model->kode_barang(),
            'kode_barang_selected' => $this->input->post('kode_barang') ? $this->input->post('kode_barang') : '$row->kode_barang', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi

            //dropdown part number dari item sprpart
            'dd_barang' => $this->transaksi_model->dd_barang(),
            'barang_selected' => $this->input->post('kode_barang') ? $this->input->post('kode_barang') : '$row->kode_barang', // 
            
            'dd_supplier' => $this->transaksi_model->dd_supplier(),
            'supplier_selected' => $this->input->post('nama_supplier') ? $this->input->post('nama_supplier') : '$row->customer_id', // untuk edit ganti          
        );

        $po_supplier = $this->sparepart_model;
        $validation = $this->form_validation();
        $validation->set_rules($po_supplier->rules());

        if ($validation->run()) {
            $po_supplier->save_po_supplier();
            $this->session->set_flashdata('success', 'Berhasil Disimpan');

        }

        $this->load->view('sparepart/add_po_supplier', $data);
    }

    //Sparepart Po Ke Supplier


    //Sparepart Dipesan
	public function sp_dipesan()
	{
		$data["sp_dipesan"] = $this->sparepart_model->getAll();
		$this->load->view("sparepart/sp_dipesan", $data);
		
	}

	//save product to db
    function save_sp_dipesan()
    {	
    	$status_id   = $this->input->post('status_id',TRUE);
    	$kode_barang   = $this->input->post('kode_barang',TRUE);
    	$customer_id   = $this->input->post('customer_id',TRUE);
    	$jumlah   = $this->input->post('jumlah',TRUE);
    	$tanggal_order   = $this->input->post('tanggal_order',TRUE);
    	$nomor_po   = $this->input->post('nomor_po',TRUE);
    	$keterangan   = $this->input->post('keterangan',TRUE);
    	$created_at   = $this->created_at = date('Y-m-d H:i:s');		
        $created_by    = $this->created_by = $this->session->userdata('ses_id');
        
        $this->sparepart_model->save_sp_dipesan($status_id, $kode_barang, $customer_id, $jumlah, $tanggal_order, $nomor_po, $keterangan, $created_at, $created_by);
       $this->session->set_flashdata('simpan', 'Data Berhasil Ditambahkan');
        redirect('sparepart/sp_dipesan');
    }

	public function add()
	{
		$this->load->helper('form_helper');
        $data = array (                      
            //dropdown part number dari sprpart masuk
            'kode_barang' => $this->transaksi_model->kode_barang(),
            'kode_barang_selected' => $this->input->post('kode_barang') ? $this->input->post('kode_barang') : '$row->kode_barang', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi

            //dropdown part number dari item sprpart
            'dd_barang' => $this->transaksi_model->dd_barang(),
            'barang_selected' => $this->input->post('kode_barang') ? $this->input->post('kode_barang') : '$row->kode_barang', // 
            
            'dd_customer' => $this->transaksi_model->dd_customer(),
            'customer_selected' => $this->input->post('nama_customer') ? $this->input->post('nama_customer') : '', // untuk edit ganti          
    	);

		// $sp_dipesan =  $this->sparepart_model;
		// $validation = $this->form_validation;
		// $validation->set_rules($sp_dipesan->rules());

		// if ($validation->run()) {
		// 	$sp_dipesan->save();
		// 	redirect('sparepart/sp_dipesan');
		// 	$this->session->set_flashdata('success', 'Berhasil disimpan');
			
		// }

		$this->load->view("sparepart/add_sp_dipesan", $data);
	}

	public function get_edit()
    {
    	$id = $this->uri->segment(3);
        $data['id'] = $id;
        $data['kode_barang'] = $this->transaksi_model->dd_barang();
        $data['customer'] = $this->transaksi_model->dd_customer();
        $get_data = $this->sparepart_model->get_data_by_id($id);
       /* if($get_data->num_rows() > 0){
            $row = $get_data->row_array();
            $data['kode_barang'] = $row['customer'];
        }*/
        $this->load->view('sparepart/edit_sp_dipesan', $data);
    }

	public function get_data_by_id()
    {
        $id = $this->input->post('id',TRUE);
        $data = $this->sparepart_model->get_data_by_id($id);
        echo json_encode($data);
    }

    /*public function update_sp_dipesan()
    // {
       
    // 	$kode_barang   = $this->input->post('kode_barang',TRUE);
    // 	$customer_id   = $this->input->post('customer_id',TRUE);
    // 	$jumlah   = $this->input->post('jumlah',TRUE);
    // 	$tanggal_order   = $this->input->post('tanggal_order',TRUE);
    // 	$nomor_po   = $this->input->post('nomor_po',TRUE);
    // 	$keterangan   = $this->input->post('keterangan',TRUE);
    // 	$updated_at   = $this->updated_at = date('Y-m-d H:i:s');		
    //     $updated_by    = $this->updated_by = $this->session->userdata('ses_id');
        
    //     $this->sparepart_model->update_sp_dipesan($kode_barang, $customer_id, $jumlah, $tanggal_order, $nomor_po, $keterangan, $updated_at, $updated_by);
    //    $this->session->set_flashdata('update', 'Data Berhasil Diubah');
    //     redirect('sparepart/sp_dipesan');
    // }*/



	public function delete_sp_dipesan()
    {
        if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2')
            {
                $id = $this->input->post('id');
                $this->sparepart_model->delete_sparepart_dipesan($id);
                if ($this->db->affected_rows() > 0) {
                    echo "<script>alert('Data berhasil dihapus')</script>";
                }
                echo "<script>window.location='".site_url('sparepart/sp_dipesan')."';</script>";
                //$this->session->set_flashdata('delete', 'Data Berhasil Dihapus');

            }else{
                    echo "Anda tidak berhak mengakses halaman ini";
            }
    }

}

/* End of file  */
/* Location: ./application/controllers/ */