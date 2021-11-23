<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kartustock extends CI_Controller
{
	public function __construct(){
    parent::__construct();   
    //validasi jika user belum login
    if($this->session->userdata('masuk') != TRUE){
            $url=base_url();
            redirect($url);
        } 
    $this->load->model('Kartustock_model');
    $this->load->model('Report_model');
  }

  function kartustock_masuk()
  {
  	$kartustock_masuk = $this->Kartustock_model->kartustock();
  	$data['kartustock'] = $kartustock_masuk;
  	
  	$this->load->view('barang/kartu_stock', $data);
  }

  function mutasi_masuk()
  {
    $mutasi_masuk = $this->Kartustock_model->mutasi_masuk();
    $data['mutasi_masuk'] = $mutasi_masuk;

    $mutasi_masuk_total = $this->Kartustock_model->mutasi_masuk_total();
    $data['mutasi_masuk_total'] = $mutasi_masuk_total;

    $this->load->view('kartustock/mutasi_unit', $data);
  }


//mutasi unit masuk

public function mutasi_unit_masuk(){
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
               $type_unit = $_GET['nama_unit'];
                
                $ket = 'Mutasi Unit masuk '.$type_unit;
                $url_cetak = 'kartustock/cetak_mutasi_unit_masuk?filter=1&nama_unit='.$type_unit;
                $report= $this->Report_model->view_by_nama_rekap_unit_masuk($type_unit); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else if ($filter == '2') {
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Mutasi Unit Masuk '.$nama_bulan[$bulan].' '.$tahun;
                $url_cetak = 'kartustock/cetak_mutasi_unit_masuk?filter=2&bulan='.$bulan.'&tahun='.$tahun;
                $report = $this->Report_model->view_by_month_rekap_unit_masuk($bulan, $tahun); 
                //$report = $this->Kartustock_model->view_by_model($model); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else{ // Jika filter nya 5
                $tahun = $_GET['tahun'];
                
                
                $ket = 'Mutasi Unit Masuk '.$tahun;
                $url_cetak = 'kartustock/cetak_mutasi_unit_masuk?filter=3&tahun='.$tahun;
                $report = $this->Report_model->view_by_year_rekap_unit_masuk($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Mutasi Unit Masuk';
            $url_cetak = 'kartustock/cetak_mutasi_unit_masuk';
            $report =  $this->Report_model->rekap_unit_masuk();
            
        }
        
    $data['ket'] = $ket;
    $data['url_cetak'] = base_url('index.php/'.$url_cetak);
    $data['report'] = $report;
    $data['option_tahun_rekap_unit_masuk'] = $this->Report_model->option_tahun_rekap_unit_masuk();
     $data['option_nama_rekap_unit_masuk'] = $this->Report_model->option_nama_rekap_unit_masuk();
    $this->load->view('kartustock/mutasi_unit_masuk', $data);
  }


//cetak
  public function cetak_mutasi_unit_masuk(){
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
               $type_unit = $_GET['nama_unit'];
                
                $ket = 'Mutasi Unit Masuk '.$type_unit;
                $url_cetak = 'kartustock/cetak_mutasi_masukk?filter=1&nama_unit='.$type_unit;
                $report= $this->Report_model->view_by_nama_rekap_unit_masuk($type_unit); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else if ($filter == '2') {
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Mutasi Unit Masuk '.$nama_bulan[$bulan].' '.$tahun;
                $url_cetak = 'kartustock/cetak_mutasi_masukk?filter=2&bulan='.$bulan.'&tahun='.$tahun;
                $report = $this->Report_model->view_by_month_rekap_unit_masuk($bulan, $tahun); 
                //$report = $this->Kartustock_model->view_by_model($model); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else{ // Jika filter nya 5
                $tahun = $_GET['tahun'];
                
                
                $ket = 'Mutasi Unit Masuk Tahun '.$tahun;
                $url_cetak = 'kartustock/cetak_mutasi_masukk?filter=3&tahun='.$tahun;
                $report = $this->Report_model->view_by_year_rekap_unit_masuk($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Mutasi Unit Masuk';
            $url_cetak = 'kartustock/cetak_mutasi_masukk';
            $report =  $this->Kartustock_model->mutasi_masuk();
            
        }
        
    $data['ket'] = $ket;
    $data['url_cetak'] = base_url('index.php/'.$url_cetak);
    $data['report'] = $report;
    $data['option_tahun_rekap_unit_masuk'] = $this->Report_model->option_tahun_rekap_unit_masuk();
     $data['option_model_rekap_unit_masuk'] = $this->Report_model->option_model_rekap_unit_masuk();
     $data['option_nama_rekap_unit_masuk'] = $this->Report_model->option_nama_rekap_unit_masuk();
    /*$this->load->view('kartustock/mutasi_unit', $data);*/

    ob_start();
    $this->load->view('cetak/mutasi_unit_masuk', $data);
    $html = ob_get_contents();
    ob_end_clean();
        
    require_once('./assets/html2pdf/html2pdf.class.php');
    $pdf = new HTML2PDF('P','A4','en');
    //$html2pdf->setDefaultFont('Arial');
    $pdf->writeHTML($html);
    $pdf->Output('Data Transaksi.pdf', 'I');
  }


//mutasi unit keluar

  public function mutasi_unit_keluar(){
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
               $type_unit = $_GET['nama_unit'];
                
                $ket = 'Mutasi Unit Keluar '.$type_unit;
                $url_cetak = 'kartustock/cetak_mutasi_unit_keluar?filter=1&nama_unit='.$type_unit;
                $report= $this->Report_model->view_by_nama_rekap_unit_keluar($type_unit); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else if ($filter == '2') {
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Mutasi Unit Keluar '.$nama_bulan[$bulan].' '.$tahun;
                $url_cetak = 'kartustock/cetak_mutasi_unit_keluar?filter=2&bulan='.$bulan.'&tahun='.$tahun;
                $report = $this->Report_model->view_by_month_rekap_unit_keluar($bulan, $tahun); 
                //$report = $this->Kartustock_model->view_by_model($model); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else{ // Jika filter nya 5
                $tahun = $_GET['tahun'];
                
                
                $ket = 'Mutasi Unit Keluar '.$tahun;
                $url_cetak = 'kartustock/cetak_mutasi_unit_keluar?filter=3&tahun='.$tahun;
                $report = $this->Report_model->view_by_year_rekap_unit_keluar($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Mutasi Unit Keluar ';
            $url_cetak = 'kartustock/cetak_mutasi_unit_keluar';
            $report =  $this->Report_model->rekap_unit_keluar();
            
        }
        
    $data['ket'] = $ket;
    $data['url_cetak'] = base_url('index.php/'.$url_cetak);
    $data['report'] = $report;
    $data['option_tahun_rekap_unit_keluar'] = $this->Report_model->option_tahun_rekap_unit_keluar();
     $data['option_nama_rekap_unit_keluar'] = $this->Report_model->option_nama_rekap_unit_keluar();
    $this->load->view('kartustock/mutasi_unit_keluar', $data);
  }


//cetak mutasi unit keluar
  public function cetak_mutasi_unit_keluar(){
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
               $type_unit = $_GET['nama_unit'];
                
                $ket = 'Mutasi Unit Keluar '.$type_unit;
                $url_cetak = 'kartustock/cetak_mutasi_unit_keluar?filter=1&nama_unit='.$type_unit;
                $report= $this->Report_model->view_by_nama_rekap_unit_keluar($type_unit); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else if ($filter == '2') {
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Mutasi Unit Keluar '.$nama_bulan[$bulan].'  '.$tahun;
                $url_cetak = 'kartustock/cetak_mutasi_unit_keluar?filter=2&bulan='.$bulan.'&tahun='.$tahun;
                $report = $this->Report_model->view_by_month_rekap_unit_keluar($bulan, $tahun); 
                //$report = $this->Kartustock_model->view_by_model($model); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else{ // Jika filter nya 5
                $tahun = $_GET['tahun'];
                
                
                $ket = 'Mutasi Unit Kelua '.$tahun;
                $url_cetak = 'kartustock/cetak_mutasi_unit_keluar?filter=3&tahun='.$tahun;
                $report = $this->Report_model->view_by_year_rekap_unit_keluar($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Mutasi Unit Keluar';
            $url_cetak = 'kartustock/cetak_mutasi_unit_keluar';
             $report =  $this->Report_model->rekap_unit_keluar();
            
        }
        
    $data['ket'] = $ket;
    $data['url_cetak'] = base_url('index.php/'.$url_cetak);
    $data['report'] = $report;
    $data['option_tahun_rekap_unit_keluar'] = $this->Report_model->option_tahun_rekap_unit_keluar();
     $data['option_model_rekap_unit_keluar'] = $this->Report_model->option_model_rekap_unit_keluar();
     $data['option_nama_rekap_unit_keluar'] = $this->Report_model->option_nama_rekap_unit_keluar();
    /*$this->load->view('kartustock/mutasi_unit', $data);*/

    ob_start();
    $this->load->view('cetak/mutasi_unit_keluar', $data);
    $html = ob_get_contents();
    ob_end_clean();
        
    require_once('./assets/html2pdf/html2pdf.class.php');
    $pdf = new HTML2PDF('P','A4','en');
    //$html2pdf->setDefaultFont('Arial');
    $pdf->writeHTML($html);
    $pdf->Output('Data Transaksi.pdf', 'I');
  }


//kartu stock//
  function kartustock(){
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
               $model = $_GET['model'];
                
                $ket = 'Kartu Stock Model '.$model;
                $url_cetak = 'kartustock/cetak_kartustock?filter=1&model='.$model;
                $kartustock_masuk= $this->Kartustock_model->view_by_model_kartustock($model);
                $kartustock_keluar = $this->Kartustock_model->kartustock_keluar();
                $kartustock_dipesan = $this->Kartustock_model->kartustock_dipesan();
                $kartustock_order_stock =  $this->Kartustock_model->kartustock_order_stock();
                 // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else{ // Jika filter nya 5
                $serial_number = $_GET['serial_number'];
                
                
                $ket = 'Kartu Stock Serial Number '.$serial_number;
                $url_cetak = 'kartustock/cetak_kartustock?filter=2&serial_number='.$serial_number;
                $kartustock_masuk = $this->Kartustock_model->view_by_serial_number_kartustock($serial_number);
                $kartustock_keluar = $this->Kartustock_model->kartustock_keluar();
                $kartustock_dipesan = $this->Kartustock_model->kartustock_dipesan();
                $kartustock_order_stock =  $this->Kartustock_model->kartustock_order_stock(); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Kartu Stock';
            $url_cetak = 'kartustock/cetak_kartustock';
            $kartustock_masuk = $this->Kartustock_model->kartustock_masuk();
            $kartustock_keluar = $this->Kartustock_model->kartustock_keluar();
            $kartustock_dipesan = $this->Kartustock_model->kartustock_dipesan();
                $kartustock_order_stock =  $this->Kartustock_model->kartustock_order_stock(); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
    $data['ket'] = $ket;
    $data['url_cetak'] = base_url('index.php/'.$url_cetak);
    //$data['report'] = $report;
    $data['kartustock_masuk'] = $kartustock_masuk;
    $data['kartustock_keluar'] = $kartustock_keluar;
    $data['option_model_kartustock'] = $this->Kartustock_model->option_model_kartustock();
    $data['option_serial_number_kartustock'] = $this->Kartustock_model->option_serial_number_kartustock();
    $data['kartustock_dipesan'] = $kartustock_dipesan;
        $data['kartustock_order_stock'] = $kartustock_order_stock;
    $this->load->view('kartustock/kartustock', $data);
  }


   function cetak_kartustock(){
         if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
               $model = $_GET['model'];
                
                $ket = 'Kartu Stock Unit model '.$model;
                $url_cetak = 'artustock/cetak_kartustock?filter=1&model='.$model;
                $kartustock_masuk= $this->Kartustock_model->view_by_model_kartustock($model);
                $kartustock_keluar = $this->Kartustock_model->kartustock_keluar();
                $kartustock_dipesan = $this->Kartustock_model->kartustock_dipesan();
                $kartustock_order_stock =  $this->Kartustock_model->kartustock_order_stock(); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else if($filter == '2'){ // Jika filter nya 1 (per tanggal)
               $serial_number = $_GET['serial_number'];
                
                $ket = 'kartu Stock Unit serial number '.$serial_number;
                $url_cetak = 'kartustock/cetak_kartustock?filter=2&serial_number='.$serial_number;
                $kartustock_masuk = $this->Kartustock_model->view_by_serial_number_kartustock($serial_number);
                $kartustock_keluar = $this->Kartustock_model->kartustock_keluar(); 
                $kartustock_dipesan = $this->Kartustock_model->kartustock_dipesan();
                $kartustock_order_stock =  $this->Kartustock_model->kartustock_order_stock();// Panggil fungsi view_by_date yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Kartu Stock Unit';
            $url_cetak = 'kartustock/cetak_kartustock';
            $kartustock_masuk = $this->Kartustock_model->kartustock_masuk_cetak();
            $kartustock_keluar = $this->Kartustock_model->kartustock_keluar();
            $kartustock_dipesan = $this->Kartustock_model->kartustock_dipesan();
            $kartustock_order_stock =  $this->Kartustock_model->kartustock_order_stock(); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
        $data['ket'] = $ket;
        $data['kartustock_masuk'] = $kartustock_masuk;
        $data['kartustock_keluar'] = $kartustock_keluar;
         $data['kartustock_dipesan'] = $kartustock_dipesan;
        $data['kartustock_order_stock'] = $kartustock_order_stock;

        
    ob_start();
    $this->load->view('cetak/kartustock', $data);
    $html = ob_get_contents();
    ob_end_clean();
        
    require_once('./assets/html2pdf/html2pdf.class.php');
    $pdf = new HTML2PDF('P','A4','en');
    //$html2pdf->setDefaultFont('Arial');
    $pdf->writeHTML($html);
    $pdf->Output('Data Transaksi.pdf', 'I');
  }


}
