
<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<!-- <link src="<?php //echo base_url().'kolam/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.css'?>" rel="stylesheet" type="text/css"> -->

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Rekap Unit Masuk
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Rekap Unit Masuk</a></li>
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
            <option value="1">Per Bulan</option>
            <option value="2">Per Tahun</option>
            <option value="3">Per Model</option>
            <option value="4">Per Nama Unit</option>
        </select>
        <br /><br />
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

        <div id="form-model">
            <label>Model Unit</label><br>
            <select name="model">
                <option value="">Pilih</option>
                <?php
                    foreach ($option_model_rekap_unit_masuk as $key) {
                        echo '<option value="'.$key->model.'">'.$key->model.'</option>';
                        # code...
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
                    foreach ($option_nama_rekap_unit_masuk as $key) {
                        echo '<option value="'.$key->nama_unit.'">'.$key->nama_unit.'</option>';
                        # code...
                    }
                    ?>
            </select name="nama_unit">
            
            <br /><br />
        </div>

        <button type="submit">Tampilkan</button>
        <a href="<?php echo base_url('index.php/barang/barang/rekap_masuk'); ?>">Reset Filter</a>
    </form>
    <hr />
    
    <b><?php echo $ket; ?></b><br /><br />
    <a href="<?php echo $url_cetak; ?>" target="_BLANK" class="btn btn-success">CETAK PDF</a><br /><br />
    </div>

 <div class="box-body">
    <table id="example2" class="table table-bordered table-striped">
        <thead>
    <tr>
        <th>No.</th>
                    <th>Model</th>                   
                    <th>Nama Unit</th>
                    <th>Serial Number</th>
                    <th>Pressure</th>
                    <th>Unit Masuk</th>
                    <th>Bulan</th>                   
                    <th>Tahun</th>
            
    </tr>
</thead>
    <?php
    if( ! empty($report)){
        $no = 1;
        foreach($report as $data){
            //$tgl = date('d-m-Y', strtotime($data->tanggal));
            
            echo "<tr>";
            echo "<td>".$no."</td>";
            echo "<td>".$data->model."</td>";
            echo "<td>".$data->nama_unit."</td>";
             echo "<td>".$data->serial_number."</td>";
            echo "<td>".$data->pressure."</td>";
            //echo "<td>".$data->nama_supplier."</td>";
            echo "<td>".$data->unit_masuk."</td>";
            echo "<td>".$data->bulan."</td>";
            echo "<td>".$data->tahun."</td>";
           
            echo "</tr>";
            $no++;
        }
    }
    ?>
    </table>

            </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
      </div>
      </div><!-- /.content-wrapper -->           
            

</section><!-- /.content -->
    
<?php 
$this->load->view('template/js');
?>
    <script src="<?php echo base_url('assets/js/jquery-ui.js'); ?>"></script> <!-- Load file plugin js jquery-ui -->
    <script>
    $(document).ready(function(){ // Ketika halaman selesai di load
        

        $('#form-bulan, #form-tahun, #form-model, #form-nama_unit').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya

        $('#filter').change(function(){ // Ketika user memilih filter
            if($(this).val() == '1'){ // Jika filter nya 1 (per tanggal)
                $('#form-model, #form-nama_unit').hide(); // Sembunyikan form bulan dan tahun
                $('#form-bulan, #form-tahun').show(); // Tampilkan form tanggal
            }else if($(this).val() == '2'){
                $('#form-bulan, #form-model, #form-nama_unit').hide(); // Sembunyikan form bulan dan tahun
                $('#form-tahun').show(); // Tampilkan form tanggal
            }else if($(this).val() == '3'){
                $('#form-bulan, #form-tahun, #form-nama_unit').hide();// Sembunyikan form bulan dan tahun
                $('#form-model').show(); // Tampilkan form tanggal
            }else{
               $('#form-bulan, #form-tahun, #form-model').hide(); // Sembunyikan form bulan dan tahun
                $('#form-nama_unit').show(); // Tampilkan form tanggal
            }

            $(' #form-bulan select, #form-tahun select, #form-model select, #form-nama_unit select').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
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

<script type="text/javascript" src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datatables/jquery.dataTables.js'?>">
    
</script>
<script type="text/javascript" src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.js'?>">
    
</script>
<!--tambahkan custom js disini-->
<?php

$this->load->view('template/foot');

?>