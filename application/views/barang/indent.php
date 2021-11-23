<?php 
$this->load->view('template/head');
?>
<link src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datepicker/datepicker3.css'?>" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      Barang Indent
        <small>data list barang indeneet</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">barang indent</a></li>
        <li class="active">list</li>
    </ol>
</section>
      
    
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Hover Data Table</h3>
                  <div class="pull-right"><a href="" class="btn btn-success" data-toggle="modal" data-target="#ModalaAdd"><span class="fa fa-plus"></span></a></div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  
                <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Part Number</th>
                   <!-- <th>Nama Barang</th>-->
                    <th>Jumlah</th>
                    <th>Customer</th>
                    <th>Nomor Order</th>
                    <th>Tanggal Order</th>
                   <!-- <th>Estimasi Barang sampai</th>-->
                    <th>Order By</th>    
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th style="text-align: right;">Aksi</th>
                    
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
 
        <div class="modal fade" id="ModalaAdd" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Barang Indent</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">    
               
                     <div class="form-group">
                        <label class="control-label col-xs-3" >Part Number</label>
                        <div class="col-xs-9">
                          <?php
                                $dd_barang_attribute = 'class="form-control select2" style="width:335px;" id="kode_barang"';
                                echo form_dropdown('kode_barang', $dd_barang, $barang_selected, $dd_barang_attribute);
                            ?>
                        </div>
                    </div>                      
                    
                   
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jumlah</label>
                        <div class="col-xs-9">
                            <input name="jumlah" id="jumlah" class="form-control" type="text" placeholder="Masukan jumlah" style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Customer</label>
                        <div class="col-xs-9">
                          <?php
                                $dd_customer_attribute = 'class="form-control select2" style="width:335px;" id="customer_id"';
                                echo form_dropdown('customer_id', $dd_customer, $customer_selected, $dd_customer_attribute);
                            ?>
                        </div>
                    </div>    
                     <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal Order</label>
                       <div class="col-xs-9">
                            <input name="tanggal_pesan" id="tanggal_pesan" class="form-control" placeholder="Masukan tanggal Order" style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor PO</label>
                        <div class="col-xs-9">
                            <input name="no_order" id="no_order" class="form-control" type="text" placeholder="Masukan Nomor PO" style="width:335px;" required>
                        </div>
                    </div>
                   <!-- <div class="form-group">
                        <label class="control-label col-xs-3" >Estimasi Order Sampai</label>
                        <div class="col-xs-9">
                            <input name="tanggal_sampai" id="tanggal_sampai" class="form-control" type="text" placeholder="Masukan Estimasi Order sampai" style="width:335px;" required>
                        </div>
                    </div>--> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" > Order By</label>
                        <div class="col-xs-9">
                            <input name="order_by" id="order_by" class="form-control" type="text" placeholder="Masukan Order by" style="width:335px;" required>
                        </div>
                    </div> 
                    
                                        

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <textarea name="keterangan" id="keterangan" class="form-control" type="text" placeholder="Masukan Keterangan" style="width:335px;" required> </textarea>
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

        

        <!-- MODAL EDIT -->
        <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Edit</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">                     
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Part Number</label>
                        <div class="col-xs-9">
                            <input name="kode_barangedit" id="kode_barang2" class="form-control" type="text"  style="width:335px;">
                        </div>
                    </div>  
                    <input type="hidden" name="idedit" id="id2" value=""> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jumlah</label>
                        <div class="col-xs-9">
                            <input name="jumlahedit" id="jumlah2" class="form-control" type="text"  style="width:335px;" required>
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
                        <label class="control-label col-xs-3" >Nomor Order</label>
                        <div class="col-xs-9">
                            <input name="no_orderedit" id="no_order2" class="form-control" type="text"  style="width:335px;" required>
                        </div>
                    </div> 
                     <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal Order</label>
                        <div class="col-xs-9">
                            <input name="tanggal_pesanedit" id="tanggal_pesan2" class="form-control" type="text"  style="width:335px;" required>
                        </div>
                    </div> 
                     
                     <div class="form-group">
                        <label class="control-label col-xs-3" >Estimasi Order Sampai</label>
                        <div class="col-xs-9">
                            <input name="tanggal_sampaiedit" id="tanggal_sampai2" class="form-control" type="text"  style="width:335px;" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Order By</label>
                        <div class="col-xs-9">
                            <input name="order_byedit" id="order_by2" class="form-control" type="text"  style="width:335px;" required>
                        </div>
                    </div> 
                     <div class="form-group">
                        <label class="control-label col-xs-3" >Status</label>
                        <div class="col-xs-9">
                           <select name="statusedit" id="status2" class="form-control" style="width:335px;" required>
                            <option value="">Pilih Status Order</option>
                                <option value="0">Pending</option>
                                <option value="1">Selesai</option>
                            </select>
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <textarea name="keteranganedit" id="keterangan2" class="form-control" type="text" placeholder="Masukan Keterangan" style="width:335px;" required> </textarea>
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
                        <h4 class="modal-title" id="myModalLabel">Hapus Barang Indent</h4>
                    </div>
                    <form class="form-horizontal">
                    <div class="modal-body">
                                           
                            <input type="hidden" name="id" id="textid" value="">
                            <div class="alert alert-warning"><p>Apakah Anda yakin mau menghapus barang indent ini?</p></div>
                                         
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
<script type="text/javascript" src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datatables/jquery.dataTables.js'?>">
    
</script>
<script type="text/javascript" src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.js'?>">
    
</script>
 <script src="<?php  echo base_url();?>kolam/AdminLTE-2.0.5/plugins/datepicker/bootstrap-datepicker.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script>
            $(function () {
            //Date picker
            $('#tanggal_pesan').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true    }); 

            $('#tanggal_sampai').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true    });     
            });   

             $(function () {
            $('#tanggal_pesan2').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true    }); 

            $('#tanggal_sampai2').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true    });     
            });                   

            $(document).ready(function () {
                $(".select2").select2({
                    placeholder: "Please Select"
                });
            });


        </script>
<script type="text/javascript">
    $(document).ready(function(){
        tampil_data_barang_indent();   //pemanggilan fungsi tampil.
         
        $('#example1').dataTable();
          
        //fungsi tampil barang
        function tampil_data_barang_indent(){
            $.ajax({
                type  : 'GET',
                url   : '<?php echo base_url()?>index.php/admin/order/data_indent',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                       var status = data[i].status;
                        if(status == 1){
                                                html += '<tr>'+
                                                '<td>'+data[i].kode_barang+'</td>'+
                                                //'<td>'+data[i].nama_barang+'</td>'+
                                                '<td>'+data[i].jumlah+'</td>'+
                                                '<td>'+data[i].nama_customer+'</td>'+
                                                '<td>'+data[i].no_order+'</td>'+
                                                '<td>'+data[i].tanggal_pesan+'</td>'+                                
                                                //'<td>'+data[i].tanggal_sampai+'</td>'+                                
                                                '<td>'+data[i].order_by+'</td>'+
                                                '<td>'+data[i].keterangan+'</td>'+
                                                '<td>'+' <small class="label label-info">Selesai</small>'+'</td>'+ 
                                                '<td style="text-align:right;">'+
                                     <?php
                  if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2')
                    { ?>
                                    '<a href="javascript:;" class="btn-sm btn-info  item_edit" data="'+data[i].id+'"><span class="fa fa-pencil"></span></a>'+' '+
                                    '<a href="javascript:;" class="btn-sm btn-danger  item_delete" data="'+data[i].id+'"><span class="fa fa-trash"></span></a>'+ <?php } ?>
                                '</td>'+
                                '</tr>';
                        }else{
                                html += '<tr>'+
                                                '<td>'+data[i].kode_barang+'</td>'+
                                               // '<td>'+data[i].nama_barang+'</td>'+
                                                '<td>'+data[i].jumlah+'</td>'+
                                                '<td>'+data[i].nama_customer+'</td>'+
                                                '<td>'+data[i].no_order+'</td>'+
                                                '<td>'+data[i].tanggal_pesan+'</td>'+                                
                                                //'<td>'+data[i].tanggal_sampai+'</td>'+                                
                                                '<td>'+data[i].order_by+'</td>'+
                                                '<td>'+data[i].keterangan+'</td>'+
                                                '<td>'+' <small class="label label-danger">Pending</small>'+'</td>'+ 
                                                '<td style="text-align:right;">'+
                                     <?php
                  if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2')
                    { ?>
                                    
                                    '<a href="javascript:;" class="btn-sm btn-info  item_edit" data="'+data[i].id+'"><span class="fa fa-pencil"></span></a>'+' '+
                                    '<a href="javascript:;" class="btn-sm btn-danger  item_delete" data="'+data[i].id+'"><span class="fa fa-trash"></span></a>'+ <?php } ?>
                                '</td>'+
                                '</tr>';
                             }
                       
                             
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
                url  : "<?php echo base_url('index.php/admin/order/get_indent')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id, kode_barang, jumlah, no_order, tanggal_pesan, tanggal_sampai, order_by, customer_id, keterangan, status){
                        $('#ModalEdit').modal('show');
                        $('[name="idedit"]').val(data.id);
                        $('[name="kode_barangedit"]').val(data.kode_barang);
                        $('[name="jumlahedit"]').val(data.jumlah);
                        $('[name="customer_idedit"]').val(data.customer_id);
                        $('[name="no_orderedit"]').val(data.no_order);
                        $('[name="tanggal_pesanedit"]').val(data.tanggal_pesan);
                        $('[name="order_byedit"]').val(data.order_by);
                        $('[name="tanggal_sampaiedit"]').val(data.tanggal_sampai);
                        $('[name="statusedit"]').val(data.status);
                        $('[name="keteranganedit"]').val(data.keterangan);
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


        //Save
        $('#btn_simpan').on('click',function(){
            //var id=$('#id').val();
            var kode_barang=$('#kode_barang').val();
            var jumlah=$('#jumlah').val();
            var customer_id=$('#customer_id').val();
            var tanggal_pesan=$('#tanggal_pesan').val();
            var no_order=$('#no_order').val();            
            //var tanggal_sampai=$('#tanggal_sampai').val();
            var order_by=$('#order_by').val();
            var keterangan=$('#keterangan').val();
           // var status=$('#status').val();
           
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/admin/order/save_indent')?>",
                dataType : "JSON",
                data : {kode_barang:kode_barang, jumlah:jumlah, customer_id:customer_id, tanggal_pesan:tanggal_pesan, no_order:no_order, order_by:order_by, keterangan:keterangan},
                success: function(data){       
                    //$('[name="id"]').val("");            
                    $('[name="kode_barang"]').val("");
                    $('[name="jumlah"]').val("");
                    $('[name="customer_id"]').val("");
                    $('[name="tanggal_pesan"]').val("");
                    $('[name="no_order"]').val("");
                    //$('[name="tanggal_sampai"]').val("");
                    $('[name="order_by"]').val("");                                                        
                    $('[name="keterangan"]').val("");
                    //$('[name="status"]').val("");                    
                    $('#ModalaAdd').modal('hide');
                     tampil_data_barang_indent();
                      location.reload();
                }
            });
            return false;
        });   



 
        //Update
        $('#btn_update').on('click',function(){
            var id=$('#id2').val();
            var kode_barang=$('#kode_barang2').val();
            var jumlah=$('#jumlah2').val();
            var order_by=$('#order_by2').val();
            var customer_id=$('#customer_id2').val();
            var no_order=$('#no_order2').val();            
            var tanggal_pesan=$('#tanggal_pesan2').val();           
            var tanggal_sampai=$('#tanggal_sampai2').val();            
            var keterangan=$('#keterangan2').val();
            var status=$('#status2').val();
            
             $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/admin/order/update_indent')?>",
                dataType : "JSON",
                data : {id:id, kode_barang:kode_barang, jumlah:jumlah, order_by:order_by, customer_id:customer_id, no_order:no_order, tanggal_pesan:tanggal_pesan,  tanggal_sampai:tanggal_sampai,  keterangan:keterangan, status:status},
                success: function(data){
                    $('[name="idedit"]').val("");            
                    $('[name="kode_barangedit"]').val("");
                    $('[name="jumlahedit"]').val("");
                    $('[name="customer_idedit"]').val("");
                    $('[name="no_orderedit"]').val("");
                    $('[name="tanggal_pesanedit"]').val("");                    
                    $('[name="tanggal_sampaiedit"]').val(""); 
                    $('[name="order_byedit"]').val("");                  
                    $('[name="keteranganedit"]').val("");
                    $('[name="statusedit"]').val("");
                    $('#ModalEdit').modal('hide');
                    tampil_data_barang_indent();
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
            url  : "<?php echo base_url('index.php/admin/order/delete_indent')?>",
            dataType : "JSON",
                    data : {id:id},
                    success: function(data){
                            $('#ModalDelete').modal('hide');
                             tampil_data_barang_indent();
                              location.reload();
                    }
                });
                return false;
            });

 
    });



 
</script>
<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>

