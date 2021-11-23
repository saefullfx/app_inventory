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
        Kartu Stock
        <small>data list kartu stock</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Kartu Stock</a></li>
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
                 
                  <?php
                  if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2')
                    { ?>
                  <div class="pull-right"><a href="#" class="btn btn-success" data-toggle="modal" data-target="#ModalaAdd"><span class="fa fa-plus"></span></a></div> <?php } ?>

                </div><!-- /.box-header -->
                <div class="box-body">
                  
                <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                   
                    <th>Part Number</th>
                    <th>Nama Barang</th>                    
                    <th>Lokasi</th>
                    <th>Ruang</th>
                    <th>Rak</th>
                    <th>Tingkat</th>
                    <th>Jumlah</th>
                    <th>keterangan</th>
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
                <h3 class="modal-title" id="myModalLabel">Tambah Kartu Stock</h3>
            </div>
            <form class="form-horizontal" id="add-row-form">
                <div class="modal-body">               
               
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Part Number</label>
                        <div class="col-xs-9">
                          <?php
                                $dd_barang_attribute = 'class="form-control select2" style="width:335px;" id="kode_barang"';
                                echo form_dropdown('kode_barang', $dd_barang, $barang_selected, $dd_barang_attribute);
                            ?> 
                            <!-- <input name="kode_barang" id="kode_barang" class="form-control" type="text" placeholder="Masukan Part Number" style="width:335px;" required>-->
                        </div>
                    </div>  
                   
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Lokasi Penempatan</label>
                        <div class="col-xs-9">
                            <input name="lokasi" id="lokasi" class="form-control" type="text" placeholder="Lokasi" style="width:335px;" required>
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
                        <label class="control-label col-xs-3" > Tingkat</label>
                        <div class="col-xs-9">
                            <input name="tingkat" id="tingkat" class="form-control" type="text" placeholder="Masukan Tingkat" style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jumlah</label>
                        <div class="col-xs-9">
                            <input name="jumlah" id="jumlah" class="form-control" type="text" placeholder="Masukan Jumlah" style="width:335px;" required>
                        </div>
                    </div> 
                   
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <textarea name="keterangan" id="keterangan" class="form-control" type="text" placeholder="Keterangan" style="width:335px;" required> </textarea>
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
                        <label class="control-label col-xs-3" >Nama Barang</label>
                        <div class="col-xs-9">
                          <?php
                                $dd_barang_attribute = 'class="form-control select2" style="width:335px;" id="kode_barang2"';
                                echo form_dropdown('kode_barang', $dd_barang, $barang_selected, $dd_barang_attribute);
                            ?>
                        </div>
                    </div>  
                     <div class="form-group">
                        <label class="control-label col-xs-3" >Lokasi Penempatan</label>
                        <div class="col-xs-9">
                            <input name="lokasi" id="lokasi2" class="form-control" type="text" placeholder="Lokasi" style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Ruang</label>
                        <div class="col-xs-9">
                            <input name="ruang" id="ruang2" class="form-control" type="text" placeholder="Ruang" style="width:335px;" required>
                        </div>
                    </div> 
                     <div class="form-group">
                        <label class="control-label col-xs-3" >Rak</label>
                        <div class="col-xs-9">
                            <input name="rak" id="rak2" class="form-control" type="text" placeholder="Rak" style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" > Tingkat</label>
                        <div class="col-xs-9">
                            <input name="tingkat" id="tingkat2" class="form-control" type="text" placeholder="Tingkat" style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jumlah</label>
                        <div class="col-xs-9">
                            <input name="jumlah" id="jumlah2" class="form-control" type="text" placeholder="Jumlah" style="width:335px;" required>
                        </div>
                    </div> 
                   
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <textarea name="keterangan" id="keterangan2" class="form-control" type="text" placeholder="Keterangan" style="width:335px;" required> </textarea>
                        </div>
                    </div> 
                    <input type="hidden" name="id" id="id2" value="">            
                     
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
                            <div class="alert alert-warning"><p>Apakah Anda yakin mau menghapus kartu stock ini?</p></div>
                                         
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        tampil_data_kartu_stock();   //pemanggilan fungsi tampil.
         
         $('#example1').dataTable();

        $(".select2").select2({
                    placeholder: "Please Select"
                });
          
        //fungsi tampil
        function tampil_data_kartu_stock(){
            $.ajax({
                type  : 'GET',
                url   : '<?php echo base_url()?>index.php/barang/barang/data_kartu_stock',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                       
                                '<td>'+data[i].kode_barang+'</td>'+
                                '<td>'+data[i].nama_barang+'</td>'+                                
                                '<td>'+data[i].lokasi+'</td>'+
                                 '<td>'+data[i].ruang+'</td>'+
                                '<td>'+data[i].rak+'</td>'+
                                '<td>'+data[i].tingkat+'</td>'+
                                '<td>'+data[i].jumlah+'</td>'+
                                '<td>'+data[i].keterangan+'</td>'+
                                
                                '<td style="text-align:right;">'+
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


         //Save
        $('#btn_simpan').on('click',function(){
            var id=$('#id').val();
            var kode_barang=$('#kode_barang').val(); 
            var lokasi=$('#lokasi').val();
            var ruang=$('#ruang').val();
            var rak=$('#rak').val();
            var tingkat=$('#tingkat').val();            
            var jumlah=$('#jumlah').val();      
            var keterangan=$('#keterangan').val();
           
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/barang/barang/save_kartu_stock')?>",
                dataType : "JSON",
                data : {id:id, kode_barang:kode_barang, lokasi:lokasi, ruang:ruang, rak:rak, tingkat:tingkat, jumlah:jumlah, keterangan:keterangan},
                success: function(data){       
                    $('[name="id"]').val("");            
                    $('[name="kode_barang"]').val("");                   
                    $('[name="lokasi"]').val("");
                    $('[name="ruang"]').val("");
                    $('[name="rak"]').val("");
                    $('[name="tingkat"]').val("");                    
                    $('[name="jumlah"]').val("");                
                    $('[name="keterangan"]').val("");
                   
                    $('#ModalaAdd').modal('hide');
                     tampil_data_kartu_stock();
                      location.reload();
                }
            });
            return false;
        });       

        //GET UPDATE
        $('#show_data').on('click','.item_edit',function(){
            var id = $(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('index.php/barang/barang/get_kartu_stock')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id, kode_barang, lokasi, ruang, rak, tingkat, jumlah, keterangan){
                        $('#ModalEdit').modal('show');
                        $('[name="id"]').val(data.id);
                        $('[name="kode_barang"]').val(data.kode_barang);
                        $('[name="lokasi"]').val(data.lokasi);
                        $('[name="ruang"]').val(data.ruang);
                        $('[name="rak"]').val(data.rak);
                        $('[name="tingkat"]').val(data.tingkat);
                        $('[name="jumlah"]').val(data.jumlah);
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
            var id=$('#id2').val();
            var kode_barang=$('#kode_barang2').val();
            var lokasi=$('#lokasi2').val();
            var ruang=$('#ruang2').val();
            var rak=$('#rak2').val();
            var tingkat=$('#tingkat2').val();
            var jumlah=$('#jumlah2').val();
            var keterangan=$('#keterangan2').val();
           /* var nabar=$('#nama_barang2').val();
            var harga=$('#harga2').val();*/
             $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/barang/barang/update_kartu_stock')?>",
                dataType : "JSON",
                data : {id:id, kode_barang:kode_barang,  lokasi:lokasi, ruang:ruang, rak:rak, tingkat:tingkat, jumlah:jumlah,keterangan:keterangan},
                success: function(data){
                    $('[name="id"]').val("");
                    $('[name="kode_barang"]').val("");
                    $('[name="lokasi"]').val("");
                    $('[name="ruang"]').val("");
                    $('[name="rak"]').val("");
                    $('[name="tingkat"]').val("");
                    $('[name="jumlah"]').val("");
                    $('[name="keterangan"]').val("");
                    $('#ModalEdit').modal('hide');
                    tampil_data_kartu_stock();
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
            url  : "<?php echo base_url('index.php/barang/barang/delete_kartu_stock')?>",
            dataType : "JSON",
                    data : {id:id},
                    success: function(data){
                            $('#ModalDelete').modal('hide');
                             tampil_data_kartu_stock();
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