<html>
<head>
    <meta charset="utf-8">
    <title>List lokasi</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/jquery.dataTables.css'?>">
</head>
<body>
<div class="container">
    <?php $this->load->view('menu');?> <!--Include menu-->
    <!-- Page Heading -->
        
            <h1 class="page-header">Data
                <small>Lokasi</small>
                <div class="pull-right"><a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ModalaAdd"><span class="fa fa-plus"></span> Tambah lokasi</a></div>
            </h1>
      
    
        <table class="table table-striped" id="mydata">
            <thead>
                <tr>
                  
                    <th>Nama lokasi</th>
                    <th>Ruang</th>
                    <th>Rak</th>
                    <th>Tingkat</th>
                    <th>keterangan</th>
                    <th style="text-align: right;">Aksi</th>
                    
                </tr>
            </thead>
            <tbody id="show_data">
                 
            </tbody>
        </table>
   
</div>
 
<!-- MODAL ADD -->
        <div class="modal fade" id="ModalaAdd" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Lokasi</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">               
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama lokasi</label>
                        <div class="col-xs-9">
                            <input name="nama_lokasi" id="nama_lokasi" class="form-control" type="text" placeholder="Nama lokasi" style="width:335px;" required>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Ruang</label>
                        <div class="col-xs-9">
                            <input name="ruang" id="ruang" class="form-control" type="text" placeholder="Ruang" style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Rak</label>
                        <div class="col-xs-9">
                            <input name="rak" id="rak" class="form-control" type="text" placeholder="Rak" style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tingkat</label>
                        <div class="col-xs-9">
                            <input name="tingkat" id="tingkat" class="form-control" type="text" placeholder="Tingkat" style="width:335px;" required>
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
                        <label class="control-label col-xs-3" >Nama lokasi</label>
                        <div class="col-xs-9">
                            <input name="nama_lokasiedit" id="nama_lokasi2" class="form-control" type="text"  style="width:335px;" required>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Ruang</label>
                        <div class="col-xs-9">
                            <input name="ruangedit" id="ruang2" class="form-control" type="text"  style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Rak</label>
                        <div class="col-xs-9">
                            <input name="rakedit" id="rak2" class="form-control" type="text"  style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tingkat</label>
                        <div class="col-xs-9">
                            <input name="tingkatedit" id="tingkat2" class="form-control" type="text"  style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <input name="keteranganedit" id="keterangan2" class="form-control" type="text"  style="width:335px;" required>
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
                        <h4 class="modal-title" id="myModalLabel">Hapus Barang</h4>
                    </div>
                    <form class="form-horizontal">
                    <div class="modal-body">
                                           
                            <input type="hidden" name="id" id="textid" value="">
                            <div class="alert alert-warning"><p>Apakah Anda yakin mau menghapus lokasi barang ini?</p></div>
                                         
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



<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.dataTables.js'?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        tampil_data_lokasi();   //pemanggilan fungsi tampil.
         
        $('#mydata').dataTable();
          
        //fungsi tampil barang
        function tampil_data_lokasi(){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo base_url()?>index.php/page/data_lokasi',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                                '<td>'+data[i].nama_lokasi+'</td>'+
                                '<td>'+data[i].ruang+'</td>'+
                                '<td>'+data[i].rak+'</td>'+
                                '<td>'+data[i].tingkat+'</td>'+
                                '<td>'+data[i].keterangan+'</td>'+
                                
                                '<td style="text-align:right;">'+
                                    '<a href="javascript:;" class="btn btn-info btn-xs item_edit" data="'+data[i].id+'">Edit</a>'+' '+
                                    '<a href="javascript:;" class="btn btn-danger btn-xs item_delete" data="'+data[i].id+'">Hapus</a>'+
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
                url  : "<?php echo base_url('index.php/page/get_lokasi')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id, nama_lokasi,ruang,rak,tingkat,keterangan){
                        $('#ModalEdit').modal('show');
                        $('[name="idedit"]').val(data.id);
                        $('[name="nama_lokasiedit"]').val(data.nama_lokasi);
                        $('[name="ruangedit"]').val(data.ruang);
                        $('[name="rakedit"]').val(data.rak);
                        $('[name="tingkatedit"]').val(data.tingkat);
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
            var nama_lokasi=$('#nama_lokasi').val();
            var ruang=$('#ruang').val();
            var rak=$('#rak').val();
            var tingkat=$('#tingkat').val();
            var keterangan=$('#keterangan').val();
            //var harga=$('#harga').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/page/save_lokasi')?>",
                dataType : "JSON",
                data : {id:id , nama_lokasi:nama_lokasi, ruang:ruang, rak:rak, tingkat:tingkat, keterangan:keterangan},
                success: function(data){
                    $('[name="id"]').val("");
                    $('[name="nama_lokasi"]').val("");
                    $('[name="ruang"]').val("");
                    $('[name="rak"]').val("");
                    $('[name="tingkat"]').val("");
                    $('[name="keterangan"]').val("");
                   
                    $('#ModalaAdd').modal('hide');
                     tampil_data_lokasi();
                      location.reload();
                }
            });
            return false;
        });
 
        //Update
        $('#btn_update').on('click',function(){
            var id=$('#id2').val();
            var nama_lokasi=$('#nama_lokasi2').val();
           /* var nabar=$('#nama_barang2').val();
            var harga=$('#harga2').val();*/
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/page/update_lokasi')?>",
                dataType : "JSON",
                data : {nama_lokasi:nama_lokasi},
                success: function(data){
                    $('[name="idedit"]').val("");
                    $('[name="nama_lokasiedit"]').val("");
                    /*$('[name="nabar_edit"]').val("");
                    $('[name="harga_edit"]').val("");*/
                    $('#ModalEdit').modal('hide');
                    tampil_data_barang();
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
            url  : "<?php echo base_url('index.php/page/delete_lokasi')?>",
            dataType : "JSON",
                    data : {id:id},
                    success: function(data){
                            $('#ModalDelete').modal('hide');
                             tampil_data_lokasi();
                              location.reload();
                    }
                });
                return false;
            });
 
    });



 
</script>
</body>
</html>