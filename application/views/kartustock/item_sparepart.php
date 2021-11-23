<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">



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
                    <th>Nama Spare Part</th>                                   
                    <th>Jenis Sparepart</th>
                    <th>Keterangan</th>  
                    <th>Option</th>       
            
                </tr>
            </thead>
            <tbody>
            <?php
    if( ! empty($gabung)){
        $no = 1;
        foreach($gabung as $data){
            //$tgl = date('d-m-Y', strtotime($data->tanggal));
           
            echo "<tr>";
            echo "<td>".$no."</td>";
            echo "<td>".$data->kode_barang."</td>";
            echo "<td>".$data->nama_barang."</td>";        
            echo "<td>".$data->nama_jenis."</td>";
            echo "<td>".$data->keterangan."</td>"; 
            echo "<td>
            <div class='btn-group'>
                      <button type='button' class='btn btn-default'>Action</button>
                      <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
                        <span class='caret'></span>
                        <span class='sr-only'>Toggle Dropdown</span>
                      </button>
                      <ul class='dropdown-menu' role='menu'>
                        <li><a href='javascript:;'  class='item_edit' data='+$data->id+'><i class='fa fa-edit'></i> Edit</a></li>
                        <li><a href='#'><i class='fa fa-trash'></i> Delete</a></li>
                        
                      </ul>
                    </div>
                    </td>";         
            echo "</tr>";
            
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

<!-- MODAL EDIT -->
        <div class="modal fade" id="ModalEdit" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Edit</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">                     
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Kode Barang</label>
                        <div class="col-xs-9">
                            <input name="kode_barangedit" id="kode_barang2" class="form-control" type="text" placeholder="" style="width:335px;" required>
                        </div>
                    </div>  

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Barang</label>
                        <div class="col-xs-9">
                            <input name="nama_barangedit" id="nama_barang2" class="form-control" type="text" placeholder="" style="width:335px;" required>
                        </div>
                    </div>  
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jenis</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_jenis_attribute = 'class="form-control select2" id="jenis_id2" style="width:335px;"';
                                echo form_dropdown('jenis_idedit', $dd_jenis, $jenis_selected, $dd_jenis_attribute);
                            ?>
                        </div>
                    </div> 

                     <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <input name="keteranganedit" id="keterangan2" class="form-control" type="text" placeholder="" style="width:335px;" required>
                        </div>
                    </div>  
                    <input type="hidden" name="idedit" id="id2">            
                     
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" id="btn_update">Update</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <!--END MODAL EDIT-->


        <!-- MODAL EDIT kode barang -->
        <div class="modal fade" id="ModalEdit2" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Edit Kode barang</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">

                 <div class="form-group">
                        <label class="control-label col-xs-3" >Kode Barang</label>
                        <div class="col-xs-9">
                            <input name="kode_barang" id="kode_barang" class="form-control" type="text" placeholder="" style="width:335px;" required>
                        </div>
                    </div>                       
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Kode Barang Baru</label>
                        <div class="col-xs-9">
                            <input name="kode_barangbaru" id="kode_barangbaru2" class="form-control" type="text" placeholder="" style="width:335px;" required>
                        </div>
                    </div>  

                   
                    <input type="hidden" name="ideditlama" id="idlama2">            
                     
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" id="btn_update2">Update</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <!--END MODAL EDIT kode barang-->

        <!--MODAL HAPUS-->
        <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                        <h4 class="modal-title" id="myModalLabel">Hapus Barang</h4>
                    </div>
                    <form class="form-horizontal">
                    <div class="modal-body">
                                           
                            <input type="hidden" name="id" id="textid" value="">
                            <div class="alert alert-danger"><p>Apakah Anda yakin mau menghapus item barang ini?</p></div>
                                         
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button class="btn_delete btn btn-danger" id="btn_delete">Hapus</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!--END MODAL HAPUS-->




<?php 
$this->load->view('template/js');
?>

    <script>
    $(document).ready(function(){ // Ketika halaman selesai di load
        

        $('#form-jenis').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya

        $('#filter').change(function(){ // Ketika user memilih filter
            if($(this).val() == '1'){ // Jika filter nya 1 (per tanggal)
                 // Sembunyikan form bulan dan tahun
                $('#form-jenis').show(); // Tampilkan form tanggal
            
            }else{
               $('#form-jenis').hide();
            }

            $(' #form-jenis select').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
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