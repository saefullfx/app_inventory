<?php
	class Order_model extends CI_Model
{

  private $_table = "transaksi";

  public $id;
  public $status_id = 4;
  public $kode_barang;  
  public $supplier_id;
  public $jumlah;
  public $tanggal_order;
  public $nomor_po;
  public $tanggal;
  public $keterangan;
  public $created_by;
  public $created_at;

 	/*function order_list()
	{
		$this->db->select('pemesanan_barang.id, pemesanan_barang.kode_barang, nama_barang, pemesanan_barang.jumlah, SUM(konfirmasi_barang.jumlah) AS jumlah_parsial, pemesanan_barang.jumlah - SUM(konfirmasi_barang.jumlah) AS SISA_KIRIM, tanggal_order, tanggal_sampai, nomor_po, nama_supplier, pemesanan_barang.keterangan');
		$this->db->from('pemesanan_barang');
		$this->db->join('barang', 'barang.kode_barang = pemesanan_barang.kode_barang', 'Left');
		$this->db->join('supplier', 'supplier.id = pemesanan_barang.supplier_id', 'Left');
		
        $this->db->join('konfirmasi_barang', 'konfirmasi_barang.pemesananbrg_id = pemesanan_barang.id', 'Left');
        $this->db->group_by('pemesanan_barang.id', 'konfirmasi_barang.pemesananbrg_id');
		
		return $query = $this->db->get()->result();

    $this->db->select('a.id, a.kode_barang, nama_barang, a.jumlah, SUM(CASE WHEN status_id = 1 THEN b.jumlah ELSE 0 END) AS jumlah_parsial, a.jumlah - SUM(CASE WHEN status_id = 1 THEN b.jumlah ELSE 0 END) AS SISA_KIRIM,  b.pemesanan_id, a.tanggal_order, a.tanggal_sampai, a.nomor_po, nama_supplier, a.keterangan');
    $this->db->from('pemesanan_barang a');
    $this->db->join('barang', 'barang.kode_barang = a.kode_barang', 'Left');
  $this->db->join('supplier', 'supplier.id = a.supplier_id', 'Left');
    $this->db->join('transaksi b', 'b.pemesanan_id = a.id', 'Left');
    
    $this->db->group_by('a.id', 'b.pemesanan_id');
    
    return $query = $this->db->get()->result();
	}*/
	
	function order_list()
  {
    $this->db->select('a.id, a.kode_barang, nama_barang, a.jumlah, a.tanggal_order, a.tanggal as tanggal_sampai, a.nomor_po, nama_supplier, a.keterangan');
    $this->db->from('transaksi a');
    $this->db->join('barang b', 'b.kode_barang = a.kode_barang', 'Left');
	  $this->db->join('supplier s', 's.id = a.supplier_id', 'Left');
    $this->db->where('a.status_id = 4');
    
    return $query = $this->db->get()->result();
  }


  function konfirmasi_pemesanan_sparepart()
  {
    $this->db->select('konfirmasi_barang.id, konfirmasi_barang.kode_barang, nama_barang, jumlah, tanggal, konfirmasi_barang.keterangan, nama');
    $this->db->from('konfirmasi_barang');
    $this->db->join('barang', 'barang.kode_barang = konfirmasi_barang.kode_barang', 'Left');
    $this->db->join('admin', 'admin.nip = konfirmasi_barang.created_by', 'Left');
    /*$this->db->where('status_id = 5');*/
    
    return $query = $this->db->get()->result();
  }

 //dari pemesanan unit // po ke supplier atau keluar //
   function order_unit_list()
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
    $this->db->group_by('a.id', 'b.pemesanan_id');

    return $query = $this->db->get()->result();
    
    /*sql = "SELECT a.id, c.nama_unit, d.model, a.pressure, a.voltase, a.jumlah, b.unit_masuk, a.nomor_po, a.tanggal_order, e.nama_supplier, a.tanggal, a.keterangan FROM `pemesanan_unit` a LEFT JOIN (SELECT pemesanan_id, SUM(jumlah) as unit_masuk FROM konfirmasi_unit GROUP BY pemesanan_id) b on a.id= b.pemesanan_id Left JOIN type_unit c ON c.id = a.type_id Left JOIN model_unit d ON d.id_model = a.model_id Left JOIN supplier e ON e.id = a.supplier_id";
    $query  = $this->db->query($sql);
    $result = $query->result();
    print_r($result);*/


    //return $query = $this->db->get()->result();

  }

    function konfirmasi_pemesanan_unit()
  {
    $this->db->select('konfirmasi_unit.id, nama_unit, model, jumlah, tanggal, konfirmasi_unit.keterangan, nama');
    $this->db->from('konfirmasi_unit');
    $this->db->join('type_unit', 'type_unit.id = konfirmasi_unit.type_id', 'Left');
     $this->db->join('model_unit', 'model_unit.id_model = konfirmasi_unit.model_id', 'Left');
    $this->db->join('admin', 'admin.nip = konfirmasi_unit.created_by', 'Left');
    /*$this->db->where('status_id = 5');*/
    
    return $query = $this->db->get()->result();
  }


    function save_order($kode_barang, $jumlah, $supplier_id, $status_id, $tanggal_order, $nomor_po, $tanggal, $keterangan, $created_by, $created_at)
  	{
    $data = array(     
      'kode_barang' => $kode_barang,
      'jumlah' => $jumlah,      
      'supplier_id' => $supplier_id,
      'status_id' => $status_id,
      'tanggal_order' => $tanggal_order,
      'nomor_po' => $nomor_po,            
      'tanggal' => $tanggal, 
      'keterangan' => $keterangan,   
      'created_by' => $this->session->userdata('ses_id'),
      'created_at' =>  date('Y-m-d H:i:s'),
    );
      $this->db->insert('transaksi', $data);
   }
   
    //unit masuk dari pemesanan unit//
function simpan_sparepart_masuk($kode_barang, $pemesanan_id, $status_id, $supplier_id, $tanggal_order, $jumlah, $nomor_po, $tanggal, $keterangan, $created_by, $created_at)
{
    $data = array(    
      'kode_barang' => $kode_barang,
      'pemesanan_id' => $pemesanan_id,
      'status_id' => $status_id,
      'supplier_id' => $supplier_id,
      'tanggal_order' => $tanggal_order,
      'jumlah' => $jumlah,
      'nomor_po' => $nomor_po,
      'tanggal' => $tanggal,
      'keterangan' => $keterangan,
      'created_by' => $this->session->userdata('ses_id'),
      'created_at' =>  date('Y-m-d H:i:s'),
    );
      $this->db->insert('transaksi',$data);
}
   
   function get_order_sparepart_masuk($id)
   {
    $hsl=$this->db->query("SELECT * FROM pemesanan_barang WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'id' => $data->id,
                    'kode_barang' => $data->kode_barang,
                    'jumlah' => $data->jumlah,
                    'supplier_id' => $data->supplier_id,
                    'tanggal_order' => $data->tanggal_order,
                    'nomor_po' => $data->nomor_po,
                    );
            }
        }
        return $hasil;

}

  function save_konfirmasi_order($kode_barang, $pemesananbrg_id, $jumlah, $tanggal, $keterangan, $created_by, $created_at)
  {
    $data = array(     
      'kode_barang' => $kode_barang,
      'pemesananbrg_id' => $pemesananbrg_id,
      'jumlah' => $jumlah,       
      'tanggal' => $tanggal, 
      'keterangan' => $keterangan,   
      'created_by' => $this->session->userdata('ses_id'),
      'created_at' =>  date('Y-m-d H:i:s'),
    );
      $this->db->insert('konfirmasi_barang', $data);
  }

   function delete_order($id)
  {
    $hasil=$this->db->query("DELETE FROM transaksi WHERE id='$id'");
        return $hasil;
  }

   function delete_konfirmasi_order($id)
  {
    $hasil=$this->db->query("DELETE FROM konfirmasi_barang WHERE id='$id'");
        return $hasil;
  }

  function delete_indent($id)
  {
    $hasil=$this->db->query("DELETE FROM indent WHERE id='$id'");
        return $hasil;
  }

  //order sparepart
   function get_order_by_id($id)
  {
    $hsl = $this->db->query("SELECT * FROM transaksi WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
              'id' => $data->id,
              'kode_barang' => $data->kode_barang,
              'jumlah' => $data->jumlah,      
              'supplier_id' => $data->supplier_id,
              /*'status_id' => $data->status_id,*/

              'tanggal_order' => $data->tanggal_order,
              'nomor_po' => $data->nomor_po,            
              'tanggal' => $data->tanggal, 
              'keterangan' => $data->keterangan,   
              );
            }
        }
        return $hasil;
  }

  function get_konfirmasi_order_by_id($id)
  {
    $hsl = $this->db->query("SELECT * FROM konfirmasi_barang WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
              'id' => $data->id,
              'pemesananbrg_id' => $data->pemesananbrg_id,
              'kode_barang' => $data->kode_barang,
              'jumlah' => $data->jumlah,      
              'tanggal' => $data->tanggal, 
              'keterangan' => $data->keterangan,   
                    );
            }
        }
        return $hasil;
  }

 

  function update_order($id, $kode_barang, $jumlah, $supplier_id, $tanggal_order, $nomor_po,  $tanggal, $keterangan, $updated_by)
  {
    $data = array(
      'id' => $id,
      'kode_barang' => $kode_barang,
      'jumlah' => $jumlah, 
      
      'supplier_id' => $supplier_id,
      'tanggal_order' => $tanggal_order,
      'nomor_po' => $nomor_po,
      'tanggal' => $tanggal, 
      'keterangan' => $keterangan,   
      'updated_by' => $this->session->userdata('ses_id'),
      //'updated_at' =>  'NOW()',
    );
    $this->db->where('id', $id);
    $this->db->update('transaksi', $data);
	}

  function update_konfirmasi_order($id, $kode_barang, $jumlah, $tanggal, $keterangan, $updated_by)
  {
    $data = array(
      'id' => $id,
      'kode_barang' => $kode_barang,
      'jumlah' => $jumlah,      
      'tanggal' => $tanggal, 
      'keterangan' => $keterangan,   
      'updated_by' => $this->session->userdata('ses_id'),
      //'updated_at' =>  'NOW()',
    );
    $this->db->where('id', $id);
    $this->db->update('konfirmasi_barang', $data);
  }

  function update_indent($id, $kode_barang, $jumlah, $order_by, $customer_id, $no_order, $tanggal_pesan, $tanggal_sampai, $keterangan, $status, $updated_by)
  {
    $data = array(
      'id' => $id,
      'kode_barang' => $kode_barang,
      'jumlah' => $jumlah,
      'order_by' => $order_by,
      'customer_id' => $customer_id,
      'no_order' => $no_order,
      'tanggal_pesan' => $tanggal_pesan,      
      'tanggal_sampai' => $tanggal_sampai,
      'keterangan' => $keterangan,    
      'status' => $status,
      'updated_by' => $this->session->userdata('ses_id'),
      //'updated_at' =>  'NOW()',
    );
    $this->db->where('id', $id);
    $this->db->update('indent', $data);
  }

  //order UNIT//

  function save_order_unit($type_id, $model_id, $status_id, $pressure, $voltase, $supplier_id, $jumlah, $tanggal_order, $nomor_po, $tanggal, $keterangan, $created_by, $created_at)
{
    $data = array(
      'type_id' => $type_id,
      'model_id' => $model_id,
      'status_id' => $status_id,
      'pressure' => $pressure,
      'voltase' => $voltase,
      'supplier_id' => $supplier_id,
      'jumlah' => $jumlah,
      'tanggal_order' => $tanggal_order,
      'nomor_po' => $nomor_po,
      'tanggal' => $tanggal,
      //'status_pemesanan' => $status_pemesanan,
     // 'customer_id' => $customer_id,
     // 'nomor_penawaran' => $nomor_penawaran,
     // 'po_customer' => $po_customer,
     // 'tanggal_po_customer' => $tanggal_po_customer,
      'keterangan' => $keterangan,
      'created_by' => $this->session->userdata('ses_id'),
      'created_at' =>  date('Y-m-d H:i:s'),
     // 'updated_by' => $this->session->userdata('ses_id'),
    );
      $this->db->insert('unit',$data);
}
  
  //unit masuk dari pemesanan unit//
function simpan_unit_masuk($type_id, $model_id, $pemesanan_id, $pressure, $voltase, $serial_number, $status_id, $supplier_id, $tanggal_order, $jumlah, $nomor_po, $tanggal, $keterangan, $created_by, $created_at)
{
    $data = array(    
      'type_id' => $type_id,
      'model_id' => $model_id,
      'pemesanan_id' => $pemesanan_id,
      'pressure' => $pressure,
      'voltase' => $voltase,
      'serial_number' => $serial_number,
      'status_id' => $status_id,
      'supplier_id' => $supplier_id,
      // 'status_pemesanan' => $status_pemesanan,
      // 'customer_id' => $customer_id,
      // 'nomor_penawaran' => $nomor_penawaran,
      // 'po_customer' => $po_customer,
      // 'tanggal_po_customer' => $tanggal_po_customer,
      'tanggal_order' => $tanggal_order,
      'jumlah' => $jumlah,
      'nomor_po' => $nomor_po,
      'tanggal' => $tanggal,
      'keterangan' => $keterangan,
      'created_by' => $this->session->userdata('ses_id'),
      'created_at' =>  date('Y-m-d H:i:s'),
     // 'updated_by' => $this->session->userdata('ses_id'),
    );
      $this->db->insert('unit',$data);
}

function save_konfirmasi_order_unit($type_id, $model_id, $jumlah, $tanggal, $keterangan, $created_by, $created_at)
  {
    $data = array(     
      'type_id' => $type_id,
      'model_id' => $model_id,
      'jumlah' => $jumlah,       
      'tanggal' => $tanggal, 
      'keterangan' => $keterangan,   
      'created_by' => $this->session->userdata('ses_id'),
      'created_at' =>  date('Y-m-d H:i:s'),
    );
      $this->db->insert('konfirmasi_unit', $data);
  }


function get_order_unit_by_id($id)
{

  $hsl=$this->db->query("SELECT * FROM unit WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'id' => $data->id,
                    'type_id' => $data->type_id,
                    'model_id' => $data->model_id,
                    'status_id' => $data->status_id,
                    'pressure' => $data->pressure,
                    'voltase' => $data->voltase,
                    'progress' => $data->progress,
                    'supplier_id' => $data->supplier_id,
                    'jumlah' => $data->jumlah,
                    'tanggal_order' => $data->tanggal_order,
                    'nomor_po' => $data->nomor_po,
                    'tanggal' => $data->tanggal,
                    'status_pemesanan' => $data->status_pemesanan,
                    'customer_id' => $data->customer_id,
                    'nomor_penawaran' => $data->nomor_penawaran,
                    'po_customer' => $data->po_customer,
                    'tanggal_po_customer' => $data->tanggal_po_customer,
                    'keterangan' => $data->keterangan,
                    
                    );
            }
        }
        return $hasil;

}

function get_order_unit_masuk($id)
{

  $hsl=$this->db->query("SELECT * FROM unit WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'id' => $data->id,
                    'type_id' => $data->type_id,
                    'model_id' => $data->model_id,
                    'pressure' => $data->pressure,
                    'voltase' => $data->voltase,
                    'jumlah' => $data->jumlah,
                    'supplier_id' => $data->supplier_id,
                    'tanggal_order' => $data->tanggal_order,
                    'nomor_po' => $data->nomor_po,
                    'status_pemesanan' => $data->status_pemesanan,
                    'customer_id' => $data->customer_id,
                    'nomor_penawaran' => $data->nomor_penawaran,
                    'po_customer' => $data->po_customer,
                    'tanggal_po_customer' => $data->tanggal_po_customer,
                    
                    );
            }
        }
        return $hasil;

}

  function update_order_unit($id, $type_id, $model_id, $status_id, $pressure, $voltase, $jumlah, $tanggal_order, $nomor_po, $supplier_id, $tanggal, $status_pemesanan, $customer_id, $nomor_penawaran, $po_customer, $tanggal_po_customer, $keterangan, $updated_by)
  {
    $data = array(
      'id' => $id,
      'type_id' => $type_id,
      'model_id' => $model_id,
      'status_id' => $status_id,
      'pressure' => $pressure,
      'voltase' => $voltase,
      'jumlah' => $jumlah,
      'tanggal_order' => $tanggal_order,
      'nomor_po' => $nomor_po,
      'supplier_id' => $supplier_id,
      'tanggal' => $tanggal,
      'status_pemesanan' => $status_pemesanan,
      'customer_id' => $customer_id,
      'nomor_penawaran' => $nomor_penawaran,
      'po_customer' => $po_customer,
      'tanggal_po_customer' => $tanggal_po_customer,
      'keterangan' => $keterangan,
      'updated_by' => $this->session->userdata('ses_id'),
      //'updated_at' =>  'NOW()',
    );
    $this->db->where('id', $id);
    $this->db->update('unit', $data);
  }

  //Update progress PO ke Supplier
  function update_progress_order_unit($id, $progress)
  {
    $data = array(
      'id' => $id,
      'progress' => $progress,
    );
    $this->db->where('id', $id);
    $this->db->update('unit', $data);
  }


  function update_konfirmasi_order_unit($id, $type_id, $model_id, $jumlah, $tanggal, $keterangan, $updated_by)
  {
    $data = array(
      'id' => $id,
      'type_id' => $type_id,
      'model_id' => $model_id,
      'jumlah' => $jumlah,
      'tanggal' => $tanggal,
      'keterangan' => $keterangan,
      'updated_by' => $this->session->userdata('ses_id'),
      //'updated_at' =>  'NOW()',
    );
    $this->db->where('id', $id);
    $this->db->update('konfirmasi_unit', $data);
  }

   function update_order_unit_add_unit_masuk($id, $type_id, $model, $serial_number, $status_id, $supplier_id, $jumlah, $tanggal_order, $nomor_po, $nomor_surat_jalan, $tanggal, $keterangan, $created_by)
  {
    $data = array(
      'id' => $id,
      'type_id' => $type_id,
      'model' => $model,
      'serial_number' => $serial_number,
      'status_id' => $status_id,
      'supplier_id' => $supplier_id,
      'jumlah' => $jumlah,
      'tanggal_order' => $tanggal_order,
      'nomor_po' => $nomor_po,
      'nomor_surat_jalan' => $nomor_surat_jalan,
      'tanggal' => $tanggal,
      'keterangan' => $keterangan,
      'created_by' => $this->session->userdata('ses_id'),
      //'updated_at' =>  'NOW()',
    );
    $this->db->where('id', $id);
    $this->db->update('unit', $data);
  }
  
  function update_order_unit_status($id, $status_id, $updated_by)
  {
    $data = array(
      'id' => $id,      
      'status_id' => $status_id,
      'updated_by' => $this->session->userdata('ses_id'),
      //'updated_at' =>  'NOW()',
    );
    $this->db->where('id', $id);
    $this->db->update('unit', $data);
  }

  function delete_order_unit($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('unit');
  }

  function delete_konfirmasi_order_unit($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('konfirmasi_unit');
  }

//get dropdown unit
  function dd_unit()
    {
        // ambil data dari db
        $this->db->order_by('model', 'asc');
       
        $result = $this->db->get('master_unit');
        
        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $dd_unit[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $dd_unit[$row->model] = $row->model;
            }
        }
        return $dd_unit;
    }

    //get dd_kon_barang
  function dd_kon_barang()
    {
        // ambil data dari db
        $this->db->order_by('kode_barang', 'asc');
        $this->db->where('transaksi.status_id = 5');
        $result = $this->db->get('transaksi');
        
        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $dd_kon_barang[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $dd_kon_barang[$row->kode_barang] = $row->kode_barang;
            }
        }
        return $dd_kon_barang;
    }

    //get dropdown customer
  function dd_customer()
    {
        // ambil data dari db
        $this->db->order_by('nama_customer', 'asc');
        $result = $this->db->get('customer');
        
        // bikin array $this->db->where('id', $id);
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $dd[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $dd[$row->id] = $row->nama_customer;
            }
        }
        return $dd;
    }


  //get dropdown supplier
  function dd_supplier()
    {
        // ambil data dari db
        $this->db->order_by('nama_supplier', 'asc');
        $result = $this->db->get('supplier');
        
        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $dd[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $dd[$row->id] = $row->nama_supplier;
            }
        }
        return $dd;
    }

     //get dropdown type unit
  function dd_type_unit()
    {
        // ambil data dari db
        $this->db->order_by('nama_unit', 'asc');
        $result = $this->db->get('type_unit');
        
        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $dd[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $dd[$row->id] = $row->nama_unit;
            }
        }
        return $dd;
    }

    ///get dropdown model unit
  function dd_model_unit()
    {
        // ambil data dari db
        $this->db->order_by('model', 'asc');
        $result = $this->db->get('model_unit');
        
        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $dd[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $dd[$row->id_model] = $row->model;
            }
        }
        return $dd;
    }

   
    //chain dropdown konfirmasi order unit
     public function get_type_unit_order()
        {
            $this->db->select('type_id, nama_unit');
            $this->db->join('type_unit', 'type_unit.id = pemesanan_unit.type_id', 'Left');
            $this->db->order_by('nama_unit', 'asc');
            return $this->db->get('pemesanan_unit')->result();
        }

        public function get_model_unit_order()
        {
            // kita joinkan tabel kota dengan provinsi
            $this->db->select('pemesanan_unit.type_id, nama_unit, model_id, model');
          
            $this->db->join('model_unit', 'model_unit.id_model = pemesanan_unit.model_id', 'Left');
              $this->db->join('type_unit', 'type_unit.id = model_unit.type_id', 'Left');
            $this->db->order_by('model', 'asc');
            return $this->db->get('pemesanan_unit')->result();
        }

        public function get_serial_number()
        {
            // kita joinkan tabel kota dengan provinsi
            $this->db->order_by('serial_number', 'asc');
            $this->db->join('model_unit', 'model_unit.model = master_unit.model', 'Left');
            return $this->db->get('master_unit')->result();
        }


}