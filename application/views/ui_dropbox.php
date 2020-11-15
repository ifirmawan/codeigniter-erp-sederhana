<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Fin</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(). 'assets/css/scooter.css' ?> ">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(). 'assets/css/grid.min.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(). 'assets/font-awesome/css/font-awesome.min.css' ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
.tab-content{
	display: none;
}

	</style>

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-4">

			</div>
			<div class="col-xs-12 col-md-8" style="padding-right: 50px;">
				

				<div style="float: right;">


					<div class="fin-dropdown">
						<?php  //foreach ($username as $user) { ?> 
							<a href="<?php echo base_url().'members/detail_user/'.$my['id'];?>">
							<?php
								if (isset($my['username'])) {
									echo ucfirst($my['username']);
								}
							?>
								
							</a>
  						<?php //} ?>
  						<div class="fin-dropdown-content">
    						<a 	href="<?php echo site_url('auth/logout'); ?>"
    							class="fin-dropdown-item">Logout</a>
  						</div>
					</div>

				</div>

				<div style="float: right;margin-right: 25px;">
					<ul class="fin-nav-hr"> 
						<li><a href="<?php  if(isset($target)){ echo base_url().$target; } ?>">Inbox <span class="c-badge"><?php if (isset($count)) {
							echo $count;
						} ?></span></a></li>
						
					</ul>	
				</div>

			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<?php 
				if (isset($notifikasi)) {
					foreach ($notifikasi as $key => $value) { ?>
					
					<div id="alert" class="alert alert-info tr" onclick="window.location='<?php echo base_url(). 'members/on_click_notification/' .$value->id_permintaan.'/'.$value->id_notification; ?>'">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong><?php echo ucwords($value->username); ?></strong> <?php echo ucwords($value->pesan_notifikasi); ?>
					</div>
				<?php }} ?>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12">
				<?php echo (isset($alert))? $alert : '' ;?>
				<div class="u-pad-s">
					<?php echo (isset($content))? $content : '';?>  
				</div>
			</div>
		</div>
		
	</div>
	


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
	<script type="text/javascript">
		//index
		$(document).ready(function(){
			
			$(".c-tab-nav a").click(function(event) {
        		event.preventDefault();
        		$(this).parent().addClass("is-active");
        		$(this).parent().siblings().removeClass("is-active");
        		
        		var tab = $(this).attr("href");
        		
        		$(".tab-content").not(tab).css("display", "none");
        		$(tab).fadeIn();
    		});
    	
			$('.c-tab-nav a:first').trigger('click');
		//tambah_permintaan
			if ($("#satuan").val()=="Rupiah") {
				$("#selanjutnya").hide();	
				$("#tambah").show();
			}else{
				$("#tambah").hide();
				$("#selanjutnya").show();
			}

			$("#satuan").change(function(){
				var val = $("#satuan").val();
				if (val == "Rupiah") {
					$("#tambah").show();
					$("#selanjutnya").hide();
				}

				if (val != "Rupiah") {
					$("#tambah").hide();
					$("#selanjutnya").show();
				}
			});
		//hapus semua
			$("button[id=hapus_semua]").click(function(){
				var message = "Apa anda yakin ?";
				var id_permintaan = $(this).val();
				if (confirm(message)) {
					window.location.href = this.getAttribute('href');
				}
			});
		
		//rincian aktiva
			$("#kebutuhan").hide();
			$("#golongan").hide();
		
			$( "#select_gol" ).change(function() {
			  var click = $("#select_gol").val();
			  if (click=="lainya") {$("#golongan").show();} else {$("#golongan").hide();}	
			});

			$( "#select_keb" ).change(function() {
			  var click = $("#select_keb").val();
			  if (click=="lainya") {$("#kebutuhan").show();} else {$("#kebutuhan").hide();}	
			});
 
		//edit item
			$("#kebutuhan").hide();
			$("#golongan").hide();
			
			if ($("#kebutuhan").val() !== "") {
				$("#select_keb").val("lainya");
				$("#kebutuhan").show();
			}

			if ($("#golongan").val() !== "") {
				$("#select_gol").val("lainya");
				$("#golongan").show();
			}
			
			$( "#select_gol" ).change(function() {
			  var click = $("#select_gol").val();
			  if (click=="lainya") {$("#golongan").show();} else {$("#golongan").hide();}	
			});

			$( "#select_keb" ).change(function() {
			  var click = $("#select_keb").val();
			  if (click=="lainya") {$("#kebutuhan").show();} else {$("#kebutuhan").hide();}	
			});	
		
		//button review
			$("#btn_review").hide();
			var dept = $("#dept").val();
			if (dept=="Kepala Departement") {
				$("#btn_review").show();
			}

			if (dept == "") {
				$("#btn_review").hide();
			}


		//modal
			

			$("button[name=revisi]").click(function(){
				var value = $(this).val();
				var action = "<?php echo base_url(). 'direksi/tanggapi_pengajuan/'?>"+value;
				var id_permintaan = $(this).prop("id");

				$(".modal-title").text("Alasan Revisi");
				$("input[name=id_permintaan]").val(id_permintaan);
				$("button[id=tolak]").hide();
				$("button[id=revisi]").click(function(){
					$("form").attr("action", action);
				});
			});

			$("button[name=tolak]").click(function(){
				var value = $(this).val();
				var action = "<?php echo base_url(). 'direksi/tanggapi_pengajuan/'?>"+value;
				var id_permintaan = $(this).prop("id");

				$("input[name=id_permintaan]").val(id_permintaan);
				$(".modal-title").text("Alasan Penolakan");
				$("button[id=revisi]").hide();
				$("button[id=tolak").click(function(){
					$("form").attr("action", action);
				});
			});
			
		});
	</script>


</body>
</html>