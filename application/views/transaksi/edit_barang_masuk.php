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
        Edit barang masuk
        <small>edit barang masuk</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">barang Masuk</a></li>
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
            
        <form action="<?php echo site_url('admin/transaksi/update_barang_masuk');?>" method="post">
          <div class="form-group">
                        <label class="control-label col-xs-3" >Kode Barang</label>
                        <div class="col-xs-9">
                          <?php
                                $dd_barang_attribute = 'class="form-control select2" style="width:335px;"';
                                echo form_dropdown('kode_barang', $dd_barang, $barang_selected, $dd_barang_attribute);
                            ?>
                        </div>
                    </div>  
                    
                    
                        
                       
                            <input name="status_id" id="status_id" class="form-control" type="hidden" value="1" p style="width:335px;" required>
                       
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Supplier</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_supplier_attribute = 'class="form-control select2" style="width:335px;"';
                                echo form_dropdown('supplier_id', $dd_supplier, $supplier_selected, $dd_supplier_attribute);
                            ?>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jumlah</label>
                        <div class="col-xs-9">
                            <input name="jumlah" id="tingkat" value="<?php echo $jumlah?>" class="form-control" type="text" placeholder="Jumlah" style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor PO</label>
                        <div class="col-xs-9">
                            <input name="nomor_po" id="nomor_po" value="<?php echo $nomor_po?>" class="form-control" type="text" placeholder="nomor_po" style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor Surat Jalan</label>
                        <div class="col-xs-9">
                            <input name="nomor_surat_jalan" value="<?php echo $nomor_surat_jalan?>" id="nomor_surat_jalan" class="form-control" type="text" placeholder="Nomor Surat Jalan" style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal</label>
                        <div class="col-xs-9">
                            <input name="tanggal" id="tanggal" class="form-control" value="<?php echo $tanggal?>" placeholder="tanggal" style="width:335px;" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <input name="keterangan" id="keterangan" class="form-control" type="text" value="<?php echo $keterangan?>" placeholder="Keterangan" style="width:335px;" required>
                        </div>
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