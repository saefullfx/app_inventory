<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	function jumlah_user()
  	{
	     $query = $this->db->get('user');
		   if($query->num_rows()>0)
		   {
		     return $query->num_rows();
		   }
		   else
		   {
		     return 0;
		   }
   	}

   	function jumlah_customer()
  	{
	     $query = $this->db->get('customer');
		   if($query->num_rows()>0)
		   {
		     return $query->num_rows();
		   }
		   else
		   {
		     return 0;
		   }
   	}

   	function master_stock_sparepart()
   	{
   		 $this->db->select('transaksi.kode_barang, nama_barang, barang.keterangan, SUM(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) AS barang_masuk, SUM(CASE WHEN status_id = 2 THEN jumlah ELSE 0 END) AS barang_keluar, SUM(CASE WHEN status_id = 3 && status_pemesanan != 1 THEN jumlah ELSE 0 END) AS po_sementara, (SUM(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) - SUM(CASE WHEN status_id = 2 THEN jumlah ELSE 0 END)) - SUM(CASE WHEN status_id = 3 && status_pemesanan != 1 THEN jumlah ELSE 0 END) AS ready_stock');
	    $this->db->from('transaksi');
	    $this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
	    $this->db->group_by('transaksi.kode_barang');
	        
	    return $this->db->get()->result();
   	}

	function hitungJenisBarang() 
	{
	  $this->db->select('nama_barang, jenis_id, SUM(jenis_id) AS jumlah_jenis, nama_jenis');
      $this->db->from('barang');
      $this->db->join('jenis', 'jenis.id = barang.jenis_id', 'Left');
      $this->db->group_by('jenis_id', 'asc');

      return $query = $this->db->get()->result();
	}

	function latestSparepartMasuk()
	{
		$this->db->select('transaksi.id, transaksi.kode_barang, nama_barang, nama_supplier, nomor_po, jumlah, tanggal');
		$this->db->from('transaksi');
		$this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
		$this->db->join('supplier', 'supplier.id = transaksi.supplier_id', 'Left');
		$this->db->where('status_id = 1'); 
		$this->db->order_by('nama_barang', 'desc');
		$this->db->limit(5);
		return $query = $this->db->get()->result();
	}

	function latestSparepartKeluar()
	{
		$this->db->select('transaksi.id, transaksi.kode_barang, nama_barang, nama_customer, nomor_po, jumlah, tanggal');
		$this->db->from('transaksi');
		$this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
		$this->db->join('customer', 'customer.id = transaksi.customer_id', 'Left');
		$this->db->where('status_id = 2'); 
		$this->db->order_by('nama_barang', 'desc');
		$this->db->limit(5);
		return $query = $this->db->get()->result();
	}

	function latestItemSparepart()
	{
		$this->db->select('barang.id, barang.kode_barang, nama_jenis,');
		$this->db->from('barang');
		$this->db->join('jenis', 'jenis.id = barang.jenis_id', 'Left');
		$this->db->order_by('nama_jenis', 'desc');
		$this->db->limit(5);
		return $query = $this->db->get()->result();
	}

	function master_stock_unit()
	{
			$this->db->select('nama_unit, model_id, model, sum(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) AS unit_masuk, sum(CASE WHEN status_id = 2 THEN jumlah ELSE 0 END) AS unit_keluar, sum(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) - sum(case WHEN status_id = 2 THEN jumlah ELSE 0 END) AS total');
	    	$this->db->from('unit');	    
	     	$this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
	     	$this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');	    
		    $this->db->group_by('model_id');		        
		    return $this->db->get()->result();  
	}

	function latestUnitMasuk()
	{
		$this->db->select('nama_unit, model_id, model, nama_supplier, nomor_po, jumlah, tanggal');
		$this->db->from('unit');
		$this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
	    $this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');	   
		$this->db->join('supplier', 'supplier.id = unit.supplier_id', 'Left');
		$this->db->where('status_id = 1'); 
		$this->db->order_by('nama_unit', 'desc');
		$this->db->limit(5);
		return $query = $this->db->get()->result();
	}

	function latestUnitKeluar()
	{
		$this->db->select('nama_unit, model_id, model, nama_customer, nomor_po, jumlah, tanggal');
		$this->db->from('unit');
		$this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
	    $this->db->join('model_unit ', 'model_unit.id_model = unit.model_id', 'Left');	   
		$this->db->join('customer', 'customer.id = unit.customer_id', 'Left');
		$this->db->where('status_id = 2'); 
		$this->db->order_by('nama_unit', 'desc');
		$this->db->limit(5);
		return $query = $this->db->get()->result();
	}

	function jumlah_sparepart_keluar_perbulan()
    {      
        $this->db->select('kode_barang, SUM(jumlah) AS jumlah, DATE_FORMAT(tanggal, "%Y-%m") AS the_month');
        $this->db->from('transaksi');
        $this->db->where('status_id = 2');
        $this->db->group_by('kode_barang, the_month');
        return $query = $this->db->get()->result();
    }

	 function jumlah_sparepart_masuk_perbulan()
    {      
        $this->db->select('kode_barang, SUM(jumlah) AS jumlah, DATE_FORMAT(tanggal, "%Y-%m") AS the_month');
        $this->db->select('count(*) as total_record');
        $this->db->from('transaksi');
        $this->db->where('status_id = 1');
        $this->db->group_by('kode_barang, the_month');
        return $query = $this->db->get()->result();
    }
    
    function quick_stock_sp()
    {
    	$this->db->select('t.kode_barang, IFNULL((SUM(CASE WHEN status_id = 1 THEN t.jumlah ELSE 0 END) - SUM(CASE WHEN status_id = 2 THEN t.jumlah ELSE 0 END)), "Data Belum Diinput") AS stock_digital, IFNULL(q.jumlah, "Data Belum Diinput") AS stock_fisik, IFNULL((SUM(CASE WHEN status_id = 1 THEN t.jumlah ELSE 0 END) - SUM(CASE WHEN status_id = 2 THEN t.jumlah ELSE 0 END)) - q.jumlah, "Data Belum Diinput") AS cek_selisih, IFNULL(q.created_at, "Data Belum Diinput") AS waktu');
    	$this->db->from('transaksi t');
    	$this->db->join('quick_stock q', 'q.kode_barang = t.kode_barang', 'Left');
    	$this->db->group_by('t.kode_barang');
    	return $query = $this->db->get()->result();
    }

    // Fungsi untuk melakukan proses upload file
   function upload_file_cek_stock($filename)
   {
	    $this->load->library('upload'); // Load librari upload
	    
	    $config['upload_path'] = './excel/upload/cek_stock/';
	    $config['allowed_types'] = 'xlsx';
	    $config['max_size']  = '2048';
	    $config['overwrite'] = true;
	    $config['file_name'] = $filename;
	  
	    $this->upload->initialize($config); // Load konfigurasi uploadnya
	    if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
	      // Jika berhasil :
	      $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
	      return $return;
	    }else{
	      // Jika gagal :
	      $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
	      return $return;
	    }
  	}

  	//insert data dari file import
    function insert_multiple($data)
  	{
    	$this->db->insert_batch('quick_stock', $data);
  	}

  	//clear data stock fisik
  	function clear_table()
  	{
  		$this->db->truncate('quick_stock');
  	}

}

/* End of file  */
/* Location: ./application/models/ */