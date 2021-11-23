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
        Sparepart telah dipesan
        <small>data list </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Sparepart telah dipesan</a></li>
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
                  <div class="pull-right"><a href="<?php echo base_url().'sparepart/add'?>" class="btn  btn-success"  ><span class="fa fa-user-plus"></span> </a>
                  || <a class="btn  btn-info" href="<?php echo base_url("index.php/admin/transaksi/form"); ?>">Import Data</a>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  
                <table id="example1" class="table table-bordered table-striped"  width="100%" cellspacing="0">
		            <thead>
		                <tr>
		                  
		                    <th>Part Number</th>
		                    <th>Sparepart</th>
		                    <th>Jumlah</th>
		                    <!-- <th>Dikirim</th>
		                    <th>Belum Dikirim</th> -->
		                    <th>Supplier</th>
		                    <th>Tanggal PO</th>                   
                            <th>Nomor PO</th>                     
		                    <th>Estimasi Sampai</th>                     
		                    <th>Keterangan</th>
		                    <th>Aksi</th>		                    
		                    
		                </tr>
		            </thead>
		            <tbody>
		                 <?php 
                                                $no = 1;
                                                foreach($po_supplier as $row)
                                                {
                                                  ?>
                                            <tr>
                                                                                        
                                                <td><?php echo $row->kode_barang?></td>
                                                <td><?php echo $row->nama_barang?></td>
                                                <td><?php echo $row->jumlah?></td>
                                                <!-- <td><?php echo $row->jumlah_parsial?></td>
                                                <td><?php echo $row->SISA_KIRIM?></td> -->
                                                <td><?php echo $row->nama_supplier?></td>
                                                <td><?php echo $row->tanggal_order?></td>
                                                <td><?php echo $row->nomor_po?></td>                                                
                                                <td><?php echo $row->tanggal?></td>                                                
                                                <td><?php echo $row->keterangan?></td>
                                                <td>

                                                	<form action="<?=site_url('sparepart/delete_sp_diepsan') ?>" method="POST">
                                                		
                                                  	<a  href="<?= site_url('sparepart/get_edit/'.$row->id)?>" class="btn btn-primary"><span class="fa fa-pencil"></span> </a>  

                                                 
                                                 	<input type="hidden" name="id" value="<?= $row->id ?>">
                                                 	<button onclick="return confirm('Apakah Anda Yakin Akan Menghapus Ini?')" class="btn btn-danger">
                                                 		 <span class="fa fa-trash"></span>
                                                 	</button>
                                                 	
                                                 </form>	
                                                  <!-- <a href="<?php echo base_url(); ?>departemen/delete/<?php echo $row->id; ?>" onclick="return confirm('Apakah Anda Yakin Akan Menghapus Ini?')" class="btn btn-danger">
                                                  <span class="fa fa-trash"></span> </a>      -->                                                       
                                                </td>
                                            </tr>  
                                            <?php
                                                }
                                            ?>  
		            </tbody>
		     	</table>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
      
      </div><!-- /.content-wrapper -->           
            

</section><!-- /.content -->
 

 <!-- MODAL KIRIM KE SPAREPART KELUAR-->
        <div class="modal fade" id="ModalEdit" tabindex="" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Sparepart Keluar</h3>
            </div>
            <form class="form-horizontal">
                  
                <div class="modal-body">           
                      

                      
                            <input name="pesan_id" id="pesan_id" class="form-control" type="hidden"  style="width:335px;" required>
                             <input name="status_id" id="status_id" value="2" class="form-control" type="hidden" style="width:335px;" required>
                      

                      <div class="form-group">
                        <label class="control-label col-xs-3" >Part Number</label>
                        <div class="col-xs-9">
                            <input name="kode_barang" id="kode_barang" class="form-control" type="text"  style="width:335px;" required readonly="">
                        </div>
                    </div>

                        
                           
                     
                    

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Customer</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_customer_attribute = 'class="form-control select2" style="width:335px;" id=customer_id';
                                echo form_dropdown('customer_id', $dd_customer, $customer_selected, $dd_customer_attribute);
                            ?>
                        </div>
                    </div>  
                    

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jumlah</label>
                        <div class="col-xs-9">
                            <input name="jumlah" id="jumlah" class="form-control" type="text" placeholder="Jumlah" style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal PO</label>
                        <div class="col-xs-9">
                            <input name="tanggal_order" id="tanggal_order" class="form-control" placeholder="tanggal" style="width:335px;" required readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor PO</label>
                        <div class="col-xs-9">
                            <input name="nomor_po" id="nomor_po" class="form-control" type="text" placeholder="nomor_po" style="width:335px;" required>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor Surat Jalan</label>
                        <div class="col-xs-9">
                            <input name="nomor_surat_jalan" id="nomor_surat_jalan" class="form-control" type="text" placeholder="Nomor Surat Jalan" style="width:335px;" required>
                        </div>
                    </div> 
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal Keluar</label>
                        <div class="col-xs-9">
                            <input name="tanggal" id="tanggal" class="form-control" placeholder="Tanggal Keluar" style="width:335px;" required>
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
                    <button class="btn btn-info" id="btn_update">Simpan</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <!--END MODAL  MODAL KIRIM KE SPAREPART KELUAR-->

        <!-- MODAL EDIT -->
        <div class="modal fade" id="ModalEditDipesan" tabindex="" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Edit Sparepart Dipesan</h3>
            </div>
            <form class="form-horizontal">
                  
                <div class="modal-body">           
                      

                      
                            <input name="idedit" id="id2" class="form-control" type="hidden"  style="width:335px;" required>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Part Number</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_barang_attribute = 'class="form-control select2" style="width:335px;" id=kode_barang2';
                                echo form_dropdown('kode_barangedit', $dd_barang, $barang_selected, $dd_barang_attribute);
                            ?>
                        </div>
                    </div>                   
                    
                     <div class="form-group">
                        <label class="control-label col-xs-3" >Jumlah</label>
                        <div class="col-xs-9">
                            <input name="jumlahedit" id="jumlah2" class="form-control" type="text" placeholder="Jumlah" style="width:335px;" required>
                        </div>
                    </div> 
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Customer</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_customer_attribute = 'class="form-control select2" style="width:335px;" id=customer_id2';
                                echo form_dropdown('customer_idedit', $dd_customer, $customer_selected, $dd_customer_attribute);
                            ?>
                        </div>
                    </div>                     

                   
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal PO</label>
                        <div class="col-xs-9">
                            <input name="tanggal_orderedit" id="tanggal_order2" class="form-control" placeholder="Tanggal PO" style="width:335px;" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor PO</label>
                        <div class="col-xs-9">
                            <input name="nomor_poedit" id="nomor_po2" class="form-control" type="text" placeholder="Nomor PO" style="width:335px;" required>
                        </div>
                    </div> 

                      

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <input name="keteranganedit" id="keterangan2" class="form-control" type="text" placeholder="Keterangan" style="width:335px;" required>
                        </div>
                    </div> 
                   
                        
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" id="btn_edit">Update</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <!--END MODAL EDIT-->

         <!-- MODAL EDIT STATUS -->
        <div class="modal fade" id="ModalEditStatusDipesan" tabindex="" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Edit Status Sparepart Dipesan</h3>
            </div>
            <form class="form-horizontal">
                  
                <div class="modal-body">           
                      

                      
                            <input name="ideditstat" id="idstat2" class="form-control" type="hidden"  style="width:335px;" required>

                                       

                       <div class="form-group">
                        <label class="control-label col-xs-3" >Status Pemesanan</label>
                        <div class="col-xs-9">
                           <select  class="select2" name="status_pemesanan" id="status_pemesanan2" class="form-control" style="width:335px;" required>
                            <option value="">Pilih Status Pemesanan</option>
                                <option value="0">Open</option>
                                <option value="1">Close</option>
                            </select>
                        </div>
                    </div>
                   
                        
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" id="btn_editstat">Update</button>
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
                        <h4 class="modal-title" id="myModalLabel">Hapus PO Sementara</h4>
                    </div>
                    <form class="form-horizontal">
                    <div class="modal-body">
                                           
                            <input type="hidden" name="id" id="id_item_dipesan" value="">
                            <div class="alert alert-warning"><p>Apakah Anda yakin mau menghapus po sementara ini?</p></div>
                                         
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
<script src="<?php echo base_url();?>kolam/AdminLTE-2.0.5/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function()
    {
        tampil_data_po_sementara();   //pemanggilan fungsi tampil.
         
        $('#example1').DataTable( {
            
        } );
          
        //fungsi tampil barang
        function tampil_data_po_sementara(){
            $.ajax({
                type  : 'GET',
                url   : '<?php echo base_url()?>index.php/admin/transaksi/data_sparepart_dipesan',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                         var status_pemesanan = data[i].status_pemesanan;

                         if (status_pemesanan == 0){
                            html += '<tr>'+
                                                        
                                '<td>'+data[i].kode_barang+'</td>'+
                                '<td>'+data[i].nama_barang+'</td>'+
                                '<td>'+data[i].jumlah+'</td>'+
                                '<td>'+data[i].jumlah_parsial+'</td>'+
                                '<td>'+data[i].SISA_KIRIM+'</td>'+
                                '<td>'+data[i].nama_customer+'</td>'+
                                '<td>'+data[i].tanggal_order+'</td>'+
                                '<td>'+data[i].nomor_po+'</td>'+ 
                                '<td> <span class="label label-success">Open</span></td>'+  
                                '<td>'+data[i].keterangan+'</td>'+   

                                '<td>'+                                
                                    '<a href="javascript:;" class="btn btn-default item_edit" data="'+data[i].id+'"><span class="fa fa-pencil"></a>'+' '+
                                    '<a href="javascript:;" class="btn btn-info barang_keluar" data="'+data[i].id+'"><span class="fa fa-paper-plane"></a>'+' '+
                                     '<a href="javascript:;" class="btn btn-danger  item_delete" data="'+data[i].id+'"><span class="fa fa-trash"></span></a>'+                                 
                                '</td>'+
                                '<td>'+                                
                                    '<a href="javascript:;" class="btn btn-default item_editstat" data="'+data[i].id+'"><span class="fa fa-play"></a>'+
                                '</td>'+
                                '</tr>';
                            }else if (status_pemesanan == 1){
                                html += '<tr>'+
                                                        
                                '<td>'+data[i].kode_barang+'</td>'+
                                '<td>'+data[i].nama_barang+'</td>'+
                                '<td>'+data[i].jumlah+'</td>'+
                                '<td>'+data[i].jumlah_parsial+'</td>'+
                                '<td>'+data[i].SISA_KIRIM+'</td>'+
                                '<td>'+data[i].nama_customer+'</td>'+
                                '<td>'+data[i].tanggal_order+'</td>'+
                                '<td>'+data[i].nomor_po+'</td>'+ 
                                '<td> <span class="label label-danger">Close</span></td>'+  
                                '<td>'+data[i].keterangan+'</td>'+   

                                '<td>'+
                                
                                    '<a href="javascript:;" class="btn btn-default item_edit" data="'+data[i].id+'"><span class="fa fa-pencil"></a>'+' '+
                                    /*'<a href="javascript:;" class="btn btn-info barang_keluar" data="'+data[i].id+'"><span class="fa fa-paper-plane"></a>'+' '+*/
                                     '<a href="javascript:;" class="btn btn-danger  item_delete" data="'+data[i].id+'"><span class="fa fa-trash"></span></a>'+
                                    
                                '</td>'+
                                '<td>'+'</td>'+
                                '</tr>'; 
                            }
                        
                    }
                    $('#show_data').html(html);
                }
 
            });

        }


        //GET UPDATE SPAREPART DIPESAN
        $('#show_data').on('click','.item_edit',function(){
            var id=$(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('index.php/admin/transaksi/get_sparepart_dipesan')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id, kode_barang, jumlah, customer_id, nomor_po, tanggal_order, keterangan){
                        $('#ModalEditDipesan').modal('show');
                        $('[name="idedit"]').val(data.id);
                        $('[name="kode_barangedit"]').val(data.kode_barang);
                        $('[name="tanggal_orderedit"]').val(data.tanggal_order);
                        $('[name="customer_idedit"]').val(data.customer_id);
                        $('[name="jumlahedit"]').val(data.jumlah);
                        $('[name="nomor_poedit"]').val(data.nomor_po);      
                        $('[name="keteranganedit"]').val(data.keterangan);
                    });
                }
            });
            return false;
        });

       
       //GET UPDATE  STATUS SPAREPART DIPESAN
        $('#show_data').on('click','.item_editstat',function(){
            var id=$(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('index.php/admin/transaksi/get_sparepart_dipesan')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id, status_pemesanan){
                        $('#ModalEditStatusDipesan').modal('show');
                        $('[name="ideditstat"]').val(data.id);
                        $('[name="status_pemesanan"]').val(data.status_pemesanan);
                    });
                }
            });
            return false;
        });

        //GET UPDATE
        $('#show_data').on('click','.barang_keluar',function(){
            var id=$(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('index.php/admin/transaksi/get_sparepart_dipesan_keluar')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id, pesan_id, kode_barang, jumlah, customer_id, nomor_po, tanggal_order, keterangan){
                        $('#ModalEdit').modal('show');
                        $('[name="pesan_id"]').val(data.id);
                        $('[name="kode_barang"]').val(data.kode_barang);
                        $('[name="tanggal_order"]').val(data.tanggal_order);
                        $('[name="customer_id"]').val(data.customer_id);
                        $('[name="jumlah"]').val(data.jumlah);
                        $('[name="nomor_po"]').val(data.nomor_po);
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

        
        
        

        //Update SPAREPART DIPESAN
        $('#btn_edit').on('click',function(){
            var id=$('#id2').val();
            var kode_barang=$('#kode_barang2').val()
            var customer_id=$('#customer_id2').val();
            var jumlah=$('#jumlah2').val();
            var nomor_po=$('#nomor_po2').val();
            var tanggal_order=$('#tanggal_order2').val();
            var keterangan=$('#keterangan2').val();
           
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/admin/transaksi/update_sparepart_dipesan')?>",
                dataType : "JSON",
                data : {id:id, kode_barang:kode_barang, customer_id:customer_id, jumlah:jumlah, nomor_po:nomor_po, tanggal_order:tanggal_order, keterangan:keterangan},
                success: function(data){
                    $('[name="idedit"]').val("");
                   
                    $('[name="kode_barangedit"]').val("");
                    $('[name="customer_idedit"]').val("");
                    $('[name="jumlahedit"]').val("");
                    $('[name="nomor_poedit"]').val("");
                    $('[name="tanggal_orderedit"]').val("");
                    $('[name="keteranganedit"]').val("");
                    $('#ModalEditDipesan').modal('hide');
                    tampil_data_po_sementara();
                    location.reload();
                }
            });
            return false;
        });

        //Update STATUS SPAREPART DIPESAN
        $('#btn_editstat').on('click',function(){
            var id=$('#idstat2').val();
            var status_pemesanan=$('#status_pemesanan2').val()
            
           
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/admin/transaksi/update_status_sparepart_dipesan')?>",
                dataType : "JSON",
                data : {id:id, status_pemesanan:status_pemesanan},
                success: function(data){
                    $('[name="ideditstat"]').val("");
                   
                    $('[name="status_pemesanan"]').val("");
                    $('#ModalEditStatusDipesan').modal('hide');
                    tampil_data_po_sementara();
                    location.reload();
                }
            });
            return false;
        });

         //Kirim SPAREPART KElUAR
        $('#btn_update').on('click',function(){
           
            var kode_barang=$('#kode_barang').val();
            var pesan_id=$('#pesan_id').val();
            var status_id=$('#status_id').val();            
            var customer_id=$('#customer_id').val();            
            var jumlah=$('#jumlah').val();
            var nomor_po=$('#nomor_po').val();
            var tanggal_order=$('#tanggal_order').val();
            var nomor_surat_jalan=$('#nomor_surat_jalan').val();
            var tanggal=$('#tanggal').val();
            var keterangan=$('#keterangan').val();
           
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/admin/transaksi/update_kirim_keluar')?>",
                dataType : "JSON",
                data : {kode_barang:kode_barang, pesan_id:pesan_id, status_id:status_id, customer_id:customer_id, jumlah:jumlah, nomor_po:nomor_po, tanggal_order:tanggal_order, nomor_surat_jalan:nomor_surat_jalan, tanggal:tanggal, keterangan:keterangan},
                success: function(data){
                    
                    $('[name="kode_barang"]').val("");
                    $('[name="pesan_id"]').val("");  
                    $('[name="status_id"]').val(""); 
                    $('[name="customer_id"]').val("");
                    $('[name="jumlah"]').val("");
                    $('[name="nomor_po"]').val("");
                    $('[name="tanggal_order"]').val("");
                    $('[name="nomor_surat_jalan"]').val("");
                    $('[name="tanggal"]').val("");
                    $('[name="keterangan"]').val("");
                    $('#ModalEdit').modal('hide');
                    tampil_data_po_sementara();
                    location.reload();
                }
            });
            return false;
        });
 
 
        //Delete
        $('#btn_delete').on('click',function(e){
        	e.preventDefault();
            var id=$('#id_item_dipesan').val();
            $.ajax({
            type : "POST",
            url  : "<?php echo base_url('index.php/admin/transaksi/delete_sparepart_dipesan')?>",
            // dataType : "JSON",
            data : {id:id},
                success: function(data){
                            $('#ModalDelete').modal('hide');
                             tampil_data_po_sementara();
                    }
                });
               
            });
 
    }); 
</script>

 <script>
            $(function () {
            //Date picker
            $('#tanggal2').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true    }); 

            $('#tanggal').datepicker({
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