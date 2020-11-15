<!DOCTYPE html>
<html>
<head>
	<title>hello</title>
</head>
<body>
<audio id="notif_audio"><source src="<?php echo base_url('sounds/notify.ogg');?>" type="audio/ogg">
	<source src="<?php echo base_url('sounds/notify.mp3');?>" type="audio/mpeg"><source src="<?php echo base_url('sounds/notify.wav');?>" type="audio/wav">
</audio>
<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/');?>push.js/bin/push.min.js"></script>
<script src="<?php echo base_url('socket.io-client/socket.io.js');?>"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	var socket = io.connect( 'http://'+window.location.hostname+':3001' );

  	//socket.on( 'new_count_message', function( data ) {
  	socket.on( 'new_message', function( data ) {
  		console.log(data);
  		//alert(data.new_count_message);
      	//$( "#new_count_message" ).html( data.new_count_message );
      	Push.create(data.title + ' from'+data.name, {
			body: data.message,
			timeout: 4000,
			onClick: function () {
				//window.focus();
				window.open(data.url); 
				this.close();
			}
		});
      	$('#notif_audio')[0].play();
  	});
});
</script>
</body>
</html>