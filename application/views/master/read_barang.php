<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />


<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Item Barang
        <small>data list item barang</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Item Barang</a></li>
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
                  <div class="pull-right"><a href="#" class="btn btn-success" data-toggle="modal" data-target="#ModalaAdd"><span class="fa fa-plus"></span></a></div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  
                <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                  
                    
                    <th>Part Number</th>
                    <th>Nama Barang</th>
                     <th>Jenis</th>
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
                <h3 class="modal-title" id="myModalLabel">Tambah Item Barang</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">               
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Part Number</label>
                        <div class="col-xs-9">
                            <input name="kode_barang" id="kode_barang" class="form-control" type="text" placeholder="Part Number" style="width:335px;" required>
                        </div>
                    </div>                       
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Barang</label>
                        <div class="col-xs-9">
                            <input name="nama_barang" id="nama_barang" class="form-control" type="text" placeholder="Nama Barang" style="width:335px;" required>
                        </div>
                    </div> 
                
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jenis</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_jenis_attribute = 'class="form-control select2" id="jenis_id" style="width:335px;"';
                                echo form_dropdown('jenis_id', $dd_jenis, $jenis_selected, $dd_jenis_attribute);
                            ?>
                        </div>
                    </div> 
                   
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
                        <label class="control-label col-xs-3" >Kode Barang</label>
                        <div class="col-xs-9">
                            <input name="kode_barangedit" id="kode_barang2" class="form-control" type="text" placeholder="" style="width:335px;" required>
                        </div>
                    </div>  

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Barang</label>
                        <div class="col-xs-9">
                            <input name="nama_barangedit" id="nama_barang2" class="form-control" type="text" placeholder="" style="width:335px;" required>
                        </div>
                    </div>  
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jenis</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_jenis_attribute = 'class="form-control select2" id="jenis_id2" style="width:335px;"';
                                echo form_dropdown('jenis_idedit', $dd_jenis, $jenis_selected, $dd_jenis_attribute);
                            ?>
                        </div>
                    </div> 

                     <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <input name="keteranganedit" id="keterangan2" class="form-control" type="text" placeholder="" style="width:335px;" required>
                        </div>
                    </div>  
                    <input type="hidden" name="idedit" id="id2">            
                     
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


        <!-- MODAL EDIT kode barang -->
        <div class="modal fade" id="ModalEdit2" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Edit Kode barang</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">

                 <div class="form-group">
                        <label class="control-label col-xs-3" >Kode Barang</label>
                        <div class="col-xs-9">
                            <input name="kode_barang" id="kode_barang" class="form-control" type="text" placeholder="" style="width:335px;" required>
                        </div>
                    </div>                       
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Kode Barang Baru</label>
                        <div class="col-xs-9">
                            <input name="kode_barangbaru" id="kode_barangbaru2" class="form-control" type="text" placeholder="" style="width:335px;" required>
                        </div>
                    </div>  

                   
                    <input type="hidden" name="ideditlama" id="idlama2">            
                     
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" id="btn_update2">Update</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <!--END MODAL EDIT kode barang-->

        <!--MODAL HAPUS-->
        <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                        <h4 class="modal-title" id="myModalLabel">Hapus Barang</h4>
                    </div>
                    <form class="form-horizontal">
                    <div class="modal-body">
                                           
                            <input type="hidden" name="id" id="textid" value="">
                            <div class="alert alert-danger"><p>Apakah Anda yakin mau menghapus item barang ini?</p></div>
                                         
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        tampil_data_barang();   //pemanggilan fungsi tampil.
         
        $('#example1').dataTable();
          
        //fungsi tampil barang
        function tampil_data_barang(){
            $.ajax({
                type  : 'GET',
                url   : '<?php echo base_url()?>index.php/page/data_barang',
                async : false,
                dataType : 'json',
               "processing": true,
                "serverSide": true,
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                                                               
                                '<td>'+data[i].kode_barang+'</td>'+
                                '<td>'+data[i].nama_barang+'</td>'+
                                '<td>'+data[i].nama_jenis+'</td>'+
                                 '<td>'+data[i].keterangan+'</td>'+                            
                                '<td style="text-align:right;">'+
                                     /*'<a href="javascript:;" class="btn btn-info  item_editkode_barang" data="'+data[i].id+'">P/N</span></a>'+' '+*/
                                    '<a href="javascript:;" class="btn btn-info  item_edit" data="'+data[i].id+'"><span class="fa fa-pencil"></span></a>'+' '+
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
                url  : "<?php echo base_url('index.php/page/get_barang')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id, kode_barang, nama_barang, jenis_id, keterangan){
                        $('#ModalEdit').modal('show');
                        $('[name="idedit"]').val(data.id);
                        $('[name="kode_barangedit"]').val(data.kode_barang);
                        $('[name="nama_barangedit"]').val(data.nama_barang);
                        $('[name="jenis_idedit"]').val(data.jenis_id);
                        $('[name="keteranganedit"]').val(data.keterangan);
                        
                    });
                }
            });
            return false;
        });

        //GET UPDATE kode barang
        /*$('#show_data').on('click','.item_editkode_barang',function(){
            var id=$(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php //echo base_url('index.php/page/get_kode_barangedit')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id, kode_barang, nama_barang, jenis_id, keterangan){
                        $('#ModalEdit2').modal('show');
                        $('[name="ideditlama"]').val(data.id);
                         $('[name="kode_barang"]').val(data.kode_barang);
                        $('[name="kode_barangbaru"]').val("");
                       
                        
                    });
                }
            });
            return false;
        });*/
         

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
            var nama_barang=$('#nama_barang').val();
            //var kategori_id=$('#kategori_id').val();
            var jenis_id=$('#jenis_id').val();
            var keterangan=$('#keterangan').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/page/simpan_barang')?>",
                dataType : "JSON",
               // data : {id:id , },
                data : {id:id, kode_barang:kode_barang, nama_barang:nama_barang, jenis_id:jenis_id, keterangan:keterangan},
                success: function(data){
                    $('[name="id"]').val("");
                    $('[name="kode_barang"]').val("");
                    $('[name="nama_barang"]').val("");
                    $('[name="jenis_id"]').val("");
                     $('[name="keterangan"]').val("");
                   
                    $('#ModalaAdd').modal('hide');
                     tampil_data_barang();
                      location.reload();
                }
            });
            return false;
        });
 
        //Update
        $('#btn_update').on('click',function(){
            var id=$('#id2').val();
            var kode_barang=$('#kode_barang2').val();
            var nama_barang=$('#nama_barang2').val();
            var jenis_id=$('#jenis_id2').val();
            var keterangan=$('#keterangan2').val();
           /* var nabar=$('#nama_barang2').val();
            var harga=$('#harga2').val();*/
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/page/update_barang')?>",
                dataType : "JSON",
                data : {id:id, kode_barang:kode_barang, nama_barang:nama_barang, jenis_id:jenis_id, keterangan:keterangan},
                success: function(data){
                    $('[name="idedit"]').val("");
                    $('[name="kode_barangedit"]').val("");
                    $('[name="nama_barangedit"]').val("");                    
                    $('[name="jenis_idedit"]').val("");
                    $('[name="keteranganedit"]').val("");
                    $('#ModalEdit').modal('hide');
                    tampil_data_barang();
                    location.reload();
                }
            });
            return false;
        });

        //Update kode barang
       /* $('#btn_update2').on('click',function(){
            var id=$('#idlama2').val();
            var kode_barang=$('#kode_barang').val();
            var kode_barangbaru=$('#kode_barangbaru2').val();
            
            $.ajax({
                type : "POST",
                url  : "<?php //echo base_url('index.php/page/update_kode_barang')?>",
                dataType : "JSON",
                data : {id:id, kode_barang:kode_barang, kode_barangbaru:kode_barangbaru},
                success: function(data){
                    $('[name="ideditlama"]').val("");
                    $('[name="kode_barang"]').val("");
                    $('[name="kode_barangbaru"]').val("");
                   
                    $('#ModalEdit2').modal('hide');
                    tampil_data_barang();
                    location.reload();
                }
            });
            return false;
        });*/
 
 
        //Delete
        $('#btn_delete').on('click',function(){
            var id=$('#textid').val();
            $.ajax({
            type : "POST",
            url  : "<?php echo base_url('index.php/page/delete_barang')?>",
            dataType : "JSON",
                    data : {id:id},
                    success: function(data){
                            $('#ModalDelete').modal('hide');
                             tampil_data_barang();
                              location.reload();
                    }
                });
                return false;
            });
 
    });


 $(".select2").select2({
                    placeholder: "Please Select"
                });
</script>


<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>