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
			<div class="col-xs-12 col-md-2">
			</div>

			<div class="col-xs-12 col-md-8">
				<?php echo (isset($alert))? $alert : '' ;?>
				<div class="u-pad-s">
					<?php echo (isset($content))? $content : '';?>  
				</div>
			</div>
			<div class="col-xs-12 col-md-2">
			</div>
		</div>
		
	</div>
	
</body>
</html>