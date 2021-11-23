<?php 
$this->load->view('template/head');
?>
<link src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datepicker/datepicker3.css'?>" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
     Fast, slow & dead stock
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'page'?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url().'index.php/report/hitung_sparepart_keluar'?>">Fast, slow & dead stock</a></li>
        <li class="active">list</li>
    </ol>
</section>
      
    
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Fast, slow & dead stock</h3>
                 <!--  <div class="pull-right"><a href="" class="btn btn-success" data-toggle="modal" data-target="#ModalaAdd"><span class="fa fa-plus"></span></a>
                  </div> -->

                
                </div><!-- /.box-header -->
                <div class="box-body">
                  
                <table id="example2" class="table table-bordered table-striped">
            <thead>
                <tr>            
                    <th>Nama Sparepart</th>
                    <th>Part Number</th>
                    <th>Jumlah</th>
                    <th>Rata-Rata</th>
                    <th>Leadtime</th>
                    <th>Demand +1 Month</th>
                    <th id="jm">Jumlah Minimum Stock</th>
                    <th>Tahun</th>
                    <th>Kategori SP</th>      
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

<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
      
<script type="text/javascript">
    $(document).ready(function(){
        data_master_unit();   //pemanggilan fungsi tampil.
         
        $('#example1').DataTable( {
            "scrollX": true
        } );

         $('#example2').dataTable({
         
        });
          
        //fungsi tampil barang
        function data_master_unit(){
            $.ajax({
                type  : 'GET',
                url   : '<?php echo base_url()?>index.php/report/data_hitung_sparepart_keluar',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                    var a = Math.floor(data[i].rata_rata) + Math.floor(data[i].rata_rata)*(4) + Math.floor(data[i].rata_rata)                    
                        if(data[i].jml_keluar == 0){
                            html += '<tr>'+
                                                
                                               
                                                '<td>'+data[i].nama_barang+'</td>'+
                                                '<td>'+data[i].kode_barang+'</td>'+
                                                '<td>'+data[i].jml_keluar+'</td>'+
                                                '<td>'+Math.floor(data[i].rata_rata)+'</small>'+'</td>'+
                                                '<td>'+Math.floor(data[i].rata_rata)*(4)+'</td>'+
                                                '<td>'+Math.floor(data[i].rata_rata)+'</small>'+'</td>'+
                                                '<td>'+(Math.floor(data[i].rata_rata)*(4)+Math.floor(data[i].rata_rata))+'</td>'+
                                               
                                                '<td>'+data[i].the_year+'</small>'+'</td>'+
                                                '<td>'+'<small class="label label-default">Dead Stock</small>'+'</td>'+
                                                
                                              

                                '</tr>';
                        }else if(data[i].jml_keluar <= 10){
                            html += '<tr>'+
                                                
                                                '<td>'+data[i].nama_barang+'</td>'+
                                                '<td>'+data[i].kode_barang+'</td>'+
                                                '<td>'+data[i].jml_keluar+'</td>'+
                                                '<td>'+Math.floor(data[i].rata_rata)+'</td>'+
                                                 '<td>'+Math.floor(data[i].rata_rata)*(4)+'</td>'+
                                               '<td>'+Math.floor(data[i].rata_rata)+'</small>'+'</td>'+
                                                '<td>'+(Math.floor(data[i].rata_rata)*(4)+Math.floor(data[i].rata_rata))+'</td>'+
                                                
                                                '<td>'+data[i].the_year+'</td>'+
                                                '<td>'+'<small class="label label-warning">Slow Moving</small>'+'</td>'+           

                                '</tr>';
                        }  else if(data[i].jml_keluar >= 10){
                             html += '<tr>'+
                                                
                                                '<td>'+data[i].nama_barang+'</td>'+
                                                '<td>'+data[i].kode_barang+'</td>'+
                                                '<td>'+data[i].jml_keluar+'</td>'+
                                                '<td>'+Math.floor(data[i].rata_rata)+'</td>'+
                                                '<td>'+Math.floor(data[i].rata_rata)*(4)+'</td>'+
                                               '<td>'+Math.floor(data[i].rata_rata)+'</small>'+'</td>'+
                                                '<td>'+(Math.floor(data[i].rata_rata)*(4)+Math.floor(data[i].rata_rata))+'</td>'+
                                                
                                                '<td>'+data[i].the_year+'</td>'+
                                                '<td>'+'<small class="label label-success">Fast Moving</small>'+'</td>'+
                                                
                                               

                                '</tr>';
                        }   
                    }
                    $('#show_data').html(html);
                } 
            });
        } 

        
 
 
        //Delete
        $('#btn_delete').on('click',function(){
            var id=$('#textid').val();
            $.ajax({
            type : "POST",
            url  : "<?php echo base_url('index.php/barang/rental/delete_rental')?>",
            dataType : "JSON",
                    data : {id:id},
                    success: function(data){
                            $('#ModalDelete').modal('hide');
                             data_master_unit();
                              location.reload();
                    }
                });
                return false;
            });

 
    });



 
</script>
<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>

