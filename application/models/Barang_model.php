<?php
class Barang_model extends CI_Model{

function total_item()
 {
  //$this->db->select_count('kode_barang');
   $query = $this->db->get('barang');
   if($query->num_rows()>0)
   {
     return $query->num_rows();
   }
   else
   {
     return 0;
   }
 }

 function total_item_unit()
 {
  //$this->db->select_count('kode_barang');
   $query = $this->db->get('master_unit');
   if($query->num_rows()>0)
   {
     return $query->num_rows();
   }
   else
   {
     return 0;
   }
 }


function get_barang()
{
    $result = $this->db->get('barang');
    return $result;
 }

 function get_kategori(){
    $hsl=$this->db->get('kategori');
    return $hsl;
  }

 function barang_list()
{

$this->db->select('nama_barang, kode_barangbaru, sum(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) AS barang_masuk, sum(CASE WHEN status_id = 2 THEN jumlah ELSE 0 END) AS barang_keluar, transaksi.kode_barang, transaksi.keterangan, sum(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) - sum(case WHEN status_id = 2 THEN jumlah ELSE 0 END) AS total');
$this->db->from('transaksi');
$this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');

$this->db->where('status_id IN (1,2)'); 
$this->db->group_by('transaksi.kode_barang');
return $query = $this->db->get()->result();

//print_r($query);

 }


 /*function barang_ready()
 {
   $this->db->select('a.kode_barang, b.keterangan, nama_barang, sum(CASE WHEN status_id = 1 THEN a.jumlah ELSE 0 END) - sum(case WHEN status_id = 2 && pesan_id = 0 THEN a.jumlah ELSE 0 END) - SUM(CASE WHEN c.jumlah != NULL THEN c.jumlah ELSE 0 END) AS stock, c.jumlah AS Dipesan');
    $this->db->from('transaksi a');
    $this->db->join('barang b', 'b.kode_barang = a.kode_barang', 'Left');
    $this->db->join('barang_dipesan c', 'c.id = a.pesan_id', 'Left');
    $this->db->where('a.status_id IN (1,2)'); 
    $this->db->group_by('a.kode_barang', 'c.id', 'a.pesan_id');
    return $query = $this->db->get()->result();
 }*/
 
 function barang_ready()
 {
   $this->db->select('a.kode_barang, b.keterangan, nama_barang, sum(CASE WHEN status_id = 1 THEN a.jumlah ELSE 0 END) - sum(case WHEN status_id = 2 THEN a.jumlah ELSE 0 END) AS stock');
    $this->db->from('transaksi a');
    $this->db->join('barang b', 'b.kode_barang = a.kode_barang', 'Left');
    //$this->db->join('barang_dipesan c', 'c.id = a.pesan_id', 'Left');
    $this->db->where('a.status_id IN (1,2)'); 
    $this->db->group_by('a.kode_barang');
    return $query = $this->db->get()->result();
 }


 function rekap_list()
{

$this->db->select('transaksi.kode_barang, nama_barang, sum(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) AS barang_masuk, sum(CASE WHEN status_id = 2 THEN jumlah ELSE 0 END) AS barang_keluar, sum(CASE WHEN status_id = 1 THEN jumlah ELSE 0 END) - sum(case WHEN status_id = 2 THEN jumlah ELSE 0 END) AS total, sum(CASE WHEN status_id = 3 THEN booking ELSE 0 END) AS po_sementara, sum(CASE WHEN status_id = 5 THEN jumlah ELSE 0 END) AS order_barang');
$this->db->from('transaksi');
$this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');

$this->db->where('transaksi.status_id IN (1,2,3,5)'); 
$this->db->group_by('transaksi.kode_barang');
return $query = $this->db->get()->result();

//print_r($query);

 }


//rekap masuk//
 function rekap_masuk()
{

$this->db->select('transaksi.kode_barang, nama_barang, sum(jumlah) AS jumlah, MONTHNAME(tanggal) AS bulan, YEAR(tanggal) AS tahun');
$this->db->from('transaksi');
$this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');

$this->db->where('transaksi.status_id = 1'); 
$this->db->group_by('transaksi.kode_barang, bulan');
return $query = $this->db->get()->result();

//print_r($query);

 }

  public function view_by_partnumber($kode_barang)
  {
    $this->db->select('transaksi.kode_barang, nama_barang, sum(jumlah) AS jumlah, MONTHNAME(tanggal) AS bulan, YEAR(tanggal) AS tahun');
    $this->db->from('transaksi');
    $this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
    
    $this->db->where('status_id = 1');        
    $this->db->where('transaksi.kode_barang', $kode_barang); // Tambahkan where tanggal nya
    $this->db->group_by('transaksi.kode_barang, bulan, tahun');
        
    return $this->db->get()->result(); // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
  }
  
  public function view_by_jenis_barang($jenis_barang)
  {
    $this->db->select('transaksi.kode_barang, nama_barang, jenis_id, nama_jenis, sum(jumlah) AS jumlah, MONTHNAME(tanggal) AS bulan, YEAR(tanggal) AS tahun');
    $this->db->from('transaksi');
    $this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
    $this->db->join('jenis', 'jenis.id = barang.jenis_id', 'Left');

    $this->db->where('status_id = 1');        
    $this->db->where('jenis_id', $jenis_barang); // Tambahkan where tanggal nya
    $this->db->group_by('transaksi.kode_barang, bulan, tahun');
        
    return $this->db->get()->result(); // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
  }
    
  public function view_by_month($month, $year)
  {
    $this->db->select('transaksi.kode_barang, nama_barang, sum(jumlah) AS jumlah, MONTHNAME(tanggal) AS bulan, YEAR(tanggal) AS tahun');
    $this->db->from('transaksi');
    $this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
    
    $this->db->where('status_id = 1'); 
    $this->db->where('MONTH(tanggal)', $month); // Tambahkan where bulan
    $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
    $this->db->group_by('transaksi.kode_barang, bulan, tahun');
        
    return $this->db->get()->result(); // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
  }
    
  public function view_by_year($year)
  {
    $this->db->select('transaksi.kode_barang, nama_barang, sum(jumlah) AS jumlah, MONTHNAME(tanggal) AS bulan, YEAR(tanggal) AS tahun');
    $this->db->from('transaksi');
    $this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang');
    $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
    $this->db->where('status_id = 1'); 
    $this->db->group_by('transaksi.kode_barang, bulan, tahun');
        
    return $this->db->get()->result(); // Tampilkan data transaksi sesuai tahun yang diinput oleh user pada filter
  }
    
  public function view_all()
  {
   $this->db->select('transaksi.kode_barang, nama_barang, sum(jumlah) AS jumlah, MONTHNAME(tanggal) AS bulan, YEAR(tanggal) AS tahun');
$this->db->from('transaksi');
$this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');

$this->db->where('transaksi.status_id = 1'); 
$this->db->group_by('transaksi.kode_barang, bulan, tahun');
return $query = $this->db->get()->result();
  }
    
    public function option_tahun()
    {
        $this->db->select('YEAR(tanggal) AS tahun'); // Ambil Tahun dari field tanggal
        $this->db->from('transaksi'); // select ke tabel transaksi
        $this->db->where('status_id = 1'); 
        $this->db->order_by('YEAR(tanggal)'); // Urutkan berdasarkan tahun secara Ascending (ASC)
        $this->db->group_by('YEAR(tanggal)'); // Group berdasarkan tahun pada field tanggal
        
        return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    }

    public function option_kode_barang()
    {
        $this->db->select('kode_barang'); // Ambil Tahun dari field tanggal
        $this->db->from('transaksi'); // select ke tabel transaksi
         $this->db->where('status_id = 1');
          $this->db->order_by('kode_barang'); // Urutkan berdasarkan tahun secara Ascending (ASC)
        
         $this->db->group_by('kode_barang'); // Group berdasarkan tahun pada field tanggal
       
       
        
        return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    }
    
    function option_jenis_barang()
    {
      $this->db->select('transaksi.kode_barang, nama_barang, jenis_id, nama_jenis');
      $this->db->from('transaksi');
      $this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
      $this->db->join('jenis', 'jenis.id = barang.jenis_id', 'Left');

      $this->db->where('transaksi.status_id = 1');  
      $this->db->group_by('barang.jenis_id');

     return $this->db->get()->result();
    }
 //end rekap masuk//

  //rekap keluar

  function rekap_keluar()
{

$this->db->select('transaksi.kode_barang, nama_barang, sum(jumlah) AS jumlah, MONTHNAME(tanggal) AS bulan, YEAR(tanggal) AS tahun');
$this->db->from('transaksi');
$this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');

$this->db->where('transaksi.status_id = 2'); 
$this->db->group_by('transaksi.kode_barang, bulan');
return $query = $this->db->get()->result();

//print_r($query);

 }
 
 public function view_by_jenis_barang_keluar($jenis_barang)
  {
    $this->db->select('transaksi.kode_barang, nama_barang, jenis_id, nama_jenis, sum(jumlah) AS jumlah, MONTHNAME(tanggal) AS bulan, YEAR(tanggal) AS tahun');
    $this->db->from('transaksi');
    $this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
    $this->db->join('jenis', 'jenis.id = barang.jenis_id', 'Left');

    $this->db->where('status_id = 2');        
    $this->db->where('jenis_id', $jenis_barang); // Tambahkan where tanggal nya
    $this->db->group_by('transaksi.kode_barang, bulan, tahun');
        
    return $this->db->get()->result(); // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
  }

 function view_by_partnumber_keluar($kode_barang)
  {
    $this->db->select('transaksi.kode_barang, nama_barang, sum(jumlah) AS jumlah, MONTHNAME(tanggal) AS bulan, YEAR(tanggal) AS tahun');
    $this->db->from('transaksi');
    $this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
    
    $this->db->where('status_id = 2');        
    $this->db->where('transaksi.kode_barang', $kode_barang); // Tambahkan where tanggal nya
    $this->db->group_by('transaksi.kode_barang, bulan, tahun');
        
    return $this->db->get()->result(); // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
  }
    
 function view_by_month_keluar($month, $year)
  {
    $this->db->select('transaksi.kode_barang, nama_barang, sum(jumlah) AS jumlah, MONTHNAME(tanggal) AS bulan, YEAR(tanggal) AS tahun');
    $this->db->from('transaksi');
    $this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
    
    $this->db->where('status_id = 2'); 
    $this->db->where('MONTH(tanggal)', $month); // Tambahkan where bulan
    $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
    $this->db->group_by('transaksi.kode_barang, bulan, tahun');
        
    return $this->db->get()->result(); // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
  }
    
 function view_by_year_keluar($year)
  {
    $this->db->select('transaksi.kode_barang, nama_barang, sum(jumlah) AS jumlah, MONTHNAME(tanggal) AS bulan, YEAR(tanggal) AS tahun');
    $this->db->from('transaksi');
    $this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
    $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
    $this->db->where('status_id = 2'); 
    $this->db->group_by('transaksi.kode_barang, bulan, tahun');
        
    return $this->db->get()->result(); // Tampilkan data transaksi sesuai tahun yang diinput oleh user pada filter
  }
    
 function view_all_keluar()
  {
   $this->db->select('transaksi.kode_barang, nama_barang, sum(jumlah) AS jumlah, MONTHNAME(tanggal) AS bulan, YEAR(tanggal) AS tahun');
$this->db->from('transaksi');
$this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');

$this->db->where('transaksi.status_id = 2'); 
$this->db->group_by('transaksi.kode_barang, bulan, tahun');
return $query = $this->db->get()->result();
  }
    
  public function option_tahun_keluar()
    {
        $this->db->select('YEAR(tanggal) AS tahun'); // Ambil Tahun dari field tanggal
        $this->db->from('transaksi'); // select ke tabel transaksi
        $this->db->where('status_id = 2'); 
        $this->db->order_by('YEAR(tanggal)'); // Urutkan berdasarkan tahun secara Ascending (ASC)
        $this->db->group_by('YEAR(tanggal)'); // Group berdasarkan tahun pada field tanggal
        
        return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    }

  public function option_kode_barang_keluar()
    {
        $this->db->select('kode_barang'); // Ambil Tahun dari field tanggal
        $this->db->from('transaksi'); // select ke tabel transaksi
         $this->db->where('status_id = 2');
           // Urutkan berdasarkan tahun secara Ascending (ASC)        
         $this->db->group_by('kode_barang'); // Group berdasarkan tahun pada field tanggal
       
       
        
        return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    }
    
    function option_jenis_barang_keluar()
    {
      $this->db->select('transaksi.kode_barang, nama_barang, jenis_id, nama_jenis');
      $this->db->from('transaksi');
      $this->db->join('barang', 'barang.kode_barang = transaksi.kode_barang', 'Left');
      $this->db->join('jenis', 'jenis.id = barang.jenis_id', 'Left');

      $this->db->where('transaksi.status_id = 2');  
      $this->db->group_by('jenis_id');

     return $this->db->get()->result();
    }


 //rekap keluar end //

 	function data_kartu_stock()
 	{
 		$this->db->select('kartu_stock.id, kartu_stock.kode_barang, nama_barang, lokasi, ruang, rak, tingkat, jumlah, keterangan');
 		$this->db->from('kartu_stock');
 		$this->db->join('barang', 'barang.kode_barang = kartu_stock.kode_barang', 'Left');
 		

 		return $query = $this->db->get()->result();
 	}

 	


 	/*function get_all_kartu_stock()
 	{
 		$this->datatables->select('kartu_stock.id, kartu_stock.kode_barang, nama_barang, nama_kategori, nama_jenis, lokasi, ruang, rak, tingkat, jumlah, keterangan');
 		$this->datatables->from('kartu_stock');
 		$this->datatables->join('barang', 'barang.kode_barang = kartu_stock.kode_barang');
 		$this->datatables->join('kategori', 'kategori.id = kartu_stock.kategori_id' );
 		$this->datatables->join('jenis', 'jenis.id = kartu_stock.jenis_id');
 		$this->datatables->add_column('view',    '<a href="javascript:void(0);" class="edit_record btn btn-info btn-xs" data-id="$1" data-kode_barang="$2" data-nama_barang="$3" data-nama_kategori="$4" data-nama_jenis="$5" data-lokasi="$6" data-ruang="$7" data-rak="$8" data-tingkat="$10" data-jumlah="$11">Edit</a>  <a href="javascript:void(0);" class="hapus_record btn btn-danger btn-xs" data-id="$1">Hapus</a>','id, kode_barang, nama_barang, nama_kategori, nama_jenis, lokasi, ruang, rak, tingkat, jumlah, keterangan');
 		return $this->datatables->generate();
 	}*/

 	//get dropdown barang
  function dd_barang()
    {
        // ambil data dari db
        /*$this->db->order_by('nama_barang', 'asc');
        $this->db->where('kategori_id = 1');
        $result = $this->db->get('barang');*/

        $this->db->select('kode_barang');
$this->db->order_by('kode_barang');
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


    //get dropdown kategori
  function dd_kategori()
    {
        // ambil data dari db
        $this->db->order_by('nama_kategori', 'asc');
        $result = $this->db->get('kategori');
        
        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $dd[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $dd[$row->id] = $row->nama_kategori;
            }
        }
        return $dd;
    }

    //get dropdown barang
  function dd_jenis()
    {
        // ambil data dari db
        $this->db->order_by('nama_jenis', 'asc');
        $result = $this->db->get('jenis');
        
        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $dd[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $dd[$row->id] = $row->nama_jenis;
            }
        }
        return $dd;
    }


     function save_kartu_stock($id, $kode_barang, $lokasi, $ruang, $rak, $tingkat, $jumlah, $keterangan, $created_by, $created_at)
     { 
     //function simpan data
    	$data = array(
      'id' => $id,
      'kode_barang' => $kode_barang,
      'lokasi' => $lokasi,
      'ruang' => $ruang,
      'rak' => $rak,
      'tingkat' => $tingkat,
      'jumlah' => $jumlah,
      'keterangan' => $keterangan,
      'created_by' => $this->session->userdata('ses_id'),
      'created_at' =>  date('Y-m-d H:i:s'),
      //'updated_by' => $this->session->userdata('ses_id'),
    );
    $this->db->insert('kartu_stock', $data);
  }

  function get_kartu_stock_by_id($id)
  {
  $hsl=$this->db->query("SELECT * FROM kartu_stock WHERE id='$id'");
        if($hsl->num_rows()>0){
            foreach ($hsl->result() as $data) {
                $hasil=array(
                    'id' => $data->id,
                    'kode_barang' => $data->kode_barang,
                    'lokasi' => $data->lokasi,
                    'ruang' => $data->ruang,
                    'rak' => $data->rak,
                    'tingkat' => $data->tingkat,
                    'jumlah' => $data->jumlah,
                    'keterangan' => $data->keterangan,
                    
                    
                    );
            }
        }
        return $hasil;
}

  function update_kartu_stock($id, $kode_barang, $lokasi, $ruang, $rak, $tingkat, $jumlah, $keterangan, $updated_by)
  {
    $data = array(
      'id' => $id,
      'kode_barang' => $kode_barang,
      'lokasi' => $lokasi,
      'ruang'     => $ruang,
      'rak'     => $rak,
      'tingkat'    => $tingkat,
      'jumlah' => $jumlah,
      'keterangan'     => $keterangan,
      'updated_by' => $this->session->userdata('ses_id'),
      //'updated_at' =>  'NOW()',
    );
    $this->db->where('id', $id);
    $this->db->update('kartu_stock', $data);
  }

  

  function delete_kartu_stock($id)
  {
    $hasil=$this->db->query("DELETE FROM kartu_stock WHERE id='$id'");
        return $hasil;
  }

  //rekap barang masuk


  

}