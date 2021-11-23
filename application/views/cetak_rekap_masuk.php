<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1 solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
</style>
</head>
<body>
  
  
    <h2><?php echo $ket; ?></h2>
    <h4> Rekap Barang Masuk </h4>
    <br /><br />
 <div style="overflow-x:auto;">   
  <table border="1">
      <tr>
        <th><b>No.</b></th> 
        <th ><b>Part Number</b></th>
        <th ><b>Nama Barang</b></th>
        <!-- <th ><b>Supplier</b></th> -->
        <th ><b>Jumlah</b></th>
        <th ><b>Bulan</b></th>             
        <th ><b>Tahun</b></th>
    </tr>

    <?php
    if( ! empty($report)){
    $no = 1;
      foreach($report as $data){
           // $tgl = date('d-m-Y', MONTH($data->tanggal));
            
        echo "<tr>";
        
       echo "<td >".$no."</td>";
       echo "<td >".$data->kode_barang."</td>";
       echo "<td >".$data->nama_barang."</td>";
       // echo "<td >".$data->nama_supplier."</td>";
           //echo "<td >".$tgl."</td>";
            echo "<td >".$data->jumlah."</td>";
            echo "<td>".$data->bulan."</td>";
        echo "<td>".$data->tahun."</td>";
            //echo "<td>".$data->keterangan."</td>";
        echo "</tr>";
        $no++;
       
      }
    }
    ?>
  </table>
</div>
</body>
</html>