
<?php 
$this->load->view('template/head');
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  
  <link src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datepicker/datepicker3.css'?>" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">


<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>



<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        History Unit Keluar
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">laporan</a></li>
        <li class="active">Unit keluar</li>
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
            <option value="1">Per Tanggal</option>
            <option value="2">Per Bulan</option>
            <option value="3">Per Tahun</option>
             <option value="4">Per Model</option>
            <option value="5">Per Nama Unit</option>

        </select>
        <br /><br />

        <div id="form-tanggal">
            <label>Tanggal</label><br>
            <input type="text" name="tanggal" class="input-tanggal" />
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
                foreach($option_tahun as $data){ // Ambil data tahun dari model yang dikirim dari controller
                    echo '<option value="'.$data->tahun.'">'.$data->tahun.'</option>';
                }
                ?>
            </select>
            <br /><br />
        </div>

        <div id="form-model_unit">
            <label>Model Unit</label><br>
            <select name="model">
                <option value="">Pilih</option>
                <?php
                foreach($option_model as $data){ // Ambil data tahun dari model yang dikirim dari controller
                    echo '<option value="'.$data->model.'">'.$data->model.'</option>';
                }
                ?>
            </select>
            <br /><br />
        </div>

        <div id="form-nama_unit">
            <label>Nama Unit</label><br>
            <select name="nama_unit">
                <option value="">Pilih</option>
                <?php
                foreach($option_nama_unit as $data){ // Ambil data tahun dari model yang dikirim dari controller
                    echo '<option value="'.$data->nama_unit.'">'.$data->nama_unit.'</option>';
                }
                ?>
            </select>
            <br /><br />
        </div>

        <button type="submit">Tampilkan</button>
        <a href="<?php echo base_url('index.php/report/unit_keluar'); ?>">Reset Filter</a>
    </form>
    <hr />
    
    <b><?php echo $ket; ?></b><br /><br />
   <!--  <a href="<?php echo $url_cetak; ?>" target="_BLANK" class="btn btn-success">CETAK PDF</a><br /><br /> -->
    </div>

 <div class="box-body">
    <table id="example" class="cell-border display nowrap" width="100%">
        <thead>
    <tr>
        <th>No.</th>
        <th>Type Unit</th>
        <th>Model</th>
        <th>Serial Number</th>        
        <th>Customer</th>
        <th>Tanggal Order</th>
        <th>Jumlah</th>
        <th>Tanggal Keluar</th>
        <th>Nomor PO</th>
        <th>Nomor Surat jalan</th>
       
        <th>Keterangan</th>
    </tr>
</thead>
    <?php
    if( ! empty($report)){
        $no = 1;
        foreach($report as $data){
            $tgl = date('d-m-Y', strtotime($data->tanggal));
            
            echo "<tr>";
            echo "<td>".$no."</td>";
            echo "<td>".$data->nama_unit."</td>";
            echo "<td>".$data->model."</td>";
            echo "<td>".$data->serial_number."</td>";
            echo "<td>".$data->nama_customer."</td>";
            echo "<td>".$data->tanggal_po_customer."</td>";
            
            echo "<td>".$data->jumlah."</td>";
            echo "<td>".$tgl."</td>";
            echo "<td>".$data->po_customer."</td>";
            echo "<td>".$data->nomor_surat_jalan."</td>";
            echo "<td>".$data->keterangan."</td>";
            echo "</tr>";
            $no++;
        }
    }
    ?>
    </table>

            </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
      
      </div><!-- /.content-wrapper -->           
            

</section><!-- /.content -->
    
<?php 
$this->load->view('template/js');
?>
    <script src="<?php echo base_url('assets/js/jquery-ui.js'); ?>"></script> <!-- Load file plugin js jquery-ui -->
    <script>
    $(document).ready(function(){ // Ketika halaman selesai di load
        $('.input-tanggal').datepicker({
            dateFormat: 'yy-mm-dd' // Set format tanggalnya jadi yyyy-mm-dd
        });

        $('#form-tanggal, #form-bulan, #form-tahun, #form-model_unit, #form-nama_unit').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya

        $('#filter').change(function(){ // Ketika user memilih filter
            if($(this).val() == '1'){ // Jika filter nya 1 (per tanggal)
                $('#form-bulan, #form-tahun, #form-model_unit, #form-nama_unit').hide(); // Sembunyikan form bulan dan tahun
                $('#form-tanggal').show(); // Tampilkan form tanggal
            }else if($(this).val() == '2'){ // Jika filter nya 2 (per bulan)
                $('#form-tanggal, #form-model_unit, #form-nama_unit').hide(); // Sembunyikan form tanggal
                $('#form-bulan, #form-tahun').show(); // Tampilkan form bulan dan tahun
            }else if($(this).val() == '3'){ // Jika filternya 3 (per tahun)
                $('#form-tanggal, #form-bulan, #form-model_unit, #form-nama_unit').hide(); // Sembunyikan form tanggal dan bulan
                $('#form-tahun').show(); // Tampilkan form tahun
            }else if($(this).val() == '4'){ // Jika filternya 3 (per tahun)
                $('#form-tanggal, #form-bulan, #form-nama_unit, #form-tahun').hide(); // Sembunyikan form tanggal dan bulan
                $('#form-model_unit').show();
            }else{ // Jika filternya 3 (per tahun)
                $('#form-tanggal, #form-bulan, #form-model_unit, #form-tahun').hide(); // Sembunyikan form tanggal dan bulan
                $('#form-nama_unit').show();
            }

            $('#form-tanggal input, #form-bulan select, #form-tahun select, #form-nama_unit select, #form-model_unit select').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
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
                messageTop: 'Laporan Unit Keluar',
            },

            {
                extend: 'pdfHtml5',
                messageTop: 'Laporan Unit Keluar',
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

<!-- <script type="text/javascript" src="<?php //echo base_url().'kolam/AdminLTE-2.0.5/plugins/datatables/jquery.dataTables.js'?>">    
</script>
<script type="text/javascript" src="<?php //echo base_url().'kolam/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.js'?>"></script> -->

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