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
        Add Barang Keluar
        <small>Create barang keluar</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Barang Keluar</a></li>
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
                    <p>Jika tidak ada nomor PO</p>
                    <p> No Surat Jalan, Tanggal Pengiriman dikosongkan dan Status Order Barang Pending.</p>
                    <p>Perhatikan huruf besar kecil, spasi dan lain-lain ketika mengisi <b>PART NUMBER</b></p>
                  </div>-->
                </div><!-- /.box-header -->
                <div class="box-body">
            
             <form class="well form-horizontal" action="<?php echo site_url('admin/transaksi/save_barang_keluar');?>" method="post">                           
 
                    <!--<div class="form-group">
                        <label class="control-label col-xs-3" >Nama Barang</label>
                        <div class="col-xs-9">
                          <?php
                                //$dd_barang_attribute = 'class="form-control select2" style="width:335px;"';
                               // echo form_dropdown('kode_barang', $dd_barang, $barang_selected, $dd_barang_attribute);
                            ?>
                        </div>
                    </div>  -->
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Part Number</label>
                        <div class="col-xs-9">
                           
                             <?php
                                $dd_barang_attribute = 'class="form-control select2" style="width:335px;" id="kode_barang2"';
                                echo form_dropdown('kode_barang', $kode_barang, $kode_barang_selected, $dd_barang_attribute);
                            ?>
                       
                        </div>
                    </div> 
                    
                    
                        
                       
                            <input name="status_id" id="status_id" class="form-control" type="hidden" value="2" p style="width:335px;" required>
                       
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Customer</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_customer_attribute = 'class="form-control select2" style="width:335px;" id=customer_id"';
                                echo form_dropdown('customer_id', $dd_customer, $customer_selected, $dd_customer_attribute);
                            ?>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jumlah</label>
                        <div class="col-xs-9">
                            <input name="jumlah" id="tingkat" class="form-control" type="text" placeholder="Jumlah" style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor PO</label>
                        <div class="col-xs-9">
                            <input name="nomor_po" id="nomor_po" class="form-control" type="text" placeholder="nomor_po" style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal Pemesanan</label>
                        <div class="col-xs-9">
                            <input name="tanggal_order" id="tanggal_order" class="form-control" placeholder="Tanggal Pemesanan" style="width:335px;" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor Surat Jalan</label>
                        <div class="col-xs-9">
                            <input name="nomor_surat_jalan" id="nomor_surat_jalan" class="form-control" type="text" placeholder="Nomor Surat Jalan" style="width:335px;">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal Pengiriman</label>
                        <div class="col-xs-9">
                            <input name="tanggal" id="tanggal" class="form-control" placeholder="tanggal" style="width:335px;">
                        </div>
                    </div>
                   <!--<div class="form-group">
                        <label class="control-label col-xs-3" >Status</label>
                        <div class="col-xs-9">
                           <select name="status_order" id="status_order" class="form-control" style="width:335px;" required>
                            <option value="">Pilih Status Order</option>
                                <option value="0">OPEN</option>
                                <option value="1">CLOSE</option>
                            </select>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <input name="keterangan" id="keterangan" class="form-control" type="text" placeholder="Keterangan" style="width:335px;">
                        </div>
                    </div> 
                
                    <a href="<?php echo base_url().'index.php/admin/transaksi/barang_keluar'?>" class="btn btn-danger"> Batal </a>
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
        