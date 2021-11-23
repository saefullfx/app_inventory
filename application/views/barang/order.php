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
    <h1>Sparepart OnGoing</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">pemesanan sparepart</a></li>
        <li class="active">list</li>
    </ol>
</section>
      
    
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                
                <div class="box-header">
                  <h3 class="box-title">Data Sparepart OnGoing</h3>
                  <div class="pull-right"><a href="" class="btn btn-success" data-toggle="modal" data-target="#ModalaAdd"><span class="fa fa-plus"></span></a></div>
                </div><!-- /.box-header -->
                
                <div class="box-body">
                <table id="example1" class="table table-bordered table-striped display nowrap"  width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Part Number</th>
                                <th>Nama Sparepart</th>                                      
                                <th>Jumlah</th>                                      
                                <th>Supplier</th>
                                <th>Tanggal PO</th>
                                <th>Nomor PO</th>
                                <th>Estimasi Sampai</th>
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
                <h3 class="modal-title" id="myModalLabel">PO Sparepart ke Supplier</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">    
               
                    <div class="form-group col-xs-12">
                        <label class="control-label col-xs-3" >Part Number</label>
                        <div class="col-xs-9">
                          <?php
                                $dd_barang_attribute = 'class="form-control select2" style="width:335px;" id="kode_barang" required';
                                echo form_dropdown('kode_barang', $dd_barang, $barang_selected, $dd_barang_attribute);
                            ?>
                        </div>
                    </div>                
                   
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jumlah</label>
                        <div class="col-xs-9">
                            <input name="jumlah" id="jumlah" class="form-control" type="text" placeholder="Masukan jumlah pemesanan sparepart" style="width:335px;" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Supplier</label>
                        <div class="col-xs-9">
                          <?php
                                $dd_supplier_attribute = 'class="form-control select2" style="width:335px;" id="supplier_id" required';
                                echo form_dropdown('supplier_id', $dd_supplier, $supplier_selected, $dd_supplier_attribute);
                            ?>
                        </div>
                    </div>  

                     <input name="status_id" id="status_id" type="hidden" class="form-control" value="4" placeholder="" style="width:335px;" required>
                    
                     <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal Order</label>
                       <div class="col-xs-9">
                            <input name="tanggal_order" id="tanggal_order" class="form-control" placeholder="Format input tanggal TAHUN/BULAN/HARI" style="width:335px;" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor PO</label>
                        <div class="col-xs-9">
                            <input name="nomor_po" id="nomor_po" class="form-control" type="text" placeholder="Masukan Nomor PO" style="width:335px;" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Estimasi Order Sampai</label>
                        <div class="col-xs-9">
                            <input name="tanggal_sampai" id="tanggal_sampai" class="form-control" type="text" placeholder="Format input tanggal TAHUN/BULAN/HARI" style="width:335px;" required>
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

        <!-- MODAL INSERT KE UNIT MASUK -->
        <div class="modal fade" id="ModalEditMasuk" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Sparepart Masuk</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">           
                    

                     <!--<div class="form-group">
                        <label class="control-label col-xs-3" >Part Number</label>
                        <div class="col-xs-9">
                          <?php
                               /* $dd_barang_attribute = 'class="form-control select2" style="width:335px;" kode_barangmasuk';
                                echo form_dropdown('kode_barangin', $dd_barang, $barang_selected, $dd_barang_attribute);*/
                            ?>
                        </div>
                    </div> -->
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Part Number</label>
                            <div class="col-xs-9">
                             <input name="kode_barangin" id="kode_barangmasuk" class="form-control" type="text" p style="width:335px;" readonly>
                          </div>
                    </div> 
                       
                            <input name="status_idin" id="status_idmasuk" class="form-control" type="hidden" value="1" p style="width:335px;" required>
                            <input name="pemesanan_idin" id="pemesanan_idmasuk" class="form-control" type="hidden"  p style="width:335px;" required>
                       
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Supplier</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_supplier_attribute = 'class="form-control select2" style="width:335px;" supplier_idmasuk';
                                echo form_dropdown('supplier_idin', $dd_supplier, $supplier_selected, $dd_supplier_attribute);
                            ?>
                        </div>
                    </div> 
                     <!--<div class="form-group">
                        <label class="control-label col-xs-3" >Supplier</label>
                        <div class="col-xs-9">
                            <input name="supplier_idin" id="supplier_idmasuk" class="form-control" type="text" placeholder="Jumlah" style="width:335px;" required>
                        </div>
                    </div>-->
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jumlah</label>
                        <div class="col-xs-9">
                            <input name="jumlahin" id="jumlahmasuk" class="form-control" type="text" placeholder="Jumlah" style="width:335px;" required>
                        </div>
                    </div> 
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor PO</label>
                        <div class="col-xs-9">
                            <input name="nomor_poin" id="nomor_pomasuk" class="form-control" type="text" placeholder="nomor_po" style="width:335px;" required>
                        </div>
                    </div> 
                   
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal PO</label>
                        <div class="col-xs-9">
                            <input name="tanggal_orderin" id="tanggal_ordermasuk" class="form-control" placeholder="tanggal" style="width:335px;" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal Masuk</label>
                        <div class="col-xs-9">
                            <input name="tanggalin" id="tanggalmasuk" class="form-control" placeholder="tanggal" style="width:335px;" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <input name="keteranganin" id="keteranganmasuk" class="form-control" type="text" placeholder="Keterangan" style="width:335px;" required>
                        </div>
                    </div> 
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" id="btn_update2">Simpan</button>
                </div>
                </div>
            </form>
            </div>
            </div>
        </div>
       <!-- MODAL INSERT KE UNIT MASUK -->

        <!-- MODAL EDIT -->
        <div class="modal fade" id="ModalEdit" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Ubah PO Sparepart ke Supplier</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">                     
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Part Number</label>
                        <div class="col-xs-9">
                          <?php
                                $dd_barang_attribute = 'class="form-control select2" style="width:335px;" id="kode_barang2"';
                                echo form_dropdown('kode_barangedit', $dd_barang, $barang_selected, $dd_barang_attribute);
                            ?>
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
                        <label class="control-label col-xs-3" >Nama Supplier</label>
                        <div class="col-xs-9">
                          <?php
                                $dd_supplier_attribute = 'class="form-control select2" style="width:335px;" id="supplier_id2"';
                                echo form_dropdown('supplier_idedit', $dd_supplier, $supplier_selected, $dd_supplier_attribute);
                            ?>
                        </div>
                    </div>    

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor Order</label>
                        <div class="col-xs-9">
                            <input name="nomor_poedit" id="nomor_po2" class="form-control" type="text"  style="width:335px;" required>
                        </div>
                    </div> 

                     

                     <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal Order</label>
                        <div class="col-xs-9">
                            <input name="tanggal_orderedit" id="tanggal_order2" class="form-control" type="text"  style="width:335px;" required>
                        </div>
                    </div> 
                     
                     <div class="form-group">
                        <label class="control-label col-xs-3" >Estimasi Order Sampai</label>
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
                            <div class="alert alert-warning"><p>Apakah Anda yakin mau menghapus pemesanan barang ini?</p></div>
                                         
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

<script type="text/javascript">
    $(document).ready(function(){
        tampil_data_order_barang();   //pemanggilan fungsi tampil.
         
        $('#example1').DataTable( {
            "scrollX": true
        } );
          
        //fungsi tampil barang
        function tampil_data_order_barang(){
            $.ajax({
                type  : 'GET',
                url   : '<?php echo base_url()?>index.php/admin/order/data_order',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        // var status = data[i].SISA_KIRIM;
                        // if(status == 0){
                           html += '<tr>'+
                                               '<td>'+data[i].kode_barang+'</td>'+
                                                '<td>'+data[i].nama_barang+'</td>'+
                                                '<td>'+data[i].jumlah+'</td>'+
                                                /*'<td>'+data[i].jumlah_parsial+'</td>'+
                                                '<td>'+data[i].SISA_KIRIM+'</td>'+*/
                                                '<td>'+data[i].nama_supplier+'</td>'+
                                                '<td>'+data[i].tanggal_order+'</td>'+
                                                '<td>'+data[i].nomor_po+'</td>'+
                                               
                                                '<td>'+data[i].tanggal_sampai+'</td>'+              
                                                '<td>'+data[i].keterangan+'</td>'+
                                              /*  '<td>'+'<small class="label label-danger">CLOSE</small>'+'</td>'+*/
                                                '<td width="8%">'+
                                                   // '<a href="javascript:;" class="btn btn-info item_editmasuk" data="'+data[i].id+'"><span class="fa fa-send"></a>'+' '+
                                                    '<a href="javascript:;" class="btn btn-info  item_edit" data="'+data[i].id+'"><span class="fa fa-pencil"></span></a>'+' '+
                                                    '<a href="javascript:;" class="btn btn-danger  item_delete" data="'+data[i].id+'"><span class="fa fa-trash"></span></a>'+
                                                '</td>'+
                                    '</tr>';
                    //     }else{
                    //        html += '<tr>'+
                    //                            '<td>'+data[i].kode_barang+'</td>'+
                    //                             '<td>'+data[i].nama_barang+'</td>'+
                    //                             '<td>'+data[i].jumlah+'</td>'+
                    //                             '<td>'+data[i].jumlah_parsial+'</td>'+
                    //                             '<td>'+data[i].SISA_KIRIM+'</td>'+
                    //                             '<td>'+data[i].nama_supplier+'</td>'+
                    //                             '<td>'+data[i].nomor_po+'</td>'+
                    //                             '<td>'+data[i].tanggal_order+'</td>'+
                    //                             '<td>'+data[i].tanggal_sampai+'</td>'+              
                    //                             '<td>'+data[i].keterangan+'</td>'+
                    //                             '<td>'+'<small class="label label-success">OPEN</small>'+'</td>'+
                    //                             '<td width="8%">'+
                    //                                 '<a href="javascript:;" class="btn btn-info item_editmasuk" data="'+data[i].id+'"><span class="fa fa-send"></a>'+' '+
                    //                                 '<a href="javascript:;" class="btn btn-info  item_edit" data="'+data[i].id+'"><span class="fa fa-pencil"></span></a>'+' '+
                    //                                 '<a href="javascript:;" class="btn btn-danger  item_delete" data="'+data[i].id+'"><span class="fa fa-trash"></span></a>'+ 
                    //                             '</td>'+
                    //                 '</tr>';
                    // }   
                    $('#show_data').html(html);
                } 
                
                    
                }
            });
        } 
        
        //GET SPAREPART Masuk
        $('#show_data').on('click','.item_editmasuk',function(){
            var id=$(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('index.php/admin/order/get_order_sparepart_masuk')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id, kode_barang, supplier_id, tanggal_order, nomor_po){
                        $('#ModalEditMasuk').modal('show');
                        $('[name="pemesanan_idin"]').val(data.id);
                        $('[name="kode_barangin"]').val(data.kode_barang);
                        $('[name="supplier_idin"]').val(data.supplier_id);
                        $('[name="tanggal_orderin"]').val(data.tanggal_order);
                        $('[name="nomor_poin"]').val(data.nomor_po);
                    });
                }
            });
            return false;
        });


           //POST Insert Sparepart Masuk
        $('#btn_update2').on('click',function(){
            
            var kode_barang=$('#kode_barangmasuk').val();
            var pemesanan_id=$('#pemesanan_idmasuk').val();
            var status_id=$('#status_idmasuk').val();
            var supplier_id=$('#supplier_idmasuk').val();
            var tanggal_order=$('#tanggal_ordermasuk').val(); 
            var jumlah=$('#jumlahmasuk').val();
            var nomor_po=$('#nomor_pomasuk').val();         
            var tanggal=$('#tanggalmasuk').val();            
            var keterangan=$('#keteranganmasuk').val();
           
             $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/admin/order/simpan_sparepart_masuk')?>",
                dataType : "JSON",
                data : {kode_barang:kode_barang, pemesanan_id:pemesanan_id, status_id:status_id, supplier_id:supplier_id,  tanggal_order:tanggal_order, jumlah:jumlah, nomor_po:nomor_po, tanggal:tanggal,  keterangan:keterangan},
                success: function(data){
                  
                   $('[name="kode_barangin"]').val("");            
                   $('[name="pemesanan_idin"]').val("");
                   $('[name="status_idin"]').val("");
                   $('[name="supplier_idin"]').val("");
                   $('[name="tanggal_orderin"]').val("");
                   $('[name="jumlahin"]').val("");
                   $('[name="nomor_poin"]').val("");                   
                   $('[name="tanggalin"]').val("");                   
                   $('[name="keteranganin"]').val("");
                   $('#ModalEditMasuk').modal('hide');

                    tampil_data_order_barang();
                      location.reload();
                }
            });
            return false;
        });
        

        //GET UPDATE
        $('#show_data').on('click','.item_edit',function(){
            var id=$(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('index.php/admin/order/get_order')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id, kode_barang, jumlah, nomor_po, supplier_id, tanggal_pesan, tanggal, keterangan){
                        $('#ModalEdit').modal('show');
                        $('[name="idedit"]').val(data.id);
                        $('[name="kode_barangedit"]').val(data.kode_barang);
                        $('[name="jumlahedit"]').val(data.jumlah);
                        $('[name="nomor_poedit"]').val(data.nomor_po);
                        $('[name="supplier_idedit"]').val(data.supplier_id);
                        $('[name="tanggal_orderedit"]').val(data.tanggal_order);
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
            var supplier_id=$('#supplier_id').val();
            var status_id=$('#status_id').val();
            var tanggal_order=$('#tanggal_order').val();
            var nomor_po=$('#nomor_po').val(); 
            var tanggal_sampai=$('#tanggal_sampai').val();
            var keterangan=$('#keterangan').val();
           // var status=$('#status').val();
           
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/admin/order/save_order')?>",
                dataType : "JSON",
                data : {id:id, kode_barang:kode_barang, jumlah:jumlah, supplier_id:supplier_id, status_id:status_id, tanggal_order:tanggal_order, nomor_po:nomor_po, tanggal_sampai:tanggal_sampai, keterangan:keterangan},
                success: function(data){       
                    $('[name="id"]').val("");                              
                    $('[name="kode_barang"]').val("");
                    $('[name="jumlah"]').val("");
                    $('[name="supplier_id"]').val("");
                    $('[name="status_id"]').val(""); 
                    $('[name="tanggal_order"]').val("");
                    $('[name="nomor_po"]').val("");
                    $('[name="tanggal_sampai"]').val("");                                                                      
                    $('[name="keterangan"]').val("");
                                       
                    $('#ModalaAdd').modal('hide');
                     
                     tampil_data_order_barang();
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
            var nomor_po=$('#nomor_po2').val();
            var supplier_id=$('#supplier_id2').val();
            var tanggal_order=$('#tanggal_order2').val();           
            var tanggal=$('#tanggal2').val();            
            var keterangan=$('#keterangan2').val();
           /* var nabar=$('#nama_barang2').val();
            var harga=$('#harga2').val();*/
             $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/admin/order/update_order')?>",
                dataType : "JSON",
                data : {id:id, kode_barang:kode_barang, jumlah:jumlah, nomor_po:nomor_po, supplier_id:supplier_id, tanggal_order:tanggal_order, tanggal:tanggal, keterangan:keterangan},
                success: function(data){
                   $('[name="idedit"]').val("");
                    $('[name="kode_barangedit"]').val("");
                    $('[name="jumlahedit"]').val("");
                    $('[name="nomor_poedit"]').val("");
                    $('[name="supplier_idedit"]').val("");
                    $('[name="tanggal_orderedit"]').val("");                    
                    $('[name="tanggaledit"]').val("");                   
                    $('[name="keteranganedit"]').val("");
                    $('#ModalEdit').modal('hide');
                    tampil_data_order_barang();
                     // location.reload();
                }
            });
            return false;
        });
 
 
        //Delete
        $('#btn_delete').on('click',function(){
            var id=$('#textid').val();
            $.ajax({
            type : "POST",
            url  : "<?php echo base_url('index.php/admin/order/delete_order')?>",
            dataType : "JSON",
                    data : {id:id},
                    success: function(data){
                            $('#ModalDelete').modal('hide');
                             tampil_data_order_barang();
                              //location.reload();
                    }
                });
                return false;
            });

 
    });
</script>
<!--tambahkan custom js disini-->

<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="<?php  echo base_url();?>kolam/AdminLTE-2.0.5/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
 $(document).ready(function () 
    {
            
            $('#tanggal_order').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true    }); 

            $('#tanggal_sampai').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true    });      
    });          

            $(document).ready(function () 
            {
                $(".select2").select2({
                    placeholder: "Please Select"
                });
            });
</script>

<?php
$this->load->view('template/foot');
?>


