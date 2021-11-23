<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rental_model extends CI_Model {

//master unit rental
	 function data_unit_rental()
	{
		$this->db->select('a.id, a.pressure, a.serial_number, a.keterangan_unit, a.model_id, b.model, a.status_rental');
		$this->db->from('unit_rental a');
		$this->db->join('model_unit b', 'b.id_model = a.model_id', 'Left');
		
		return $query = $this->db->get()->result();
	}

//data rental
	 function data_rental()
	{
		$this->db->select('a.id, a.nomor_po, a.tanggal_kirim, a.tanggal_kembali, a.keterangan, a.kondisi, b.pressure, b.serial_number, b.status_rental, c.model, d.nama_customer');
		$this->db->from('rental a');
		$this->db->join('unit_rental b', 'b.id = a.unit_rental_id', 'Left');
		$this->db->join('model_unit c', 'c.id_model = b.model_id', 'Left');		
		$this->db->join('customer d', 'd.id = a.customer_id', 'Left');
		return $query = $this->db->get()->result();
	}

	function save_unit_rental($model_id, $pressure, $serial_number, $keterangan_unit, $created_by, $updated_at)
	{
	    $data = array(      
	      'model_id' => $model_id,
	      'pressure' => $pressure,
	      'serial_number' => $serial_number,
	      'keterangan_unit' => $keterangan_unit,
	      'created_by' => $this->session->userdata('ses_id'),
	      'created_at' =>  date('Y-m-d H:i:s'),
	    );
	      $this->db->insert('unit_rental',$data);
	}

	function save_rental($unit_rental_id, $customer_id, $nomor_po, $tanggal_kirim, $keterangan, $created_by, $created_at)
	{
	    $data = array(      
	      'unit_rental_id' => $unit_rental_id,
	      'customer_id' => $customer_id,     
	      'nomor_po' => $nomor_po,
	      'tanggal_kirim' => $tanggal_kirim,
	      'keterangan' => $keterangan,
	      'created_by' => $this->session->userdata('ses_id'),
	      'created_at' =>  date('Y-m-d H:i:s'),
	     // 'updated_by' => $this->session->userdata('ses_id'),
	    );
	      $this->db->insert('rental',$data);
	}

	function get_unit_rental($id)
  	{
		  $hsl=$this->db->query("SELECT * FROM unit_rental WHERE id='$id'");
		        if($hsl->num_rows()>0){
		            foreach ($hsl->result() as $data) {
		                $hasil=array(
		                    'id' => $data->id,  
		                    'model_id' => $data->model_id,
		                    'pressure'  => $data->pressure,
		                    'serial_number' => $data->serial_number,
		                    'status_rental' => $data->status_rental,
		                    'keterangan_unit' => $data->keterangan_unit,
		                    );
		            }
		        }
		        return $hasil;
	}

	function get_rental($id)
  	{
		  $hsl=$this->db->query("SELECT * FROM rental WHERE id='$id'");
		        if($hsl->num_rows()>0){
		            foreach ($hsl->result() as $data) {
		                $hasil=array(
		                    'id' => $data->id,
		                    'unit_rental_id' => $data->unit_rental_id,
		                    'customer_id' => $data->customer_id,
		                    'nomor_po' => $data->nomor_po,
		                    'tanggal_kirim' => $data->tanggal_kirim,
		                    'tanggal_kembali' => $data->tanggal_kembali,
		                    'kondisi' => $data->kondisi,
		                    'keterangan' => $data->keterangan,           
		                    
		                    );
		            }
		        }
		        return $hasil;
	}

	//get dropdown customer
  function dd_model_id()
    {
        // ambil data dari db
        $this->db->order_by('model', 'asc');
        $result = $this->db->get('model_unit');
        
        // bikin array $this->db->where('id', $id);
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

   function update_unit_rental($id, $model_id, $pressure, $serial_number, $keterangan_unit, $updated_by, $updated_at)
  {
    $data = array(
      'id' => $id,
      'model_id' => $model_id,
      'pressure' => $pressure,
      'serial_number' => $serial_number,
      'keterangan_unit' => $keterangan_unit,
      'updated_by' => $this->session->userdata('ses_id'),
      'updated_at' => date('Y-m-d H:i:s'),
    );
    $this->db->where('id', $id);
    $this->db->update('unit_rental', $data);
  }

    function update_status_unit_rental($id, $status_rental, $updated_by, $updated_at)
  {
    $data = array(
      'id' => $id,      
      'status_rental' => $status_rental,
      'updated_by' => $this->session->userdata('ses_id'),
      'updated_at' => date('Y-m-d H:i:s'),
    );
    $this->db->where('id', $id);
    $this->db->update('unit_rental', $data);
  }

    function update_rental($id, $unit_rental_id, $customer_id, $nomor_po, $tanggal_kirim, $keterangan, $updated_by, $updated_at)
  {
    $data = array(
      'id' => $id,
 	  'unit_rental_id' => $unit_rental_id,
 	  'customer_id' => $customer_id,
      'nomor_po' => $nomor_po,
      'tanggal_kirim' => $tanggal_kirim,
      'keterangan' => $keterangan,
      'updated_by' => $this->session->userdata('ses_id'),
      'updated_at' =>  date('Y-m-d H:i:s'),
    );
    $this->db->where('id', $id);
    $this->db->update('rental', $data);
  }

  function update_rental_kembali($id, $tanggal_kembali, $kondisi, $keterangan, $updated_by, $updated_at)
  {
    $data = array(
      'id' => $id,
 	  'tanggal_kembali' => $tanggal_kembali,
 	  'kondisi' =>$kondisi,
      'keterangan' => $keterangan,
      'updated_by' => $this->session->userdata('ses_id'),
      'updated_at' =>  date('Y-m-d H:i:s'),
    );
    $this->db->where('id', $id);
    $this->db->update('rental', $data);
  }

  function delete_rental($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('rental');
  }


  //detail dan history unit renta;
  function detail_unit_rental($model_id)
{
  $this->db->select('a.model_id, a.pressure, a.serial_number, a.status_rental, a.keterangan_unit, b.nomor_po, b.tanggal_kirim, b.tanggal_kembali, b.kondisi, b.keterangan, b.customer_id, nama_customer, d.model');
  $this->db->from('unit_rental a');
  $this->db->join('rental b ', 'a.id = b.unit_rental_id', 'Left');
  $this->db->join('model_unit d ', 'd.id_model = a.model_id', 'Left');
  $this->db->join('customer c', 'c.id = b.customer_id', 'Left');

  $this->db->where('a.model_id', $model_id);
  
  return $query = $this->db->get()->result(); 
}

//data rental monitoring

	 function data_rental_monitoring()
	{
		$this->db->select('e.id, a.pressure, a.serial_number, a.nomor_po, a.tanggal_kirim, a.tanggal_kembali, a.status_rental, a.keterangan, d.nama_unit, b.model, c.nama_customer, e.tanggal, e.perihal, e.penggantian, e.teknisi, e.ket');
		$this->db->from('rental a');
		$this->db->join('model_unit b', 'b.id_model = a.model_id', 'Left');
		$this->db->join('type_unit d', 'd.id = b.type_id', 'Left');
		$this->db->join('customer c', 'c.id = a.customer_id', 'Left');
		$this->db->join('rental_maintenance e', 'e.rental_id = a.id', 'Left');
		
		return $query = $this->db->get()->result();
	}

	function save_rental_monitoring($rental_id, $tanggal, $perihal, $penggantian, $teknisi, $ket, $created_by, $created_at)
	{
	    $data = array(      
	      'rental_id' => $rental_id,
	      'tanggal' => $tanggal,
	      'perihal' => $perihal,
	      'penggantian' => $penggantian,     
	      'teknisi' => $teknisi,
	      'ket' => $ket,
	      'created_by' => $this->session->userdata('ses_id'),
	      'created_at' =>  date('Y-m-d H:i:s'),
	     // 'updated_by' => $this->session->userdata('ses_id'),
	    );
	      $this->db->insert('rental_maintenance',$data);
	}

	function get_rental_monitoring($id)
  	{
		  $hsl=$this->db->query("SELECT * FROM rental_maintenance WHERE id='$id'");
		        if($hsl->num_rows()>0){
		            foreach ($hsl->result() as $data) {
		                $hasil=array(
		                    'id' => $data->id,
		                    'rental_id' => $data->rental_id,
		                    'tanggal' => $data->tanggal,
		                    'perihal' => $data->perihal,
		                    'penggantian' => $data->penggantian,
		                    'teknisi' => $data->teknisi,
		                    'ket' => $data->ket,                    
		                    
		                    );
		            }
		        }
		        return $hasil;
	}


	  function update_rental_monitoring($id, $rental_id, $tanggal, $perihal, $penggantian, $teknisi, $ket, $updated_by)
	  {
	    $data = array(
	      'id' => $id,
	      'rental_id' => $rental_id,
	      'tanggal' => $tanggal,
	      'perihal' => $perihal,
	      'penggantian' => $penggantian,
	      'teknisi' => $teknisi,
	      'ket' => $ket,
	      'updated_by' => $this->session->userdata('ses_id'),
	      //'updated_at' =>  'NOW()',
	    );
	    $this->db->where('id', $id);
	    $this->db->update('rental_maintenance', $data);
	  }

  function delete_rental_monitoring($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('rental_maintenance');
  }

  //get dropdown customer
 

    function dd_unit_rental()
    {
        // ambil data dari db
        
        $this->db->select('id, model_id, model');
        $this->db->from('unit_rental');
        $status_rental = "Free";
        $this->db->join('model_unit', 'model_unit.id_model = unit_rental.model_id', 'left');
        $this->db->where('status_rental', $status_rental);

        $result = $this->db->get();
        
        // bikin array $this->db->where('id', $id);
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $dd[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $dd[$row->id] = $row->model;
            }
        }
        return $dd;
    }


}

/* End of file rental_model.php */
/* Location: ./application/models/rental_model.php */