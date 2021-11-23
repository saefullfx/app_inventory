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
        Data Rental Unit
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">laporan</a></li>
        <li class="active">rekap unit</li>
    </ol>
</section>

     <!-- Main content -->
<section class="content">
 <div class="row">
    <div class="col-xs-12">
        <div class="box">
         <div class="box-body">
            <table id="example" class="cell-border display nowrap" width="100%">
                <thead>
            <tr>
                            <th>No.</th>
                            <th>Model</th>
                            <th>Pressure</th>  
                            <th>S/N</th>    
                            <th>Status Unit Rental</th>   
                            <th>Keterangan</th>
                            
                                                    
            </tr>
        </thead>
        <tbody>
    <?php
    if( ! empty($unit_rental)){
        $no = 1;
        foreach($unit_rental as $data){
            //$tgl = date('d-m-Y', strtotime($data->tanggal));
           ?> 
    <tr>   
        <td><?php echo $no++?>   </td>     
        <td><a href="<?php echo site_url('barang/rental/detail_unit_rental/').$data->model_id?>"><?php echo $data->model?></a></td>
        <td><?php echo $data->pressure ?></td>
        <td><?php echo $data->serial_number?></td>
        <?php
            if($data->status_rental == 'Free'){ ?>
                 <td><small class="label label-info"><?php echo $data->status_rental?></small></td>
        <?php      }else if($data->status_rental == 'Dipakai'){ ?>
                        <td><small class="label label-warning"><?php echo $data->status_rental?></small></td>
            <?php   }?>
       <!-- <td align="center"><a href="<?php echo site_url('report/detail_unit_ready/').$data->model_id?>"><?php echo $data->stock_ready?></a></td>  -->
        <td><?php echo $data->keterangan_unit ?></td>
    </tr>
 <?php       }
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
<script>
        $(function(){
            $(document).on('click','.edit-record',function(e){
                e.preventDefault();
                $("#myModal").modal('show');
                $.post('<?php echo base_url('index.php/report/detail_unit_masuk')?>',
                    {model_id:$(this).attr('data-id')},
                    function(html){
                        $(".modal-body").html(html);
                    }
                );
            });
        });
    </script>


    <script src="<?php echo base_url('assets/js/jquery-ui.js'); ?>"></script> <!-- Load file plugin js jquery-ui -->
    <script>
    $(document).ready(function(){ // Ketika halaman selesai di load
        

        $('#form-model_unit_rekap, #form-nama_unit_rekap').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya

        $('#filter').change(function(){ // Ketika user memilih filter
            if($(this).val() == '1'){ // Jika filter nya 1 (per tanggal)
                $('#form-nama_unit_rekap').hide(); // Sembunyikan form bulan dan tahun
                $('#form-model_unit_rekap').show(); // Tampilkan form tanggal
            }else if($(this).val() == '2'){
                $('#form-model_unit_rekap').hide(); // Sembunyikan form bulan dan tahun
                $('#form-nama_unit_rekap').show(); // Tampilkan form tanggal
            }

            $(' #form-model_unit_rekap select, #form-nama_unit_rekap select').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
        })
    })
    </script>

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
                messageTop: 'Kartu Stock Unit',
            },

            {
                extend: 'pdfHtml5',
                messageTop: 'Kartu Stock Unit',
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