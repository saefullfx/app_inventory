<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datepicker/datepicker3.css'?>" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Add Item Spare part
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Item spare part</a></li>
        <li class="active">add</li>
    </ol>
</section>


<!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                     
                      
                   <!-- <div class="callout callout-info" style="margin-bottom: 0!important;">                                           
            <h4><i class="fa fa-info"></i> Note:</h4>
                    <p>Jika barang PO sementara</p>
                    <p> No Surat Jalan, Tanggal Pengiriman dikosongkan dan Status Order Barang Pending.</p>
                    <p>Perhatikan huruf besar kecil, spasi dan lain-lain ketika mengisi <b>PART NUMBER</b></p>
                  </div> -->
              
                </div><!-- /.box-header -->

                <div class="box-body">
            
                <form class="well form-horizontal" action="<?php echo site_url('page/simpan_item_sparepart');?>" method="post">                           
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Part Number</label>
                        <div class="col-xs-9">
                            <input name="kode_barang" id="kode_barang" class="form-control" type="text" placeholder="Part Number" style="width:335px;" required>
                        </div>
                    </div>                       
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Barang</label>
                        <div class="col-xs-9">
                            <input name="nama_barang" id="nama_barang" class="form-control" type="text" placeholder="Nama Barang" style="width:335px;" required>
                        </div>
                    </div> 
                
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jenis</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_jenis_attribute = 'class="form-control select2" id="jenis_id" style="width:335px;"';
                                echo form_dropdown('jenis_id', $dd_jenis, $jenis_selected, $dd_jenis_attribute);
                            ?>
                        </div>
                    </div> 
                   
                   <div class="form-group">
                        <label class="control-label col-xs-3" >Part Number Persamaan</label>
                        <div class="col-xs-9">
                            <input name="keterangan" id="keterangan" class="form-control" type="text" placeholder="Keterangan" style="width:335px;" required>
                        </div>
                    </div>  
                
                    <a href="<?php echo base_url().'index.php/page/item_sparepart'?>" class="btn btn-danger"> Batal </a>
                    <button type="submit" class="btn btn-info">Simpan</button>
                
            </form>
           </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
      
      </div><!-- /.content-wrapper -->           
            

</section><!-- /.content -->
 

<?php 
    $this->load->view('template/js');
?>
        <script src="<?php  echo base_url();?>kolam/AdminLTE-2.0.5/plugins/datepicker/bootstrap-datepicker.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script>
            $(function () {
            //Date picker
            $('#tanggal').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true    });   

            $('#tanggal_order').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true    }); 
            });

                
        

            $(document).ready(function () {
                $(".select2").select2({
                    placeholder: "Please Select"
                });
            });


        </script>

        <script>
            
        </script>
        