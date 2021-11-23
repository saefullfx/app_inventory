<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Autocomplete</title>
     <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css'?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/jquery-ui.css'?>">
</head>
<body>
    <div class="container">
        <div class="row">
            <h2>Autocomplete Codeigniter</h2>
        </div>
        <div class="row">
            <form>
                 <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" id="nama_barang" placeholder="Title" style="width:500px;">
                  </div>
            </form>
        </div>
    </div>
 
        <script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-ui.js'?>"></script>
        
        <script type="text/javascript">
        $(document).ready(function(){
            $( "#nama_barang" ).autocomplete({
              source: "<?php echo site_url('welcome/get_autocomplete/?');?>"
            });
        });
    </script>
        
    

 
</body>
</html>