<?php 
$this->load->view('template/head');
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"/> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css"/>



<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
     Pengecekan Stock Sparepart System dan Fisik
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'page'?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#"></a></li>
        <li class="active"></li>
    </ol>
</section>
      
    
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                   <div class="box-body">
                  
                <table id="" class="table table-bordered table-striped display nowrap">
                    <thead>
                        <tr>
                          <th>Tingkat Akurasi</th>          
                        </tr>
                    </thead>
                    <tbody>

    <?php 
   
    $total1 = 0;
    $total2 = 0;
            foreach ($cek_stock as $data) {  
                
                
           
            $total1 += floatval($data->stock_fisik);
             if ($total1 <= 0) $total1 = 1;

            $total2 += floatval($data->stock_digital);
              if ($total2 <= 0) $total2 = 1;
           
            $total_total = round($total1 / $total2 * 100, 2);
            }
     ?>   
            <tr font-style: bold;>
             

            <td> <h1><b><?php echo "$total_total %"; ?></b></h1></td>
            
        </tr>    
    </tbody>
             </table>
              </div><!-- /.box -->
              </div>
            </div>
      </div>         


          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"></h3>
                  <div class="pull-right"><a class="btn  btn-info" href="<?php echo base_url("index.php/report/form_import_cek_stock"); ?>">Import Data <span class="fa fa-plus"></span></a></div>
                  <div class="pull-left"><a class="btn  btn-danger" href="<?php echo base_url("index.php/report/clear_data"); ?>">Clear Data <span class="fa fa-trash"></span></a></div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  
                <table id="example1" class="table table-bordered table-striped display nowrap">
                    <thead>
                        <tr>
                          <th>Part Number</th>
                          <th>Stok Sistem</th>
                          <th>Stok Fisik</th>
                          <th>Selisih</th>
                          <th>Tanggal Upload</th>            
                        </tr>
                    </thead>
                      <tbody>

    <?php 
   
    $total1 = 0;
    $total2 = 0;
            foreach ($cek_stock as $data) {
               
    ?>    
            
        <tr>
            <td><?php echo $data->kode_barang;  ?></td>           
            <td><?php echo $data->stock_digital;  ?></td>           
            <td><?php echo $data->stock_fisik;  ?></td>  
            <td><?php echo $data->cek_selisih;  ?></td>  
            <td><?php echo $data->waktu;  ?></td>             
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

<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
       /* tampil_data_cek_stock();*/   //pemanggilan fungsi tampil.
         
        $('#example1').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'print'
            ]
            } ); 
    });
</script>
<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>

