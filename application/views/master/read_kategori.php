<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.css'?>" rel="stylesheet" type="text/css">

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Kategeori
        <small>data list Kategeori</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Kategeori</a></li>
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
                  <div>
                   <bu<div class="pull-right"><a href="#" class="btn btn-success" data-toggle="modal" data-target="#ModalaAdd"><span class="fa fa-plus"></span> </a></div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  
                <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                  
                    <th>Nama kategori</th>
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
        <div class="modal fade" id="ModalaAdd" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Tambah</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">               
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama kategori</label>
                        <div class="col-xs-9">
                            <input name="nama_kategori" id="nama_kategori" class="form-control" type="text" placeholder="Nama kategori" style="width:335px;" required>
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
                        <label class="control-label col-xs-3" >Nama kategori</label>
                        <div class="col-xs-9">
                            <input name="nama_kategoriedit" id="nama_kategori2" class="form-control" type="text" placeholder="" style="width:335px;" required>
                        </div>
                    </div>  
                    <input type="hidden" name="idedit" id="id2" value="">            
                     
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
                        <h4 class="modal-title" id="myModalLabel">Hapus Kategori</h4>
                    </div>
                    <form class="form-horizontal">
                    <div class="modal-body">
                                           
                            <input type="hidden" name="id" id="textid" value="">
                            <div class="alert alert-warning"><p>Apakah Anda yakin mau menghapus kategori barang ini?</p></div>
                                         
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
<script type="text/javascript" src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datatables/jquery.dataTables.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.js'?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        tampil_data_kategori();   //pemanggilan fungsi tampil.
         
        $('#example1').dataTable();
          
        //fungsi tampil
        function tampil_data_kategori(){
            $.ajax({
                type  : 'GET',
                url   : '<?php echo base_url()?>page/data_kategori',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                                '<td>'+data[i].nama_kategori+'</td>'+
                                
                                '<td style="text-align:right;">'+
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
                url  : "<?php echo base_url('index.php/page/get_kategori')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id, nama_kategori){
                        $('#ModalEdit').modal('show');
                        $('[name="idedit"]').val(data.id);
                        $('[name="nama_kategoriedit"]').val(data.nama_kategori);
                        //$('[name="update_by"]').val(data.update_by);
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
            var nama_kategori=$('#nama_kategori').val();
            //var harga=$('#harga').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/page/save_kategori')?>",
                dataType : "JSON",
                data : {id:id , nama_kategori:nama_kategori},
                success: function(data){
                    $('[name="id"]').val("");
                    $('[name="nama_kategori"]').val("");
                   
                    $('#ModalaAdd').modal('hide');
                     tampil_data_kategori();
                      location.reload();
                }
            });
            return false;
        });
 
         //Update
        $('#btn_update').on('click',function(){
            var id=$('#id2').val();
           // var kode_barang=$('#kode_barang2').val();
            var nama_kategori=$('#nama_kategori2').val();
           /* var nabar=$('#nama_barang2').val();
            var harga=$('#harga2').val();*/
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/page/update_kategori')?>",
                dataType : "JSON",
                data : {id:id,  nama_kategori:nama_kategori},
                success: function(data){
                    $('[name="idedit"]').val("");                    
                    $('[name="nama_kategoriedit"]').val("");
                   
                    $('#ModalEdit').modal('hide');
                    tampil_data_kategori();
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
            url  : "<?php echo base_url('index.php/page/delete_kategori')?>",
            dataType : "JSON",
                    data : {id:id},
                    success: function(data){
                            $('#ModalDelete').modal('hide');
                             tampil_data_kategori();
                              location.reload();
                    }
                });
                return false;
            });
 
    });

</script>



<?php
$this->load->view('template/foot');
?>