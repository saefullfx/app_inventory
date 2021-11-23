
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
        Data Detail Unit Stock
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">detail</a></li>
        <li class="active">unit</li>
    </ol>
</section>

     <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
<div class="box">
     <div class="box-header">
        
                  <h3 class="box-title"></h3>
           
                  <div class="pull-right"><a href="<?php echo base_url().'index.php/report/rekap_unit_all'?>" class="btn  btn-info">Kembali </a></div>
                </div><!-- /.box-header -->

 <div class="box-body">
    <table id="example" class="cell-border display nowrap" width="100%">
            <thead>
            <tr>
                        <th>No.</th>
                        <th>Type Unit</th>
                        <th>Model Unit</th>
                        <th>Serial Number</th>
                        <th>Pressure</th>
                        <th>Voltase</th>
                        <!-- <th>Aksi</th>     -->                                  
            </tr>
            </thead>
    <tbody>
    <?php
    if( ! empty($detail_unit_stock)){
        $no = 1;

        foreach($detail_unit_stock as $data){
            if($data->total > 0){
                ?> 
            <tr>                  
                <td><?php echo $no++?>     </td>    
                <td><?php echo $data->nama_unit ?></td>
                <td><?php echo $data->model ?></td>
                <td><?php echo $data->serial_number ?></td>
                <td><?php echo $data->pressure ?></td>
                <td><?php echo $data->voltase ?></td>
                
                 <!-- <?php

                  if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2')
                    {
                    if($data->status_pemesanan == 'Stock'){ ?>
                        <td><a class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal_edit<?php echo $data->id;?>">PESAN</a></td>
                <?php   }else if($data->status_pemesanan == 'Dipesan'){ ?>
                        <td><a class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal_status<?php echo $data->id;?>">UBAH</a></td>
                    <?php }?>
                 <?php }else{  ?>
                      </td>
                      <td> </td>
               <?php  } ?> -->
                             
           </tr>
           
 <?php  
            }     
           
        }
    }

    ?>
    </tbody>
    </table>


            </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
      </div>  

       <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <div class="box-title">
                            <h3>Unit Belum Masuk</h3>
                        </div>                        
                    </div>  
                            <div class="box-body">
                                <table  class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <td>No.</td>
                                            <td>Type Unit</td>
                                            <td>Model Unit</td>
                                            <td>Jumlah</td>
                                            
                                        </tr>                                        
                                    </thead>

                                    <tbody>
                                        <?php
                                         if( ! empty($detail_unit_stock_unit_belum_masuk))
                                         {
                                            $no = 1;

                                            foreach($detail_unit_stock_unit_belum_masuk as $data)
                                                {
                                                    $jumlah = $data->jumlah;
                                                    $konfirmasi = $data->konfirmasi;
                                                    $belum_masuk = $jumlah - $konfirmasi;

                                                     if($belum_masuk > 0)
                                                         {
                                                        ?> 


                                            <tr>
                                                <td><?php echo $no++?>     </td>    
                                                <td><?php echo $data->nama_unit ?></td>
                                                <td><?php echo $data->model ?></td>
                                                <td><?php echo $belum_masuk ?></td>
                                                
                                                
                                            </tr>
                                        
                                                 <?php  
                                                    }     
                                               
                                                }
                                        }

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                                          
                </div>                
            </div>

             <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <div class="box-title">
                            <h3>Unit Belum Dikirim</h3>
                        </div>                        
                    </div>  
                            <div class="box-body">
                                <table  class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <td>No.</td>
                                            <td>Type Unit</td>
                                            <td>Model Unit</td>
                                            <td>Jumlah</td>
                                            
                                        </tr>                                        
                                    </thead>

                                    <tbody>
                                        <?php
                                         if( ! empty($detail_unit_stock_unit_belum_dikirim))
                                         {
                                            $no = 1;

                                            foreach($detail_unit_stock_unit_belum_dikirim as $data)
                                                {
                                                    $jumlah = $data->jumlah;
                                                    $konfirmasi = $data->konfirmasi;
                                                    $belum_dikirim = $jumlah - $konfirmasi;

                                                     if($belum_dikirim > 0)
                                                         {
                                                        ?> 


                                            <tr>
                                                <td><?php echo $no++?>     </td>    
                                                <td><?php echo $data->nama_unit ?></td>
                                                <td><?php echo $data->model ?></td>
                                                <td><?php echo $belum_dikirim ?></td>
                                                
                                                
                                            </tr>
                                        
                                                 <?php  
                                                     }     
                                               
                                                }
                                        }

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                                          
                </div>                
            </div>          
      </div>  


      <div class="row">
                      
      </div> 

      


</section>

<!-- ============ MODAL EDIT PEMESANAN =============== -->
    <?php
    if( ! empty($detail_unit_stock))
    {
        foreach($detail_unit_stock as $data){
            if($data->total > 0){
              
        ?>
        <div class="modal fade" id="modal_edit<?php echo $data->id;?>" tabindex="" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Pesan Unit</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'index.php/report/edit_stock'?>">
                <div class="modal-body">

                    <!-- <div class="form-group">
                        <label class="control-label col-xs-3" >Status Pemesanan</label>
                        <div class="col-xs-8">
                             <select name="status_pemesanan" class="form-control" required>
                                <option value="">-PILIH-</option>
                                <?php //if($data->status_pemesanan=='0'):?>
                                    <option value="0" selected>STOCK</option>
                                    <option value="1">DIPESAN</option>
                                <?php //elseif($data->status_pemesanan=='1'):?>
                                    <option value="0">STOCK</option>
                                    <option value="1" selected>DIPESAN</option>                                
                                <?php //endif;?>
                             </select>
                        </div>
                    </div> -->

                    
                       
                            <input name="id" value="<?php echo $data->id;?>" class="form-control" type="hidden" readonly>
                       
                    
                     
                       
                      
                            <input name="status_pemesanan" value="Dipesan" class="form-control" type="hidden" readonly="">
                      
                

                    <div class="form-group" id="">
                        <label class="control-label col-xs-3" >Customer</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_customer_attribute = 'class="form-control select2" style="width:335px;" id="customer_id"';
                                echo form_dropdown('customer_id', $dd_customer, $customer_selected, $dd_customer_attribute);
                            ?>
                        </div>
                    </div> 
 
                    
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor Penawaran</label>
                        <div class="col-xs-8">
                            <input name="nomor_penawaran" value="<?php echo $data->nomor_penawaran;?>" class="form-control" type="text" placeholder="Nomor Penawaran" style="width:335px;" required>
                        </div>
                    </div>
 
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >PO Customer</label>
                        <div class="col-xs-8">
                            <input name="po_customer" value="<?php echo $data->po_customer;?>" class="form-control" type="text" placeholder="PO Customer" style="width:335px;" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal PO Customer</label>
                        <div class="col-xs-9">
                            <input name="tanggal_po_customer" id="tanggal_po_customer" class="form-control" type="text" placeholder="Format tanggal Tahun/Bulan/Hari" style="width:335px;" required>
                        </div>
                    </div>
 
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info">Update</button>
                </div>
            </form>
            </div>
            </div>
        </div>
  <?php  
            }     
           
        }
    }

    ?>
    <!--END MODAL PEMESANAN-->
    
    <!-- ============ MODAL EDIT STATUS PENJATAHAN =============== -->
    <?php
    if( ! empty($detail_unit_stock))
    {
        foreach($detail_unit_stock as $data){
            if($data->total > 0){
              
        ?>
        <div class="modal fade" id="modal_status<?php echo $data->id;?>" tabindex="" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Ubah Status Unit</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'index.php/report/edit_jatah'?>">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Status Pemesanan</label>
                        <div class="col-xs-8">
                             <select name="status_pemesanan" class="form-control" style="width:335px;" required>
                                <option value="">-PILIH-</option>
                                <?php if($data->status_pemesanan=='Stock'):?>
                                    <option value="Stock" selected>Stock</option>
                                    <option value="Dipesan">Dipesan</option>
                                <?php elseif($data->status_pemesanan=='Dipesan'):?>
                                    <option value="Stock">Stock</option>
                                    <option value="Dipesan" selected>Dipesan</option>                                
                                <?php endif;?>
                             </select>
                        </div>
                    </div> 

                            <input name="id" value="<?php echo $data->id;?>" class="form-control" type="hidden" readonly>
                       

                    <div class="form-group" id="">
                        <label class="control-label col-xs-3" >Customer</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_customer_attribute = 'class="form-control status_jatah" style="width:335px;" id="customer_id"';
                                echo form_dropdown('customer_id', $dd_customer, $customer_selected, $dd_customer_attribute);
                            ?>
                        </div>
                    </div> 
 
                    
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nomor Penawaran</label>
                        <div class="col-xs-8">
                            <input name="nomor_penawaran" value="<?php echo $data->nomor_penawaran;?>" class="form-control" type="text" placeholder="Nomor Penawaran" style="width:335px;" >
                        </div>
                    </div>
 
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >PO Customer</label>
                        <div class="col-xs-8">
                            <input name="po_customer" value="<?php echo $data->po_customer;?>" class="form-control" type="text" placeholder="PO Customer" style="width:335px;" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal PO Customer</label>
                        <div class="col-xs-9">
                            <input name="tanggal_po_customer" id="tanggal_po_customer" class="form-control" type="text" placeholder="Format tanggal Tahun/Bulan/Hari" style="width:335px;" >
                        </div>
                    </div>
 
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info">Update</button>
                </div>
            </form>
            </div>
            </div>
        </div>
  <?php  
            }     
           
        }
    }

    ?>
    <!--END MODAL STATUS PENJATAHAN-->
    
<?php 
$this->load->view('template/js');
?>
    <script src="<?php echo base_url('assets/js/jquery-ui.js'); ?>"></script> <!-- Load file plugin js jquery-ui -->
   
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
                messageTop: 'Data Detail Unit Masuk',
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
                messageTop: 'Data Detail Unit Masuk',
            },

            {
                extend: 'pdfHtml5',
                messageTop: 'Data Detail Unit Masuk',
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>

            $(document).ready(function () {
                $(".select2").select2({
                    placeholder: "Please Select"
                });
            });


        </script>
        
        <script>

            $(document).ready(function () {
                $(".status_jatah").select2({
                    placeholder: "Please Select"
                    initSelection: function(element, callback) {                   
                    }
                });
                
                $("#status_jatah").select2("val", "");
            });


        </script>

<?php

$this->load->view('template/foot');

?>