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
        Barang Masuk
        <small>data list barang masuk</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Barang Masuk</a></li>
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
                  <div class="pull-right"><a href="<?php echo base_url().'index.php/admin/transaksi/add_barang_masuk'?>" class="btn  btn-success"  ><span class="fa fa-plus"></span> </a>
                  <a class="btn  btn-info" href="<?php echo base_url("index.php/admin/transaksi/form_import_brg_masuk"); ?>">Import Data</a> 
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  
                <table id="example1" class="table table-bordered table-striped display nowrap">
            <thead>
                <tr>
                    
                    <th>Part Number</th>
                    <th>Nama Barang</th>
                    <th>Supplier</th>
                    <th>Jumlah</th>
                    <th>Nomor PO</th>
                    <th>Nomor Surat Jalan</th>     
                    <th>Tanggal</th>
                   <!-- <th>Created By</th>-->
                    <th>Last Modified</th>
                    <th>Updated By</th>
                    
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
                <h3 class="modal-title" id="myModalLabel">Edit</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">           
                      <div class="form-group">
                        <label class="control-label col-xs-3" >Part Number</label>
                        <div class="col-xs-9">
                             
                          <?php
                               
                                $dd_barang_attribute = 'class="form-control select2" style="width:335px;" id="kode_barang2"';
                                echo form_dropdown('kode_barang', $dd_barang, $barang_selected, $dd_barang_attribute);
                            
                            ?>
                        </div>
                    </div>  
                     <input name="status_id" id="status_id" class="form-control" type="hidden" style="width:335px;" required>
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Supplier</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_supplier_attribute = 'class="form-control select2"  style="width:335px;" id="supplier_id2"';
                                echo form_dropdown('supplier_id', $dd_supplier, $supplier_selected, $dd_supplier_attribute);
                            ?>
                        </div>
                    </div> 
                    

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jumlah</label>
                        <div class="col-xs-9">
                            <input name="jumlah" id="jumlah2" class="form-control" type="text" placeholder="Jumlah" style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor PO</label>
                        <div class="col-xs-9">
                            <input name="nomor_po" id="nomor_po2" class="form-control" type="text" placeholder="nomor_po" style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor Surat Jalan</label>
                        <div class="col-xs-9">
                            <input name="nomor_surat_jalan" id="nomor_surat_jalan2" class="form-control" type="text" placeholder="Nomor Surat Jalan" style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal</label>
                        <div class="col-xs-9">
                            <input name="tanggal" id="tanggal2" class="form-control" placeholder="tanggal" style="width:335px;" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <input name="keterangan" id="keterangan2" class="form-control" type="text" placeholder="Keterangan" style="width:335px;" required>
                        </div>
                    </div> 
                     <input name="id" id="id2" class="form-control" type="hidden"  style="width:335px;" required>
                        
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
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                        <h4 class="modal-title" id="myModalLabel">Hapus Barang</h4>
                    </div>
                    <form class="form-horizontal">
                    <div class="modal-body">
                                           
                            <input type="hidden" name="id" id="textid" value="">
                            <div class="alert alert-warning"><p>Apakah Anda yakin mau menghapus transaksi barang ini?</p></div>
                                         
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

<script type="text/javascript" src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.js'?>"></script>
<script src="<?php  echo base_url();?>kolam/AdminLTE-2.0.5/plugins/datepicker/bootstrap-datepicker.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        tampil_data_barang_masuk();   //pemanggilan fungsi tampil.
         
        $('#example1').DataTable( {
            "scrollX": true
        } );
          
        //fungsi tampil barang
        function tampil_data_barang_masuk(){
            $.ajax({
                type  : 'GET',
                url   : '<?php echo base_url()?>index.php/admin/transaksi/data_barang_masuk',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                                                        
                                '<td>'+data[i].kode_barang+'</td>'+
                               '<td>'+data[i].nama_barang+'</td>'+
                                '<td>'+data[i].nama_supplier+'</td>'+
                                '<td>'+data[i].jumlah+'</td>'+
                                '<td>'+data[i].nomor_po+'</td>'+
                                '<td>'+data[i].nomor_surat_jalan+'</td>'+
                                '<td>'+data[i].tanggal+'</td>'+
                                 
                                 '<td>'+data[i].updated_at+'</td>'+
                                 //'<td>'+data[i].nama+'</td>'+
                                 '<td>'+data[i].nama+'</td>'+
                                
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
                url  : "<?php echo base_url('index.php/admin/transaksi/get_barang_masuk')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id, kode_barang, status_id, supplier_id, jumlah, nomor_po, nomor_surat_jalan, tanggal, keterangan){
                        $('#ModalEdit').modal('show');
                        $('[name="id"]').val(data.id);
                        $('[name="kode_barang"]').val(data.kode_barang);
                        $('[name="status_id"]').val(data.status_id);
                        $('[name="supplier_id"]').val(data.supplier_id);
                        $('[name="jumlah"]').val(data.jumlah);
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
            var id=$('#id2').val();
            var kode_barang=$('#kode_barang2').val();
            var status_id=$('#status_id').val();
            var supplier_id=$('#supplier_id2').val();
            var jumlah=$('#jumlah2').val();
            var nomor_po=$('#nomor_po2').val();
            var nomor_surat_jalan=$('#nomor_surat_jalan2').val();
            var tanggal=$('#tanggal2').val();
            var keterangan=$('#keterangan2').val();
           
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/admin/transaksi/update_barang_masuk')?>",
                dataType : "JSON",
                data : {id:id, kode_barang:kode_barang, status_id:status_id, supplier_id:supplier_id, jumlah:jumlah, nomor_po:nomor_po, nomor_surat_jalan:nomor_surat_jalan, tanggal:tanggal, keterangan:keterangan},
                success: function(data){
                    $('[name="id"]').val("");
                    $('[name="kode_barang"]').val("");
                    $('[name="status_id"]').val("");
                    $('[name="supplier_id"]').val("");
                    $('[name="jumlah"]').val("");
                    $('[name="nomor_po"]').val("");
                    $('[name="nomor_surat_jalan"]').val("");
                    $('[name="tanggal"]').val("");
                    $('[name="keterangan"]').val("");
                    $('#ModalEdit').modal('hide');
                    tampil_data_barang_masuk();
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
            url  : "<?php echo base_url('index.php/admin/transaksi/delete_barang_masuk')?>",
            dataType : "JSON",
                    data : {id:id},
                    success: function(data){
                            $('#ModalDelete').modal('hide');
                             tampil_data_barang_masuk();
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


<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>