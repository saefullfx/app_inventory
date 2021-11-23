<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
<link src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datepicker/datepicker3.css'?>" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
<link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />

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
                    <?php if($this->session->flashdata('simpan')){ ?>  
                                 <div class="alert alert-success">  
                                   <a href="#" class="close" data-dismiss="alert">&times;</a>  
                                   <strong>OK!</strong> <?php echo $this->session->flashdata('simpan'); ?>  
                                 </div>  
                               <?php } else if($this->session->flashdata('delete')){ ?>  
                                 <div class="alert alert-danger">  
                                   <a href="#" class="close" data-dismiss="alert">&times;</a>  
                                   <strong>Ok!</strong> <?php echo $this->session->flashdata('delete'); ?>  
                                 </div>  
                               <?php } else if($this->session->flashdata('update')){ ?>  
                                 <div class="alert alert-warning">  
                                   <a href="#" class="close" data-dismiss="alert">&times;</a>  
                                   <strong>Warning!</strong> <?php echo $this->session->flashdata('update'); ?>  
                                 </div>  
                               <?php } else if($this->session->flashdata('info')){ ?>  
                                 <div class="alert alert-info">  
                                   <a href="#" class="close" data-dismiss="alert">&times;</a>  
                                   <strong>Info!</strong> <?php echo $this->session->flashdata('info'); ?>  
                                 </div>  
                              <?php } ?>  
                  
                <table id="example1" class="table table-bordered table-striped"  width="100%" cellspacing="0">
		            <thead>
		                <tr>
		                  
		                    <th>Part Number</th>
		                    <th>Sparepart</th>
		                    <th>Jumlah</th>
		                    <!-- <th>Dikirim</th>
		                    <th>Belum Dikirim</th> -->
		                    <th>Customer</th>
		                    <th>Tanggal PO</th>                   
		                    <th>Nomor PO</th>                     
		                    <th>Keterangan</th>
		                    <th>Aksi</th>		                    
		                    
		                </tr>
		            </thead>
		            <tbody>
		                 <?php 
                                                $no = 1;
                                                foreach($sp_dipesan as $row)
                                                {
                                                  ?>
                                            <tr>
                                                                                        
                                                <td><?php echo $row->kode_barang?></td>
                                                <td><?php echo $row->nama_barang?></td>
                                                <td><?php echo $row->jumlah?></td>
                                                <!-- <td><?php echo $row->jumlah_parsial?></td>
                                                <td><?php echo $row->SISA_KIRIM?></td> -->
                                                <td><?php echo $row->nama_customer?></td>
                                                <td><?php echo $row->tanggal_order?></td>
                                                <td><?php echo $row->nomor_po?></td>                                                
                                                <td><?php echo $row->keterangan?></td>
                                                <td>

                                                	<form action="<?=site_url('sparepart/delete_sp_dipesan') ?>" method="POST">
                                                		
                                                  	<a  href="<?= site_url('sparepart/edit/'.$row->id)?>" class="btn btn-primary"><span class="fa fa-pencil"></span> </a>  

                                                 
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
 

 



<?php 
    $this->load->view('template/js');
?>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>kolam/AdminLTE-2.0.5/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function()
    {        
        $('#example1').DataTable( {
            
        } );         
    
 
    }); 
</script>

<script type="application/javascript">  
     /** After windod Load */  
     $(window).bind("load", function() {  
       window.setTimeout(function() {  
         $(".alert").fadeTo(1500, 0).slideUp(1500, function() {  
           $(this).remove();  
         });  
       }, 1500);  
     });  
   </script>



<!--tambahkan custom js disini -->
<?php
$this->load->view('template/foot');
?>