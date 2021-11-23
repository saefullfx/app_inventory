<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {
    
     private $filename = 'format_cek_stock';
  
public function __construct()
{
    parent::__construct();
    //validasi jika user belum login
    if($this->session->userdata('masuk') != TRUE){
            $url=base_url();
            redirect($url);
        }
    
     $this->load->model('Report_model');
     $this->load->model('order_model');
     $this->load->model('dashboard_model');
     $this->load->helper('form_helper');
  }
  

//SPAREPART//

     public function rekap_all()
     {
            if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
                $filter = $_GET['filter']; // Ambil data filder yang dipilih user

                if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                   $kode_barang3 = $_GET['kode_barang3'];
                    
                    $ket = 'Data Rekap Sparepart Berdasarkan Part Number ' .$kode_barang3;
                    $url_cetak = 'report/cetak_rekap_all?filter=1&kode_barang3='.$kode_barang3;
                    $report= $this->Report_model->view_by_partnumber_rekapall($kode_barang3); // Panggil fungsi view_by_date yang ada di TransaksiModel
                }else{ // Jika filter nya 5
                    $jenis_id = $_GET['jenis_id'];
                    
                    
                    $ket = 'Data Transaksi Rekap Sparepart Berdasarkan Jenis Barang ';
                    $url_cetak = 'report/cetak_rekap_all?filter=2&jenis_id='. $jenis_id;
                    $report = $this->Report_model->view_by_jenis($jenis_id); // Panggil fungsi view_by_year yang ada di TransaksiModel
                }
            }else{ // Jika user tidak mengklik tombol tampilkan
                $ket = 'Semua Data Transaksi Sparepart';
                $url_cetak = 'report/cetak_rekap_all';
                $report = $this->Report_model->view_all_rekap(); // Panggil fungsi view_all yang ada di TransaksiModel
            }
            
        $data['ket'] = $ket;
        $data['url_cetak'] = base_url('index.php/'.$url_cetak);
        $data['report'] = $report;
        $data['option_kode_barang_rekap'] = $this->Report_model->option_kode_barang_rekap();
        $data['option_jenis_barang_rekap_all'] = $this->Report_model->option_jenis_barang_rekap_all();
        $data['sparepart_ongoing'] = $this->Report_model->sparepart_ongoing();
        $data['sparepart_dipesan'] = $this->Report_model->sparepart_dipesan();
        $this->load->view('report/rekap_all', $data);
      }
  
      public function barang_keluar()
      {
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];
                
                $ket = 'Data Transaksi Sparepart Keluar Berdasarkan Tanggal '.date('d-m-y', strtotime($tgl));
                $url_cetak = 'report/cetak?filter=1&tanggal='.$tgl;
                $report= $this->Report_model->view_by_date($tgl); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Data Transaksi Sparepart Keluar Berdasarkan Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $url_cetak = 'report/cetak?filter=2&bulan='.$bulan.'&tahun='.$tahun;
                $report = $this->Report_model->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di Report_model
            }else if($filter == '3'){ 
                $tahun = $_GET['tahun'];
                
                $ket = 'Data Transaksi Sparepart Keluar Berdasarkan Tahun '.$tahun;
                $url_cetak = 'report/cetak?filter=3&tahun='.$tahun;
                $report = $this->Report_model->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else if($filter == '4'){ 
                $kode_barang = $_GET['kode_barang'];
                
                $ket = 'Data Transaksi Barang Keluar Berdasarkan Part Number '.$kode_barang;
                $url_cetak = 'report/cetak?filter=4&kode_barang='.$kode_barang;
                $report = $this->Report_model->view_by_partnumber($kode_barang); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else if ($filter == '5'){ // Jika filter nya 5
                $kode_barang2 = $_GET['kode_barang2'];
                $tanggal2 = $_GET['tanggal2'];
                $ket = 'Data Transaksi Sparepart Keluar Berdasarkan Part Number '.$kode_barang2.' dan Tanggal '.$tanggal2.' ';
                $url_cetak = 'report/cetak?filter=5&kode_barang2='.$kode_barang2.'&tanggal2='.$tanggal2;
                $report = $this->Report_model->view_by_partnumber_tanggal($kode_barang2, $tanggal2); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else{ // Jika filter nya 6
                $kode_barang3 = $_GET['kode_barang3'];
                $bulan2 = $_GET['bulan2'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Data Transaksi Sparepart Keluar Berdasarkan Part Number '.$kode_barang3.' dan Bulan '.$nama_bulan[$bulan3].' '.$tahun;
                $url_cetak = 'report/cetak?filter=6&kode_barang='.$kode_barang3.'&bulan='.$bulan2.'&tahun='.$tahun;
                $report = $this->Report_model->view_by_partnumber_bulan($kode_barang3, $bulan2, $tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Transaksi Sparepart Keluar';
            $url_cetak = 'report/cetak';
            $report = $this->Report_model->view_all(); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
        $data['ket'] = $ket;
        $data['url_cetak'] = base_url('index.php/'.$url_cetak);
        $data['report'] = $report;
        $data['option_tahun'] = $this->Report_model->option_tahun();
        $data['option_kode_barang'] = $this->Report_model->option_kode_barang();
        $this->load->view('report/barang_keluar', $data);
      }

      public function barang_masuk()
      {
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];
                
                $ket = 'Data Transaksi Sparepart Masuk Tanggal '.date('d-m-y', strtotime($tgl));
                $url_cetak = 'report/cetak_masuk?filter=1&tanggal='.$tgl;
                $report= $this->Report_model->view_by_date_masuk($tgl); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Data Transaksi Sparepart Masuk Bulan '. $nama_bulan[$bulan].' ' .$tahun;
                $url_cetak = 'report/cetak_masuk?filter=2&bulan='.$bulan.'&tahun='.$tahun;
                $report = $this->Report_model->view_by_month_masuk($bulan, $tahun); // Panggil fungsi view_by_month yang ada di Report_model
            }else if($filter == '3'){ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                
                $ket = 'Data Transaksi Sparepart Masuk Tahun '.$tahun;
                $url_cetak = 'report/cetak_masuk?filter=3&tahun='.$tahun;
                $report = $this->Report_model->view_by_year_masuk($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else if($filter == '4'){ 
                $kode_barang = $_GET['kode_barang'];
                
                $ket = 'Data Transaksi Barang Masuk Berdasarkan Part Number ' .$kode_barang;
                $url_cetak = 'report/cetak_masuk?filter=4&kode_barang='.$kode_barang;
                $report = $this->Report_model->view_by_partnumbermasuk($kode_barang); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else{ // Jika filter nya 5
                $kode_barang2 = $_GET['kode_barang2'];
                $tanggal2 = $_GET['tanggal2'];
                
                $ket = 'Data Transaksi Barang Masuk Berdasarkan Part Number ' .$kode_barang2.' dan Tanggal '.$tanggal2.' ';
                $url_cetak = 'report/cetak_masuk?filter=5&kode_barang2='.$kode_barang2.'&tanggal2='.$tanggal2;
                $report = $this->Report_model->view_by_partnumber_tanggal_masuk($kode_barang2, $tanggal2); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak memilih opsi dan mengklik tombol tampilkan
            $ket = 'Semua Data Transaksi Sparepart Masuk';
            $url_cetak = 'report/cetak_masuk';
            $report = $this->Report_model->view_all_masuk(); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
            $data['ket'] = $ket;
            $data['url_cetak'] = base_url('index.php/'.$url_cetak);
            $data['report'] = $report;
            $data['option_tahun'] = $this->Report_model->option_tahun_masuk();
            $data['option_kode_barangmasuk'] = $this->Report_model->option_kode_barangmasuk();
        $this->load->view('report/barang_masuk', $data);
      }

    //SPAREPART//
    

    //UNIT//
   //unit masuk//
    public function unit_masuk()
    {
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];
                
                $ket = 'Data Transaksi Unit Masuk Tanggal '.date('d-m-y', strtotime($tgl));
                $url_cetak = 'report/cetak_unit_masuk?filter=1&tanggal='.$tgl;
                $report= $this->Report_model->view_by_date_unit_masuk($tgl); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Data Transaksi Unit Masuk Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $url_cetak = 'report/cetak_unit_masuk?filter=2&bulan='.$bulan.'&tahun='.$tahun;
                $report = $this->Report_model->view_by_month_unit_masuk($bulan, $tahun); // Panggil fungsi view_by_month yang ada di Report_model
            }else if($filter == '3'){ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                
                $ket = 'Data Transaksi Unit Masuk Tahun '.$tahun;
                $url_cetak = 'report/cetak_unit_masuk?filter=3&tahun='.$tahun;
                $report = $this->Report_model->view_by_year_unit_masuk($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else if($filter == '4'){ // Jika filter nya 3 (per tahun)
                $model = $_GET['model'];
                
                $ket = 'Data Transaksi Unit Masuk Model '.$model;
                $url_cetak = 'report/cetak_unit_masuk?filter=4&model='.$model;
                $report = $this->Report_model->view_model_unit_masuk($model); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else { // Jika filter nya 3 (per tahun)
                $nama_unit = $_GET['nama_unit'];
                
                $ket = 'Data Transaksi Unit Masuk'.$nama_unit;
                $url_cetak = 'report/cetak_unit_masuk?filter=5&nama_unit='.$nama_unit;
                $report = $this->Report_model->view_nama_unit_masuk($nama_unit); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Transaksi Unit Masuk';
            $url_cetak = 'report/cetak_unit_masuk';
            $report = $this->Report_model->view_all_unit_masuk(); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
    $data['ket'] = $ket;
    $data['url_cetak'] = base_url('index.php/'.$url_cetak);
    $data['report'] = $report;
    $data['option_tahun'] = $this->Report_model->option_tahun_unit_masuk();
    $data['option_model'] = $this->Report_model->option_model_unit_masuk();
    $data['option_nama_unit'] = $this->Report_model->option_nama_unit_masuk();
    $this->load->view('report/unit_masuk', $data);
  }

  //unit keluar
  public function unit_keluar()
  {
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];
                
                $ket = 'Data Transaksi Unit Keluar Tanggal '.date('d-m-y', strtotime($tgl));
                $url_cetak = 'report/cetak_unit_keluar?filter=1&tanggal='.$tgl;
                $report= $this->Report_model->view_by_date_unit_keluar($tgl); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Data Transaksi Unit Keluar Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $url_cetak = 'report/cetak_unit_keluar?filter=2&bulan='.$bulan.'&tahun='.$tahun;
                $report = $this->Report_model->view_by_month_unit_keluar($bulan, $tahun); // Panggil fungsi view_by_month yang ada di Report_model
            }else if($filter == '3'){ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                
                $ket = 'Data Transaksi Unit Keluar Tahun '.$tahun;
                $url_cetak = 'report/cetak_unit_keluar?filter=3&tahun='.$tahun;
                $report = $this->Report_model->view_by_year_unit_keluar($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else if($filter == '4'){ // Jika filter nya 3 (per tahun)
                $model = $_GET['model'];
                
                $ket = 'Data Transaksi Unit Keluar Model '.$model;
                $url_cetak = 'report/cetak_unit_keluar?filter=4&model='.$model;
                $report = $this->Report_model->view_model_unit_keluar($model); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else{ // Jika filter nya 3 (per tahun)
                $nama_unit = $_GET['nama_unit'];
                
                $ket = 'Data Transaksi Unit Keluar '.$nama_unit;
                $url_cetak = 'report/cetak_unit_keluar?filter=5&nama_unit='.$nama_unit;
                $report = $this->Report_model->view_nama_unit_keluar($nama_unit); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Transaksi Unit Keluar';
            $url_cetak = 'report/cetak_unit_keluar';
            $report = $this->Report_model->view_all_unit_keluar(); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
        $data['ket'] = $ket;
        $data['url_cetak'] = base_url('index.php/'.$url_cetak);
        $data['report'] = $report;
        $data['option_tahun'] = $this->Report_model->option_tahun_unit_keluar();
        $data['option_model'] = $this->Report_model->option_model_unit_keluar();
        $data['option_nama_unit'] = $this->Report_model->option_nama_unit_keluar();
        $this->load->view('report/unit_keluar', $data);
  }
  
  //rekap unit masuk//
    public function rekap_unit_masuk()
    {
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Data Rekap Unit Masuk Bulan ' .$nama_bulan[$bulan].' '.$tahun;
                $url_cetak = 'report/cetak_rekap_unit_masuk?filter=1&bulan='.$bulan.'&tahun='.$tahun;
                $report = $this->Report_model->view_by_month_rekap_unit_masuk($bulan, $tahun); // Panggil fungsi view_by_month yang ada di Report_model
            }else if($filter == '2'){ 
                $tahun = $_GET['tahun'];
                
                $ket = 'Data Rekap Unit Masuk Tahun '.$tahun;
                $url_cetak = 'report/cetak_rekap_unit_masuk?filter=2&tahun='.$tahun;
                $report = $this->Report_model->view_by_year_rekap_unit_masuk($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else if($filter == '3'){ // Jika filter nya 4 (per tahun)
                $model = $_GET['model'];
                
                $ket = 'Data Rekap Unit Masuk Model ' .$model;
                $url_cetak = 'report/cetak_rekap_unit_masuk?filter=3&model='.$model;
                $report = $this->Report_model->view_by_model_rekap_unit_masuk($model); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else{ // Jika filter nya 4 (per tahun)
                $nama_unit = $_GET['nama_unit'];
                
                $ket = 'Data Rekap Unit Masuk Nama Unit ' .$nama_unit;
                $url_cetak = 'report/cetak_rekap_unit_masuk?filter=4&nama_unit='.$nama_unit;
                $report = $this->Report_model->view_by_nama_rekap_unit_masuk($nama_unit); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Data Rekap Unit Masuk';
            $url_cetak = 'report/cetak_rekap_unit_masuk';
            $report = $this->Report_model->rekap_unit_masuk(); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
        $data['ket'] = $ket;
        $data['url_cetak'] = base_url('index.php/'.$url_cetak);
        $data['report'] = $report;
        $data['option_tahun_rekap_unit_masuk'] = $this->Report_model->option_tahun_rekap_unit_masuk();
        $data['option_model_rekap_unit_masuk'] = $this->Report_model->option_model_rekap_unit_masuk();
        $data['option_nama_rekap_unit_masuk'] = $this->Report_model->option_nama_rekap_unit_masuk();
        $this->load->view('report/rekap_unit_masuk', $data);
  }
  
  //rekap unit keluar//
   public function rekap_unit_keluar()
   {
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Data Rekap Unit Keluar Bulan ' .$nama_bulan[$bulan].' '.$tahun;
                $url_cetak = 'report/cetak_rekap_unit_keluar?filter=1&bulan='.$bulan.'&tahun='.$tahun;
                $report = $this->Report_model->view_by_month_rekap_unit_keluar($bulan, $tahun); // Panggil fungsi view_by_month yang ada di Report_model
            }else if($filter == '2'){ 
                $tahun = $_GET['tahun'];
                
                $ket = 'Data Rekap Unit Keluar Tahun ' .$tahun;
                $url_cetak = 'report/cetak_rekap_unit_keluar?filter=2&tahun='.$tahun;
                $report = $this->Report_model->view_by_year_rekap_unit_keluar($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else if($filter == '3'){ // Jika filter nya 4 (per tahun)
                $model = $_GET['model'];
                
                $ket = 'Data Rekap Unit Keluar Model ' .$model;
                $url_cetak = 'report/cetak_rekap_unit_keluar?filter=3&model='.$model;
                $report = $this->Report_model->view_by_model_rekap_unit_keluar($model); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else{ // Jika filter nya 4 (per tahun)
                $nama_unit = $_GET['nama_unit'];
                
                $ket = 'Data Rekap Unit Keluar Nama Unit '.$nama_unit;
                $url_cetak = 'report/cetak_rekap_unit_masuk?filter=4&nama_unit='.$nama_unit;
                $report = $this->Report_model->view_by_nama_rekap_unit_keluar($nama_unit); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Rekap Transaksi Unit Keluar';
            $url_cetak = 'report/cetak_rekap_unit_keluar';
            $report = $this->Report_model->rekap_unit_keluar(); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
        $data['ket'] = $ket;
        $data['url_cetak'] = base_url('index.php/'.$url_cetak);
        $data['report'] = $report;
        $data['option_tahun_rekap_unit_keluar'] = $this->Report_model->option_tahun_rekap_unit_keluar();
        $data['option_model_rekap_unit_keluar'] = $this->Report_model->option_model_rekap_unit_keluar();
        $data['option_nama_rekap_unit_keluar'] = $this->Report_model->option_nama_rekap_unit_keluar();
        $this->load->view('report/rekap_unit_keluar', $data);
  }
  
  
  //cetak //
  public function cetak_rekap_all()
  {
         if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

           if($filter == '1'){ // Jika filter nya 1 (per tanggal)
               $kode_barang = $_GET['kode_barang3'];
                
                $ket = 'Data Rekap Barang Berdasarkan Part Number '.$kode_barang;
                //$url_cetak = 'report/cetak_rekap_all?filter=1&kode_barang='.$kode_barang;
                $report= $this->Report_model->view_by_partnumber_rekapall($kode_barang); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else if($filter == '2'){ // Jika filter nya 1 (per tanggal)
               $jenis_id = $_GET['jenis_id'];
                
                $ket = 'Data Rekap Barang Berdasarkan Jenis Barang ';
                //$url_cetak = 'report/cetak_rekap_all?filter=2&jenis_id='.$jenis_id;
                $report = $this->Report_model->view_by_jenis($jenis_id); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Rekap Transaksi Barang';
            $url_cetak = 'report/cetak_rekap_all';
            $report = $this->Report_model->view_all_rekap(); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
        $data['ket'] = $ket;
        $data['report'] = $report;
        
        ob_start();
        $this->load->view('cetak_rekap_keluar_masuk', $data);
        $html = ob_get_contents();
        ob_end_clean();
            
            require_once('./assets/html2pdf/html2pdf.class.php');
        $pdf = new HTML2PDF('P','A4','en');
        //$html2pdf->setDefaultFont('Arial');
        $pdf->WriteHTML($html);
        $pdf->Output('Data Transaksi.pdf', 'I');
  }
  

  
  public function cetak()
  {
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];                
                $ket = 'Data Transaksi Tanggal '.date('d-m-y', strtotime($tgl));
                $report = $this->Report_model->view_by_date($tgl); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Data Transaksi Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $report = $this->Report_model->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di TransaksiModel
            }else if($filter == '3'){ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                
                $ket = 'Data Transaksi Tahun '.$tahun;
                $report = $this->Report_model->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else if($filter == '4'){ // Jika filter nya 3 (per tahun)
                $kode_barang = $_GET['kode_barang'];
                
                $ket = 'Data Transaksi Part Number '.$kode_barang;
                $report = $this->Report_model->view_by_partnumber($kode_barang); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else{ // Jika filter nya 3 (per tahun)
                $kode_barang2 = $_GET['kode_barang2'];
                $tanggal2 = $_GET['tanggal2'];
                
                $ket = 'Data Transaksi Part Number '.$kode_barang2.' Tanggal '.$tanggal2.'';
                $report = $this->Report_model->view_by_partnumber_tanggal($kode_barang2, $tanggal2); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Transaksi';
            $report = $this->Report_model->view_all(); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
        $data['ket'] = $ket;
        $data['report'] = $report;
        
        ob_start();
        $this->load->view('print', $data);
        $html = ob_get_contents();
        ob_end_clean();
            
            require_once('./assets/html2pdf/html2pdf.class.php');
        $pdf = new HTML2PDF('P','A4','en');
        //$html2pdf->setDefaultFont('Arial');
        $pdf->WriteHTML($html);
        $pdf->Output('Data Transaksi.pdf', 'I');
  }

  public function cetak_masuk()
  {
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];                
                $ket = 'Data Transaksi Barang Masuk Tanggal '.date('d-m-y', strtotime($tgl));
                $report = $this->Report_model->view_by_date_masuk($tgl); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Data Transaksi Barang Masuk Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $report = $this->Report_model->view_by_month_masuk($bulan, $tahun); // Panggil fungsi view_by_month yang ada di TransaksiModel
            }else if($filter == '3'){ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                
                $ket = 'Data Transaksi Barang Masuk Tahun '.$tahun;
                $report = $this->Report_model->view_by_year_masuk($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else if($filter == '4'){ // Jika filter nya 3 (per tahun)
                $kode_barang = $_GET['kode_barang'];
                
                $ket = 'Data Transaksi Part Number '.$kode_barang;
                $report = $this->Report_model->view_by_partnumber_masuk($kode_barang); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else{ // Jika filter nya 3 (per tahun)
                $kode_barang2 = $_GET['kode_barang2'];
                $tanggal2 = $_GET['tanggal2'];
                
                $ket = 'Data Transaksi Part Number '.$kode_barang2.' Tanggal '.$tanggal2.'';
                $report = $this->Report_model->view_by_partnumber_tanggal_masuk($kode_barang2, $tanggal2); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Transaksi';
            $report = $this->Report_model->view_all_masuk(); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
        $data['ket'] = $ket;
        $data['report'] = $report;
         
        try{
        ob_start();
        $this->load->view('print_masuk', $data);
        $html = ob_get_contents();
        ob_end_clean();
            
        require_once('./assets/html2pdf/html2pdf.class.php');
        $pdf = new HTML2PDF('P','A4','en');
        $pdf->WriteHTML($html);
        $pdf->Output('Data Transaksi.pdf', date('d-m-y'), 'I');
        }catch (Html2PdfException $e){
        $html2pdf->clean();
        $formatter = new ExceptionFormatter($e);
        echo $formatter->getHtmlMessage();
        }    
  }
  
  public function cetak_unit_masuk()
  {
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];                
                $ket = 'Data Transaksi Unit Masuk  Tanggal '.date('d-m-y', strtotime($tgl));
                $report = $this->Report_model->view_by_date_unit_masuk($tgl); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Data Transaksi Unit Masuk  Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $report = $this->Report_model->view_by_month_unit_masuk($bulan, $tahun); // Panggil fungsi view_by_month yang ada di TransaksiModel
            }else if($filter == '3'){ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                
                $ket = 'Data Transaksi Unit Masuk Tahun '.$tahun;
                $report = $this->Report_model->view_by_year_unit_masuk($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else if($filter == '4'){ // Jika filter nya 3 (per tahun)
                $model = $_GET['model'];
                
                $ket = 'Data Transaksi Unit Masuk Model'.$model;
                $report = $this->Report_model->view_model_unit_masuk($model); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else{ // Jika filter nya 3 (per tahun)
                $nama_unit = $_GET['nama_unit'];
                
                $ket = 'Data Transaksi Unit Masuk  '.$nama_unit;
                $report = $this->Report_model->view_nama_unit_masuk($nama_unit); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Transaksi Unit Masuk';
            $report = $this->Report_model->view_all_unit_masuk(); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
        $data['ket'] = $ket;
        $data['report'] = $report;
        
        try{
        ob_start();
        $this->load->view('unit_masuk', $data);
        $html = ob_get_contents();
        ob_end_clean();
            
        require_once('./assets/html2pdf/html2pdf.class.php');
        $pdf = new HTML2PDF('P','A4','en');
        $pdf->WriteHTML($html);
        $pdf->Output('Unit Masuk.pdf', date('d-m-y'), 'I');
        }catch (Html2PdfException $e){
        $html2pdf->clean();
        $formatter = new ExceptionFormatter($e);
        echo $formatter->getHtmlMessage();
        }    
  }

  public function cetak_unit_keluar()
  {
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];                
                $ket = 'Data Transaksi Unit Keluar Tanggal '.date('d-m-y', strtotime($tgl));
                $report = $this->Report_model->view_by_date_unit_keluar($tgl); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Data Transaksi Unit Keluar Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $report = $this->Report_model->view_by_month_unit_keluar($bulan, $tahun); // Panggil fungsi view_by_month yang ada di TransaksiModel
            }else if($filter == '3'){ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                
                $ket = 'Data Transaksi Unit Keluar Tahun '.$tahun;
                $report = $this->Report_model->view_by_year_unit_keluar($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else if($filter == '4'){ // Jika filter nya 3 (per tahun)
                $model = $_GET['model'];
                
                $ket = 'Data Transaksi Unit keluar Model '.$model;
                $report = $this->Report_model->view_model_unit_keluar($model); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }else{ // Jika filter nya 3 (per tahun)
                $nama_unit = $_GET['nama_unit'];
                
                $ket = 'Data Transaksi Unit Keluar '.$nama_unit;
                $report = $this->Report_model->view_nama_unit_keluar($nama_unit); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Transaksi Unit Keluar';
            $report = $this->Report_model->view_all_unit_keluar(); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
        $data['ket'] = $ket;
        $data['report'] = $report;
        
        ob_start();
        $this->load->view('unit_keluar', $data);
        $html = ob_get_contents();
        ob_end_clean();
            
            require_once('./assets/html2pdf/html2pdf.class.php');
        $pdf = new HTML2PDF('P','A4','en');
        //$html2pdf->setDefaultFont('Arial');
        $pdf->WriteHTML($html);
        $pdf->Output('Unit Keluar.pdf', date('d-m-y'), 'I');
  }
  
  public function cetak_rekap_unit_masuk()
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
                
                $ket = 'Data Rekap Unit Masuk Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $report = $this->Report_model->view_by_month_rekap_unit_masuk($bulan, $tahun); // Panggil fungsi view_by_month yang ada di Rekap Unit MasukModel
            }else if($filter == '2'){ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                
                $ket = 'Data Rekap Unit Masuk Tahun '.$tahun;
                $report = $this->Report_model->view_by_year_rekap_unit_masuk($tahun); // Panggil fungsi view_by_year yang ada di Rekap Unit MasukModel
            }else if($filter == '3'){ // Jika filter nya 3 (per tahun)
                $model = $_GET['model'];
                
                $ket = 'Data Rekap Unit Masuk Model '.$model;
                $report = $this->Report_model->view_by_model_rekap_unit_masuk($model); // Panggil fungsi view_by_year yang ada di Rekap Unit MasukModel
            }else{ // Jika filter nya 3 (per tahun)
                $nama_unit = $_GET['nama_unit'];
                
                $ket = 'Data Rekap Unit Masuk Nama Unit '.$nama_unit;
               // $url_cetak = 'barang/barang/cetak_rekap_masuk?filter=4&nama_unit='.$nama_unit;
                $report = $this->Report_model->view_by_nama_rekap_unit_masuk($nama_unit);// Panggil fungsi view_by_year yang ada di Rekap Unit MasukModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Rekap Unit Masuk';
            $report = $this->Report_model->rekap_unit_masuk(); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
        $data['ket'] = $ket;
        $data['report'] = $report;
        
        ob_start();
        $this->load->view('cetak/cetak_rekap_unit_masuk', $data);
        $html = ob_get_contents();
        ob_end_clean();
            
            require_once('./assets/html2pdf/html2pdf.class.php');
        $pdf = new HTML2PDF('P','A4','en');
        //$html2pdf->setDefaultFont('Arial');
        $pdf->WriteHTML($html);
        $pdf->Output('Data Transaksi.pdf', 'I');
  }
  
  public function cetak_rekap_unit_keluar()
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
                
                $ket = 'Data Rekap Unit Keluar Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $report = $this->Report_model->view_by_month_rekap_unit_keluar($bulan, $tahun); // Panggil fungsi view_by_month yang ada di Rekap Unit MasukModel
            }else if($filter == '2'){ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                
                $ket = 'Data Rekap Unit Keluar Tahun '.$tahun;
                $report = $this->Report_model->view_by_year_rekap_unit_keluar($tahun); // Panggil fungsi view_by_year yang ada di Rekap Unit MasukModel
            }else if($filter == '3'){ // Jika filter nya 3 (per tahun)
                $model = $_GET['model'];
                
                $ket = 'Data Rekap Unit Keluar Model '.$model;
                $report = $this->Report_model->view_by_model_rekap_unit_keluar($model); // Panggil fungsi view_by_year yang ada di Rekap Unit MasukModel
            }else{ // Jika filter nya 3 (per tahun)
                $nama_unit = $_GET['nama_unit'];
                
                $ket = 'Data Rekap Unit Keluar Nama Unit '.$nama_unit;
               // $url_cetak = 'barang/barang/cetak_rekap_masuk?filter=4&nama_unit='.$nama_unit;
                $report = $this->Report_model->view_by_nama_rekap_unit_keluar($nama_unit);// Panggil fungsi view_by_year yang ada di Rekap Unit MasukModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Rekap Unit Keluar';
            $report = $this->Report_model->rekap_unit_keluar(); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
        $data['ket'] = $ket;
        $data['report'] = $report;
        
        ob_start();
        $this->load->view('cetak/cetak_rekap_unit_keluar', $data);
        $html = ob_get_contents();
        ob_end_clean();
            
            require_once('./assets/html2pdf/html2pdf.class.php');
        $pdf = new HTML2PDF('P','A4','en');
        //$html2pdf->setDefaultFont('Arial');
        $pdf->WriteHTML($html);
        $pdf->Output('Data Transaksi.pdf', 'I');
  }
  
  //rekap unit all//
  public function rekap_unit_all()
  {
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
               $model = $_GET['model'];
                
                $ket = 'Data Rekap Unit ' .$model;
                $url_cetak = 'report/cetak_rekap_unit_all?filter=1&model='.$model;
                $report= $this->Report_model->view_by_model_rekap_unit($model); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else{ // Jika filter nya 5
                $nama_unit = $_GET['nama_unit'];
                
                
                $ket = 'Data Rekap Unit ' .$nama_unit;
                $url_cetak = 'report/cetak_rekap_unit_all?filter=2&nama_unit='.$nama_unit;
                $report = $this->Report_model->view_by_nama_unit_rekap_unit($nama_unit); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Rekap Unit';
            $url_cetak = 'report/cetak_rekap_unit_all';
            $report = $this->Report_model->view_all_rekap_unit(); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
        $data['ket'] = $ket;
        $data['url_cetak'] = base_url('index.php/'.$url_cetak);
        $data['report'] = $report;
        $data['option_model_rekap_unit'] = $this->Report_model->option_model_rekap_unit();
        $data['option_nama_unit_rekap'] = $this->Report_model->option_nama_unit_rekap();
        $this->load->view('report/rekap_unit_all', $data);
  }

  //cetak rekap unit all//
  public function cetak_rekap_unit_all(){
         if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
               $model = $_GET['model'];
                
                $ket = 'Data Rekap Unit  '.$model;
                $url_cetak = 'report/cetak_rekap_unit_all?filter=1&model='.$model;
                $report= $this->Report_model->view_by_model_rekap_unit($model); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else if($filter == '2'){ // Jika filter nya 1 (per tanggal)
               $nama_unit = $_GET['nama_unit'];
                
                $ket = 'Data Rekap Unit  '.$nama_unit;
                $url_cetak = 'report/cetak_rekap_unit_all?filter=2&nama_unit='.$nama_unit;
                $report = $this->Report_model->view_by_nama_unit_rekap_unit($nama_unit); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Rekap Unit';
            $url_cetak = 'report/cetak_rekap_unit_all';
            $report = $this->Report_model->view_all_rekap_unit(); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
        $data['ket'] = $ket;
        $data['report'] = $report;
        
    ob_start();
    $this->load->view('cetak_rekap_unit_all', $data);
    $html = ob_get_contents();
    ob_end_clean();
        
        require_once('./assets/html2pdf/html2pdf.class.php');
    $pdf = new HTML2PDF('P','A4','en');
    //$html2pdf->setDefaultFont('Arial');
    $pdf->WriteHTML($html);
    $pdf->Output('Data Transaksi.pdf', 'I');
  }
  //rekap unit all selesai//
  
  
  //View Detail rekap Unit//
  function detail_unit_masuk($model_id)
  {

    $detail = $this->Report_model->detail_unit_masuk($model_id);
   
    $data['detail_unit_masuk'] = $detail;
    $this->load->view('barang/detail_unit_masuk', $data);
  }

   function detail_unit_keluar($model_id)
  {
   
    $detail = $this->Report_model->detail_unit_keluar($model_id);
    //$detail = $this->Report_model->detail_unit_dipesan($model_id);*/
   
    $data['detail_unit_keluar'] = $detail;
    $this->load->view('barang/detail_unit_keluar', $data);
  }
  
    function detail_po_unit_keluar($id)
  {   
    $detail = $this->Report_model->detail_po_unit_keluar($id);
   // 
    //$detail = $this->Report_model->detail_unit_dipesan($model_id);*/
   
    $data['detail_po_unit_keluar'] = $detail;
    $this->load->view('barang/detail_po_unit_keluar', $data);
  }

  function detail_po_unit_masuk($id)
  {   
    $detail = $this->Report_model->detail_po_unit_masuk($id);
   // 
    //$detail = $this->Report_model->detail_unit_dipesan($model_id);*/
   
    $data['detail_po_unit_masuk'] = $detail;
    $this->load->view('barang/detail_po_unit_masuk', $data);
  }

   function detail_unit_stock($model_id)
  {
    $detail = $this->Report_model->detail_unit_stock($model_id);
    $unit_belum_masuk = $this->Report_model->detail_unit_stock_unit_belum_masuk($model_id);

    $data = array(            
            'dd_customer' => $this->order_model->dd_customer(),
            'customer_selected' => $this->input->post('nama_customer') ? $this->input->post('nama_customer') : '$row->customer_id', // untuk edit ganti '' menjadi data dari database misalnya $row->provinsi
          );
    $data['detail_unit_stock'] = $detail;
    $data['detail_unit_stock_unit_belum_masuk'] = $unit_belum_masuk;
    
    $this->load->view('barang/detail_unit_stock', $data);
  }
  
  function edit_stock()
  {
        $id=$this->input->post('id');
        $status_pemesanan=$this->input->post('status_pemesanan');
        $customer_id=$this->input->post('customer_id');
        $nomor_penawaran=$this->input->post('nomor_penawaran');
        $po_customer=$this->input->post('po_customer');
        $tanggal_po_customer = $this->input->post('tanggal_po_customer');
        //$updated_by = $this->input->post('updated_by');
        $this->Report_model->edit_stock($id, $status_pemesanan, $customer_id, $nomor_penawaran, $po_customer, $tanggal_po_customer);
        redirect('/report/rekap_unit_all/');
  }
  
  
  function edit_jatah()
  {
        $id=$this->input->post('id');
        $status_pemesanan=$this->input->post('status_pemesanan');
        $customer_id=$this->input->post('customer_id');
        $nomor_penawaran=$this->input->post('nomor_penawaran');
        $po_customer=$this->input->post('po_customer');
        $tanggal_po_customer = $this->input->post('tanggal_po_customer');
        //$updated_by = $this->input->post('updated_by');
        $this->Report_model->edit_jatah($id, $status_pemesanan, $customer_id, $nomor_penawaran, $po_customer, $tanggal_po_customer);
        redirect('/report/rekap_unit_all/');
  }

  //Selesai View Detail rekap//
  
   function hitung_sparepart_keluar()
    {

        $this->load->view('report/hitung_sp_keluar');
    }
  
   function data_hitung_sparepart_keluar()
    {
        $data = $this->Report_model->hitung_sparepart_keluar();
        echo json_encode($data);
    }
    
    function detail_sparepart_dipesan($kode_barang)
    {
        $detail = $this->Report_model->detail_sparepart_dipesan($kode_barang);
       
        $data['detail_sparepart_dipesan'] = $detail;
        $this->load->view('barang/detail_sparepart_dipesan', $data);
    }
    
    //hitung cepat perbandingan stock sistem dan fisik
    function quick_check_stock()
    {
        $data['cek_stock'] = $this->dashboard_model->quick_stock_sp();
        $this->load->view('dashboard/cek_stock', $data);
    }

     function data_check_stock()
    {
        $data = $this->dashboard_model->quick_stock_sp();
        echo json_encode($data);
    }

    //form imporrt barang masuk
    function form_import_cek_stock(){
        $data = array(); // Buat variabel $data sebagai array
        
        if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
          // lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
          $upload = $this->dashboard_model->upload_file_cek_stock($this->filename);
          
          if($upload['result'] == "success"){ // Jika proses upload sukses
            // Load plugin PHPExcel nya
            include APPPATH.'third_party/PHPExcel/PHPExcel.php';
            
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load('excel/upload/cek_stock/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
            $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
            
            // Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
            // Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
            $data['sheet'] = $sheet; 
          }else{ // Jika proses upload gagal
            $data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
          }
        }
        
        $this->load->view('dashboard/form_import_cek_stock', $data);
    }

     //import sparepart masuk
   public function import_cek_stok()
   {
    // Load plugin PHPExcel nya
    include APPPATH.'third_party/PHPExcel/PHPExcel.php';
    
    $excelreader = new PHPExcel_Reader_Excel2007();
    $loadexcel = $excelreader->load('excel/upload/cek_stock/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
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
            'jumlah' => $row['B'],
        ));
      }
      
      $numrow++; // Tambah 1 setiap kali looping
    }
    // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
   
    $this->dashboard_model->insert_multiple($data);
    
    redirect("report/quick_check_stock"); // Redirect ke halaman awal (ke controller siswa fungsi index)
  }

  function clear_data()
  {
    $this->dashboard_model->clear_table();
    $this->session->flashdata('Data fisik berhasil dihapus');
    redirect("report/quick_check_stock", 'refresh');
  }


  //Stock Unit//
  public function stock_unit()
  {
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
               $model = $_GET['model'];
                
                $ket = 'Data Rekap Unit ' .$model;
                $url_cetak = 'report/cetak_rekap_unit_all?filter=1&model='.$model;
                $report= $this->Report_model->view_by_model_rekap_unit($model); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else{ // Jika filter nya 5
                $nama_unit = $_GET['nama_unit'];
                
                
                $ket = 'Data Rekap Unit ' .$nama_unit;
                $url_cetak = 'report/cetak_rekap_unit_all?filter=2&nama_unit='.$nama_unit;
                $report = $this->Report_model->view_by_nama_unit_rekap_unit($nama_unit); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Rekap Unit';
            $url_cetak = 'report/cetak_rekap_unit_all';
            $report = $this->Report_model->view_all_stock_unit(); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
        $data['ket'] = $ket;
        $data['url_cetak'] = base_url('index.php/'.$url_cetak);
        $data['report'] = $report;
        $data['option_model_rekap_unit'] = $this->Report_model->option_model_rekap_unit();
        $data['option_nama_unit_rekap'] = $this->Report_model->option_nama_unit_rekap();
        $data['unit_ongoing'] = $this->Report_model->unit_ongoing();
        $data['unit_belum_dikirim'] = $this->Report_model->unit_belum_dikirim();
        $this->load->view('report/stock_unit', $data);
  }

  //Stock Unit//
  
}