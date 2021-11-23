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
        <form action="<?php echo site_url('page/update_customer');?>" method="post">
          <div class="form-group">
            <label>Nama Customer</label>
            <input type="text" class="form-control" name="nama_customer" value="<?php echo $nama_customer;?>" placeholder="">
          </div>
          <div class="form-group">
            <label>Telepon</label>
            <input type="text" class="form-control" name="telepon" value="<?php echo $telepon;?>" placeholder="Telepon">
          </div>
             <div class="form-group">
            <label>Alamat</label>
            <input type="text" class="form-control" name="alamat" value="<?php echo $alamat;?>" placeholder="Telepon">
          </div>
             <div class="form-group">
            <label>Keterangan</label>
            <input type="text" class="form-control" name="keterangan" value="<?php echo $keterangan;?>" placeholder="Telepon">
          </div>

          <input type="hidden" name="id" value="<?php echo $id?>">
          <a href="<?php echo base_url().'index.php/page/read_supplier'?>" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-primary">Update</button>
  </form>
           </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
      
      </div><!-- /.content-wrapper -->           
            

</section><!-- /.content -->
 
    <?php 
    $this->load->view('template/js');
?>
  </body>
</html>