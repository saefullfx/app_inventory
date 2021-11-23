<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
<link src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datepicker/datepicker3.css'?>" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Unit Masuk
        <small>data list unit masuk</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Unit Masuk</a></li>
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
                  <!-- <div class="pull-right"><a href="<?php echo base_url().'index.php/barang/unit/add_unit_masuk'?>" class="btn  btn-success"  ><span class="fa fa-plus"></span> </a></div> -->
                </div><!-- /.box-header -->
                <div class="box-body">
                  
                <table id="example1" class="table table-bordered table-striped display nowrap" width="100%">
            <thead>
                <tr>                    
                    <th>Type Unit</th>
                    <th>Model</th>
                    <th>Voltase</th>
                    <th>Pressure</th>
                    <th>Serial Number</th>
                    <th>Tanggal PO</th>
                    <th>Nomor PO</th>
                    <th>Tanggal Masuk</th>   
                    <th>Supplier</th> 
                    <th>Jumlah</th>
                  <!--   <th>Status Pemesanan</th>
                    <th>Customer</th>
                    <th>Nomor Penawaran</th>
                    <th>PO Customer</th> 
                    <th>Tanggal PO Customer</th> -->
                    <th>Keterangan</th>
                    <th style="text-align: right; width: 100px">Aksi</th>                    
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
 

 <!-- MODAL EDIT -->
        <div class="modal fade" id="ModalEdit" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Edit Unit Masuk</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">  

                <input name="id" id="id" class="form-control" type="hidden"  style="width:335px;" required>
                 <input name="pemesanan_id" id="pemesanan_id" class="form-control" type="hidden"  style="width:335px;" required>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Type Unit</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_type_unit_attribute = 'class="form-control select2" style="width:335px;" id="type_id"';
                                echo form_dropdown('type_id', $dd_type_unit, $type_unit_selected, $dd_type_unit_attribute);
                            ?>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Model Unit</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_model_unit_attribute = 'class="form-control select2" style="width:335px;" id="model_id"';
                                echo form_dropdown('model_id', $dd_model_unit, $model_unit_selected, $dd_model_unit_attribute);
                            ?>
                        </div>
                    </div> 

                     <div class="form-group">
                        <label class="control-label col-xs-3" >Pressure</label>
                        <div class="col-xs-9">
                            <input name="pressure" id="pressure" class="form-control" type="text" placeholder="" style="width:335px;">
                        </div>
                    </div> 

                     <div class="form-group">
                        <label class="control-label col-xs-3" >Voltase</label>
                        <div class="col-xs-9">
                            <input name="voltase" id="voltase" class="form-control" type="text" placeholder="" style="width:335px;">
                        </div>
                    </div>   

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Serial Number</label>
                        <div class="col-xs-9">
                            <input name="serial_number" id="serial_number" class="form-control" type="text" placeholder="" style="width:335px;">
                        </div>
                    </div>   

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal Order</label>
                        <div class="col-xs-9">
                            <input name="tanggal_order" id="tanggal_order" class="form-control" placeholder="tanggal" style="width:335px;">
                        </div>
                    </div>

                     <input name="status_id" id="status_id" class="form-control" type="hidden" style="width:335px;" required>
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Supplier</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_supplier_attribute = 'class="form-control select2"  style="width:335px;" id="supplier_id"';
                                echo form_dropdown('supplier_id', $dd_supplier, $supplier_selected, $dd_supplier_attribute);
                            ?>
                        </div>
                    </div> 
                    

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jumlah</label>
                        <div class="col-xs-9">
                            <input name="jumlah" id="jumlah" class="form-control" type="text" placeholder="Jumlah" style="width:335px;">
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor PO</label>
                        <div class="col-xs-9">
                            <input name="nomor_po" id="nomor_po" class="form-control" type="text" placeholder="nomor_po" style="width:335px;">
                        </div>
                    </div> 
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal Masuk</label>
                        <div class="col-xs-9">
                            <input name="tanggal" id="tanggal" class="form-control" placeholder="tanggal" style="width:335px;" required>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="control-label col-xs-3" >Status Unit</label>
                        <div class="col-xs-9">
                    <select class="form-control select2" name="status_pemesanan" id="status_pemesanan" style="width:335px;">
                      <option selected value="">Please Select</option>
                      <option value="Stock">Stock</option>
                      <option value="Dipesan">Dipesan</option>                      
                    </select>
                        </div>
                    </div> 

                    <!-- <div class="form-group" id="">
                        <label class="control-label col-xs-3" >Customer</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_customer_attribute = 'class="form-control select2" style="width:335px;" id="customer_id"';
                                echo form_dropdown('customer_id', $dd_customer, $customer_selected, $dd_customer_attribute);
                            ?>
                        </div>
                    </div> 
                    
                    

                    <div class="form-group" id="">
                        <label class="control-label col-xs-3" >Nomor Penawaran</label>
                        <div class="col-xs-9">
                            <input name="nomor_penawaran" id="nomor_penawaran" class="form-control" placeholder="tanggal" style="width:335px;" required>
                        </div>
                    </div>
                    
                    <div class="form-group" id="">
                        <label class="control-label col-xs-3" >Tanggal PO Customer</label>
                        <div class="col-xs-9">
                            <input name="tanggal_po_customer" id="tanggal_po_customer" class="form-control" placeholder="Isi dengan FORMAT TAHUN/BULAN/HARI" style="width:335px;">
                        </div>
                    </div>

                     <div class="form-group" id="">
                        <label class="control-label col-xs-3" >PO Customer</label>
                        <div class="col-xs-9">
                            <input name="po_customer" id="po_customer" class="form-control" placeholder="Masukan Po Customer" style="width:335px;" required>
                        </div>
                    </div>
 -->
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <input name="keterangan" id="keterangan" class="form-control" type="text" placeholder="Keterangan" style="width:335px;" required>
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
        <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                        <h4 class="modal-title" id="myModalLabel">Hapus Unit</h4>
                    </div>
                    <form class="form-horizontal">
                    <div class="modal-body">
                                           
                            <input type="hidden" name="id" id="textid" value="">
                            <div class="alert alert-danger"><p>Apakah Anda yakin mau menghapus unit masuk ini?</p></div>
                                         
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


<?php 
$this->load->view('template/js');
?>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="<?php  echo base_url();?>kolam/AdminLTE-2.0.5/plugins/datepicker/bootstrap-datepicker.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        tampil_data_unit_masuk();   //pemanggilan fungsi tampil.
         
       $('#example1').DataTable( {
             "scrollX": true
        } );
          
        //fungsi tampil barang
        function tampil_data_unit_masuk(){
            $.ajax({
                type  : 'GET',
                url   : '<?php echo base_url()?>index.php/barang/unit/data_unit_masuk',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                       //var status_pemesanan = data[i].status_pemesanan;
                       //if(status_pemesanan == 1){                         
                        html += '<tr>'+
                                '<td>'+data[i].nama_unit+'</td>'+
                                '<td>'+data[i].model+'</td>'+
                                '<td>'+data[i].voltase+'</td>'+
                                '<td>'+data[i].pressure+'</td>'+                                
                                '<td>'+data[i].serial_number+'</td>'+
                                '<td>'+data[i].tanggal_order+'</td>'+
                                '<td>'+data[i].nomor_po+'</td>'+
                                '<td>'+data[i].tanggal+'</td>'+                                
                                '<td>'+data[i].nama_supplier+'</td>'+                                
                                '<td>'+data[i].jumlah+'</td>'+                             
                                // '<td>'+data[i].status_pemesanan+'</td>'+
                                //'<td>'+'<small class="label label-danger">DIPESAN</small>'+'</td>'+
                                // '<td>'+data[i].nama_customer+'</td>'+                                
                                // '<td>'+data[i].nomor_penawaran+'</td>'+                                
                                // '<td>'+data[i].po_customer+'</td>'+
                                // '<td>'+data[i].tanggal_po_customer+'</td>'+
                                '<td>'+data[i].keterangan+'</td>'+                                
                                '<td style="text-align:right;">'+
                                    '<a href="javascript:;" class="btn btn-info item_edit" data="'+data[i].id+'"><span class="fa fa-pencil"></a>'+' '+
                                    '<a href="javascript:;" class="btn btn-danger  item_delete" data="'+data[i].id+'"><span class="fa fa-trash"></span></a>'+
                                    
                                '</td>'+
                                '</tr>';
                        /*}else{
                             html += '<tr>'+
                                                           
                                '<td>'+data[i].nama_unit+'</td>'+
                                '<td>'+data[i].model+'</td>'+
                                '<td>'+data[i].voltase+'</td>'+
                                '<td>'+data[i].pressure+'</td>'+                                
                                '<td>'+data[i].serial_number+'</td>'+
                                '<td>'+data[i].tanggal_order+'</td>'+
                                '<td>'+data[i].nomor_po+'</td>'+
                                '<td>'+data[i].tanggal+'</td>'+                                
                                '<td>'+data[i].nama_supplier+'</td>'+                                
                                '<td>'+data[i].jumlah+'</td>'+                             
                                //'<td>'+data[i].status_pemesanan+'</td>'+
                                '<td>'+'<small class="label label-info">STOCK</small>'+'</td>'+
                                '<td>'+data[i].nama_customer+'</td>'+                                
                                '<td>'+data[i].nomor_penawaran+'</td>'+                                
                                '<td>'+data[i].po_customer+'</td>'+
                                '<td>'+data[i].keterangan+'</td>'+                               
                                '<td style="text-align:right;">'+
                                    '<a href="javascript:;" class="btn btn-info item_edit" data="'+data[i].id+'"><span class="fa fa-pencil"></a>'+' '+
                                    '<a href="javascript:;" class="btn btn-danger  item_delete" data="'+data[i].id+'"><span class="fa fa-trash"></span></a>'+
                                    
                                '</td>'+
                                '</tr>';
                        }*/
                    }
                    $('#show_data').html(html);
                }
 
            });

        }


          //GET UPDATE
        $('#show_data').on('click','.item_edit',function(){
            var id=$(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('index.php/barang/unit/get_unit_masuk')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id, pemesanan_id, type_id, model_id, pressure, voltase, serial_number, status_id, tanggal_order, supplier_id, jumlah, nomor_po, tanggal, status_pemesanan, customer_id, nomor_penawaran, tanggal_po_customer, po_customer, keterangan){
                        $('#ModalEdit').modal('show');
                        $('[name="id"]').val(data.id);
                        $('[name="pemesanan_id"]').val(data.pemesanan_id);
                        $('[name="type_id"]').val(data.type_id);
                        $('[name="model_id"]').val(data.model_id);
                        $('[name="pressure"]').val(data.pressure);
                        $('[name="voltase"]').val(data.voltase);
                        $('[name="serial_number"]').val(data.serial_number);
                        $('[name="status_id"]').val(data.status_id);
                        $('[name="tanggal_order"]').val(data.tanggal_order);
                        $('[name="supplier_id"]').val(data.supplier_id);
                        $('[name="jumlah"]').val(data.jumlah);
                        $('[name="nomor_po"]').val(data.nomor_po);
                        $('[name="tanggal"]').val(data.tanggal);
                        $('[name="status_pemesanan"]').val(data.status_pemesanan);
                        $('[name="customer_id"]').val(data.customer_id);
                        $('[name="nomor_penawaran"]').val(data.nomor_penawaran);
                        $('[name="tanggal_po_customer"]').val(data.tanggal_po_customer);
                        $('[name="po_customer"]').val(data.po_customer);                        
                        $('[name="keterangan"]').val(data.keterangan);
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
            var id=$('#id').val();
            var pemesanan_id=$('#pemesanan_id').val();
            var type_id =$('#type_id').val();
            var model_id =$('#model_id').val();
            var pemesanan_id =$('#pemesanan_id').val();
            var serial_number=$('#serial_number').val();
            var pressure=$('#pressure').val();
            var voltase =$('#voltase').val();
            var status_id=$('#status_id').val();
            var tanggal_order=$('#tanggal_order').val();
            var supplier_id=$('#supplier_id').val();
            var jumlah=$('#jumlah').val();
            var nomor_po=$('#nomor_po').val();
            var tanggal=$('#tanggal').val();
            var status_pemesanan=$('#status_pemesanan').val();
            var customer_id=$('#customer_id').val();
            var nomor_penawaran=$('#nomor_penawaran').val();
            var tanggal_po_customer=$('#tanggal_po_customer').val();
            var po_customer=$('#po_customer').val();
            var keterangan=$('#keterangan').val();
           
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/barang/unit/update_unit_masuk')?>",
                dataType : "JSON",
                data : {id:id, pemesanan_id:pemesanan_id, type_id:type_id, model_id:model_id, pressure:pressure, voltase:voltase, serial_number:serial_number, status_id:status_id, tanggal_order:tanggal_order, supplier_id:supplier_id, jumlah:jumlah, nomor_po:nomor_po, tanggal:tanggal, status_pemesanan:status_pemesanan, customer_id:customer_id, nomor_penawaran:nomor_penawaran, tanggal_po_customer:tanggal_po_customer, po_customer:po_customer, keterangan:keterangan},
                success: function(data){
                    $('[name="id"]').val("");
                    $('[name="pemesanan_id"]').val("");
                    $('[name="type_id"]').val("");
                    $('[name="model_id"]').val("");
                    $('[name="pressure"]').val("");
                    $('[name="voltase"]').val("");
                    $('[name="serial_number"]').val("");
                    $('[name="status_id"]').val("");
                    $('[name="tanggal_order"]').val("");
                    $('[name="supplier_id"]').val("");
                    $('[name="jumlah"]').val("");
                    $('[name="nomor_po"]').val("");
                    $('[name="tanggal"]').val("");
                    $('[name="status_pemesanan"]').val("");
                    $('[name="customer_id"]').val("");
                    $('[name="nomor_penawaran"]').val("");
                    $('[name="tanggal_po_customer"]').val("");
                    $('[name="po_customer"]').val("");
                    $('[name="keterangan"]').val("");
                    $('#ModalEdit').modal('hide');
                    tampil_data_unit_masuk();
                    location.reload(true);
                }
            });
            return false;
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
                              location.reload(true);
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
                    placeholder: "-- Pilih Customer --"
                     initSelection: function(element, callback) {                   
                    }
                });
                
                $("#select2").select2("val", "");
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


<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>