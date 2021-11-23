<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit Supplier
        <small>edit supplier</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Supplier</a></li>
        <li class="active">edit</li>
    </ol>
</section>
 
     <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  
                </div><!-- /.box-header -->
                <div class="box-body">
                

            
                <!--  <?php 
                    ///  $att = array('id' => 'biodata-form');
//echo form_open('page/update_sparepart', $att);
                     // echo form_hidden('id', $edit->id);
                  ?> -->
          <form class="form-horizontal" method="post" action="<?php echo base_url().'index.php/page/update_sparepart'?>">
          <input type="hidden" name="id" value="<?php echo $edit->id ?>">
          <div class="form-group">
            <label class="control-label col-xs-3" >Part Number</label>
            <div class="col-xs-9">           
                  <input type="text" class="form-control" name="kode_barang" value="<?php echo $edit->kode_barang;?>" style="width:335px;">
            </div>
          </div>
          
          <div class="form-group">
            <label class="control-label col-xs-3" >Nama Sparepart</label>
             <div class="col-xs-9"> 
                  <input type="text" class="form-control" name="nama_barang" value="<?php echo $edit->nama_barang;?>" style="width:335px;">
            </div>
          </div>

           <!-- <div class="form-group">
            <label class="control-label col-xs-3" >Jenis Sparepart</label>
             <div class="col-xs-9"> 
                  <input type="text" class="form-control" name="jenis_id" value="<?php //echo $edit->jenis_id;?>" style="width:335px;">
            </div>
          </div> -->

            <div class="form-group">
                        <label class="control-label col-xs-3" >Jenis</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_jenis_attribute = 'class="form-control select2" id="jenis_id" style="width:335px;" required';
                                echo form_dropdown('jenis_id', $dd_jenis, $jenis_selected, $dd_jenis_attribute);
                            ?>
                        </div>
                    </div> 
                 
                    
             <div class="form-group">
            <label class="control-label col-xs-3" >Part Number Persamaan</label>
             <div class="col-xs-9"> 
            <input type="text" class="form-control" name="keterangan" value="<?php echo $edit->keterangan;?>" style="width:335px;">
            </div>
          </div>
          <br/>

         
          <a href="<?php echo base_url().'index.php/page/item_sparepart'?>" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-primary">Update</button>
   </form>
  
           </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
      
      </div><!-- /.content-wrapper -->           
            

</section><!-- /.content -->
 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
 <script src="<?php echo base_url('assets/js/jquery-ui.js'); ?>"></script>
 
 <script type="text/javascript">
   
            $(document).ready(function () {
                $(".select2").select2({
                    placeholder: "Please Select"
                });
            });


 </script>




    <?php 
    $this->load->view('template/js');
?>
  </body>
</html>