<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Fin</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(). 'assets/css/scooter.css' ?> ">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(). 'assets/css/grid.min.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(). 'assets/font-awesome/css/font-awesome.min.css' ?>">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<style type="text/css">
		a.fin-item{
		text-decoration: none;
		}
		ul.fin-nav-hr {
    		list-style-type: none;
    		margin: 0;
    		padding: 0;
    		overflow: hidden;

		}

ul.fin-nav-hr > li {
    float: left;
}

ul.fin-nav-hr > li a {
    display: block;
    text-align: center;
    padding-left: 16px;
}

.fin-dropdown {
    position: relative;
    display: inline-block;
}

.fin-dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1000;
}

.fin-dropdown-content .fin-dropdown-item {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.fin-dropdown-content .fin-dropdown-item:hover {background-color: #f1f1f1}

.fin-dropdown:hover .fin-dropdown-content {
    display: block;
}

.fin-dropdown:hover .dropbtn {
    background-color: #3e8e41;
}
.f3{
	font-weight: bold;
}
.f3 small{
	font-weight: normal;
}
.fin-row{
	padding-left: 22px;
}

	</style>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    $(".barang").hide();
    $("#menu_financial").click(function(){
      $(".barang").hide();
      $(".financial").show();
    });
    $("#menu_barang").click(function(){
      $(".barang").show();
      $(".financial").hide();
    });
  });
</script>
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-4">

			</div>
			<div class="col-xs-12 col-md-8">
				<div style="float: right;">
					<div class="fin-dropdown">
						<?php 
							foreach ($username as $user) {
						?>

  <a href="#"><?php echo $user->username; ?></a>
  <?php
}
?>
  <div class="fin-dropdown-content">
    <a href="#" class="fin-dropdown-item">Link 1</a>
    <a href="#" class="fin-dropdown-item">Link 2</a>
    <a href="#" class="fin-dropdown-item">Link 3</a>
  </div>
</div>
				</div>
				<div style="float: right;margin-right: 25px;">
				<ul class="fin-nav-hr"> 
					
					<li><a href="#">Inbox <span class="c-badge">12</span></a></li>
				</ul>	
				</div>
				
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<nav class="u-pad-m">
  <ul class="c-tab-nav" role="tablist">

    <li role="presentation" class="c-tab-nav__tab is-active">
      <button id="menu_financial" role="tab" aria-selected="true" tabindex="0">Permintaan Financial</button>
    </li>
    <li role="presentation" class="c-tab-nav__tab" id="barang">
      <button id="menu_barang" role="tab" aria-selected="false" tabindex="-1">Permintaan Barang</button>
    </li>
  </ul>
</nav>

      <div class="row" style="padding-left: 22px;">
      <div class="col-xs-12 col-md-8">
    <span ><!--class="u-pad-s" -->
            <input class="c-input" placeholder="search anything here"  />
          </span>
      </div>
      <div class="col-xs-12 col-md-4">
            <div style="text-align: right;">
            
            

          </div>
         
      </div>
    </div>

<table class="c-table c-table--zebra financial">
  <thead>
    <th>Number</th>
    <th>Type</th>
    <th>Name</th>
    <th>Amount</th>
    <th>Unit</th>
    <th>Description</th>
    <th>Action</th>
  </thead>
  <tbody>
    <?php
    foreach ($financial as $row) {
    ?>
    <form action="<?php echo base_url(). 'direksi/tanggapi_pengajuan/' .$row->id_item .'/'.$row->jenis_pengajuan ; ?>" method="post">
      <input type="hidden" name="id_item" value="<?php echo $row->id_item; ?>">
      <input type="hidden" name="id_permintaan" value="<?php echo $row->id_permintaan; ?>">
      <input type="hidden" name="id_pengajuan" value="<?php echo $row->id_pengajuan; ?>" >
      <input type="hidden" name="jenis_pengajuan" value="<?php echo $row->jenis_pengajuan; ?>">
    <tr>
      <td><?php echo $row->no_permintaan; ?></td>
      <td><?php echo $row->jenis_pengajuan; ?></td>
      <td><?php echo $row->nama_item; ?></td>
      <td><?php echo $row->qty; ?></td>
      <td><?php echo $row->satuan ?></td>
      <td><?php echo $row->description; ?></td> 
      <td>
        <button type="submit" name="btn_function" value="revisi" class="c-btn c-btn--tertiary"><i class="fa fa-edit"></i>Revisi</button>
          <button type="submit" name="btn_function" value="tolak" class="c-btn c-btn--secondary"><i class="fa fa-times-circle-o"></i>&nbsp; Tolak </button>
          <button type="submit" name="btn_function" value="terima" class="c-btn c-btn--primary"><i class="fa fa-check-square-o"></i>&nbsp; Terima </button>
      </td>     
    </tr>
    <tr>
      <td colspan="7"><textarea name="catatan" class="c-input" placeholder="Catatan :"></textarea></td>
    </tr>
    </form>

    <?php
    }
    ?>    
  </tbody>
</table>

<!-- tabel permintaan barang-->
<table class="c-table c-table--zebra barang">
  <thead>
    <th>Number</th>
    <th>Type</th>
    <th>Name</th>
    <th>Amount</th>
    <th>Unit</th>
    <th>Description</th>
    <th>Action</th>
  </thead>
  <tbody>
    <?php
    foreach ($barang as $row) {
    ?>
    <form action="<?php echo base_url(). 'direksi/tanggapi_pengajuan/' .$row->id_item.'/'.$row->jenis_pengajuan; ?>" method="post">
      <input type="hidden" name="id_item" value="<?php echo $row->id_item; ?>">
      <input type="hidden" name="id_permintaan" value="<?php echo $row->id_permintaan; ?>">
      <input type="hidden" name="id_belanja" value="<?php echo $row->id_belanja; ?>" >
      <input type="hidden" name="jenis_pengajuan" value="<?php echo $row->jenis_pengajuan; ?>">
    <tr>
      <td><?php echo $row->no_permintaan; ?></td>
      <td><?php echo $row->jenis_pengajuan; ?></td>
      <td><?php echo $row->nama_item; ?></td>
      <td><?php echo $row->qty; ?></td>
      <td><?php echo $row->satuan ?></td>
      <td><?php echo $row->description; ?></td> 
      <td>
        <button type="submit" name="btn_function" value="revisi" class="c-btn c-btn--tertiary"><i class="fa fa-edit"></i>Revisi</button>
          <button type="submit" name="btn_function" value="tolak" class="c-btn c-btn--secondary"><i class="fa fa-times-circle-o"></i>&nbsp; Tolak </button>
          <button type="submit" name="btn_function" value="terima" class="c-btn c-btn--primary"><i class="fa fa-check-square-o"></i>&nbsp; Terima </button>
      </td>     
    </tr>
    <tr class="barang">
      <td colspan="7"><textarea name="catatan" class="c-input" placeholder="Catatan :"></textarea></td>
    </tr>
    </form>

    <?php
    }
    ?>    
  </tbody>
</table>
<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Open Modal</button>
      </div>
    </div>
  </div>
<!-- MODAL -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <textarea>Alasan penolakan</textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>