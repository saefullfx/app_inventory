<?php
class Transaksi extends CI_Controller
{
    private $filename = 'format';
    
	function __construct()
	{
        parent::__construct();
        //validasi jika user belum login
        if($this->session->userdata('masuk') != TRUE)
        {
            $url=base_url();
            redirect($url);
        }
        $this->load->model('transaksi_model');
    }
    
    
    //pencarian barang
    function pencarian()
    {
        if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
        $this->load->view('transaksi/pencarian');
         }else{
                echo "Anda tidak berhak mengakses halaman ini";
        }
    }

    function data_pencarian()
    {
        $data = $this->transaksi_model->pencarian_list();
        echo json_encode($data);
    }
 
 //barang keluar
    function barang_keluar()
    {
        if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2')
    {
        $this->load->helper('form_helper');
        $data = array(
            'dd_customer' => $this->transaksi_model->dd_customer(),
            'customer_selected' => $this->input->post('nama_customer') ? $this->input->post('nama_customer') : '$row->customer_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
            
            'kode_barang' => $this->transaksi_model->dd_barang_masuk(),
            'kode_barang_selected' => $this->input->post('kode_barang') ? $this->input->post('kode_barang') : '$row->kode_barang', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
           
            
    );
        $this->load->view('transaksi/barang_keluar', $data);
         }else{
                echo "Anda tidak berhak mengakses halaman ini";
        }
    }

    function data_barang_keluar()
    {
        $data=$this->transaksi_model->barang_keluar_list();
        echo json_encode($data);
    }

    function add_barang_keluar()
    {
        if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2')
    {
        $this->load->helper('form_helper');
 
        $data = array(
            'dd_customer' => $this->transaksi_model->dd_customer(),
            'customer_selected' => $this->input->post('nama_customer') ? $this->input->post('nama_customer') : '', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
          
           'kode_barang' => $this->transaksi_model->dd_barang_masuk(),
            'kode_barang_selected' => $this->input->post('kode_barang') ? $this->input->post('kode_barang') : '$row->kode_barang', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
           
           
    );

        $this->load->view('transaksi/add_barang_keluar', $data);
        }else{
                echo "Anda tidak berhak mengakses halaman ini";
        }
    }

    function save_barang_keluar()
    {
       $kode_barang = $this->input->post('kode_barang');
        $status_id = $this->input->post('status_id');
        $customer_id = $this->input->post('customer_id');
        $jumlah = $this->input->post('jumlah');
        $nomor_po=$this->input->post('nomor_po');
        $tanggal_order = $this->input->post('tanggal_order');
        $nomor_surat_jalan = $this->input->post('nomor_surat_jalan');
        $tanggal = $this->input->post('tanggal');
       // $status_order = $this->input->post('status_order');
        $keterangan=$this->input->post('keterangan');
        $created_by = $this->input->post('created_by');
        $created_at = $this->input->post('created_at');
        //$updated_by = $this->input->post('updated_by');
        
        $this->transaksi_model->save_barang_keluar($kode_barang, $status_id, $customer_id, $jumlah, $nomor_po, $tanggal_order, $nomor_surat_jalan, $tanggal, $keterangan, $created_by, $created_at);
       redirect('admin/transaksi/barang_keluar');
    }

    function delete_barang_keluar()
    {
        if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2')
        {
             $id=$this->input->post('id');
        $data=$this->transaksi_model->delete_barang_keluar($id);
        echo json_encode($data);
        }else{
                echo "Anda tidak berhak mengakses halaman ini";
        }
    }

  function get_barang_keluar()
  {

        $id=$this->input->get('id');

        $data=$this->transaksi_model->get_barang_keluar_id($id);
        echo json_encode($data);
  } 


function update_barang_keluar()
  {
        $id = $this->input->post('id');
        $kode_barang = $this->input->post('kode_barang');
        $status_id = $this->input->post('status_id');
        $customer_id = $this->input->post('customer_id');

        $jumlah = $this->input->post('jumlah');
        $nomor_po = $this->input->post('nomor_po');
        $tanggal_order = $this->input->post('tanggal_order');
        
        
        $nomor_surat_jalan = $this->input->post('nomor_surat_jalan');
        $tanggal = $this->input->post('tanggal');
       

        $keterangan = $this->input->post('keterangan');
        $updated_by = $this->input->post('updated_by');
        
        
        $data = $this->transaksi_model->update_barang_keluar($id, $kode_barang, $status_id, $customer_id, $jumlah, $nomor_po, $tanggal_order, $nomor_surat_jalan, $tanggal, $keterangan, $updated_by);
        echo json_encode($data);
    }



function get_autocomplete(){
       $nama_barang = $this->input->get('nama_barang');
       $query = $this->transaksi_model->get_barang($nama_barang, 'nama_barang');
       echo json_encode($query);
    }


    //-- barang masuk --//
    function barang_masuk()
    {
        $this->load->helper('form_helper');
        $data = array(
            'dd_supplier' => $this->transaksi_model->dd_supplier(),
            'supplier_selected' => $this->input->post('nama_supplier') ? $this->input->post('nama_supplier') : '$row->supplier_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
            'dd_barang' => $this->transaksi_model->dd_barang_masuk(),
            'barang_selected' => $this->input->post('nama_barang') ? $this->input->post('nama_barang') : '$row->kode_barang', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
      
            
    );
        
        $this->load->view('transaksi/barang_masuk', $data);
    }

    function data_barang_masuk()
    {

        $data=$this->transaksi_model->barang_masuk_list();
        echo json_encode($data);
    }

    function add_barang_masuk()
    {
        $this->load->helper('form_helper');
 
        $data = array(
            'dd_supplier' => $this->transaksi_model->dd_supplier(),
            
            'supplier_selected' => $this->input->post('nama_supplier') ? $this->input->post('nama_supplier') : '$row->nama_supplier', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
            
            'dd_barang' => $this->transaksi_model->dd_barang_masuk(),
            'barang_selected' => $this->input->post('kode_barang') ? $this->input->post('kode_barang') : '$row->kode_barang', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
    );

        $this->load->view('transaksi/add_barang_masuk', $data);
    }

  function save_barang_masuk()
  {
        $kode_barang = $this->input->post('kode_barang');
        $status_id = $this->input->post('status_id');
        $supplier_id = $this->input->post('supplier_id');
        $jumlah = $this->input->post('jumlah');
        $nomor_po=$this->input->post('nomor_po');
        $nomor_surat_jalan = $this->input->post('nomor_surat_jalan');
        $tanggal = $this->input->post('tanggal');
        //$posisi_penempatan = $this->input->post('posisi_penempatan');
        $keterangan=$this->input->post('keterangan');
        $created_by = $this->input->post('created_by');
        $created_at = $this->input->post('created_at');
        $updated_by = $this->input->post('updated_by');
        
        $this->transaksi_model->save_barang_masuk($kode_barang,$status_id,$supplier_id,$jumlah,$nomor_po,$nomor_surat_jalan,$tanggal, $keterangan,$created_by,$created_at,$updated_by);
       redirect('admin/transaksi/barang_masuk');
  
  }

  function delete_barang_masuk()
  {
   
        if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2')
        {
             $id=$this->input->post('id');
        $data=$this->transaksi_model->delete_barang_masuk($id);
        echo json_encode($data);
        }else{
                echo "Anda tidak berhak mengakses halaman ini";
        }
  }


  function get_barang_masuk()
  {

        $id=$this->input->get('id');

        $data=$this->transaksi_model->get_barang_masuk_id($id);
        echo json_encode($data);
  } 


  function update_barang_masuk()
  {
    
    $id = $this->input->post('id');
    $kode_barang = $this->input->post('kode_barang');
        $status_id = $this->input->post('status_id');
        $supplier_id = $this->input->post('supplier_id');
        $jumlah = $this->input->post('jumlah');
        $nomor_po=$this->input->post('nomor_po');
        $nomor_surat_jalan = $this->input->post('nomor_surat_jalan');
        $tanggal = $this->input->post('tanggal');
        
        $keterangan =$this->input->post('keterangan');
        $updated_by = $this->input->post('updated_by');
        $updated_at = $this->input->post('updated_at');
         
         $data = $this->transaksi_model->update_barang_masuk($id,$kode_barang,$status_id,$supplier_id,$jumlah,$nomor_po,$nomor_surat_jalan,$tanggal,$keterangan,$updated_by);
        echo json_encode($data);
  }
  
 function po_sementara()
{
    $this->load->helper('form_helper');
        $data = array(                      

            'dd_barang' => $this->transaksi_model->dd_barang(),
            'barang_selected' => $this->input->post('kode_barang') ? $this->input->post('kode_barang') : '$row->kode_barang', // 

             'dd_customer' => $this->transaksi_model->dd_customer(),
            'customer_selected' => $this->input->post('nama_customer') ? $this->input->post('nama_customer') : '', // 
    );

    $this->load->view('transaksi/po_sementara', $data);
}

function data_po_sementara()
    {

        $data=$this->transaksi_model->po_sementara_list();
        echo json_encode($data);
    }

function add_po_sementara()
  {
    $this->load->helper('form_helper');
        $data = array(                      
            //dropdown part number dari sprpart masuk
            'kode_barang' => $this->transaksi_model->kode_barang(),
            'kode_barang_selected' => $this->input->post('kode_barang') ? $this->input->post('kode_barang') : '$row->kode_barang', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi

            //dropdown part number dari item sprpart
            'dd_barang' => $this->transaksi_model->dd_barang(),
            'barang_selected' => $this->input->post('kode_barang') ? $this->input->post('kode_barang') : '$row->kode_barang', // 
            
            'dd_customer' => $this->transaksi_model->dd_customer(),
            'customer_selected' => $this->input->post('nama_customer') ? $this->input->post('nama_customer') : '', // untuk edit ganti          
    );
   /* 
    $data = array(
            'dd_customer' => $this->transaksi_model->dd_customer(),
            'customer_selected' => $this->input->post('nama_customer') ? $this->input->post('nama_customer') : '', // untuk edit ganti 

            'get_jenis' => $this->transaksi_model->get_jenis_chain(),
            'get_part_number' => $this->transaksi_model->get_part_number(),
            'get_jenis_selected' => '',
            'get_part_number_selected' => '',
        );*/

   /* $data = array(
            'dd_customer' => $this->transaksi_model->dd_customer(),
            'customer_selected' => $this->input->post('nama_customer') ? $this->input->post('nama_customer') : '', // untuk edit ganti 

            'get_jenis' => $this->transaksi_model->get_jenis_chain(),
            'get_part_number' => $this->transaksi_model->get_part_number(),
            'get_jenis_selected' => '',
            'get_part_number_selected' => '',
        );*/

    $this->load->view('transaksi/add_po_sementara', $data);
  }


 function save_po_sementara()
  {
        $kode_barang = $this->input->post('kode_barang');
        $status_id = $this->input->post('status_id');
        $customer_id = $this->input->post('customer_id');
        
        $jumlah = $this->input->post('jumlah');
        $tanggal_order = $this->input->post('tanggal_order');
        $nomor_po=$this->input->post('nomor_po');

        $keterangan=$this->input->post('keterangan');
        $created_by = $this->input->post('created_by');
        $created_at = $this->input->post('created_at');
        //$updated_by = $this->input->post('updated_by');
        
        $data = $this->transaksi_model->save_po_sementara($kode_barang, $status_id, $customer_id, $jumlah, $tanggal_order, $nomor_po, $keterangan, $created_by, $created_at);
        redirect('admin/transaksi/po_sementara');
        
  }

  function get_sparepart_dipesan_keluar()
  {

        $id=$this->input->get('id');

        $data=$this->transaksi_model->get_sparepart_dipesan_keluar($id);
        echo json_encode($data);
  } 

  function update_kirim_keluar()
  {
       
        $kode_barang = $this->input->post('kode_barang');
        $pesan_id = $this->input->post('pesan_id');
        $status_id = $this->input->post('status_id');
        $customer_id = $this->input->post('customer_id');
        $jumlah = $this->input->post('jumlah');
        $nomor_po = $this->input->post('nomor_po');
        $tanggal_order = $this->input->post('tanggal_order');  
        $nomor_surat_jalan = $this->input->post('nomor_surat_jalan');
        $tanggal = $this->input->post('tanggal');
        $keterangan = $this->input->post('keterangan');
        $updated_by = $this->input->post('updated_by');      
        
       $data = $this->transaksi_model->insert_sparepart_keluar($kode_barang, $pesan_id, $status_id, $customer_id, $jumlah, $nomor_po, $tanggal_order, $nomor_surat_jalan, $tanggal, $keterangan, $updated_by);
       echo json_encode($data);       
    }



  // sparepart telah dipesan //
    function sparepart_dipesan()
      {
            $this->load->helper('form_helper');
                $data = array(                 

                 
            'dd_barang' => $this->transaksi_model->dd_barang(),
            'barang_selected' => $this->input->post('kode_barang') ? $this->input->post('kode_barang') : '$row->kode_barang', // 

            'dd_customer' => $this->transaksi_model->dd_customer(),
            'customer_selected' => $this->input->post('nama_customer') ? $this->input->post('nama_customer') : '', //          
            );

            $this->load->view('transaksi/po_sementara', $data);
      }

    function data_sparepart_dipesan()
    {

        $data=$this->transaksi_model->sparepart_dipesan();
        echo json_encode($data);
    }

    function save_sparepart_dipesan()
    {
        $kode_barang = $this->input->post('kode_barang');
        $jumlah = $this->input->post('jumlah');
        $customer_id = $this->input->post('customer_id');
        $nomor_po=$this->input->post('nomor_po');
        $tanggal_po = $this->input->post('tanggal_po');
        $keterangan=$this->input->post('keterangan');
        $created_by = $this->input->post('created_by');
        $created_at = $this->input->post('created_at');
        //$updated_by = $this->input->post('updated_by');
        
        $data = $this->transaksi_model->save_sparepart_dipesan($kode_barang, $jumlah, $customer_id, $nomor_po, $tanggal_po, $keterangan, $created_by, $created_at);
        redirect('admin/transaksi/sp_dipesan');
        
  }

  function get_sparepart_dipesan()
  {

        $id=$this->input->get('id');
        $data=$this->transaksi_model->get_sparepart_dipesan_id($id);
        echo json_encode($data);
  } 

  function update_sparepart_dipesan()
  {
        $id = $this->input->post('id');

        $kode_barang = $this->input->post('kode_barang');

        $jumlah = $this->input->post('jumlah');

        $customer_id = $this->input->post('customer_id');

        $nomor_po = $this->input->post('nomor_po');

        $tanggal_order = $this->input->post('tanggal_order');

        $keterangan = $this->input->post('keterangan');

        $updated_by = $this->input->post('updated_by');       

        
       $data = $this->transaksi_model->update_sparepart_dipesan($id, $kode_barang, $jumlah, $customer_id, $nomor_po, $tanggal_order, $keterangan, $updated_by);
       echo json_encode($data);       
    }

    function update_status_sparepart_dipesan()
    {
        $id = $this->input->post('id');
        $status_pemesanan = $this->input->post('status_pemesanan');
        $updated_by = $this->input->post('updated_by');


        $data = $this->transaksi_model->update_status_sparepart_dipesan($id, $status_pemesanan, $updated_by);
       echo json_encode($data);     
    }


    function delete_sparepart_dipesan()
  {
    if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2')
        {
        $id=$this->input->post('id');
        $data=$this->transaksi_model->delete_sparepart_dipesan($id);
        echo json_encode($data);
        }else{
                echo "Anda tidak berhak mengakses halaman ini";
        }
  }

  // sparepart telah dipesan //
  
  public function form(){
    $data = array(); // Buat variabel $data sebagai array
    
    if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
      // lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
      $upload = $this->transaksi_model->upload_file($this->filename);
      
      if($upload['result'] == "success"){ // Jika proses upload sukses
        // Load plugin PHPExcel nya
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';
        
        $excelreader = new PHPExcel_Reader_Excel2007();
        $loadexcel = $excelreader->load('excel/upload/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
        $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
        
        // Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
        // Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
        $data['sheet'] = $sheet; 
      }else{ // Jika proses upload gagal
        $data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
      }
    }
    
    $this->load->view('transaksi/form', $data);
  }
  
  //form import sparepart masuk
  public function form_import_brg_masuk()
  {
    $data = array(); // Buat variabel $data sebagai array
    
    if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
      // lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
      $upload = $this->transaksi_model->upload_file_brg_masuk($this->filename);
      
      if($upload['result'] == "success"){ // Jika proses upload sukses
        // Load plugin PHPExcel nya
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';
        
        $excelreader = new PHPExcel_Reader_Excel2007();
        $loadexcel = $excelreader->load('excel/upload/sparepart_masuk/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
        $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
        
        // Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
        // Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
        $data['sheet'] = $sheet; 
      }else{ // Jika proses upload gagal
        $data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
      }
    }
    
    $this->load->view('transaksi/form_import_brg_masuk', $data);
  }
  
  //form import barang keluar
 public function form_import_brg_keluar()
 {
    $data = array(); // Buat variabel $data sebagai array
    
    if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
      // lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
      $upload = $this->transaksi_model->upload_file_brg_keluar($this->filename);
      
      if($upload['result'] == "success"){ // Jika proses upload sukses
        // Load plugin PHPExcel nya
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';
        
        $excelreader = new PHPExcel_Reader_Excel2007();
        $loadexcel = $excelreader->load('excel/upload/sparepart_keluar/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
        $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
        
        // Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
        // Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
        $data['sheet'] = $sheet; 
      }else{ // Jika proses upload gagal
        $data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
      }
    }
    
    $this->load->view('transaksi/form_import_brg_keluar', $data);
  }

    //import barang dipesan
  public function import(){
    // Load plugin PHPExcel nya
    include APPPATH.'third_party/PHPExcel/PHPExcel.php';
    
    $excelreader = new PHPExcel_Reader_Excel2007();
    $loadexcel = $excelreader->load('excel/upload/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
    $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
    
    // Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
    $data = array();
    
    $numrow = 1;
    foreach($sheet as $row){
      // Cek $numrow apakah lebih dari 1
      // Artinya karena baris pertama adalah nama-nama kolom
      // Jadi dilewat saja, tidak usah diimport
      if($numrow > 1){
        // Kita push (add) array data ke variabel data
        array_push($data, array(
           'kode_barang' => $row['A'],
            'status_id' => $row['B'],
            'customer_id' => $row['C'],
            'jumlah' => $row['D'],
            'tanggal_order' => $row['E'],
            'nomor_po' => $row['F'],
            'keterangan' => $row['G'],
        ));
      }
      
      $numrow++; // Tambah 1 setiap kali looping
    }
    // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
    $this->transaksi_model->insert_multiple($data);
    
    redirect("admin/transaksi/po_sementara"); // Redirect ke halaman awal (ke controller siswa fungsi index)
  }
  
  public function import_brg_masuk()
  {
    // Load plugin PHPExcel nya
    include APPPATH.'third_party/PHPExcel/PHPExcel.php';
    
    $excelreader = new PHPExcel_Reader_Excel2007();
    $loadexcel = $excelreader->load('excel/upload/sparepart_masuk/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
    $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
    
    // Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
    $data = array();
    
    $numrow = 1;
    foreach($sheet as $row){
      // Cek $numrow apakah lebih dari 1
      // Artinya karena baris pertama adalah nama-nama kolom
      // Jadi dilewat saja, tidak usah diimport
      if($numrow > 1){
        // Kita push (add) array data ke variabel data
        array_push($data, array(
            'kode_barang' => $row['A'],
            'status_id' => $row['B'],
            'supplier_id' => $row['C'],
            'jumlah' => $row['D'],
            'nomor_po' => $row['E'],
            'nomor_surat_jalan' => $row['F'],
            'tanggal' => $row['G'],
            'keterangan' => $row['H'],
        ));
      }
      
      $numrow++; // Tambah 1 setiap kali looping
    }
    // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
   
    $this->transaksi_model->insert_multiple($data);
    
    redirect("admin/transaksi/barang_masuk"); // Redirect ke halaman awal (ke controller siswa fungsi index)
  }

    //import sparepart keluar
  public function import_brg_keluar(){
    // Load plugin PHPExcel nya
    include APPPATH.'third_party/PHPExcel/PHPExcel.php';
    
    $excelreader = new PHPExcel_Reader_Excel2007();
    $loadexcel = $excelreader->load('excel/upload/sparepart_keluar/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
    $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
    
    // Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
    $data = array();
    
    $numrow = 1;
    foreach($sheet as $row){
      // Cek $numrow apakah lebih dari 1
      // Artinya karena baris pertama adalah nama-nama kolom
      // Jadi dilewat saja, tidak usah diimport
      if($numrow > 1){
        // Kita push (add) array data ke variabel data
        array_push($data, array(
            'kode_barang' => $row['A'],
            'status_id' => $row['B'],

            'customer_id' => $row['C'],
            'jumlah' => $row['D'],

            'nomor_po' => $row['E'],
            'tanggal_order' => $row['F'],
            
            'nomor_surat_jalan' => $row['G'],
            'tanggal' => $row['H'],
            'keterangan' => $row['I'],
        ));
      }
      
      $numrow++; // Tambah 1 setiap kali looping
    }
    // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
   
    $this->transaksi_model->insert_multiple($data);
    
    redirect("admin/transaksi/barang_keluar"); // Redirect ke halaman awal (ke controller siswa fungsi index)
  }


    //SP DIPESAN//

   /* function sp_dipesan()
    {
        //$this->load->helper('form_helper');
            $data['sp_dipesan'] =  $this->transaksi_model->sparepart_dipesan();
            $data = array(                    
                    'dd_barang' => $this->transaksi_model->dd_barang(),
                    'barang_selected' => $this->input->post('kode_barang') ? $this->input->post('kode_barang') : '$row->kode_barang', // 

                    'dd_customer' => $this->transaksi_model->dd_customer(),
                    'customer_selected' => $this->input->post('nama_customer') ? $this->input->post('nama_customer') : '', // 
            );

        $this->load->view('transaksi/sprt_dipesan');
    }*/


    function delete()
    {
        if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2')
            {
                $id = $this->input->post('id');
                $this->transaksi_model->delete_sparepart_dipesan($id);
                if ($this->db->affected_rows() > 0) {
                    echo "<script>alert('Data berhasil dihapus')</script>";
                }
                echo "<script>window.location='".site_url('sparepart')."';</script>";

            }else{
                    echo "Anda tidak berhak mengakses halaman ini";
            }
    }

    function edit($id)
    {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('kode_barang', 'Part number', 'trim|required');
        $this->form_validation->set_rules('customer_id', 'Customer', 'trim|required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required|numeric');
        $this->form_validation->set_rules('nomor_po', 'Nomor PO', 'trim|required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

        // $this->form_validation->set_message('required', '%s Masih Kosong, silakan isi');
        
        // $this->form_validation->set_error_delimeter('<span class="help-block">', '</span>');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('transaksi/edit_sp_dipesan');          
        } else {
            //$post = $this->input->post(null, TRUE);
            echo "proses update data berhasil";
        } 

        /*$id = $this->input->post('id');

        $kode_barang = $this->input->post('kode_barang');

        $jumlah = $this->input->post('jumlah');

        $customer_id = $this->input->post('customer_id');

        $nomor_po = $this->input->post('nomor_po');

        $tanggal_order = $this->input->post('tanggal_order');

        $keterangan = $this->input->post('keterangan');

        $updated_by = $this->input->post('updated_by');       */

        
       /*$data = $this->transaksi_model->update_sparepart_dipesan($id, $kode_barang, $jumlah, $customer_id, $nomor_po, $tanggal_order, $keterangan, $updated_by);
       echo json_encode($data);*/       
    }

}