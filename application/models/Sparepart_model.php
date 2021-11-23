<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sparepart_model extends CI_Model {

	private $_table = "transaksi";

	public $id;
	public $status_id;
	public $kode_barang;	
	public $customer_id;
	public $supplier_id;
	public $jumlah;
	public $tanggal_order;
	public $nomor_po;
	public $tanggal;
	public $keterangan;
	public $created_by;
	public $created_at;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function rules()
	{
		return [
			['filed' => 'kode_barang',
			'label' => 'Part Number',
			'rules' => 'required'],

			['filed' => 'customer_id',
			'label' => 'Customer',
			'rules' => 'required'],

			['filed' => 'supplier_id',
			'label' => 'Supplier',
			'rules' => 'required'],

			['filed' => 'jumlah',
			'label' => 'Jumlah',
			'rules' => 'required'],

			['filed' => 'tanggal_order',
			'label' => 'Tanggal Order',
			'rules' => 'required'],

			['filed' => 'tanggal',
			'label' => 'Estimasi Sampai',
			'rules' => 'required'],

			['filed' => 'nomor_po',
			'label' => 'Nomor PO',
			'rules' => 'required'],

			['filed' => 'keterangan',
			'label' => 'Keterangan',
			'rules' => 'required']			
		];
	}

	//Sparepart Po Ke Supplier
	public function getPoSupplier()
	{
		$this->db->select('t.id, t.kode_barang, nama_barang, jumlah, nama_supplier, tanggal_order, nomor_po, tanggal, t.keterangan');
		$this->db->from('transaksi t');
		$this->db->join('barang', 'barang.kode_barang = t.kode_barang', 'Left');
		$this->db->join('supplier', 'supplier.id = supplier_id', 'Left');		    
		$this->db->where('status_id = 4');
 
    	return $query = $this->db->get()->result();
	}

	public function save_po_supplier()
    {
        $post = $this->input->post();
        /*$this->product_id = uniqid();*/
        $this->status_id = $post["status_id"];
		$this->kode_barang = $post["kode_barang"];		
		$this->supplier_id = $post["supplier_id"];
		$this->jumlah = $post["jumlah"];
		$this->tanggal_order = $post["tanggal_order"];
		$this->nomor_po = $post["nomor_po"];
		$this->tanggal = $post["tanggal"];
		$this->keterangan = $post["keterangan"];
		$this->created_at = date('Y-m-d H:i:s');
		$this->created_by = $this->session->userdata('ses_id');

		return $this->db->insert($this->_table, $this);
    }
	//Sparepart Po Ke Supplier


	public function getAll()
	{
		/*$this->db->select('transaksi.id, transaksi.kode_barang, nama_barang, jumlah, tanggal_order, nomor_po, customer, transaksi.updated_by, transaksi.updated_at, transaksi.created_at, transaksi.keterangan');
		$this->db->from('transaksi');
		$this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
		$this->db->join('customer', 'customer.id = customer_id', 'Left');		    
		$this->db->where('status_id = 3');
 
    	return $query = $this->db->get()->result();*/
		$sql_query=$this->db->query("CALL selectPoCustomer()");                     
        mysqli_next_result( $this->db->conn_id);
            if($sql_query->num_rows() > 0)
            {
                return $sql_query->result();
            }
	}

	public function getById($id)
	{
		return $this->db->get_where( $this->_table, ["id" => $id])->row();
	}

	//save to db
    public function save_sp_dipesan($status_id, $kode_barang, $customer_id, $jumlah, $tanggal_order, $nomor_po, $keterangan, $created_at, $created_by)
    {
    	$data = array(
    		'status_id' => $status_id,
    		'kode_barang' => $kode_barang,
    		'customer_id' => $customer_id,
            'jumlah' => $jumlah,
            'tanggal_order' => $tanggal_order,
            'nomor_po' => $nomor_po,
            'keterangan' => $keterangan,
            'created_at' => $created_at,
            'created_by' => $created_by
    	);
    	$this->db->insert('transaksi', $data);
    }

    public function get_data_by_id($id)
    {
        $query = $this->db->get_where('transaksi', array('id' =>  $id))->row();
        return $query;
    }

    public function update_sp_dipesan($kode_barang, $customer_id, $jumlah, $tanggal_order, $nomor_po, $keterangan, $updated_at, $updated_by)
    {
        $this->db->set('kode_barang', $kode_barang);
        $this->db->set('customer_id', $customer_id);
        $this->db->set('jumlah', $jumlah);
        $this->db->set('tanggal_order', $tanggal_order);
        $this->db->set('nomor_po', $nomor_po);
        $this->db->set('keterangan', $keterangan);
        $this->db->set('updated_at', $updated_at);
        $this->db->set('updated_by', $updated_by);
        $this->db->where('id', $id);
        $this->db->update('transaksi');
    }

    public function update($data, $id)
    {
        return $this->db->update($this->_table, $data, array('id' => $id));
    }

	/*public function save()
	{
		$post = $this->input->post();
		$this->status_id = $post["status_id"];
		$this->kode_barang = $post["kode_barang"];		
		$this->customer_id = $post["customer_id"];
		$this->jumlah = $post["jumlah"];
		$this->tanggal_order = $post["tanggal_order"];
		$this->nomor_po = $post["nomor_po"];
		$this->keterangan = $post["keterangan"];
		$this->created_at = date('Y-m-d H:i:s');
		$this->created_by = $this->session->userdata('ses_id');
	
		return $this->db->insert($this->_table, $this);
	}*/

	/*public function update()
	{
		$post = $this->input->post();
		$this->kode_barang = $post["kode_barang"];
		$this->status_id = $post["status_id"];
		$this->customer_id = $post["customer_id"];
		$this->jumlah = $post["jumlah"];
		$this->tanggal_order = $post["tanggal_order"];
		$this->nomor_po = $post["nomor_po"];
		$this->keterangan = $post["keterangan"];
		$this->keterangan = $post["date('Y-m-d H:i:s')"];
		$this->keterangan = $post["$this->session->userdata('ses_id')"];
	
		return $this->db->update($this->_table, $this, array('id' => $post['id']));
	}*/

	/*public function delete()
	{
		return $this->db->delete($this->_table, array("id" => $id));
	}*/

	public function delete_sparepart_dipesan($id)
   	{
	    $this->db->where('id', $id);
	    $this->db->delete('transaksi');
  	}

  	public function get_customer()
  	{
	 $query = $this->db->get('customer')->result();
	 return $query;
	}
}

/* End of file  */
/* Location: ./application/models/ */