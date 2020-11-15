<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<link rel="stylesheet" type="text/css" 
		href="<?php echo base_url('assets/css/bootstrap.min.css');?>" />
	<link rel="stylesheet" type="text/css" 
		href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css');?>" />
	<link rel="stylesheet" type="text/css" 
		href="<?php echo base_url('assets/css/bootstrap-notifications.min.css');?>" />
	<link rel="stylesheet" type="text/css" 
		href="<?php echo base_url('assets/custom/css/sticky-footer-navbar.css');?>" />
	<style type="text/css">
		.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    		padding: 8px;
    		line-height: 0.01;
		}
	</style>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo (isset($me))? site_url($me.'/index') : site_url('/');?>">
            	<?php echo (isset($is))? ucfirst($is) : '' ;?>
            </a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
      			<?php 
                  	if (function_exists('render_top_navigation') && isset($navigasi)) {
                      	render_top_navigation($navigasi);
                  	}
                ?>
            </ul>
            <form class="navbar-form navbar-right">
				<a  href="<?php echo site_url($me.'/logout');?>" class="btn btn-default">
					<i class="glyphicon glyphicon-log-out"> </i>Keluar
				</a>
			</form>
            <ul class="nav navbar-nav navbar-right">
            	<li>
					<a href="<?php echo site_url($me.'/detail_pribadi');?>">
						<?php echo (isset($username))? 'Hai ! '.$username : 'Anonymous';?>
					</a>
				</li>
			</ul>
            <div class="nav navbar-nav navbar-right">
      			<ul class="nav navbar-nav navbar-right nav-bell">
        		<li class="dropdown dropdown-notifications">
            		<a href="#" class="dropdown-toggle" id="list-notif-lg" data-toggle="dropdown">
              			<i data-count="<?php echo (isset($notif_count))? $notif_count : 0;?>" 
              				class="glyphicon glyphicon-bell notification-icon"></i>
           			</a>
            		<div class="dropdown-container" aria-labelledby="list-notif-lg">
              		<div class="dropdown-toolbar">
                		<div class="dropdown-toolbar-actions">
                  			<a href="#">Mark all as read</a>
                		</div>
                		<h3 class="dropdown-toolbar-title">
                			Notifications (<?php echo (isset($notif_count))? $notif_count : 0;?>)
                		</h3>
              		</div><!-- /dropdown-toolbar -->
    			
    				<ul class="dropdown-menu notifications">
    					<?php echo (isset($notif_items))? $notif_items : '';?>
      				</ul>
              		<div class="dropdown-footer text-center">
                		<a href="#">View All</a>
              		</div><!-- /dropdown-footer -->
            		</div><!-- /dropdown-container -->
          		</li>
      			</ul>

            </div>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

<div class="container" style="margin-top: 15px;">
	<div class="row">
		<div class="col-xs-12 col-md-6">
			
		</div>
		<div class="col-xs-12 col-md-6">
			<div class="text-right">
				<?php
				if (isset($tools) && is_array($tools) && isset($me) && isset($table_name)) {
					$action_toolbar = '<div class="btn btn-group">';
					$color 		= array('primary','default','info','warning','danger');
					$class_btn 	= '';
					$index		= 0;
					foreach ($tools as $key => $value) {
						$class_btn 	= 'btn btn-'.$color[0];
						
						if (isset($color[$index])) {
							$class_btn 	= 'btn btn-'.$color[$index];
						}
						
						if (strpos($value, '/') !== false) {
							$explode 	= explode('/', $value);
							$label 		= str_replace('_', ' ', $explode[1]);

							$action_toolbar .= anchor($value,ucfirst($label),array(
									'class'=>$class_btn
								)
							);
						}else{
							
							$url = $me.'/'.$value;
							if (in_array($value, array('tambah','edit','hapus'))) {
								$url .='/'.$table_name; 
							}
							$label 	= str_replace('_',' ', $value);
							$label 	= ucfirst($label);
							$action_toolbar .= anchor($url,$label,array(
								'class'=>$class_btn
								)
							);
						}

						$index++;
					}
					$action_toolbar .='</div>';
					echo $action_toolbar;
				}
		?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<?php echo (isset($alert))? $alert : '' ;?>
		</div>
	</div>
	<div class="row">
		
			<div class="col-xs-12">
			<?php if(isset($sources)) : ?>

<!--<div class="table-responsive">-->
	
	<table class="col-xs-12 rwd-table" id="gl-table" >
  	<thead class="thead-inverse " >
		<tr>
	  		<?php
	  			if (isset($columns)) {
	  				
	  				foreach ($columns as $key => $value) {
	  					if (isset($show) && in_array($value, $show)) {
	  						if (function_exists('set_datatables_column')) {
	  							echo '<th data-th="'.set_datatables_column($value).'">'.set_datatables_column($value).'</th>';
	  						}else{
	  							echo '<th data-th="'.set_datatables_column($value).'">'.$value.'</th>';
	  						}
	  					}elseif (!isset($show)) {
	  						if (function_exists('set_datatables_column')) {
	  							echo '<th data-th="'.set_datatables_column($value).'">'.set_datatables_column($value).'</th>';
	  						}else{
	  							echo '<th data-th="'.set_datatables_column($value).'">'.$value.'</th>';
	  						}
	  					}
	  				}
	  				echo '<th data-th="'.set_datatables_column($value).'">'.strtoupper('tindakan').'</th>';
	  			}
	  		?>
		</tr>

	</thead>
	<tbody>
		<?php
			if (isset($columns) && $sources && is_array($sources)) {
				foreach ($sources as $key => $value) {
					echo '<tr>';
		 			foreach ($columns as $k => $field) {
		 				
		 				if (isset($show) && in_array($field, $show)) { //&& isset($value[$field])
		 					echo '<td>';
		 					
		 					$data = ucwords($value[$field]);
		 					$len  = strlen($data);

		 					if (strpos($field,'harga_') !== false && $len > 0) {
		 						$data = show_currency_format($data);
		 					}
		 					echo (isset($data))? $data : '';
		 					echo  '</td>';
		 				}elseif (!isset($show)) {
		 					echo '<td>';
		 					echo (isset($value[$field]))? ucwords($value[$field]) : '';
		 					echo  '</td>';
		 				}
		 			}
		 			echo '<td>';
		 			$_id = 0;
		 			if (isset($primary_key)) {
		 				if (isset($value[$primary_key])) {
		 					$_id = $value[$primary_key];
		 				}
		 			}
		 			if (function_exists('set_datatables_action') && isset($group_id)) {
		 				if (isset($action[$group_id])) {
		 					set_datatables_action($action[$group_id],$_id,$value);
		 				}
		 			}
		 			echo '</td>';
		 			
		 			echo '</tr>';
				}
				
			} 
		?>	
	</tbody>
</table>

<!--</div>-->
	
<?php endif; ?>
		</div>
		</div>


	</div>
    <footer class="footer">
      <div class="text-center">
        	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php 
        		if (ENVIRONMENT === 'development') {
        			echo 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>';
        		}
        	?></p>
      </div>
</footer>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.2.1.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js');?>"> </script>
<script type="text/javascript" src="<?php echo base_url('assets/js/moment.min.js');?>"> </script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-datepicker.min.js');?>"> </script>  
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"> </script>
<script type="text/javascript" src="<?php echo base_url('assets/js/dataTables.bootstrap.min.js');?>"> </script>
<script type="text/javascript" src="<?php echo base_url('assets/custom/js/jvm.apek.js');?>"></script>
</body>
</html>