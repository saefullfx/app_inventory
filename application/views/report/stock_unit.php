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
        Stock Unit
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Unit</a></li>
        <li class="active">Stock Unit</li>
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

                        <select name="filter" class="select2" style="width:300px;" id="filter">
                            <option value="">Pilih</option>
                            <option value="2">Per Type Unit</option>
                            <option value="1">Per Model</option>
                            <!-- <option value="2">Per Nama Unit</option> -->

                        </select>
                        <br /><br />

                       

                         <div id="form-model_unit_rekap">
                            <label>Model</label><br>
                            <select name="model" class="select2" style="width:300px;">
                                <option value="">Pilih</option>
                                <?php
                                    foreach ($option_model_rekap_unit as $key) {
                                        echo '<option value="'.$key->model.'">'.$key->model.'</option>';
                                        # code...
                                    }
                                    ?>
                            </select name="model">
                            
                            <br /><br />
                        </div>

                         <div id="form-nama_unit_rekap">
                            <label>Nama Unit</label><br>
                            <select name="nama_unit" class="select2" style="width:300px;">
                                <option value="">Pilih</option>
                                <?php
                                    foreach ($option_nama_unit_rekap as $key) {
                                        echo '<option value="'.$key->nama_unit.'">'.$key->nama_unit.'</option>';
                                        # code...
                                    }
                                    ?>
                            </select name="nama_unit">
                            
                            <br /><br />
                        </div> 

                          
                        
                        <button class="btn btn-info" type="submit">Tampilkan</button> ||
                        <a class="btn btn-warning" href="<?php echo base_url('index.php/report/stock_unit'); ?>">Reset Filter</a>
                    </form>
                    <hr />
                    
                    <b><?php echo $ket; ?></b><br /><br />
                    <!-- <a href="<?php echo $url_cetak; ?>" target="_BLANK" class="btn btn-success">CETAK PDF</a><br /><br /> -->
                    </div>

                 <div class="box-body">
                    <table id="example" class="cell-border display nowrap" width="100%">
                        <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Type Unit</th>
                                    <th>Model Unit</th>
                                    <th align="center">Stock</th>
                                                                          
                                </tr>
                    </thead>
                                <tbody>
                                    <?php
                                    if( ! empty($report)){
                                        $no = 1;
                                        foreach($report as $data){
                                          // if ($data->baru_masuk > 0) {  ?> 
                                    <tr>   
                                        <td><?php echo $no++?>   </td>     
                                        <td><?php echo $data->nama_unit?></td>
                                        <td><?php echo $data->model ?></td>
                                        <td><a href="<?php echo site_url('report/detail_unit_stock/').$data->model_id?>"><?php echo $data->total?></a></td> 
                                        <!-- <td><a href="<?php echo site_url('report/detail_po_unit_keluar/').$data->model_id?>"><?php echo $data->baru_masuk ?></a></td> -->
                                         <!-- <td align="center"><a href="<?php echo site_url('report/detail_po_unit_masuk/').$data->model_id?>"><?php echo $data->po_masuk?></a></td> -->
                                        <!-- <td align="center"><a href="<?php echo site_url('report/detail_unit_masuk/').$data->model_id?>"><?php echo $data->unit_masuk?></a></td>
                                        <td align="center"><a href="<?php echo site_url('report/detail_unit_keluar/').$data->model_id?>"><?php echo $data->unit_keluar?></a></td> -->
                                        
                                       <!--  <td align="center"><a href="<?php echo site_url('report/detail_unit_dipesan/').$data->model_id?>"><?php echo $data->unit_dipesan?></a></td> -->
                                        <!-- <td align="center"><a href="<?php echo site_url('report/detail_unit_ready/').$data->model_id?>"><?php echo $open_stock?></a></td>   -->
                                    </tr>
                                    <?php

                                         //  }
                                           ?> 
                                    
                                 <?php       }
                                    }

                                    ?>
                                    </tbody>
                                    </table>


            </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
      </div>     

        <div class="row">
                <div class="col-xs-6">
                    <div class="box">
                        <div class="box-header">
                            <h3>Unit On Going</h3>
                        </div>
                       
                        <div class="box-body">
                        <table id="example1" class="cell-border display nowrap" width="100%">
                        <thead>
                                <tr>
                                                <th>No.</th>
                                                <th>Type Unit</th>
                                                <th>Model Unit</th>
                                                <th align="center">Jumlah</th>                                         
                                </tr>
                        </thead>
                                <tbody>
                                    <?php
                                    if( ! empty($unit_ongoing)){
                                        $no = 1;
                                        foreach($unit_ongoing as $data){
                                          if ($data->baru_masuk > 0) {  ?> 
                                    <tr>   
                                        <td><?php echo $no++?>   </td>     
                                        <td><?php echo $data->nama_unit?></td>
                                        <td><?php echo $data->model ?></td>                                        
                                        <td align="center"><a href="<?php echo site_url('report/detail_po_unit_keluar/').$data->id?>"> <?php echo $data->baru_masuk ?></a></td>
                                    </tr>
                                    <?php

                                           }
                                           ?> 
                                    
                                 <?php       }
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
                            <h3>PO Unit Dari Customer</h3>
                        </div>
                        <div class="box-body">
                        <table id="example2" class="cell-border display nowrap" width="100%">
                        <thead>
                                <tr>
                                                <th>No.</th>
                                                <th>Type Unit</th>
                                                <th>Model Unit</th>
                                                <th align="center">Jumlah</th>                        
                                                
                                                                          
                                </tr>
                    </thead>
                                <tbody>
                                    <?php
                                    if( ! empty($unit_belum_dikirim)){
                                        $no = 1;
                                        foreach($unit_belum_dikirim as $data){
                                           if ($data->baru_dikirim > 0) {  ?> 
                                    <tr>   
                                        <td><?php echo $no++?>   </td>     
                                        <td><?php echo $data->nama_unit?></td>
                                        <td><?php echo $data->model ?></td>
                                        <td align="center"><a href="<?php echo site_url('report/detail_po_unit_masuk/').$data->id?>"><?php echo $data->baru_dikirim ?></a></td> 
                                        
                                        
                                    </tr>
                                    <?php

                                           }
                                           ?> 
                                    
                                 <?php       }
                                    }

                                    ?>
                                    </tbody>
                                    </table>
                    </div>
                    </div>
                    
                    
                </div>
              
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
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

   <!--  <script type="text/javascript">
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
    </script> -->

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
        $(document).ready(function () {
                $(".select2").select2({
                    placeholder: "Please Select"
                });
            });
    </script>

    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<!--tambahkan custom js disini-->
<?php

$this->load->view('template/foot');

?>