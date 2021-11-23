<?php
class Auth_model extends CI_Model{
    //cek nip dan password dosen
    function auth_admin($username,$password)
    {
        $query=$this->db->query("SELECT * FROM admin WHERE nip='$username' AND pass=MD5('$password') LIMIT 1");
        return $query;
    }
 
    //cek nim dan password mahasiswa
    function auth_pegawai($username,$password)
    {
        $query=$this->db->query("SELECT * FROM user WHERE nip='$username' AND pass=MD5('$password') LIMIT 1");
        return $query;
    }
 
}