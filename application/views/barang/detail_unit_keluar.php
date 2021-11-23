
<?php 
$this->load->view('template/head');
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  
  <link src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datepicker/datepicker3.css'?>" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
 <!-- <link src="<?php //echo base_url().'plugins/datatables/dataTables.bootstrap.css'?>" rel="stylesheet" type="text/css" />
   
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
 -->
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Detail Unit Keluar
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">detail</a></li>
        <li class="active">unit</li>
    </ol>
</section>

     <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
<div class="box">
     <div class="box-header">
                  <h3 class="box-title"></h3>
                  <div class="pull-right"><a href="<?php echo base_url().'index.php/report/rekap_unit_all'?>" class="btn  btn-info"  >Kembali </a></div>
                </div><!-- /.box-header -->
    

       

         

          
        
     

 <div class="box-body">
    <table id="example" class="cell-border display nowrap" width="100%">
        <thead>
    <tr>
                    <th>No.</th>
                    <th>Type Unit</th>
                    <th>Model Unit</th>
                    <th>Serial Number</th>
                    <th>Pressure</th>
                    <th>Voltase</th>                           
                    <th>Jumlah</th>
                    <th>Tanggal PO Customer</th>
                    <th>Customer</th>
                    <th>PO Customer</th>
                    <th>Tanggal Keluar</th>
                    <th>Keterangan</th>
                    
                                            
    </tr>
</thead>
<tbody>
    <?php
    if( ! empty($detail_unit_keluar)){
        $no = 1;
        foreach($detail_unit_keluar as $data){
            //$tgl = date('d-m-Y', strtotime($data->tanggal));
           ?> 
            <tr> 

                 <td><?php echo $no++ ?></td>          
                <td><?php echo $data->nama_unit ?></td>
                <td><?php echo $data->model ?></td>
                <td><?php echo $data->serial_number ?></td>
                <td><?php echo $data->pressure ?></td>
                <td><?php echo $data->voltase ?></td>
                <td><?php echo $data->jumlah ?></td>
                <td><?php echo $data->tanggal_po_customer ?></td>
                <td><?php echo $data->nama_customer ?></td>
                <td><?php echo $data->nomor_po ?></td>
                <td><?php echo $data->tanggal ?></td>
                <td><?php echo $data->keterangan ?></td>
               
           </tr>
 <?php       
           
        }
    }

    ?>
    </tbody>
    </table>


            </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
      </div>     
</section>


    
<?php 
$this->load->view('template/js');
?>
    <script src="<?php echo base_url('assets/js/jquery-ui.js'); ?>"></script> <!-- Load file plugin js jquery-ui -->

    <script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>

<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable( {
        "scrollX": true,
        dom: 'Bfrtip',
        buttons: [
            
              /*  {
                extend: 'print',
                messageTop: 'This print was produced using the Print button for DataTables'
            },*/
            {
                extend: 'print',
                messageTop: 'Data Detail Unit Keluar',
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10pt' )
                        /*.prepend(
                            '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
                        );*/
 
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                }
            },

            {
                extend: 'excel',
                messageTop: 'Data Detail Unit Keluar',
            },

            {
                extend: 'pdfHtml5',
                messageTop: 'Data Detail Unit Keluar',
                orientation: 'landscape',
                pageSize: 'A4',
            }

            /*{
                extend: 'print',
                messageTop: 'This print was produced using the Print button for DataTables'
            }*/
            
        ]
    } );
} );
    </script>

    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<!--tambahkan custom js disini-->
<?php

$this->load->view('template/foot');

?>