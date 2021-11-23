<?php
class Barang extends CI_Controller{
  function __construct(){
    parent::__construct();
    //validasi jika user belum login
    if($this->session->userdata('masuk') != TRUE){
            $url=base_url();
            redirect($url);
        }
        $this->load->model('barang_model');

        $this->load->library('datatables');
  }
 
  /*function index()
  {    
    //$data['barang'] = $this->barang_model->get_barang();
    $this->load->view('barang/read');    
  }*/

 //stock barang

  function stock_barang()
  {
    $this->load->view('barang/stock');
  }

  function rekap()
  {
    $this->load->view('barang/rekap');
  }

  //rekap masuk //
  /*function rekap_masuk()
  {
    $this->load->view('barang/rekap_masuk');
  }*/

  public function rekap_masuk(){
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            /*if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['bulan'];
                
                $ket = 'Data Transaksi Sparepart Masuk Tanggal '.date('d-m-y', strtotime($tgl));
                $url_cetak = 'report/cetak?filter=1&tanggal='.$tgl;
                $report= $this->Report_model->view_by_date($tgl); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else*/ 
            if($filter == '1'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Data Transaksi Sparepart Masuk Bulan ' .$nama_bulan[$bulan].' ' .$tahun;
                $url_cetak = 'barang/barang/cetak_rekap_masuk?filter=1&bulan='.$bulan.'&tahun='.$tahun;
                $report = $this->barang_model->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di Report_model
            }else if($filter == '2'){ 
                $tahun = $_GET['tahun'];
                
                $ket = 'Data Transaksi Sparepart Masuk Tahun ' .$tahun;
                $url_cetak = 'barang/barang/cetak_rekap_masuk?filter=2&tahun='.$tahun;
                $report = $this->barang_model->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else if($filter == '3'){ // Jika filter nya 4 (per tahun)
                $kode_barang = $_GET['kode_barang'];
                
                $ket = 'Data Transaksi Sparepart masuk Part Number ' .$kode_barang;
                $url_cetak = 'barang/barang/cetak_rekap_masuk?filter=3&kode_barang='.$kode_barang;
                $report = $this->barang_model->view_by_partnumber($kode_barang); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else{ // Jika filter nya 4 (per tahun)
                $jenis_barang = $_GET['jenis_id'];
                
                $ket = 'Data Transaksi Sparepart Masuk Berdasarkan Jenis Barang ';
                $url_cetak = 'barang/barang/cetak_rekap_masuk?filter=4&jenis_id=' .$jenis_barang;
                $report = $this->barang_model->view_by_jenis_barang($jenis_barang); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Transaksi Sparepart Masuk';
            $url_cetak = 'barang/barang/cetak_rekap_masuk';
            $report = $this->barang_model->view_all(); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
    $data['ket'] = $ket;
    $data['url_cetak'] = base_url('index.php/'.$url_cetak);
    $data['report'] = $report;
    $data['option_tahun'] = $this->barang_model->option_tahun();
     $data['option_kode_barang'] = $this->barang_model->option_kode_barang();
      $data['option_jenis_barang'] = $this->barang_model->option_jenis_barang();
    $this->load->view('barang/rekap_masuk', $data);
  }


  public function cetak_rekap_masuk(){
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            /*if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $bulan = $_GET['bbulan'];                
                $ket = 'Data Transaksi Tanggal '.date('d-m-y', strtotime($tgl));
                $report = $this->Report_model->view_by_date($tgl); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }*/if($filter == '1'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Data Transaksi Sparepart Masuk Bulan ' .$nama_bulan[$bulan].' ' .$tahun;
                $report = $this->barang_model->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di TransaksiModel
            }else if($filter == '2'){ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                
                $ket = 'Data Transaksi Sparepart Masuk Tahun ' .$tahun;
                $report = $this->barang_model->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else if($filter == '3'){ // Jika filter nya 3 (per tahun)
                $kode_barang = $_GET['kode_barang'];
                
                $ket = 'Data Transaksi Part Number '.$kode_barang;
                $report = $this->barang_model->view_by_partnumber($kode_barang); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else{ // Jika filter nya 3 (per tahun)
                $jenis_barang = $_GET['jenis_id'];
                
                $ket = 'Data Transaksi Sparepart Masuk Berdasarkan Jenis' .$jenis_barang;
               // $url_cetak = 'barang/barang/cetak_rekap_masuk?filter=4&jenis_barang='.$jenis_barang;
                $report = $this->barang_model->view_by_jenis_barang($jenis_barang);// Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Transaksi Sparepart Masuk';
            $report = $this->barang_model->view_all(); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
        $data['ket'] = $ket;
        $data['report'] = $report;
        
    ob_start();
    $this->load->view('cetak_rekap_masuk', $data);
    $html = ob_get_contents();
    ob_end_clean();
        
        require_once('./assets/html2pdf/html2pdf.class.php');
    $pdf = new HTML2PDF('P','A4','en');
    //$html2pdf->setDefaultFont('Arial');
    $pdf->WriteHTML($html);
    $pdf->Output('Data Transaksi.pdf', 'I');
  }

  //rekap masuk end //

  function rekap_keluar()
  {
    if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            /*if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['bulan'];
                
                $ket = 'Data Transaksi Barang Keluar Tanggal '.date('d-m-y', strtotime($tgl));
                $url_cetak = 'report/cetak?filter=1&tanggal='.$tgl;
                $report= $this->Report_model->view_by_date($tgl); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else*/ 
            if($filter == '1'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Data Transaksi Sparepart Keluar Bulan ' .$nama_bulan[$bulan].' ' .$tahun;
                $url_cetak = 'barang/barang/cetak_rekap_keluar?filter=1&bulan='.$bulan.'&tahun='.$tahun;
                $report = $this->barang_model->view_by_month_keluar($bulan, $tahun); // Panggil fungsi view_by_month yang ada di Report_model
            }else if($filter == '2'){ 
                $tahun = $_GET['tahun'];
                
                $ket = 'Data Transaksi Sparepart Keluar Tahun ' .$tahun;
                $url_cetak = 'barang/barang/cetak_rekap_masuk?filter=2&tahun='.$tahun;
                $report = $this->barang_model->view_by_year_keluar($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else if($filter == '3'){ // Jika filter nya 4 (per tahun)
                $kode_barang = $_GET['kode_barang'];
                
                $ket = 'Data Transaksi Sparepart Keluar Part Number ' .$kode_barang;
                $url_cetak = 'barang/barang/cetak_rekap_keluar?filter=3&kode_barang='.$kode_barang;
                $report = $this->barang_model->view_by_partnumber_keluar($kode_barang); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else{ // Jika filter nya 4 (per tahun)
                $jenis_barang = $_GET['jenis_id'];
                
                $ket = 'Data Transaksi Sparepart Keluar Berdasarkan Jenis Barang ' .$jenis_barang;
                $url_cetak = 'barang/barang/cetak_rekap_keluar?filter=4&jenis_id='.$jenis_barang;
                $report = $this->barang_model->view_by_jenis_barang_keluar($jenis_barang); // Panggil fungsi view_by_year yang ada di jn
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Transaksi Sparepart Keluar';
            $url_cetak = 'barang/barang/cetak_rekap_keluar';
            $report = $this->barang_model->view_all_keluar(); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
    $data['ket'] = $ket;
    $data['url_cetak'] = base_url('index.php/'.$url_cetak);
    $data['report'] = $report;
    $data['option_tahun_keluar'] = $this->barang_model->option_tahun_keluar();
    $data['option_kode_barang_keluar'] = $this->barang_model->option_kode_barang_keluar();
    $data['option_jenis_barang_keluar'] = $this->barang_model->option_jenis_barang_keluar();
    
    $this->load->view('barang/rekap_keluar', $data);
  }

  public function cetak_rekap_keluar()
  {
    if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            /*if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $bulan = $_GET['bbulan'];                
                $ket = 'Data Transaksi Tanggal '.date('d-m-y', strtotime($tgl));
                $report = $this->Report_model->view_by_date($tgl); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }*/ if($filter == '1'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Data Transaksi Sparepart Bulan ' .$nama_bulan[$bulan].' ' .$tahun;
                $report = $this->barang_model->view_by_month_keluar($bulan, $tahun); // Panggil fungsi view_by_month yang ada di TransaksiModel
            }else if($filter == '2'){ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                
                $ket = 'Data Transaksi Sparepart Tahun ' .$tahun;
                $report = $this->barang_model->view_by_year_keluar($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else if($filter == '3'){ // Jika filter nya 3 (per tahun)
                $kode_barang = $_GET['kode_barang'];
                
                $ket = 'Data Transaksi Sparepart Part Number ' .$kode_barang;
                $report = $this->barang_model->view_by_partnumber_keluar($kode_barang); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else{ // Jika filter nya 3 (per tahun)
                $jenis_barang = $_GET['jenis_id'];
                
                $ket = 'Data Transaksi Sparepart Keluar Berdasarkan Jenis Barang' .$jenis_barang;
                $report = $this->barang_model->view_by_jenis_barang_keluar($jenis_barang); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Transaksi Sparepart Keluar';
            $report = $this->barang_model->view_all_keluar(); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
        $data['ket'] = $ket;
        $data['report'] = $report;
        
    ob_start();
    $this->load->view('cetak_rekap_keluar', $data);
    $html = ob_get_contents();
    ob_end_clean();
        
        require_once('./assets/html2pdf/html2pdf.class.php');
    $pdf = new HTML2PDF('P','A4','en');
    //$html2pdf->setDefaultFont('Arial');
    $pdf->WriteHTML($html);
    $pdf->Output('Data Transaksi.pdf', 'I');
  }

  function barang_ready()
  {
    $this->load->view('barang/ready');
  }

  function data_barang()
  {
        $data=$this->barang_model->get_barang();
        echo json_encode($data);
  }

  function data_stock_barang()
  {
        $data=$this->barang_model->barang_list();
        echo json_encode($data);
  }

  function data_rekap()
  {
        $data=$this->barang_model->rekap_list();
        echo json_encode($data);
  }

  function data_rekap_masuk()
  {
    $data = $this->barang_model->rekap_masuk();
    echo json_encode($data);
  }

  function data_rekap_keluar()
  {
    $data = $this->barang_model->rekap_keluar();
    echo json_encode($data);
  }

  function data_barang_ready()
  {
        $data = $this->barang_model->barang_ready();
        echo json_encode($data);
  }


  function kartu_stock()
  {
    $this->load->helper('form_helper');
        $data = array(                      

            'dd_barang' => $this->barang_model->dd_barang(),
            'barang_selected' => $this->input->post('kode_barang') ? $this->input->post('kode_barang') : '$row->kode_barang', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi           
    );

    $this->load->view('barang/kartu_stock', $data);
  }

  

  function data_kartu_stock()
  {
        $data=$this->barang_model->data_kartu_stock();
        echo json_encode($data);
  }



  function read()
  {
    $this->load->helper('form_helper');
 
        $data = array(
             'dd_kategori' => $this->barang_model->dd_kategori(),
            'kategori_selected' => $this->input->post('nama_kategori') ? $this->input->post('nama_kategori') : '$row->kategori_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
           
            'dd_jenis' => $this->barang_model->dd_jenis(),
            'jenis_selected' => $this->input->post('nama_jenis') ? $this->input->post('nama_jenis') : '$row->jenis_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
            
            'dd_barang' => $this->barang_model->dd_barang(),
            'barang_selected' => $this->input->post('nama_barang') ? $this->input->post('nama_barang') : '$row->kode_barang', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
          );

    $this->load->view('barang/read', $data);
  }


 /* function get_json()
  {
    header('Content-Type: application/json');
    echo $this->barang_model->get_all_kartu_stock();
  }*/

 

  function save_kartu_stock()
  {
        $id = $this->input->post('id');
        $kode_barang = $this->input->post('kode_barang');       
        $lokasi = $this->input->post('lokasi');
        $ruang = $this->input->post('ruang');
        $rak = $this->input->post('rak');
        $tingkat = $this->input->post('tingkat');
        $jumlah = $this->input->post('jumlah');
        $keterangan = $this->input->post('keterangan');
        $created_by = $this->input->post('created_by');
        $created_at = $this->input->post('created_at');
        //$updated_by = $this->input->post('updated_by');
        
        $data = $this->barang_model->save_kartu_stock($id, $kode_barang, $lokasi, $ruang, $rak, $tingkat, $jumlah, $keterangan, $created_by, $created_at);
       echo json_encode($data);  
  }


   function get_kartu_stock()
    {
      $id=$this->input->get('id');
        $data=$this->barang_model->get_kartu_stock_by_id($id);
        echo json_encode($data);
    }

  function update_kartu_stock()
  {
   
        $id = $this->input->post('id');        
        $kode_barang = $this->input->post('kode_barang');
        $lokasi=$this->input->post('lokasi');
        $ruang = $this->input->post('ruang');
        $rak = $this->input->post('rak');
        $tingkat = $this->input->post('tingkat');
        $jumlah = $this->input->post('jumlah');
        $keterangan=$this->input->post('keterangan');
        $updated_by = $this->input->post('updated_by');
          
        $data = $this->barang_model->update_kartu_stock($id, $kode_barang, $lokasi, $ruang, $rak, $tingkat, $jumlah, $keterangan, $updated_by);
          echo json_encode($data);
  }

  

  


  function delete_kartu_stock()
  { 
  //function hapus data
    $id=$this->input->post('id');
        $data=$this->barang_model->delete_kartu_stock($id);
        echo json_encode($data);
  }

  


}