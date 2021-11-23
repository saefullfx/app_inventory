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
    <br /><br />
 <div style="overflow-x:auto;">   
  <table border="1">
      <tr>          
                    <th>Model</th>                   
                    <!-- <th>Nama Unit</th> -->
                    <th>Serial Number</th>
                    <th>Pressure</th>
                    <th>Unit Masuk</th>
                    <th>Unit Keluar</th>                   
                    <th>Stock</th>
                    <th>Unit Dipesan</th>
                    <th>Unit Order Stock</th>
    </tr>

    <?php
    if( ! empty($report)){
    $no = 1;
      foreach($report as $data){
           // $tgl = date('d-m-Y', MONTH($data->tanggal));
            
       echo "<tr>";
            //echo "<td>".$no."</td>";
            echo "<td>".$data->model."</td>";
            //echo "<td>".$data->nama_unit."</td>";
             echo "<td>".$data->serial_number."</td>";
            echo "<td>".$data->pressure."</td>";
            //echo "<td>".$data->nama_supplier."</td>";
            echo "<td>".$data->unit_masuk."</td>";
            echo "<td>".$data->unit_keluar."</td>";
            echo "<td>".$data->total."</td>";
            echo "<td>".$data->unit_dipesan."</td>";
            echo "<td>".$data->unit_order."</td>";
           
            echo "</tr>";
            $no++;
       
      }
    }
    ?>
  </table>
</div>
</body>
</html>