<?php
class Order extends CI_Controller
{
	function __construct()
	{
        parent::__construct();
        //validasi jika user belum login
    if($this->session->userdata('masuk') != TRUE){
            $url=base_url();
            redirect($url);
        }
        $this->load->model('order_model');
        $this->load->model('transaksi_model');
        $this->load->model('barang_model');
        $this->load->model('unit_model');
    }


//ORDER SPAREPART

    function read()
    {
    	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
            $this->load->helper('form_helper');
 
        $data = array(
            'dd_supplier' => $this->transaksi_model->dd_supplier(),
            'supplier_selected' => $this->input->post('nama_supplier') ? $this->input->post('nama_supplier') : '$row->supplier_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi

            'dd_barang' => $this->barang_model->dd_barang(),
            'barang_selected' => $this->input->post('kode_barang') ? $this->input->post('kode_barang') : '$row->kode_barang', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi 
          
          );
    		$this->load->view('barang/order', $data);
    	}else{
      			echo "Anda tidak berhak mengakses halaman ini";
    		}
    }


    function konfirmasi_pemesanan_sparepart()
    {
        if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
            $this->load->helper('form_helper');
 
        $data = array(
           
             'dd_kon_barang' => $this->order_model->dd_kon_barang(),
            'barang_selected' => $this->input->post('kode_barang') ? $this->input->post('kode_barang') : '$row->kode_barang', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi 
          
          );
            $this->load->view('barang/konfirmasi_sparepart', $data);
        }else{
                echo "Anda tidak berhak mengakses halaman ini";
            }
    }

    
    function data_order()
    {
    	$data = $this->order_model->order_list();
        echo json_encode($data);
    }

    function data_pemesanan_sparepart()
    {
        $data = $this->order_model->pemesanan_sparepart();
        echo json_encode($data);
    }

    function data_konfirmasi_pemesanan_sparepart()
    {
        $data = $this->order_model->konfirmasi_pemesanan_sparepart();
        echo json_encode($data);
    }

    function save_order()
    {    	
    	$kode_barang = $this->input->post('kode_barang');
    	$jumlah = $this->input->post('jumlah');
        $supplier_id = $this->input->post('supplier_id');
        $status_id = $this->input->post('status_id');
        $tanggal_order = $this->input->post('tanggal_order');
        $nomor_po = $this->input->post('nomor_po');
        $tanggal = $this->input->post('tanggal_sampai');
        $keterangan = $this->input->post('keterangan');
        $created_by = $this->input->post('created_by');
        $created_at = $this->input->post('created_at');

    	$data = $this->order_model->save_order($kode_barang, $jumlah, $supplier_id, $status_id, $tanggal_order, $nomor_po, $tanggal, $keterangan, $created_by, $created_at);
        echo json_encode($data);
    }
    
    //unit masuk dari pemesanan barang//
     function simpan_sparepart_masuk()
    {        
        $kode_barang = $this->input->post('kode_barang');
        $pemesanan_id = $this->input->post('pemesanan_id');
        $status_id = $this->input->post('status_id');
        $supplier_id = $this->input->post('supplier_id');
        $tanggal_order = $this->input->post('tanggal_order');
        $jumlah = $this->input->post('jumlah');
        $nomor_po=$this->input->post('nomor_po');
        $tanggal = $this->input->post('tanggal');
        $keterangan=$this->input->post('keterangan');
        $created_by = $this->input->post('created_by');
        $created_at = $this->input->post('created_at');       
        
       $data = $this->order_model->simpan_sparepart_masuk($kode_barang, $pemesanan_id, $status_id, $supplier_id, $tanggal_order, $jumlah, $nomor_po, $tanggal, $keterangan, $created_by, $created_at);
            //redirect('barang/unit/unit_masuk');
         echo json_encode($data);        
    }

    function save_konfirmasi_order()
    {       
        $kode_barang = $this->input->post('kode_barang');
        $pemesananbrg_id = $this->input->post('pemesananbrg_id');
        $jumlah = $this->input->post('jumlah');
        $tanggal = $this->input->post('tanggal');                  
        $keterangan = $this->input->post('keterangan');
        $created_by = $this->input->post('created_by');
        $created_at = $this->input->post('created_at');

        $data = $this->order_model->save_konfirmasi_order($kode_barang, $pemesananbrg_id, $jumlah, $tanggal, $keterangan, $created_by, $created_at);
        echo json_encode($data);
    }

    function get_order()
    {
    	$id = $this->input->get('id');
        $data = $this->order_model->get_order_by_id($id);
        echo json_encode($data);
    }

    function get_konfirmasi_order()
    {
        $id = $this->input->get('id');
        $data = $this->order_model->get_konfirmasi_order_by_id($id);
        echo json_encode($data);
    }
    
    function get_order_sparepart_masuk()
    {
        $id = $this->input->get('id');
        $data = $this->order_model->get_order_sparepart_masuk($id);
        echo json_encode($data);
    }
    
    function update_order()
  	{   
        $id = $this->input->post('id'); 
        $kode_barang = $this->input->post('kode_barang');
        $jumlah = $this->input->post('jumlah');       
        $supplier_id = $this->input->post('supplier_id');
        $tanggal_order = $this->input->post('tanggal_order');
        $nomor_po = $this->input->post('nomor_po');
        $tanggal = $this->input->post('tanggal');                   
        $keterangan = $this->input->post('keterangan'); 
        $updated_by = $this->input->post('updated_by');
        
        $data = $this->order_model->update_order($id, $kode_barang, $jumlah, $supplier_id, $tanggal_order, $nomor_po,  $tanggal, $keterangan, $updated_by);
        echo json_encode($data);
    }

    function update_konfirmasi_order()
    {   
        $id = $this->input->post('id'); 
        $kode_barang = $this->input->post('kode_barang');
        $jumlah = $this->input->post('jumlah');       
        $tanggal = $this->input->post('tanggal');                   
        $keterangan = $this->input->post('keterangan'); 
        $updated_by = $this->input->post('updated_by');
        $data = $this->order_model->update_konfirmasi_order($id, $kode_barang, $jumlah, $tanggal, $keterangan, $updated_by);
        echo json_encode($data);
    }

    function delete_order()
    {
        $id=$this->input->post('id');
        $data=$this->order_model->delete_order($id);
        echo json_encode($data);
    }

    function delete_konfirmasi_order()
    {
        $id=$this->input->post('id');
        $data=$this->order_model->delete_konfirmasi_order($id);
        echo json_encode($data);
    }

    // end order sparepart //

    

    //ORDER UNIT//
    
    function order_unit()
    {
        if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2')
        {
            $this->load->helper('form_helper');
 
        $data = array(
            'dd_supplier' => $this->order_model->dd_supplier(),
            'supplier_selected' => $this->input->post('nama_supplier') ? $this->input->post('nama_supplier') : '$row->supplier_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi

            'dd_customer' => $this->order_model->dd_customer(),
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
            $this->load->view('barang/order_unit', $data);
            //$this->load->view('errors/errorUnderMaintenance');

        }else{
                echo "Anda tidak berhak mengakses halaman ini";
             }
    }

    function konfirmasi_pemesanan_unit()
    {
        if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2')
        {
            $this->load->helper('form_helper');
        $data = array(

            'type_unit' => $this->order_model->get_type_unit_order(),
            'model_unit' => $this->order_model->get_model_unit_order(),
            
            'type_selected' => '',
            'model_selected' => '',
          );
            $this->load->view('barang/konfirmasi_unit', $data);
        }else{
                echo "Anda tidak berhak mengakses halaman ini";
             }
    }



//add po dari customer
    function add_po_customer()
    {
        $this->load->helper('form_helper');
            $data = array(
                'dd_supplier' => $this->order_model->dd_supplier(),
                'supplier_selected' => $this->input->post('nama_supplier') ? $this->input->post('nama_supplier') : '$row->supplier_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi

                 'dd_customer' => $this->order_model->dd_customer(),
                'customer_selected' => $this->input->post('nama_customer') ? $this->input->post('nama_customer') : '$row->customer_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
            
                'type_unit' => $this->unit_model->get_type_unit(),
                'model_unit' => $this->unit_model->get_model(),
                
                'type_selected' => '',
                'model_selected' => '',
               
              
              );

        $this->load->view('barang/add_po_customer', $data);
    }


  function add_order_unit()
  {
    $this->load->helper('form_helper');
        $data = array(
            'dd_supplier' => $this->order_model->dd_supplier(),
            'supplier_selected' => $this->input->post('nama_supplier') ? $this->input->post('nama_supplier') : '$row->supplier_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi

             'dd_customer' => $this->order_model->dd_customer(),
            'customer_selected' => $this->input->post('nama_customer') ? $this->input->post('nama_customer') : '$row->customer_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
        
            'type_unit' => $this->unit_model->get_type_unit(),
            'model_unit' => $this->unit_model->get_model(),
            
            'type_selected' => '',
            'model_selected' => '',
           
          
          );

    $this->load->view('barang/add_order_unit', $data);
  }
    
     function data_order_unit()
    {
        $data = $this->order_model->order_unit_list();
        echo json_encode($data);
    }

    function data_konfirmasi_pemesanan_unit()
    {
        $data = $this->order_model->konfirmasi_pemesanan_unit();
        echo json_encode($data);
    }
    
    function save_order_unit()
    {       
            $type_id = $this->input->post('type_id');
            $model_id = $this->input->post('model_id');
            $status_id = $this->input->post('status_id');
            $pressure = $this->input->post('pressure');
            $voltase = $this->input->post('voltase');
            $jumlah = $this->input->post('jumlah');
            $supplier_id = $this->input->post('supplier_id');
            $tanggal_order = $this->input->post('tanggal_order');
            $nomor_po = $this->input->post('nomor_po');      
            $tanggal = $this->input->post('tanggal');
            //$status_pemesanan = $this->input->post('status_pemesanan');
           // $customer_id = $this->input->post('customer_id');
            //$nomor_penawaran = $this->input->post('nomor_penawaran');
           // $po_customer = $this->input->post('po_customer');
           // $tanggal_po_customer = $this->input->post('tanggal_po_customer');
            $keterangan = $this->input->post('keterangan');
            $created_by = $this->input->post('created_by');
            $created_at = $this->input->post('created_at');

           
            $data = $this->order_model->save_order_unit($type_id, $model_id, $status_id, $pressure, $voltase, $supplier_id, $jumlah, $tanggal_order, $nomor_po, $tanggal, $keterangan, $created_by, $created_at);
        
        redirect('admin/order/order_unit');  
        
    }
    
     //unit masuk dari pemesanan barang//
     function simpan_unit_masuk()
    {        
        $type_id = $this->input->post('type_id');
        $model_id = $this->input->post('model_id');
        $pemesanan_id = $this->input->post('pemesanan_id');

        $pressure = $this->input->post('pressure');
        $voltase = $this->input->post('voltase');
        $serial_number = $this->input->post('serial_number');
        $status_id = $this->input->post('status_id');
        $supplier_id = $this->input->post('supplier_id');
        $tanggal_order = $this->input->post('tanggal_order');
        $jumlah = $this->input->post('jumlah');
        $nomor_po=$this->input->post('nomor_po');
        $tanggal = $this->input->post('tanggal');
        $keterangan=$this->input->post('keterangan');
        $created_by = $this->input->post('created_by');
        $created_at = $this->input->post('created_at');       
        
       $data = $this->order_model->simpan_unit_masuk($type_id, $model_id, $pemesanan_id, $pressure, $voltase, $serial_number, $status_id, $supplier_id, $tanggal_order, $jumlah, $nomor_po, $tanggal, $keterangan, $created_by, $created_at);
            //redirect('barang/unit/unit_masuk');
         echo json_encode($data);        
    }
    
    function save_konfirmasi_order_unit()
    {       
        $type_id = $this->input->post('type_id');
        $model_id = $this->input->post('model_id');
        $jumlah = $this->input->post('jumlah');
        $tanggal = $this->input->post('tanggal');                  
        $keterangan = $this->input->post('keterangan');
        $created_by = $this->input->post('created_by');
        $created_at = $this->input->post('created_at');

        $data = $this->order_model->save_konfirmasi_order_unit($type_id, $model_id, $jumlah, $tanggal, $keterangan, $created_by, $created_at);
        echo json_encode($data);
    }
    
    function get_order_unit()
    {
        $id = $this->input->get('id');
        $data = $this->order_model->get_order_unit_by_id($id);
        echo json_encode($data);
    }
    
     function get_order_unit_status()
    {
        $id = $this->input->get('id');
        $data = $this->order_model->get_order_unit_status_by_id($id);
        echo json_encode($data);
    }

    function get_konfirmasi_order_unit()
    {
        $id = $this->input->get('id');
        $data = $this->order_model->get_konfirmasi_order_unit_by_id($id);
        echo json_encode($data);
    }

     function get_edit_order_masuk()
    {
        $id = $this->input->get('id');
        $data = $this->order_model->get_order_unit_masuk($id);
        echo json_encode($data);
    }
    
    function update_order_unit()
    {   
        $id = $this->input->post('id');
        $type_id = $this->input->post('type_id');       
        $model_id = $this->input->post('model_id');
        $status_id = $this->input->post('status_id');
        $pressure = $this->input->post('pressure');
        $voltase = $this->input->post('voltase');
        $jumlah = $this->input->post('jumlah');
        $tanggal_order = $this->input->post('tanggal_order');
        $nomor_po = $this->input->post('nomor_po');
        $supplier_id = $this->input->post('supplier_id');       
        $tanggal = $this->input->post('tanggal');
        $status_pemesanan = $this->input->post('status_pemesanan');
        $customer_id = $this->input->post('customer_id');
        $nomor_penawaran = $this->input->post('nomor_penawaran');
        $po_customer = $this->input->post('po_customer');
        $tanggal_po_customer = $this->input->post('tanggal_po_customer');
        $keterangan = $this->input->post('keterangan'); 
        $updated_by = $this->input->post('updated_by');
        
        
        $data = $this->order_model->update_order_unit($id, $type_id, $model_id, $status_id, $pressure, $voltase, $jumlah, $tanggal_order, $nomor_po, $supplier_id, $tanggal, $status_pemesanan, $customer_id, $nomor_penawaran, $po_customer, $tanggal_po_customer, $keterangan, $updated_by);
        echo json_encode($data);

    }

    //updated progress PO ke Supplier
     function update_progress_order_unit()
    {   
        $id = $this->input->post('id');
        $progress = $this->input->post('progress');   
        
        $data = $this->order_model->update_progress_order_unit($id, $progress);
        echo json_encode($data);

    }
    
     function update_konfirmasi_order_unit()
    {   
        $id = $this->input->post('id');
        $type_id = $this->input->post('type_id');       
        $model = $this->input->post('model');
        $jumlah = $this->input->post('jumlah');       
        $tanggal = $this->input->post('tanggal');                   
        $keterangan = $this->input->post('keterangan'); 
        $updated_by = $this->input->post('updated_by');
        
        
        $data = $this->order_model->update_konfirmasi_order_unit($id, $type_id, $model, $jumlah, $tanggal, $keterangan, $updated_by);
        echo json_encode($data);

    }
    
     function update_order_unit_add_unit_masuk()
    {   
        $id = $this->input->post('id');
        $type_id = $this->input->post('type_id');       
        $model = $this->input->post('model');
        $serial_number = $this->input->post('serial_number');
        $status_id = $this->input->post('status_id');
        $jumlah = $this->input->post('jumlah');
        $tanggal_order = $this->input->post('tanggal_order');
        $nomor_po = $this->input->post('nomor_po');
        $supplier_id = $this->input->post('supplier_id');
        $nomor_surat_jalan = $this->input->post('nomor_surat_jalan');       
        $tanggal = $this->input->post('tanggal');                   
        $keterangan = $this->input->post('keterangan'); 
        $created_by = $this->input->post('created_by');
        
        
        $data = $this->order_model->update_order_unit_add_unit_masuk($id, $type_id, $model, $serial_number, $status_id, $supplier_id, $jumlah, $tanggal_order, $nomor_po, $nomor_surat_jalan, $tanggal, $keterangan, $created_by);
        echo json_encode($data);

    }
    
     function delete_order_unit()
    {
        $id=$this->input->post('id');
        $data=$this->order_model->delete_order_unit($id);
        echo json_encode($data);
    }

     function delete_konfirmasi_order_unit()
    {
        $id=$this->input->post('id');
        $data=$this->order_model->delete_konfirmasi_order_unit($id);
        echo json_encode($data);
    }
    
}