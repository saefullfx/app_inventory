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
        Tambah PO Unit Dari Customer
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">PO Unit Dari Customer</a></li>
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
            
                <form class="well form-horizontal" action="<?php echo site_url('barang/unit/save_po_unit');?>" method="post">                         
 
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
                    
                      <div class="form-group">
                        <label class="control-label col-xs-3" >Pressure</label>
                        <div class="col-xs-9">
                            <input name="pressure" id="pressure" class="form-control" type="text" placeholder="Pressure" style="width:335px;" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Voltase</label>
                        <div class="col-xs-9">
                            <input name="voltase" id="voltase" class="form-control" type="text" placeholder="Voltase" style="width:335px;" required>
                        </div>
                    </div>

                     <input name="status_id" id="status_id" class="form-control" type="hidden" value="5" style="width:335px;" required>

                      <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal PO</label>
                        <div class="col-xs-9">
                            <input name="tanggal_po_customer" id="tanggal_po_customer" class="form-control" placeholder="Masukan Tanggal PO" style="width:335px;" required>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor PO</label>
                        <div class="col-xs-9">
                            <input name="po_customer" id="po_customer" class="form-control" type="text" placeholder="Masukan Nomor PO" style="width:335px;" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Customer</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_customer_attribute = 'class="form-control select2" style="width:335px;" id="customer_id"';
                                echo form_dropdown('customer_id', $dd_customer, $customer_selected, $dd_customer_attribute);
                            ?>
                        </div>
                    </div> 

                                         
                           
                           <!--  <input name="progress" id="progress" class="form-control" type="hidden" value="Belum Dikirim" style="width:335px;" required> -->                  

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jumlah</label>
                        <div class="col-xs-9">
                            <input name="jumlah" id="jumlah" class="form-control" type="text" placeholder="Jumlah" style="width:335px;" required>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <textarea name="keterangan" id="keterangan" class="form-control" type="text" placeholder="Masukan Keterangan" style="width:335px;" required> </textarea>
                        </div>
                    </div> 

                    <a href="<?php echo base_url().'index.php/admin/order/po_unit'?>" class="btn btn-danger"> Batal </a>
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


        