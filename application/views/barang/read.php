<html>
<head>
    <meta charset="utf-8">
    <title>List Barang</title>
    <?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
<link src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.css'?>" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />




<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
</head>
<body>
<div class="container">        
            <h1 class="page-header">Unit
                <small>Barang</small>
                <div class="pull-right"><a href="#" class="btn btn-success" data-toggle="modal" data-target="#ModalaAdd"><span class="fa fa-plus"></span> </a></div>
            </h1>
      
    
        <table class="table table-striped" id="mytable">
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Jenis</th>
                    <th>Lokasi Penempatan</th>
                    <th>Ruang</th>
                    <th>Rak</th>
                    <th>Tingkat</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th style="text-align: right;">Aksi</th>
                    
                </tr>
            </thead>
            
        </table>
   
</div>
 
<!-- MODAL ADD -->
 <form class="form-horizontal" id="add-row-form" action="<?php echo base_url().'index.php/barang/barang/save_kartu_stock'?>" method="post">
        <div class="modal fade" id="ModalaAdd" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Kartu Stock</h3>
            </div>
           
                <div class="modal-body">               
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Barang</label>
                        <div class="col-xs-9">
                          <?php
                                $dd_barang_attribute = 'class="form-control select2" style="width:335px;"';
                                echo form_dropdown('kode_barang', $dd_barang, $barang_selected, $dd_barang_attribute);
                            ?>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Kategori</label>
                        <div class="col-xs-9">
                           
                            <?php
                                $dd_kategori_attribute = 'class="form-control select2" name="kategori_id" style="width:335px;"';
                                echo form_dropdown('kategori_id', $dd_kategori, $kategori_selected, $dd_kategori_attribute);
                            ?>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jenis</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_jenis_attribute = 'class="form-control select2" name="jenis_id" style="width:335px;"';
                                echo form_dropdown('jenis_id', $dd_jenis, $jenis_selected, $dd_jenis_attribute);
                            ?>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Lokasi Penempatan</label>
                        <div class="col-xs-9">
                            <input name="lokasi" id="lokasi" class="form-control" type="text" placeholder="Lokasi" style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Ruang</label>
                        <div class="col-xs-9">
                            <input name="ruang" id="ruang" class="form-control" type="text" placeholder="Ruang" style="width:335px;" required>
                        </div>
                    </div> 
                     <div class="form-group">
                        <label class="control-label col-xs-3" >Rak</label>
                        <div class="col-xs-9">
                            <input name="rak" id="rak" class="form-control" type="text" placeholder="Rak" style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" > Tingkat</label>
                        <div class="col-xs-9">
                            <input name="tingkat" id="tingkat" class="form-control" type="text" placeholder="Tingkat" style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jumlah</label>
                        <div class="col-xs-9">
                            <input name="jumlah" id="jumlah" class="form-control" type="text" placeholder="Jumlah" style="width:335px;" required>
                        </div>
                    </div> 
                   
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <textarea name="keterangan" id="keterangan" class="form-control" type="text" placeholder="Keterangan" style="width:335px;" required> </textarea>
                        </div>
                    </div> 
                        
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" id="add-row">Simpan</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <!--END MODAL ADD-->


        <!-- MODAL EDIT -->
        <form class="form-horizontal" id="add-row-form" action="<?php echo base_url().'index.php/barang/barang/update_kartu_stock'?>" method="post">
        <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Edit</h3>
            </div>
           
                <div class="modal-body">               
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Barang</label>
                        <div class="col-xs-9">
                          <?php
                                $dd_barang_attribute = 'class="form-control select2" name=kode_barang id="kode_barang" style="width:335px;"';
                                echo form_dropdown('kode_barang', $dd_barang, $barang_selected, $dd_barang_attribute);
                            ?>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Kategori</label>
                        <div class="col-xs-9">
                           
                            <?php
                                $dd_kategori_attribute = 'class="form-control select2" name="kategori_id" id="kategori_id" style="width:335px;"';
                                echo form_dropdown('kategori_id', $dd_kategori, $kategori_selected, $dd_kategori_attribute);
                            ?>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jenis</label>
                        <div class="col-xs-9">
                            <?php
                                $dd_jenis_attribute = 'class="form-control select2" name="jenis_id" id="jenis_id" style="width:335px;"';
                                echo form_dropdown('jenis_id', $dd_jenis, $jenis_selected, $dd_jenis_attribute);
                            ?>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Lokasi Penempatan</label>
                        <div class="col-xs-9">
                            <input name="lokasi" id="lokasi" class="form-control" type="text" placeholder="Lokasi" style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Ruang</label>
                        <div class="col-xs-9">
                            <input name="ruang" id="ruang" class="form-control" type="text" placeholder="Ruang" style="width:335px;" required>
                        </div>
                    </div> 
                     <div class="form-group">
                        <label class="control-label col-xs-3" >Rak</label>
                        <div class="col-xs-9">
                            <input name="rak" id="rak" class="form-control" type="text" placeholder="Rak" style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" > Tingkat</label>
                        <div class="col-xs-9">
                            <input name="tingkat" id="tingkat" class="form-control" type="text" placeholder="Tingkat" style="width:335px;" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jumlah</label>
                        <div class="col-xs-9">
                            <input name="jumlah" id="jumlah" class="form-control" type="text" placeholder="Jumlah" style="width:335px;" required>
                        </div>
                    </div> 
                   
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Keterangan</label>
                        <div class="col-xs-9">
                            <textarea name="keterangan" id="keterangan" class="form-control" type="text" placeholder="Keterangan" style="width:335px;" required> </textarea>
                        </div>
                    </div> 
                        <input name="id" id="id" class="form-control" type="hidden" placeholder="Jumlah" style="width:335px;" required>
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" id="add-row">Update</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <!--END MODAL EDIT-->

        <!--MODAL HAPUS-->
        <form class="form-horizontal" id="add-row-form" action="<?php echo base_url().'index.php/barang/barang/delete'?>">
        <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                        <h4 class="modal-title" id="myModalLabel">Hapus Kartu Stock</h4>
                    </div>
                    
                    <div class="modal-body">
                                           
                            <input type="hidden" name="id" id="id">
                            <div class="alert alert-warning"><p>Apakah Anda yakin mau menghapus record ini?</p></div>
                                         
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
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datatables/jquery.dataTables.js'?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        // Setup datatables
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
      {
          return {
              "iStart": oSettings._iDisplayStart,
              "iEnd": oSettings.fnDisplayEnd(),
              "iLength": oSettings._iDisplayLength,
              "iTotal": oSettings.fnRecordsTotal(),
              "iFilteredTotal": oSettings.fnRecordsDisplay(),
              "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
              "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
          };
      };

      var table = $("#mytable").dataTable({
          initComplete: function() {
              var api = this.api();
              $('#mytable_filter input')
                  .off('.DT')
                  .on('input.DT', function() {
                      api.search(this.value).draw();
              });
          },
              oLanguage: {
              sProcessing: "loading..."
          },
              processing: true,
              serverSide: true,
              ajax: {"url": "<?php echo base_url().'index.php/barang/barang/get_json'?>", "type": "POST"},
                    columns: [
                                                {"data": "kode_barang"},
                                                {"data": "nama_barang"},
                                                 {"data": "nama_kategori"},
                                                {"data": "nama_jenis"},
                                                 {"data": "lokasi"},
                                                {"data": "ruang"},
                                                 {"data": "rak"},
                                                {"data": "tingkat"},
                                                 {"data": "jumlah"},
                                                {"data": "keterangan"},
                                                //render harga dengan format angka
                       /* {"data": "barang_harga", render: $.fn.dataTable.render.number(',', '.', '')},
                        {"data": "kategori_nama"},*/
                        {"data": "view"}
                  ],
                order: [[1, 'asc']],
          rowCallback: function(row, data, iDisplayIndex) {
              var info = this.fnPagingInfo();
              var page = info.iPage;
              var length = info.iLength;
              $('td:eq(0)', row).html();
          }

      });
            // end setup datatables
            // get Edit Records
            $('#mytable').on('click','.edit_record',function(){
                        var id=$(this).data('id');
                        var kode_barang=$(this).data('kode_barang');                        
                        var nama_kategori=$(this).data('kategori_id');
                        var nama_jenis=$(this).data('jenis_id');
                        var lokasi=$(this).data('lokasi');
                        var ruang=$(this).data('ruang');
                        var rak=$(this).data('rak');
                        var tingkat=$(this).data('tingkat');
                        var jumlah=$(this).data('jumlah');
                        var keterangan=$(this).data('keterangan');
                        
            $('#ModalEdit').modal('show');
                        $('[name="id"]').val(id);
                        $('[name="kode_barang"]').val(kode_barang);
                        $('[name="nama_kategori"]').val(nama_kategori);
                        $('[name="nama_jenis"]').val(nama_jenis);
                        $('[name="lokasi"]').val(lokasi);
                        $('[name="ruang"]').val(ruang);
                        $('[name="rak"]').val(rak);
                        $('[name="tingkat"]').val(tingkat);
                        $('[name="jumlah"]').val(jumlah);
                        $('[name="keterangan"]').val(keterangan);
      });
            // End Edit Records
            
            // get Hapus Records
            $('#mytable').on('click','.hapus_record',function(){
            var id=$(this).data('id');
            $('#ModalDelete').modal('show');
            $('[name="id"]').val(id);
      });
            // End Hapus Records

            $(document).ready(function () {
                $(".select2").select2({
                    placeholder: "Please Select"
                });
            });
        

    });
</script>
</body>
</html>