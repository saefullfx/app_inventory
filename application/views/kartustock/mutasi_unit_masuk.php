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
       Rekap Unit Masuk
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
            <option value="1">Per Type Unit</option>
            <option value="2">Per Bulan</option>
            <option value="3">Per Tahun</option>

        </select>
        <br /><br />

        <div id="form-nama_unit">
            <label>Type Unit</label><br>
            <select name="nama_unit">
                <option value="">Pilih</option>
                <?php
                    foreach ($option_nama_rekap_unit_masuk as $key) {
                        echo '<option value="'.$key->nama_unit.'">'.$key->nama_unit.'</option>';
                        # code...
                    }
                    ?>
            </select>
            <br /><br />
        </div>

        <div id="form-bulan">
            <label>Bulan</label><br>
            <select name="bulan">
                <option value="">Pilih</option>
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
            <br /><br />
        </div>

        <div id="form-tahun">
            <label>Tahun</label><br>
            <select name="tahun">
                <option value="">Pilih</option>
                <?php
                foreach($option_tahun_rekap_unit_masuk as $data){ // Ambil data tahun dari model yang dikirim dari controller
                    echo '<option value="'.$data->tahun.'">'.$data->tahun.'</option>';
                }
                ?>
            </select>
            <br /><br />
        </div>
        <button type="submit">Tampilkan</button>
        <a href="<?php echo base_url('index.php/kartustock/mutasi_unit_masuk'); ?>">Reset Filter</a>
    </form>
    <hr />
    
    <b><?php echo $ket; ?></b><br /><br />
     <a href="<?php echo $url_cetak; ?>" target="_BLANK" class="btn btn-success">CETAK PDF</a><br /><br />
     </div>             
               
    <div class="box-body">              
   <table id="" class="table table-bordered table-hover">     
    <thead>
        <tr>
        <th>No.</th>
        <th>Type Unit</th>
        <th>Bulan</th>
        <th>Tahun</th>
        <th>Unit Masuk</th>
        </tr>
    </thead>
        
   
        
    
   
   

    <?php 
    $no = 1;
    $total = 0;
            foreach ($report as $data) {
               
    ?>    <tbody>
            
        <tr>
            <td><?php echo $no;?></td>
            <td><?php echo $data->nama_unit;  ?></td>
            <td><?php echo $data->bulan;  ?></td>  
            <td><?php echo $data->tahun;  ?></td>
            <td ><?php echo $data->unit_masuk;  ?>
        </tr>



    <?php 
    $no++;
    $total+=$data->unit_masuk;
            }
     ?>  
          <tr font-style: bold;>
             <td colspan="4" align="center" ><b>Total Unit Masuk</b></td>

            <td font-style: bold;><b><?php echo $total; ?></b></td>
            
        </tr>
    </tbody>

         
    
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
        

        $('#form-bulan, #form-tahun, #form-nama_unit').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya

        $('#filter').change(function(){ // Ketika user memilih filter
            if($(this).val() == '1'){ // Jika filter nya 1 (per tanggal)
                $('#form-model, #form-tahun').hide(); // Sembunyikan form bulan dan tahun
                $('#form-nama_unit').show(); // Tampilkan form tanggal
            }else if($(this).val() == '2'){
                $('#form-nama_unit').hide(); // Sembunyikan form bulan dan tahun
                $('#form-bulan, #form-tahun').show(); // Tampilkan form tanggal
             
            }else if($(this).val() == '3'){
               $('#form-bulan, #form-nama_unit').hide(); // Sembunyikan form bulan dan tahun
               $('#form-tahun').show(); // Tampilkan form tanggal
            }else{
               $('#form-bulan, #form-tahun, #form-nama_unit').hide();
            }

            $(' #form-bulan select, #form-tahun select, #form-nama_unit select').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
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
                messageTop: 'Mutasi Unit Masuk',
            },

            {
                extend: 'pdfHtml5',
                messageTop: 'Mutasi Unit Masuk',
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