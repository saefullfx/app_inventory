<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends CI_Model {

//rekap all Sparepart
  function view_by_partnumber_rekapall($kode_barang3)
  {
    $this->db->select('transaksi.kode_barang, nama_barang, barang.keterangan, SUM(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) - SUM(CASE WHEN status_id = 2 THEN jumlah ELSE 0 END) AS stock');
    $this->db->from('transaksi');
    $this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
          
    $this->db->where('transaksi.kode_barang', $kode_barang3); // Tambahkan where tanggal nya
    $this->db->group_by('transaksi.kode_barang');
        
    return $this->db->get()->result(); 
  }

  function view_by_jenis($jenis_id)
  {
    $this->db->select('transaksi.kode_barang, nama_barang, barang.keterangan, SUM(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) - SUM(CASE WHEN status_id = 2 THEN jumlah ELSE 0 END) AS stock');
    $this->db->from('transaksi');
    $this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
    $this->db->join('jenis', 'jenis.id = barang.jenis_id', 'Left');
       
    $this->db->where('jenis_id', $jenis_id); // Tambahkan where tanggal nya
    $this->db->group_by('transaksi.kode_barang');

    return $this->db->get()->result(); 
  }

  function view_all_rekap()
  {
    $sql_query=$this->db->query("CALL selectStockSp()");                     
        mysqli_next_result( $this->db->conn_id);
            if($sql_query->num_rows() > 0)
            {
                return $sql_query->result();
            }
  }

  function sparepart_ongoing()
  {
    $this->db->select('a.id, a.kode_barang, nama_barang, nama_supplier, jumlah, nomor_po, tanggal_order, nomor_surat_jalan, tanggal, nama, a.updated_at, a.updated_by, a.keterangan, b.keterangan AS part_persamaan');
    $this->db->from('transaksi a');
    $this->db->join('barang b', 'b.kode_barang = a.kode_barang', 'Left');
    $this->db->join('supplier c', 'c.id = a.supplier_id', 'Left');
    $this->db->join('admin d', 'd.nip = a.updated_by', 'Left');

    $this->db->where('status_id = 4'); 

        
    return $this->db->get()->result();
  }

  function sparepart_dipesan()
  {
    $sql_query=$this->db->query("CALL selectSpDipesan()");                     
        mysqli_next_result( $this->db->conn_id);
            if($sql_query->num_rows() > 0)
            {
                return $sql_query->result();
            }
  }

    public function option_kode_barang_rekap()
    {
        $this->db->select('kode_barang'); // Ambil Tahun dari field tanggal
        $this->db->from('transaksi'); // select ke tabel transaksi
        $this->db->where('status_id IN (1,2,3,5)');
        $this->db->group_by('kode_barang'); // Group berdasarkan tahun pada field tanggal       

        return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    }
    
    function option_jenis_barang_rekap_all()
    {
      $this->db->select('transaksi.kode_barang, nama_barang, jenis_id, nama_jenis');
      $this->db->from('transaksi');
      $this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
      $this->db->join('jenis', 'jenis.id = barang.jenis_id', 'Left');

      $this->db->where('transaksi.status_id IN (1,2,3,5)');  
      $this->db->group_by('barang.jenis_id');

     return $this->db->get()->result();
    }

//end rekap all


//barang keluar
public function view_by_partnumber($kode_barang)
  {
    $this->db->select('transaksi.id, transaksi.kode_barang, nama_barang, nama_customer, jumlah, nomor_po, nomor_surat_jalan, tanggal, transaksi.keterangan');
    $this->db->from('transaksi');
    $this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
    $this->db->join('customer', 'customer.id = transaksi.customer_id', 'Left');
    $this->db->where('status_id = 2');        
    $this->db->where('transaksi.kode_barang', $kode_barang); // Tambahkan where tanggal nya
        
    return $this->db->get()->result(); 
  }

  public function view_by_date($date)
  {
    $this->db->select('transaksi.id, transaksi.kode_barang, nama_barang, nama_customer, jumlah, nomor_po, nomor_surat_jalan, tanggal, transaksi.keterangan');
    $this->db->from('transaksi');
    $this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
    $this->db->join('customer', 'customer.id = transaksi.customer_id', 'Left');

    $this->db->where('status_id = 2');        
    $this->db->where('DATE(tanggal)', $date); // Tambahkan where tanggal nya
        
    return $this->db->get()->result(); 
  }
  
  public function view_by_partnumber_tanggal($kode_barang2, $date)
  {
    $this->db->select('transaksi.id, transaksi.kode_barang, nama_barang, nama_customer, jumlah, nomor_po, nomor_surat_jalan, tanggal, transaksi.keterangan');
    $this->db->from('transaksi');
    $this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
    $this->db->join('customer', 'customer.id = transaksi.customer_id', 'Left');

    $this->db->where('status_id = 2');        
    $this->db->where('transaksi.kode_barang', $kode_barang2); // Tambahkan where kode_barang nya
    $this->db->where('DATE(tanggal)', $date); // Tambahkan where tanggal nya
        
    return $this->db->get()->result(); 
  }
  
   public function view_by_partnumber_bulan($kode_barang3, $month, $year)
  {
    $this->db->select('transaksi.id, transaksi.kode_barang,  nama_barang, nama_customer, jumlah, nomor_po, nomor_surat_jalan, tanggal, transaksi.keterangan');
    $this->db->from('transaksi');
    $this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
    $this->db->join('customer', 'customer.id = transaksi.customer_id', 'Left');
    $this->db->where('status_id = 2'); 
    $this->db->where('transaksi.kode_barang', $kode_barang3); // Tambahkan where kode_barang nya
    $this->db->where('MONTH(tanggal)', $month); // Tambahkan where bulan
    $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun

    return $this->db->get()->result(); 
  }
    
  public function view_by_month($month, $year)
  {
    $this->db->select('transaksi.id, transaksi.kode_barang,  nama_barang, nama_customer, jumlah, nomor_po, nomor_surat_jalan, tanggal, transaksi.keterangan');
    $this->db->from('transaksi');
    $this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
    $this->db->join('customer', 'customer.id = transaksi.customer_id', 'Left');
    $this->db->where('status_id = 2'); 
    $this->db->where('MONTH(tanggal)', $month); // Tambahkan where bulan
    $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun

    return $this->db->get()->result(); 
  }
    
  public function view_by_year($year)
  {
    $this->db->select('transaksi.id, transaksi.kode_barang, nama_barang, nama_customer, jumlah, nomor_po, nomor_surat_jalan, tanggal, transaksi.keterangan');
    $this->db->from('transaksi');
    $this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
    $this->db->join('customer', 'customer.id = transaksi.customer_id', 'Left');
    $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
    $this->db->where('status_id = 2'); 
        
    return $this->db->get()->result(); 
  }
    
  public function view_all()
  {
    $this->db->select('transaksi.id, transaksi.kode_barang, nama_barang, nama_customer, jumlah, nomor_po, nomor_surat_jalan, tanggal, transaksi.keterangan');
    $this->db->from('transaksi');
    $this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
    $this->db->join('customer', 'customer.id = transaksi.customer_id', 'Left');
    
    $this->db->where('status_id = 2'); 
    return $query = $this->db->get()->result(); // Tampilkan semua data transaksi
  }
    
    public function option_tahun()
    {
        $this->db->select('YEAR(tanggal) AS tahun'); // Ambil Tahun dari field tanggal
        $this->db->from('transaksi'); // select ke tabel transaksi
        $this->db->order_by('YEAR(tanggal)'); // Urutkan berdasarkan tahun secara Ascending (ASC)
        $this->db->group_by('YEAR(tanggal)'); // Group berdasarkan tahun pada field tanggal
        
        return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    }
    
    public function option_kode_barang()
    {
        $this->db->select('kode_barang'); // Ambil Tahun dari field tanggal
        $this->db->from('transaksi'); // select ke tabel transaksi
        $this->db->where('status_id = 2');
        $this->db->order_by('kode_barang'); // Urutkan berdasarkan tahun secara Ascending (ASC)
        
        $this->db->group_by('kode_barang'); // Group berdasarkan tahun pada field tanggal              
        return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    }
//end barang keluar//


//barang masuk
 public function view_by_partnumber_masuk($kode_barang)
  {
    $this->db->select('transaksi.kode_barang, nama_barang, nama_supplier, jumlah, nomor_po, nomor_surat_jalan, tanggal, transaksi.keterangan');
$this->db->from('transaksi');
$this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
$this->db->join('supplier', 'supplier.id = transaksi.supplier_id', 'Left');
//$this->db->join('admin', 'admin.nip = transaksi.created_by', 'Left');
$this->db->where('status_id = 1');        
$this->db->where('transaksi.kode_barang', $kode_barang); // Tambahkan where tanggal nya
        
    return $this->db->get()->result(); 
  }

  public function view_by_partnumber_tanggal_masuk($kode_barang2, $date)
  {
    $this->db->select('transaksi.id, transaksi.kode_barang, nama_barang, nama_supplier, jumlah, nomor_po, nomor_surat_jalan, tanggal, transaksi.keterangan');
    $this->db->from('transaksi');
    $this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
    $this->db->join('supplier', 'supplier.id = transaksi.supplier_id', 'Left');

    $this->db->where('status_id = 1');        
    $this->db->where('transaksi.kode_barang', $kode_barang2); // Tambahkan where kode_barang nya
    $this->db->where('DATE(tanggal)', $date); // Tambahkan where tanggal nya
        
    return $this->db->get()->result(); 
  }

    public function view_by_date_masuk($date)
    {
    $this->db->select('transaksi.id, transaksi.kode_barang, nama_barang, nama_supplier, jumlah, nomor_po, nomor_surat_jalan, tanggal, transaksi.keterangan');
    $this->db->from('transaksi');
    $this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
    $this->db->join('supplier', 'supplier.id = transaksi.supplier_id', 'Left');

    $this->db->where('status_id = 1');        
    $this->db->where('DATE(tanggal)', $date); // Tambahkan where tanggal nya
        
    return $this->db->get()->result(); 
  }
    
  public function view_by_month_masuk($month, $year)
  {
    $this->db->select('transaksi.id, transaksi.kode_barang,  nama_barang, nama_supplier, jumlah, nomor_po, nomor_surat_jalan, tanggal, transaksi.keterangan');
    $this->db->from('transaksi');
    $this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
    $this->db->join('supplier', 'supplier.id = transaksi.supplier_id', 'Left');
    $this->db->where('status_id = 1'); 
    $this->db->where('MONTH(tanggal)', $month); // Tambahkan where bulan
    $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
        
    return $this->db->get()->result(); 
  }
    
  public function view_by_year_masuk($year)
  {
    $this->db->select('transaksi.id, transaksi.kode_barang,  nama_barang, nama_supplier, jumlah, nomor_po, nomor_surat_jalan, tanggal, transaksi.keterangan');
    $this->db->from('transaksi');
    $this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang');
    $this->db->join('supplier', 'supplier.id = transaksi.supplier_id');
    $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
    $this->db->where('status_id = 1'); 
        
    return $this->db->get()->result(); 
  }
    
  public function view_all_masuk()
  {
    $this->db->select('transaksi.id, transaksi.kode_barang, nama_barang, nama_supplier, jumlah, nomor_po, nomor_surat_jalan, tanggal, transaksi.keterangan');
    $this->db->from('transaksi');
    $this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
    $this->db->join('supplier', 'supplier.id = transaksi.supplier_id', 'Left');
    
    $this->db->where('status_id = 1'); 
    return $query = $this->db->get()->result(); // Tampilkan semua data transaksi
  }
    
    public function option_tahun_masuk()
    {
        $this->db->select('YEAR(tanggal) AS tahun'); // Ambil Tahun dari field tanggal
        $this->db->from('transaksi'); // select ke tabel transaksi
        $this->db->order_by('YEAR(tanggal)'); // Urutkan berdasarkan tahun secara Ascending (ASC)
        $this->db->group_by('YEAR(tanggal)'); // Group berdasarkan tahun pada field tanggal
        
        return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    }
    
    public function option_kode_barangmasuk()
    {
        $this->db->select('kode_barang'); // Ambil Tahun dari field tanggal
        $this->db->from('transaksi'); // select ke tabel transaksi
        $this->db->where('status_id = 1');
        $this->db->order_by('kode_barang'); // Urutkan berdasarkan tahun secara Ascending (ASC)
        $this->db->group_by('kode_barang'); // Group berdasarkan tahun pada field tanggal

        return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    }
//end barang masuk //
    
//report unit masuk //
    public function view_by_date_unit_masuk($date)
    {
    $this->db->select('nama_unit, model, voltase, pressure, serial_number, tanggal_order, nama_supplier, status_pemesanan, nama_customer, jumlah, nomor_po, tanggal, unit.keterangan');
$this->db->from('unit');

$this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
$this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');
$this->db->join('supplier', 'supplier.id = unit.supplier_id', 'Left');
$this->db->join('customer', 'customer.id = unit.customer_id', 'Left');

$this->db->where('status_id = 1');        
$this->db->where('DATE(tanggal)', $date); // Tambahkan where tanggal nya
        
    return $this->db->get()->result(); 
  }
    
  public function view_by_month_unit_masuk($month, $year)
  {
    $this->db->select('nama_unit, model, voltase, pressure, serial_number, tanggal_order, nama_supplier, status_pemesanan, nama_customer, jumlah, nomor_po, tanggal, unit.keterangan');
$this->db->from('unit');

$this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
$this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');
$this->db->join('supplier', 'supplier.id = unit.supplier_id', 'Left');
$this->db->join('customer', 'customer.id = unit.customer_id', 'Left');
$this->db->where('status_id = 1'); 
        $this->db->where('MONTH(tanggal)', $month); // Tambahkan where bulan
        $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun


        
    return $this->db->get()->result(); // Tampilkan data unit sesuai bulan dan tahun yang diinput oleh user pada filter
  }
    
  public function view_by_year_unit_masuk($year)
  {
    $this->db->select('nama_unit, model, voltase, pressure, serial_number, tanggal_order, nama_supplier, status_pemesanan, nama_customer, jumlah, nomor_po, tanggal, unit.keterangan');
$this->db->from('unit');

$this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
$this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');
$this->db->join('supplier', 'supplier.id = unit.supplier_id', 'Left');
$this->db->join('customer', 'customer.id = unit.customer_id', 'Left');
$this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
$this->db->where('status_id = 1'); 

$this->db->order_by('nama_unit', 'ASC');
        
    return $this->db->get()->result(); 
  }
    
  public function view_all_unit_masuk()
  {
    $this->db->select('nama_unit, model, voltase, pressure, serial_number, tanggal_order, nama_supplier, status_pemesanan, nama_customer, jumlah, nomor_po, tanggal, unit.keterangan');
$this->db->from('unit');

$this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
$this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');
$this->db->join('supplier', 'supplier.id = unit.supplier_id', 'Left');
$this->db->join('customer', 'customer.id = unit.customer_id', 'Left');
$this->db->where('status_id = 1'); 
$this->db->order_by('nama_unit', 'ASC');
return $query = $this->db->get()->result(); // Tampilkan semua data transaksi
  }

  public function view_model_unit_masuk($model)
  {
    $this->db->select('nama_unit, model, voltase, pressure, serial_number, tanggal_order, nama_supplier, status_pemesanan, nama_customer, jumlah, nomor_po, tanggal, unit.keterangan');
$this->db->from('unit');

$this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
$this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');
$this->db->join('supplier', 'supplier.id = unit.supplier_id', 'Left');
$this->db->join('customer', 'customer.id = unit.customer_id', 'Left');

    $this->db->where('status_id = 1'); 
    $this->db->where('model', $model); 
    return $query = $this->db->get()->result(); // Tampilkan semua data transaksi
  }

  public function view_nama_unit_masuk($nama_unit)
  {
   $this->db->select('nama_unit, model, voltase, pressure, serial_number, tanggal_order, nama_supplier, status_pemesanan, nama_customer, jumlah, nomor_po, tanggal, unit.keterangan');
$this->db->from('unit');

$this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
$this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');
$this->db->join('supplier', 'supplier.id = unit.supplier_id', 'Left');
$this->db->join('customer', 'customer.id = unit.customer_id', 'Left');

    $this->db->where('status_id = 1'); 
    $this->db->where('nama_unit', $nama_unit);
    
    $this->db->order_by('nama_unit', 'ASC'); 
    return $query = $this->db->get()->result(); // Tampilkan semua data transaksi
  }
    
    public function option_tahun_unit_masuk(){
        $this->db->select('YEAR(tanggal) AS tahun'); // Ambil Tahun dari field tanggal
        $this->db->from('unit'); // select ke tabel transaksi
        $this->db->where('status_id = 1');
         // Urutkan berdasarkan tahun secara Ascending (ASC)
        $this->db->group_by('YEAR(tanggal)'); // Group berdasarkan tahun pada field tanggal
        
        return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    }

    public function option_model_unit_masuk(){
        $this->db->select('id_model, model, model_id'); // Ambil Tahun dari field tanggal
        $this->db->from('unit'); // select ke tabel transaksi
        $this->db->join('model_unit', 'model_unit.id_model = unit.model_id', 'left');
        $this->db->where('status_id = 1');
         // Urutkan berdasarkan tahun secara Ascending (ASC)
        $this->db->group_by('model'); // Group berdasarkan tahun pada field tanggal
        
        return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    }

    public function option_nama_unit_masuk(){
        $this->db->select('unit.type_id, nama_unit'); // Ambil Tahun dari field tanggal
        $this->db->from('unit'); // select ke tabel transaksi
        $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
        $this->db->where('status_id = 1');
         // Urutkan berdasarkan tahun secara Ascending (ASC)
        $this->db->group_by('nama_unit'); // Group berdasarkan tahun pada field tanggal
        
        return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    }


//unit keluar
public function view_by_date_unit_keluar($date)
{
      $this->db->select('nama_unit, model, pressure, voltase, serial_number, nama_customer, tanggal_po_customer, jumlah, po_customer, nomor_surat_jalan, tanggal, unit.keterangan');
      $this->db->from('unit');
      $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
      $this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');
      $this->db->join('customer', 'customer.id = unit.customer_id');
      $this->db->where('status_id = 2');        
      $this->db->where('DATE(tanggal)', $date);        
      return $this->db->get()->result();
}
    
  public function view_by_month_unit_keluar($month, $year)
  {
    $this->db->select('nama_unit, model, pressure, voltase, serial_number, nama_customer, tanggal_po_customer, jumlah, po_customer, nomor_surat_jalan, tanggal, unit.keterangan');
    $this->db->from('unit');    
    $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
    $this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');
    $this->db->join('customer', 'customer.id = unit.customer_id');
    $this->db->where('status_id = 2'); 
        $this->db->where('MONTH(tanggal)', $month); // Tambahkan where bulan
        $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun        
    return $this->db->get()->result(); 
  }
    
  public function view_by_year_unit_keluar($year)
  {
    $this->db->select('nama_unit, model, pressure, voltase, serial_number, nama_customer, tanggal_po_customer, jumlah, po_customer, nomor_surat_jalan, tanggal, unit.keterangan');
    $this->db->from('unit');
    //$this->db->join('master_unit ', 'master_unit.model = unit.model', 'Left');
    $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
    $this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');
    $this->db->join('customer', 'customer.id = unit.customer_id', 'Left');
    $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
    $this->db->where('status_id = 2'); 
        
    return $this->db->get()->result(); 
  }

   public function view_model_unit_keluar($model)
  {
    $this->db->select('nama_unit, model, pressure, voltase, serial_number, nama_customer, tanggal_po_customer, jumlah, po_customer, nomor_surat_jalan, tanggal, unit.keterangan');
    $this->db->from('unit');
   // $this->db->join('master_unit ', 'master_unit.model = unit.model', 'Left');
    $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
    $this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');
    $this->db->join('customer', 'customer.id = unit.customer_id', 'Left');

    $this->db->where('status_id = 2'); 
    $this->db->where('model', $model); 
    return $query = $this->db->get()->result(); // Tampilkan semua data transaksi
  }

  public function view_nama_unit_keluar($nama_unit)
  {
      $this->db->select('nama_unit, model, pressure, voltase, serial_number, nama_customer, tanggal_po_customer, jumlah, po_customer, nomor_surat_jalan, tanggal, unit.keterangan');
      $this->db->from('unit');
      $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
      $this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');
      $this->db->join('customer', 'customer.id = unit.customer_id', 'Left');

      $this->db->where('status_id = 2'); 
      $this->db->where('nama_unit', $nama_unit); 
    return $query = $this->db->get()->result(); // Tampilkan semua data transaksi
  }
    
  public function view_all_unit_keluar()
  {
   $this->db->select('nama_unit, model, pressure, voltase, serial_number, nama_customer, tanggal_po_customer, jumlah, po_customer, nomor_surat_jalan, tanggal, unit.keterangan');
    $this->db->from('unit');
    $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
     $this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');
    $this->db->join('customer', 'customer.id = unit.customer_id', 'Left');

    $this->db->where('status_id = 2'); 
return $query = $this->db->get()->result(); // Tampilkan semua data transaksi
  }
    
    public function option_tahun_unit_keluar(){
        $this->db->select('YEAR(tanggal) AS tahun'); // Ambil Tahun dari field tanggal
        $this->db->from('unit'); // select ke tabel transaksi
        /*$this->db->order_by('YEAR(tanggal)'); // Urutkan berdasarkan tahun secara Ascending (ASC)*/
        $this->db->where('status_id = 2');
        $this->db->group_by('YEAR(tanggal)'); // Group berdasarkan tahun pada field tanggal
        
        return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    }

     public function option_model_unit_keluar(){
        $this->db->select('model_id, model'); // Ambil Tahun dari field tanggal
        $this->db->from('unit'); // select ke tabel transaksi
        $this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');
        $this->db->where('status_id = 2');
         // Urutkan berdasarkan tahun secara Ascending (ASC)
        $this->db->group_by('model'); // Group berdasarkan tahun pada field tanggal
        
        return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    }

    public function option_nama_unit_keluar(){
        $this->db->select('unit.type_id, nama_unit'); // Ambil Tahun dari field tanggal
        $this->db->from('unit'); // select ke tabel transaksi
       $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
        $this->db->where('status_id = 2');
         // Urutkan berdasarkan tahun secara Ascending (ASC)
        $this->db->group_by('nama_unit'); // Group berdasarkan tahun pada field tanggal
        
        return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    }

   
  //rekap all unit//
  function view_by_model_rekap_unit($model)
  {
     $this->db->select('nama_unit, model, model_id, sum(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) - sum(case WHEN status_id = 2 THEN jumlah ELSE 0 END) AS total');
    $this->db->from('unit');
    $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
    $this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');
    $this->db->where('unit.status_id IN (1,2)');         
    $this->db->where('model', $model); // Tambahkan where tanggal nya
    $this->db->group_by('model', 'serial_number');
        
    return $this->db->get()->result(); 
  }

  function view_by_nama_unit_rekap_unit($nama_unit)
  {
    $this->db->select('nama_unit, model, model_id, sum(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) - sum(case WHEN status_id = 2 THEN jumlah ELSE 0 END) AS total');
    $this->db->from('unit');
    $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
    $this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');
    $this->db->where('unit.status_id IN (1,2)');               
    $this->db->where('nama_unit', $nama_unit); // Tambahkan where tanggal nya
    $this->db->group_by('model', 'serial_number');

    return $this->db->get()->result(); 
  }

  function view_by_serial_number_unit_rekap_unit($serial_number)
  {
    $this->db->select('nnama_unit, model, model_id, sum(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) - sum(case WHEN status_id = 2 THEN jumlah ELSE 0 END) AS total');
    $this->db->from('unit');
    $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
    $this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');
    $this->db->where('unit.status_id IN (1,2)');               
    $this->db->where('serial_number', $serial_number); // Tambahkan where tanggal nya
    $this->db->group_by('model', 'serial_number');

    return $this->db->get()->result(); 
  }

  // function view_all_rekap_unit()
  // {
  //   $this->db->select('a.id, nama_unit, a.model_id, model,  a.jumlah - SUM(CASE WHEN b.status_id = 1 THEN b.jumlah ELSE 0 END) AS baru_masuk, a.progress, b.pemesanan_id');
  //   $this->db->from('unit a');
  //   $this->db->join('unit b', 'b.pemesanan_id = a.id', 'Left');
  //   $this->db->join('type_unit', 'type_unit.id = a.type_id', 'Left');
  //   $this->db->join('model_unit', 'model_unit.id_model = a.model_id', 'Left');
    
  //   $this->db->where('a.status_id = 4');
  //   $this->db->group_by('b.pemesanan_id');
  //   $this->db->group_by('model');
        
  //   return $this->db->get()->result();  
  // }

  /*function view_all_rekap_unit_unit_order()
  {
    $this->db->select('nama_unit, model, pressure, voltase, serial_number, sum(CASE WHEN status_id = 5 THEN jumlah ELSE 0 END) AS unit_order');
    $this->db->from('unit');
    
     $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
     $this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');
    
    $this->db->where('status_id = 5');   
    //$this->db->where('transaksi.kode_barang', $kode_barang); // Tambahkan where tanggal nya
    $this->db->group_by('pressure');
        
    return $this->db->get()->result();  
  }*/

 public function option_model_rekap_unit()
    {
         $this->db->select('model_id, model'); 
        $this->db->from('unit'); 
        $this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');
        $this->db->where('status_id IN (1,2)');
       
        $this->db->group_by('model');            
        return $this->db->get()->result(); // Ambil data pada tabel  sesuai kondisi diatas
    }

    function option_nama_unit_rekap()
    {
        $this->db->select('unit.type_id, nama_unit'); // Ambil Tahun dari field tanggal
        $this->db->from('unit'); // select ke tabel transaksi
        $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
        $this->db->where('status_id IN (1,2)');
        $this->db->group_by('nama_unit');
        return $this->db->get()->result();
    }

    function option_serial_number_unit_rekap()
    {
        $this->db->select('model_id, serial_number, model'); // Ambil Tahun dari field tanggal
        $this->db->from('unit'); // select ke tabel transaksi
        //$this->db->join('master_unit ', 'master_unit.model = unit.model', 'Left');
        $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
        $this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');
        $this->db->where('status_id IN (1,2)');

      $this->db->group_by('serial_number');

     return $this->db->get()->result();
    }

//end rekap all


    //rekap masuk//
 function rekap_unit_masuk()
{

      $this->db->select('unit.id,  nama_unit, sum(jumlah) AS unit_masuk, MONTHNAME(tanggal) AS bulan, YEAR(tanggal) AS tahun');
      $this->db->from('unit'); // select ke tabel transaksi
      //$this->db->join('master_unit ', 'master_unit.model = unit.model', 'Left');
      $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
      $this->db->where('status_id = 1'); 
      $this->db->group_by('type_id, bulan, tahun');
      return $query = $this->db->get()->result();
       $this->db->order_by('nama_unit', 'ASC');

//print_r($query);

 }

  public function view_by_model_rekap_unit_masuk($model)
  {
    $this->db->select('unit.id, model, nama_unit, serial_number, sum(jumlah) AS unit_masuk, MONTHNAME(tanggal) AS bulan, YEAR(tanggal) AS tahun');
     $this->db->from('unit'); // select ke tabel transaksi
      //$this->db->join('master_unit ', 'master_unit.model = unit.model', 'Left');
      $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
      $this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');
      $this->db->where('status_id = 1'); 
    $this->db->where('unit.model', $model); // Tambahkan where tanggal nya
    $this->db->group_by('model, bulan');
     $this->db->order_by('nama_unit', 'ASC');
        
    return $this->db->get()->result(); 
  }

  public function view_by_nama_rekap_unit_masuk($nama_unit)
  {
     $this->db->select('unit.type_id,  nama_unit,  sum(jumlah) AS unit_masuk, MONTHNAME(tanggal) AS bulan, YEAR(tanggal) AS tahun');
     $this->db->from('unit'); // select ke tabel transaksi
     // $this->db->join('master_unit ', 'master_unit.model = unit.model', 'Left');
$this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
    $this->db->where('status_id = 1');        
    $this->db->where('nama_unit', $nama_unit); // Tambahkan where tanggal nya
    $this->db->group_by('unit.type_id, bulan, tahun');
     $this->db->order_by('nama_unit', 'ASC');
        
    return $this->db->get()->result(); 
  }
    
  public function view_by_month_rekap_unit_masuk($month, $year)
  {
    $this->db->select('unit.type_id, nama_unit,  sum(jumlah) AS unit_masuk, MONTHNAME(tanggal) AS bulan, YEAR(tanggal) AS tahun');
     $this->db->from('unit'); // select ke tabel transaksi
      //$this->db->join('master_unit ', 'master_unit.model = unit.model', 'Left');
    $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
    $this->db->where('status_id = 1'); 
    $this->db->where('MONTH(tanggal)', $month); // Tambahkan where bulan
    $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
    $this->db->group_by('unit.type_id, bulan, tahun');
     $this->db->order_by('nama_unit', 'ASC');
        
    return $this->db->get()->result(); 
  }
    
  public function view_by_year_rekap_unit_masuk($year)
  {
    $this->db->select('unit.type_id, nama_unit,  sum(jumlah) AS unit_masuk, MONTHNAME(tanggal) AS bulan, YEAR(tanggal) AS tahun');
  $this->db->from('unit'); // select ke tabel transaksi
     // $this->db->join('master_unit ', 'master_unit.model = unit.model', 'Left');
    $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
    $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
    $this->db->where('status_id = 1'); 
    $this->db->group_by('unit.type_id, bulan, tahun');
     $this->db->order_by('nama_unit', 'ASC');
        
    return $this->db->get()->result(); 
  }
        
    public function option_tahun_rekap_unit_masuk()
    {
        $this->db->select('YEAR(tanggal) AS tahun'); // Ambil Tahun dari field tanggal
        $this->db->from('unit'); // select ke tabel transaksi
        $this->db->where('status_id = 1'); 
        $this->db->order_by('YEAR(tanggal)'); // Urutkan berdasarkan tahun secara Ascending (ASC)
        $this->db->group_by('YEAR(tanggal)'); // Group berdasarkan tahun pada field tanggal
        
        return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    }

    public function option_model_rekap_unit_masuk()
    {
        $this->db->select('model'); // Ambil Tahun dari field tanggal
        $this->db->from('unit'); // select ke tabel transaksi
        $this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');
        $this->db->where('status_id = 1');
        $this->db->order_by('model'); // Urutkan berdasarkan tahun secara Ascending (ASC)
        
         $this->db->group_by('model'); // Group berdasarkan tahun pada field tanggal
       
       
        
        return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    }


   function option_nama_rekap_unit_masuk()
    {
     $this->db->select('unit.type_id, nama_unit'); // Ambil Tahun dari field tanggal
        $this->db->from('unit'); // select ke tabel transaksi
        $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
        $this->db->where('status_id = 1');

      $this->db->group_by('nama_unit');

     return $this->db->get()->result();
    }
 //end rekap unit masuk//


    //rekap unit keluar//
 function rekap_unit_keluar()
{

      $this->db->select('nama_unit, sum(jumlah) AS unit_keluar, MONTHNAME(tanggal) AS bulan, YEAR(tanggal) AS tahun');
      $this->db->from('unit'); // select ke tabel transaksi
      //$this->db->join('master_unit ', 'master_unit.model = unit.model', 'Left');
      $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');

      $this->db->where('status_id = 2'); 
      $this->db->group_by('unit.type_id, bulan, tahun');
       $this->db->order_by('nama_unit', 'ASC');

      return $query = $this->db->get()->result();

//print_r($query);

 }

  /*public function view_by_model_rekap_unit_keluar($model)
  {
    $this->db->select('unit.type_id, unit.model, nama_unit, serial_number,  sum(jumlah) AS unit_keluar, MONTHNAME(tanggal) AS bulan, YEAR(tanggal) AS tahun');
     $this->db->from('unit'); // select ke tabel transaksi
     // $this->db->join('master_unit ', 'master_unit.model = unit.model', 'Left');
      $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');

      $this->db->where('status_id = 2'); 
    $this->db->where('unit.model', $model); // Tambahkan where tanggal nya
    $this->db->group_by('unit.model, bulan');
        
    return $this->db->get()->result(); 
  }*/

  public function view_by_nama_rekap_unit_keluar($nama_unit)
  {
     $this->db->select('unit.type_id, nama_unit, sum(jumlah) AS unit_keluar, MONTHNAME(tanggal) AS bulan, YEAR(tanggal) AS tahun');
     $this->db->from('unit'); // select ke tabel transaksi
     // $this->db->join('master_unit ', 'master_unit.model = unit.model', 'Left');
      $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');

    $this->db->where('status_id = 2');        
    $this->db->where('nama_unit', $nama_unit); // Tambahkan where tanggal nya
    $this->db->group_by('type_id, bulan, tahun');
     $this->db->order_by('nama_unit', 'ASC');
        
    return $this->db->get()->result(); 
  }
    
  public function view_by_month_rekap_unit_keluar($month, $year)
  {
    $this->db->select('unit.type_id, nama_unit, sum(jumlah) AS unit_keluar, MONTHNAME(tanggal) AS bulan, YEAR(tanggal) AS tahun');
    $this->db->from('unit'); // select ke tabel transaksi
    $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
    
    $this->db->where('status_id = 2'); 
    $this->db->where('MONTH(tanggal)', $month); // Tambahkan where bulan
    $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
    $this->db->group_by('unit.type_id, bulan, tahun');
    $this->db->order_by('nama_unit', 'ASC');
        
    return $this->db->get()->result(); 
  }
    
  public function view_by_year_rekap_unit_keluar($year)
  {
    $this->db->select('unit.id, model, nama_unit, serial_number, sum(jumlah) AS unit_keluar, MONTHNAME(tanggal) AS bulan, YEAR(tanggal) AS tahun');
  $this->db->from('unit'); // select ke tabel transaksi
    //  $this->db->join('master_unit ', 'master_unit.model = unit.model', 'Left');
      $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
    $this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');
    $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
    $this->db->where('status_id = 2'); 
    $this->db->group_by('unit.type_id, bulan, tahun');
    $this->db->order_by('nama_unit', 'ASC');
        
    return $this->db->get()->result(); 
  }
        
    public function option_tahun_rekap_unit_keluar()
    {
        $this->db->select('YEAR(tanggal) AS tahun'); // Ambil Tahun dari field tanggal
        $this->db->from('unit'); // select ke tabel transaksi
        $this->db->where('status_id = 2'); 
        $this->db->order_by('YEAR(tanggal)'); // Urutkan berdasarkan tahun secara Ascending (ASC)
        $this->db->group_by('YEAR(tanggal)'); // Group berdasarkan tahun pada field tanggal
        
        return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    }

    public function option_model_rekap_unit_keluar()
    {
        $this->db->select('model'); // Ambil Tahun dari field tanggal
        $this->db->from('unit'); // select ke tabel transaks
        $this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');
        $this->db->where('status_id = 2');
        $this->db->order_by('model'); // Urutkan berdasarkan tahun secara Ascending (ASC)
        
        $this->db->group_by('model'); // Group berdasarkan tahun pada field tanggal
        return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    }


   function option_nama_rekap_unit_keluar()
    {
     $this->db->select('unit.type_id, nama_unit'); // Ambil Tahun dari field tanggal
        $this->db->from('unit'); // select ke tabel transaksi
       $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
        $this->db->where('status_id = 2');

      $this->db->group_by('nama_unit');

     return $this->db->get()->result();
    }
 //end rekap masuk//
 
    //detail rekap unit//
function detail_unit_masuk($model_id)
{
  $this->db->select('model, nama_unit, pressure, voltase, serial_number, tanggal_order, nama_supplier, jumlah, nomor_po, tanggal, unit.keterangan');
  $this->db->from('unit');
  $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
  $this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');
  $this->db->join('supplier', 'supplier.id = unit.supplier_id', 'Left');

  $this->db->where('model_id', $model_id);
  $this->db->where('status_id = 1'); 
  $this->db->order_by('nama_unit', 'ASC');
  return $query = $this->db->get()->result(); 
}

function detail_unit_keluar($model_id)
{
  $this->db->select('model, nama_unit, pressure, voltase, serial_number, tanggal_po_customer, nama_supplier, nama_customer, jumlah, nomor_po, tanggal, unit.keterangan');
  $this->db->from('unit');
  $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
  $this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');
  $this->db->join('customer', 'customer.id = unit.customer_id', 'Left');
  $this->db->join('supplier', 'supplier.id = unit.supplier_id', 'Left');

  $this->db->where('model_id', $model_id);
  $this->db->where('status_id = 2'); 
  $this->db->order_by('nama_unit', 'ASC');
  return $query = $this->db->get()->result(); 
}

function detail_unit_stock($model_id)
{
    $this->db->select('unit.id, nama_unit, model, pressure, voltase, serial_number, status_pemesanan, nama_customer, nomor_penawaran, nomor_po, po_customer, tanggal_po_customer, sum(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) AS unit_masuk, sum(CASE WHEN status_id = 2 THEN jumlah ELSE 0 END) AS unit_keluar, sum(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) - sum(case WHEN status_id = 2 THEN jumlah ELSE 0 END) AS total');
    $this->db->from('unit');
    $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
    $this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');
    $this->db->join('customer ', 'customer.id = unit.customer_id', 'Left');

    $this->db->where('model_id', $model_id);

    $this->db->group_by('serial_number');
    return $query = $this->db->get()->result(); 
}


function detail_unit_stock_unit_belum_masuk($model_id)
{
    $this->db->select('a.id, nama_unit, model, a.pressure, a.voltase, a.jumlah, a.progress, nama_customer, c.nomor_penawaran, c.po_customer, c.tanggal_po_customer,  b.pemesanan_id, SUM(CASE WHEN b.status_id = 1 THEN b.jumlah ELSE 0 END) AS konfirmasi, a.tanggal_order, a.tanggal, a.status_pemesanan, a.nomor_po, nama_supplier, a.keterangan');
    
    $this->db->from('unit a');
    $this->db->join('unit b', 'b.pemesanan_id = a.id', 'Left');
    $this->db->join('unit c', 'a.po_masuk_id = c.id', 'Left');
    $this->db->join('type_unit', 'type_unit.id = a.type_id', 'Left');
    $this->db->join('model_unit', 'model_unit.id_model = a.model_id', 'Left');
    $this->db->join('supplier', 'supplier.id = a.supplier_id', 'Left');
    $this->db->join('customer', 'customer.id = c.customer_id', 'Left');
    
    $this->db->where('a.status_id = 4');
    //$this->db->where('a.progress != 2');
    $this->db->where('a.model_id', $model_id);
    $this->db->group_by('a.id', 'b.pemesanan_id');

    return $query = $this->db->get()->result();
}

function detail_unit_stock_unit_belum_dikirim($model_id)
{
    $this->db->select('a.id, nama_unit, model, a.pressure, a.voltase, a.jumlah, a.progress, nama_customer, a.po_customer, a.tanggal_po_customer,  b.po_masuk_id, SUM(CASE WHEN b.status_id = 2 THEN b.jumlah ELSE 0 END) AS konfirmasi, a.tanggal_po_customer, a.keterangan');
    $this->db->from('unit a');
    $this->db->join('unit b', 'b.po_masuk_id = a.id', 'Left');
    $this->db->join('type_unit', 'type_unit.id = a.type_id', 'Left');
    $this->db->join('model_unit', 'model_unit.id_model = a.model_id', 'Left');
    $this->db->join('customer', 'customer.id = a.customer_id', 'Left');
    
    $this->db->where('a.status_id = 5');
   // $this->db->where('a.progress != 2');
    $this->db->where('a.model_id', $model_id);
    $this->db->group_by('a.id', 'b.po_masuk_id');

    return $query = $this->db->get()->result();
}

function detail_po_unit_keluar($id)
{
    $this->db->select('a.id, a.model_id, nama_unit, model, a.pressure, a.voltase, a.jumlah, a.progress, b.pemesanan_id, SUM(CASE WHEN b.status_id = 1 THEN b.jumlah ELSE 0 END) AS konfirmasi, a.jumlah - SUM(CASE WHEN b.status_id = 1 THEN b.jumlah ELSE 0 END) AS sisa_masuk, a.tanggal_order, a.tanggal, a.status_pemesanan, a.nomor_po, nama_supplier, a.keterangan');
    $this->db->from('unit a');
    $this->db->join('unit b', 'b.pemesanan_id = a.id', 'Left');
    $this->db->join('type_unit', 'type_unit.id = a.type_id', 'Left');
    $this->db->join('model_unit', 'model_unit.id_model = a.model_id', 'Left');
    $this->db->join('supplier', 'supplier.id = a.supplier_id', 'Left');

    $this->db->where('a.id', $id);
    $this->db->where('a.status_id = 4');
    $this->db->where('a.progress = 1');
    $this->db->group_by('a.id', 'b.pemesanan_id');
    return $query = $this->db->get()->result(); 
}

function detail_po_unit_masuk($id)
{
  $this->db->select('a.id, nama_unit, model, b.po_masuk_id, a.pressure, a.voltase, a.progress, nama_customer, a.tanggal_po_customer, a.po_customer, a.jumlah, a.status_barang, a.keterangan, b.status_pemesanan');
  $this->db->from('unit a');
  $this->db->join('type_unit', 'type_unit.id = a.type_id', 'Left');
  $this->db->join('model_unit', 'model_unit.id_model = a.model_id', 'Left');
  $this->db->join('unit b', 'a.id = b.po_masuk_id', 'Left');
  $this->db->join('customer', 'customer.id = a.customer_id', 'Left');

  $this->db->where('a.id', $id);
  $this->db->where('a.status_id = 5');
  $this->db->group_by('a.id', 'b.po_masuk_id');
  return $query = $this->db->get()->result(); 
}

function detail_unit_dipesan($model_id)
{
  $this->db->select('model, nama_unit, pressure, voltase, serial_number, tanggal_order, nama_supplier, nama_customer, jumlah, nomor_po, tanggal, unit.keterangan');
  $this->db->from('unit');
  $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
  $this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');
  $this->db->join('customer', 'customer.id = unit.customer_id', 'Left');
  $this->db->join('supplier', 'supplier.id = unit.supplier_id', 'Left');

  $this->db->where('model_id', $model_id);
  $this->db->where('status_id = 3');
  $this->db->order_by('nama_unit', 'ASC');
  return $query = $this->db->get()->result(); 
}

function detail_unit_ready($model_id)
{
    $this->db->select('nama_unit, model, pressure, voltase, serial_number, sum(CASE WHEN status_id = 3 THEN jumlah ELSE 0 END) AS unit_dipesan, sum(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) - sum(case WHEN status_id = 2 THEN jumlah ELSE 0 END) - sum(CASE WHEN status_id = 3 THEN jumlah ELSE 0 END) AS stock_ready');
    $this->db->from('unit');
    
     $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
     $this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');
    
    $this->db->where('model_id', $model_id);
    $this->db->group_by('serial_number');
        
    return $this->db->get()->result();  
  }
  
  function edit_stock($id, $status_pemesanan, $customer_id, $nomor_penawaran, $po_customer, $tanggal_po_customer)
  {
        $hasil = $this->db->query("UPDATE unit SET status_pemesanan='$status_pemesanan', customer_id='$customer_id', nomor_penawaran='$nomor_penawaran', po_customer='$po_customer', tanggal_po_customer='$tanggal_po_customer' WHERE id='$id'");
        return $hasil;
  }
  
  function edit_jatah($id, $status_pemesanan, $customer_id, $nomor_penawaran, $po_customer, $tanggal_po_customer)
  {
        $hasil = $this->db->query("UPDATE unit SET status_pemesanan='$status_pemesanan', customer_id='$customer_id', nomor_penawaran='$nomor_penawaran', po_customer='$po_customer', tanggal_po_customer='$tanggal_po_customer' WHERE id='$id'");
        return $hasil;
  }
  
  function hitung_sparepart_keluar()
  {
    $this->db->select('transaksi.kode_barang, nama_barang, SUM(jumlah) AS jml_keluar, SUM(jumlah)/12 AS rata_rata, DATE_FORMAT(tanggal, "%Y-%m") AS the_month , DATE_FORMAT(tanggal, "%Y") AS the_year');
    $this->db->from('transaksi');    
    $this->db->join('barang ', 'barang.kode_barang = transaksi.kode_barang', 'Left');
    $this->db->where('status_id = 2'); 
    $this->db->group_by('transaksi.kode_barang', 'the_year');        
    return $this->db->get()->result();  
  }

  function detail_sparepart_dipesan($kode_barang)
{
    $this->db->select('a.id, a.kode_barang, nama_barang, a.jumlah, SUM(CASE WHEN b.status_id = 2 && b.pesan_id != "" THEN b.jumlah ELSE 0 END) AS jumlah_parsial, 
      a.jumlah - SUM(CASE WHEN b.status_id = 2 && b.pesan_id != "" THEN b.jumlah ELSE 0 END) AS SISA_KIRIM, b.pesan_id, a.tanggal_order, a.nomor_po, nama_customer, a.keterangan');
    $this->db->from('transaksi a');
    $this->db->join('barang', 'barang.kode_barang = a.kode_barang', 'Left');
    $this->db->join('customer', 'customer.id = a.customer_id', 'Left');
    $b = "OPEN";
    $this->db->join('transaksi b', 'b.pesan_id = a.id', 'Left');
    $this->db->where('a.kode_barang', $kode_barang);
    $this->db->where('a.status_id = 3');
    $this->db->where('a.status_pemesanan = 0');
    
    $this->db->group_by('a.id', 'b.pesan_id');
        
    return $this->db->get()->result();  
  }

//detail rekap unit//


//Stock Unit//
  function view_all_stock_unit()
  {
      $this->db->select('nama_unit, model, model_id, sum(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) - sum(case WHEN status_id = 2 THEN jumlah ELSE 0 END) AS total');
      $this->db->from('unit ');
      $this->db->join('type_unit', 'type_unit.id = type_id', 'Left');
      $this->db->join('model_unit', 'model_unit.id_model = model_id', 'Left');
      $this->db->where('status_id IN (1,2)');
      $this->db->group_by('model');
          
      return $this->db->get()->result();  
  }

  function unit_ongoing()
  {
    $this->db->select('a.id, nama_unit, a.model_id, model,  a.jumlah - SUM(CASE WHEN b.status_id = 1 THEN b.jumlah ELSE 0 END) AS baru_masuk, a.progress, b.pemesanan_id');
    $this->db->from('unit a');
    $this->db->join('unit b', 'b.pemesanan_id = a.id', 'Left');
    $this->db->join('type_unit', 'type_unit.id = a.type_id', 'Left');
    $this->db->join('model_unit', 'model_unit.id_model = a.model_id', 'Left');
    
    $this->db->where('a.status_id = 4');
    $this->db->group_by('a.id', 'b.pemesanan_id');
    $this->db->group_by('model');
        
    return $this->db->get()->result();  
  }

   function unit_belum_dikirim()
  {
    $this->db->select('a.id, nama_unit, a.model_id, model,  a.jumlah - SUM(CASE WHEN b.status_id = 2 THEN b.jumlah ELSE 0 END) AS baru_dikirim, a.progress, b.po_masuk_id');
    $this->db->from('unit a');
    $this->db->join('unit b', 'b.po_masuk_id = a.id', 'Left');
    $this->db->join('type_unit', 'type_unit.id = a.type_id', 'Left');
    $this->db->join('model_unit', 'model_unit.id_model = a.model_id', 'Left');
    
    $this->db->where('a.status_id = 5');
    $this->db->group_by('a.id', 'b.po_masuk_id');
    $this->db->group_by('model');
        
    return $this->db->get()->result();  
  }

//Stock Unit//
}