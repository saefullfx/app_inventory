<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<!-- <link src="<?php //echo base_url().'kolam/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.css'?>" rel="stylesheet" type="text/css"> -->

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Stock Sparepart
        <small>data list stock sparepart</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Stock sparepart</a></li>
        <li class="active">list</li>
    </ol>
</section>
      
    
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Hover Data Table</h3>
                  
                </div><!-- /.box-header -->
                <div class="box-body">
                  
                <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Part Number</th>
                    <th>Part Number Persamaan</th>
                    <th>Nama Barang</th>
                    <th>Stock</th>
                   <!--<th>Telah dipesan</th>                  
                    <th id="jumlah">Stock Ready</th>  -->
                                   
                </tr>
            </thead>
            <tbody id="show_data">
                 
            </tbody>
  </table>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
      
      </div><!-- /.content-wrapper -->           
            

</section><!-- /.content -->


       



<?php 
$this->load->view('template/js');
?>
<script type="text/javascript" src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datatables/jquery.dataTables.js'?>">
    
</script>
<script type="text/javascript" src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.js'?>">
    
</script>
<script type="text/javascript">
    $(document).ready(function(){
        tampil_data_barang_ready();   //pemanggilan fungsi tampil.
         
        $('#example1').dataTable();
          
        //fungsi tampil barang
        function tampil_data_barang_ready(){
            $.ajax({
                type  : 'GET',
                url   : '<?php echo base_url()?>index.php/barang/barang/data_barang_ready',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                       var datai = data[i].stock;
                       var datab = data[i].Dipesan;
                       var ab = datai - datab;
                       //if(datai <= 5){
                             html += '<tr>'+
                                    '<td>'+data[i].kode_barang+'</td>'+
                                    '<td>'+data[i].keterangan+'</td>'+
                                    '<td>'+data[i].nama_barang+'</td>'+
                                    '<td>'+data[i].stock+'</td>'+
                                    /*'<td>'+data[i].Dipesan+'</td>'+
                                    '<td>'+ab+'</td>'+*/
                                 '</tr>';
                        //}else{
                            /*html += '<tr>'+
                                 '<td>'+data[i].kode_barang+'</td>'+
                                 '<td>'+data[i].kode_baranglama+'</td>'+
                                '<td>'+data[i].nama_barang+'</td>'+  
                                '<td>'+data[i].barang_masuk+'</td>'+
                                '<td>'+data[i].barang_keluar+'</td>'+                             
                                    '<td>'+data[i].total+'</td>'+   
                                                       
                                '</tr>';
                        }                     */                                 
                    }
                    $('#show_data').html(html);
                }
 
            });

        } 
       
 
    });



 
</script>
<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>