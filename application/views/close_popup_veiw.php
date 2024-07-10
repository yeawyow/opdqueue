
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="refresh" content="300">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/main.css">
  <!-- Font-icon css-->
  <!-- <link rel="stylesheet" type="text/css" href="<?php // echo base_url();?>assets/css/font-awesome.min.css"> -->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src="<?php echo "http://".$_SERVER['HTTP_HOST'];?>:3000/socket.io/socket.io.js"></script> 
  


</head>

<body onload="myFunction()">
  
  <!-- Essential javascripts for application to work-->
  <script src="<?php echo base_url();?>assets/js/jquery-3.2.1.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="<?php echo base_url();?>assets/js/plugins/pace.min.js"></script>
  
<script>
    function myFunction() {
        // setTimeout("window.close()", 300);
        setTimeout("self.close();",100); 
    }
    
</script>

</body>

</html>