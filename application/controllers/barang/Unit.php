<?php
class Unit extends CI_Controller
{
	function __construct()
	{
        parent::__construct();
        //validasi jika user belum login
    if($this->session->userdata('masuk') != TRUE){
            $url=base_url();
            redirect($url);
        }
        $this->load->model('unit_model');
         $this->load->model('order_model');

    }


    //type unit
  function type_unit()
  {
    $this->load->view('barang/read_type_unit');
  }

  function get_type_unit_by_id()
  {
        $id = $this->input->get('id');
        $data = $this->unit_model->get_type_unit_by_id($id);
        echo json_encode($data);
  }

   function data_type_unit()
  {
        $data=$this->unit_model->data_type_unit();
        echo json_encode($data);
  }

  function simpan_type_unit()
  {
        $nama_unit = $this->input->post('nama_unit');
        $created_by = $this->input->post('created_by');
        $created_at = $this->input->post('created_at');
        
        $data = $this->unit_model->simpan_type_unit($nama_unit, $created_by, $created_at);
        echo json_encode($data);
  }

  function update_type_unit()
  {
        $id = $this->input->post('id');
        $nama_unit = $this->input->post('nama_unit');       
        $updated_by = $this->input->post('updated_by');

        $data = $this->unit_model->update_type_unit($id, $nama_unit, $updated_by);
        echo json_encode($data);
    }

    function delete_type_unit()
    {
        $id=$this->input->post('id');
        $data=$this->unit_model->delete_type_unit($id);
        echo json_encode($data);
    }
    // end type unit

   
    //model unit  
  function model_unit()
  {
        $this->load->helper('form_helper');
        $data = array(   
            'dd_type_unit' => $this->unit_model->dd_type_unit(),
            'type_unit_selected' => $this->input->post('nama_unit') ? $this->input->post('nama_unit') : '$row->id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi

        );
    $this->load->view('barang/read_model_unit', $data);
  }

  function get_model_unit_by_id()
  {
        $id_model = $this->input->get('id_model');
        $data = $this->unit_model->get_model_unit_by_id($id_model);
        echo json_encode($data);
  }

   function data_model_unit()
  {
        $data=$this->unit_model->data_model_unit();
        echo json_encode($data);
  }

  function simpan_model_unit()
  {
        $model = $this->input->post('model');
        $type_id = $this->input->post('type_id');
        $created_by = $this->input->post('created_by');
        $created_at = $this->input->post('created_at');
        
        $data = $this->unit_model->simpan_model_unit($model, $type_id, $created_by, $created_at);
        echo json_encode($data);
  }

  function update_model_unit()
  {
        $id_model = $this->input->post('id_model');
        $model = $this->input->post('model');
        $type_id = $this->input->post('type_id');       
        $updated_by = $this->input->post('updated_by');

        $data = $this->unit_model->update_model_unit($id_model, $model, $type_id, $updated_by);
        echo json_encode($data); 
    }

    function delete_model_unit()
    {
        $id_model = $this->input->post('id_model');
        $data=$this->unit_model->delete_model_unit($id_model);
        echo json_encode($data);
    }

    //end model unit
	
    

  // master unit
  function data_unit()
  {
    $data = array(
            'type_unit' => $this->unit_model->get_type_unit(),
            'model_unit' => $this->unit_model->get_model(),
            'type_selected' => '',
            'model_selected' => '',
        );
    $this->load->view('barang/read_unit', $data);
  }
    // untuk edit
    /*public function edit()
    {
        // realnya ambil data dari database, misalnya kita dapatkan data sbb:
        $id_kecamatan = 4;
        // kita ambil data selected nya untuk selected option
        $selected = $this->Chain_model->get_selected_by_id_kecamatan($id_kecamatan);
        $data = array(
            'provinsi' => $this->Chain_model->get_provinsi(),
            'kota' => $this->Chain_model->get_kota(),
            'kecamatan' => $this->Chain_model->get_kecamatan(),
            'provinsi_selected' => $selected->id_provinsi,
            'kota_selected' => $selected->id_kota,
            'kecamatan_selected' => $selected->id_kecamatan,
        );
        $this->load->view('chain', $data);
    }*/
   

  function get_unit_by_id()
  {
        $id = $this->input->get('id');
        $data = $this->unit_model->get_unit_by_id($id);
        echo json_encode($data);
  }

   function data_master_unit()
  {
        $data=$this->unit_model->data_master_unit();
        echo json_encode($data);
  }

  function simpan_unit()
  {
        $type_id = $this->input->post('type_id');
        $model = $this->input->post('model');
        $serial_number = $this->input->post('serial_number');
        $pressure = $this->input->post('pressure');
        $created_by = $this->input->post('created_by');
        $created_at = $this->input->post('created_at');
        
        $data = $this->unit_model->simpan_unit($type_id, $model, $serial_number, $pressure, $created_by, $created_at);
        echo json_encode($data);
  }

  function update_unit()
  {
        $id = $this->input->post('id');
        $type_id = $this->input->post('type_id');
        $model=$this->input->post('model');
        $serial_number = $this->input->post('serial_number');
        $pressure = $this->input->post('pressure');
        $update_by = $this->input->post('update_by');

        $data = $this->unit_model->update_unit($id, $type_id, $model, $serial_number, $pressure, $update_by);
        echo json_encode($data);
    }

    function delete_unit()
    {
        $id=$this->input->post('id');
        $data=$this->unit_model->delete_unit($id);
        echo json_encode($data);
    }

    // end master unit //

//unit dipesan//

     function unit_dipesan()
    {
        $this->load->helper('form_helper');
        $data = array(                      

            'type_unit' => $this->unit_model->get_type_unit(),
            'model_unit' => $this->unit_model->get_model(),
            
            'type_selected' => '',
            'model_selected' => '',
           

           'dd_supplier' => $this->unit_model->dd_supplier(),
            'supplier_selected' => $this->input->post('nama_supplier') ? $this->input->post('nama_supplier') : '$row->supplier_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
        );

        $this->load->view('barang/unit_dipesan', $data);
    }

  function data_unit_dipesan()
  {
    $data = $this->unit_model->unit_dipesan();
    echo json_encode($data);
  }

  function add_unit_dipesan()
  {
    $this->load->helper('form_helper');
        $data = array(                      

          'type_unit' => $this->unit_model->get_type_unit(),
            'model_unit' => $this->unit_model->get_model(),
            
            'type_selected' => '',
            'model_selected' => '',

           'dd_customer' => $this->unit_model->dd_customer(),
            'customer_selected' => $this->input->post('nama_customer') ? $this->input->post('nama_customer') : '$row->customer_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
    );

    $this->load->view('barang/add_unit_dipesan', $data);
  }

  function save_unit_dipesan()
    {
        $type_id = $this->input->post('type_id');
        $model_id = $this->input->post('model_id');
        $pressure = $this->input->post('pressure');
        $voltase = $this->input->post('voltase');
        $serial_number = $this->input->post('serial_number');
        $status_id = $this->input->post('status_id');
        $customer_id = $this->input->post('customer_id');
        $jumlah = $this->input->post('jumlah');

        $tanggal_order = $this->input->post('tanggal_order');        
        $nomor_po=$this->input->post('nomor_po');       
        $keterangan=$this->input->post('keterangan');
        $created_by = $this->input->post('created_by');
        $created_at = $this->input->post('created_at');
       
        
        $this->unit_model->save_unit_dipesan($type_id, $model_id, $pressure, $voltase, $serial_number, $status_id, $customer_id, $jumlah, $tanggal_order, $nomor_po, $keterangan, $created_by, $created_at);
            redirect('barang/unit/unit_dipesan');       
  
  }

  function get_unit_dipesan_add_unit_keluar()
  {

        $id = $this->input->get('id');

        $data = $this->unit_model->get_unit_dipesan_add_unit_keluar_id($id);
        echo json_encode($data);
  } 

  function update_unit_dipesan_add_unit_keluar()
  {
        $id = $this->input->post('id');
        $type_id = $this->input->post('type_id');
        $model_id = $this->input->post('model_id');
        $pressure = $this->input->post('pressure');
        $voltase = $this->input->post('voltase');
        $serial_number = $this->input->post('serial_number');
        $status_id = $this->input->post('status_id');
        $customer_id = $this->input->post('customer_id');
        $jumlah = $this->input->post('jumlah');
        $tanggal_order = $this->input->post('tanggal_order');
        $nomor_po = $this->input->post('nomor_po');
        $nomor_surat_jalan = $this->input->post('nomor_surat_jalan');
        $tanggal = $this->input->post('tanggal');
        $keterangan = $this->input->post('keterangan');
        $updated_by = $this->input->post('updated_by');
        
        $data = $this->unit_model->update_unit_dipesan_add_unit_keluar($id, $type_id, $model_id, $pressure, $voltase, $serial_number, $status_id, $customer_id, $jumlah, $tanggal_order, $nomor_po, $nomor_surat_jalan, $tanggal, $keterangan, $updated_by);
        echo json_encode($data);
    }

      function delete_unit_dipesan()
  {
    if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2')
        {
        $id=$this->input->post('id');
        $data=$this->unit_model->delete_unit_dipesan($id);
        echo json_encode($data);
        }else{
                echo "Anda tidak berhak mengakses halaman ini";
             }
  }
    //end unit dopesan//


    //stock unit
    function stock_unit()
    {
        $this->load->view('barang/unit_ready');
    }

    function data_stock_unit()
    {
        $data=$this->unit_model->data_unit_list();
        echo json_encode($data);
    }

    

    //unit masuk
 	function unit_masuk()
    {
        $this->load->helper('form_helper');
        $data = array(
            'dd_supplier' => $this->unit_model->dd_supplier(),
            'supplier_selected' => $this->input->post('nama_supplier') ? $this->input->post('nama_supplier') : '$row->supplier_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
            
            'dd_customer' => $this->unit_model->dd_customer(),
            'customer_selected' => $this->input->post('nama_customer') ? $this->input->post('nama_customer') : '$row->customer_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi

            'dd_type_unit' => $this->order_model->dd_type_unit(),
            'type_unit_selected' => $this->input->post('nama_unit') ? $this->input->post('nama_unit') : '$row->type_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi

            'dd_model_unit' => $this->order_model->dd_model_unit(),
            'model_unit_selected' => $this->input->post('model') ? $this->input->post('model') : '$row->model_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
            
            'type_unit' => $this->unit_model->get_type_unit(),
            'model_unit' => $this->unit_model->get_model(),
           
            'type_selected' => '',
            'model_selected' => '',
           
            
    );

        $this->load->view('transaksi/unit_masuk', $data);
        
    }

	function data_unit_masuk()
	{


        $data=$this->unit_model->unit_masuk_list();
        echo json_encode($data);
    }

    function add_unit_masuk()
    {
        if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2')
        {
        $this->load->helper('form_helper');
        $data = array(
            'dd_supplier' => $this->unit_model->dd_supplier(),
            'supplier_selected' => $this->input->post('nama_supplier') ? $this->input->post('nama_supplier') : '$row->supplier_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
            
            'dd_customer' => $this->unit_model->dd_customer(),
            'customer_selected' => $this->input->post('nama_customer') ? $this->input->post('nama_customer') : '$row->customer_id',
            
            'type_unit' => $this->unit_model->get_type_unit(),
            'model_unit_dd' => $this->unit_model->get_model(),
         
            'type_selected' => '',
            'model_selected' => '',   
        );
        
        $this->load->view('transaksi/add_unit_masuk', $data);
        }else{
        echo "Anda tidak berhak mengakses halaman ini";
        }
    }

    function save_unit_masuk()
    {        
        $id = $this->input->post('id');
        $type_id = $this->input->post('type_id');
        $model_id = $this->input->post('model_id');
        $pressure = $this->input->post('pressure');
        $voltase = $this->input->post('voltase');
        $serial_number = $this->input->post('serial_number');
        $status_id = $this->input->post('status_id');
        $supplier_id = $this->input->post('supplier_id');
        $tanggal_order = $this->input->post('tanggal_order');
        $jumlah = $this->input->post('jumlah');
        $nomor_po = $this->input->post('nomor_po');
        $tanggal = $this->input->post('tanggal');
        $status_pemesanan = $this->input->post('status_pemesanan');
        $customer_id = $this->input->post('customer_id');
        $nomor_penawaran = $this->input->post('nomor_penawaran');
        $po_customer = $this->input->post('po_customer');
        $tanggal_po_customer = $this->input->post('tanggal_po_customer');
        $keterangan =$this->input->post('keterangan');
        $created_by = $this->input->post('created_by');
        $created_at = $this->input->post('created_at');
       
        
        $this->unit_model->save_unit_masuk($type_id, $model_id, $pressure, $voltase, $serial_number, $status_id, $supplier_id, $tanggal_order, $jumlah, $nomor_po, $tanggal, $status_pemesanan, $customer_id, $nomor_penawaran, $po_customer, $tanggal_po_customer, $keterangan, $created_by, $created_at);
            redirect('barang/unit/unit_masuk');
       
  
  }

 function get_unit_masuk()
  {

        $id=$this->input->get('id');

        $data=$this->unit_model->get_unit_masuk_id($id);
        echo json_encode($data);
  } 

  function update_unit_masuk()
  {
        $id = $this->input->post('id');
        $pemesanan_id = $this->input->post('pemesanan_id');
        $type_id = $this->input->post('type_id');
        $model_id = $this->input->post('model_id');
        $pressure = $this->input->post('pressure');
        $voltase = $this->input->post('voltase');
        $serial_number = $this->input->post('serial_number');
        $status_id = $this->input->post('status_id');
        $supplier_id = $this->input->post('supplier_id');
        $tanggal_order = $this->input->post('tanggal_order');
        $jumlah = $this->input->post('jumlah');
        $nomor_po=$this->input->post('nomor_po');
        $tanggal = $this->input->post('tanggal');
        $status_pemesanan = $this->input->post('status_pemesanan');
        $customer_id = $this->input->post('customer_id');
        $nomor_penawaran = $this->input->post('nomor_penawaran');
        $po_customer = $this->input->post('po_customer');
        $tanggal_po_customer = $this->input->post('tanggal_po_customer');
        $keterangan =$this->input->post('keterangan');
        $updated_by = $this->input->post('updated_by');
        
        $data = $this->unit_model->update_unit_masuk($id, $pemesanan_id, $type_id, $model_id, $pressure, $voltase, $serial_number, $status_id, $supplier_id, $tanggal_order, $jumlah, $nomor_po, $tanggal, $status_pemesanan, $customer_id, $nomor_penawaran, $po_customer, $tanggal_po_customer, $keterangan, $updated_by);
        echo json_encode($data);
    }


    function delete_unit_masuk()
  {
    if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2')
        {
        $id=$this->input->post('id');
        $data=$this->unit_model->delete_unit_masuk($id);
        echo json_encode($data);
        }else{
                echo "Anda tidak berhak mengakses halaman ini";
        }
  }


//unit keluar
  function unit_keluar()
    {
        $this->load->helper('form_helper');
        $data = array(           
           
            'dd_customer' => $this->unit_model->dd_customer(),
            'customer_selected' => $this->input->post('nama_customer') ? $this->input->post('nama_customer') : '$row->customer_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi

            'dd_unit' => $this->unit_model->dd_unit(),
            'unit_selected' => $this->input->post('model') ? $this->input->post('model') : '$row->model', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi

           
        );
       $this->load->view('transaksi/unit_keluar', $data);

    }

    function data_unit_keluar()
    {
        $data=$this->unit_model->unit_keluar_list();
        echo json_encode($data);
    }

    function add_unit_keluar()
    {
        $this->load->helper('form_helper');
        $data = array(           
           
            'dd_customer' => $this->unit_model->dd_customer(),
            'customer_selected' => $this->input->post('nama_customer') ? $this->input->post('nama_customer') : '$row->customer_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi

            'dd_pressure' => $this->unit_model->get_pressure_keluar(),
            'pressure_selected' => $this->input->post('pressure') ? $this->input->post('pressure') : '$row->pressure', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
            
            'dd_voltase' => $this->unit_model->get_voltase_keluar(),
            'voltase_selected' => $this->input->post('voltase') ? $this->input->post('voltase') : '$row->voltase', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
            
            
            'type_unit_keluar' => $this->unit_model->get_type_unit_keluar(),
            'model_unit' => $this->unit_model->get_model_keluar(),
            'serial_number' => $this->unit_model->get_serial_number_keluar(),
            'pressure' => $this->unit_model->get_pressure(),
            'voltase' => $this->unit_model->get_voltase(),
            
            'type_unit_keluar_selected' => '',
            'model_selected' => '',
            'serial_number_selected' => '',
            'pressure_selected' => '',
            'voltase_selected' => '',

           
        );

        $this->load->view('transaksi/add_unit_keluar', $data);
    }

    function save_unit_keluar()
    {
        if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2')
        {

            $type_id = $this->input->post('type_id');
            $model_id = $this->input->post('model_id');
            $serial_number = $this->input->post('serial_number');
            $pressure = $this->input->post('pressure');
            $voltase = $this->input->post('voltase');
            $status_id = $this->input->post('status_id');
            $customer_id = $this->input->post('customer_id');       
            $tanggal_po_customer = $this->input->post('tanggal_po_customer');
            $jumlah = $this->input->post('jumlah');
            $nomor_po = $this->input->post('nomor_po');
            $nomor_surat_jalan = $this->input->post('nomor_surat_jalan');
            $tanggal = $this->input->post('tanggal');
           
            $keterangan=$this->input->post('keterangan');
            $created_by = $this->input->post('created_by');
            $created_at = $this->input->post('created_at');
           
            
            $this->unit_model->save_unit_keluar($type_id, $model_id, $serial_number, $pressure, $voltase, $status_id, $customer_id, $tanggal_po_customer, $jumlah, $nomor_po, $nomor_surat_jalan, $tanggal, $keterangan, $created_by, $created_at);
                redirect('barang/unit/unit_keluar');
           }else{
                echo "Anda tidak berhak mengakses halaman ini";
        }
  
    }


    //SImpan Unit keluar dari PO Masuk
    function simpan_unit_keluar()
    {
            $po_masuk_id = $this->input->post('po_masuk_id');
            $type_id = $this->input->post('type_id');
            $model_id = $this->input->post('model_id');
            $serial_number = $this->input->post('serial_number');
            $pressure = $this->input->post('pressure');
            $voltase = $this->input->post('voltase');
            $jumlah = $this->input->post('jumlah');
            $status_id = $this->input->post('status_id');
            $customer_id = $this->input->post('customer_id'); 
            $po_customer = $this->input->post('po_customer');      
            $tanggal_po_customer = $this->input->post('tanggal_po_customer');
            $nomor_surat_jalan = $this->input->post('nomor_surat_jalan');
            $tanggal = $this->input->post('tanggal');
            $keterangan=$this->input->post('keterangan');
            $created_by = $this->input->post('created_by');
            $created_at = $this->input->post('created_at');
           
            
            $data = $this->unit_model->simpan_unit_keluar($po_masuk_id, $type_id, $model_id, $serial_number, $pressure, $voltase, $jumlah, $status_id, $customer_id, $po_customer, $tanggal_po_customer, $nomor_surat_jalan, $tanggal, $keterangan, $created_by, $created_at);
            echo json_encode($data);
      }

  function get_unit_keluar()
  {

        $id=$this->input->get('id');

        $data=$this->unit_model->get_unit_keluar_id($id);
        echo json_encode($data);
  } 


function update_unit_keluar()
  {
        $id = $this->input->post('id');
        $type_id = $this->input->post('type_id');
        $model_id = $this->input->post('model_id');
        $serial_number = $this->input->post('serial_number');
        $pressure = $this->input->post('pressure');
        $voltase = $this->input->post('voltase');
        $status_id = $this->input->post('status_id');
        $customer_id = $this->input->post('customer_id');
        $tanggal_po_customer = $this->input->post('tanggal_po_customer');
        $jumlah = $this->input->post('jumlah');
        $nomor_po=$this->input->post('nomor_po');
        $nomor_surat_jalan = $this->input->post('nomor_surat_jalan');
        $tanggal = $this->input->post('tanggal');
        $keterangan =$this->input->post('keterangan');
        $updated_by = $this->input->post('updated_by');
        
        $data = $this->unit_model->update_unit_keluar($id, $type_id, $model_id, $serial_number, $pressure, $voltase, $status_id, $customer_id, $tanggal_po_customer, $jumlah, $nomor_po, $nomor_surat_jalan, $tanggal, $keterangan, $updated_by);
        echo json_encode($data);
    }


     function delete_unit_keluar()
  {
    if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2')
        {
        $id=$this->input->post('id');
        $data=$this->unit_model->delete_unit_keluar($id);
        echo json_encode($data);
        }else{
                echo "Anda tidak berhak mengakses halaman ini";
        }
  }
  
  //LIst PO
    function po_unit()
    {
        $this->load->helper('form_helper');
        $data = array(
            'dd_supplier' => $this->unit_model->dd_supplier(),
            'supplier_selected' => $this->input->post('nama_supplier') ? $this->input->post('nama_supplier') : '$row->supplier_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
            'dd_customer' => $this->unit_model->dd_customer(),
            'customer_selected' => $this->input->post('nama_customer') ? $this->input->post('nama_customer') : '$row->customer_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi

            'dd_type_unit' => $this->order_model->dd_type_unit(),
            'type_unit_selected' => $this->input->post('nama_unit') ? $this->input->post('nama_unit') : '$row->type_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi

            'dd_model_unit' => $this->order_model->dd_model_unit(),
            'model_unit_selected' => $this->input->post('model') ? $this->input->post('model') : '$row->model_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi

            'type_unit' => $this->unit_model->get_type_unit(),
            'model_unit' => $this->unit_model->get_model(),
           
            'type_selected' => '',
            'model_selected' => '',

            'dd_pressure' => $this->unit_model->get_pressure_keluar(),
            'pressure_selected' => $this->input->post('pressure') ? $this->input->post('pressure') : '$row->pressure', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
            
            'dd_voltase' => $this->unit_model->get_voltase_keluar(),
            'voltase_selected' => $this->input->post('voltase') ? $this->input->post('voltase') : '$row->voltase', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
            
            
            'type_unit_keluar' => $this->unit_model->get_type_unit_keluar(),
            'model_unit' => $this->unit_model->get_model_keluar(),
            'serial_number' => $this->unit_model->get_serial_number_keluar(),
            'pressure' => $this->unit_model->get_pressure(),
            'voltase' => $this->unit_model->get_voltase(),
            
            'type_unit_keluar_selected' => '',
            'model_selected' => '',
            'serial_number_selected' => '',
            'pressure_selected' => '',
            'voltase_selected' => '',
           
            
    );

        $this->load->view('transaksi/po_unit', $data);
    }

    function data_po_unit()
    {


        $data=$this->unit_model->po_unit_list();
        echo json_encode($data);
    }

    function add_po_unit()
    {
        if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2')
        {
        $this->load->helper('form_helper');
        $data = array(
            'dd_supplier' => $this->unit_model->dd_supplier(),
            'supplier_selected' => $this->input->post('nama_supplier') ? $this->input->post('nama_supplier') : '$row->supplier_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
            'type_unit' => $this->unit_model->get_type_unit(),
            'model_unit_dd' => $this->unit_model->get_model(),
         
            'type_selected' => '',
            'model_selected' => '',   
        );
        
        $this->load->view('transaksi/add_po_unit', $data);
        }else{
        echo "Anda tidak berhak mengakses halaman ini";
        }
    }


    //PO Unit dari Customer
    function save_po_unit()
    {        
        $type_id = $this->input->post('type_id');
        $model_id = $this->input->post('model_id');
        $pressure = $this->input->post('pressure');
        $voltase = $this->input->post('voltase');
        $status_id = $this->input->post('status_id');
        $tanggal_po_customer = $this->input->post('tanggal_po_customer');       
        $po_customer = $this->input->post('po_customer');
        $customer_id = $this->input->post('customer_id');
        $jumlah = $this->input->post('jumlah');       
        // $status_barang = $this->input->post('status_barang');
        // $progress = $this->input->post('progress');
        $keterangan=$this->input->post('keterangan');
        $created_by = $this->input->post('created_by');
        $created_at = $this->input->post('created_at');
       
        
        $data = $this->unit_model->save_po_unit($type_id, $model_id, $pressure, $voltase, $status_id, $tanggal_po_customer, $po_customer, $customer_id, $jumlah, $keterangan, $created_by, $created_at);
        redirect('barang/unit/po_unit');
        //echo json_encode($data);
       
  
  }

 function get_po_unit()
  {

        $id=$this->input->get('id');

        $data=$this->unit_model->get_po_unit_id($id);
        echo json_encode($data);
  } 

  //simpan ke pemesanan unit
   function simpan_pemesanan_unit_po_unit()
    {        
        $type_id = $this->input->post('type_id');
        $model_id = $this->input->post('model_id');
        $po_masuk_id = $this->input->post('po_masuk_id');
        $status_id = $this->input->post('status_id');
        $pressure = $this->input->post('pressure');
        $voltase = $this->input->post('voltase');       
        $jumlah = $this->input->post('jumlah');
        $tanggal_order = $this->input->post('tanggal_order');
        $supplier_id = $this->input->post('supplier_id');
        $nomor_po = $this->input->post('nomor_po');
        $tanggal = $this->input->post('tanggal');
        $status_pemesanan = $this->input->post('status_pemesanan');
        $keterangan=$this->input->post('keterangan');
        $created_by = $this->input->post('created_by');
        $created_at = $this->input->post('created_at');
       
        
        $data = $this->unit_model->simpan_pemesanan_unit_po_unit($type_id, $model_id, $po_masuk_id, $status_id, $pressure, $voltase, $jumlah, $tanggal_order, $supplier_id, $nomor_po, $tanggal, $status_pemesanan, $keterangan, $created_by, $created_at);
           // redirect('barang/unit/po_unit');
        echo json_encode($data);
       
  
  }

  function update_po_masuk()
  {
        $id = $this->input->post('id');
        $type_id = $this->input->post('type_id');
        $model_id = $this->input->post('model_id');
        $pressure = $this->input->post('pressure');
        $voltase = $this->input->post('voltase');
        $status_id = $this->input->post('status_id');
        $customer_id = $this->input->post('customer_id');
        $tanggal_po_customer = $this->input->post('tanggal_po_customer');
        $po_customer = $this->input->post('po_customer');
        $jumlah = $this->input->post('jumlah');       
        $status_barang = $this->input->post('status_barang');
        $keterangan=$this->input->post('keterangan');
        $updated_by = $this->input->post('updated_by');
        
        $data = $this->unit_model->update_po_unit($id, $type_id, $model_id, $pressure, $voltase, $status_id, $customer_id, $tanggal_po_customer, $po_customer, $jumlah, $status_barang, $keterangan, $updated_by);
        echo json_encode($data);
    }
    
    function update_po_masuk_progress()
  {
        $id = $this->input->post('id');
        $progress=$this->input->post('progress');
        $updated_by = $this->input->post('updated_by');
        
        $data = $this->unit_model->update_po_masuk_progress($id, $progress, $updated_by);
        echo json_encode($data);
    }


    function delete_po_unit()
  {
    if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2')
        {
        $id=$this->input->post('id');
        $data=$this->unit_model->delete_unit_masuk($id);
        echo json_encode($data);
        }else{
                echo "Anda tidak berhak mengakses halaman ini";
        }
  }

  //Kirim ke database Unit Keluar
  function simpan_unit_keluar()
    {        
            $po_masuk_id = $this->input->post('po_masuk_id');
            $type_id = $this->input->post('type_id');
            $model_id = $this->input->post('model_id');
            $serial_number = $this->input->post('serial_number');
            $voltase = $this->input->post('voltase');
            $pressure = $this->input->post('pressure');
           
            $status_id = $this->input->post('status_id');
            $jumlah = $this->input->post('jumlah');
            $customer_id = $this->input->post('customer_id'); 
            
            $tanggal_po_customer = $this->input->post('tanggal_po_customer');
           
            $po_customer = $this->input->post('po_customer');
            $nomor_surat_jalan = $this->input->post('nomor_surat_jalan');
            $tanggal = $this->input->post('tanggal');
            $keterangan = $this->input->post('keterangan');
            $created_by = $this->input->post('created_by');
            $created_at = $this->input->post('created_at');
       
        
        $data = $this->unit_model->simpan_unit_keluar($po_masuk_id, $type_id, $model_id, $serial_number, $voltase, $pressure, $status_id, $jumlah, $customer_id, $tanggal_po_customer, $po_customer, $nomor_surat_jalan, $tanggal, $keterangan, $created_by, $created_at);
        //redirect('barang/unit/po_unit');
        echo json_encode($data);
       
  
  }

}