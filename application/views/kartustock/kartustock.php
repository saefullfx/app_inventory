<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<!-- <link src="<?php //echo base_url().'kolam/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.css'?>" rel="stylesheet" type="text/css"> -->

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">


<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
       Kartu Stock
        <small>Unit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Kartu Stock</a></li>
        <li class="active">list</li>
    </ol>
</section>
      
    
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <hr>
    <form method="get" action="">
        <label>Filter Berdasarkan</label><br>
        <select name="filter" id="filter">
            <option value="">Pilih</option>
            <option value="1">Per Model</option>
            <!-- <option value="2">Per Nama Unit</option> -->
            <option value="2">Per Serial Number</option>
        </select>
        <br /><br />

       

         <div id="form-model_unit_rekap">
            <label>Model</label><br>
            <select name="model">
                <option value="">Pilih</option>
                <?php
                    foreach ($option_model_kartustock as $key) {
                        echo '<option value="'.$key->model.'">'.$key->model.'</option>';
                        # code...
                    }
                    ?>
            </select name="model">
            
            <br /><br />
        </div>

        <!-- <div id="form-nama_unit_rekap">
            <label>Nama Unit</label><br>
            <select name="nama_unit">
                <option value="">Pilih</option>
                <?php
                  //  foreach ($option_nama_unit_rekap as $key) //{
                     //   echo '<option value="'.$key->nama_unit.'">'.$key->nama_unit.'</option>';
                        # code...
                    //}
                    ?>
            </select name="nama_unit">
            
            <br /><br />
        </div> -->

            <div id="form-nama_unit_rekap">
            <label>Serial Number</label><br>
            <select name="serial_number">
                <option value="">Pilih</option>
                <?php
                   foreach ($option_serial_number_kartustock as $key) {
                       echo '<option value="'.$key->serial_number.'">'.$key->serial_number.'</option>';
                        # code...
                    }
                    ?>
            </select name="serial_number">
            
            <br /><br />
        </div> 
        
        <button type="submit">Tampilkan</button>
        <a href="<?php echo base_url('index.php/kartustock/kartustock'); ?>">Reset Filter</a>
    </form>
    <hr />
    
    <b><?php echo $ket; ?></b><br /><br />
   <!--  <a href="<?php //echo $url_cetak; ?>" target="_BLANK" class="btn btn-success">CETAK PDF</a><br /><br />
    </div> -->

                  
               
                <div class="box-body">              
    <table id="example" class="display nowrap" cellspacing="0" width="100%">
    <thead>
        
    <tr>
        <th width="10%">Model</th>
        
        <th>Serial Number</th>
        <th>Supplier</th>
        <th>Nomor PO</th>
        
        <th>Unit masuk</th>  
        <th>Tanggal Masuk</th>

        <th>Customer</th>
        <th>Nomor PO</th>
        <th>Tanggal PO</th>     
        <th>Unit Keluar</th>
        <th>Tanggal Kirim</th>
    </tr>
    </thead>
    <?php
     
       // $no = 1;
        foreach($kartustock_masuk as $data)
        {
            //$tgl = date('d-m-Y', strtotime($data->tanggal));
            
            echo "<tr>";            
            echo "<td>".$data->model."</td>";            
            echo "<td>".$data->serial_number."</td>";
            echo "<td>".$data->nama_supplier."</td>";
            echo "<td>".$data->nomor_po."</td>";
            echo "<td>".$data->jumlah_masuk."</td>";
            echo "<td>".$data->tanggal_masuk."</td>";
            
            
           

      
        foreach($kartustock_keluar as $keluar)
        {  
          if ($data->model == $keluar->model) 
          {
            echo "<td>".$keluar->nama_customer."</td>"; 
            echo "<td>".$keluar->nomor_po."</td>";
            echo "<td>".$keluar->tanggal_order."</td>";
            echo "<td>".$keluar->jumlah_keluar."</td>";
                     
            echo "<td>".$keluar->tanggal_keluar."</td>";
            
            }             
       
            
        }
        
        

             echo "</tr>";
            /*$no++;*/
    }
    
    ?>
   </table>

              </div><!-- /.box -->
            </div><!-- /.col -->
             </div><!-- /.box-header -->
          </div><!-- /.row -->
      
             
            

</section><!-- /.content -->


       



<?php 
$this->load->view('template/js');
?>
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