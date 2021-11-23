<?php 
$this->load->view('template/head');
?>
<link src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datepicker/datepicker3.css'?>" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Pengiriman parsial pemesanan sparepart
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">parsial pemesanan barang</a></li>
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
                  
                <table id="example1" class="table table-bordered table-striped display nowrap">
            <thead>
                <tr>
                    <th>Part Number</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                    <th>Created BY</th>
                    <th>Keterangan</th>
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
                <h3 class="modal-title" id="myModalLabel">Konfirmasi Pemesanan Barang</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">    
               
                      <div class="form-group">
                        <label class="control-label col-xs-3" >Part Number</label>
                        <div class="col-xs-9">
                          <?php
                                $dd_barang_attribute = 'class="form-control select2" style="width:335px;" id="kode_barang"';
                                echo form_dropdown('kode_barang', $dd_kon_barang, $barang_selected, $dd_barang_attribute);
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
                        <label class="control-label col-xs-3" >Tanggal Konfirmasi</label>
                       <div class="col-xs-9">
                            <input name="tanggal" id="tanggal" class="form-control" placeholder="Masukan tanggal konfirmasi" style="width:335px;" required>
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
        <div class="modal fade" id="ModalEdit" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Edit</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">                     
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Part Number </label>
                        <div class="col-xs-9">
                            <input name="kode_barangedit" id="kode_barang2" class="form-control" type=""  style="width:335px;" disabled>
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
                        <label class="control-label col-xs-3" >Tanggal Konfirmasi</label>
                        <div class="col-xs-9">
                            <input name="tanggaledit" id="tanggal2" class="form-control" type="text"  style="width:335px;" required>
                        </div>
                    </div> 
                     
                     
                       
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
        <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                        <h4 class="modal-title" id="myModalLabel">Hapus Pemesanan Barang</h4>
                    </div>
                    <form class="form-horizontal">
                    <div class="modal-body">
                                           
                            <input type="hidden" name="id" id="textid" value="">
                            <div class="alert alert-warning"><p>Apakah Anda yakin mau menghapus pengiriman parsial pemesanan barang ini?</p></div>
                                         
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

<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js">
    
</script>
 <script src="<?php  echo base_url();?>kolam/AdminLTE-2.0.5/plugins/datepicker/bootstrap-datepicker.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script>
            $(function () {
            //Date picker
            $('#tanggal_order').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true    }); 

            $('#tanggal').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true    }); 

            //Date picker
            $('#tanggal_order2').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true    }); 

            $('#tanggal2').datepicker({
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
        konfirmasi_order_barang();   //pemanggilan fungsi tampil.
         
        $('#example1').DataTable( {
            "scrollX": true
        } );
          
        //fungsi tampil barang
        function konfirmasi_order_barang(){
            $.ajax({
                type  : 'GET',
                url   : '<?php echo base_url()?>index.php/admin/order/data_konfirmasi_pemesanan_sparepart',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                       html += '<tr>'+
                                               '<td>'+data[i].kode_barang+'</td>'+
                                                '<td>'+data[i].nama_barang+'</td>'+
                                                '<td>'+data[i].jumlah+'</td>'+
                                                '<td>'+data[i].tanggal+'</td>'+
                                                '<td>'+data[i].nama+'</td>'+         
                                                '<td>'+data[i].keterangan+'</td>'+
                                                
                                                '<td width="8%">'+
                                     <?php
                  if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2')
                    { ?>
                                    
                                    '<a href="javascript:;" class="btn btn-info  item_edit" data="'+data[i].id+'"><span class="fa fa-pencil"></span></a>'+' '+
                                    '<a href="javascript:;" class="btn btn-danger  item_delete" data="'+data[i].id+'"><span class="fa fa-trash"></span></a>'+ <?php } ?>
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
                url  : "<?php echo base_url('index.php/admin/order/get_konfirmasi_order')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id, kode_barang, jumlah, tanggal, keterangan)
                    {
                        $('#ModalEdit').modal('show');
                        $('[name="idedit"]').val(data.id);
                        $('[name="kode_barangedit"]').val(data.kode_barang);
                        $('[name="jumlahedit"]').val(data.jumlah);                        
                        $('[name="tanggaledit"]').val(data.tanggal);                       
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
            var id=$('#id').val(); 
            var kode_barang=$('#kode_barang').val();
            var jumlah=$('#jumlah').val();      
            var tanggal=$('#tanggal').val();
            var keterangan=$('#keterangan').val();
           
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/admin/order/save_konfirmasi_order')?>",
                dataType : "JSON",
                data : {id:id,  kode_barang:kode_barang, jumlah:jumlah, tanggal:tanggal, keterangan:keterangan},
                success: function(data){       
                    $('[name="id"]').val("");                      
                    $('[name="kode_barang"]').val("");
                    $('[name="jumlah"]').val("");                    
                    $('[name="tanggal"]').val("");                                                                      
                    $('[name="keterangan"]').val("");
                    //$('[name="status"]').val("");                    
                    $('#ModalaAdd').modal('hide');
                     konfirmasi_order_barang();
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
            var tanggal=$('#tanggal2').val();            
            var keterangan=$('#keterangan2').val();
           /* var nabar=$('#nama_barang2').val();
            var harga=$('#harga2').val();*/
             $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/admin/order/update_konfirmasi_order')?>",
                dataType : "JSON",
                data : {id:id, kode_barang:kode_barang, jumlah:jumlah, tanggal:tanggal, keterangan:keterangan},
                success: function(data)
                {
                    $('[name="idedit"]').val("");                           
                    $('[name="kode_barangedit"]').val("");
                    $('[name="jumlahedit"]').val("");           
                    $('[name="tanggaledit"]').val("");                   
                    $('[name="keteranganedit"]').val("");
                    $('#ModalEdit').modal('hide');
                    konfirmasi_order_barang();
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
            url  : "<?php echo base_url('index.php/admin/order/delete_konfirmasi_order')?>",
            dataType : "JSON",
                    data : {id:id},
                    success: function(data){
                            $('#ModalDelete').modal('hide');
                             konfirmasi_order_barang();
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

