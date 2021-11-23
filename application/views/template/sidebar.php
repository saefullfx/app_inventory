<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <!--<img src="<?php //echo base_url('kolam/AdminLTE-2.0.5/dist/img/') ?>" class="img-circle" alt="User Image" />-->
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata('ses_nama');?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <!--Akses Menu Untuk Admin-->
            <?php if($this->session->userdata('akses')=='1'):?>
            
                    <li><a href="<?php echo site_url('page') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
               
           <!--  <li>
                    <a href="<?php //echo site_url('/report/quick_check_stock') ?>">
                        <i class="fa fa-clipboard"></i><span>Pengecekan Stock Sparepart</span>
                    </a>
                </li>  -->
            
            <li>
                <a href="<?php echo site_url('/report/rekap_all') ?>">
                    <i class="fa fa-building"></i> <span>Stock Sparepart</span>
                </a>
            </li>
            
            <!--  <li><a href="<?php echo base_url().'index.php/report/rekap_unit_all'?>">
                    <i class="fa fa-archive"></i> <span>Stock Unit</span>
                </a>
            </li> -->


             <li><a href="<?php echo base_url().'index.php/report/stock_unit'?>">
                    <i class="fa fa-archive"></i> <span>Stock Unit</span>
                </a>
            </li>
            
             <li><a href="<?php echo base_url().'index.php/barang/rental/unit_rental'?>">
                    <i class="fa fa-database"></i> <span>Stock Rental</span>
                </a>
            </li>
            

            <li class="header">MENU SPAREPART</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-send"></i> <span>Pemesanan Sparepart</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                   <li>
                        <a href="<?php echo site_url('/admin/order/read') ?>">
                        <i class="fa fa-bullseye"></i> <span>Pemesanan Sparepart</span>
                        </a>
                    </li>
                </ul>
            </li>
            
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-exchange"></i> <span>Transaksi Sparepart</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('/admin/transaksi/barang_masuk') ?>"><i class="fa fa-circle-o"></i> Sparepart Masuk</a></li>
                    <li><a href="<?php echo site_url('/admin/transaksi/barang_keluar') ?>"><i class="fa fa-circle-o"></i> Sparepart Keluar</a></li>
                    <li><a href="<?php echo site_url('/admin/transaksi/po_sementara') ?>"><i class="fa fa-circle-o"></i> Sparepart telah dipesan</a></li>
                </ul>
            </li>
            
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-file"></i> <span>Laporan Sparepart</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <!--<li><a href="<?php echo base_url().'index.php/barang/barang/rekap'?>"><i class="fa fa-circle-o"></i> Rekap Sparepart</a></li>-->
                     <li><a href="<?php echo base_url().'index.php/barang/barang/rekap_masuk'?>"><i class="fa fa-circle-o"></i> Rekap Sparepart Masuk</a></li>
                      <li><a href="<?php echo base_url().'index.php/report/barang_masuk'?>"><i class="fa fa-circle-o"></i> History Sparepart Masuk</a></li>
                      <li><a href="<?php echo base_url().'index.php/barang/barang/rekap_keluar'?>"><i class="fa fa-circle-o"></i> Rekap Sparepart Keluar</a></li>
                    <li><a href="<?php echo base_url().'index.php/report/barang_keluar'?>"><i class="fa fa-circle-o"></i> History Sparepart Keluar</a></li>
                   
                    <li><a href="<?php echo base_url().'index.php/report/hitung_sparepart_keluar'?>"><i class="fa fa-circle-o"></i> Kategori Sparepart</a></li>
                    
                </ul>
            </li>
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-server"></i> <span>Data Master</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                   <!-- <li><a href="<?php echo base_url().'index.php/page/read_barang'?>"><i class="fa fa-circle-o"></i> Item Barang</a></li>-->
                    <li><a href="<?php echo base_url().'index.php/page/item_sparepart'?>"><i class="fa fa-circle-o"></i> Item Sparepart</a></li>
                    <li><a href="<?php echo base_url().'index.php/page/read_customer'?>"><i class="fa fa-circle-o"></i> Customer</a></li>
                    <li><a href="<?php echo site_url().'/page/read_supplier'?>"><i class="fa fa-circle-o"></i> <span>Supplier</span></a></li>
                   <!-- <li><a href="<?php echo site_url().'/page/read_kategori'?>"><i class="fa fa-circle-o"></i> Kategori</a></li>-->
                    <li><a href="<?php echo site_url().'/page/read_jenis'?>"><i class="fa fa-circle-o"></i> Jenis</a></li>
                    
                </ul>
            </li>
            
            
            <li class="header">MENU UNIT</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-send"></i> <span>PO Unit</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  
                    <li>
                        <a href="<?php echo site_url('/admin/order/order_unit') ?>">
                        <i class="fa fa-bullseye"></i> <span>PO Unit Ke Supplier</span>
                        </a>
                    </li>
                     <li>
                        <a href="<?php echo site_url('/barang/unit/po_unit') ?>">
                        <i class="fa fa-bullseye"></i> <span>PO Unit Dari Customer</span>
                        </a>
                    </li> 
                </ul>
            </li>
            
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-exchange"></i> <span>Transaksi Unit</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                   
                    <li><a href="<?php echo site_url('/barang/unit/unit_masuk') ?>"><i class="fa fa-circle-o"></i> Unit Masuk</a></li>
                    <li><a href="<?php echo site_url('/barang/unit/unit_keluar') ?>"><i class="fa fa-circle-o"></i> Unit Keluar</a></li>
                    <!--<li><a href="<?php echo site_url('/barang/unit/unit_dipesan') ?>"><i class="fa fa-circle-o"></i>Unit Telah dipesan</a></li>-->
                   
               </ul>
            </li> 
            
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-file"></i> <span>Laporan Unit</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                   <!--  <li><a href="<?php echo base_url().'index.php/kartustock/mutasi_unit_masuk'?>"><i class="fa fa-circle-o"></i>Rekap Unit Masuk</a></li> -->
                    <li><a href="<?php echo base_url().'index.php/report/unit_masuk'?>"><i class="fa fa-circle-o"></i>History Unit Masuk</a></li>
                   
                   <!--  <li><a href="<?php echo base_url().'index.php/kartustock/mutasi_unit_keluar'?>"><i class="fa fa-circle-o"></i>Rekap Unit Keluar</a></li> -->
                    <li><a href="<?php echo base_url().'index.php/report/unit_keluar'?>"><i class="fa fa-circle-o"></i>History Unit Keluar</a></li>
     
                    <li><a href="<?php echo base_url().'index.php/report/rekap_unit_all'?>"><i class="fa fa-circle-o"></i>Laporan Stock Unit</a></li>
                </ul>
            </li>
            
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-server"></i> <span>Data Master Unit</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url().'index.php/barang/unit/type_unit'?>"><i class="fa fa-circle-o"></i><span>Type Unit</span></a></li>
                    <li><a href="<?php echo base_url().'index.php/barang/unit/model_unit'?>"><i class="fa fa-circle-o"></i><span>Model Unit</span></a></li>
                     <!--<li><a href="<?php //echo site_url('/barang/unit/data_unit') ?>"><i class="fa fa-circle-o"></i><span>Data master Unit</span></a></li>-->
                    
                </ul>
            </li>
            
            
             <li class="header">RENTAL UNIT</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>DATA RENTAL UNIT</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                   
                    <li>
                        <a href="<?php echo site_url('/barang/rental/') ?>">
                        <i class="fa fa-bullseye"></i> <span>Data Rental Unit</span>
                        </a>
                    </li>
                     <li>
                        <a href="<?php echo site_url('/barang/rental/list_rental') ?>">
                        <i class="fa fa-bullseye"></i> <span>Monitoring Rental</span>
                        </a>
                    </li> 
                </ul>
            </li>
            
            <!--<li>
                <a href="<?php echo site_url('/admin/transaksi/pencarian') ?>">
                    <i class="fa fa-search"></i> <span>Pencarian Sparepart</span>
                </a>
            </li> -->
            
            <li class="header">USER</li>            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Users</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url().'index.php/admin/user/user'?>"><i class="fa fa-circle-o"></i> User</a></li>
                    <li><a href="<?php echo base_url().'index.php/admin/user/admin'?>"><i class="fa fa-circle-o"></i> Admin</a></li>
                    
                </ul>
            </li>


<!--Akses Menu level 2-->
  <?php elseif($this->session->userdata('akses')=='2'):?>

    <!-- HOME -->          
            <li>
                <a href="<?php echo site_url('page') ?>">
                    <i class="fa fa-dashboard"></i> <span>Home</span>
                </a>
            </li>
          
            <li>
                <a href="<?php echo site_url('/report/rekap_all') ?>">
                        <i class="fa fa-building"></i> <span>Stock Sparepart</span>
                </a>
            </li>
                
            <li>
                <a href="<?php echo base_url().'index.php/report/rekap_unit_all'?>">
                       <i class="fa fa-archive"></i> <span>Stock Unit</span>
                </a>
            </li>
                
            <li>
                <a href="<?php echo base_url().'index.php/barang/rental/unit_rental'?>">
                        <i class="fa fa-database"></i> <span>Stock Rental</span>
                </a>
            </li>
    <!-- HOME -->  
            

    <!-- MENU SPAREPART -->        
            
           <li class="header">MENU SPAREPART</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-send"></i> <span>Pemesanan Sparepart</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                   <li>
                        <a href="<?php echo site_url('/admin/order/read') ?>">
                        <i class="fa fa-bullseye"></i> <span>Pemesanan Sparepart</span>
                        </a>
                    </li>
                </ul>
            </li>
            
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-exchange"></i> <span>Transaksi Sparepart</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('/admin/transaksi/barang_masuk') ?>"><i class="fa fa-circle-o"></i> Sparepart Masuk</a></li>
                    <li><a href="<?php echo site_url('/admin/transaksi/barang_keluar') ?>"><i class="fa fa-circle-o"></i> Sparepart Keluar</a></li>
                    <li><a href="<?php echo site_url('/admin/transaksi/po_sementara') ?>"><i class="fa fa-circle-o"></i> Sparepart telah dipesan</a></li>
                </ul>
            </li>
            
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-file"></i> <span>Laporan Sparepart</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <!--<li><a href="<?php echo base_url().'index.php/barang/barang/rekap'?>"><i class="fa fa-circle-o"></i> Rekap Sparepart</a></li>-->
                     <li><a href="<?php echo base_url().'index.php/barang/barang/rekap_masuk'?>"><i class="fa fa-circle-o"></i> Rekap Sparepart Masuk</a></li>
                      <li><a href="<?php echo base_url().'index.php/report/barang_masuk'?>"><i class="fa fa-circle-o"></i> History Sparepart Masuk</a></li>
                      <li><a href="<?php echo base_url().'index.php/barang/barang/rekap_keluar'?>"><i class="fa fa-circle-o"></i> Rekap Sparepart Keluar</a></li>
                    <li><a href="<?php echo base_url().'index.php/report/barang_keluar'?>"><i class="fa fa-circle-o"></i> History Sparepart Keluar</a></li>
                   
                    <li><a href="<?php echo base_url().'index.php/report/hitung_sparepart_keluar'?>"><i class="fa fa-circle-o"></i> Kategori Sparepart</a></li>
                    
                </ul>
            </li>
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-server"></i> <span>Data Master</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                   <!-- <li><a href="<?php echo base_url().'index.php/page/read_barang'?>"><i class="fa fa-circle-o"></i> Item Barang</a></li>-->
                    <li><a href="<?php echo base_url().'index.php/page/item_sparepart'?>"><i class="fa fa-circle-o"></i> Item Sparepart</a></li>
                    <li><a href="<?php echo base_url().'index.php/page/read_customer'?>"><i class="fa fa-circle-o"></i> Customer</a></li>
                    <li><a href="<?php echo site_url().'/page/read_supplier'?>"><i class="fa fa-circle-o"></i> <span>Supplier</span></a></li>
                   <!-- <li><a href="<?php echo site_url().'/page/read_kategori'?>"><i class="fa fa-circle-o"></i> Kategori</a></li>-->
                    <li><a href="<?php echo site_url().'/page/read_jenis'?>"><i class="fa fa-circle-o"></i> Jenis</a></li>
                    
                </ul>
            </li>
            
            
            <li class="header">MENU UNIT</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-send"></i> <span>PO Unit</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  
                    <li>
                        <a href="<?php echo site_url('/admin/order/order_unit') ?>">
                        <i class="fa fa-circle-o"></i> <span>PO Unit Ke Supplier</span>
                        </a>
                    </li>
                     <li>
                        <a href="<?php echo site_url('/barang/unit/po_unit') ?>">
                        <i class="fa fa-circle-o"></i> <span>PO Unit Dari Customer</span>
                        </a>
                    </li> 
                </ul>
            </li>
            
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-exchange"></i> <span>Transaksi Unit</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                   
                    <li><a href="<?php echo site_url('/barang/unit/unit_masuk') ?>"><i class="fa fa-circle-o"></i> Unit Masuk</a></li>
                    <li><a href="<?php echo site_url('/barang/unit/unit_keluar') ?>"><i class="fa fa-circle-o"></i> Unit Keluar</a></li>
                    <!--<li><a href="<?php echo site_url('/barang/unit/unit_dipesan') ?>"><i class="fa fa-circle-o"></i>Unit Telah dipesan</a></li>-->
                   
               </ul>
            </li> 
            
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-file"></i> <span>Laporan Unit</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                   <!--  <li><a href="<?php echo base_url().'index.php/kartustock/mutasi_unit_masuk'?>"><i class="fa fa-circle-o"></i>Rekap Unit Masuk</a></li> -->
                    <li><a href="<?php echo base_url().'index.php/report/unit_masuk'?>"><i class="fa fa-circle-o"></i>History Unit Masuk</a></li>
                   
                   <!--  <li><a href="<?php echo base_url().'index.php/kartustock/mutasi_unit_keluar'?>"><i class="fa fa-circle-o"></i>Rekap Unit Keluar</a></li> -->
                    <li><a href="<?php echo base_url().'index.php/report/unit_keluar'?>"><i class="fa fa-circle-o"></i>History Unit Keluar</a></li>
     
                    <li><a href="<?php echo base_url().'index.php/report/rekap_unit_all'?>"><i class="fa fa-circle-o"></i>Laporan Stock Unit</a></li>
                </ul>
            </li>
            
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-server"></i> <span>Data Master Unit</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url().'index.php/barang/unit/type_unit'?>"><i class="fa fa-circle-o"></i><span>Type Unit</span></a></li>
                    <li><a href="<?php echo base_url().'index.php/barang/unit/model_unit'?>"><i class="fa fa-circle-o"></i><span>Model Unit</span></a></li>
                     <!--<li><a href="<?php //echo site_url('/barang/unit/data_unit') ?>"><i class="fa fa-circle-o"></i><span>Data master Unit</span></a></li>-->
                    
                </ul>
            </li>
            
            <li class="header">RENTAL UNIT</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>DATA RENTAL UNIT</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                   
                    <li>
                        <a href="<?php echo site_url('/barang/rental/') ?>">
                        <i class="fa fa-circle-o"></i> <span>Data Rental Unit</span>
                        </a>
                    </li>
                     <li>
                        <a href="<?php echo site_url('/barang/rental/list_rental') ?>">
                        <i class="fa fa-circle-o"></i> <span>Monitoring Rental</span>
                        </a>
                    </li> 
                </ul>
            </li>
        
                   
             
           

            
    <!--Akses Menu Untuk user biasa -->
      <?php else:?>
            <li>
                <a href="<?php echo site_url('page') ?>">
                    <i class="fa fa-dashboard"></i> <span>Home</span>
                </a>
            </li>
          
            <li>
                <a href="<?php echo site_url('/report/rekap_all') ?>">
                        <i class="fa fa-building"></i> <span>Stock Sparepart</span>
                </a>
            </li>
                
          <!--   <li>
                <a href="<?php echo base_url().'index.php/report/rekap_unit_all'?>">
                       <i class="fa fa-archive"></i> <span>Stock Unit</span>
                </a>
            </li> -->

            <li><a href="<?php echo base_url().'index.php/report/stock_unit'?>">
                    <i class="fa fa-archive"></i> <span>Stock Unit</span>
                </a>
            </li>
                
            <li>
                <a href="<?php echo base_url().'index.php/barang/rental/unit_rental'?>">
                        <i class="fa fa-database"></i> <span>Stock Rental</span>
                </a>
            </li>
      <?php endif;?>
           
            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">