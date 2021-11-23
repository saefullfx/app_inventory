<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Admin
        <small>data list Admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Admin</a></li>
        <li class="active">list</li>
    </ol>
</section>
        
            
      
    
       <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Admin</h3>
                  <div class="pull-right"><a href="#" class="btn btn-success" data-toggle="modal" data-target="#ModalaAdd"><span class="fa fa-plus"></span></a></div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  
                <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                  
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Password</th>
                    <th>Level</th>
                    
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
                <h3 class="modal-title" id="myModalLabel">Add Admin</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">               
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >NIP</label>
                        <div class="col-xs-9">
                            <input name="nip" id="nip" class="form-control" type="text" placeholder="Masukan NIP" style="width:335px;" required>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama</label>
                        <div class="col-xs-9">
                            <input name="nama" id="nama" class="form-control" type="text" placeholder="Nama Admin" style="width:335px;" required>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Password</label>
                        <div class="col-xs-9">
                            <input name="pass" id="pass" class="form-control" type="password" placeholder="********" style="width:335px;" required>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Level</label>
                        <div class="col-xs-9">
                            <select name="level" id="level" class="form-control" type="text"  style="width:335px;" required>
<option value="1">1</option>
<option value="2">2</option>

</select>
                         
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
                        <label class="control-label col-xs-3" >NIP</label>
                        <div class="col-xs-9">
                            <input name="nip" id="nip2" class="form-control" type="text" placeholder="Masukan NIP" style="width:335px;" required>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama</label>
                        <div class="col-xs-9">
                            <input name="nama" id="nama2" class="form-control" type="text" placeholder="Nama User" style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Password</label>
                        <div class="col-xs-9">
                            <input name="pass" id="pass2" class="form-control" type="password" placeholder="********" style="width:335px;" required>
                        </div>
                    </div>   

                      <div class="form-group">
                        <label class="control-label col-xs-3" >Level</label>
                        <div class="col-xs-9">
                            <select name="level" id="level2" class="form-control" type="text"  style="width:335px;" required>
<option value="1">1</option>
<option value="2">2</option>

</select>
                         
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
                        <h4 class="modal-title" id="myModalLabel">Hapus User</h4>
                    </div>
                    <form class="form-horizontal">
                    <div class="modal-body">
                                           
                            <input type="hidden" name="nip" id="textid" value="">
                            <div class="alert alert-warning"><p>Apakah Anda yakin mau menghapus user ini?</p></div>
                                         
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button class="btn_delete btn btn-warning" id="btn_delete">Hapus</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!--END MODAL HAPUS-->



<?php 
$this->load->view('template/js');
?>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        tampil_data_admin();   //pemanggilan fungsi tampil.
         
         $('#example1').dataTable();

        
          
        //fungsi tampil
        function tampil_data_admin(){
            $.ajax({
                type  : 'GET',
                url   : '<?php echo base_url()?>admin/user/data_admin',
                async : false,
                contentType: "application/json; charset=utf-8",
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                                '<td>'+data[i].nip+'</td>'+
                                '<td>'+data[i].nama+'</td>'+
                                
                                '<td>'+data[i].pass+'</td>'+
                                '<td>'+data[i].level+'</td>'+
                                
                                
                                '<td style="text-align:right;">'+

                                    '<a href="javascript:;" class="btn btn-info  item_edit" data="'+data[i].nip+'"><span class="fa fa-pencil"></span></a>'+' '+
                                    '<a href="javascript:;" class="btn btn-danger  item_delete" data="'+data[i].nip+'"><span class="fa fa-trash"></span></a>'+
                                '</td>'+
                                '</tr>';
                    }
                    $('#show_data').html(html);
                }
 
            });

                      

        }

        //GET UPDATE
        $('#show_data').on('click','.item_edit',function(){
            var nip=$(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('admin/user/get_admin')?>",
                dataType : "JSON",
                data : {nip:nip},
                success: function(data){
                    $.each(data,function(nip, nama, pass, level){
                        $('#ModalEdit').modal('show');
                        $('[name="nip"]').val(data.nip);
                        $('[name="nama"]').val(data.nama);
                        $('[name="pass"]').val(data.pass);
                        $('[name="level"]').val(data.level);
                        
                    });
                }
            });
            return false;
        });
         

        //GET HAPUS
        $('#show_data').on('click','.item_delete',function(){
            var nip=$(this).attr('data');
            $('#ModalDelete').modal('show');
            $('[name="nip"]').val(nip);
        });

        //Save
        $('#btn_simpan').on('click',function(){
           
            var nip=$('#nip').val();
            var nama=$('#nama').val();
            var pass=$('#pass').val();
            var level =$('#level').val();
            
            //var harga=$('#harga').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('admin/user/save_admin')?>",
                dataType : "JSON",
                data : {nip:nip , nama:nama, pass:pass, level:level},
                success: function(data){
                    
                    $('[name="nip"]').val("");
                    $('[name="nama"]').val("");
                    $('[name="pass"]').val("");
                    $('[name="level"]').val("");
                    
                   
                    $('#ModalaAdd').modal('hide');
                     tampil_data_admin();
                      location.reload();
                }
            });
            return false;
        });
 
        //Update
        $('#btn_update').on('click',function(){
            var nip=$('#nip2').val();
            var nama=$('#nama2').val();
            var pass=$('#pass2').val();
            var level=$('#level2').val();
            
           /* var nabar=$('#nama_barang2').val();
            var harga=$('#harga2').val();*/
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('admin/user/update_admin')?>",
                dataType : "JSON",
                data : {nip:nip, nama:nama, pass:pass, level:level},
                success: function(data){
                    $('[name="nip"]').val("");
                    $('[name="nama"]').val("");
                    $('[name="pass"]').val("");
                     $('[name="level"]').val("");
                    
                    $('#ModalEdit').modal('hide');
                    tampil_data_admin();
                      location.reload();
                }
            });
            return false;
        });
 
 
        //Delete
        $('#btn_delete').on('click',function(){
            var nip=$('#textid').val();
            $.ajax({
            type : "POST",
            url  : "<?php echo base_url('admin/user/delete_user')?>",
            
            dataType : "JSON",
                    data : {nip:nip},
                    success: function(data){
                            $('#ModalDelete').modal('hide');
                             tampil_data_admin();
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