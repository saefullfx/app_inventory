<?php
class Master_model extends CI_Model{

public function __construct() {
        parent::__construct();
    }

//ignited
/*function get_all_barang() 
{ //ambil data barang dari table barang yang akan di generate ke datatable
        $this->datatables->select('barang.id as ID, kode_barang, nama_barang, nama_jenis, nama_kategori');
        $this->datatables->from('barang');
        $this->datatables->join('kategori', 'barang.kategori_id = kategori.id');
        $this->datatables->join('jenis', 'jenis.id = barang.jenis_id');
        $this->datatables->add_column('view', '<a href="world/edit/$1">edit</a> | <a href="world/delete/$1">delete</a>', 'ID');
        
        return $this->datatables->generate();
  }*/
  
  function jumlah_barang()
  {
    $jml=$this->db->query("SELECT COUNT(kode_barang) FROM `barang`");
        return $jml->result();
   }

  function barang_list()
  {
      $this->db->select('barang.id, kode_barang, nama_barang, nama_jenis, keterangan');
      $this->db->from('barang');
      $this->db->join('jenis', 'jenis.id = barang.jenis_id', 'Left');
      $this->db->where('jenis_id = 1');
      $this->db->order_by('nama_jenis', 'asc');

      return $query = $this->db->get()->result();

      /* $hasil=$this->db->query("SELECT barang.id, kode_barang, kode_baranglama, nama_barang, nama_jenis FROM `barang` JOIN jenis ON jenis.id = barang.jenis_id ORDER BY nama_barang ASC");
        return $hasil->result();*/
   }
   
   function view_by_jenis_sparepart($jenis)
      {
        $this->db->select('barang.id, kode_barang, nama_barang, nama_jenis, keterangan');
        $this->db->from('barang');
      
        $this->db->join('jenis', 'jenis.id = barang.jenis_id', 'Left');
  
        $this->db->where('barang.jenis_id', $jenis);

        $this->db->order_by('nama_jenis', 'ASC');
        
        return $this->db->get()->result(); 
      }

      function option_jenis_sparepart()
      {

        $this->db->select('id, nama_jenis'); 
        $this->db->from('jenis');
        $this->db->order_by('nama_jenis', 'asc');          
        return $this->db->get()->result();
      }
   
  

  function save_barang($kode_barang, $nama_barang, $jenis_id, $keterangan, $created_by, $created_at)
  {
    $data = array(
      'kode_barang' => $kode_barang,
      'nama_barang' => $nama_barang,
      'jenis_id' => $jenis_id,
      'keterangan' => $keterangan,
      'created_by' => $this->session->userdata('ses_id'),
      'created_at' =>  date('Y-m-d H:i:s'),
    );
      $this->db->insert('barang',$data);
  }
  
  function edit_sparepart($id)
    {
        $q="SELECT * FROM barang WHERE id='$id'";
        $query=$this->db->query($q);
        return $query->row();
    }

  function get_barang_by_id($id)
  {
    $hsl=$this->db->query("SELECT * FROM barang WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'id' => $data->id,
                    'kode_barang' => $data->kode_barang,
                    'nama_barang' => $data->nama_barang,
                    'keterangan' => $data->keterangan,
                    'jenis_id' => $data->jenis_id,
                    
                    );
            }
        }
        return $hasil;
  }
  
  /* function get_kode_barang_by_id($id)
  {
    $hsl=$this->db->query("SELECT * FROM barang WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'id' => $data->id,
                    'kode_barang' => $data->kode_barang,
                    
                    
                    );
            }
        }
        return $hasil;
  }*/

  function update_sparepart($id, $kode_barang, $nama_barang, $jenis_id, $keterangan, $updated_by)
  {
    $data = array(
      'id' => $id,
      'kode_barang' => $kode_barang,
      'nama_barang' => $nama_barang,
      'jenis_id' => $jenis_id,  
      'keterangan' => $keterangan,
      'updated_by' => $this->session->userdata('ses_id'),
      //'updated_at' =>  'NOW()',
    );
    $this->db->where('id', $id);
    $this->db->update('barang', $data);
	}
	
	/*function update_kode_barang($id, $kode_barang, $kode_barangbaru, $updated_by)
  {
    $data = array(
      'id' => $id,
      'kode_barang' => $kode_barang,
      'kode_barangbaru' => $kode_barangbaru,     
      'updated_by' => $this->session->userdata('ses_id'),
      //'updated_at' =>  'NOW()',
    );
    $this->db->where('id', $id);
    $this->db->update('barang', $data);
  }*/

  function delete_barang($id)
  {
    $hasil=$this->db->query("DELETE FROM barang WHERE id='$id'");
        return $hasil;
  }






// -- barang selesai -- //



//customer 
  function get_customer()
  {
      $this->db->select('customer.id, nama_customer, telepon, alamat, keterangan, nama');
      $this->db->from('customer');
      $this->db->join('admin', 'admin.nip = customer.created_by', 'Left');
      $this->db->order_by('nama_customer', 'ASC');

      return $query = $this->db->get()->result();
      
    /*$result = $this->db->get('customer');
    $this->db->order_by("nama_customer", "asc");
    return $result->result();*/
  }

   function get_customer_by_id($id)
  {
    $hsl=$this->db->query("SELECT * FROM customer WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'id' => $data->id,
                    'nama_customer' => $data->nama_customer,
                    'telepon' => $data->telepon,
                    'alamat' => $data->alamat,
                    'keterangan' => $data->keterangan                    
                    );
            }
        }
        return $hasil;
  }

  function save_customer($nama_customer, $telepon,$alamat,$keterangan, $created_by, $created_at)
  {
    $data = array(
      'nama_customer' => $nama_customer,
      'telepon' => $telepon,
      'alamat' => $alamat,
      'keterangan' => $keterangan,
      'created_by' => $this->session->userdata('ses_id'),
      'created_at' =>  date('Y-m-d H:i:s'),
    );
    $this->db->insert('customer',$data);
  }


function delete_customer($id)
  {
    $hasil=$this->db->query("DELETE FROM customer WHERE id='$id'");
        return $hasil;
  }

  function get_customer_id($id)
  {
    $query = $this->db->get_where('customer', array('id' => $id));
    return $query;
  }

  function update_customer($id,$nama_customer, $telepon, $alamat, $keterangan, $updated_by)
  {
    $data = array(
      'id' => $id,
      'nama_customer' => $nama_customer,
      'telepon' => $telepon,
      'alamat' => $alamat,
      'keterangan' => $keterangan,
      'updated_by' => $this->session->userdata('ses_id'),
      //'updated_at' =>  'NOW()',
    );
    $this->db->where('id', $id);
    $this->db->update('customer', $data);
	}
	//--- customer selesai ---///

	// -- supplier --//

	function get_supplier()
	{
    $result = $this->db->get('supplier');
    $this->db->order_by("nama_supplier", "asc");
    return $result->result();
  	}

  function save_supplier($nama_supplier,$telepon,$alamat,$keterangan,$created_by,$created_at)
  {
    $data = array(
      'nama_supplier' => $nama_supplier,
      'telepon' => $telepon,
      'alamat' => $alamat,
      'keterangan' => $keterangan,
      'created_by' => $this->session->userdata('ses_id'),
      'created_at' =>  date('Y-m-d H:i:s'),
    );
    $this->db->insert('supplier',$data);
  }

  

   function get_supplier_by_id($id)
  {
    $hsl=$this->db->query("SELECT * FROM supplier WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'id' => $data->id,
                    'nama_supplier' => $data->nama_supplier,
                    'telepon' => $data->telepon,
                    'alamat' => $data->alamat,
                    'keterangan' => $data->keterangan                    
                    );
            }
        }
        return $hasil;
  }

function delete_supplier($id)
  {
    $hasil=$this->db->query("DELETE FROM supplier WHERE id='$id'");
        return $hasil;
  }


  function update_supplier($id, $nama_supplier, $telepon, $alamat, $keterangan, $updated_by)
  {
    $data = array(
      'id' => $id,
      'nama_supplier' => $nama_supplier,
      'telepon' => $telepon,
      'alamat' => $alamat,
      'keterangan' => $keterangan,
      'updated_by' => $this->session->userdata('ses_id'),
      //'updated_at' =>  'NOW()',
    );
    $this->db->where('id', $id);
    $this->db->update('supplier', $data);
	}

	//-- supplier selesai --//

	// jenis mulai //
	function get_jenis()
	{
    $result = $this->db->get('jenis');
    return $result;
  	}

  function jenis_list()
  {
        $hasil=$this->db->query("SELECT * FROM jenis");
        return $hasil->result();
   }

  function save_jenis($nama_jenis,$created_by,$created_at)
  {
    $data = array(
      'nama_jenis' => $nama_jenis,
      'created_by' => $this->session->userdata('ses_id'),
      'created_at' =>  date('Y-m-d H:i:s'),
    );
      $this->db->insert('jenis',$data);
  }

  function get_jenis_by_id($id)
  {
    $hsl=$this->db->query("SELECT * FROM jenis WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'id' => $data->id,
                    'nama_jenis' => $data->nama_jenis,
                    
                    );
            }
        }
        return $hasil;
  }

  function update_jenis($id,$nama_jenis,$updated_by)
  {
    $data = array(
      'id' => $id,
      'nama_jenis' => $nama_jenis,      
      'updated_by' => $this->session->userdata('ses_id'),
      //'updated_at' =>  'NOW()',
    );
    $this->db->where('id', $id);
    $this->db->update('jenis', $data);
	}

function delete_jenis($id)
  {
    $hasil=$this->db->query("DELETE FROM jenis WHERE id='$id'");
        return $hasil;
  }

  //-- jenis selesai --//

  // -- kategori mulai --//

  function kategori_list()
  {
        $hasil=$this->db->query("SELECT * FROM kategori");
        return $hasil->result();
   }

  function save_kategori($nama_kategori,$created_by,$created_at)
  {
    $data = array(
      'nama_kategori' => $nama_kategori,
      'created_by' => $this->session->userdata('ses_id'),
      'created_at' =>  date('Y-m-d H:i:s'),
    );
      $this->db->insert('kategori',$data);
  }

  function get_kategori_by_id($id)
  {
    $hsl=$this->db->query("SELECT * FROM kategori WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'id' => $data->id,
                    'nama_kategori' => $data->nama_kategori,
                    
                    );
            }
        }
        return $hasil;
  }

  function update_kategori($id,$nama_kategori,$updated_by)
  {
    $data = array(
      'id' => $id,
      'nama_kategori' => $nama_kategori,      
      'updated_by' => $this->session->userdata('ses_id'),
      //'updated_at' =>  'NOW()',
    );
    $this->db->where('id', $id);
    $this->db->update('kategori', $data);
	}

function delete_kategori($id)
  {
    $hasil=$this->db->query("DELETE FROM kategori WHERE id='$id'");
        return $hasil;
  }

  // -- kategori selesai --//


  //-- lokasi mulai --//

  function get_lokasi()
	{
    $result = $this->db->get('lokasi');
    return $result;
  	}

  function lokasi_list()
  {
        $hasil=$this->db->query("SELECT * FROM lokasi");
        return $hasil->result();
   }

  function save_lokasi($nama_lokasi,$ruang,$rak,$tingkat,$keterangan,$created_at,$created_by)
  {
    $data = array(
      'nama_lokasi' => $nama_lokasi,
      'ruang' => $ruang,
      'rak' => $rak,
      'tingkat' => $tingkat,
      'keterangan' => $keterangan,      
      'created_at' =>  date('Y-m-d H:i:s'),
      'created_by' => $this->session->userdata('ses_id'),
    );
      $this->db->insert('lokasi',$data);
  }

  function get_lokasi_by_id($id)
  {
    $hsl=$this->db->query("SELECT * FROM lokasi WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'id' => $data->id,
                    'nama_lokasi' => $data->nama_lokasi,
                    'ruang' => $data->ruang,
                    'rak' => $data->rak,
                    'tingkat' => $data->tingkat,
                    'keterangan' => $data->keterangan,
                    
                    );
            }
        }
        return $hasil;
  }

  function update_lokasi($id,$nama_lokasi,$ruang,$rak,$tingkat,$keterangan,$updated_by)
  {
    $data = array(
      'id' => $id,
      'nama_lokasi' => $nama_lokasi,  
       'ruang' => $ruang,
      'rak' => $rak,
      'tingkat' => $tingkat,
      'keterangan' => $keterangan,    
      'updated_by' => $this->session->userdata('ses_id'),
      //'updated_at' =>  'NOW()',
    );
    $this->db->where('id', $id);
    $this->db->update('lokasi', $data);
	}

function delete_lokasi($id)
  {
    $hasil=$this->db->query("DELETE FROM lokasi WHERE id='$id'");
        return $hasil;
  }

  //-- lokasi selesai --//



  //-- status --//
  function status_list()
  {
        $hasil=$this->db->query("SELECT * FROM status");
        return $hasil->result();
   }

  function save_status($nama_status,$created_at,$created_by)
  {
    $data = array(
      'nama_status' => $nama_status,     
      'created_at' =>  date('Y-m-d H:i:s'),
      'created_by' => $this->session->userdata('ses_id'),
    );
      $this->db->insert('status',$data);
  }

  function get_status_by_id($id)
  {
    $hsl=$this->db->query("SELECT * FROM status WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'id' => $data->id,
                    'nama_status' => $data->nama_status,
                    
                    );
            }
        }
        return $hasil;
  }


  function jumlah_sparepart()
  {
    $hasil=$this->db->query("SELECT COUNT(nama_barang) FROM `barang`");
        return $hasil->result();
  }
   
}