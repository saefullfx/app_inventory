<?php
class Page extends CI_Controller{
  function __construct(){
    parent::__construct();

    //validasi jika user belum login
    if($this->session->userdata('masuk') != TRUE){
            $url=base_url();
            redirect($url);
        }
        $this->load->library('datatables'); //load library ignited-dataTable
        $this->load->model('master_model');
        $this->load->model('barang_model');
        $this->load->model('dashboard_model');
  }
 
 
  //-- Dashboard Mulai --//
  function index()
  {
    $data['total_item'] = $this->barang_model->total_item();
    $data['total_item_unit'] = $this->barang_model->total_item_unit();
    $data['jumlah_user'] = $this->dashboard_model->jumlah_user();
    $data['jumlah_customer'] = $this->dashboard_model->jumlah_customer();
    $data['latest_sparepart_masuk'] = $this->dashboard_model->latestSparepartMasuk();
    $data['latest_item_sparepart'] = $this->dashboard_model->latestItemSparepart();
    $data['latest_sparepart_keluar'] = $this->dashboard_model->latestSparepartKeluar();
    $data['latest_unit_masuk'] = $this->dashboard_model->latestUnitMasuk();
    $data['latest_unit_keluar'] = $this->dashboard_model->latestUnitKeluar();
    $data['jumlah_sparepart_masuk_perbulan'] = $this->dashboard_model->jumlah_sparepart_masuk_perbulan();
    $data['jumlah_sparepart_keluar_perbulan'] = $this->dashboard_model->jumlah_sparepart_keluar_perbulan();
    
    $this->load->view('dashboard1', $data);
  }
  
  function master_stock_sparepart()
  {
    $data = $this->dashboard_model->master_stock_sparepart();
    echo json_encode($data);
  }

  function master_stock_unit()
  {
    $data = $this->dashboard_model->master_stock_unit();
    echo json_encode($data);
  }

  //-- Dashboard Selesai --//
  
  

 function jumlah_barang()
  {
    $data['barang'] = $this->master_model->jumlah_barang();
    $this->load->view('dashboard1', $data);
  }



  
 
  function get_barang_json()
  { //data data produk by JSON object
    header('Content-Type: application/json');
    echo $this->master_model->get_all_barang();
  }

  function read_barang()
  {
    // function ini hanya boleh diakses oleh admin dan dosen
    if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
     
      $this->load->helper('form_helper');
        
      $data = array(           
            
           
            'dd_jenis' => $this->barang_model->dd_jenis(),
            'jenis_selected' => $this->input->post('nama_jenis') ? $this->input->post('nama_jenis') : '$row->nama_jenis', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
      );


      $this->load->view('master/read_barang', $data);
    }else{
      echo "Anda tidak berhak mengakses halaman ini";
    }
 
  }

  function data_barang()
  {
        $data=$this->master_model->barang_list();
        echo json_encode($data);
    }

  function get_barang()
  {
        $id=$this->input->get('id');
        $data=$this->master_model->get_barang_by_id($id);
        echo json_encode($data);
  }
  
  function get_kode_barangedit()
  {
        $id=$this->input->get('id');
        $data=$this->master_model->get_kode_barang_by_id($id);
        echo json_encode($data);
  }

  function simpan_barang()
  {
        $kode_barang = $this->input->post('kode_barang');
        $nama_barang = $this->input->post('nama_barang');
        $jenis_id = $this->input->post('jenis_id');
        $keterangan = $this->input->post('keterangan');
        $created_by = $this->input->post('created_by');
        $created_at = $this->input->post('created_at');
        
        $data = $this->master_model->save_barang($kode_barang, $nama_barang, $jenis_id, $keterangan, $created_by, $created_at);
        echo json_encode($data);
  }

  function update_barang()
  {
        $id=$this->input->post('id');
        $kode_barang=$this->input->post('kode_barang');
        $nama_barang=$this->input->post('nama_barang');
        $jenis_id = $this->input->post('jenis_id');
        $keterangan = $this->input->post('keterangan');
        $update_by=$this->input->post('update_by');
        $data=$this->master_model->update_barang($id, $kode_barang, $nama_barang, $jenis_id, $keterangan, $update_by);
        echo json_encode($data);
    }
    
    /* function update_kode_barang()
    {
        $id=$this->input->post('id');
        $kode_barang=$this->input->post('kode_barang');
        $kode_barangbaru=$this->input->post('kode_barangbaru');
        $update_by=$this->input->post('update_by');
        $data=$this->master_model->update_kode_barang($id, $kode_barang, $kode_barangbaru, $update_by);
        echo json_encode($data);
    }*/

    function delete_barang()
    {
        $id=$this->input->post('id');
        $data=$this->master_model->delete_barang($id);
        echo json_encode($data);
    }
    
    function add_item_sparepart()
  {
    if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
     
    $this->load->helper('form_helper');
      $data = array(                      
            'dd_jenis' => $this->barang_model->dd_jenis(),
            'jenis_selected' => $this->input->post('nama_jenis') ? $this->input->post('nama_jenis') : '$row->jenis_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
      );


      $this->load->view('master/add_item_sparepart', $data);
    }else{
      echo "Anda tidak berhak mengakses halaman ini";
    }
  }
  
  function edit_item_sparepart($id)
  {
    $this->load->helper('form_helper');

    $data = array(                      
            'dd_jenis' => $this->barang_model->dd_jenis(),
            'jenis_selected' => $this->input->post('nama_jenis') ? $this->input->post('nama_jenis') : '$row->jenis_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
      );

    $data['edit']=$this->master_model->edit_sparepart($id);
    $this->load->view('master/edit_item_sparepart', $data);
  }
  
   public function item_sparepart(){
        if(isset($_GET['filter']) && ! empty($_GET['filter']))
        { // Cek apakah user telah memilih filter dan klik tombol tampilkan
          $filter = $_GET['filter'];

            if($filter == '1')
            { 
                $jenis = $_GET['jenis'];                
                $ket = 'Item Sparepart Jenis'.$jenis;
                $gabung= $this->master_model->view_by_jenis_sparepart($jenis); 
            }
        }else
        { // Jika user tidak mengklik tombol tampilkan
            $ket = 'Item Sparepart';
            //$url_cetak = 'kartustock/cetak_mutasi_unit_masuk';
            $gabung =  $this->master_model->barang_list();
        }

    
    $data = array(                      
            'dd_jenis' => $this->barang_model->dd_jenis(),
            'jenis_selected' => $this->input->post('nama_jenis') ? $this->input->post('nama_jenis') : '$row->nama_jenis', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
            );    
    $data['ket'] = $ket;
    //$data['url_cetak'] = base_url('index.php/'.$url_cetak);
    $data['gabung'] = $gabung;
    $data['option_jenis_sparepart'] = $this->master_model->option_jenis_sparepart();
     //$data['option_nama_rekap_unit_masuk'] = $this->Report_model->option_nama_rekap_unit_masuk();
    $this->load->view('master/item_sparepart', $data);
  }
  
   function simpan_item_sparepart()
  {
        $kode_barang = $this->input->post('kode_barang');
        $nama_barang = $this->input->post('nama_barang');
        $jenis_id = $this->input->post('jenis_id');
        $keterangan = $this->input->post('keterangan');
        $created_by = $this->input->post('created_by');
        $created_at = $this->input->post('created_at');
        
        $data=$this->master_model->save_barang($kode_barang, $nama_barang, $jenis_id, $keterangan, $created_by, $created_at);
       // echo json_encode($data);
        redirect('page/item_sparepart');
  }
  
  function update_sparepart()
    {
        $id = $this->input->post('id');
        $kode_barang = $this->input->post('kode_barang');
        $nama_barang = $this->input->post('nama_barang');
        $jenis_id = $this->input->post('jenis_id');
        $keterangan = $this->input->post('keterangan');
        $update_by = $this->input->post('update_by');
        $data = $this->master_model->update_sparepart($id, $kode_barang, $nama_barang, $jenis_id, $keterangan, $update_by);
        //echo json_encode($data);
        redirect('page/item_sparepart');
    }
    



  // -- barang selesai -- //

//customer mulai//
  function read_customer()
  {
    if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
      //$data['customer'] = $this->master_model->get_customer();
      $this->load->view('master/read_customer');
     }else{
      echo "Anda tidak berhak mengakses halaman ini";
    }
  }

   function data_customer()
  {
        $data = $this->master_model->get_customer();
        echo json_encode($data);
    }

  function get_customer()
  {
        $id=$this->input->get('id');
        $data=$this->master_model->get_customer_by_id($id);
        echo json_encode($data);
  }
 
  function add_customer()
  {
    // function ini hanya boleh diakses oleh admin dan superadmin
    if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2')
      {
        $this->load->view('master/add_customer');
      }else{
      echo "Anda tidak berhak mengakses halaman ini";
    }
  }

  /*function delete_customer()
  {
    if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2')
    {
      $id = $this->uri->segment(3);
      $this->master_model->delete_customer($id);
      redirect('page/read_customer');
    }else{
      echo "Anda tidak berhak mengakses halaman ini";
    }
  }*/

  function save_customer()
  {
        $nama_customer = $this->input->post('nama_customer');        
        $telepon = $this->input->post('telepon');
        $alamat = $this->input->post('alamat');
        $keterangan = $this->input->post('keterangan');
        $created_by = $this->input->post('created_by');
        $created_at = $this->input->post('created_at');
        
        $data=$this->master_model->save_customer($nama_customer, $telepon, $alamat, $keterangan, $created_at,$created_by);
        echo json_encode($data);
  }

  function update_customer()
  {
        $id = $this->input->post('id');
        $nama_customer = $this->input->post('nama_customer');        
        $telepon = $this->input->post('telepon');
        $alamat = $this->input->post('alamat');
        $keterangan = $this->input->post('keterangan');
        $updated_by=$this->input->post('updated_by');
        
        $data = $this->master_model->update_customer($id, $nama_customer, $telepon, $alamat, $keterangan, $updated_by);
        echo json_encode($data);
    }
 
    function delete_customer(){
        $id=$this->input->post('id');
        $data=$this->master_model->delete_customer($id);
        echo json_encode($data);
    }

  

  //---- customer selesai ----//

// --- supplier mulai --- //

  function read_supplier()
  {
    //$data['supplier'] = $this->master_model->get_supplier();
    $this->load->view('master/read_supplier');

  }

   function data_supplier()
  {
        $data = $this->master_model->get_supplier();
        echo json_encode($data);
    }

  function get_supplier()
  {
        $id=$this->input->get('id');
        $data=$this->master_model->get_supplier_by_id($id);
        echo json_encode($data);
  }

   function add_supplier()
  {
    // function ini hanya boleh diakses oleh admin dan dosen
    if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
      $this->load->view('master/add_supplier');
    }else{
      echo "Anda tidak berhak mengakses halaman ini";
    }
  }

  function save_supplier()
  {
    $nama_supplier = $this->input->post('nama_supplier');
    $telepon = $this->input->post('telepon');
    $alamat = $this->input->post('alamat');
    $keterangan = $this->input->post('keterangan');
    $created_by = $this->input->post('created_by');
    $created_at = $this->input->post('created_at');
    $data = $this->master_model->save_supplier($nama_supplier,$telepon,$alamat,$keterangan,$created_by,$created_at);
    echo json_encode($data);
  }

  function update_supplier()
  {
        $id = $this->input->post('id');
        $nama_supplier = $this->input->post('nama_supplier');        
        $telepon = $this->input->post('telepon');
        $alamat = $this->input->post('alamat');
        $keterangan = $this->input->post('keterangan');
        $updated_by=$this->input->post('updated_by');
        
        $data = $this->master_model->update_supplier($id, $nama_supplier, $telepon, $alamat, $keterangan, $updated_by);
        echo json_encode($data);
    }
 
    function delete_supplier(){
        $id=$this->input->post('id');
        $data=$this->master_model->delete_supplier($id);
        echo json_encode($data);
    }

// --- supplier selesai//

//-- jenis mulai --//
function read_jenis()
  {
    //$data['jenis'] = $this->master_model->get_jenis();
    $this->load->view('master/read_jenis');
  }

  function data_jenis()
  {
        $data=$this->master_model->jenis_list();
        echo json_encode($data);
    }

  function get_jenis()
  {
        $id=$this->input->get('id');
        $data=$this->master_model->get_jenis_by_id($id);
        echo json_encode($data);
  }

  function save_jenis()
  {
        $nama_jenis=$this->input->post('nama_jenis');
        $created_by = $this->input->post('created_by');
        $created_at = $this->input->post('created_at');
        
        $data=$this->master_model->save_jenis($nama_jenis,$created_at,$created_by);
        echo json_encode($data);
  }

  function update_jenis()
  {
        $id=$this->input->post('id');
        $nama_jenis=$this->input->post('nama_jenis');
        $update_by=$this->input->post('update_by');
        $data=$this->master_model->update_jenis($id,$nama_jenis,$update_by);
        echo json_encode($data);
    }
 
    function delete_jenis(){
        $id=$this->input->post('id');
        $data=$this->master_model->delete_jenis($id);
        echo json_encode($data);
    }
// -- jenis selesai --//

// -- kategori mulai --//

  function read_kategori()
  {
    //$data['kategori'] = $this->master_model->get_kategori();
    $this->load->view('master/read_kategori');
  }

  function data_kategori()
  {
        $data=$this->master_model->kategori_list();
        echo json_encode($data);
    }

  function get_kategori()
  {
        $id=$this->input->get('id');
        $data=$this->master_model->get_kategori_by_id($id);
        echo json_encode($data);
  }

  function save_kategori()
  {
        $nama_kategori=$this->input->post('nama_kategori');
        $created_by = $this->input->post('created_by');
        $created_at = $this->input->post('created_at');
        
        $data=$this->master_model->save_kategori($nama_kategori,$created_at,$created_by);
        echo json_encode($data);
  }

  function update_kategori()
  {
        $id=$this->input->post('id');
        $nama_kategori=$this->input->post('nama_kategori');
        $update_by=$this->input->post('update_by');
        $data=$this->master_model->update_kategori($id,$nama_kategori,$update_by);
        echo json_encode($data);
    }
 
    function delete_kategori(){
        $id=$this->input->post('id');
        $data=$this->master_model->delete_kategori($id);
        echo json_encode($data);
    }
// -- kategori selesai --//

    // -- Lokasi mulai --//

  function read_lokasi()
  {
    //$data['lokasi'] = $this->master_model->get_lokasi();
    $this->load->view('master/read_lokasi');
  }

  function data_lokasi()
  {
        $data=$this->master_model->lokasi_list();
        echo json_encode($data);
    }

  function get_lokasi()
  {
        $id=$this->input->get('id');
        $data=$this->master_model->get_lokasi_by_id($id);
        echo json_encode($data);
  }

  function save_lokasi()
  {
        $nama_lokasi=$this->input->post('nama_lokasi');
        $ruang = $this->input->post('ruang');
        $rak = $this->input->post('rak');
        $tingkat = $this->input->post('tingkat');
        $keterangan = $this->input->post('keterangan');
        $created_by = $this->input->post('created_by');
        $created_at = $this->input->post('created_at');
        
        $data=$this->master_model->save_lokasi($nama_lokasi,$ruang,$rak,$tingkat,$keterangan,$created_at,$created_by);
        echo json_encode($data);
  }

  function update_lokasi()
  {
        $id=$this->input->post('id');
        $nama_lokasi=$this->input->post('nama_lokasi');
        $ruang = $this->input->post('ruang');
        $rak = $this->input->post('rak');
        $tingkat = $this->input->post('tingkat');
        $keterangan = $this->input->post('keterangan');
        $update_by=$this->input->post('update_by');
        $data=$this->master_model->update_lokasi($id,$nama_lokasi,$ruang,$rak,$tingkat,$keterangan,$update_by);
        echo json_encode($data);
    }
 
    function delete_lokasi(){
        $id=$this->input->post('id');
        $data=$this->master_model->delete_lokasi($id);
        echo json_encode($data);
    }
    // -- Lokasi selesai --//


    //-- status --//
function read_status()
  {
    //$data['lokasi'] = $this->master_model->get_lokasi();
    $this->load->view('master/read_status');
  }

  function data_status()
  {
        $data=$this->master_model->status_list();
        echo json_encode($data);
    }

  function get_status()
  {
        $id=$this->input->get('id');
        $data=$this->master_model->get_status_by_id($id);
        echo json_encode($data);
  }

  function save_status()
  {
        $nama_status=$this->input->post('nama_status');
        
        $created_by = $this->input->post('created_by');
        $created_at = $this->input->post('created_at');
        
        $data=$this->master_model->save_status($nama_status,$created_at,$created_by);
        echo json_encode($data);
  }

  function update_status()
  {
        $id=$this->input->post('id');
        $nama_lokasi=$this->input->post('nama_lokasi');
        $ruang = $this->input->post('ruang');
        $rak = $this->input->post('rak');
        $tingkat = $this->input->post('tingkat');
        $keterangan = $this->input->post('keterangan');
        $update_by=$this->input->post('update_by');
        $data=$this->master_model->update_lokasi($id,$nama_lokasi,$ruang,$rak,$tingkat,$keterangan,$update_by);
        echo json_encode($data);
    }


    //-- status selesai --//

  function krs()
  {
    // function ini hanya boleh diakses oleh admin dan mahasiswa
    if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='3'){
      $this->load->view('v_krs');
    }else{
      echo "Anda tidak berhak mengakses halaman ini";
    }
  }
  function lhs(){
    // function ini hanya boleh diakses oleh admin dan mahasiswa
    if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='3'){
      $this->load->view('v_lhs');
    }else{
      echo "Anda tidak berhak mengakses halaman ini";
    }
  }
}