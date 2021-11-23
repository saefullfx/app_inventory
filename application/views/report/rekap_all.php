
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
        Stock Sparepart
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">laporan</a></li>
        <li class="active">stock sparepart</li>
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
        <select class="select2" name="filter" style="width:300px;" id="filter">
            <option value="">Pilih</option>
            <option value="1">Per Part Number</option>
            <option value="2">Per Jenis Barang</option>

        </select>
        <br /><br />

       

         <div id="form-kode_barang">
            <label>Part Number</label><br>
            <select class="select2" style="width:300px;" name="kode_barang3">
                <option value="">Pilih</option>
                <?php
                    foreach ($option_kode_barang_rekap as $key) {
                        echo '<option value="'.$key->kode_barang.'">'.$key->kode_barang.'</option>';
                        # code...
                    }
                    ?>
            </select name="kode_barang3">
            
            <br /><br />
        </div>

        <div id="form-jenis_barang">
            <label>Jenis Barang</label><br>
            <select class="select2" style="width:300px;" name="jenis_id">
                <option value="">Pilih</option>
                <?php
                    foreach ($option_jenis_barang_rekap_all as $key) {
                        echo '<option value="'.$key->jenis_id.'">'.$key->nama_jenis.'</option>';
                        # code...
                    }
                    ?>
            </select name="jenis_id">
            
            <br /><br />
        </div>
        
        
        <button class="btn btn-info" type="submit">Tampilkan</button>  ||
        <a class="btn btn-warning" href="<?php echo base_url('index.php/report/rekap_all'); ?>">Reset Filter</a>
        
    </form>
    <hr />
    
    <b><?php echo $ket; ?></b><br /><br />
    
    </div>

 <div class="box-body">
    <table id="example2" class="table table-bordered table-striped">
        <thead>
    <tr>
                    <th>No.</th>
                    <th>Part Number</th> 
                    <th>Part Number Persamaan</th>
                    <th>Nama Sparepart</th>
                    <!--<th>Barang Masuk</th>
                    <th>Barang Keluar</th>  -->                 
                    <th>Sparepart Di Gudang</th>
                   <!--  <th>Sparepart Telah dipesan</th> 
                    <th>Sparepart Ready</th>  -->
    </tr>
</thead>
    <?php
    if( ! empty($report)){
        $no = 1;
        foreach($report as $data){
            //$tgl = date('d-m-Y', strtotime($data->tanggal));

            // $a = $data->stock;
            // $b = $data->po_sementara;
            // $ab = $a-$b;
            ?>

    <tr>
                <td><?php echo $no++?>   </td>     
                <td><?php echo $data->kode_barang?></td>
                <td><?php echo $data->keterangan?></a></td>
                <td><?php echo $data->nama_barang ?></td>
                <!--<td align="center"><?php //echo $data->barang_masuk?></a></td>
                 <td align="center"><?php //echo $data->barang_keluar?></a></td>-->
                <td align="center"><?php echo $data->stock?></a></td>
               <!--  <td align="center"><a href="<?php echo site_url('report/detail_sparepart_dipesan/').$data->kode_barang?>"><?php echo $data->po_sementara?></a></td>
                <td align="center"><?php echo $ab?></a></td> -->
       
    </tr>
 <?php       }
    }

    ?>
    </table>

            </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
     
      </div><!-- /.content-wrapper --> 

       <div class="row">
                <div class="col-xs-6">
                    <div class="box">
                        <div class="box-header">
                            <h3>Sparepart On Going</h3>
                        </div>
                       
                        <div class="box-body">
                        <table id="example" class="cell-border display nowrap" width="100%">
                                <thead>
                                        <tr>
                                                        <th>No.</th>
                                                        <th>Part Number</th>
                                                        <!-- <th>Part Number Persamaan</th> -->
                                                        <th>Nama Sparepart</th>
                                                        <th align="center">Jumlah</th>
                                                        <th>Estimasi Sampai</th>
                                                                                               
                                                                                              
                                        </tr>
                                </thead>
                                <tbody>
                                        <?php
                                        if( ! empty($sparepart_ongoing))
                                        {
                                            $no = 1;
                                            foreach($sparepart_ongoing as $data)
                                            {
                                               ?> 
                                                <tr>   
                                                    <td><?php echo $no++?>   </td>     
                                                    <td><?php echo $data->kode_barang?></td>                            
                                                    <td><?php echo $data->nama_barang ?></td>  
                                                    <td align="center"><!-- <a href="<?php //echo site_url('report/detail_po_unit_keluar/').$data->id?>">  --><?php echo $data->jumlah ?><!-- </a> --></td>                                      
                                                    <td><?php echo $data->tanggal ?></td>                                        
                                                   
                                                </tr>                                    
                                        
                                        <?php       
                                        }
                                            }

                                        ?>
                                </tbody>
                        </table>
                    </div>
                    </div>
                </div>

                 <div class="col-xs-6">
                    <div class="box">
                        <div class="box-header">
                            <h3>PO Saprepart Dari Customer</h3>
                        </div>
                        <div class="box-body">
                        <table id="example1" class="cell-border display nowrap" width="100%">
                        <thead>
                                <tr>
                                                <th>No.</th>
                                                <th>Part Number</th>
                                               <!--  <th>Part Number Persamaan</th> -->
                                                <th>Nama Sparepart</th>
                                                <th align="center">Jumlah</th>                          
                                                
                                                                          
                                </tr>
                    </thead>
                                <tbody>
                                    <?php
                                    if( ! empty($sparepart_dipesan))
                                    {
                                        $no = 1;
                                        foreach($sparepart_dipesan as $data)
                                        {
                                          ?>
                                    <tr>   
                                       <td><?php echo $no++?>   </td>     
                                        <td><?php echo $data->kode_barang?></td>
                                        <!-- <td><?php echo $data->keterangan ?></td>      -->                                   
                                        <td><?php echo $data->nama_barang ?></td>                                        
                                        <td align="center"><!-- <a href="<?php echo site_url('report/detail_po_unit_keluar/').$data->id ?>"> --> <?php echo $data->jumlah ?><!-- </a> --></td>
                                        
                                        
                                    </tr>
                                   
                                    
                                 <?php      
                                        }
                                    }
                                    ?>
                                    </tbody>
                                    </table>
                    </div>
                    </div>
                    
                    
                </div>
              
          </div>          
            

</section><!-- /.content -->
    
<?php 
$this->load->view('template/js');
?>
    <script src="<?php echo base_url('assets/js/jquery-ui.js'); ?>"></script> <!-- Load file plugin js jquery-ui -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
    $(document).ready(function(){ // Ketika halaman selesai di load
        

        $('#form-kode_barang, #form-jenis_barang').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya

        $('#filter').change(function(){ // Ketika user memilih filter
            if($(this).val() == '1'){ // Jika filter nya 1 (per tanggal)
                $('#form-jenis_barang').hide(); // Sembunyikan form bulan dan tahun
                $('#form-kode_barang').show(); // Tampilkan form tanggal
            }else if($(this).val() == '2'){
                $('#form-kode_barang').hide(); // Sembunyikan form bulan dan tahun
                $('#form-jenis_barang').show(); // Tampilkan form tanggal
            }

            $(' #form-kode_barang select, #form-jenis_barang').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
        })
    })
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

<script type="text/javascript">
    $(document).ready(function() {
    $('#example1').DataTable( {
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

<script type="text/javascript">
    $(document).ready(function() {
    $('#example2').DataTable( {
        
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

    <script type="text/javascript">
        $(document).ready(function () {
                $(".select2").select2({
                    placeholder: "Please Select"
                });
            });
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
<!--tambahkan custom js disini-->
<?php

$this->load->view('template/foot');

?>