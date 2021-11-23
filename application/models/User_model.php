<?php
class User_model extends CI_Model{

function get_user()
{

$this->db->select('nip, nama, pass');
$this->db->from('user');
return $query = $this->db->get()->result();

//print_r($query);
 }

function save_user($nip, $nama, $pass)
{
    $data = array(
      'nip' => $nip,
      'nama' => $nama,
      'pass' => md5($pass),
      /*'jenis_id' => $jenis_id,
      'created_by' => $this->session->userdata('ses_id'),
      'created_at' =>  date('Y-m-d H:i:s'),*/
    );
      $this->db->insert('user',$data);
}

function get_user_by_id($nip)
{
	$hsl=$this->db->query("SELECT * FROM user WHERE nip='$nip'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'nip' => $data->nip,
                    'nama' => $data->nama,
                    'pass' => $data->pass,
                    
                    
                    );
            }
        }
        return $hasil;
}

 function update_user($nip, $nama, $pass)
  {
    $data = array(
      'nip' => $nip,
      'nama' => $nama,
      'pass' => md5($pass),
      //'updated_at' =>  'NOW()',
    );
    $this->db->where('nip', $nip);
    $this->db->update('user', $data);
	}

  function delete_user($nip)
  {
    $hasil=$this->db->query("DELETE FROM user WHERE nip='$nip'");
        return $hasil;
  }

  //admin
  function get_admin()
{

$this->db->select('nip, nama, pass, level');
$this->db->from('admin');
return $query = $this->db->get()->result();

//print_r($query);
 }

function save_admin($nip, $nama, $pass, $level)
{
    $data = array(
      'nip' => $nip,
      'nama' => $nama,
      'pass' => md5($pass),
      'level' => $level,
      /*'jenis_id' => $jenis_id,
      'created_by' => $this->session->userdata('ses_id'),
      'created_at' =>  date('Y-m-d H:i:s'),*/
    );
      $this->db->insert('admin',$data);
}

function get_admin_by_id($nip)
{
	$hsl=$this->db->query("SELECT * FROM admin WHERE nip='$nip'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'nip' => $data->nip,
                    'nama' => $data->nama,
                    'pass' => $data->pass,
                    'level' => $data->level,                  
                    
                    );
            }
        }
        return $hasil;
}

 function update_admin($nip, $nama, $pass, $level)
  {
    $data = array(
      'nip' => $nip,
      'nama' => $nama,
      'pass' => md5($pass),
      'level' => $level,
      //'updated_at' =>  'NOW()',
    );
    $this->db->where('nip', $nip);
    $this->db->update('admin', $data);
	}

  function delete_admin($nip)
  {
    $hasil=$this->db->query("DELETE FROM admin WHERE nip='$nip'");
        return $hasil;
  }

}