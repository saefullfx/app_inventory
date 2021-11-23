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
        Tambah Unit Keluar
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Unit Keluar</a></li>
        <li class="active">add</li>
    </ol>
</section>


<!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  
                </div><!-- /.box-header -->
                <div class="box-body">
            
             <form class="well form-horizontal" action="<?php echo site_url('barang/unit/save_unit_keluar');?>" method="post">                           
 
                  <div class="form-group">
                       <label class="control-label col-xs-3" >Type Unit</label>
                        <div class="col-xs-9">
                        <select class="form-control select2" name="type_id" id="type"  style="width:335px;">
                            <option value="">Please Select</option>
                            <?php
                            foreach ($type_unit_keluar as $prov) {
                                if($prov->stock > 0){
                                        ?>
                                        <option <?php echo $type_unit_keluar_selected == $prov->type_id ? 'selected="selected"' : '' ?>
                                            value="<?php echo $prov->type_id ?>"><?php echo $prov->nama_unit ?></option>
                                        <?php
                                }
                            }
                            ?>
                        </select>
                        </div>
                    </div>

                    <div class="form-group">
                       <label class="control-label col-xs-3" >Model</label>
                        <div class="col-xs-9">
                        <select class="form-control select2" name="model_id" id="model"  style="width:335px;">
                            <option value="">Please Select</option>
                            <?php
                            foreach ($model_unit as $kot) {
                                 if($kot->stock > 0){
                                    ?>
                                    <!--di sini kita tambahkan class berisi id provinsi-->
                                    <option <?php echo $model_selected == $kot->type_id ? 'selected="selected"' : '' ?>
                                        class="<?php echo $kot->type_id ?>" value="<?php echo $kot->id_model ?>"><?php echo $kot->model ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        </div>
                    </div>   
                    
                    
                  <div class="form-group">
                       <label class="control-label col-xs-3" >Serial Number</label>
                        <div class="col-xs-9">
                        <select class="form-control select2" name="serial_number" id="serial_number"  style="width:335px;">
                            <option value="">Please Select</option>
                            <?php
                            foreach ($serial_number as $kot) {
                                 if($kot->stock > 0){
                                    ?>
                                    <!--di sini kita tambahkan class berisi id provinsi-->
                                    <option <?php echo $serial_number_selected == $kot->model_id ? 'selected="selected"' : '' ?>
                                        class="<?php echo $kot->model_id ?>" value="<?php echo $kot->serial_number ?>"><?php echo $kot->serial_number ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        </div>
                    </div> 
                    
                     <div class="form-group">
                        <label class="control-label col-xs-3" >Voltase</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_voltase_attribute = 'class="form-control select2" style="width:335px;"';
                                echo form_dropdown('voltase', $dd_voltase, $voltase_selected, $dd_voltase_attribute);
                            ?>
                        </div>
                    </div> 
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Pressure</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_pressure_attribute = 'class="form-control select2" style="width:335px;"';
                                echo form_dropdown('pressure', $dd_pressure, $pressure_selected, $dd_pressure_attribute);
                            ?>
                        </div>
                    </div> 

                    
                    <!--   <div class="form-group">
                       <label class="control-label col-xs-3" >Serial Number</label>
                         <div class="col-xs-9">
                            <input name="serial_number" id="serial_number" class="form-control" type="text" placeholder="Masukan Serial Number" style="width:335px;" required>
                        </div>
                    </div>  -->  
                        
                       
                            <input name="status_id" id="status_id" class="form-control" type="hidden" value="2" p style="width:335px;" required>

                             <div class="form-group">
                        <label class="control-label col-xs-3" >Customer</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_customer_attribute = 'class="form-control select2" style="width:335px;"';
                                echo form_dropdown('customer_id', $dd_customer, $customer_selected, $dd_customer_attribute);
                            ?>
                        </div>
                    </div> 

                     <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal PO</label>
                        <div class="col-xs-9">
                            <input name="tanggal_po_customer" id="" class="form-control" placeholder="Masukan Format tanggal Tahun/Bulan/Hari" style="width:335px;" required>
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
                            <input name="nomor_po" id="nomor_po" class="form-control" type="text" placeholder="Nomor PO" style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor Surat Jalan</label>
                        <div class="col-xs-9">
                            <input name="nomor_surat_jalan" id="nomor_surat_jalan" class="form-control" type="text" placeholder="Nomor Surat Jalan" style="width:335px;" required>
                        </div>
                    </div> 
                   
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal Pengiriman</label>
                        <div class="col-xs-9">
                            <input name="tanggal" id="" class="form-control" placeholder="Masukan Format tanggal Tahun/Bulan/Hari" style="width:335px;" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <input name="keterangan" id="keterangan" class="form-control" type="text" placeholder="Keterangan" style="width:335px;" required>
                        </div>
                    </div> 
                
                    <a href="<?php echo base_url().'index.php/barang/unit/unit_keluar'?>" class="btn btn-danger"> Batal </a>
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

        <script src="<?php echo base_url('assets/js/jquery.chained.min.js') ?>"></script>
         <script>
            $("#model").chained("#type"); 
            $("#pressure").chained("#model");
            $("#voltase").chained("#model");
            $("#serial_number").chained("#model");
    </script>