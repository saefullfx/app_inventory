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
    <h4> Rekap Barang Keluar </h4>
    <br /><br />
 <div style="overflow-x:auto;">   
  <table border="1">
      <tr>
                    <th>Part Numbera</th>                   
                    
                    <th>Barang Masuk</th>
                    <th>Barang Keluar</th>                   
                    <th>Stock</th>
                    <th>Telah dipesan</th> 
                    <th>Order Stock</th> 
    </tr>

    <?php
    if( ! empty($report)){
    $no = 1;
      foreach($report as $data){
           // $tgl = date('d-m-Y', MONTH($data->tanggal));
            
        echo "<tr>";
        
       //echo "<td >".$no."</td>";
       echo "<td >".$data->kode_barang."</td>";
       //echo "<td >".$data->nama_barang."</td>";
       // echo "<td >".$data->nama_supplier."</td>";
           //echo "<td >".$tgl."</td>";
            echo "<td >".$data->barang_masuk."</td>";
            echo "<td>".$data->barang_keluar."</td>";
            echo "<td >".$data->total."</td>";
            echo "<td>".$data->po_sementara."</td>";
        echo "<td>".$data->order_barang."</td>";
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