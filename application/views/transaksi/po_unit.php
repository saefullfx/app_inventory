<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datepicker/datepicker3.css'?>" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
       PO Unit dari Customer
        <small>data list PO masuk</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">PO masuk</a></li>
        <li class="active">list</li>
    </ol>
</section>
      
    <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"></h3>
                  <!-- <div class="pull-right"><a href="" class="btn btn-success" data-toggle="modal" data-target="#ModalaAdd">
                    <span class="fa fa-plus"></span></a></div> -->
                    <div class="pull-right"><a href="<?php echo base_url().'index.php/admin/order/add_po_customer'?>" class="btn  btn-success"  ><span class="fa fa-plus"></span> </a></div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  
                <table id="example1" class="table table-bordered table-striped display nowrap" width="100%">
                <thead>
                    <tr>                    
                            <th>Type Unit</th>
                            <th>Model</th>
                            <th>Pressure</th>
                            <th>Voltase</th> 
                            <th>Jumlah</th>
                            <th>Unit Sudah Dikirim</th>
                            <th>Unit Belum Dikirim</th>
                            <th>Customer</th>
                            <th>Nomor PO Customer</th>
                            <th>Tanggal PO</th>                                      
                                                              
                            <th>Keterangan</th>
                            <th style="text-align: right; width: 100px">Aksi</th>
                             <!-- <th>Cek</th> -->
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


<!-- MODAL ADD -->
        <div class="modal fade" id="ModalaAdd" tabindex="" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Tambah PO Dari Customer</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">

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

                      <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal PO</label>
                        <div class="col-xs-9">
                            <input name="tanggal_po_customer" id="tanggal_po_customer" class="form-control" placeholder="Tanggal POr" style="width:335px;" required>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor PO</label>
                        <div class="col-xs-9">
                            <input name="po_customer" id="po_customer" class="form-control" type="text" placeholder="nomor_po" style="width:335px;" required>
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

                                         
                            <input name="status_id" id="status_id" class="form-control" type="hidden" value="5" p style="width:335px;" required>
                           <!--  <input name="progress" id="progress" class="form-control" type="hidden" value="Belum Dikirim" style="width:335px;" required> -->                  

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jumlah</label>
                        <div class="col-xs-9">
                            <input name="jumlah" id="jumlah" class="form-control" type="text" placeholder="Jumlah" style="width:335px;" required>
                        </div>
                    </div> 

                   
                   <!--  <div class="form-group">
                       <label class="control-label col-xs-3" >Status Barang</label>
                        <div class="col-xs-9">
                        <select class="form-control select2" name="status_barang" id="status_barang"  style="width:335px;">
                            <option value="">Please Select</option>
                            <option value="Indent">Indent</option>
                            <option value="Ready">Ready</option>
                            
                        </select>
                        </div>
                    </div> -->

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <input name="keterangan" id="keterangan" class="form-control" type="text" placeholder="Keterangan" style="width:335px;" required>
                        </div>
                    </div>  
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" id="btn_simpan">Simpan</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <!--END MODAL ADD-->

<!-- MODAL ADD Unit Keluar -->
        <div class="modal fade" id="ModalAddUnitKeluar" tabindex="" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Unit Keluar 
                            <?php
                                $dd_type_unit_attribute = 'class="form-control" style="width:335px;" id="type_idkel1" disabled';
                                echo form_dropdown('type_idkel', $dd_type_unit, $type_unit_selected, $dd_type_unit_attribute);
                            ?>

                            <?php
                                $dd_model_unit_attribute = 'class="form-control" style="width:335px;" id="model_idkel1" disabled';
                                echo form_dropdown('model_idkel', $dd_model_unit, $model_unit_selected, $dd_model_unit_attribute);
                            ?>
                        </h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group">
                       <label class="control-label col-xs-3" >Type Unit</label>
                        <div class="col-xs-9">
                        <select class="form-control select2" name="type_idkeluar" id="type_idkeluar1"  style="width:335px;">
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
                        <select class="form-control select2" name="model_idkeluar" id="model_idkeluar1"  style="width:335px;">
                            <option value="">Please Select</option>
                            <?php
                            foreach ($model_unit as $kot) {
                                 if($kot->stock > 0){
                                    ?>
                                   
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
                        <select class="form-control select2" name="serial_numberkeluar" id="serial_numberkeluar1"  style="width:335px;">
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
                                $dd_voltase_attribute = 'class="form-control select2" style="width:335px;" id="voltasekeluar1"';
                                echo form_dropdown('voltasekeluar', $dd_voltase, $voltase_selected, $dd_voltase_attribute);
                            ?>
                        </div>
                    </div> 
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Pressure</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_pressure_attribute = 'class="form-control select2" style="width:335px;" id="pressurekeluar1"';
                                echo form_dropdown('pressurekeluar', $dd_pressure, $pressure_selected, $dd_pressure_attribute);
                            ?>
                        </div>
                    </div> 


                         <div class="form-group">
                            <label class="control-label col-xs-3" >Jumlah</label>
                            <div class="col-xs-9">
                                <input name="jumlahkeluar" id="jumlahkeluar1" class="form-control" value="1" type="text" placeholder="Masukan Jumlah" style="width:335px;" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-3" >Customer</label>
                            <div class="col-xs-9">
                                <?php
                                    $dd_customer_attribute = 'class="form-control" style="width:335px;" id="customer_idkeluar1" disabled';
                                    echo form_dropdown('customer_idkeluar', $dd_customer, $customer_selected, $dd_customer_attribute);
                                ?>
                            </div>
                        </div> 

                        <div class="form-group">
                            <label class="control-label col-xs-3" >Nomor PO Customer</label>
                            <div class="col-xs-9">
                                <input name="po_customerkeluar" id="po_customerkeluar1" class="form-control" placeholder="Masukan Nomor PO Dari Customer" style="width:335px;" required>
                            </div>
                        </div> 

                     <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal PO</label>
                        <div class="col-xs-9">
                            <input name="tanggal_po_customerkeluar" id="tanggal_po_customerkeluar1" class="form-control" placeholder="Masukan Tanggal PO Dari Customer Format Tahun/Bulan/Hari" style="width:335px;" required>
                        </div>
                    </div>                    

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor Surat Jalan</label>
                        <div class="col-xs-9">
                            <input name="nomor_surat_jalan" id="nomor_surat_jalan1" class="form-control" type="text" placeholder="Masukan Nomor Surat Jalan" style="width:335px;" required>
                        </div>
                    </div>
                   
                     <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal Pengiriman</label>
                        <div class="col-xs-9">
                            <input name="tanggalkeluar" id="tanggalkeluar1" class="form-control" type="text" placeholder="Masukan Tanggal Pengiriman Format Tahun/Bulan/Hari" style="width:335px;" required>
                        </div>
                    </div>              
                    
                    <input name="status_idkeluar" id="status_idkeluar1" class="form-control" type="hidden" value="2" style="width:335px;" required>
                    <input name="po_masuk_idkeluar" id="po_masuk_idkeluar1" class="form-control" type="hidden" value="" style="width:335px;" required>
                                                 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <input name="keterangankeluar" id="keterangankeluar1" class="form-control" type="text" placeholder="Masukan Keterangan" style="width:335px;" required>
                        </div>
                    </div>  
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" id="btn_simpan2">Simpan</button>
                </div>
            </form>
            </div>
            </div>
        </div>
         <!-- MODAL ADD Unit Keluar -->


        <!-- MODAL EDIT -->
        <div class="modal fade" id="ModalEdit" tabindex="" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Ubah PO dari Customer</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">

                      <div class="form-group">
                       <label class="control-label col-xs-3" >Type Unit</label>
                        <div class="col-xs-9">
                        <select class="form-control select2" name="type_idget" id="typepost"  style="width:335px;">
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
                        <select class="form-control select2" name="model_idget" id="modelpost"  style="width:335px;">
                            <option value="">Please Select</option>
                            <?php
                            foreach ($model_unit as $mod) {
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
                            <input name="pressureget" id="pressurepost" class="form-control" type="text" placeholder="Pressure" style="width:335px;" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Voltase</label>
                        <div class="col-xs-9">
                            <input name="voltaseget" id="voltasepost" class="form-control" type="text" placeholder="Voltase" style="width:335px;" required>
                        </div>
                    </div>

                      <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal PO</label>
                        <div class="col-xs-9">
                            <input name="tanggal_po_customerget" id="tanggal_po_customerpost" class="form-control" placeholder="tanggal order" style="width:335px;" required>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor PO</label>
                        <div class="col-xs-9">
                            <input name="po_customerget" id="po_customerpost" class="form-control" type="text" placeholder="nomor_po" style="width:335px;" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Customer</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_customer_attribute = 'class="form-control select2" style="width:335px;" id="customer_idpost"';
                                echo form_dropdown('customer_idget', $dd_customer, $customer_selected, $dd_customer_attribute);
                            ?>
                        </div>
                    </div> 


                       
                            <input name="status_idget" id="status_idpost" class="form-control" type="hidden" style="width:335px;" required>
                  
                   
                            <input name="idget" id="idpost" class="form-control" type="hidden" style="width:335px;" required>
                  

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jumlah</label>
                        <div class="col-xs-9">
                            <input name="jumlahget" id="jumlahpost" class="form-control" type="text" placeholder="Jumlah" style="width:335px;" required>
                        </div>
                    </div> 

                   
                    <div class="form-group">
                       <label class="control-label col-xs-3" >Status Barang</label>
                        <div class="col-xs-9">
                        <select class="form-control select2" name="status_barangget" id="status_barangpost"  style="width:335px;">
                            <option value="">Please Select</option>
                            <option value="Indent">Indent</option>
                            <option value="Ready">Ready</option>
                            
                        </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <input name="keteranganget" id="keteranganpost" class="form-control" type="text" placeholder="Keterangan" style="width:335px;" required>
                        </div>
                    </div>  
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" id="btn_edit">Simpan</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <!--END MODAL ADD-->
 

 <!-- MODAL KIRIM KE PO KElUAR-->
        <div class="modal fade" id="ModalKirimPoMasuk" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Ke PO Unit Keluar</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">  

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Type Unit</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_type_unit_attribute = 'class="form-control select2" style="width:335px;" id="type_id2" readonly';
                                echo form_dropdown('type_idedit', $dd_type_unit, $type_unit_selected, $dd_type_unit_attribute);
                            ?>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Model Unit</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_model_unit_attribute = 'class="form-control select2" style="width:335px;" id="model_id2" readonly';
                                echo form_dropdown('model_idedit', $dd_model_unit, $model_unit_selected, $dd_model_unit_attribute);
                            ?>
                        </div>
                    </div> 


                     <input name="po_masuk_idedit" id="po_masuk_id2" class="form-control" type="hidden"  style="width:335px;" required>
                     
                     <input name="status_idedit" id="status_id2" class="form-control" type="hidden" value="4"  style="width:335px;" required>

                     <div class="form-group">
                        <label class="control-label col-xs-3" >Pressure</label>
                        <div class="col-xs-9">
                            <input name="pressureedit" id="pressure2" class="form-control" type="text" placeholder="" style="width:335px;" readonly="">
                        </div>
                    </div> 

                     <div class="form-group">
                        <label class="control-label col-xs-3" >Voltase</label>
                        <div class="col-xs-9">
                            <input name="voltaseedit" id="voltase2" class="form-control" type="text" placeholder="" style="width:335px;" readonly="">
                        </div>
                    </div>   



                    <div class="form-group">
                        <label class="control-label col-xs-3" >Supplier</label>
                        <div class="col-xs-9">
                          <?php
                                $dd_supplier_attribute = 'class="form-control select2" style="width:335px;" id="supplier_id2"';
                                echo form_dropdown('supplier_idedit', $dd_supplier, $supplier_selected, $dd_supplier_attribute);
                            ?>
                        </div>
                    </div>    
                     <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal PO</label>
                       <div class="col-xs-9">
                            <input name="tanggal_orderedit" id="tanggal_order2" class="form-control" placeholder="Masukan tanggal Order" style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor PO</label>
                        <div class="col-xs-9">
                            <input name="nomor_poedit" id="nomor_po2" class="form-control" type="text" placeholder="Masukan Nomor PO" style="width:335px;" required>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-xs-3" >Estimasi Unit Sampai</label>
                        <div class="col-xs-9">
                            <input name="tanggaledit" id="tanggal2" class="form-control" type="text" placeholder="Masukan Estimasi Unit sampai" style="width:335px;" required>
                        </div>
                    </div>                         

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jumlah</label>
                        <div class="col-xs-9">
                            <input name="jumlahedit" id="jumlah2" class="form-control" type="text" placeholder="Jumlah" style="width:335px;" required>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Status Pemesanan</label>
                        <div class="col-xs-9">
                              <input name="status_pemesananedit" id="status_pemesanan2" class="form-control" type="text" value="Dipesan" style="width:335px;" readonly="">
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <input name="keteranganedit" id="keterangan2" class="form-control" type="text" placeholder="Masukan Keterangan" style="width:335px;" required>
                        </div>
                    </div>  

                    
               
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" id="btn_send">Simpan</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <!--END MODAL KIRIM KE PO KElUAR-->

 

          <!--MODAL HAPUS-->
        <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                        <h4 class="modal-title" id="myModalLabel">Hapus Unit</h4>
                    </div>
                    <form class="form-horizontal">
                    <div class="modal-body">
                                           
                            <input type="hidden" name="id" id="textid" value="">
                            <div class="alert alert-danger"><p>Apakah Anda yakin mau menghapus transaksi unit masuk ini?</p></div>
                                         
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button class="btn_delete btn btn-danger" id="btn_delete">Hapus</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!--END MODAL HAPUS-->
        
         <!-- ============ MODAL EDIT PROGRESS UNIT =============== -->
         
         <div class="modal fade" id="ModalEditProgress" tabindex="" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Progress PO Dari Customer</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">

                <input name="idget1" id="idpost1" class="form-control" type="hidden" style="width:335px;" required>
                  
                    <div class="form-group">
                       <label class="control-label col-xs-3" >Progress</label>
                        <div class="col-xs-9">
                        <select class="form-control select2" name="progressget1" id="progresspost1"  style="width:335px;">
                            <option value="">Please Select</option>
                            <option value="1">OPEN</option>
                            <option value="2">CLOSE</option>
                            
                        </select>
                        </div>
                    </div>
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" id="btn_edit_progress">Simpan</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <!--END MODAL EDIT PROGRESS PO-->


<?php 
$this->load->view('template/js');
?>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="<?php  echo base_url();?>kolam/AdminLTE-2.0.5/plugins/datepicker/bootstrap-datepicker.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        tampil_data_po_unit();   //pemanggilan fungsi tampil.
         
       $('#example1').DataTable( {
             "scrollX": true
        } );
          
        //fungsi tampil barang
        function tampil_data_po_unit(){
            $.ajax({
                type  : 'GET',
                url   : '<?php echo base_url()?>index.php/barang/unit/data_po_unit',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                       
                        var jml = data[i].jumlah; 
                        var kon = data[i].konfirmasi;
                        var jmlkon = jml - kon;
                       if(jml == kon) {
                            html += '<tr>'+                                                           
                                '<td>'+data[i].nama_unit+'</td>'+
                                '<td>'+data[i].model+'</td>'+
                                '<td>'+data[i].voltase+'</td>'+
                                '<td>'+data[i].pressure+'</td>'+                                               
                                '<td><b>'+data[i].jumlah+'</b></td>'+
                                '<td>'+data[i].konfirmasi+'</td>'+
                                '<td><b>'+jmlkon+'</b></td>'+ 
                                '<td>'+data[i].nama_customer+'</td>'+ 
                                 
                                '<td>'+data[i].po_customer+'</td>'+     
                                '<td>'+data[i].tanggal_po_customer+'</td>'+                               
                                                    
                                '<td>'+data[i].keterangan+'</td>'+                                
                                '<td style="text-align:right;">'+                                    
                                    '<a href="javascript:;" class="btn btn-info item_edit" data="'+data[i].id+'"><span class="fa fa-pencil"></a>'+' '+
                                    '<a href="javascript:;" class="btn btn-danger  item_delete" data="'+data[i].id+'"><span class="fa fa-trash"></span></a>'+
                                '</td>'+

                               // '<td style="text-align:right;">'+
                                
                               //      '<a href="javascript:;" class="btn btn-default item_edit_progress" data="'+data[i].id+'"><span class="fa fa-caret-square-o-right"></a>'+' '+
                                    
                               //  '</td>'+
                                '</tr>';
                       }  else {

                            html += '<tr>'+                                                           
                                '<td>'+data[i].nama_unit+'</td>'+
                                '<td>'+data[i].model+'</td>'+
                                '<td>'+data[i].voltase+'</td>'+
                                '<td>'+data[i].pressure+'</td>'+                              
                                '<td><b>'+data[i].jumlah+'</b></td>'+
                                '<td>'+data[i].konfirmasi+'</td>'+
                                '<td><b>'+jmlkon+'</b></td>'+ 
                                '<td>'+data[i].nama_customer+'</td>'+ 
                                '<td>'+data[i].po_customer+'</td>'+     
                                '<td>'+data[i].tanggal_po_customer+'</td>'+                   
                                            
                                '<td>'+data[i].keterangan+'</td>'+                                
                                '<td style="text-align:right;">'+  
                                    '<a href="javascript:;" class="btn btn-info item_editkeluar" data="'+data[i].id+'"><span class="fa fa-send"></a>'+' '+

                                    '<a href="javascript:;" class="btn btn-info item_edit" data="'+data[i].id+'"><span class="fa fa-pencil"></a>'+' '+
                                    '<a href="javascript:;" class="btn btn-danger  item_delete" data="'+data[i].id+'"><span class="fa fa-trash"></span></a>'+
                                '</td>'+
/*
                                '<td style="text-align:right;">'+
                                
                                    // '<a href="javascript:;" class="btn btn-default item_edit_progress" data="'+data[i].id+'"><span class="fa fa-caret-square-o-right"></a>'+' '+
                                    
                                '</td>'+*/
                                '</tr>';
                       }   
                        
                       
                    }
                    $('#show_data').html(html);
                }
 
            });

        }        
         
        //Simpan list po
        $('#btn_simpan').on('click',function(){
            var id=$('#id').val();
            var type_id=$('#type').val();
            var model_id=$('#model').val();
            var pressure=$('#pressure').val();
            var voltase=$('#voltase').val();
            var status_id=$('#status_id').val();
            var tanggal_po_customer=$('#tanggal_po_customer').val();
            var po_customer=$('#po_customer').val();
            var customer_id=$('#customer_id').val();
            var jumlah=$('#jumlah').val();
            // var status_barang=$('#status_barang').val();
            // var progress=$('#progress').val();
            var keterangan=$('#keterangan').val();
            //var harga=$('#harga').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/barang/unit/save_po_unit')?>",
                dataType : "JSON",
                data : {id:id, type_id:type_id, model_id:model_id, pressure:pressure, voltase:voltase, status_id:status_id, tanggal_po_customer:tanggal_po_customer, po_customer:po_customer, customer_id:customer_id, jumlah:jumlah, keterangan:keterangan},
                success: function(data){
                    $('[name="id"]').val("");
                    $('[name="type_id"]').val("");
                    $('[name="model_id"]').val("");
                    $('[name="pressure"]').val("");
                    $('[name="voltase"]').val("");
                    $('[name="status_id"]').val("");
                    $('[name="tanggal_po_customer"]').val("");
                    $('[name="po_customer"]').val("");
                    $('[name="customer_id"]').val("");
                    $('[name="jumlah"]').val("");
                    /*$('[name="status_barang"]').val("");
                    $('[name="progress"]').val("");*/
                    $('[name="keterangan"]').val("");
                   
                    $('#ModalaAdd').modal('hide');
                     tampil_data_po_unit();
                      /*location.reload(true);*/
                }
            });
            return false;
        });

        //kirim ke po unit keluar jika barang indent
        //GET UPDATE
        $('#show_data').on('click','.item_send',function(){
            var id=$(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('index.php/barang/unit/get_po_unit')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id, type_id, model_id,  pressure, voltase, jumlah){
                        $('#ModalKirimPoMasuk').modal('show');
                        $('[name="po_masuk_idedit"]').val(data.id);
                        $('[name="type_idedit"]').val(data.type_id);
                        $('[name="model_idedit"]').val(data.model_id);
                        
                        $('[name="pressureedit"]').val(data.pressure);
                        $('[name="voltaseedit"]').val(data.voltase);
                       
                        $('[name="jumlahedit"]').val(data.jumlah);
                     
                    });
                }
            });
            return false;
        });


          //kirim ke po unit keluar jika barang indent
          //simpan
        $('#btn_send').on('click',function(){
           
            var type_id =$('#type_id2').val();
            var model_id =$('#model_id2').val();
            var po_masuk_id=$('#po_masuk_id2').val();
            var status_id=$('#status_id2').val();
            var pressure=$('#pressure2').val();
            var voltase =$('#voltase2').val();
            var jumlah=$('#jumlah2').val();
            var tanggal_order=$('#tanggal_order2').val();
            var supplier_id=$('#supplier_id2').val();
            
            var nomor_po=$('#nomor_po2').val();
            var tanggal=$('#tanggal2').val();
            var status_pemesanan=$('#status_pemesanan2').val();
          /*  var customer_id=$('#customer_id').val();
            var nomor_penawaran=$('#nomor_penawaran').val();
            var po_customer=$('#po_customer').val();*/
            var keterangan=$('#keterangan2').val();
           
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/barang/unit/simpan_pemesanan_unit_po_unit')?>",
                dataType : "JSON",
                data : {type_id:type_id, model_id:model_id, po_masuk_id:po_masuk_id, status_id:status_id, pressure:pressure, voltase:voltase, jumlah:jumlah, tanggal_order:tanggal_order, supplier_id:supplier_id,  nomor_po:nomor_po, tanggal:tanggal, status_pemesanan:status_pemesanan, keterangan:keterangan},
                success: function(data){
                   
                    $('[name="type_idedit"]').val("");
                    $('[name="model_idedit"]').val("");
                    $('[name="po_masuk_idedit"]').val("");
                    $('[name="status_idedit"]').val("");
                    $('[name="pressureedit"]').val("");
                    $('[name="voltaseedit"]').val("");
                    $('[name="jumlahedit"]').val("");
                    $('[name="tanggal_orderedit"]').val("");
                    $('[name="supplier_idedit"]').val("");                   
                    $('[name="nomor_poedit"]').val("");
                    $('[name="tanggal_orderedit"]').val("");
                    $('[name="status_pemesananedit"]').val("");                    
                    $('[name="keteranganedit"]').val("");
                    $('#ModalKirimPoMasuk').modal('hide');
                    tampil_data_po_unit();
                    location.reload(true);
                }
            });
            return false;
        });


        //Unit keluar dari po masuk
        //GET Data
        $('#show_data').on('click','.item_editkeluar',function(){
            var id=$(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('index.php/barang/unit/get_po_unit')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id, type_id, model_id, pressure, voltase, tanggal_po_customer, po_customer, customer_id, keterangan){
                        $('#ModalAddUnitKeluar').modal('show');
                        $('[name="po_masuk_idkeluar"]').val(data.id);
                        $('[name="type_idkel"]').val(data.type_id);
                        $('[name="type_idkeluar"]').val(data.type_id);
                        $('[name="model_idkel"]').val(data.model_id);                        
                        $('[name="model_idkeluar"]').val(data.model_id);                        
                        $('[name="pressurekeluar"]').val(data.pressure);
                        $('[name="voltasekeluar"]').val(data.voltase);
                        $('[name="customer_idkeluar"]').val(data.customer_id);
                        $('[name="po_customerkeluar"]').val(data.po_customer);
                        $('[name="tanggal_po_customerkeluar"]').val(data.tanggal_po_customer);
                     
                    });
                }
            });
            return false;
        });

        //Unit Keluar dari po masuk
        //Save Data
        $('#btn_simpan2').on('click',function(){
           
            var po_masuk_id=$('#po_masuk_idkeluar1').val();
            var type_id=$('#type_idkeluar1').val().trigger('change');
            var model_id=$('#model_idkeluar1').val().trigger('change');
            var serial_number=$('#serial_numberkeluar1').val().trigger('change');
            var pressure=$('#pressurekeluar1').val();
            var voltase=$('#voltasekeluar1').val();
            var jumlah=$('#jumlahkeluar1').val();
            var status_id=$('#status_idkeluar1').val();
            var customer_id=$('#customer_idkeluar1').val();
            var po_customer=$('#po_customerkeluar1').val();
            var tanggal_po_customer=$('#tanggal_po_customerkeluar1').val();
            var nomor_surat_jalan=$('#nomor_surat_jalan1').val();
            var tanggal=$('#tanggalkeluar1').val();          
            var keterangan=$('#keterangankeluar1').val();
           
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/barang/unit/simpan_unit_keluar')?>",
                dataType : "JSON",
                data : {po_masuk_id:po_masuk_id, type_id:type_id, model_id:model_id, serial_number:serial_number, pressure:pressure, voltase:voltase, jumlah:jumlah, status_id:status_id, customer_id:customer_id, po_customer:po_customer, tanggal_po_customer:tanggal_po_customer, nomor_surat_jalan:nomor_surat_jalan, tanggal:tanggal, keterangan:keterangan},
                success: function(data){
                   
                    $('[name="po_masuk_idkeluar"]').val("");
                    $('[name="type_idkeluar"]').val("");
                    $('[name="model_idkeluar"]').val("");
                    $('[name="serial_numberkeluar"]').val("");
                    $('[name="pressurekeluar"]').val("");
                    $('[name="voltasekeluar"]').val("");
                    $('[name="jumlahkeluar"]').val("");
                    $('[name="status_idkeluar"]').val("");
                    $('[name="customer_idkeluar"]').val(""); 
                    $('[name="po_customerkeluar"]').val(""); 
                    $('[name="tanggal_po_customerkeluar"]').val(""); 
                    $('[name="nomor_surat_jalan"]').val("");                    
                    $('[name="tanggalkeluar"]').val("");                    
                    $('[name="keterangankeluar"]').val("");
                    $('#ModalAddUnitKeluar').modal('hide');
                    tampil_data_po_unit();
                    location.reload(true);
                }
            });
            return false;
        });


         //edit po masuk
        //GET UPDATE
        $('#show_data').on('click','.item_edit',function(){
            var id=$(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('index.php/barang/unit/get_po_unit')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id, type_id, model_id, pressure, voltase, status_id, tanggal_po_customer, po_customer, customer_id, jumlah, status_barang, keterangan){
                    $('#ModalEdit').modal('show');
                    $('[name="idget"]').val(data.id);
                    $('[name="type_idget"]').val(data.type_id);
                    $('[name="model_idget"]').val(data.model_id);
                    $('[name="pressureget"]').val(data.pressure);
                    $('[name="voltaseget"]').val(data.voltase);
                    $('[name="status_idget"]').val(data.status_id);
                    $('[name="tanggal_po_customerget"]').val(data.tanggal_po_customer);
                    $('[name="po_customerget"]').val(data.po_customer);
                    $('[name="customer_idget"]').val(data.customer_id);
                    $('[name="jumlahget"]').val(data.jumlah);
                    $('[name="status_barangget"]').val(data.status_barang);
                    $('[name="keteranganget"]').val(data.keterangan);
                     
                    });
                }
            });
            return false;
        });


          //edit po masuk
          //simpan
        $('#btn_edit').on('click',function(){
           
            var id=$('#idpost').val();
            var type_id=$('#typepost').val();
            var model_id=$('#modelpost').val();
            var pressure=$('#pressurepost').val();
            var voltase=$('#voltasepost').val();
            var status_id=$('#status_idpost').val();
            var tanggal_po_customer=$('#tanggal_po_customerpost').val();
            var po_customer=$('#po_customerpost').val();
            var customer_id=$('#customer_idpost').val();
            var jumlah=$('#jumlahpost').val();
            var status_barang=$('#status_barangpost').val();
            var keterangan=$('#keteranganpost').val();
           
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/barang/unit/update_po_masuk')?>",
                dataType : "JSON",
                data : {id:id, type_id:type_id, model_id:model_id, pressure:pressure, voltase:voltase, status_id:status_id, tanggal_po_customer:tanggal_po_customer, po_customer:po_customer, customer_id:customer_id, jumlah:jumlah, status_barang:status_barang, keterangan:keterangan},
                success: function(data){
                   
                    $('[name="idget"]').val("");
                    $('[name="type_idget"]').val("");
                    $('[name="model_idget"]').val("");
                    $('[name="pressureget"]').val("");
                    $('[name="voltaseget"]').val("");
                    $('[name="status_idget"]').val("");
                    $('[name="tanggal_po_customerget"]').val("");
                    $('[name="po_customerget"]').val("");
                    $('[name="customer_idget"]').val("");                   
                    $('[name="jumlahget"]').val("");
                    $('[name="status_barangget"]').val("");                    
                    $('[name="keteranganget"]').val("");
                    $('#ModalEdit').modal('hide');
                    tampil_data_po_unit();
                    location.reload(true);
                }
            });
            return false;
        });
        
        
        //Ubah progress po customer
        //GET DATA UPDATE
        $('#show_data').on('click','.item_edit_progress',function(){
            var id=$(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('index.php/barang/unit/get_po_unit')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id, progress){
                        $('#ModalEditProgress').modal('show');
                        $('[name="idget1"]').val(data.id);
                        $('[name="progressget1"]').val(data.progress);
                    });
                }
            });
            return false;
        });
        
         //Ubah progress po customer
          //Proses Update
        $('#btn_edit_progress').on('click',function(){
           
            var id =$('#idpost1').val();
            var progress=$('#progresspost1').val();
           
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/barang/unit/update_po_masuk_progress')?>",
                dataType : "JSON",
                data : {id:id, progress:progress},
                success: function(data){
                   
                    $('[name="idget1"]').val("");
                    $('[name="progressget1"]').val("");
                    $('#ModalEditProgress').modal('hide');
                    tampil_data_po_unit();
                    location.reload(true);
                }
            });
            return false;
        });
         

        //GET HAPUS
        $('#show_data').on('click','.item_delete',function(){
            var id=$(this).attr('data');
            $('#ModalDelete').modal('show');
            $('[name="id"]').val(id);
        });

        //Delete
        $('#btn_delete').on('click',function(){
            var id=$('#textid').val();
            $.ajax({
            type : "POST",
            url  : "<?php echo base_url('index.php/barang/unit/delete_unit_masuk')?>",
            dataType : "JSON",
                    data : {id:id},
                    success: function(data){
                            $('#ModalDelete').modal('hide');
                             tampil_data_unit_masuk();
                              location.reload();
                    }
                });
                return false;
            });
         

       
 
    }); 
</script>
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
    $(document).ready(function()
    { 
        $('#input-customer, #input-penawaran, #input-pocustomer').hide(); 
        $('#status_pemesanan').change(function(){ // Ketika user memilih filter
            if($(this).val() == '1'){ 
              
                $('#input-customer, #input-penawaran, #input-pocustomer').show();
            }else{
                $('#input-customer, #input-penawaran, #input-pocustomer').hide();
            }

            $(' #input-customer select, #input-penawaran select, #input-pocustomer select').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
        })
    })
    </script>

     <!--  <script src="<?php echo base_url('assets/js/jquery.chained.min.js') ?>"></script>
        <script>
            $("#model").chained("#type"); // disini kita hubungkan kota dengan provinsi
        </script>

         <script>
           // $("#modelpost").chained("#typepost"); // disini kita hubungkan kota dengan provinsi
        </script> -->

        <script src="<?php echo base_url('assets/js/jquery.chained.min.js') ?>"></script>
        <script>
           $("#model_idkeluar1").chained("#type_idkeluar1"); 
            $("#serial_numberkeluar1").chained("#model_idkeluar1");
        </script>

         <script>
            $("#model").chained("#type_id"); // disini kita hubungkan kota dengan provinsi
            $("#serial_number").chained("#model");
        </script>


<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>