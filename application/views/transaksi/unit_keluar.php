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
        Unit Keluar
        <small>data list unit Keluar</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Unit Keluar</a></li>
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
                  <div class="pull-right"><a href="<?php echo base_url().'index.php/barang/unit/add_unit_keluar'?>" class="btn  btn-success"  ><span class="fa fa-plus"></span> </a></div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  
                <table id="example1" class="table table-bordered table-striped display nowrap" width="100%">
            <thead>
                <tr>
                    <th>Type Unit</th>
                    <th>Model Unit</th>
                    <th>Serial Number</th>
                    <th>Pressure</th>
                    <th>Voltase</th>
                    <th>Customer</th>
                    <th>Jumlah</th>
                    <th>Tanggal PO Customer</th>                                      
                    <th>Nomor PO</th>
                    <th>Nomor Surat Jalan</th>     
                    <th>Tanggal Pengiriman</th>
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
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h3 class="modal-title" id="myModalLabel">Edit</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">           
                      <div class="form-group">
                        <label class="control-label col-xs-3" >Type Unit</label>
                        <div class="col-xs-9">
                            <input name="type_id" id="type_id" class="form-control" type="text" placeholder="" style="width:335px;" readonly>
                        </div>
                    </div>  

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Model Unit</label>
                        <div class="col-xs-9">
                            <input name="model_id" id="model_id" class="form-control" type="text" placeholder="" style="width:335px;" readonly>
                        </div>
                    </div>  

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Serial Number</label>
                        <div class="col-xs-9">
                            <input name="serial_number" id="serial_number" class="form-control" type="text" placeholder="" style="width:335px;" readonly>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Pressure</label>
                        <div class="col-xs-9">
                            <input name="pressure" id="pressure" class="form-control" type="text" placeholder="" style="width:335px;" readonly>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Voltase</label>
                        <div class="col-xs-9">
                            <input name="voltase" id="voltase" class="form-control" type="text" placeholder="" style="width:335px;" readonly>
                        </div>
                    </div> 

                     <input name="status_id" id="status_id" class="form-control" type="hidden" style="width:335px;" required>

                      <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal PO Customer</label>
                        <div class="col-xs-9">
                            <input name="tanggal_po_customer" id="tanggal_po_customer" class="form-control" placeholder="tanggal" style="width:335px;" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Customer</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_customer_attribute = 'class="form-control select2"  style="width:335px;" id="customer_id"';
                                echo form_dropdown('customer_id', $dd_customer, $customer_selected, $dd_customer_attribute);
                            ?>
                        </div>
                    </div> 
                    

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jumlah</label>
                        <div class="col-xs-9">
                            <input name="jumlah" id="jumlah" class="form-control" type="text" placeholder="Jumlah" style="width:335px;" required>
                        </div>
                    </div> 
                   
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor PO</label>
                        <div class="col-xs-9">
                            <input name="nomor_po" id="nomor_po" class="form-control" type="text" placeholder="nomor_po" style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor Surat Jalan</label>
                        <div class="col-xs-9">
                            <input name="nomor_surat_jalan" id="nomor_surat_jalan" class="form-control" type="text" placeholder="Nomor Surat Jalan" style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal</label>
                        <div class="col-xs-9">
                            <input name="tanggal" id="tanggal" class="form-control" placeholder="tanggal" style="width:335px;" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <input name="keterangan" id="keterangan" class="form-control" type="text" placeholder="Keterangan" style="width:335px;" required>
                        </div>
                    </div> 
                     <input name="id" id="id" class="form-control" type="hidden"  style="width:335px;" required>
                        
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
                            <div class="alert alert-warning"><p>Apakah Anda yakin mau menghapus unit keluar ini?</p></div>
                                         
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
        tampil_data_unit_keluar();   //pemanggilan fungsi tampil.
         
        $('#example1').DataTable( {
            "scrollX": true
        } );
          
        //fungsi tampil barang
        function tampil_data_unit_keluar(){
            $.ajax({
                type  : 'GET',
                url   : '<?php echo base_url()?>index.php/barang/unit/data_unit_keluar',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                                                        
                                '<td>'+data[i].nama_unit+'</td>'+ 
                                '<td>'+data[i].model+'</td>'+                                
                                '<td>'+data[i].serial_number+'</td>'+
                                '<td>'+data[i].pressure+'</td>'+
                                '<td>'+data[i].voltase+'</td>'+
                                '<td>'+data[i].nama_customer+'</td>'+                                
                                '<td>'+data[i].jumlah+'</td>'+
                                '<td>'+data[i].tanggal_po_customer+'</td>'+                               
                                '<td>'+data[i].nomor_po+'</td>'+
                                '<td>'+data[i].nomor_surat_jalan+'</td>'+
                                '<td>'+data[i].tanggal+'</td>'+
                                '<td>'+data[i].keterangan+'</td>'+                                
                                '<td style="text-align:right;">'+
                                    '<a href="javascript:;" class="btn btn-info item_edit" data="'+data[i].id+'"><span class="fa fa-pencil"></a>'+' '+
                                    '<a href="javascript:;" class="btn btn-danger  item_delete" data="'+data[i].id+'"><span class="fa fa-trash"></span></a>'+
                                    
                                '</td>'+
                                '</tr>';
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
                url  : "<?php echo base_url('index.php/barang/unit/get_unit_keluar')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id, type_id, model_id, serial_number, pressure, voltase, status_id, customer_id, jumlah, tanggal_po_customer, nomor_po, nomor_surat_jalan, tanggal, keterangan){
                        $('#ModalEdit').modal('show');
                        $('[name="id"]').val(data.id);
                        $('[name="type_id"]').val(data.type_id);
                        $('[name="model_id"]').val(data.model_id);
                        $('[name="serial_number"]').val(data.serial_number);
                        $('[name="pressure"]').val(data.pressure);
                        $('[name="voltase"]').val(data.voltase);
                        $('[name="status_id"]').val(data.status_id);
                        $('[name="customer_id"]').val(data.customer_id);
                        $('[name="jumlah"]').val(data.jumlah);
                        $('[name="tanggal_po_customer"]').val(data.tanggal_po_customer);
                        $('[name="nomor_po"]').val(data.nomor_po);
                        $('[name="nomor_surat_jalan"]').val(data.nomor_surat_jalan);
                        $('[name="tanggal"]').val(data.tanggal);                        
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
            var type_id=$('#type_id').val();
            var model_id=$('#model_id').val();
            var serial_number=$('#serial_number').val();
            var pressure=$('#pressure').val();
            var voltase=$('#voltase').val();
            var status_id=$('#status_id').val();
            var tanggal_po_customer=$('#tanggal_po_customer').val();
            var customer_id=$('#customer_id').val();
            var jumlah=$('#jumlah').val();            
            var nomor_po=$('#nomor_po').val();
            var nomor_surat_jalan=$('#nomor_surat_jalan').val();
            var tanggal=$('#tanggal').val();
            var keterangan=$('#keterangan').val();
           
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/barang/unit/update_unit_keluar')?>",
                dataType : "JSON",
                data : {id:id, type_id:type_id, model_id:model_id, serial_number:serial_number, pressure:pressure, voltase:voltase, status_id:status_id, tanggal_po_customer:tanggal_po_customer, customer_id:customer_id, jumlah:jumlah, nomor_po:nomor_po, nomor_surat_jalan:nomor_surat_jalan, tanggal:tanggal, keterangan:keterangan},
                success: function(data){
                    $('[name="id"]').val("");
                    $('[name="type_id"]').val("");
                    $('[name="model_id"]').val("");
                    $('[name="serial_number"]').val("");
                    $('[name="pressure"]').val("");
                    $('[name="voltase"]').val("");
                    $('[name="status_id"]').val("");
                    $('[name="tanggal_po_customer"]').val("");
                    $('[name="customer_id"]').val("");
                    $('[name="jumlah"]').val("");                    
                    $('[name="nomor_po"]').val("");
                    $('[name="nomor_surat_jalan"]').val("");
                    $('[name="tanggal"]').val("");
                    $('[name="keterangan"]').val("");
                    $('#ModalEdit').modal('hide');
                    tampil_data_unit_keluar();
                    location.reload();
                }
            });
            return false;
        });
 
        
 
 
        //Delete
        $('#btn_delete').on('click',function(){
            var id=$('#textid').val();
            $.ajax({
            type : "POST",
            url  : "<?php echo base_url('index.php/barang/unit/delete_unit_keluar')?>",
            dataType : "JSON",
                    data : {id:id},
                    success: function(data){
                            $('#ModalDelete').modal('hide');
                             tampil_data_unit_keluar();
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


<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>