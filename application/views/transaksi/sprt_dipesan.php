<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
<link src="<?php echo base_url().'kolam/AdminLTE-2.0.5/plugins/datepicker/datepicker3.css'?>" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Sparepart telah dipesan
        <small>data list </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Sparepart telah dipesan</a></li>
        <li class="active">list</li>
    </ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped" width="100%" cellspacing="0">
			            <thead>
			                <tr>			                    
			                    <th>Part Number</th>
			                    <th>Sparepart</th>
			                    <th>Jumlah</th>
			                    <th>Dikirim</th>
			                    <th>Belum Dikirim</th>
			                    <th>Customer</th>
			                    <th>Tanggal PO</th>                   
			                    <th>Nomor PO</th>
			                    <th>Status Pemesanan</th>                  
			                    <th>Keterangan</th>
			                    <th width: "100px">Aksi</th>
			                    <th>Status Pemesanan</th>			                    
			                </tr>
			            </thead>
			            <tbody id="show_data">
				        </tbody>
				    </table>
				</div>			
			</div>
		</div>
	</div>
</section>

<!--MODAL HAPUS-->
  <div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel">Hapus Data</h4>
              </div>
              <form class="form-horizontal">
                <div class="modal-body">
                  <input type="hidden" name="id" id="id" value="">
                  <div class="alert alert-danger"><p>Apakah Anda yakin mau memhapus barang ini?</p></div>   
                </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button class="btn_hapus btn btn-danger" id="btn_hapus">Hapus</button>
              </div>
              </form>
          </div>
      </div>
  </div>

<?php 
$this->load->view('template/js');
?>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>kolam/AdminLTE-2.0.5/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
            $(function () {
            //Date picker
            $('#tanggal2').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true    }); 
            $('#tanggal').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true    });

            $('#example1').DataTable( {
            "scrollX": true
        	});

            });



            $(document).ready(function () {
                $(".select2").select2({
                    placeholder: "Please Select"
                });
            });
</script>

<script type="text/javascript">
	$(document).ready(function(){
	data_customer();
    
    //fungsi tampil data
    function data_customer(){
        $.ajax({
            type  : 'ajax',
            url   : '<?php echo base_url()?>index.php/admin/transaksi/data_sparepart_dipesan',
            dataType : 'json',
            success : function(data){
                var output = '';
                var i=0; 
                while(i<data.length){
                  output += '<tr>'+
                              '<td>'+data[i].kode_barang+'</td>'+
                                '<td>'+data[i].nama_barang+'</td>'+
                                '<td>'+data[i].jumlah+'</td>'+
                                '<td>'+data[i].jumlah_parsial+'</td>'+
                                '<td>'+data[i].SISA_KIRIM+'</td>'+
                                '<td>'+data[i].nama_customer+'</td>'+
                                '<td>'+data[i].tanggal_order+'</td>'+
                                '<td>'+data[i].nomor_po+'</td>'+
                                '<td>'+data[i].status_pemesanan+'</td>'+
                                '<td>'+data[i].keterangan+'</td>'+   
                              '<td>\
                              		<button class="btn btn-danger item_hapus" data="'+data[i].id+'">Hapus</button>\
                              </td>'+
                              '<td>'+data[i].kode_barang+'</td>'+
                              
                            '</tr>';
                  i++;
                }
                $('#show_data').html(output);
            }
        });
    }


    //GET delete
	$('#show_data').on('click','.item_hapus',function(){
	        var id=$(this).attr('data');
	        $('#ModalHapus').modal('show');
	        $('[name="id"]').val(id);
	    });
	//Hapus Barang
	$('#btn_hapus').on('click',function(e){
	    e.preventDefault();
	    var id=$('#id').val();
	    $.ajax({
	    type : "POST",
	    url  : "<?php echo base_url()?>index.php/admin/transaksi/delete",
	      data : {id: id},
	        success: function(data){
	                $('#ModalHapus').modal('hide');
	                data_customer();
	        }
	      });
	    });

  });
	
</script>


<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>