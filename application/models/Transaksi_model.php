<?php
class Transaksi_model extends CI_Model{

// -- barang keluar --//

function pencarian_list()
{

$this->db->select('transaksi.kode_barang, nama_barang, sum(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) - sum(case WHEN status_id = 2 THEN jumlah ELSE 0 END) AS jumlah, posisi_penempatan');
$this->db->from('transaksi');
$this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');

$this->db->where('transaksi.status_id IN (1,2)'); 
$this->db->group_by('transaksi.kode_barang');

return $query = $this->db->get()->result();

//print_r($query);

 }  


  function barang_keluar_list()
{

$this->db->select('transaksi.id, transaksi.kode_barang, nama_barang, nama_customer, jumlah, nomor_po, tanggal_order, nomor_surat_jalan, tanggal, nama, transaksi.updated_at, transaksi.updated_by, transaksi.keterangan');
$this->db->from('transaksi');
$this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
$this->db->join('customer', 'customer.id = transaksi.customer_id', 'Left');
$this->db->join('admin', 'admin.nip = transaksi.updated_by', 'Left');

$this->db->where('status_id = 2'); 
$this->db->order_by("kode_barang", "asc");
return $query = $this->db->get()->result();

//print_r($query);

 }

 function save_barang_keluar($kode_barang, $status_id, $customer_id, $jumlah, $nomor_po, $tanggal_order, $nomor_surat_jalan, $tanggal, $keterangan, $created_by, $created_at)
  {
    $data = array(
      'kode_barang' => $kode_barang,
      'status_id' => $status_id,
      'customer_id' => $customer_id,
      'jumlah' => $jumlah,
      'nomor_po' => $nomor_po,
      'tanggal_order' => $tanggal_order,
      'nomor_surat_jalan' => $nomor_surat_jalan,
      'tanggal' => $tanggal,
      'keterangan' => $keterangan,
      'created_by' => $this->session->userdata('ses_id'),
      'created_at' =>  date('Y-m-d H:i:s'),
     // 'updated_by' => $this->session->userdata('ses_id'),
    );
      $this->db->insert('transaksi',$data);
  }

  function delete_barang_keluar($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('transaksi');
  }


   function get_barang_keluar_id($id)
  {
    $hsl=$this->db->query("SELECT * FROM transaksi WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'id' => $data->id,
                    'kode_barang' => $data->kode_barang,
                    'status_id' => $data->status_id,
                    'customer_id' => $data->customer_id,
                    'jumlah' => $data->jumlah,
                    'tanggal_order' => $data->tanggal_order,
                    'nomor_po' => $data->nomor_po,
                    'nomor_surat_jalan' => $data->nomor_surat_jalan,
                    'tanggal' => $data->tanggal,
                    'keterangan' => $data->keterangan,
                    
                    );
            }
        }
        return $hasil;
  }



  function update_barang_keluar($id, $kode_barang, $status_id, $customer_id, $jumlah, $nomor_po, $tanggal_order, $nomor_surat_jalan, $tanggal, $keterangan, $updated_by)
  {
    $data = array(
      'id' => $id,
      'kode_barang' => $kode_barang,
      'status_id' => $status_id,
      'customer_id' => $customer_id,
      'jumlah' => $jumlah,
      'nomor_po' => $nomor_po,
      'tanggal_order' => $tanggal_order,
      'nomor_surat_jalan' => $nomor_surat_jalan,
      'tanggal' => $tanggal,
      'keterangan' => $keterangan,
      'updated_by' => $this->session->userdata('ses_id'),
      //'updated_at' =>  'NOW()',
    );
    
    $this->db->where('id', $id);
    $this->db->update('transaksi', $data);
  }
  


  function get_barang($nama_barang, $column)
  {
    $this->db->select('*');
    $this->db->limit(10);
    $this->db->from('barang');
    $this->db->like('nama_barang', $nama_barang);
    return $this->db->get()->result_array();     
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
    
    
    //chain dropdown
        public function get_jenis_chain()
        {
            $this->db->order_by('nama_jenis', 'asc');
            return $this->db->get('jenis')->result();
        }

        public function get_part_number()
        {
            // kita joinkan tabel kota dengan provinsi
            $this->db->order_by('kode_barang', 'asc');
            $this->db->join('jenis', 'jenis.id = barang.jenis_id');
            return $this->db->get('barang')->result();
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
    

    //get dropdown barang
  function dd_barang_masuk()
    {
        // ambil data dari db
        $this->db->group_by('kode_barang', 'asc');
        $result = $this->db->get('barang');
        
        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $dd[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $dd[$row->kode_barang] = $row->kode_barang;
            }
        }
        return $dd;
    }
    
      //barang keluar
    function kode_barang()
    {
      // ambil data dari db
        $this->db->group_by('kode_barang', 'asc');
        $this->db->where('status_id = 1');
        $result = $this->db->get('transaksi');
        
        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $kode_barang[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $kode_barang[$row->kode_barang] = $row->kode_barang;
            }
        }
        return $kode_barang;
    }
    
    //get dropdown barang
  function dd_barang()
    {
        // ambil data dari db
        $this->db->order_by('kode_barang', 'asc');
        $result = $this->db->get('barang');
        
        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $dd[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $dd[$row->kode_barang] = $row->kode_barang;
            }
        }
        return $dd;
    }

   


function get_barang_masuk()
{
    $result = $this->db->get('transaksi');
    return $result;
}

// -- barang masuk --//
function barang_masuk_list()
{

$this->db->select('transaksi.id, transaksi.kode_barang, nama_barang, nama_supplier, jumlah, nomor_po, nomor_surat_jalan, tanggal, nama, transaksi.updated_at, transaksi.updated_by, transaksi.keterangan');
$this->db->from('transaksi');
$this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
$this->db->join('supplier', 'supplier.id = transaksi.supplier_id', 'Left');
$this->db->join('admin', 'admin.nip = transaksi.updated_by', 'Left');

$this->db->where('status_id = 1'); 
return $query = $this->db->get()->result();

//print_r($query);

 }

function save_barang_masuk($kode_barang,$status_id,$supplier_id,$jumlah,$nomor_po,$nomor_surat_jalan,$tanggal,$keterangan,$created_by,$created_at,$updated_by)
  {
    $data = array(
      'kode_barang' => $kode_barang,
      'status_id' => $status_id,
      'supplier_id' => $supplier_id,
      'jumlah' => $jumlah,
      'nomor_po' => $nomor_po,
      'nomor_surat_jalan' => $nomor_surat_jalan,
      'tanggal' => $tanggal,
      //'posisi_penempatan' => $posisi_penempatan,
      'keterangan' => $keterangan,
      'created_by' => $this->session->userdata('ses_id'),
      'created_at' =>  date('Y-m-d H:i:s'),
      'updated_by' => $this->session->userdata('ses_id'),
    );
      $this->db->insert('transaksi',$data);
  }

  function delete_barang_masuk($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('transaksi');
  }

   function get_barang_masuk_id($id)
  {
    $hsl=$this->db->query("SELECT * FROM transaksi WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'id' => $data->id,
                    'kode_barang' => $data->kode_barang,
                    'status_id' => $data->status_id,
                    'supplier_id' => $data->supplier_id,
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

  function update_barang_masuk($id,$kode_barang,$status_id, $supplier_id,$jumlah,$nomor_po,$nomor_surat_jalan,$tanggal,$keterangan,$updated_by)
  {
    $data = array(
      'kode_barang' => $kode_barang,
      'status_id' => $status_id,
      'supplier_id' => $supplier_id,
      'jumlah' => $jumlah,
      'nomor_po' => $nomor_po,
      'nomor_surat_jalan' => $nomor_surat_jalan,
      'tanggal' => $tanggal,
      //'posisi_penempatan' => $posisi_penempatan,
      'keterangan' => $keterangan,
      'updated_by' => $this->session->userdata('ses_id'),
      //'updated_at' =>  'NOW()',
    );
    $this->db->where('id', $id);
    $this->db->update('transaksi', $data);
  }


  function get_barang_by_id($id)
  {
    $hsl=$this->db->query("SELECT * FROM barang WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'id' => $data->id,
                    'kode_barang' => $data->kode_barang,
                    'nama_jenis' => $data->nama_jenis,
                    
                    );
            }
        }
        return $hasil;
  }
  
  

// INSERT TO BARANG KELUAR

  /*function get_sparepart_dipesan_keluar($id)
  {
    $hsl=$this->db->query("SELECT * FROM barang_dipesan WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'id' => $data->id,
                   
                    'kode_barang' => $data->kode_barang,
                    'tanggal_po' => $data->tanggal_po,
                    'customer_id' => $data->customer_id,
                    'jumlah' => $data->jumlah,
                    'nomor_po' => $data->nomor_po,
                    
                    );
            }
        }
        return $hasil;
  }*/


  /*function insert_sparepart_keluar($kode_barang, $pesan_id, $status_id, $customer_id, $jumlah, $nomor_po, $tanggal_order, $nomor_surat_jalan, $tanggal, $keterangan, $updated_by)
  {
    $data = array(
      'kode_barang' => $kode_barang,
      'pesan_id' =>$pesan_id,
      'status_id' => $status_id,      
      'customer_id' => $customer_id,
      'jumlah' => $jumlah,
      'nomor_po' => $nomor_po,
      'tanggal_order' => $tanggal_order,           
      'nomor_surat_jalan' => $nomor_surat_jalan,
      'tanggal' => $tanggal,
      'keterangan' => $keterangan,
      'updated_by' => $this->session->userdata('ses_id'),
      //'updated_at' =>  'NOW()',
    );

    $this->db->insert('transaksi', $data);
  }*/

  


  //sparepart telah dipesan//
  /*function sparepart_dipesan()
  {

    $this->db->select('a.id, a.kode_barang, nama_barang, a.jumlah, SUM(CASE WHEN status_id = 2 THEN b.jumlah ELSE 0 END) AS jumlah_parsial, a.jumlah - SUM(CASE WHEN status_id = 2 THEN b.jumlah ELSE 0 END) AS SISA_KIRIM,  b.pesan_id, a.tanggal_po, a.nomor_po, nama_customer, a.keterangan');
    $this->db->from('barang_dipesan a');
    $this->db->join('barang', 'barang.kode_barang = a.kode_barang', 'Left');
  $this->db->join('customer', 'customer.id = a.customer_id', 'Left');
    $this->db->join('transaksi b', 'b.pesan_id = a.id', 'Left');
    
    $this->db->group_by('a.id', 'b.pesan_id');
 
    return $query = $this->db->get()->result();

  }*/


   /*function save_sparepart_dipesan($kode_barang, $jumlah, $customer_id, $nomor_po, $tanggal_po, $keterangan, $created_by, $created_at)
  {
    $data = array(
      'kode_barang' => $kode_barang,
      'jumlah' => $jumlah,
      'customer_id' => $customer_id,
      'nomor_po' => $nomor_po,
      'tanggal_po' => $tanggal_po,
      'keterangan' => $keterangan,
      'created_by' => $this->session->userdata('ses_id'),
      'created_at' =>  date('Y-m-d H:i:s'),
      /*'updated_by' => $this->session->userdata('ses_id'),*/
   // );
     // $this->db->insert('barang_dipesan',$data);
 // }*/

 /* function get_sparepart_dipesan_id($id)
  {
    $hsl=$this->db->query("SELECT * FROM barang_dipesan WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'id' => $data->id,
                    'kode_barang' => $data->kode_barang,
                    'tanggal_po' => $data->tanggal_po,
                    'customer_id' => $data->customer_id,
                    'jumlah' => $data->jumlah,
                    'nomor_po' => $data->nomor_po,
                    'keterangan' => $data->keterangan,
                    
                    );
            }
        }
        return $hasil;
  }*/


  /*function update_sparepart_dipesan($id, $kode_barang, $jumlah, $customer_id, $nomor_po, $tanggal_po, $keterangan, $updated_by)
  {
    $data = array(
      'id' => $id,
      'kode_barang' => $kode_barang,
      'jumlah' => $jumlah,
      'customer_id' => $customer_id,
      'nomor_po' => $nomor_po,
      'tanggal_po' => $tanggal_po,           
      'keterangan' => $keterangan,
      'updated_by' => $this->session->userdata('ses_id'),
      //'updated_at' =>  'NOW()',
    );


    $this->db->where('id', $id);
    $this->db->update('barang_dipesan', $data);
  }

   function delete_sparepart_dipesan($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('barang_dipesan');
  }*/
  // sparepart telah dipesan//
  
  
   function save_po_sementara($kode_barang, $status_id, $customer_id, $jumlah, $tanggal_order, $nomor_po, $keterangan, $created_by, $created_at)
  {
    $data = array(
      'kode_barang' => $kode_barang,
      'status_id' => $status_id,
      'customer_id' => $customer_id,

      'jumlah' => $jumlah,
      'tanggal_order' => $tanggal_order,
      'nomor_po' => $nomor_po,
      
     
      'keterangan' => $keterangan,
      'created_by' => $this->session->userdata('ses_id'),
      'created_at' =>  date('Y-m-d H:i:s'),
      /*'updated_by' => $this->session->userdata('ses_id'),*/
    );
      $this->db->insert('transaksi',$data);
  }




// INSERT TO BARANG KELUAR

  function get_sparepart_dipesan_keluar($id)
  {
    $hsl=$this->db->query("SELECT * FROM transaksi WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'id' => $data->id,                   
                    'kode_barang' => $data->kode_barang,
                    'tanggal_order' => $data->tanggal_order,
                    'customer_id' => $data->customer_id,
                    'jumlah' => $data->jumlah,
                    'nomor_po' => $data->nomor_po,
                    
                    );
            }
        }
        return $hasil;
  }


  function insert_sparepart_keluar($kode_barang, $pesan_id, $status_id, $customer_id, $jumlah, $nomor_po, $tanggal_order, $nomor_surat_jalan, $tanggal, $keterangan, $updated_by)
  {
    $data = array(
      'kode_barang' => $kode_barang,
      'pesan_id' =>$pesan_id,
      'status_id' => $status_id,      
      'customer_id' => $customer_id,
      'jumlah' => $jumlah,
      'nomor_po' => $nomor_po,
      'tanggal_order' => $tanggal_order,           
      'nomor_surat_jalan' => $nomor_surat_jalan,
      'tanggal' => $tanggal,
      'keterangan' => $keterangan,
      'updated_by' => $this->session->userdata('ses_id'),
      //'updated_at' =>  'NOW()',
    );

    $this->db->insert('transaksi', $data);
  }

  


  //sparepart telah dipesan//
  public function sparepart_dipesan()
  {

    // $this->db->select('a.id, a.kode_barang, nama_barang, nama_customer, a.jumlah, a.nomor_po, a.tanggal_order, a.keterangan, a.created_by, a.created_at');
    // $this->db->from('transaksi a');
    // $this->db->join('barang b', 'b.kode_barang = a.kode_barang', 'Left');
    // $this->db->join('customer c', 'c.id = a.customer_id', 'Left');
    // $this->db->where('a.status_id = 3');
 
    // return $query = $this->db->get()->result();

     // menjalankan stored procedure tampil_penerbit()
        $sql_query=$this->db->query("CALL selectSpDipesan()");                     
        mysqli_next_result( $this->db->conn_id);
            if($sql_query->num_rows()>0){
                return $sql_query->result_array();
              }

  }


 /*  function save_sparepart_dipesan($kode_barang, $jumlah, $customer_id, $nomor_po, $tanggal_po, $keterangan, $created_by, $created_at)
  {
    $data = array(
      'kode_barang' => $kode_barang,
      'jumlah' => $jumlah,
      'customer_id' => $customer_id,
      'nomor_po' => $nomor_po,
      'tanggal_po' => $tanggal_po,
      'keterangan' => $keterangan,
      'created_by' => $this->session->userdata('ses_id'),
      'created_at' =>  date('Y-m-d H:i:s'),
      /*'updated_by' => $this->session->userdata('ses_id'),*/
 /*   );
      $this->db->insert('barang_dipesan',$data);
  }*/

  function get_sparepart_dipesan_id($id)
  {
    $hsl=$this->db->query("SELECT * FROM transaksi WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'id' => $data->id,
                    'kode_barang' => $data->kode_barang,
                    'tanggal_order' => $data->tanggal_order,
                    'customer_id' => $data->customer_id,
                    'jumlah' => $data->jumlah,
                    'nomor_po' => $data->nomor_po,
                    'status_pemesanan' => $data->status_pemesanan,
                    'keterangan' => $data->keterangan,
                    
                    );
            }
        }
        return $hasil;
  }


  function update_sparepart_dipesan($id, $kode_barang, $jumlah, $customer_id, $nomor_po, $tanggal_order, $keterangan, $updated_by)
  {
    $data = array(
      'id' => $id,
      'kode_barang' => $kode_barang,
      'jumlah' => $jumlah,
      'customer_id' => $customer_id,
      'nomor_po' => $nomor_po,
      'tanggal_order' => $tanggal_order,           
      'keterangan' => $keterangan,
      'updated_by' => $this->session->userdata('ses_id'),
      //'updated_at' =>  'NOW()',
    );


    $this->db->where('id', $id);
    $this->db->update('transaksi', $data);
  }

  function update_status_sparepart_dipesan($id, $status_pemesanan, $updated_by)
  {
    $data = array(
      'id' => $id,
      'status_pemesanan' => $status_pemesanan,
      'updated_by' => $this->session->userdata('ses_id'),
      //'updated_at' =>  'NOW()',
    );


    $this->db->where('id', $id);
    $this->db->update('transaksi', $data);
  }

  function delete_sparepart_dipesan($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('transaksi');
  }
  // sparepart telah dipesan//
  
  
  // Fungsi untuk melakukan proses upload file sp telah dipesan
  public function upload_file($filename){
    $this->load->library('upload'); // Load librari upload
    
    $config['upload_path'] = './excel/upload/';
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
  
    // Fungsi untuk melakukan proses upload file brg masuk
  public function upload_file_brg_masuk($filename){
    $this->load->library('upload'); // Load librari upload
    
    $config['upload_path'] = './excel/upload/sparepart_masuk/';
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
  
  // Fungsi untuk melakukan proses upload file brg keluar
  public function upload_file_brg_keluar($filename){
    $this->load->library('upload'); // Load librari upload
    
    $config['upload_path'] = './excel/upload/sparepart_keluar/';
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

  function insert_multiple($data){
    $this->db->insert_batch('transaksi', $data);
  }

}