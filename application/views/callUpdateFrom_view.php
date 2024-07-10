
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/main.css">
  <!-- Font-icon css-->
  <!-- <link rel="stylesheet" type="text/css" href="<?php // echo base_url();?>assets/css/font-awesome.min.css"> -->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src="<?php echo "http://".$_SERVER['HTTP_HOST'];?>:3000/socket.io/socket.io.js"></script> 
  
  <script type="text/javascript">
      var base_url = "<?php echo base_url();?>";
  </script>
  <style>
            
      tr{cursor: pointer; transition: all .25s ease-in-out}
      .selected{background-color: red; font-weight: bold; color: #fff;}
           
  </style>

</head>

<body class="app ">
  <!-- Navbar-->
  <header class="app-header">

    <ul class="app-nav">
      <li class="app-search">
        <h3 style="color:#FFFFFF;">จัดการห้องตรวจ <?php echo getHospitalName();?></h3>
      </li>
      <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i
            class="fa fa-user fa-lg"></i></a>
        <ul class="dropdown-menu settings-menu dropdown-menu-right">
          <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
          <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-user fa-lg"></i> Profile</a></li>
          <li><a class="dropdown-item" href="page-login.html"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
        </ul>
      </li>
    </ul>
  </header>
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>

  <main class="app-content">
    <div class="app-title">
      <!-- <div class="row">  -->
      <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">แก้ไขเลขห้อง</h3>
            <?php foreach ($dep as $item):?>
            <form class="form-horizontal"  action="<?php echo base_url();?>index.php/UpdateRoomNo/update" method="post">
            <div class="tile-body">
                <div class="form-group row">
                  <label class="control-label col-md-3">รหัสแผนก</label>
                  <div class="col-md-8">
                    <input class="form-control col-md-8" type="text" name ="depcode" value="<?php echo $item->depcode;?>" readonly="" >
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">ชื่อห้อง</label>
                  <div class="col-md-8">
                  <input class="form-control col-md-8" type="text" value="<?php echo $item->department;?>" readonly="" >
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">หมายเลขห้อง</label>
                  <div class="col-md-8">
                  <input class="form-control col-md-8" type="text" name = "roomno">
                  </div>
                </div>
                
             
              <?php endforeach;?>
            </div>
            <div class="tile-footer">
              <div class="row">
                <div class="col-md-8 col-md-offset-3">
                  <button class="btn btn-primary"type="submit">
                  <i class="fa fa-fw fa-lg fa-check-circle"></i>บันทึก</button>
                  &nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#">
                  <i class="fa fa-fw fa-lg fa-times-circle"></i>ยกเลิก</a>
                </div>
              </div>
            </div>
            </form>
          </div>
        </div>
      <!--  two table -->
      
      <!--  </div> -->

    </div>
  </main>
  <!-- Essential javascripts for application to work-->
  <script src="<?php echo base_url();?>assets/js/jquery-3.2.1.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="<?php echo base_url();?>assets/js/plugins/pace.min.js"></script>
  <!-- Page specific javascripts-->
  <!-- Google analytics script-->
  <script type="text/javascript">
    if (document.location.hostname == 'pratikborsadiya.in') {
      (function (i, s, o, g, r, a, m) {
      i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
        (i[r].q = i[r].q || []).push(arguments)
      }, i[r].l = 1 * new Date(); a = s.createElement(o),
        m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
      })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
      ga('create', 'UA-72504830-1', 'auto');
      ga('send', 'pageview');
    }
  </script>
 
</body>

</html>
