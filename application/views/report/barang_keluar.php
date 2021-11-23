
<?php 
$this->load->view('template/head');
?>

     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 <link src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datepicker/datepicker3.css'?>" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
 <link src="<?php echo base_url().'plugins/datatables/dataTables.bootstrap.css'?>" rel="stylesheet" type="text/css" />


<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Laporan Sparepart Keluar
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">laporan</a></li>
        <li class="active">Sparepart keluar</li>
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
            <option value="4">Per Part Number</option>
            <option value="5">Per Tanggal dan PartNumber</option>
            
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
        
        <div id="form-bulan2">
            <label>Bulan</label><br>
            <select name="bulan2">
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
        
        <div id="form-tahun2">
            <label>Tahun</label><br>
            <select name="tahun2">
                <option value="">Pilih</option>
                <?php
                foreach($option_tahun as $data){ // Ambil data tahun dari model yang dikirim dari controller
                    echo '<option value="'.$data->tahun.'">'.$data->tahun.'</option>';
                }
                ?>
            </select>
            <br /><br />
        </div>

        <div id="form-kode_barang">
            <label>Part Number</label><br>
            <select name="kode_barang">
                <option value="">Pilih</option>
                <?php
                    foreach ($option_kode_barang as $key) {
                        echo '<option value="'.$key->kode_barang.'">'.$key->kode_barang.'</option>';
                        # code...
                    }
                    ?>
            </select name="kode_barang">
            
            <br /><br />
        </div>

        <div id="form-tanggal2">
            <label>Tanggal</label><br>
            <input type="text" name="tanggal2" class="input-tanggal2" />
            <br /><br />
        </div>
        
         <div id="form-tanggal3">
            <label>Tanggal</label><br>
            <input type="text" name="tanggal3" class="input-tanggal3" />
            <br /><br />
        </div>

        <div id="form-kode_barang2">
            <label>Part Number</label><br>
            <select name="kode_barang2">
                <option value="">Pilih</option>
                <?php
                    foreach ($option_kode_barang as $key) {
                        echo '<option value="'.$key->kode_barang.'">'.$key->kode_barang.'</option>';
                        # code...
                    }
                    ?>
            </select name="kode_barang2">
            
            <br /><br />
        </div>
        
         <div id="form-kode_barang3">
            <label>Part Number</label><br>
            <select name="kode_barang3">
                <option value="">Pilih</option>
                <?php
                    foreach ($option_kode_barang as $key) {
                        echo '<option value="'.$key->kode_barang.'">'.$key->kode_barang.'</option>';
                        # code...
                    }
                    ?>
            </select name="kode_barang3">
            
            <br /><br />
        </div>

        <button type="submit">Tampilkan</button>
        <a href="<?php echo base_url('index.php/report/barang_keluar'); ?>">Reset Filter</a>
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
        <th>Part Number</th>
        <th>Nama Barang</th>
        <th>Customer</th>
        <th>Tanggal</th>
        <th>Jumlah</th>
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
            echo "<td>".$data->kode_barang."</td>";
            echo "<td>".$data->nama_barang."</td>";
            echo "<td>".$data->nama_customer."</td>";
            echo "<td>".$tgl."</td>";
            echo "<td>".$data->jumlah."</td>";
            echo "<td>".$data->nomor_po."</td>";
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

        $('.input-tanggal2').datepicker({
            dateFormat: 'yy-mm-dd' // Set format tanggalnya jadi yyyy-mm-dd
        });
        
         $('.input-tanggal3').datepicker({
            dateFormat: 'yy-mm-dd' // Set format tanggalnya jadi yyyy-mm-dd
        });

        $('#form-tanggal, #form-tanggal2, #form-tanggal3, #form-bulan, #form-bulan2, #form-tahun, #form-tahun2, #form-kode_barang, #form-kode_barang2, #form-kode_barang3').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya

        $('#filter').change(function(){ // Ketika user memilih filter
            if($(this).val() == '1'){ // Jika filter nya 1 (per tanggal)
                $('#form-tanggal2, #form-tanggal3, #form-bulan, #form-bulan2, #form-tahun, #form-tahun2, #form-kode_barang, #form-kode_barang2, #form-kode_barang3').hide(); // Sembunyikan form bulan dan tahun
                $('#form-tanggal').show(); // Tampilkan form tanggal
            }else if($(this).val() == '2'){ // Jika filter nya 2 (per bulan)
                $('#form-tanggal, #form-tanggal2, #form-tanggal3, #form-bulan2, #form-tahun2, #form-kode_barang, #form-kode_barang2, #form-kode_barang3').hide(); // Sembunyikan
                $('#form-bulan, #form-tahun').show(); // Tampilkan form bulan dan tahun
            }else if($(this).val() == '3'){ // Jika filternya 3 (per tahun)
                $('#form-tanggal, #form-tanggal2, #form-tanggal3, #form-bulan, #form-bulan2, #form-tahun2, #form-kode_barang, #form-kode_barang2, #form-kode_barang3').hide(); // Sembunyikan form tanggal dan bulan
                $('#form-tahun').show(); // Tampilkan form tahun
            }else if($(this).val() == '4'){
                $('#form-tanggal, #form-tanggal2, #form-tanggal3, #form-bulan, #form-bulan2, #form-tahun, #form-tahun2, #form-kode_barang2, #form-kode_barang3').hide(); // Sembunyikan form tanggal dan bulan
                $('#form-kode_barang').show(); // Tampilkan form tahun   
            }else if($(this).val() == '5'){
                $('#form-tanggal, #form-tanggal3, #form-bulan, #form-bulan2, #form-tahun, #form-tahun2, #form-kode_barang, #form-kode_barang3').hide(); // Sembunyikan
                $('#form-kode_barang2, #form-tanggal2').show(); // Tampilkan form part number dan tanggal   
            }else{
                $('#form-tanggal, #form-tanggal2, #form-tanggal3, #form-bulan, #form-tahun, #form-kode_barang, #form-kode_barang2').hide(); // Sembunyikan form tanggal dan bulan
                $('#form-kode_barang3, #form-bulan2, #form-tahun2').show(); // Tampilkan form tahun 
            }
            $('#form-tanggal input, #form-tanggal2 input, #form-tanggal3 input, #form-bulan select, #form-bulan2 select, #form-tahun select, #form-tahun2 select, #form-kode_barang select, #form-kode_barang2 select, #form-kode_barang3 select').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
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
<script type="text/javascript" src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.js'?>"></script>


<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>