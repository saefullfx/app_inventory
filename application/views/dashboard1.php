<?php
$this->load->view('template/head');
?>

<!--tambahkan custom css disini-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Home
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        
    </ol>
</section>



 <section class="content">
     <div class="row">        
        <div class="col-md-12">
            <!-- PRODUCT LIST -->
            <div class="box">
              
                 <div class="callout callout-success" style="margin-bottom: 0!important;">                                           
                    <h4>Selamat datang,  <b><?php echo $this->session->userdata('ses_nama');?></b></h4>
                    <p> Silahkan mengelola aplikasi inventory kontrol dengan menggunakan menu-menu yang sudah disediakan.</p> 
                </div> 
            </div><!-- /.box -->
        </div><!-- /.col -->
        
    </div><!-- /.row -->
    
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="<?php echo base_url('assets/image/900x500/satu.jpg') ?>" alt="First slide">

                    <div class="carousel-caption">
                      First Slide
                    </div>
                  </div>
                  <div class="item">
                    <img src="http://placehold.it/900x500/3c8dbc/ffffff&text=I+Love+Bootstrap" alt="Second slide">

                    <div class="carousel-caption">
                      Second Slide
                    </div>
                  </div>
                  <div class="item">
                    <img src="http://placehold.it/900x500/f39c12/ffffff&text=I+Love+Bootstrap" alt="Third slide">

                    <div class="carousel-caption">
                      Third Slide
                    </div>
                  </div>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- END ACCORDION & CAROUSEL-->
        
    

    <!-- Small boxes (Stat box) -->
   <!-- <div class="row">
      <div class="col-lg-3 col-xs-6">
            // small box
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3> <?php echo $total_item; ?> </h3>
                    <p>Item Sparepart</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="<?php echo base_url().'index.php/page/read_barang'?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"> </i></a>
            </div>
        </div> 
        <div class="col-lg-3 col-xs-6">
           
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo $total_item_unit; ?></h3>
                    <p>Item Unit</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
               <a href="<?php echo site_url('/barang/unit/data_unit')?>"  class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?php echo $jumlah_user; ?></h3>
                    <p>Total User</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#"  class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><h3><?php echo $jumlah_customer; ?></h3></h3>
                    <p>Total Customer</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div> -->
    <!-- Main row -->

    
          
            
</section>



<?php
$this->load->view('template/js');
?>

<!--tambahkan custom js disini-->
<!-- jQuery UI 1.11.2 -->
<script src="<?php echo base_url('kolam/js/jquery-ui.min.js') ?>" type="text/javascript"></script>
<!--tambahkan custom js disini-->

<script type="text/javascript" src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datatables/jquery.dataTables.js'?>">  
</script>
<script type="text/javascript" src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.js'?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        tampil_data_stock_barang();   //pemanggilan fungsi tampil.
         
        $('#example1').dataTable();
          
        //fungsi tampil barang
        //fungsi tampil barang
        function tampil_data_stock_barang(){
            $.ajax({
                type  : 'GET',
                url   : '<?php echo base_url()?>page/master_stock_sparepart',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                                                        
                                '<td>'+data[i].kode_barang+'</td>'+
                                '<td>'+data[i].keterangan+'</td>'+
                                '<td>'+data[i].nama_barang+'</td>'+
                                '<td>'+data[i].ready_stock+'</td>'+

                                '</tr>';
                    }
                    $('#show_data').html(html);
                }
 
            });

        }
    }); 
</script>

<script type="text/javascript">
    $(document).ready(function(){
        tampil_data_stock_unit();   //pemanggilan fungsi tampil.
         
        $('#example2').dataTable();
          
        //fungsi tampil barang
        //fungsi tampil barang
        function tampil_data_stock_unit(){
            $.ajax({
                type  : 'GET',
                url   : '<?php echo base_url()?>page/master_stock_unit',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                                                        
                                '<td>'+data[i].nama_unit+'</td>'+
                                '<td>'+data[i].model+'</td>'+
                                '<td>'+data[i].total+'</td>'+
                                '</tr>';
                    }
                    $('#show_data2').html(html);
                }
 
            });

        }
    }); 
</script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('kolam/AdminLTE-2.0.5/dist/js/pages/dashboard.js') ?>" type="text/javascript"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('kolam/AdminLTE-2.0.5/dist/js/demo.js') ?>" type="text/javascript"></script>

<?php
$this->load->view('template/foot');
?>