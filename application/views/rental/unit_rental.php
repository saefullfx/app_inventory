<?php 
$this->load->view('template/head');
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      List Rental Unit
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'page'?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">rental unit</a></li>
        <li class="active">list</li>
    </ol>
</section>
      
    
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Daftar Rental</h3>
                 <!--  <div class="pull-right"><a href="" class="btn btn-success" data-toggle="modal" data-target="#ModalaAdd"><span class="fa fa-plus"></span></a>
                  </div> -->

                  <div class="pull-right"><a href="" class="btn btn-success" data-toggle="modal" data-target="#ModalaAdd"><span class="fa fa-plus"></span></a>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">                  
                <table id="example1" class="table table-bordered table-striped display nowrap">
            <thead>
                <tr>
                    <th>Model</th>
                    <th>Pressure</th>
                    <th>S/N</th>
                    <th>Customer</th>
                    <th>Nomor PO</th>
                    <th>Tanggal Kirim</th>
                    <th>Tanggal Kembali</th>
                    <th>Kondisi</th>
                    <th>Keterangan</th>
                    <th>Option</th>       
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
                <h3 class="modal-title" id="myModalLabel">Add Rental Unit</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">    
               
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Model Unit</label>
                        <div class="col-xs-9">
                          <?php
                                $dd_unit_rental_attribute = 'class="form-control select2" style="width:335px;" id="unit_rental_id"';
                                echo form_dropdown('unit_rental_id', $dd_unit_rental, $unit_rental_selected, $dd_unit_rental_attribute);
                            ?>
                        </div>
                    </div>      
                                    
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Customer</label>
                        <div class="col-xs-9">
                          <?php
                                $dd_customer_attribute = 'class="form-control select2" style="width:335px;" id="customer_id"';
                                echo form_dropdown('customer_id', $dd_customer, $customer_selected, $dd_customer_attribute);
                            ?>
                        </div>
                    </div>    
                     
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor PO</label>
                        <div class="col-xs-9">
                            <input name="nomor_po" id="nomor_po" class="form-control" type="text" placeholder="Masukan Nomor PO" style="width:335px;" required>
                        </div>
                    </div>

                   <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal Kirim</label>
                       <div class="col-xs-9">
                            <input name="tanggal_kirim" id="tanggal_kirim" class="form-control" placeholder="Masukan tanggal Kirim" style="width:335px;" required>
                        </div>
                    </div> 

                    <!-- <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal Kembali</label>
                        <div class="col-xs-9">
                            <input name="tanggal_kembali" id="tanggal_kembali" class="form-control" type="text" placeholder="Masukan Tanggal Kembali" style="width:335px;" required>
                        </div>
                    </div>    -->

                    <!-- <div class="form-group">
                        <label class="control-label col-xs-3" >Status Rental</label>
                        <div class="col-xs-9">
                            <input name="status_rental" id="status_rental" class="form-control" type="text" placeholder="Masukan Status Rental" style="width:335px;" required>
                        </div>
                    </div>      -->                                  

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


         <!-- MODAL EDIT unit rental -->
        <div class="modal fade" id="ModalEdit" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Edit</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">  
                    <input type="hidden" name="ided" id="ided2" value="">                

                  <div class="form-group">
                        <label class="control-label col-xs-3" >Model Unit</label>
                        <div class="col-xs-9">
                          <?php
                                $dd_unit_rental_attribute = 'class="form-control select2" style="width:335px;" id="unit_rental_ided2"';
                                echo form_dropdown('unit_rental_ided', $dd_unit_rental, $unit_rental_selected, $dd_unit_rental_attribute);
                            ?>
                        </div>
                    </div>      
                                    
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Customer</label>
                        <div class="col-xs-9">
                          <?php
                                $dd_customer_attribute = 'class="form-control select2" style="width:335px;" id="customer_ided2"';
                                echo form_dropdown('customer_ided', $dd_customer, $customer_selected, $dd_customer_attribute);
                            ?>
                        </div>
                    </div>    
                     
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor PO</label>
                        <div class="col-xs-9">
                            <input name="nomor_poed" id="nomor_poed2" class="form-control" type="text" placeholder="Masukan Nomor PO" style="width:335px;" required>
                        </div>
                    </div>

                   <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal Kirim</label>
                       <div class="col-xs-9">
                            <input name="tanggal_kirimed" id="tanggal_kirimed2" class="form-control" placeholder="Masukan tanggal Kirim" style="width:335px;" required>
                        </div>
                    </div> 

                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <textarea name="keteranganed" id="keteranganed2" class="form-control" type="text" placeholder="Masukan Keterangan" style="width:335px;" required> </textarea>
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

         <!-- MODAL EDIT status unit rental -->
        <div class="modal fade" id="ModalEditRentalKembali" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Edit rental Kembali</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">  

                                 
                    <input type="hidden" name="ideditkembali" id="idkembali2" value=""> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal Kembali </label>
                        <div class="col-xs-9">
                            <input name="tanggal_kembaliedit" id="tanggal_kembali2" class="form-control" type="" placeholder="Format : Tahun-Bulan-Tanggal"  style="width:335px;" required="">
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Kondisi Unit </label>
                        <div class="col-xs-9">
                            <input name="kondisiedit" id="kondisi2" class="form-control" type="" placeholder="Masukan Kondisi Unit"  style="width:335px;" required="">
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <input name="keteranganedit" id="keterangan2" class="form-control" type="" placeholder="Masukan Keterangan"  style="width:335px;" required="">
                        </div>
                    </div> 

                                  
                    
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" id="btn_updatekembali">Update</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <!--END MODAL EDIT status unit rental-->


        <!--MODAL HAPUS-->
        <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                        <h4 class="modal-title" id="myModalLabel">Hapus Data Rental Unit</h4>
                    </div>
                    <form class="form-horizontal">
                    <div class="modal-body">
                                           
                            <input type="hidden" name="id" id="textid" value="">
                            <div class="alert alert-warning"><p>Apakah Anda yakin mau menghapus data rental unit?</p></div>
                                         
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
<script>
  $(document).ready(function () {
                $(".select2").select2({
                    placeholder: "Please Select"
                });
            });
 </script>
      
<script type="text/javascript">
    $(document).ready(function(){
        data_master_unit();   //pemanggilan fungsi tampil.
         
        $('#example1').DataTable( {
            "scrollX": true
        } );
          
        //fungsi tampil barang
        function data_master_unit(){
            $.ajax({
                type  : 'GET',
                url   : '<?php echo base_url()?>index.php/barang/rental/data_rental',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        //var a = data[i].tanggal_kembali;
                        
                        if(data[i].tanggal_kembali == null){
                            html += '<tr>'+
                                                
                                                //'<td>'+data[i].nama_unit+'</td>'+
                                                '<td>'+data[i].model+'</td>'+
                                                '<td>'+data[i].pressure+'</td>'+
                                                '<td>'+data[i].serial_number+'</td>'+                                                
                                                '<td>'+data[i].nama_customer+'</td>'+
                                                '<td>'+data[i].nomor_po+'</td>'+
                                                '<td>'+data[i].tanggal_kirim+'</td>'+
                                                '<td>'+data[i].tanggal_kembali+'</td>'+
                                                '<td>'+data[i].kondisi+'</td>'+
                                                '<td>'+data[i].keterangan+'</td>'+
                                                
                                                '<td width="8%">'+ 

                                                    '<a href="javascript:;" class="btn btn-default  item_editkembali" data-toggle="tooltip" title="Unit Kembali" data="'+data[i].id+'"><span class="fa fa-chevron-circle-right"></span></a>'+' '+
                                                                                                     
                                                    
                                                    '<a href="javascript:;" class="btn btn-info  item_edit" data-toggle="tooltip" title="Edit" data="'+data[i].id+'"><span class="fa fa-pencil"></span></a>'+' '+
                                                    '<a href="javascript:;" class="btn btn-danger  item_delete" data-toggle="tooltip" title="Delete" data="'+data[i].id+'"><span class="fa fa-trash"></span></a>'+
                                                '</td>'+
                                              

                                '</tr>';
                        }else{
                            html += '<tr>'+
                                                
                                                //'<td>'+data[i].nama_unit+'</td>'+
                                                '<td>'+data[i].model+'</td>'+
                                                '<td>'+data[i].pressure+'</td>'+
                                                '<td>'+data[i].serial_number+'</td>'+                                                
                                                '<td>'+data[i].nama_customer+'</td>'+
                                                '<td>'+data[i].nomor_po+'</td>'+
                                                '<td>'+data[i].tanggal_kirim+'</td>'+
                                                '<td>'+data[i].tanggal_kembali+'</td>'+
                                                '<td>'+data[i].kondisi+'</td>'+
                                                '<td>'+data[i].keterangan+'</td>'+
                                                
                                                '<td width="8%">'+ 
                                                

                                                    
                                                    '<a href="javascript:;" class="btn btn-info  item_edit" data-toggle="tooltip" title="Edit" data="'+data[i].id+'"><span class="fa fa-pencil"></span></a>'+' '+
                                                    '<a href="javascript:;" class="btn btn-danger  item_delete" data-toggle="tooltip" title="Delete" data="'+data[i].id+'"><span class="fa fa-trash"></span></a>'+
                                                '</td>'+
                                               

                                '</tr>';
                        }       
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
                url  : "<?php echo base_url('index.php/barang/rental/get_rental')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id, unit_rental_id, customer_id, nomor_po, tanggal_kirim, keterangan){
                        $('#ModalEdit').modal('show');
                        $('[name="ided"]').val(data.id);
                        $('[name="unit_rental_ided"]').val(data.unit_rental_id);
                        $('[name="customer_ided"]').val(data.customer_id);
                        $('[name="nomor_poed"]').val(data.nomor_po);
                        $('[name="tanggal_kirimed"]').val(data.tanggal_kirim);
                        $('[name="keteranganed"]').val(data.keterangan);
                        
                    });
                }
            });
            return false;
        });


        //GET UPDATE
        $('#show_data').on('click','.item_editkembali',function(){
            var id=$(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('index.php/barang/rental/get_rental')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id, keterangan){
                        $('#ModalEditRentalKembali').modal('show');
                        $('[name="ideditkembali"]').val(data.id);
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

         //Save rental unit
        $('#btn_simpan').on('click',function(){
            var unit_rental_id=$('#unit_rental_id').val();
            var customer_id=$('#customer_id').val();
            var nomor_po=$('#nomor_po').val(); 
            var tanggal_kirim=$('#tanggal_kirim').val();
            var keterangan=$('#keterangan').val();           
           // var status=$('#status').val();
           
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/barang/rental/save_rental')?>",
                dataType : "JSON",
                data : {unit_rental_id:unit_rental_id, customer_id:customer_id, nomor_po:nomor_po, tanggal_kirim:tanggal_kirim, keterangan:keterangan},
                success: function(data){       
                   
                    $('[name="unit_rental_id"]').val("");         
                    $('[name="customer_id"]').val("");
                    $('[name="nomor_po"]').val("");
                     $('[name="tanggal_kirim"]').val("");
                      $('[name="keterangan"]').val("");
                    
                    //$('[name="status"]').val("");                    
                    $('#ModalaAdd').modal('hide');
                     data_master_unit();
                      location.reload();
                }
            });
            return false;
        });   

         

 
        //Update
        $('#btn_update').on('click',function(){
            var id=$('#ided2').val();
            var unit_rental_id=$('#unit_rental_ided2').val();
            var customer_id=$('#customer_ided2').val();
            var nomor_po=$('#nomor_poed2').val();
            var tanggal_kirim=$('#tanggal_kirimed2').val();
            var keterangan=$('#keteranganed2').val();
           
             $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/barang/rental/update_rental')?>",
                dataType : "JSON",
                data : {id:id, unit_rental_id:unit_rental_id, customer_id:customer_id, nomor_po:nomor_po, tanggal_kirim:tanggal_kirim, keterangan:keterangan},
                success: function(data){
                        $('[name="ided"]').val();
                        $('[name="unit_rental_ided"]').val();
                        $('[name="customer_ided"]').val();
                        $('[name="nomor_poed"]').val();
                        $('[name="tanggal_kirimed"]').val();
                    $('#ModalEdit').modal('hide');
                    data_master_unit();
                      location.reload();
                }
            });
            return false;
        });

        //Update
        $('#btn_updatekembali').on('click',function(){
            var id=$('#idkembali2').val();
            var tanggal_kembali=$('#tanggal_kembali2').val();
            var kondisi=$('#kondisi2').val();
            var keterangan=$('#keterangan2').val();
           
           
             $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/barang/rental/update_rental_kembali')?>",
                dataType : "JSON",
                data : {id:id, tanggal_kembali:tanggal_kembali, kondisi:kondisi, keterangan:keterangan},
                success: function(data){
                        $('[name="ideditkembali"]').val();
                        $('[name="tanggal_kembaliedit"]').val();
                        $('[name="kondisiedit"]').val();
                        $('[name="keteranganedit"]').val();
                        
                    $('#ModalEditRentalKembali').modal('hide');
                    data_master_unit();
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
            url  : "<?php echo base_url('index.php/barang/rental/delete_rental')?>",
            dataType : "JSON",
                    data : {id:id},
                    success: function(data){
                            $('#ModalDelete').modal('hide');
                             data_master_unit();
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

