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
            
               <form class="well form-horizontal" action="<?php echo site_url('admin/transaksi/save_po_sementara');?>" method="post">        
                   
                                                         
                            <input name="status_id" id="status_id" class="form-control" type="hidden" value="3" style="width:335px;" required>
                  
                                      
 
                    
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Part Number *</label>
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
                        <label class="control-label col-xs-3" >Jumlah *</label>
                        <div class="col-xs-9">
                            <input name="jumlah" id="jumlah" class="form-control" type="text" placeholder="Jumlah" style="width:335px;" required>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor PO *</label>
                        <div class="col-xs-9">
                            <input name="nomor_po" id="nomor_po" class="form-control" type="text" placeholder="nomor_po" style="width:335px;" required>
                        </div>
                    </div> 

                     <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal Order *</label>
                        <div class="col-xs-9">
                            <input name="tanggal_order" id="tanggal_order" class="form-control" placeholder="Tanggal Pemesanan" style="width:335px;" required>
                        </div>
                    </div>
                    
                   
                    
                      <!-- <div class="form-group">
                        <label class="control-label col-xs-3" >Status Pemesanan</label>
                        <div class="col-xs-9">
                           <select name="status_order" id="status_order" class="form-control" style="width:335px;" required>
                            <option value="">Pilih Status Order</option>
                                <option value="0">Pending</option>
                                <option value="1">Selesai</option>
                            </select>
                        </div>
                    </div> -->

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan *</label>
                        <div class="col-xs-9">
                            <input name="keterangan" id="keterangan" class="form-control" type="text" placeholder="Keterangan" style="width:335px;" required>
                        </div>
                    </div> 
                
                    <a href="<?php echo base_url().'index.php/admin/transaksi/sp_dipesan'?>" class="btn btn-danger"> Batal </a>
                    <button type="submit" class="btn btn-info">Simpan</button>
                
            </form>
           </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
      
      </div><!--         
            

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
        