<?php 
$this->load->view('template/head');
?>
<link src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datepicker/datepicker3.css'?>" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>

<style>
    .datepicker {
      z-index: 1600 !important; /* has to be larger than 1050 */
    }
</style>

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      PO Unit Ke Supplier
        <small>data list PO keluar</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">pemesanan unit</a></li>
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
                  <div class="pull-right"><a href="<?php echo base_url().'index.php/admin/order/add_order_unit'?>" class="btn  btn-success"  ><span class="fa fa-plus"></span> </a></div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  
                <table id="example1" class="cell-border display nowrap" width="100%">
            <thead>
                <tr>
                    <th>Type Unit</th>
                    <th>Model</th>
                    <th>Pressure</th>
                    <th>Voltase</th> 
                    <th>Jumlah</th>
                    <th>Unit Sudah Masuk</th>
                    <th>Unit Belum Masuk</th>
                    <th>Supplier</th>
                    <th>Nomor PO Unit</th>
                    <th>Tanggal PO Unit</th> 
                    <th>Estimasi Sampai</th>
                    <th>Keterangan</th>                   
                    <th style="text-align: right; width: 100px">Aksi</th>               
                    <!-- <th style="text-align: center;">Konfirmasi Status</th>  -->              
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


<!-- MODAL INSERT KE UNIT MASUK -->
        <div class="modal fade" id="ModalEditMasuk" role="dialog" tabindex="-1" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Unit Masuk</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">           
                    

                     <div class="form-group">
                        <label class="control-label col-xs-3" >Type Unit</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_type_unit_attribute = 'class="form-control" style="width:335px;" id="type_idmasuk" disabled';
                                echo form_dropdown('type_idmasuk', $dd_type_unit, $type_unit_selected, $dd_type_unit_attribute);
                            ?>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Model Unit</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_model_unit_attribute = 'class="form-control" style="width:335px;" id="model_idmasuk" disabled';
                                echo form_dropdown('model_idmasuk', $dd_model_unit, $model_unit_selected, $dd_model_unit_attribute);
                            ?>
                        </div>
                    </div> 

                     <div class="form-group">
                        <label class="control-label col-xs-3" >Pressure</label>
                        <div class="col-xs-9">
                            <input name="pressuremasuk" id="pressuremasuk" class="form-control" type="text" style="width:335px;" required>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="control-label col-xs-3" >Voltase</label>
                        <div class="col-xs-9">
                            <input name="voltasemasuk" id="voltasemasuk" class="form-control" type="text" style="width:335px;" required>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="control-label col-xs-3" >Serial Number</label>
                        <div class="col-xs-9">
                            <input name="serial_numbermasuk" id="serial_numbermasuk" class="form-control" placeholder="Masukan Serial Number Unit" type="text" style="width:335px;" required>
                        </div>
                    </div>  

                      <input type="hidden" name="status_idmasuk" id="status_idmasuk" value="1">
                      <input type="hidden" name="pemesanan_idmasuk" id="pemesanan_idmasuk" value="">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jumlah</label>
                        <div class="col-xs-9">
                            <input name="jumlahmasuk" id="jumlahmasuk" value="1" class="form-control" type="text" style="width:335px;" required>
                        </div>
                    </div> 
                    
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal PO</label>
                        <div class="col-xs-9">
                            <input name="tanggal_ordermasuk" id="tanggal_ordermasuk" class="form-control" placeholder="Masukan Format Tanggal Tahun/Bulan/Hari" style="width:335px;" required>
                             
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor PO</label>
                        <div class="col-xs-9">
                            <input name="nomor_pomasuk" id="nomor_pomasuk" class="form-control" type="text" placeholder="Nomor PO" style="width:335px;" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Supplier</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_supplier_attribute = 'class="form-control" style="width:335px;" id="supplier_idmasuk" disabled';
                                echo form_dropdown('supplier_idmasuk', $dd_supplier, $supplier_selected, $dd_supplier_attribute);
                            ?>
                        </div>
                    </div>
                    
                      <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal Masuk</label>
                        <div class="col-xs-9">
                          <input class="form-control" name="tanggalmasuk" id="tanggalmasuk" placeholder="Masukan Tanggal Masuk Format Tahun/Bulan/Hari" type="text" style="width:335px;" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <input name="keteranganmasuk" id="keteranganmasuk" class="form-control" type="text" placeholder="Keterangan" style="width:335px;" required>
                        </div>
                    </div> 
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" id="btn_update2">Simpan</button>
                </div>
            </form>
            </div>
            </div>
        </div>
       <!-- MODAL INSERT KE UNIT MASUK -->
        

        <!-- MODAL EDIT -->
        <div class="modal fade" id="ModalEdit" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Edit Pemesanan Unit</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">                    
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Type Unit</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_type_unit_attribute = 'class="form-control select2" style="width:335px;" id="type_id2"';
                                echo form_dropdown('type_idedit', $dd_type_unit, $type_unit_selected, $dd_type_unit_attribute);
                            ?>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Model Unit</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_model_unit_attribute = 'class="form-control select2" style="width:335px;" id="model_id2"';
                                echo form_dropdown('model_idedit', $dd_model_unit, $model_unit_selected, $dd_model_unit_attribute);
                            ?>
                        </div>
                    </div> 
                    <input type="hidden" name="idedit" id="id2" value=""> 
                     <input type="hidden" name="status_idedit" id="status_id2" value=""> 

                      <div class="form-group">
                        <label class="control-label col-xs-3" >Pressure</label>
                        <div class="col-xs-9">
                            <input name="pressureedit"  id="pressure2" class="form-control" type="text" placeholder="Masukan Pressure" style="width:335px;" required>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Voltase</label>
                        <div class="col-xs-9">
                            <input name="voltaseedit" id="voltase2" class="form-control" type="text" placeholder="Masukan Voltase" style="width:335px;" required>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jumlah</label>
                        <div class="col-xs-9">
                            <input name="jumlahedit" id="jumlah2" class="form-control" type="text"  style="width:335px;" required>
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
                        <label class="control-label col-xs-3" >Nomor Order</label>
                        <div class="col-xs-9">
                            <input name="nomor_poedit" id="nomor_po2" class="form-control" type="text"  style="width:335px;" required>
                        </div>
                    </div> 

                     <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal Order</label>
                        <div class="col-xs-9">
                            <input name="tanggal_orderedit" id="tanggal_order2" class="form-control" type="text" placeholder="Masukan Format Tanggal Tahun/Bulan/Hari"  style="width:335px;" required>
                        </div>
                    </div> 
                    
                     <div class="form-group">
                        <label class="control-label col-xs-3" >Estimasi Order Sampai</label>
                        <div class="col-xs-9">
                     
                            <input name="tanggaledit" id="tanggal2" class="form-control" type="text"  style="width:335px;" required>
                        </div>
                    </div>
                    
                    <!-- <div class="form-group">
                        <label class="control-label col-xs-3">Status Pemesanan</label>
                        <div class="col-xs-9">
                    <select class="form-control select2" name="status_pemesananedit" id="status_pemesanan2" style="width:335px;">
                      <option selected value="">Please Select</option>
                      <option  value="Stock">Stock</option>
                      <option value="Dipesan">Dipesan</option>                      
                    </select>
                        </div>
                    </div> 
                    
                     <div class="form-group">
                        <label class="control-label col-xs-3" >Customer</label>
                        <div class="col-xs-9">
                          <?php
                                $dd_customer_attribute = 'class="form-control select2" style="width:335px;" id="customer_id2"';
                                echo form_dropdown('customer_idedit', $dd_customer, $customer_selected, $dd_customer_attribute);
                            ?>
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor Penawaran</label>
                        <div class="col-xs-9">
                            <input name="nomor_penawaranedit" id="nomor_penawaran2" class="form-control" type="text" placeholder="Nomor Peawaran" style="width:335px;" required>
                        </div>
                    </div> 
                    
                     <div class="form-group">
                        <label class="control-label col-xs-3" >PO Customer</label>
                        <div class="col-xs-9">
                            <input name="po_customeredit" id="po_customer2" class="form-control" type="text" placeholder="Masukan Keterangan" style="width:335px;" required>
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal PO Customer</label>
                        <div class="col-xs-9">
                            <input name="tanggal_po_customeredit" id="tanggal_po_customer2" class="form-control" type="text" placeholder="Tanggal Po Customer" style="width:335px;" required>
                        </div>
                    </div> -->
                       
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <input name="keteranganedit" id="keterangan2" class="form-control" type="text"  style="width:335px;" required>
                        </div>
                    </div> 
                    
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" id="btn_update">Update</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <!--END MODAL EDIT-->

        <!--MODAL HAPUS-->
        <div class="modal fade" id="ModalDelete" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                        <h4 class="modal-title" id="myModalLabel">Hapus PO Unit Ke Supplier?</h4>
                    </div>
                    <form class="form-horizontal">
                    <div class="modal-body">
                                           
                            <input type="hidden" name="id" id="textid" value="">
                            <div class="alert alert-danger"><p>Apakah Anda yakin mau menghapus pemesanan unit ini?</p></div>
                                         
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


        <!-- MODAL EDIT Progres PO ke Supplier-->
        <div class="modal fade" id="ModalEditProgress" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Edit Progress PO</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">                    
                    
                        <input type="hidden" name="ideditprogress" id="id3" value=""> 
                     
                    <div class="form-group">
                       <label class="control-label col-xs-3" >Progress</label>
                        <div class="col-xs-9">
                        <select class="form-control" name="progress" id="progress3"  style="width:335px;">
                            <option value="">Please Select</option>
                            <option value="1">OPEN</option>
                            <option value="2">CLOSE</option>                            
                        </select>
                        </div>
                    </div>                    
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" id="btn_update_progress">Simpan</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <!--END MODAL EDIT-->


<?php 
$this->load->view('template/js');
?>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>  
            $(document).ready(function () {
                $(".select2").select2({
                    placeholder: "Please Select"
                });
            });
 </script>


<script type="text/javascript">
    $(document).ready(function(){
         tampil_data_unit_order();   //pemanggilan fungsi tampil.
         
        $('#example1').DataTable( {
            "scrollX": true
        } );
          
        //fungsi tampil barang
        function  tampil_data_unit_order(){
            $.ajax({
                type  : 'GET',
                 url   : '<?php echo base_url()?>index.php/admin/order/data_order_unit',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        
                        var jml = data[i].jumlah; 
                        var kon = data[i].konfirmasi;
                        var jmlkon = jml - kon;
                       if(jml == kon)
                       {
                            html += '<tr>'+
                                '<td>'+data[i].nama_unit+'</td>'+
                                '<td>'+data[i].model+'</td>'+ 
                                '<td>'+data[i].pressure+'</td>'+                                                 
                                '<td>'+data[i].voltase+'</td>'+                                                              
                                '<td><b>'+data[i].jumlah+'</b></td>'+
                                '<td>'+data[i].konfirmasi+'</td>'+
                                '<td><b>'+jmlkon+'</b></td>'+                                
                                '<td>'+data[i].nama_supplier+'</td>'+
                                 '<td>'+data[i].nomor_po+'</td>'+
                                '<td>'+data[i].tanggal_order+'</td>'+                                                               
                                '<td>'+data[i].tanggal+'</td>'+                                 
                                '<td>'+data[i].keterangan+'</td>'+                              
                                '<td style="text-align:right;">'+
                                   //'<a href="javascript:;" class="btn btn-info item_editmasuk" data="'+data[i].id+'"><span class="fa fa-send"></a>'+' '+
                                    '<a href="javascript:;" class="btn btn-info item_edit" data="'+data[i].id+'"><span class="fa fa-pencil"></a>'+' '+
                                    '<a href="javascript:;" class="btn btn-danger  item_delete" data="'+data[i].id+'"><span class="fa fa-trash"></span></a>'+ 
                                '</td>'+

                                /*'<td style="text-align:center;">'+                                   
                                    '<a href="javascript:;" class="btn btn-warning item_edit_progress" data="'+data[i].id+'"><span class="fa fa-check-circle-o"></a>'
                                '</td>'+*/
                                '</tr>';
                       }else{
                            html += '<tr>'+
                                '<td>'+data[i].nama_unit+'</td>'+
                                '<td>'+data[i].model+'</td>'+ 
                                '<td>'+data[i].pressure+'</td>'+                                                 
                                '<td>'+data[i].voltase+'</td>'+                                                              
                                '<td><b>'+data[i].jumlah+'</b></td>'+
                                '<td>'+data[i].konfirmasi+'</td>'+
                                '<td><b>'+jmlkon+'</b></td>'+                                
                                '<td>'+data[i].nama_supplier+'</td>'+
                                '<td>'+data[i].nomor_po+'</td>'+
                                '<td>'+data[i].tanggal_order+'</td>'+                                                               
                                '<td>'+data[i].tanggal+'</td>'+
                                
                              /*  '<td>'+data[i].status_pemesanan+'</td>'+
                                '<td>'+data[i].nama_customer+'</td>'+
                                '<td>'+data[i].nomor_penawaran+'</td>'+
                                '<td>'+data[i].po_customer+'</td>'+
                                '<td>'+data[i].tanggal_po_customer+'</td>'+*/
                                '<td>'+data[i].keterangan+'</td>'+                                
                                                                
                                '<td style="text-align:right;">'+
                                   '<a href="javascript:;" class="btn btn-success item_editmasuk" data="'+data[i].id+'"><span class="fa fa-send"></a>'+' '+
                                    '<a href="javascript:;" class="btn btn-info item_edit" data="'+data[i].id+'"><span class="fa fa-pencil"></a>'+' '+
                                    '<a href="javascript:;" class="btn btn-danger  item_delete" data="'+data[i].id+'"><span class="fa fa-trash"></span></a>'+ 
                                '</td>'+
                                '</tr>';
                        }             
                    }
                    $('#show_data').html(html);
                } 
            });
        } 

         //GET UPDATE Masuk
        $('#show_data').on('click','.item_editmasuk',function(){
            var id=$(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('index.php/admin/order/get_edit_order_masuk')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id, type_id, model_id, pressure, voltase, supplier_id, tanggal_order, nomor_po){
                        $('#ModalEditMasuk').modal('show');
                        
                        $('[name="pemesanan_idmasuk"]').val(data.id);
                        $('[name="type_idmasuk"]').val(data.type_id);
                        $('[name="model_idmasuk"]').val(data.model_id);
                        $('[name="pressuremasuk"]').val(data.pressure);
                        $('[name="voltasemasuk"]').val(data.voltase);
                        $('[name="supplier_idmasuk"]').val(data.supplier_id);
                        $('[name="tanggal_ordermasuk"]').val(data.tanggal_order);
                        $('[name="nomor_pomasuk"]').val(data.nomor_po);
                       /* $('[name="status_pemesananmasuk"]').val(data.status_pemesanan);
                        $('[name="customer_idmasuk"]').val(data.customer_id);
                        $('[name="nomor_penawaranmasuk"]').val(data.nomor_penawaran);
                        $('[name="po_customermasuk"]').val(data.po_customer);
                        $('[name="tanggal_po_customermasuk"]').val(data.tanggal_po_customer);*/
                    });
                }
            });
            return false;
        });


        //Update Insert Unit Masuk
        $('#btn_update2').on('click',function(){
            
            var type_id=$('#type_idmasuk').val();
            var model_id=$('#model_idmasuk').val();
            var pemesanan_id=$('#pemesanan_idmasuk').val();
            var pressure=$('#pressuremasuk').val();
            var voltase=$('#voltasemasuk').val();
            var serial_number=$('#serial_numbermasuk').val();
            var status_id=$('#status_idmasuk').val();
            var supplier_id=$('#supplier_idmasuk').val();
            var tanggal_order=$('#tanggal_ordermasuk').val(); 
            var jumlah=$('#jumlahmasuk').val();
            var nomor_po=$('#nomor_pomasuk').val();         
            var tanggal=$('#tanggalmasuk').val();            
            var keterangan=$('#keteranganmasuk').val();
           
             $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/admin/order/simpan_unit_masuk')?>",
                dataType : "JSON",
                data : {type_id:type_id, model_id:model_id, pemesanan_id:pemesanan_id, pressure:pressure, voltase:voltase, serial_number:serial_number, status_id:status_id, supplier_id:supplier_id, tanggal_order:tanggal_order, jumlah:jumlah, nomor_po:nomor_po,  tanggal:tanggal,  keterangan:keterangan},
                success: function(data){
                   
                   $('[name="type_idmasuk"]').val("");   

                   $('[name="model_idmasuk"]').val("");
                   $('[name="pemesanan_idmasuk"]').val("");

                   $('[name="pressuremasuk"]').val("");
                   $('[name="voltasemasuk"]').val("")
                   $('[name="serial_numbermasuk"]').val("");

                   $('[name="status_idmasuk"]').val("");
                   $('[name="supplier_idmasuk"]').val("");
                   $('[name="tanggal_ordermasuk"]').val("");

                   $('[name="jumlahmasuk"]').val("");
                   $('[name="nomor_pomasuk"]').val("");                   
                   $('[name="tanggalmasuk"]').val("");                   
                   $('[name="keteranganmasuk"]').val("");
                   $('#ModalEditMasuk').modal('hide');

                    tampil_data_unit_order();
                    location.reload(true);
                }
            });
            return false;
        });

        


        //GET UPDATE
        $('#show_data').on('click','.item_edit',function(){
            var id=$(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('index.php/admin/order/get_order_unit')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id, type_id, model_id, status_id, pressure, voltase, jumlah, tanggal_order, nomor_po, supplier_id, tanggal, keterangan){
                        $('#ModalEdit').modal('show');
                        $('[name="idedit"]').val(data.id);
                        $('[name="type_idedit"]').val(data.type_id);
                        $('[name="model_idedit"]').val(data.model_id);
                        $('[name="status_idedit"]').val(data.status_id);
                        $('[name="pressureedit"]').val(data.pressure);
                        $('[name="voltaseedit"]').val(data.voltase);
                        $('[name="jumlahedit"]').val(data.jumlah);
                        $('[name="tanggal_orderedit"]').val(data.tanggal_order);
                        $('[name="nomor_poedit"]').val(data.nomor_po);
                        $('[name="supplier_idedit"]').val(data.supplier_id);
                        $('[name="tanggaledit"]').val(data.tanggal);  
                      /*  $('[name="status_pemesananedit"]').val(data.status_pemesanan); 
                        $('[name="customer_idedit"]').val(data.customer_id);
                        $('[name="nomor_penawaranedit"]').val(data.nomor_penawaran); 
                        $('[name="po_customeredit"]').val(data.po_customer);
                        $('[name="tanggal_po_customeredit"]').val(data.tanggal_po_customer); */
                        $('[name="keteranganedit"]').val(data.keterangan);
                    });
                }
            });
            return false;
        });


         //GET UPDATE Progress PO
        $('#show_data').on('click','.item_edit_progress',function(){
            var id=$(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('index.php/admin/order/get_order_unit')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id, progress){
                        $('#ModalEditProgress').modal('show');
                        $('[name="ideditprogress"]').val(data.id);
                        $('[name="progress"]').val(data.progress);
                        
                    });
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
 
        //Update
        $('#btn_update').on('click',function(){
            var id=$('#id2').val();
            var type_id=$('#type_id2').val();
            var model_id=$('#model_id2').val();
            var status_id=$('#status_id2').val();
            var pressure=$('#pressure2').val();
            var voltase=$('#voltase2').val();
            var jumlah=$('#jumlah2').val();
            var tanggal_order=$('#tanggal_order2').val();
            var nomor_po=$('#nomor_po2').val();            
            var supplier_id=$('#supplier_id2').val();           
            var tanggal=$('#tanggal2').val();
           /* var status_pemesanan=$('#status_pemesanan2').val();
            var customer_id=$('#customer_id2').val();
            var nomor_penawaran=$('#nomor_penawaran2').val();
            var po_customer=$('#po_customer2').val();
            var tanggal_po_customer=$('#tanggal_po_customer2').val();*/
             
            var keterangan=$('#keterangan2').val();
           /* var nabar=$('#nama_barang2').val();
            var harga=$('#harga2').val();*/
             $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/admin/order/update_order_unit')?>",
                dataType : "JSON",
                data : {id:id, type_id:type_id, model_id:model_id, status_id:status_id, pressure:pressure, voltase:voltase, jumlah:jumlah, tanggal_order:tanggal_order, nomor_po:nomor_po, supplier_id:supplier_id, tanggal:tanggal, keterangan:keterangan},
                success: function(data){
                    $('[name="idedit"]').val("");
                    $('[name="type_idedit"]').val("");            
                    $('[name="model_idedit"]').val("");
                    $('[name="status_idedit"]').val("");
                    $('[name="pressureedit"]').val("");
                    $('[name="voltaseedit"]').val("");
                    $('[name="jumlahedit"]').val("");
                    $('[name="tanggal_orderedit"]').val("");
                    $('[name="nomor_poedit"]').val("");
                    $('[name="supplier_idedit"]').val("");      
                    $('[name="tanggaledit"]').val(""); 
                   /* $('[name="status_pemesananedit"]').val("");
                    $('[name="customer_idedit"]').val("");
                    $('[name="nomor_penawaranedit"]').val("");
                    $('[name="po_customeredit"]').val("");
                    $('[name="tanggal_po_customeredit"]').val("");*/
                    $('[name="keteranganedit"]').val("");
                    $('#ModalEdit').modal('hide');

                    tampil_data_unit_order();
                    location.reload(true);
                }
            });
            return false;
        });


        //Update progress PO
        $('#btn_update_progress').on('click',function(){
            var id=$('#id3').val();
            var progress=$('#progress3').val();
            
             $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/admin/order/update_progress_order_unit')?>",
                dataType : "JSON",
                data : {id:id, progress:progress},
                success: function(data){
                    $('[name="ideditprogress"]').val("");
                    $('[name="progress"]').val("");    
                    $('#ModalEditProgress').modal('hide');
                    tampil_data_unit_order();
                }
            });
            return false;
        });
 
 
        //Delete
        $('#btn_delete').on('click',function(){
            var id=$('#textid').val();
            $.ajax({
            type : "POST",
            url  : "<?php echo base_url('index.php/admin/order/delete_order_unit')?>",
            dataType : "JSON",
                    data : {id:id},
                    success: function(data){
                            $('#ModalDelete').modal('hide');

                           tampil_data_unit_order();
                           location.reload(true);
                    }
                });
                return false;
            });

 
    });
 
</script>

 
<script src="<?php echo base_url('assets/js/jquery.chained.min.js') ?>"></script>
        <script>
            $("#model").chained("#type_id"); // disini kita hubungkan kota dengan provinsi
            $("#serial_number").chained("#model");
    </script>


    <script src="<?php echo base_url('assets/js/jquery-ui.js'); ?>"></script> <!-- Load file plugin js jquery-ui -->
    <script>
    $(document).ready(function()
    { 
        $('#input-customer, #input-penawaran, #input-pocustomer').hide(); 
        $('#status_pemesananmasuk').change(function(){ // Ketika user memilih filter
            if($(this).val() == '1'){ 
              
                $('#input-customer, #input-penawaran, #input-pocustomer').show();
            }else{
                $('#input-customer, #input-penawaran, #input-pocustomer').hide();
            }

            $(' #input-customer select, #input-penawaran select, #input-pocustomer select').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
        })
    })
    </script>

     
<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>
