<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />


<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Tipe Unit
        <small>data list tipe unit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="http://localhost/spectra/index.php/page/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Tipe Unit</a></li>
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
                    <th>Nama Unit</th>
                    <th>Created By</th>
                    <th>Created at</th>                                    
                    
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
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Type Unit</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">               
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Unit</label>
                        <div class="col-xs-9">
                            <input name="nama_unit" id="nama_unit" class="form-control" type="text" placeholder="Nama Unit" style="width:335px;" required>
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
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h3 class="modal-title" id="">Edit</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">                     
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Unit</label>
                        <div class="col-xs-9">
                            <input name="nama_unitedit" id="nama_unit2" class="form-control" type="text" placeholder="" style="width:335px;" required>
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
                            <div class="alert alert-danger"><p>Apakah Anda yakin mau menghapus type unit ini?</p></div>
                                         
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function()
    {
        tampil_data_type_unit();   //pemanggilan fungsi tampil.
         
        $('#example1').dataTable();
          
        //fungsi tampil barang
        function tampil_data_type_unit()
        {
            $.ajax({
                type  : 'GET',
                url   : '<?php echo site_url('barang/unit/data_type_unit')?>',
                async : false,
                dataType : 'json',
                success : function(data)
                {
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++)
                    {
                        html += '<tr>'+
                                                               
                                '<td>'+data[i].nama_unit+'</td>'+                                
                                '<td>'+data[i].nama+'</td>'+
                                '<td>'+data[i].created_at+'</td>'+                                                         
                                
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
                url  : "<?php echo base_url('index.php/barang/unit/get_type_unit_by_id')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id, nama_unit){
                        $('#ModalEdit').modal('show');
                        $('[name="idedit"]').val(data.id);
                        $('[name="nama_unitedit"]').val(data.nama_unit);
                        
                        
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
            var id =$('#id').val();
            var nama_unit =$('#nama_unit').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('barang/unit/simpan_type_unit')?>",
                dataType : "json",
                data : {id:id , nama_unit:nama_unit},
                success: function(data){
                    $('[name="id"]').val("");
                    $('[name="nama_unit"]').val("");                    
                   
                    $('#ModalaAdd').modal('hide');
                    
                   tampil_data_type_unit();
                   location.reload(true);
                }
                
            });
            
             
            return false;
        });
 
        //Update
        $('#btn_update').on('click',function(){
            var id=$('#id2').val();
            var nama_unit=$('#nama_unit2').val();
          
            $.ajax({
                type : "POST",
                url  : '<?php echo site_url('barang/unit/update_type_unit')?>',
                dataType : "JSON",
                data : {id:id, nama_unit:nama_unit},
                success: function(data){
                    $('[name="idedit"]').val("");
                    $('[name="nama_unitedit"]').val("");
                    
                    $('#ModalEdit').modal('hide');
                    tampil_data_type_unit();
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
            url  : "<?php echo site_url('barang/unit/delete_type_unit')?>",
            dataType : "JSON",
                    data : {id:id},
                    success: function(data){
                            $('#ModalDelete').modal('hide');
                             tampil_data_type_unit();
                             location.reload(true);
                             
                             
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