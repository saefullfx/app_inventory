<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kartustock_model extends CI_Model
{
	function kartustock_masuk()
		{
			$this->db->select('nama_unit, unit.model, serial_number, nama_supplier, nomor_po, tanggal AS tanggal_masuk, jumlah AS jumlah_masuk');
			$this->db->from('unit');
			
			$this->db->join('type_unit', 'type_unit.id = unit.type_id', 'Left');
			$this->db->join('supplier', 'supplier.id = unit.supplier_id', 'Left');
			$this->db->where('status_id = 1');
			
			$this->db->order_by('unit.model');

			return $this->db->get()->result(); 
		}

		

		function kartustock_keluar()
		{
			$this->db->select('nama_unit, unit.model, serial_number, nama_customer, nomor_po, tanggal_order, jumlah AS jumlah_keluar, tanggal AS tanggal_keluar');
			$this->db->from('unit');
			
			$this->db->join('type_unit', 'type_unit.id = unit.type_id', 'Left');
			$this->db->join('customer', 'customer.id = unit.customer_id', 'Left');
			$this->db->where('status_id = 2');
			
			$this->db->order_by('unit.model');

			return $this->db->get()->result(); 
		}

		function kartustock_dipesan()
		{
			$this->db->select('unit.model, nama_unit, serial_number,  nama_customer, nomor_po, tanggal_order, jumlah AS jumlah_dipesan, tanggal AS tanggal_dipesan');
			$this->db->from('unit');
			
			$this->db->join('type_unit', 'type_unit.id = unit.type_id', 'Left');
			$this->db->join('customer', 'customer.id = unit.customer_id', 'Left');
			$this->db->where('status_id = 3');
			
			$this->db->order_by('unit.model');

			return $this->db->get()->result(); 
		}

		function kartustock_order_stock()
		{
			$this->db->select('unit.model, nama_unit, serial_number,  nama_supplier, nomor_po, tanggal_order, jumlah AS jumlah_order_stock, tanggal AS tanggal_brg_order');
			$this->db->from('unit');
			
			$this->db->join('type_unit', 'type_unit.id = unit.type_id', 'Left');
			$this->db->join('supplier', 'supplier.id = unit.supplier_id', 'Left');
			$this->db->where('status_id = 5');
			
			$this->db->order_by('unit.model');

			return $this->db->get()->result(); 
		}

		function view_by_model_kartustock($model)
  		{
    		$this->db->select('unit.model, nama_unit, serial_number,  nama_supplier, nomor_po, tanggal AS tanggal_masuk, jumlah AS jumlah_masuk');
   			$this->db->from('unit');
			
			$this->db->join('type_unit', 'type_unit.id = unit.type_id', 'Left');
			$this->db->join('supplier', 'supplier.id = unit.supplier_id', 'Left');
			$this->db->where('status_id = 1');
			$this->db->where('unit.model', $model);

			$this->db->order_by('unit.model');
        
    		return $this->db->get()->result(); 
  		}

  		function view_by_serial_number_kartustock($serial_number)
  		{
    		$this->db->select('unit.model, nama_unit, serial_number, nama_supplier, nomor_po, tanggal AS tanggal_masuk, jumlah AS jumlah_masuk');
   			$this->db->from('unit');
			
			$this->db->join('type_unit', 'type_unit.id = unit.type_id', 'Left');
			$this->db->join('supplier', 'supplier.id = unit.supplier_id', 'Left');
			$this->db->where('status_id = 1');
			$this->db->where('serial_number', $serial_number);

			$this->db->order_by('unit.model');
        
    		return $this->db->get()->result(); 
  		}


  		public function option_model_kartustock()
    {
         $this->db->select('model'); 
        $this->db->from('unit'); 
        $this->db->where('status_id IN (1,2)');
       
        $this->db->group_by('model');            
        return $this->db->get()->result(); // Ambil data pada tabel  sesuai kondisi diatas
    }

    
    function option_serial_number_kartustock()
    {
     $this->db->select('unit.model, serial_number'); // Ambil Tahun dari field tanggal
        $this->db->from('unit'); // select ke tabel transaksi
        
        $this->db->where('status_id IN (1,2)');

      $this->db->group_by('serial_number');

     return $this->db->get()->result();
    }

		function kartustock()
		{
			$this->db->select('unit.model, nama_unit, serial_number, nama_supplier, tanggal AS tanggal_masuk, jumlah AS jumlah_masuk, nama_customer, tanggal_order, jumlah AS jumlah_keluar, tanggal AS tanggal_keluar');
			$this->db->from('unit');
			
			$this->db->join('type_unit', 'type_unit.id = unit.type_id', 'Left');
			$this->db->join('customer', 'customer.id = unit.customer_id', 'Left');
			$this->db->join('supplier', 'supplier.id = unit.supplier_id', 'Left');

			$this->db->where('status_id IN (1,2)');
			$this->db->order_by('unit.model');

			return $this->db->get()->result(); 
		}

	function mutasi_masuk()
	{
		$this->db->select('COALESCE(nama_unit, "TOTAL UNIT MASUK") AS nama_unit, COALESCE(year(tanggal), "SUB TOTAL") AS tahun,  COALESCE(MONTHNAME(tanggal), "SUB TOTAL") AS bulan, sum(jumlah) AS unit_masuk');
		$this->db->from('unit');

		$this->db->join('type_unit', 'type_unit.id = unit.type_id', 'Left');
		$this->db->where('status_id = 1');
		$this->db->group_by('type_id, tahun, bulan', 'WITH ROLLUP');

		return $this->db->get()->result(); 

	}

	function mutasi_keluar()
	{
		$this->db->select('nama_unit, SUM(jumlah) jumlah_keluar, MONTHNAME(tanggal) AS bulan, YEAR(tanggal) AS tahun');
		$this->db->from('unit');

		$this->db->join('type_unit', 'type_unit.id = unit.type_id', 'Left');
		$this->db->where('status_id = 2');
		$this->db->group_by('type_id, bulan, tahun');

		return $this->db->get()->result(); 

	}

	function mutasi_masuk_total()
	{
		$this->db->select_sum('jumlah', 'jumlah2');
		$this->db->from('unit');
		$this->db->where('status_id = 1');
		//$this->db->group_by('tahun');

		return $this->db->get('')->row();

	}

	function hitung_unit_by_tahun()
	{
		$this->db->select('type_id, SUM(jumlah) AS STOK_AKHIR, YEAR(tanggal) AS tahun');
		$this->db->from('unit');
		$this->db->where('status_id = 1');
		$this->db->group_by('type_id, tahun');

		return $this->db->get('')->row(); 
	}


	function view_by_model($model)
  {
    $this->db->select('unit.id, unit.model, nama_unit, serial_number,  sum(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) AS unit_masuk, sum(CASE WHEN status_id = 2 THEN jumlah ELSE 0 END) AS unit_keluar, sum(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) - sum(case WHEN status_id = 2 THEN jumlah ELSE 0 END) AS total, sum(CASE WHEN status_id = 3 THEN jumlah ELSE 0 END) AS unit_dipesan, sum(CASE WHEN status_id = 5 THEN jumlah ELSE 0 END) AS unit_order,');
    $this->db->from('unit');
    //$this->db->join('master_unit', 'master_unit.model = unit.model', 'Left');
    $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
    
    $this->db->where('unit.status_id IN (1,2,3,5)');         
    $this->db->where('unit.model', $model); // Tambahkan where tanggal nya
    $this->db->group_by('unit.model');
        
    return $this->db->get()->result(); 
  }

  function view_by_type_unit($type_unit)
  {
    $this->db->select('unit.id, unit.model, nama_unit, serial_number,  sum(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) AS unit_masuk, sum(CASE WHEN status_id = 2 THEN jumlah ELSE 0 END) AS unit_keluar, sum(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) - sum(case WHEN status_id = 2 THEN jumlah ELSE 0 END) AS total, sum(CASE WHEN status_id = 3 THEN jumlah ELSE 0 END) AS unit_dipesan, sum(CASE WHEN status_id = 5 THEN jumlah ELSE 0 END) AS unit_order,');
    $this->db->from('unit');
   // $this->db->join('master_unit', 'master_unit.model = unit.model', 'Left');
    $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
    
    $this->db->where('unit.status_id IN (1,2,3,5)');               
    $this->db->where('nama_unit', $type_unit); // Tambahkan where tanggal nya
    $this->db->group_by('unit.model');

    return $this->db->get()->result(); 
  }

  function view_by_serial_number($serial_number)
  {
    $this->db->select('unit.id, unit.model, nama_unit, serial_number, sum(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) AS unit_masuk, sum(CASE WHEN status_id = 2 THEN jumlah ELSE 0 END) AS unit_keluar, sum(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) - sum(case WHEN status_id = 2 THEN jumlah ELSE 0 END) AS total, sum(CASE WHEN status_id = 3 THEN jumlah ELSE 0 END) AS unit_dipesan, sum(CASE WHEN status_id = 5 THEN jumlah ELSE 0 END) AS unit_order,');
    $this->db->from('unit');
   // $this->db->join('master_unit', 'master_unit.model = unit.model', 'Left');
     $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
    
    $this->db->where('unit.status_id IN (1,2,3,5)');               
    $this->db->where('serial_number', $serial_number); // Tambahkan where tanggal nya
    $this->db->group_by('unit.model');

    return $this->db->get()->result(); 
  }


 public function option_model()
    {
         $this->db->select('model'); 
        $this->db->from('unit'); 
        $this->db->where('status_id IN (1,2,3,5)');
       
        $this->db->group_by('model');            
        return $this->db->get()->result(); // Ambil data pada tabel  sesuai kondisi diatas
    }

    function option_type_unit()
    {
     $this->db->select('unit.type_id, nama_unit'); // Ambil Tahun dari field tanggal
        $this->db->from('unit'); // select ke tabel transaksi
         $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
        $this->db->where('status_id IN (1,2,3,5)');

      $this->db->group_by('nama_unit');

     return $this->db->get()->result();
    }

    function option_serial_number()
    {
     $this->db->select('unit.model, serial_number'); // Ambil Tahun dari field tanggal
        $this->db->from('unit'); // select ke tabel transaksi
        //$this->db->join('master_unit ', 'master_unit.model = unit.model', 'Left');
         $this->db->join('type_unit ', 'type_unit.id = unit.type_id', 'Left');
        $this->db->where('status_id IN (1,2,3,5)');

      $this->db->group_by('serial_number');

     return $this->db->get()->result();
    }

//end rekap all

		
}