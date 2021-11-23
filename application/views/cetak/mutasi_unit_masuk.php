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
  <table border="1" >
    <thead>
       <tr>
        <th>No.</th>
        <th>Type Unit</th>
        <th>Bulan</th>
        <th>Tahun</th>
        <th>Unit Masuk</th>
      </tr>
    </thead>
   
    <?php 
    $no = 1;
    $total = 0;
            foreach ($report as $data) {
               
       
            

        echo "<tr>";
        
       echo "<td align='center'>".$no."</td>";
       echo "<td >".$data->nama_unit."</td>";
       echo "<td >".$data->bulan."</td>";       
       echo "<td >".$data->tahun."</td>";
       echo "<td align='center'>".$data->unit_masuk."</td>";
       echo "</tr>";

        $no++;

    ?> 
    <?php 
    $total+=$data->unit_masuk;
            }
    
         echo " <tr font-style: bold;>";
             echo "<td colspan='4' align='center'><b>Jumlah Unit Masuk</b></td>";
            
            echo "<td align='center'><b>".$total."</b></td>";
            
        echo "</tr>";
     ?>  
     </table>


    
 
</div>
</body>
</html>