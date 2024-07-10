
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="refresh" content="120">
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
        <h3 style="color:#FFFFFF;">รอรับยา โรงพยาบาลวานรนิวาส</h3>
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
      <div class="col-md-12">

        <div class="table-responsive">
          <!-- <div class="table-responsive"></div> -->
         
          <table class="table">
              <col style="width:15%">
              <col style="width:85%">
              
            <?php foreach ($pt as $item):?>
            <tbody>
              <tr class="table "style="color:#FFFFFF;font-size:48px; background-color:#003300">
                <td><?php echo $item->oqueue;?></td>
                <td>
                  <strong>
                    <?php echo $item->ptname?>
                  </strong>&nbsp
                </td>
                
              </tr>
             
            </tbody>
            <?php endforeach;?>
          </table>
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
  <audio>  </audio>
<script> 
  var socket = io.connect( 'http://'+window.location.hostname+':3000' );
      socket.on("refesh_phama_queue",function ( data ){
          if(data.refesh=='refesh'){
            location.reload();
          }
      })

    socket.on("call_to_phama_room2",function ( data ){
        console.log(data);
        var firstname = data.fname+'.mp3';
        var lastname = data.lname+'.mp3';
        var station = data.station+'.mp3';
        $("<audio></audio>").attr({
        'src':base_url+'audio/เชิญคุณ.mp3',
        'volume':0.4,
        'autoplay':'autoplay'
        }).appendTo("body");  

        setTimeout(function() {
        $("<audio></audio>").attr({
            'src':base_url+'audio/'+firstname,
            'volume':0.4,
            'autoplay':'autoplay'
            }).appendTo("body");
        },1000);
        
        setTimeout(function() {
        $("<audio></audio>").attr({
            'src':base_url+'audio/'+lastname,
            'volume':0.4,
            'autoplay':'autoplay'
            }).appendTo("body");
        },2000);

        setTimeout(function(){
        $("<audio></audio>").attr({
        'src':base_url+'audio/รับยาช่อง.mp3',
        'volume':0.4,
        'autoplay':'autoplay'
        }).appendTo("body");
        },3000);

        setTimeout(function(){
        $("<audio></audio>").attr({
        'src':base_url+'audio/'+station,
        'volume':0.4,
        'autoplay':'autoplay'
        }).appendTo("body");
        },4500);

        setTimeout(function(){
        $("<audio></audio>").attr({
        'src':base_url+'audio/คะ.mp3',
        'volume':0.4,
        'autoplay':'autoplay'
        }).appendTo("body");
        },5500);
    
    })  
    


    
</script>
</body>

</html>