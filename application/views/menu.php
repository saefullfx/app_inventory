<nav class="navbar navbar-inverse">
<div class="container-fluid">
<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
  <ul class="nav navbar-nav">
  <!--Akses Menu Untuk Admin-->
  <?php if($this->session->userdata('akses')=='1'):?>
      <li class="active"><a href="<?php echo base_url().'index.php/page'?>">Dashboard</a></li>
      <li><a href="<?php echo base_url().'index.php/admin/transaksi/barang_keluar'?>">Barang Keluar</a></li>
      <li><a href="<?php echo base_url().'index.php/admin/transaksi/barang_masuk'?>">Barang Masuk</a></li>
      <li><a href="<?php echo base_url().'index.php/barang/barang/stock'?>">Stock Barang</a></li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Master Data
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo base_url().'index.php/page/read_customer'?>">Customer</a>
          <a class="dropdown-item" href="<?php echo base_url().'index.php/page/read_supplier'?>">Supplier</a>
          <a class="dropdown-item" href="<?php echo base_url().'index.php/page/read_kategori'?>">Kategori</a>
          <a class="dropdown-item" href="<?php echo base_url().'index.php/page/read_jenis'?>">Jenis</a>
          <a class="dropdown-item" href="<?php echo base_url().'index.php/page/read_lokasi'?>">Lokasi</a>
          <a class="dropdown-item" href="<?php echo base_url().'index.php/page/read_barang'?>">Barang</a>
          <a class="dropdown-item" href="<?php echo base_url().'index.php/page/read_status'?>">Status</a>
        </div>
      </li>
      
  <!--Akses Menu Untuk Dosen-->
  <?php elseif($this->session->userdata('akses')=='2'):?>
      <li class="active"><a href="<?php echo base_url().'index.php/page'?>">Dashboard</a></li>
      <li><a href="<?php echo base_url().'index.php/page/barang'?>">Data Barang</a></li>
      <li><a href="<?php echo base_url().'index.php/page/tambah_barang'?>">Input Barang</a></li>
  <!--Akses Menu Untuk Mahasiswa-->
  <?php else:?>
      <li class="active"><a href="<?php echo base_url().'index.php/page'?>">Dashboard</a></li>
      <li><a href="<?php echo base_url().'index.php/page/krs'?>">KRS</a></li>
      <li><a href="<?php echo base_url().'index.php/page/lhs'?>">LHS</a></li>
  <?php endif;?>
  </ul>
 
  <ul class="nav navbar-nav navbar-right">
    <li><a href="<?php echo base_url().'index.php/auth/logout'?>">Sign Out</a></li>
  </ul>
</div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav> 