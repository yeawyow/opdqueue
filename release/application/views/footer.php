
    <!-- Essential javascripts for application to work-->
    <script src="<?php echo base_url();?>assets/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?php echo base_url();?>assets/js/plugins/pace.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/plugins/select2.min.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/chart.js"></script>
   
	<script src="<?php echo "http://".$_SERVER['HTTP_HOST'];?>:3000/socket.io/socket.io.js"></script> 
	<script type="text/javascript">
	$('#demoSelect').select2();
	$('#save').click(function(){
		//console.log( $("#demoSelect").val() );
		var dep = $("#demoSelect").val();
		console.log(dep);
		$.ajax({
			type: "POST",
			url: base_url+"index.php/Config/postDepartment",
			dataType: 'json',
			data: {dep:dep},
			success: 
				function(data) {
					if(data==1){
						alert("บันทึกข้อมูลแล้ว!!");
					}
				}
		});
	});
	
	$('#docSelect').select2();
	$('#DocSave').click(function(){
		//console.log( $("#demoSelect").val() );
		var dep = $("#docSelect").val();
		console.log(dep);
		$.ajax({
			type: "POST",
			url: base_url+"index.php/Config/postDocDept",
			dataType: 'json',
			data: {dep:dep},
			success: 
				function(data) {
					if(data==1){
						alert("บันทึกข้อมูลแล้ว!!");
					}
				}
		});
	});

	$('#NCDSelect').select2();
	$('#NCDSave').click(function(){
		//console.log( $("#NCDSelect").val() );
		var dep = $("#NCDSelect").val();
		console.log(dep);
		$.ajax({
			type: "POST",
			url: base_url+"index.php/Config/postNCDClinic",
			dataType: 'json',
			data: {dep:dep},
			success: 
				function(data) {
					if(data==1){
						alert("บันทึกข้อมูลแล้ว!!");
					}
				}
		}); 
	});

	$('#drugsubmit').click(function(){
		//console.log( $("#demoSelect").val() );
		var dq = $("#DrugSelect").val();
		console.log(dq);
		$.ajax({
			type: "POST",
			url: base_url+"index.php/Config/postDurgQueue",
			dataType: 'json',
			data: {drug_queue:dq},
			success: 
				function(data) {
					if(data==1){
						alert("บันทึกข้อมูลแล้ว!!");
					}
				}
		});
	});

		  
	var socket = io.connect( 'http://'+window.location.hostname+':3000' );
	$('#submit').click(function(){
		
		var a = document.getElementById("Select1").value;
		//var hn = document.getElementById("hn").value;
	    console.log(a);
		$.ajax({
			type: "POST",
			url: base_url+"index.php/Config/updateconfig",
			dataType: 'json',
			data: {callq:a},
			success: 
				function(data) {
					if(data==1){
						alert("บันทึกข้อมูลแล้ว!!");
					}
				
				}
		});
	});

	$('#submitHN').click(function(){
		
		//var a = document.getElementById("Select1").value;
		var hn = document.getElementById("hn").value;
	    console.log(hn);
		$.ajax({
			type: "POST",
			url: base_url+"index.php/Config/updatehn_len",
			dataType: 'json',
			data: {hn:hn},
			success: 
				function(data) {
					if(data==1){
						alert("บันทึกข้อมูลแล้ว!!");
					}
				
				}
		});
	});

	$('#submitSubQ').click(function(){
		
		//var a = document.getElementById("Select1").value;
		var subq = document.getElementById("subqueue").value;
	    console.log(subq);
		$.ajax({
			type: "POST",
			url: base_url+"index.php/Config/updatesub_queue",
			dataType: 'json',
			data: {sub_queue:subq},
			success: 
				function(data) {
					if(data==1){
						alert("บันทึกข้อมูลแล้ว!!");
					}
				
				}
		});
	});


	$('#num').click(function(){
		socket.emit('loadFile', {  
          number: 'num'
        });
	});

	$('#name').click(function(){
		console.log('name');
		socket.emit('loadFile', {  
          number: 'name'
        });
	});

	
	</script>

    <!-- Google analytics script-->
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
      	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      	ga('create', 'UA-72504830-1', 'auto');
      	ga('send', 'pageview');
      }
    </script>
  </body>
</html>