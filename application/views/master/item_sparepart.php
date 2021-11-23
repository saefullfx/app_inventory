<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />


<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Item Sparepart
        <small>data list item sparepart</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Item Barang</a></li>
        <li class="active">list</li>
    </ol>
</section>
            <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Hover Data Table</h3>
                  <div class="pull-right"><a href="<?php echo base_url().'index.php/page/add_item_sparepart'?>" class="btn btn-default"><span class="fa fa-plus"></span> Item Sparepart</a></div>
                                <hr>
    <form method="get" action="">
        <label>Filter Berdasarkan</label><br>
        <select name="filter" id="filter">
            <option value="">Pilih</option>
            <option value="1">Per Jenis Spare Part</option>
        </select>
        <br /><br />

        <div id="form-jenis">
            <label>Jenis Spare Part</label><br>
            <select name="jenis">
                <option value="">Pilih</option>
                <?php
                    foreach ($option_jenis_sparepart as $key) {
                        echo '<option value="'.$key->id.'">'.$key->nama_jenis.'</option>';
                        # code...
                    }
                    ?>
            </select>
            <br /><br />
        </div>

        

       
        <button type="submit">Tampilkan</button>
        <a href="<?php echo base_url('index.php/page/item_sparepart'); ?>">Reset Filter</a>
    </form>
    <hr />
                </div><!-- /.box-header -->
                <div class="box-body">
      
                  
               <table id="example" class="cell-border display nowrap" width="100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Part Number</th>
                    <th>Part Number Persamaan</th> 
                    <th>Nama Spare Part</th>                                   
                    <th>Jenis Sparepart</th>                    
                    <th>Option</th>       
            
                </tr>
            </thead>
            <tbody>
            <?php
    if( ! empty($gabung)){
        $no = 1;
        foreach($gabung as $data){ ?>
            <!-- //$tgl = date('d-m-Y', strtotime($data->tanggal)); -->
           
            <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $data->kode_barang ?></td>
            <td><?php echo $data->keterangan?></td>
            <td><?php echo $data->nama_barang?></td>        
            <td><?php echo $data->nama_jenis?></td>
             
            <td>
                 <?php echo '<a href="'.base_url().'index.php/page/edit_item_sparepart/'.$data->id.'" class="btn btn-default"><span class="fa fa-edit"></a>'?>

                 <?php echo '<a href="'.base_url().'index.php/page/delete_barang/'.$data->id.'" class="btn btn-default" onclick="return confirm(\'Anda yakin akan menghapus Part Number '.$data->kode_barang.'?\')"><span class="fa fa-trash"></span></a>'?>
                 
             </td>
              
            </tr>
         <?php   
            $no++;
        }
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

<script src="<?php echo base_url('assets/js/jquery-ui.js'); ?>"></script> <!-- Load file plugin js jquery-ui -->
    


    <script>
    $(document).ready(function()
    { 
        $('#form-jenis').hide();

        $('#filter').change(function()
        { 
            if($(this).val() == '1')
            { 
                $('#form-jenis').show(); 
            }else{
               $('#form-jenis').hide();
            }
            $(' #form-jenis select').val('');
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
        "pagingType": "full_numbers",
        "paging": true,
        "lengthMenu": [10, 25, 50, 75, 100],
        dom: 'Bfrtip',
        buttons: [
            
               
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
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
    


<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>