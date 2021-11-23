<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Unit_model extends CI_Model{

//type unit

   function data_type_unit()
  {
    $this->db->select('id, nama_unit, nama, created_at, updated_at, created_by');
    $this->db->from('type_unit');
    $this->db->join('admin', 'admin.nip = type_unit.created_by', 'Left');

    //$this->db->where('transaksi.status_id IN (1,2)'); 
    //$this->db->group_by('transaksi.kode_barang');
    return $query = $this->db->get()->result();

  /*$hasil=$this->db->query("SELECT id, nama, model, serial_number, pressure, created_by, created_at, updated_by, updated_at
FROM `master_unit` ");
        return $hasil->result();*/
  }


  function simpan_type_unit($nama_unit, $created_by, $created_at)
  {
    $data = array(
      'nama_unit' => $nama_unit,
      'created_by' => $this->session->userdata('ses_id'),
      'created_at' =>  date('Y-m-d H:i:s'),
    );
      $this->db->insert('type_unit',$data);
  }

  function get_type_unit_by_id($id)
  {
    $hsl=$this->db->query("SELECT * FROM type_unit WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'id' => $data->id,
                    'nama_unit' => $data->nama_unit,
                    
                    
                    );
            }
        }
        return $hasil;
  }

  function update_type_unit($id, $nama_unit, $updated_by)
  {
    $data = array(
      'id' => $id,
      'nama_unit' => $nama_unit,
      'updated_by' => $this->session->userdata('ses_id'),
      //'updated_at' =>  'NOW()',
    );
    $this->db->where('id', $id);
    $this->db->update('type_unit', $data);
  }

  function delete_type_unit($id)
  {
    $hasil=$this->db->query("DELETE FROM type_unit WHERE id='$id'");
        return $hasil;
  }
//end type unit


// model unit
   function data_model_unit()
  {
    $this->db->select('id_model, model, nama_unit, nama, model_unit.created_at, model_unit.updated_at, model_unit.created_by');
    $this->db->from('model_unit');
    $this->db->join('type_unit', 'type_unit.id = model_unit.type_id', 'Left');
    $this->db->join('admin', 'admin.nip = model_unit.created_by', 'Left');

    return $query = $this->db->get()->result(); 
  }


  function simpan_model_unit($model, $type_id, $created_by, $created_at)
  {
    $data = array(
      'model' => $model,
      'type_id' => $type_id,
      'created_by' => $this->session->userdata('ses_id'),
      'created_at' =>  date('Y-m-d H:i:s'),
    );
      $this->db->insert('model_unit',$data);
  }

  function get_model_unit_by_id($id_model)
  {
    $hsl=$this->db->query("SELECT * FROM model_unit WHERE id_model='$id_model'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil = array(
                    'id_model' => $data->id_model,
                    'model' => $data->model,
                    'type_id' => $data->type_id,                    
                    );
            }
        }
        return $hasil;
  }

  function update_model_unit($id_model, $model, $type_id, $updated_by)
  {
    $data = array(
      'id_model' => $id_model,
      'model' => $model,
      'type_id' => $type_id,
      'updated_by' => $this->session->userdata('ses_id'),
      //'updated_at' =>  'NOW()',
    );
    $this->db->where('id_model', $id_model);
    $this->db->update('model_unit', $data);
  }

  function delete_model_unit($id_model)
  {
    $hasil=$this->db->query("DELETE FROM model_unit WHERE id_model='$id_model'");
        return $hasil;
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
        $unit_selected[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $unit_selected[$row->id] = $row->nama_unit;
            }
        }
        return $unit_selected;
    }

//end model unit



// master unit
  function data_master_unit()
  {
    $this->db->select('master_unit.id, nama_unit, master_unit.model, serial_number, pressure, nama, master_unit.created_at');
    $this->db->from('master_unit');
    $this->db->join('type_unit', 'type_unit.id = master_unit.type_id', 'LEFT');
    $this->db->join('admin', 'admin.nip = master_unit.created_by', 'LEFT');

    //$this->db->where('transaksi.status_id IN (1,2)'); 
    //$this->db->group_by('transaksi.kode_barang');
return $query = $this->db->get()->result();

  /*$hasil=$this->db->query("SELECT id, nama, model, serial_number, pressure, created_by, created_at, updated_by, updated_at
FROM `master_unit` ");
        return $hasil->result();*/
  }

  //chain dropdown
        public function get_type_unit()
        {
            $this->db->order_by('nama_unit', 'asc');
            return $this->db->get('type_unit')->result();
        }

        public function get_model()
        {

            $this->db->select('id_model, model, type_id, type_unit.id');
            $this->db->from('model_unit');
           
            $this->db->join('type_unit', 'type_unit.id = model_unit.type_id', 'Left');
            $this->db->order_by('model', 'asc');
            return $query = $this->db->get()->result();
            /*return $this->db->get('model_unit')->result();*/
        }
        
         public function get_model_keluar()
        {

            $this->db->select('unit.type_id, nama_unit, id_model, model, sum(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) - sum(case WHEN status_id = 2 THEN jumlah ELSE 0 END) AS stock');
            $this->db->from('unit');
           
            $this->db->join('type_unit', 'type_unit.id = unit.type_id', 'Left');
            $this->db->join('model_unit', 'model_unit.id_model = unit.model_id');
            $this->db->group_by('model', 'asc');
            return $query = $this->db->get()->result();
            /*return $this->db->get('model_unit')->result();*/
        }

         function get_serial_number_keluar()
        {
          $this->db->select('model_id, serial_number, sum(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) - sum(case WHEN status_id = 2 THEN jumlah ELSE 0 END) AS stock');
          $this->db->from('unit');
          $this->db->join('model_unit', 'model_unit.id_model = unit.model_id');
         // $this->db->where('status_id = 1');
          $this->db->group_by('serial_number');

           return $query = $this->db->get()->result();
        }

      public function get_pressure()
        {
            $this->db->select('id_model, model_id, pressure');
            $this->db->from('unit');
            $this->db->join('model_unit', 'model_unit.id_model = unit.model_id');
            $this->db->group_by('model_id', 'asc');
           
            return $query = $this->db->get()->result();
        }
        
        function get_pressure_keluar()
        {
            // ambil data dari db
            $this->db->select('pressure');
            $this->db->where('status_id = 1');
            $this->db->group_by('pressure');
            $result = $this->db->get('unit');
            
            // bikin array $this->db->where('id', $id);
            // please select berikut ini merupakan tambahan saja agar saat pertama
            // diload akan ditampilkan text please select.
            $dd[''] = 'Please Select';
            if ($result->num_rows() > 0) {
                foreach ($result->result() as $row) {
                // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                    $dd[$row->pressure] = $row->pressure;
                }
            }
        return $dd;
        }
        

         public function get_voltase()
        {
            $this->db->select('id_model, model_id, voltase');
            $this->db->from('unit');
            $this->db->join('model_unit', 'model_unit.id_model = unit.model_id');
            $this->db->group_by('model_id', 'asc');
           
            return $query = $this->db->get()->result();
        }
        
        function get_voltase_keluar()
        {
            
            $this->db->select('voltase');
            $this->db->where('status_id = 1');
            $this->db->group_by('voltase');
            $result = $this->db->get('unit');
            
            $dd[''] = 'Please Select';
            if ($result->num_rows() > 0) {
                foreach ($result->result() as $row) {
                // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                    $dd[$row->voltase] = $row->voltase;
                }
            }
        return $dd;
        }

         public function get_type_unit_keluar()
        {
            $this->db->select('type_id, nama_unit, sum(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) - sum(case WHEN status_id = 2 THEN jumlah ELSE 0 END) AS stock');
            $this->db->from('unit');
           
            $this->db->join('type_unit', 'type_unit.id = unit.type_id', 'Left');
            $this->db->group_by('nama_unit', 'asc');
            return $query = $this->db->get()->result();
        }
        
        // untuk edit ambil dari id level paling bawah
        public function get_selected_by_id_model($id_model)
        {
            $this->db->where('id', $id_model);
            $this->db->join('type_unit', 'type_unit.id = model_unit.type_id');
            
            return $this->db->get('model_unit')->row();
        }

  function simpan_unit($type_id, $model, $serial_number, $pressure, $created_by, $created_at)
  {
    $data = array(
      'type_id' => $type_id,
      'model' => $model,
      'serial_number' => $serial_number,
      'pressure' => $pressure,
      'created_by' => $this->session->userdata('ses_id'),
      'created_at' =>  date('Y-m-d H:i:s'),
    );
      $this->db->insert('master_unit',$data);
  }

  function get_unit_by_id($id)
  {
    $hsl=$this->db->query("SELECT * FROM master_unit WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'id' => $data->id,
                    'type_id' => $data->type_id,
                    'model' => $data->model,
                    'serial_number' => $data->serial_number,
                    'pressure' => $data->pressure,
                    
                    );
            }
        }
        return $hasil;
  }

  function update_unit($id, $type_id, $model, $serial_number, $pressure, $updated_by)
  {
    $data = array(
      'id' => $id,
      'type_id' => $type_id,
      'model' => $model,
      'serial_number' => $serial_number,
      'pressure' => $pressure,      
      'updated_by' => $this->session->userdata('ses_id'),
      //'updated_at' =>  'NOW()',
    );
    $this->db->where('id', $id);
    $this->db->update('master_unit', $data);
  }

  function delete_unit($id)
  {
    $hasil=$this->db->query("DELETE FROM master_unit WHERE id='$id'");
        return $hasil;
  }

//end master unit//



//stock unit
function data_unit_list()
{

$this->db->select('nama_unit, model, serial_number, pressure, voltase, sum(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) AS unit_masuk, sum(CASE WHEN status_id = 2 THEN jumlah ELSE 0 END) AS unit_keluar, sum(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) - sum(case WHEN status_id = 2 THEN jumlah ELSE 0 END) AS jumlah, sum(CASE WHEN status_id = 3 THEN jumlah ELSE 0 END) AS unit_dipesan, sum(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) - sum(case WHEN status_id = 2 THEN jumlah ELSE 0 END) - sum(case WHEN status_id = 3 THEN jumlah ELSE 0 END) AS stock_ready ');
$this->db->from('unit');
$this->db->join('type_unit', 'type_unit.id = unit.type_id', 'Left');
$this->db->join('model_unit', 'model_unit.id_model = unit.model_id', 'Left');
$this->db->where('unit.status_id IN (1,2,3)'); 
$this->db->group_by('serial_number');
return $query = $this->db->get()->result();

//print_r($query);

 }



// unit masuk
function unit_masuk_list()
{
    $this->db->select('unit.id, nama_unit, model, voltase, pressure, serial_number, tanggal_order, nama_supplier, status_pemesanan, nama_customer, jumlah, nomor_penawaran, po_customer, nomor_po, tanggal, tanggal_po_customer, unit.keterangan');
    $this->db->from('unit');
    $this->db->join('type_unit', 'type_unit.id = unit.type_id', 'Left');
    $this->db->join('model_unit', 'model_unit.id_model = unit.model_id', 'Left');
    $this->db->join('supplier', 'supplier.id = unit.supplier_id', 'Left');
    $this->db->join('customer', 'customer.id = unit.customer_id', 'Left');
    $this->db->where('unit.status_id = 1'); 
    $this->db->order_by("serial_number", "asc");
    return $query = $this->db->get()->result();
}

function save_unit_masuk($type_id, $model_id, $pressure, $voltase, $serial_number, $status_id, $supplier_id, $tanggal_order, $jumlah, $nomor_po, $tanggal, $status_pemesanan, $customer_id, $nomor_penawaran, $po_customer, $tanggal_po_customer, $keterangan, $created_by, $created_at)
{
    $data = array(    
      'type_id' => $type_id,
      'model_id' => $model_id,
      'pressure' => $pressure,
      'voltase' => $voltase,
      'serial_number' => $serial_number,
      'status_id' => $status_id,
      'supplier_id' => $supplier_id,
      'tanggal_order' => $tanggal_order,
      'jumlah' => $jumlah,
      'nomor_po' => $nomor_po,
      'tanggal' => $tanggal,
      'status_pemesanan' => $status_pemesanan,
      'customer_id' => $customer_id,
      'nomor_penawaran' => $nomor_penawaran,
      'po_customer' => $po_customer,
      'tanggal_po_customer' => $tanggal_po_customer,
      'keterangan' => $keterangan,
      'created_by' => $this->session->userdata('ses_id'),
      'created_at' =>  date('Y-m-d H:i:s'),
     // 'updated_by' => $this->session->userdata('ses_id'),
    );
      $this->db->insert('unit',$data);
}


function get_unit_masuk_id($id)
{

  $hsl=$this->db->query("SELECT * FROM unit WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                   'id' => $data->id,
                    'type_id' => $data->type_id,
                    'model_id' => $data->model_id,
                    'pemesanan_id' => $data->pemesanan_id,
                    'pressure' => $data->pressure,
                    'voltase' => $data->voltase,
                    'serial_number' => $data->serial_number,
                    'status_id' => $data->status_id,
                    'supplier_id' => $data->supplier_id,
                    'tanggal_order' => $data->tanggal_order,
                    'jumlah' => $data->jumlah,
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

/*function get_unit_masuk_by_id($id_model)
{
            $this->db->where('id', $id_model);
            $this->db->join('type_unit', 'type_unit.id = model_unit.type_id');
            $this->db->join('unit', 'unit.id_ = provinsi.id_provinsi');
            return $this->db->get('kecamatan')->row();
}
*/
function update_unit_masuk($id, $pemesanan_id, $type_id, $model_id, $pressure, $voltase, $serial_number, $status_id, $supplier_id, $tanggal_order, $jumlah, $nomor_po, $tanggal, $status_pemesanan, $customer_id, $nomor_penawaran, $po_customer, $tanggal_po_customer, $keterangan, $updated_by)
  {
    $data = array(
      'id' => $id,
      'pemesanan_id' => $pemesanan_id,
      'type_id' => $type_id,
      'model_id' => $model_id,
      'pemesanan_id' => $pemesanan_id,
      'pressure' => $pressure,
      'voltase' => $voltase,
      'serial_number' => $serial_number,
      'status_id' => $status_id,
      'supplier_id' => $supplier_id,
      'tanggal_order' => $tanggal_order,
      'jumlah' => $jumlah,
      'nomor_po' => $nomor_po,
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

  function delete_unit_masuk($id)
  {
      $this->db->where('id', $id);
      $this->db->delete('unit');
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
        $unit_selected[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $unit_selected[$row->model] = $row->model;
            }
        }
        return $unit_selected;
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

 // unit keluar
function unit_keluar_list()
{
  $this->db->select('unit.id, nama_unit, model, serial_number, pressure, voltase, nama_customer, tanggal_po_customer, jumlah, nomor_po, nomor_surat_jalan, tanggal, unit.keterangan');
  $this->db->from('unit');
  $this->db->join('type_unit', 'type_unit.id = unit.type_id', 'Left');
  $this->db->join('model_unit', 'model_unit.id_model = unit.model_id', 'Left');
  $this->db->join('customer', 'customer.id = unit.customer_id', 'Left');
  $this->db->where('unit.status_id = 2'); 
  return $query = $this->db->get()->result();
}

function save_unit_keluar($type_id, $model_id, $serial_number, $pressure, $voltase, $status_id, $customer_id, $tanggal_po_customer, $jumlah, $nomor_po, $nomor_surat_jalan, $tanggal, $keterangan, $created_by, $created_at)
{
    $data = array(      
      'type_id' => $type_id,
      'model_id' => $model_id,
      'serial_number' => $serial_number,
      'pressure' => $pressure,
      'voltase' => $voltase,
      'status_id' => $status_id,  
      'customer_id' => $customer_id,
      'tanggal_po_customer' => $tanggal_po_customer,    
      'jumlah' => $jumlah, 
      'nomor_po' => $nomor_po,
      'nomor_surat_jalan' => $nomor_surat_jalan,
      'tanggal' => $tanggal,
      'keterangan' => $keterangan,
      'created_by' => $this->session->userdata('ses_id'),
      'created_at' =>  date('Y-m-d H:i:s'),
     // 'updated_by' => $this->session->userdata('ses_id'),
    );
      $this->db->insert('unit',$data);
}


//simpan unit keluar dari po masuk
function simpan_unit_keluar($po_masuk_id, $type_id, $model_id, $serial_number, $pressure, $voltase, $jumlah, $status_id, $customer_id, $po_customer, $tanggal_po_customer, $nomor_surat_jalan, $tanggal, $keterangan, $created_by, $created_at)
{
    $data = array(      
      'po_masuk_id' => $po_masuk_id,
      'type_id' => $type_id,
      'model_id' => $model_id,
      'serial_number' => $serial_number,
      'pressure' => $pressure,
      'voltase' => $voltase,
      'jumlah' => $jumlah, 
      'status_id' => $status_id,  
      'customer_id' => $customer_id,
      'po_customer' => $po_customer,
      'tanggal_po_customer' => $tanggal_po_customer,         
      'nomor_surat_jalan' => $nomor_surat_jalan,
      'tanggal' => $tanggal,
      'keterangan' => $keterangan,
      'created_by' => $this->session->userdata('ses_id'),
      'created_at' =>  date('Y-m-d H:i:s'),
     // 'updated_by' => $this->session->userdata('ses_id'),
    );
      $this->db->insert('unit',$data);
}

function get_unit_keluar_id($id)
{
  $hsl=$this->db->query("SELECT * FROM unit WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'id' => $data->id,
                    'type_id' => $data->type_id,
                    'model_id' => $data->model_id,
                    'serial_number' => $data->serial_number,
                    'pressure' => $data->pressure,
                    'voltase' => $data->voltase,
                    'status_id' => $data->status_id,
                    'customer_id' => $data->customer_id,
                    'tanggal_po_customer' => $data->tanggal_po_customer,
                    'jumlah' => $data->jumlah,
                    'nomor_po' => $data->nomor_po,
                    'nomor_surat_jalan' => $data->nomor_surat_jalan,
                    'tanggal' => $data->tanggal,
                    'keterangan' => $data->keterangan,
                    
                    );
            }
        }
        return $hasil;
}

function update_unit_keluar($id, $type_id, $model_id, $serial_number, $pressure, $voltase, $status_id, $customer_id, $tanggal_po_customer, $jumlah, $nomor_po, $nomor_surat_jalan, $tanggal, $keterangan, $updated_by)
  {
    $data = array(
      'id' => $id,
      'type_id' => $type_id,
      'model_id' => $model_id,
      'serial_number' => $serial_number,
      'pressure' => $pressure,
      'voltase' => $voltase,
      'status_id' => $status_id,
      'customer_id' => $customer_id,
      'tanggal_po_customer' => $tanggal_po_customer,
      'jumlah' => $jumlah,
      'nomor_po' => $nomor_po,
      'nomor_surat_jalan' => $nomor_surat_jalan,
      'tanggal' => $tanggal,
      'keterangan' => $keterangan,
      'updated_by' => $this->session->userdata('ses_id'),
      //'updated_at' =>  'NOW()',
    );
      $this->db->where('id', $id);
      $this->db->update('unit', $data);
  }

  function delete_unit_keluar($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('unit');
  }
  

  //List PO Unit dari Customer //
  function po_unit_list()
  {
     
    $this->db->select('a.id, nama_unit, model, a.pressure, a.voltase, a.jumlah, a.progress, nama_customer, a.po_customer, a.tanggal_po_customer,  b.po_masuk_id, SUM(CASE WHEN b.status_id = 2 THEN b.jumlah ELSE 0 END) AS konfirmasi, a.tanggal_po_customer, a.keterangan');
    $this->db->from('unit a');
    $this->db->join('unit b', 'b.po_masuk_id = a.id', 'Left');
    $this->db->join('type_unit', 'type_unit.id = a.type_id', 'Left');
    $this->db->join('model_unit', 'model_unit.id_model = a.model_id', 'Left');
    $this->db->join('customer', 'customer.id = a.customer_id', 'Left');
    
    $this->db->where('a.status_id = 5');
    //$this->db->where('a.progress != 2');
    $this->db->group_by('a.id', 'b.po_masuk_id');

    return $query = $this->db->get()->result();
  }



//PO Unit dari Customer
function save_po_unit($type_id, $model_id, $pressure, $voltase, $status_id, $tanggal_po_customer, $po_customer, $customer_id, $jumlah, $keterangan, $created_by, $created_at)
{
    $data = array(      
      'type_id' => $type_id,
      'model_id' => $model_id,
      'pressure' => $pressure,
      'voltase' => $voltase,
      'status_id' => $status_id,
      'tanggal_po_customer' => $tanggal_po_customer,  
      'po_customer' => $po_customer,
      'customer_id' => $customer_id,     
      'jumlah' => $jumlah,
     /* 'status_barang' => $status_barang,
      'progress' => $progress,*/
      'keterangan' => $keterangan,
      'created_by' => $this->session->userdata('ses_id'),
      'created_at' =>  date('Y-m-d H:i:s'),
     // 'updated_by' => $this->session->userdata('ses_id'),
    );
      $this->db->insert('unit',$data);
}

function get_po_unit_id($id)
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
                    'tanggal_po_customer' => $data->tanggal_po_customer,
                    'po_customer' => $data->po_customer,
                    'status_id' => $data->status_id,
                    'customer_id' => $data->customer_id,
                    'status_barang' => $data->status_barang,
                    'progress' => $data->progress,
                    'keterangan' => $data->keterangan,                    
                    );
            }
        }
        return $hasil;
}

//simpan ke pemesanan unit
function simpan_pemesanan_unit_po_unit($type_id, $model_id, $po_masuk_id, $status_id, $pressure, $voltase, $jumlah, $tanggal_order, $supplier_id, $nomor_po, $tanggal, $status_pemesanan, $keterangan, $created_by, $created_at)
{
    $data = array(
    
      'type_id' => $type_id,
      'model_id' => $model_id,
      'po_masuk_id' => $po_masuk_id,
      'status_id' => $status_id,
      'pressure' => $pressure,
      'voltase' => $voltase,
      'jumlah' => $jumlah,
      'tanggal_order' => $tanggal_order,
      'supplier_id' => $supplier_id,     
      'nomor_po' => $nomor_po,
      'tanggal' => $tanggal,
      'status_pemesanan' => $status_pemesanan,
      'keterangan' => $keterangan,
      'created_by' => $this->session->userdata('ses_id'),
      'created_at' =>  date('Y-m-d H:i:s'),
     // 'updated_by' => $this->session->userdata('ses_id'),
    );
      $this->db->insert('unit',$data);
}

function update_po_unit($id, $type_id, $model_id, $pressure, $voltase, $status_id, $customer_id, $tanggal_po_customer, $po_customer, $jumlah, $status_barang, $keterangan, $updated_by)
{
    $data = array(  
      'id' => $id,    
      'type_id' => $type_id,
      'model_id' => $model_id,
      'pressure' => $pressure,
      'voltase' => $voltase,
      'status_id' => $status_id,
      'customer_id' => $customer_id, 
      'tanggal_po_customer' => $tanggal_po_customer,  
      'po_customer' => $po_customer,          
      'jumlah' => $jumlah,
      'status_barang' => $status_barang,
      'keterangan' => $keterangan,
      'updated_by' => $this->session->userdata('ses_id'),
     // 'updated_by' => $this->session->userdata('ses_id'),
    );
      $this->db->where('id', $id);
    $this->db->update('unit', $data);
}

function update_po_masuk_progress($id, $progress, $updated_by)
{
    $data = array(  
      'id' => $id,    
      'progress' => $progress,
      'updated_by' => $this->session->userdata('ses_id'),
    );
    $this->db->where('id', $id);
    $this->db->update('unit', $data);
}

//Simpan ke unit keluar dari po customer
  // function simpan_unit_keluar($po_masuk_id, $type_id, $model_id, $serial_number, $voltase, $pressure, $status_id, $jumlah, $customer_id, $tanggal_po_customer, $po_customer, $nomor_surat_jalan, $tanggal, $keterangan, $created_by, $created_at)
  //   {
  //       $data = array(    
  //         'po_masuk_id' => $po_masuk_id,
  //         'type_id' => $type_id,
  //         'model_id' => $model_id,
  //         'serial_number' => $serial_number,
  //         'voltase' => $voltase,
  //         'pressure' => $pressure,
  //         'status_id' => $status_id, 
  //         'jumlah' => $jumlah, 
  //         'customer_id' => $customer_id,
  //         'tanggal_po_customer' => $tanggal_po_customer,    
          
  //         'po_customer' => $po_customer,
  //         'nomor_surat_jalan' => $nomor_surat_jalan,
  //         'tanggal' => $tanggal,
  //         'keterangan' => $keterangan,
  //         'created_by' => $this->session->userdata('ses_id'),
  //         'created_at' =>  date('Y-m-d H:i:s'),
  //        // 'updated_by' => $this->session->userdata('ses_id'),
  //       );
  //         $this->db->insert('unit',$data);
  //   }

	
}