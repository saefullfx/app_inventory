
<!--tambahkan custom css disini-->
<!-- <link src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.css'?>" rel="stylesheet" type="text/css"> -->
<!-- Bootstrap 3.3.2 -->
        <link href="<?php echo base_url('kolam/AdminLTE-2.0.5/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
<link src="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">



     
    
        
        
                  
               
                <div class="box-body">
                  
                <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                  
                    <th>Nama Barang</th>
                    <th>Part Number</th>
                    
                    <th >Jumlah</th>                    
                </tr>
            </thead>
            <tbody id="show_data">
                 
            </tbody>
  </table>       



<!-- jQuery 2.1.3 -->
<script src="<?php echo base_url('kolam/AdminLTE-2.0.5/plugins/jQuery/jQuery-2.1.3.min.js') ?>"></script>
<script src="<?php echo base_url('kolam/AdminLTE-2.0.5/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datatables/jquery.dataTables.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.js'?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        tampil_data_stock_barang();   //pemanggilan fungsi tampil.
         
        $('#example1').dataTable();
          
        //fungsi tampil barang
        function tampil_data_stock_barang(){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo base_url()?>index.php/barang/barang/data_stock_barang',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                                '<td>'+data[i].nama_barang+'</td>'+
                                '<td>'+data[i].kode_barang+'</td>'+
                             
                              
                                     
                             
                                    '<td>'+

                                data[i].total+'</td>'+
                           
                                
                                
                                '</tr>';
                    }
                    $('#show_data').html(html);
                }
 
            });

        } 
       
 
    });



 
</script>
<!--tambahkan custom js disini-->
