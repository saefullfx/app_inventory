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
        Tambah PO Unit Ke Supplier
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">PO Unit Keluar</a></li>
        <li class="active">tambah</li>
    </ol>
</section>


<!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
                <?php 
                                if(validation_errors() != false)
                                {
                                    ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo validation_errors(); ?>
                                    </div>
                                    <?php
                                }
                                ?>
            
                <form class="well form-horizontal" action="<?php echo site_url('admin/order/save_order_unit');?>" method="post">                         
 
                   <div class="form-group">
                       <label class="control-label col-xs-3" >Type Unit</label>
                        <div class="col-xs-9">
                        <select class="form-control select2" name="type_id" id="type_id"  style="width:335px;">
                            <option value="">Please Select</option>
                            <?php
                            foreach ($type_unit as $prov) {
                                ?>
                                <option <?php echo $type_selected == $prov->id ? 'selected="selected"' : '' ?>
                                    value="<?php echo $prov->id ?>"><?php echo $prov->nama_unit ?></option>
                                <?php
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
                                ?>
                                <!--di sini kita tambahkan class berisi id provinsi-->
                                <option <?php echo $model_selected == $kot->type_id ? 'selected="selected"' : '' ?>
                                    class="<?php echo $kot->type_id ?>" value="<?php echo $kot->id_model ?>"><?php echo $kot->model ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        </div>
                    </div>             
                    
                     <input name="status_id" value="4" class="form-control" type="hidden" style="width:335px;" required>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Pressure</label>
                        <div class="col-xs-9">
                            <input name="pressure" class="form-control" type="text" placeholder="Masukan Pressure" style="width:335px;" required>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Voltase</label>
                        <div class="col-xs-9">
                            <input name="voltase" class="form-control" type="text" placeholder="Masukan Voltase" style="width:335px;" required>
                        </div>
                    </div> 
                        
                  <div class="form-group">
                        <label class="control-label col-xs-3" >Jumlah</label>
                        <div class="col-xs-9">
                            <input name="jumlah" class="form-control" type="text" placeholder="Masukan Jumlah" style="width:335px;" required>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Supplier</label>
                        <div class="col-xs-9">
                          <?php
                                $dd_supplier_attribute = 'class="form-control select2" style="width:335px;" id="supplier_id"';
                                echo form_dropdown('supplier_id', $dd_supplier, $supplier_selected, $dd_supplier_attribute);
                            ?>
                        </div>
                    </div>   
                    
                     <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal PO</label>
                       <div class="col-xs-9">
                            <input name="tanggal_order" id="tanggal_order" class="form-control" placeholder="Masukan tanggal Order" style="width:335px;" required>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor PO</label>
                        <div class="col-xs-9">
                            <input name="nomor_po" id="nomor_po" class="form-control" type="text" placeholder="Masukan Nomor PO" style="width:335px;" required>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-xs-3" >Estimasi Unit Sampai</label>
                        <div class="col-xs-9">
                            <input name="tanggal" id="tanggal" class="form-control" type="text" placeholder="Masukan Estimasi Unit sampai" style="width:335px;" required>
                        </div>
                    </div>     

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <textarea name="keterangan" id="keterangan" class="form-control" type="text" placeholder="Masukan Keterangan" style="width:335px;" required> </textarea>
                        </div>
                    </div> 

                    <a href="<?php echo base_url().'index.php/admin/order/order_unit'?>" class="btn btn-danger"> Batal </a>
                    <button type="submit" class="btn btn-info">Simpan</button>
                        
                </div>
 
                
                    
                
            </form>
           </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        
  


 

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
            
            $('#tanggal_po_customer').datepicker({
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
            $("#model").chained("#type_id"); // disini kita hubungkan kota dengan provinsi
            $("#serial_number").chained("#model");
    </script>


        