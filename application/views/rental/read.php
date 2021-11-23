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
    <h1>
      Daftar Unit Rental Compressor
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

                  <div class="pull-right"><a href="" class="btn btn-success" data-toggle="modal" data-target="#ModalaAddMaster"><span class="fa fa-plus"></span></a>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  
                <table id="example1" class="table table-bordered table-striped display nowrap">
            <thead>
                <tr>
                   
                    
                    <th>Model</th>
                    <th>Pressure</th>
                    <th>S/N</th>
                    <th>Status Unit Rental</th>
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

<!-- MODAL ADD master unit rental -->
 
        <div class="modal fade" id="ModalaAddMaster" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
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
                                $dd_model_id_attribute = 'class="form-control select2" style="width:335px;" id="model_idm"';
                                echo form_dropdown('model_id', $dd_model_id, $model_id_selected, $dd_model_id_attribute);
                            ?>                        </div>
                    </div>      
                                   
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Pressure</label>
                        <div class="col-xs-9">
                            <input name="pressurem" id="pressurem" class="form-control" type="text" placeholder="Masukan pressure" style="width:335px;" required>
                        </div>
                    </div> 
                        
                   
                    <div class="form-group">
                        <label class="control-label col-xs-3" >S/N</label>
                        <div class="col-xs-9">
                            <input name="serial_numberm" id="serial_numberm" class="form-control" type="text" placeholder="Masukan serial number" style="width:335px;" required>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <input name="keterangan_unitm" id="keterangan_unitm" class="form-control" type="text" placeholder="Masukan keterangan unit rental" style="width:335px;" required>
                        </div>
                    </div> 
                                    
                </div>
 
               <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button class="btn btn-info" id="btn_simpanm">Save</button>
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

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Model Unit</label>
                        <div class="col-xs-9">
                          <?php
                                $dd_model_id_attribute = 'class="form-control select2" style="width:335px;" id="model_id2" required';
                                echo form_dropdown('model_idedit', $dd_model_id, $model_id_selected, $dd_model_id_attribute);
                            ?>
                        </div>
                    </div>                       
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Pressure </label>
                        <div class="col-xs-9">
                            <input name="pressureedit" id="pressure2" class="form-control" type=""  style="width:335px;" required="">
                        </div>
                    </div> 

                    <input type="hidden" name="idedit" id="id2" value=""> 

                   <!--   <div class="form-group">
                        <label class="control-label col-xs-3" >Status Unit Rental</label>
                        <div class="col-xs-9">
                    <select class="form-control select2" name="status_rental" id="status_rental2" style="width:335px;" required>
                      <option selected value="">Please Select</option>
                      <option value="Free">Free</option>
                      <option value="Booked">Booked</option>                      
                    </select>
                        </div>
                    </div>  -->

                     <div class="form-group">
                        <label class="control-label col-xs-3" >S/N</label>
                        <div class="col-xs-9">
                            <input name="serial_numberedit" id="serial_number2" class="form-control" type="text"  style="width:335px;" required>
                        </div>
                    </div> 

                     <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <input name="keterangan_unitedit" id="keterangan_unit2" class="form-control" type="text"  style="width:335px;" required>
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
        <!--END MODAL EDIT unit rental-->

         <!-- MODAL EDIT status unit rental -->
        <div class="modal fade" id="ModalEditStatus" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Edit Status Unit Rental</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">  

                                 
                    <input type="hidden" name="ideditstatus" id="idstatus2" value=""> 

                     <div class="form-group">
                        <label class="control-label col-xs-3" >Status Unit Rental</label>
                        <div class="col-xs-9">
                            <select class="form-control select2" name="status_rentalstatus" id="status_rental2" style="width:335px;" required>
                              <option selected value="">Please Select</option>
                              <option value="Free">Free</option>
                              <option value="Dipakai">Dipakai</option>                      
                             </select>
                        </div>
                    </div>                 
                    
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" id="btn_updatestatus">Update</button>
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
                url   : '<?php echo base_url()?>index.php/barang/rental/data_unit_rental',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        var a = data[i].status_rental;
                        
                        //if(a == 'Free'){
                            html += '<tr>'+
                                                
                                                //'<td>'+data[i].nama_unit+'</td>'+
                                                '<td>'+data[i].model+'</td>'+
                                                '<td>'+data[i].pressure+'</td>'+
                                                '<td>'+data[i].serial_number+'</td>'+
                                                '<td>'+'<small class="">'+data[i].status_rental+'</small>'+'</td>'+
                                                '<td>'+'<small class="">'+data[i].keterangan_unit+'</small>'+'</td>'+
                                                '<td width="8%">'+                                                  

                                                    '<a href="javascript:;" class="btn btn-info  item_edit" data-toggle="tooltip" title="Edit" data="'+data[i].id+'"><span class="fa fa-pencil"></span></a>'+' '+
                                                   /* '<a href="javascript:;" class="btn btn-danger  item_delete" data-toggle="tooltip" title="Delete" data="'+data[i].id+'"><span class="fa fa-trash"></span></a>'+' '+*/
                                                    '<a href="javascript:;" class="btn btn-default  item_editstatus" data-toggle="tooltip" title="Edit Status" data="'+data[i].id+'"><span class="fa fa-chevron-circle-right"></span></a>'+' '+
                                                '</td>'+
                                              

                                '</tr>';
                        /*}else if(a == 'Booked'){
                            html += '<tr>'+
                                                ModalEditStatus
                                                //'<td>'+data[i].nama_unit+'</td>'+
                                                '<td>'+data[i].model+'</td>'+
                                                '<td>'+data[i].pressure+'</td>'+
                                                '<td>'+data[i].serial_number+'</td>'+
                                                '<td>'+'<small class="label label-warning">'+data[i].status_rental+'</small>'+'</td>'+
                                                '<td width="8%">'+                    
                                                    '<a href="javascript:;" class="btn btn-info  item_edit" data-toggle="tooltip" title="Edit" data="'+data[i].id+'"><span class="fa fa-pencil"></span></a>'+' '+
                                                    '<a href="javascript:;" class="btn btn-danger  item_delete" data-toggle="tooltip" title="Delete" data="'+data[i].id+'"><span class="fa fa-trash"></span></a>'+
                                                '</td>'+
                                               

                                '</tr>';
                        }*/       
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
                url  : "<?php echo base_url('index.php/barang/rental/get_unit_rental')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id, model_id, pressure, serial_number ){
                        $('#ModalEdit').modal('show');
                        $('[name="idedit"]').val(data.id);
                        $('[name="model_idedit"]').val(data.model_id);
                        $('[name="pressureedit"]').val(data.pressure);
                        $('[name="serial_numberedit"]').val(data.serial_number);
                        $('[name="keterangan_unitedit"]').val(data.keterangan_unit);
                       
                        
                    });
                }
            });
            return false;
        });

         //GET UPDATE
        $('#show_data').on('click','.item_editstatus',function(){
            var id=$(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('index.php/barang/rental/get_unit_rental')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(id, status_rental){
                        $('#ModalEditStatus').modal('show');
                        $('[name="ideditstatus"]').val(data.id);
                        $('[name="status_rentalstatus"]').val(data.status_rental);  
                    });
                }
            });
            return false;
        });

        
    
       /*//GET HAPUS
        $('#show_data').on('click','.item_delete',function(){
            var id=$(this).attr('data');
            $('#ModalDelete').modal('show');
            $('[name="id"]').val(id);
        });*/

         //Save master unit rental
        $('#btn_simpanm').on('click',function(){
            var model_id=$('#model_idm').val();
            var pressure=$('#pressurem').val();
            var serial_number=$('#serial_numberm').val();            
            var keterangan_unit=$('#keterangan_unitm').val();
           
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/barang/rental/save_unit_rental')?>",
                dataType : "JSON",
                data : {model_id:model_id, pressure:pressure, serial_number:serial_number, keterangan_unit},
                success: function(data){       
                   
                    $('[name="model_idm"]').val("");         
                    $('[name="pressurem"]').val("");
                    $('[name="serial_numberm"]').val("");
                    $('[name="keterangan_unitm"]').val("");                    
                    $('#ModalaAddMaster').modal('hide');
                     data_master_unit();
                      location.reload();
                }
            });
            return false;
        });   

         

 
        //Update
        $('#btn_update').on('click',function(){
            var id=$('#id2').val();
            var model_id=$('#model_id2').val();
            var pressure=$('#pressure2').val();
            var serial_number=$('#serial_number2').val();
           var keterangan_unit=$('#keterangan_unit2').val();
           
             $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/barang/rental/update_unit_rental')?>",
                dataType : "JSON",
                data : {id:id, model_id:model_id, pressure:pressure, serial_number:serial_number, keterangan_unit},
                success: function(data){
                        $('[name="idedit"]').val();
                        $('[name="model_idedit"]').val();
                        $('[name="pressureedit"]').val();
                        $('[name="serial_numberedit"]').val();
                        $('[name="keterangan_unitedit"]').val();
                    $('#ModalEdit').modal('hide');
                    data_master_unit();
                      location.reload();
                }
            });
            return false;
        });


         //Update status unit rental
        $('#btn_updatestatus').on('click',function(){
            var id=$('#idstatus2').val();           
            var status_rental=$('#status_rental2').val();          
           
             $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/barang/rental/update_status_unit_rental')?>",
                dataType : "JSON",
                data : {id:id, status_rental:status_rental},
                success: function(data){
                        $('[name="ideditstatus"]').val();                       
                        $('[name="status_rentalstatus"]').val();
                    $('#ModalEditStatus').modal('hide');
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

