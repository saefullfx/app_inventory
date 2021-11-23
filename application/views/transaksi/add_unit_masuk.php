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
        Tambah Unit Masuk
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Unit Masuk</a></li>
        <li class="active">tambah</li>
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
             
             <form class="well form-horizontal" action="<?php echo site_url('barang/unit/save_unit_masuk');?>" method="post" novalidate>                           
 
                      <div class="form-group">
                       <label class="control-label col-xs-3" >Type Unit</label>
                        <div class="col-xs-9">
                        <select class="form-control select2" name="type_id" id="type"  style="width:400px;" required="">
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
                       <label class="control-label col-xs-3" >Model Unit</label>
                        <div class="col-xs-9">
                        <select class="form-control select2" name="model_id" id="model"  style="width:400px;">
                            <option value="">Please Select</option>
                            <?php
                            foreach ($model_unit_dd as $mod) {
                                ?>
                                <!--di sini kita tambahkan class berisi id provinsi-->
                                <option <?php echo $model_selected == $mod->type_id ? 'selected="selected"' : '' ?>
                                    class="<?php echo $mod->type_id ?>" value="<?php echo $mod->id_model ?>"><?php echo $mod->model ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        </div>
                    </div>

                   
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Pressure</label>
                        <div class="col-xs-9">
                            <input name="pressure" id="pressure" class="form-control" type="text" placeholder="Masukan Pressure" style="width:400px;" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Voltase</label>
                        <div class="col-xs-9">
                            <input name="voltase" id="voltase" class="form-control" type="text" placeholder="Masukan Voltase" style="width:400px;" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Serial Number</label>
                        <div class="col-xs-9">
                            <input name="serial_number" id="serial_number" class="form-control" type="text" placeholder="Masukan Serial Number" style="width:400px;" required>
                        </div>
                    </div>
                
                       
                            <input name="status_id" id="status_id" class="form-control" type="hidden" value="1" p style="width:400px;" required>
                  
                   <div class="form-group">
                        <label class="control-label col-xs-3" >Supplier</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_supplier_attribute = 'class="form-control select2" style="width:400px;"';
                                echo form_dropdown('supplier_id', $dd_supplier, $supplier_selected, $dd_supplier_attribute);
                            ?>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal PO Unit</label>
                        <div class="col-xs-9">
                            <input name="tanggal_order" id="" class="form-control" placeholder="Contoh Format Tanggal 2019/10/20 (Tahun/Bulan/Hari)" style="width:400px;" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jumlah</label>
                        <div class="col-xs-9">
                            <input name="jumlah" id="tingkat" class="form-control" type="text" placeholder="Masukan Jumlah Unit Masuk" style="width:400px;" required>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor PO Unit</label>
                        <div class="col-xs-9">
                            <input name="nomor_po" id="nomor_po" class="form-control" type="text" placeholder="Masukan Nomor PO Unit" style="width:400px;" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal Masuk</label>
                        <div class="col-xs-9">
                            <input name="tanggal" id="" class="form-control" placeholder="Contoh Format Tanggal 2019/10/20 (Tahun/Bulan/Hari)" style="width:400px;" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Status Unit</label>
                        <div class="col-xs-9">
                    <select class="form-control select2" name="status_pemesanan" id="status_pemesanan" style="width:400px;">
                        <option seelcted value="">Please Select</option>
                      <option value="Stock">Stock</option>
                      <option value="Dipesan">Dipesan</option>                      
                    </select>
                        </div>
                    </div> 

                    <div class="form-group" id="input-customer">
                        <label class="control-label col-xs-3" >Customer</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_customer_attribute = 'class="form-control select2" style="width:400px;" id="customer_id"';
                                echo form_dropdown('customer_id', $dd_customer, $customer_selected, $dd_customer_attribute);
                            ?>
                        </div>
                    </div> 

                    <div class="form-group" id="input-penawaran">
                        <label class="control-label col-xs-3" >Nomor Penawaran</label>
                        <div class="col-xs-9">
                            <input name="nomor_penawaran" id="nomor_penawaran" class="form-control" placeholder="Masukan Nomor Penawaran" style="width:400px;" required>
                        </div>
                    </div>

                     <div class="form-group" id="input-pocustomer">
                        <label class="control-label col-xs-3" >PO Customer</label>
                        <div class="col-xs-9">
                            <input name="po_customer" id="po_cutsomer" class="form-control" placeholder="Masukan PO Customer" style="width:400px;" required>
                        </div>
                    </div>

                    <div class="form-group" id="input-tanggalpocustomer">
                        <label class="control-label col-xs-3" >Tanggal PO Customer</label>
                        <div class="col-xs-9">
                            <input name="tanggal_po_customer" id="tanggal_po_customer" class="form-control" placeholder="Contoh Format Tanggal 2019/10/20 (Tahun/Bulan/Hari)" style="width:400px;" required>
                        </div>
                    </div>
                            
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <input name="keterangan" id="keterangan" class="form-control" type="text" placeholder="Masukan Keterangan" style="width:400px;" required>
                        </div>
                    </div> 
                
                    <a href="<?php echo base_url().'index.php/barang/unit/unit_masuk'?>" class="btn btn-danger"> Batal </a>
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
            $("#model").chained("#type"); // disini kita hubungkan kota dengan provinsi
            $("#serial_number").chained("#model");
           
        </script>
        
        <script>
            $(document).ready(function()
            { 
            $('#input-customer, #input-penawaran, #input-pocustomer, #input-tanggalpocustomer').hide(); 
            $('#status_pemesanan').change(function(){ // Ketika user memilih filter
                if($(this).val() == 'Dipesan'){ 
                  
                    $('#input-customer, #input-penawaran, #input-pocustomer, #input-tanggalpocustomer').show();
                }else{
                    $('#input-customer, #input-penawaran, #input-pocustomer, #input-tanggalpocustomer').hide();
                }
    
                $(' #input-customer select, #input-penawaran select, #input-pocustomer select, #input-tanggalpocustomer select').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
            })
            })
        </script>