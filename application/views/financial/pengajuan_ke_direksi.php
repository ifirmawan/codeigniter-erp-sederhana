<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Fin</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(). 'assets/css/scooter.css' ?> ">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(). 'assets/css/grid.min.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(). 'assets/font-awesome/css/font-awesome.min.css' ?>">
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
      $("#diterima").hide();
      $("#menu_pengajuan").click(function(){
        $("#diterima").hide();
        $("#pengajuan").show();
      });
      $("#menu_diterima").click(function(){
        $("#diterima").show();
        $("#pengajuan").hide();
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
					
					<li><a href="#">Inbox <span class="c-badge"><?php echo $count; ?></span></a></li>
				</ul>	
				</div>
				
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<nav class="u-pad-m">
  <ul class="c-tab-nav" role="tablist">
    <li role="presentation" class="c-tab-nav__tab is-active">
      <button id="menu_pengajuan" role="tab" aria-selected="true" tabindex="0">Pengajuan</button>
    </li>
    <li role="presentation" class="c-tab-nav__tab">
      <button role="tab" aria-selected="false" tabindex="-1">Proses</button>
    </li>
    <li role="presentation" class="c-tab-nav__tab">
      <button id="menu_diterima" role="tab" aria-selected="false" tabindex="-1">Diterima</button>
    </li>
    <li role="presentation" class="c-tab-nav__tab">
      <button role="tab" aria-selected="false" tabindex="-1">Ditolak</button>
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
            
            <button onclick="window.location='<?php echo base_url(). 'members/selesai' ?>'" class="c-btn c-btn--primary" >
              <i class="fa fa-times-circle-o"></i>&nbsp;
                Selesai
            </button>

          </div>
         
      </div>
    </div>
  
<table id="pengajuan" class="c-table c-table--zebra">
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
    foreach ($pengajuan as $row) {
    ?>
    <form action="<?php echo base_url(). $type .'/ajukan/' .$row->id_item; ?>" method="post">
      <input type="hidden" name="id_item" value="<?php echo $row->id_item; ?>">
      <input type="hidden" name="nama_item" value="<?php echo $row->nama_item ?>">
      <input type="hidden" name="jumlah" value="<?php echo $row->qty ?>">
      <input type="hidden" name="satuan" value="<?php echo $row->satuan ?>">
      <input type="hidden" name="description" value="<?php echo $row->description; ?>">
      <input type="hidden" name="id_permintaan" value="<?php echo $row->id_permintaan; ?>" >
      <input type="hidden" name="jenis_pengajuan" value="<?php echo $row->jenis_pengajuan; ?>">
    <tr>
      <td><?php echo $row->no_permintaan; ?></td>
      <td><?php echo $row->jenis_pengajuan; ?></td>
      <td><?php echo $row->nama_item; ?></td>
      <td><?php echo $row->qty; ?></td>
      <td><?php echo $row->satuan ?></td>
      <td><?php echo $row->description; ?></td>
            
      <td><button type="Submit" name="btn_function" value="ajukan" class="c-btn c-btn--secondary"><i class="fa fa-paper-plane"></i>&nbsp; Ajukan</button>
      </td>     
    </tr>
    </form>

    <?php
    }
    ?>    
  </tbody>
</table>

<!-- diterima -->
<table id="diterima" class="c-table c-table--zebra">
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
    foreach ($diterima as $terima) {
    ?>

    <tr>
      <td><?php echo $terima->no_permintaan; ?></td>
      <td><?php echo $terima->jenis_pengajuan; ?></td>
      <td><?php echo $terima->nama_item; ?></td>
      <td><?php echo $terima->qty; ?></td>
      <td><?php echo $terima->satuan ?></td>
      <td><?php echo $terima->description; ?></td>
            
      <td><button id="cairkan" name="btn_function" value="ajukan" class="c-btn c-btn--secondary"><i class="fa fa-paper-plane"></i>&nbsp; <?php echo $btn; ?></button>
      </td>     
    </tr>

    <?php
    }
    ?>    
  </tbody>
</table>


      </div>
    </div>
  </div>
</body>
</html>