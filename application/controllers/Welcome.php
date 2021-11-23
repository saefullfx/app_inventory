<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
	{
        parent::__construct();
        $this->load->model('transaksi_model');
    }
    
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function blank()
	{
		$this->load->view('blank');
	}


	function get_autocomplete(){
        if (isset($_GET['term'])) {
            $result = $this->transaksi_model->search_barang($_GET['term']);
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
                    'kode_barang' => $row->kode_barang
                    //'nama_barang'   => $row->nama_barang,
             );
                echo json_encode($arr_result);
            }
        }
    }
}
