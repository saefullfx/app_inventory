<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Add Supplier
        <small>data add supplier</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Supplier</a></li>
        <li class="active">add</li>
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
                   <form class="well form-horizontal" action="<?php echo site_url('page/save_supplier');?>" method="post">
                    
                         <div class="form-group">
                        <label class="control-label col-xs-3" >Nama supplier</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="" name="nama_supplier" placeholder="Nama supplier" class="form-control" required="true" value="" type="text" style="width:335px;"></div>
                            </div>
                         </div>
                         <div class="form-group">
                        <label class="control-label col-xs-3" >Telepon</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span><input id="" name="telepon" placeholder="Telepon" class="form-control" required="true" value="" type="text" style="width:335px;"></div>
                            </div>
                         </div>
                         <div class="form-group">
                        <label class="control-label col-xs-3" >Alamat</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span><textarea id="" name="alamat" placeholder="Alamat" class="form-control" required="true" value="" type="text" style="width:335px;"></textarea></div>
                            </div>
                         </div>
                         <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span><input id="" name="keterangan" placeholder="Keterangan" class="form-control" required="true" value="" type="text" style="width:335px;"></div>
                            </div>
                         </div>
                         
                   
                         <a href="<?php echo base_url().'index.php/page/read_supplier'?>" class="btn btn-default">Cancel</a>
                      <button type="submit" class="btn btn-info">Submit</button>
                      
            
            </form>
           </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
      
      </div><!-- /.content-wrapper -->           
            

</section><!-- /.content -->

<?php 
    $this->load->view('template/js');
?>
<?php 
    $this->load->view('template/foot');
?>