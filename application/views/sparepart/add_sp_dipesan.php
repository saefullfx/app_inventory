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
        Add Sparepart yang dipesan
        <small>Create Sparepart yang dipesan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Sparepart yang dipesan</a></li>
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
               <form class="well form-horizontal" action="<?php echo site_url('sparepart/save_sp_dipesan') ?>" method="post"> 
                                                         
                <input name="status_id" id="status_id" class="form-control" type="hidden" value="3" style="width:335px;" required>                
                    
                    <div class="form-group">
                        <!-- <label class="control-label col-xs-3" >Part Number *</label> -->
                        <label class="control-label col-xs-3" for="name">Part Number *</label>
                        <div class="col-xs-9">
                          <?php
                                $dd_barang_attribute = 'class="form-control select2" style="width:335px;" required';
                                echo form_dropdown('kode_barang', $dd_barang, $barang_selected, $dd_barang_attribute);
                            ?>
                        </div>
                    </div>  
                       
                         
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Customer *</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_customer_attribute = 'class="form-control select2" style="width:335px;" id=customer_id required';
                                echo form_dropdown('customer_id', $dd_customer, $customer_selected, $dd_customer_attribute);
                            ?>
                        </div>
                    </div> 



                    <div class="form-group">
                        <label class="control-label col-xs-3" for="jumlah">Jumlah *</label>
                        <div class="col-xs-9">
                            <input class="form-control" name="jumlah" <?php echo form_error('jumlah') ? 'is-invalid':'' ?> id="jumlah"  type="number" min="0" placeholder="Jumlah" style="width:335px;" required>
                        </div>
                        <div class="invalid-feedback">
                            <?php echo form_error('jumlah') ?>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" for="nomor_po">Nomor PO *</label>
                        <div class="col-xs-9">
                            <input class="form-control" name="nomor_po" <?php echo form_error('nomor_po') ? 'is-invalid':'' ?> id="nomor_po" type="text" placeholder="Nomor PO" style="width:335px;" required>
                        </div>
                        <div class="invalid-feedback">
                            <?php echo form_error('nomor_po') ?>
                        </div>
                    </div> 

                     <div class="form-group">
                        <label class="control-label col-xs-3" for="tanggal_order">Tanggal PO *</label>
                        <div class="col-xs-9">
                            <input class="form-control" name="tanggal_order" <?php echo form_error('tanggal_order') ? 'is-invalid':'' ?> id="tanggal_order" placeholder="Tanggal Purchase Order" style="width:335px;" required>
                        </div>
                        <div class="invalid-feedback">
                            <?php echo form_error('tanggal_order') ?>
                        </div>
                    </div>
                                        
                    <div class="form-group">
                        <label class="control-label col-xs-3" for="keterangan">Keterangan *</label>
                        <div class="col-xs-9">
                            <input class="form-control" name="keterangan" <?php echo form_error('keterangan') ? 'is-invalid':'' ?> id="keterangan" type="text" placeholder="Keterangan" style="width:335px;" required>
                        </div>
                        <div class="invalid-feedback">
                            <?php echo form_error('keterangan') ?>
                        </div>
                    </div> 
                
                    <a href="<?php echo base_url().'sparepart/sp_dipesan'?>" class="btn btn-danger"> Batal </a>
                    <input class="btn btn-primary" type="submit" name="btn" value="Simpan"/>
                
            </form>
                        <div class="card-footer small text-muted">
                           <b> * Required fields </b>
                        </div>
           </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
      
      </div>      
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

         <script src="<?php echo base_url('assets/js/jquery.chained.min.js') ?>"></script>
        <script>
            $("#kode_barang").chained("#type"); // disini kita hubungkan kota dengan provinsi
           
    </script>
        