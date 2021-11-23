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
  
    <h3><?php echo $ket; ?></h3>
    <br /><br />

  <div style="overflow-x:auto;">   

   <table border="1" width="100%">
      <tr>
       
        <th><b>Model</b></th>
        <th><b>Nama Unit</b></th>
        <th><b>Supplier</b></th>
        <th><b>Tanggal</b></th>
        <th><b>Jumlah</b></th>
        <!-- <th><b>Nomor PO</b></th>
        <th><b>Nomor Surat jalan</b></th>   -->     
        <th><b>Keterangan</b></th>
    </tr>


    <?php
    if( ! empty($report)){
      $no = 1;
      foreach($report as $data){
            $tgl = date('d-m-Y', strtotime($data->tanggal));
            
        echo "<tr>";
        
        echo "<td>".$data->model."</td>";
       echo "<td>".$data->nama_unit."</td>";
        echo "<td>".$data->nama_supplier."</td>";
           echo "<td>".$tgl."</td>";
            echo "<td>".$data->jumlah."</td>";
            /*echo "<td>".$data->nomor_po."</td>";
        echo "<td>".$data->nomor_surat_jalan."</td>";*/
            echo "<td>".$data->keterangan."</td>";
        echo "</tr>";
        $no++;
      }
    }
    ?>
   </table>
</div>
</body>
</html>