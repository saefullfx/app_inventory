<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datepicker/datepicker3.css'?>" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit Sparepart dipesan
        <small>Edit Sparepart dipesan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('page');?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo site_url('sparepart/sp_dipesan');?>">Sparepart dipesan</a></li>
        <li class="active">edit</li>
    </ol>
</section>

        <section class="content">
              <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body">
                                <form class="well form-horizontal" action="<?php echo site_url('sparepart/update_po_dipesan');?>" method="post">
                                    <input type="hidden" name="id" value="<?php echo $sp_dipesan->id?>" required>
                                   

                                    <div class="form-group">
                                        <label class="control-label col-xs-3" >Part Number</label>
                                        <div class="col-xs-9">
                                           <!--  <select class="form-control" id="customer_id" name="customer_id">
                                               <option selected="0">select..</option>
                                               <?php foreach($customer as $cust) : ?>
                                                <option value="<?php echo $cust->id_customer;?>"> <?php echo $cust->nama_customer; ?></option>
                                               <?php endforeach; ?>
                                              </select> -->
                                             <?php
                                                $dd_barang_attribute = 'class="form-control select2" style="width:335px;" value="<?php echo $sp_dipesan->kode_barang; ?>"" required';
                                                echo form_dropdown('kode_barang', $dd_barang, $barang_selected, $dd_barang_attribute);
                                            ?>
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <label class="control-label col-xs-3" >Customer</label>
                                        <div class="col-xs-9">
                                            <?php
                                                $dd_customer_attribute = 'class="form-control select2" style="width:335px;" id="customer_id" required';
                                                echo form_dropdown('customer_id', $dd_customer, $customer_selected, $dd_customer_attribute);
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-xs-3">Tanggal Order</label>
                                        <div class="col-xs-9">
                                            <input type="text" value="<?php //echo $sp_dipesan->tanggal_order; ?>" class="form-control" name="tanggal_order" id="tanggal_order" placeholder="Tanggal Order" style="width:335px;" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-xs-3">Jumlah</label>
                                        <div class="col-xs-9">
                                            <input type="number" value="<?php //echo $sp_dipesan->jumlah; ?>" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah" style="width:335px;" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="nomor_po" class="control-label col-xs-3">Nomor PO</label>
                                        <div class="col-xs-9">
                                            <input type="text" value="<?php //echo $sp_dipesan->nomor_po; ?>" class="form-control" name="nomor_po" id="nomor_po" placeholder="Nomor PO" style="width:335px;" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="keterangan" class="control-label col-xs-3">Keterangan</label>
                                        <div class="col-xs-9">
                                        <input type="text" value="<?php //echo $sp_dipesan->keterangan; ?>" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" style="width:335px;" required>
                                        </div>
                                    </div>     
                                        <a href="<?php echo base_url().'sparepart/sp_dipesan'?>" class="btn btn-danger"> Batal </a>               
                                        <button class="btn btn-info" type="submit">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
              </div>            
        </section>
    
<?php 
    $this->load->view('template/js');
?>
        <script src="<?php  echo base_url();?>kolam/AdminLTE-2.0.5/plugins/datepicker/bootstrap-datepicker.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script>
            $(function () {
            //Date picker
            $('#tanggal_order').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true    }); 
            });             
        

            $(document).ready(function () {
                $(".select2").select2({
                    placeholder: "Please Select"
                });
            });
        </script>

        <script type="text/javascript">
        $(document).ready(function(){
            //call function get data edit
            get_data_edit();
 
            //load data for edit
            function get_data_edit(){

            var id = $('[name="id"]').val();            
            $.ajax({
            // type : "GET",
            url  : "<?php echo base_url()?>index.php/sparepart/get_data_by_id",
            method : "POST",
            data : {id:id},
            dataType : "JSON",            
            success: function(data){
                  $.each(data, function(i, item){
                      
                      $('[name="kode_barang"]').val(data.kode_barang);
                      $('[name="customer_id"]').val(data.customer_id);
                      $('[name="jumlah"]').val(data.jumlah);
                      $('[name="nomor_po"]').val(data.nomor_po);
                      $('[name="tanggal_order"]').val(data.tanggal_order);
                      $('[name="keterangan"]').val(data.keterangan);
                      $('#id').val(data.id);
                  });
              }
            });
            }
             
        });
    </script>
    