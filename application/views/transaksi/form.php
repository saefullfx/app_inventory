<html>
<head>
  <title>Form Import</title>
  
  <!-- Load File jquery.min.js yang ada difolder js -->
 <script src="<?php echo base_url('kolam/AdminLTE-2.0.5/plugins/jQuery/jQuery-2.1.3.min.js') ?>"></script>
  <script>
  $(document).ready(function(){
    // Sembunyikan alert validasi kosong
    $("#kosong").hide();
  });
  </script>
</head>
<body>
  <h3>Form Import PO Sparepart Dari Customer</h3>
  <hr>
  
  <a href="<?php echo base_url("excel/format.xlsx"); ?>">Download Format</a>
  <br>
  <br>
  
  <!-- Buat sebuah tag form dan arahkan action nya ke controller ini lagi -->
  <form method="post" action="<?php echo base_url("index.php/admin/transaksi/form"); ?>" enctype="multipart/form-data">
    <!-- 
    -- Buat sebuah input type file
    -- class pull-left berfungsi agar file input berada di sebelah kiri
    -->
    <input type="file" name="file">
    
    <!--
    -- BUat sebuah tombol submit untuk melakukan preview terlebih dahulu data yang akan di import
    -->
    <input type="submit" name="preview" value="Preview">
  </form>
  
  <?php
  if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form 
    if(isset($upload_error)){ // Jika proses upload gagal
      echo "<div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload
      die; // stop skrip
    }
    
    // Buat sebuah tag form untuk proses import data ke database
    echo "<form method='post' action='".base_url("index.php/admin/transaksi/import")."'>";
    
    // Buat sebuah div untuk alert validasi kosong
    echo "<div style='color: red;' id='kosong'>
    Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
    </div>";
    
    echo "<table border='1' cellpadding='8'>
    <tr>
      <th colspan='7'>Preview Data</th>
    </tr>
    <tr>
      <th>Part Number</th>
      <th>Status id</th>
      <th>Customer id</th>
      <th>Jumlah</th>
      <th>Tanggal Order</th>
      <th>Nomor PO</th>
      <th>Keterangan</th>
    </tr>";
    
    $numrow = 1;
    $kosong = 0;
    
    // Lakukan perulangan dari data yang ada di excel
    // $sheet adalah variabel yang dikirim dari controller
    foreach($sheet as $row){ 
      // Ambil data pada excel sesuai Kolom
      $kode_barang = $row['A']; // Ambil data NIS
      $status_id = $row['B']; // Ambil data nama
      $customer_id = $row['C']; // Ambil data jenis kelamin
      $jumlah = $row['D']; // Ambil data alamat
      $tanggal_order = $row['E'];
      $nomor_po = $row['F'];
      $keterangan = $row['G'];
      
      // Cek jika semua data tidak diisi
      if($kode_barang == "" && $status_id == "" && $customer_id == "" && $jumlah == "" && $tanggal_order == "" && $nomor_po == "" && $keterangan == "")
        continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
      
      // Cek $numrow apakah lebih dari 1
      // Artinya karena baris pertama adalah nama-nama kolom
      // Jadi dilewat saja, tidak usah diimport
      if($numrow > 1){
        // Validasi apakah semua data telah diisi
        $kode_barang_td = ( ! empty($kode_barang))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
        $status_id_td = ( ! empty($status_id))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
        $customer_id_td = ( ! empty($customer_id))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
        $jumlah_td = ( ! empty($jumlah))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
        $tanggal_order_td = ( ! empty($tanggal_order))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
        $nomor_po_td = ( ! empty($nomor_po))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
        $keterangan_td = ( ! empty($keterangan))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
       
        
        // Jika salah satu data ada yang kosong
        if($kode_barang == "" or $status_id == "" or $customer_id == "" or $jumlah == "" or $tanggal_order == "" or $nomor_po == "" or $keterangan == ""){
          $kosong++; // Tambah 1 variabel $kosong
        }
        
        echo "<tr>";
        echo "<td".$kode_barang_td.">".$kode_barang."</td>";
        echo "<td".$status_id_td.">".$status_id."</td>";
        echo "<td".$customer_id_td.">".$customer_id."</td>";
        echo "<td".$jumlah_td.">".$jumlah."</td>";
        echo "<td".$tanggal_order_td.">".$tanggal_order."</td>";
        echo "<td".$nomor_po_td.">".$nomor_po."</td>";
        echo "<td".$keterangan_td.">".$keterangan."</td>";
        echo "</tr>";
      }
      
      $numrow++; // Tambah 1 setiap kali looping
    }
    
    echo "</table>";
    
    // Cek apakah variabel kosong lebih dari 0
    // Jika lebih dari 0, berarti ada data yang masih kosong
    if($kosong > 0){
    ?>  
      <script>
      $(document).ready(function(){
        // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
        $("#jumlah_kosong").html('<?php echo $kosong; ?>');
        
        $("#kosong").show(); // Munculkan alert validasi kosong
      });
      </script>
    <?php
    }else{ // Jika semua data sudah diisi
      echo "<hr>";
      
      // Buat sebuah tombol untuk mengimport data ke database
      echo "<button class='btn btn-info' type='submit' name='import'>Import</button>  ||| ";
      echo "<a class='btn btn-danger' href='".base_url("/admin/transaksi/po_sementara")."'>Cancel</a>";
    }
    
    echo "</form>";
  }
  ?>
</body>
</html>

