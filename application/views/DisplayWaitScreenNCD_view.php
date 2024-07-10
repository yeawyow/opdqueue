
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="refresh" content="120">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/main.css">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/font-awesome.min.css">
  <script src="<?php echo "http://".$_SERVER['HTTP_HOST'];?>:3000/socket.io/socket.io.js"></script> 
  
  <script type="text/javascript">
      var base_url = "<?php echo base_url();?>";
  </script>
  <style>
            
      tr{cursor: pointer; transition: all .25s ease-in-out}
      .selected{background-color: red; font-weight: bold; color: #fff;}
           
  </style>

</head>

<body class="app " >
  <!-- Navbar-->
  <header class="app-header">

    <ul class="app-nav">
      <li class="app-search">
        <h3 style="color:#FFFFFF;">คิวรอซักประว้ติ <?php echo getHospitalName();?></h3>
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
  <br />
    <div class="app-title">
      
        <div class="col-md-6 col-lg-6">
          <div class="widget-small primary coloured-icon" ><i class="icon" ><strong>1</strong></i>
              <div class="info" id="ch1" style="color:#003300;font-size:50px;"><strong></strong></div>
          </div>
          
          <div class="widget-small primary coloured-icon" ><i class="icon" ><strong>2</strong></i>
              <div class="info" id="ch2" style="color:#003300;font-size:50px;"><strong></strong></div>
          </div>
          <div class="widget-small primary coloured-icon" ><i class="icon" ><strong>3</strong></i>
              <div class="info" id="ch3" style="color:#003300;font-size:50px;"><strong></strong></div>
          </div>
          <div class="widget-small primary coloured-icon" ><i class="icon" ><strong>4</strong></i>
              <div class="info" id="ch4" style="color:#003300;font-size:50px;"><strong></strong></div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="table-responsive">
            <table class="table">
                <col style="width:15%">
                <col style="width:85%">
              <thead>
                <tr style="background-color: #db0e30;">
                  <th colspan="3" style="color:#FFFFFF;font-size:40px; text-align: center">เร่งด่วน</th>
                </tr>
              </thead>
              <tbody>
              <?php  foreach ($priority as $pri):?>
                <tr id="<?php  if($q->sub_queue == 'Y' && $q->call_queue == 'Y'){
                        echo $pri->main_dep_queue;
                      }else{
                        echo $pri->oqueue;
                      }?>" style="color:#FFFFFF;font-size:42px;background-color:#990000">
                  <td> <?php 
                      if($q->sub_queue == 'Y' && $q->call_queue == 'Y'){
                        echo $pri->main_dep_queue;
                      }else{
                        echo $pri->oqueue;
                      }
                    ?>
                  </td>
                  <td><strong class="<?php echo $pri->oqueue;?>"><?php echo $pri->ptname?></strong></td>
                  <td><strong id ="chanel_<?php echo $pri->hn;?>"></strong></td>
                </tr>
                    <?php endforeach;?>
              </tbody>
            </table>
          </div>

         <!--  <div class="col-md-12"> -->
          <div class="table-responsive">
            <table class="table" id="tblnormal">
                <col style="width:15%">
                <col style="width:85%">
              <thead>
                <tr style="background-color: #130ff8;">
                  <th colspan="3" style="color:#FFFFFF;font-size:40px; text-align: center">ปกติ</th>
                </tr>
              </thead>
              
              <tbody>
              <?php foreach ($pt as $item):?>
                <tr id="<?php if($q->sub_queue == 'Y' && $q->call_queue == 'Y'){
                        echo $item->main_dep_queue;
                      }else{
                        echo $item->oqueue;
                      }  ?>" style="color:#000000;font-size:42px;background-color:#e65c00">
                  <td >
                    <?php if($q->sub_queue == 'Y' && $q->call_queue == 'Y'){
                        echo $item->main_dep_queue;
                      }else{
                        echo $item->oqueue;
                      }                    
                    ?>
                    </td>
                  <td><strong class="<?php echo $item->oqueue;?>"><?php echo $item->ptname?></strong></td>
                  <td><strong id ="chanel_<?php echo $item->hn;?>"></strong></td>
                </tr>
              <?php endforeach;?>
              </tbody>
              
            </table>
          </div>

        <!-- </div> -->

        </div>
        
     
    </div> <!-- app-title -->
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
  
  socket.on("ncd",function ( data ){
    console.log(data);
    var ptname = document.getElementById(data.Queue).children[1].children[0].innerText;
    console.log(document.getElementById(data.Queue).children[1].children[0].innerText);
    if(data.Station==1){
      list = document.getElementById("ch1");
      list.removeChild(list.childNodes[0]);
      $('#ch1').append('<strong >'+ptname+'</strong>');
      //console.log(document.getElementById("ch1").childNodes[0].innerText);
      function blink_chanel1() {
          $('#ch1').fadeOut(2000);
          $('#ch1').fadeIn(1000);
      }
      setInterval(blink_chanel1, 1000);
    }else if(data.Station==2){
      list = document.getElementById("ch2");
      list.removeChild(list.childNodes[0]);
      $('#ch2').append('<strong >'+ptname+'</strong>');
      function blink_chanel2() {
          $('#ch2').fadeOut(2000);
          $('#ch2').fadeIn(1000);
      }
      setInterval(blink_chanel2, 1000);
    }else if(data.Station==3){
      list = document.getElementById("ch3");
      list.removeChild(list.childNodes[0]);
      $('#ch3').append('<strong >'+ptname+'</strong>');
      function blink_chanel3() {
          $('#ch3').fadeOut(2000);
          $('#ch3').fadeIn(1000);
      }
      setInterval(blink_chanel3, 1000);
    }else if(data.Station==4){
      list = document.getElementById("ch4");
      list.removeChild(list.childNodes[0]);
      $('#ch4').append('<strong >'+ptname+'</strong>');
      function blink_chanel4() {
          $('#ch4').fadeOut(2000);
          $('#ch4').fadeIn(1000);
      }
      setInterval(blink_chanel4, 1000);
    }

    
    if(data.CallQueue=='Y'){
      console.log('ใช้คิว');
      var queueNumber = data.Queue+'.mp3';
      var station = 'screen_'+data.Station+'.mp3';
      var queue = data.Queue; 
      console.log(queueNumber);
      var source =[ 
          base_url+"audio/"+queueNumber, 
          base_url+"audio/"+station
          ];

      play_sound_queue(source);

      function play_sound_queue(source) {
        var q = 0;
        function recursive_play() {
          
          if (q === source.length) {
          } else {
          
            play(source[q], function() {
                q++;
                recursive_play();
            });
          }
        }
        recursive_play(); 
      }


    }else{
      console.log('ใช้ชื่อ');
      var firstname = data.HN+'.mp3';
      var station = data.Station+'.mp3';
      var queue = data.Queue; 
      console.log(queue);
      var source =[ 
          base_url+"audio/"+firstname, 
          base_url+"audio/screen_"+station
          ];

      play_sound_queue(source);

      function play_sound_queue(source) {
        var q = 0;
        function recursive_play() {
          
          if (q === source.length) {
            //play(source[q], null);
            //alert(source[q]);
          } else {
          
            play(source[q], function() {
                q++;
                recursive_play();
            });
          }
        }
        recursive_play(); 
      }

    }
    
    function play(a, callback) {
      var audio = document.createElement("audio");
      audio.autoplay = true;
      audio.src = a;
      console.log(a);
      audio.addEventListener("load", function() {audio.play();}, true);
      audio.addEventListener('ended', callback);
    }
    $('#chanel_'+data.HN).html( data.Station );

    document.getElementById(queue).style.backgroundColor='#A0A0A4';
    console.log('xxx');
    //localStorage.setItem('Qselected', queue);  

    function blink_text() {
      $('.'+queue).fadeOut(500);
      $('.'+queue).fadeIn(500);
    }
    setInterval(blink_text, 5000);
    
  })

  /* 
  function myblink(){
    var q = localStorage.getItem("Qselected");  
    document.getElementById(q).style.backgroundColor='#A0A0A4'
      $('.'+q).fadeOut(500);
      $('.'+q).fadeIn(500);
    
  }
  setInterval(myblink, 5000);*/
  
  if(localStorage.getItem('QueueOrNameCalling')==null || localStorage.getItem('SubQueue')==null ){
        $.ajax({
              type: "POST",
              url: base_url+"index.php/Config/QueueOrNameCalling",
              dataType: 'json',
              success: 
                  function(data) {
                      console.log(data);
                      localStorage.setItem('QueueOrNameCalling', data[0].call_queue);
                      localStorage.setItem('SubQueue', data[0].sub_queue);
                      c = data[0].call_queue;
              }
          });
    }else{
      $.ajax({
        type: "POST",
        url: base_url+"index.php/Config/QueueOrNameCalling",
        dataType: 'json',
        success: 
            function(data) {
                if(localStorage.getItem('QueueOrNameCalling')!==data[0].call_queue||localStorage.getItem('SubQueue')!==data[0].sub_queue){
                  localStorage.setItem('QueueOrNameCalling', data[0].call_queue);
                  localStorage.setItem('SubQueue', data[0].sub_queue);
                }
        }
      });
    }
 

</script>
</body>

</html>
