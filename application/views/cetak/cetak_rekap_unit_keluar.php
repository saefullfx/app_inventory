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
        <th><b>No.</b></th> 
        <th ><b>Model</b></th>
        <th ><b>Nama Unit</b></th>
        
         <th ><b>Serial Number</b></th>
         <th>Pressure</th>
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
       echo "<td >".$data->model."</td>";
       echo "<td >".$data->nama_unit."</td>";
     
        //echo "<td >".$tgl."</td>";
          echo "<td >".$data->serial_number."</td>";
            echo "<td >".$data->pressure."</td>";
            echo "<td >".$data->unit_masuk."</td>";
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