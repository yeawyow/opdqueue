
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- <meta http-equiv="refresh" content="120"> -->
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
      .ch1 .ch2 .ch3 .ch4 .ch5 .ch6 .ch7 .ch8 .ch9 .ch10{background-color:#FFFFFF;}
      .n1 {background-color:#00cc00}
      .p1 {background-color:#FF9900;}
      .p2 {background-color:#f00000;}
      .x11 {background-color:#FF6347;}
      .c1 {background-color:#ffffff;}

      .x1 {background-color:#FF6347;}
      .c1 {background-color:#ffffff;}
      .x2 {background-color:#FF6347;}
      .c2 {background-color:#ffffff;}
      .x3 {background-color:#FF6347;}
      .c3 {background-color:#ffffff;}
      .x4 {background-color:#FF6347;}
      .c4 {background-color:#ffffff;}
      .x5 {background-color:#FF6347;}
      .c5 {background-color:#ffffff;}
      .x6 {background-color:#FF6347;}
      .c6 {background-color:#ffffff;}
      .x7 {background-color:#FF6347;}
      .c7 {background-color:#ffffff;}
      .x8 {background-color:#FF6347;}
      .c8 {background-color:#ffffff;}
      .x9 {background-color:#FF6347;}
      .c9 {background-color:#ffffff;}
      .x10 {background-color:#FF6347;}
      .c10 {background-color:#ffffff;}

      .jrotate {
        animation: rotation 5s infinite linear;
      }

      @keyframes rotation {
        from {
          transform: rotate(0deg);
        }
        to {
          transform: rotate(359deg);
        }
      }       
  </style>

</head>

<body class="app ">
  <!-- Navbar-->
  <header class="app-header">

    <ul class="app-nav">
      <li class="app-search">
        <h3 style="color:#FFFFFF;">รอรับบริการห้องฉุกเฉิน <?php echo getHospitalName();?></h3>
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
    <div  class="col-md-6 col-lg-8">
      <div  class="row">
        <div class="col-md-6 ">
            <div class="widget-small primary coloured-icon" ><i class="icon" ><strong>1</strong></i>
              <div class="info ch1" id="ch1" style="color:#003300;font-size:50px;">
                <strong></strong>
              </div>
            </div>
            <div class="widget-small primary coloured-icon" ><i class="icon" ><strong>2</strong></i>
              <div class="info ch2" id="ch2" style="color:#003300;font-size:50px;"><strong></strong></div>
            </div>
            <div class="widget-small primary coloured-icon" ><i class="icon" ><strong>3</strong></i>
              <div class="info ch3" id="ch3" style="color:#003300;font-size:50px;"><strong></strong></div>
            </div>
            <div class="widget-small primary coloured-icon" ><i class="icon" ><strong>4</strong></i>
                <div class="info ch4" id="ch4" style="color:#003300;font-size:50px;"><strong></strong></div>
            </div>
            <div class="widget-small primary coloured-icon" ><i class="icon" ><strong>5</strong></i>
                <div class="info ch5" id="ch5" style="color:#003300;font-size:50px;"><strong></strong></div>
            </div>
        </div>
        <div class="col-md-6">
            
            <div class="widget-small primary coloured-icon" ><i class="icon" ><strong>6</strong></i>
                <div class="info ch6" id="ch6" style="color:#003300;font-size:50px;"><strong></strong></div>
            </div>
            <div class="widget-small primary coloured-icon" ><i class="icon" ><strong>7</strong></i>
              <div class="info ch7" id="ch7" style="color:#003300;font-size:50px;"><strong></strong></div>
            </div>
            <div class="widget-small primary coloured-icon" ><i class="icon" ><strong>8</strong></i>
                <div class="info ch8" id="ch8" style="color:#003300;font-size:50px;"><strong></strong></div>
            </div>
            <div class="widget-small primary coloured-icon" ><i class="icon" ><strong>9</strong></i>
                <div class="info ch9" id="ch9" style="color:#003300;font-size:50px;"><strong></strong></div>
            </div>
            <div class="widget-small primary coloured-icon" ><i class="icon" ><strong>10</strong></i>
                <div class="info  ch10" id="ch10" style="color:#003300;font-size:50px;"><strong></strong></div>
            </div> 
        </div>
      </div><!--//end row -->

      
    </div><!-- // end <div  class="col-md-6 col-lg-8">-->

      <!-- <div class="row">  -->
      <div class="col-md-4">
        <div class="table-responsive">
          <!-- <div class="table-responsive"></div> -->
          <table class="table" >
              <col style="width:15%">
              <col style="width:85%">
              
            <thead>
              <tr style="background-color: #0000b3;">
                <th colspan="3" style="color:#FFFFFF;font-size:32px; text-align: center">ผู้รอรับบริการ</th>
              </tr>
            </thead>
            
            <tbody>
            <?php  foreach ($priority as $pri):?>
                <tr id="<?php if($q->sub_queue == 'Y' && $q->call_queue == 'Y'){
                    echo $pri->main_dep_queue;}else{ echo $pri->oqueue;}?>"
                  <?php 
                    if($pri->erlevel == 1){
                      echo 'style="color:#FFFFFF;font-size:36px;background-color:#C90101"';
                      echo ' class="p2"';
                    }else if($pri->erlevel == 2){
                      echo 'style="color:#000000;font-size:36px;background-color:#FF6C02"';
                      echo ' class="p1"';
                    }else if($pri->erlevel == 3){
                      echo 'style="color:#000000;font-size:36px;background-color:#FFFE03"';
                      echo ' class="p1"';
                    }else if($pri->erlevel == 4){
                      echo 'style="color:#000000;font-size:36px;background-color:#6CFF35"';
                      echo ' class="p1"';
                    }else if($pri->erlevel == 5){
                    echo 'style="color:#000000;font-size:36px;background-color:#FFFFFF"';
                    echo ' class="p1"';
                    }
                    ?>>
                  <td> <?php 
                      if($q->sub_queue == 'Y' && $q->call_queue == 'Y'){
                        echo $pri->main_dep_queue;
                      }else{
                        echo $pri->oqueue;
                      }
                    ?>
                  </td>
                  <td><strong class="<?php echo $pri->oqueue;?>"><?php echo $pri->ptname?></strong>&nbsp
                    <?php 
                      if($pri->lab_count !='' && $pri->report_count !=''){
                        if($pri->lab_count > $pri->report_count){
                            echo '<img src="'.base_url().'assets/img/flask.png" class="jrotate" height="32" width="32">';
                        }else if($pri->lab_count == $pri->report_count){
                            echo '<img src="'.base_url().'assets/img/flask.png" height="32" width="32">';
                        } 
                      }
                        echo '&nbsp';
                        if($pri->confirm_all=='N'){
                          echo '<img src="'.base_url().'assets/img/radiation.png" class="jrotate" height="32" width="32">';
                        }else if($pri->confirm_all=='Y'){
                            echo '<img class="app-sidebar__user-avatar" src="'.base_url().'assets/img/radiation.png" height="32" width="32">';  
                        }
                      
                    ?>
                  </td>
                  <td><strong id ="chanel_<?php echo $pri->hn;?>"></strong></td>
                </tr>
                    <?php endforeach;?>
              </tbody>
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
<script type="text/javascript">
  var socket = io.connect( 'http://'+window.location.hostname+':3000' );
  socket.on("er_serv",function ( data ){
    console.log(data);
    var fullName = $('.'+data.queue).parent().children(0).html().trim();

    var onbed = JSON.parse(localStorage.getItem("onbed"));
    onbed.items.push(fullName);
    localStorage.setItem('onbed', JSON.stringify(onbed));

    var onbed = JSON.parse(localStorage.getItem("onbed"));
    console.log('length::',onbed.items.length)
    l=1;
    for(i=0;i<=10;i++){
      if (i === onbed.items.length) { break; }
      localStorage.setItem('d'+l,onbed.items[i])
      l++;
    }
    location.reload();
  
  })

  socket.on("callER_Patient",function ( data ){
    console.log(data);
    var cartItems = JSON.parse(localStorage.getItem("productsInCart"));
    cartItems.items.push(data);
    localStorage.setItem('productsInCart', JSON.stringify(cartItems));
    var cartItems = JSON.parse(localStorage.getItem("productsInCart"));
    jong();
  })

  function jong(){
    jong = function(){};
    calltocall();
  }

  function calltocall(){
    //calltocall = function(){};
    var cartItems = JSON.parse(localStorage.getItem("productsInCart"));
    if(cartItems.items[0]['relative'] == 'Y'){
      var firstname = 'f_'+cartItems.items[0]['HN']+'.mp3';
    }else if(cartItems.items[0]['relative'] == 'N'){
      var firstname = cartItems.items[0]['HN']+'.mp3';
    }
    
    var queueNumber = cartItems.items[0]['Queue']+'.mp3';
    var station = 'er.mp3';
    var queue = cartItems.items[0]['Queue'];
    var callqueue = localStorage.getItem('QueueOrNameCalling') 
    
    
    getItem();
    cartItems.items.shift();
    localStorage.setItem('productsInCart', JSON.stringify(cartItems));
    

    if(callqueue=='Y'){
      console.log('ใช้คิว');
      var source =[ 
        base_url+"audio/"+queueNumber, 
        base_url+"audio/"+station
        ];
      play_sound_queue(source);
    }else{
      var source =[ 
        base_url+"audio/"+firstname, 
        base_url+"audio/"+station
        ];
      
      play_sound_queue(source);
    }
  
  } 


  function play_sound_queue(source) {
    var q = 0;
    localStorage.setItem('endQ', 0);
    
    function recursive_play() {

      if (q == source.length) {
        var x = JSON.parse(localStorage.getItem("productsInCart"));
        localStorage.setItem('endQ', q);
        
        if(x.items.length == 0){
          location.reload();
        }else{
          calltocall();
        }
        
      } else {
      
        play(source[q], function() {
            q++;
            recursive_play();
        });
      
      }
      
    }
    
    recursive_play();

  }

  function play(a, callback) {
    var audio = document.createElement("audio");
    audio.autoplay = true;
    audio.src = a;
    audio.addEventListener("load", function() {audio.play();}, true);
    audio.addEventListener('ended', callback);
  }   
  
  function getItem(){
    
    var cartItems = JSON.parse(localStorage.getItem("productsInCart"));

    var ptname = document.getElementById(cartItems.items[0]['Queue']).children[1].children[0].innerText;
    console.log('ptname::',document.getElementById(cartItems.items[0]['Queue']).children[1].children[0].innerText);
    if(cartItems.items[0]['station']==1){
      if(localStorage.getItem('d2')==ptname){
        localStorage.setItem('d2', '');
      }
      if(localStorage.getItem('d3')==ptname){
        localStorage.setItem('d3', '');
      }
      if(localStorage.getItem('d4')==ptname){
        localStorage.setItem('d4', '');
      }
      if(localStorage.getItem('d5')==ptname){
        localStorage.setItem('d5', '');
      }
      if(localStorage.getItem('d6')==ptname){
        localStorage.setItem('d6', '');
      }
      if(localStorage.getItem('d7')==ptname){
        localStorage.setItem('d7', '');
      }
      if(localStorage.getItem('d8')==ptname){
        localStorage.setItem('d8', '');
      }
      if(localStorage.getItem('d9')==ptname){
        localStorage.setItem('d9', '');
      }
      if(localStorage.getItem('d10')==ptname){
        localStorage.setItem('d10', '');
      }

      localStorage.setItem('d1', ptname);
      document.getElementById('ch1').children[1].innerText = localStorage.getItem('d1');
      $('.info').addClass('x11');

      var i = 0;
      var a = setInterval(function(){
        if(i==10){clearInterval(a)}
        if ($('.x11').hasClass('c1')){
            $('.x11').removeClass('c1');
        }else{
            $('.x11').addClass('c1');
        }
        i++;
      },1000);
    }else if(cartItems.items[0]['station']==2){
      if(localStorage.getItem('d1')==ptname){
        localStorage.setItem('d1', '');
      }
      if(localStorage.getItem('d3')==ptname){
        localStorage.setItem('d3', '');
      }
      if(localStorage.getItem('d4')==ptname){
        localStorage.setItem('d4', '');
      }
      if(localStorage.getItem('d5')==ptname){
        localStorage.setItem('d5', '');
      }
      if(localStorage.getItem('d6')==ptname){
        localStorage.setItem('d6', '');
      }
      if(localStorage.getItem('d7')==ptname){
        localStorage.setItem('d7', '');
      }
      if(localStorage.getItem('d8')==ptname){
        localStorage.setItem('d8', '');
      }
      if(localStorage.getItem('d9')==ptname){
        localStorage.setItem('d9', '');
      }
      if(localStorage.getItem('d10')==ptname){
        localStorage.setItem('d10', '');
      }

      localStorage.setItem('d2', ptname);
      document.getElementById('ch2').children[1].innerText = localStorage.getItem('d2');
      $('.info').addClass('x11');

      var i = 0;
      var a = setInterval(function(){
        if(i==10){clearInterval(a)}
        if ($('.x11').hasClass('c1')){
            $('.x11').removeClass('c1');
        }else{
            $('.x11').addClass('c1');
        }
        i++;
      },1000);
    }else if(cartItems.items[0]['station']==3){
      if(localStorage.getItem('d2')==ptname){
        localStorage.setItem('d2', '');
      }
      if(localStorage.getItem('d1')==ptname){
        localStorage.setItem('d1', '');
      }
      if(localStorage.getItem('d4')==ptname){
        localStorage.setItem('d4', '');
      }
      if(localStorage.getItem('d5')==ptname){
        localStorage.setItem('d5', '');
      }
      if(localStorage.getItem('d6')==ptname){
        localStorage.setItem('d6', '');
      }
      if(localStorage.getItem('d7')==ptname){
        localStorage.setItem('d7', '');
      }
      if(localStorage.getItem('d8')==ptname){
        localStorage.setItem('d8', '');
      }
      if(localStorage.getItem('d9')==ptname){
        localStorage.setItem('d9', '');
      }
      if(localStorage.getItem('d10')==ptname){
        localStorage.setItem('d10', '');
      }
      
      localStorage.setItem('d3', ptname);
      document.getElementById('ch3').children[1].innerText = localStorage.getItem('d3');
      $('.info').addClass('x11');
      var i = 0;
      var a = setInterval(function(){
        if(i==10){clearInterval(a)}
        if ($('.x11').hasClass('c1')){
            $('.x11').removeClass('c1');
        }else{
            $('.x11').addClass('c1');
        }
        i++;
      },1000);
      
    }else if(cartItems.items[0]['station']==4){
      if(localStorage.getItem('d2')==ptname){
        localStorage.setItem('d2', '');
      }
      if(localStorage.getItem('d3')==ptname){
        localStorage.setItem('d3', '');
      }
      if(localStorage.getItem('d1')==ptname){
        localStorage.setItem('d1', '');
      }
      if(localStorage.getItem('d5')==ptname){
        localStorage.setItem('d5', '');
      }
      if(localStorage.getItem('d6')==ptname){
        localStorage.setItem('d6', '');
      }
      if(localStorage.getItem('d7')==ptname){
        localStorage.setItem('d7', '');
      }
      if(localStorage.getItem('d8')==ptname){
        localStorage.setItem('d8', '');
      }
      if(localStorage.getItem('d9')==ptname){
        localStorage.setItem('d9', '');
      }
      if(localStorage.getItem('d10')==ptname){
        localStorage.setItem('d10', '');
      }

      localStorage.setItem('d4', ptname);
      document.getElementById('ch4').children[1].innerText = localStorage.getItem('d4');
      $('.info').addClass('x11');

      var i = 0;
      var a = setInterval(function(){
        if(i==10){clearInterval(a)}
        if ($('.x11').hasClass('c1')){
            $('.x11').removeClass('c1');
        }else{
            $('.x11').addClass('c1');
        }
        i++;
      },1000);
      
    }else if(cartItems.items[0]['station']==5){
      if(localStorage.getItem('d2')==ptname){
        localStorage.setItem('d2', '');
      }
      if(localStorage.getItem('d3')==ptname){
        localStorage.setItem('d3', '');
      }
      if(localStorage.getItem('d4')==ptname){
        localStorage.setItem('d4', '');
      }
      if(localStorage.getItem('d1')==ptname){
        localStorage.setItem('d1', '');
      }
      if(localStorage.getItem('d6')==ptname){
        localStorage.setItem('d6', '');
      }
      if(localStorage.getItem('d7')==ptname){
        localStorage.setItem('d7', '');
      }
      if(localStorage.getItem('d8')==ptname){
        localStorage.setItem('d8', '');
      }
      if(localStorage.getItem('d9')==ptname){
        localStorage.setItem('d9', '');
      }
      if(localStorage.getItem('d10')==ptname){
        localStorage.setItem('d10', '');
      }

      localStorage.setItem('d5', ptname);
      document.getElementById('ch5').children[1].innerText = localStorage.getItem('d5');
      $('.info').addClass('x11');

      var i = 0;
      var a = setInterval(function(){
        if(i==10){clearInterval(a)}
        if ($('.x11').hasClass('c1')){
            $('.x11').removeClass('c1');
        }else{
            $('.x11').addClass('c1');
        }
        i++;
      },1000);
    }else if(cartItems.items[0]['station']==6){
      if(localStorage.getItem('d2')==ptname){
        localStorage.setItem('d2', '');
      }
      if(localStorage.getItem('d3')==ptname){
        localStorage.setItem('d3', '');
      }
      if(localStorage.getItem('d4')==ptname){
        localStorage.setItem('d4', '');
      }
      if(localStorage.getItem('d5')==ptname){
        localStorage.setItem('d5', '');
      }
      if(localStorage.getItem('d1')==ptname){
        localStorage.setItem('d1', '');
      }
      if(localStorage.getItem('d7')==ptname){
        localStorage.setItem('d7', '');
      }
      if(localStorage.getItem('d8')==ptname){
        localStorage.setItem('d8', '');
      }
      if(localStorage.getItem('d9')==ptname){
        localStorage.setItem('d9', '');
      }
      if(localStorage.getItem('d10')==ptname){
        localStorage.setItem('d10', '');
      }

      localStorage.setItem('d6', ptname);
      document.getElementById('ch6').children[1].innerText = localStorage.getItem('d6');
      $('.info').addClass('x11');

      var i = 0;
      var a = setInterval(function(){
        if(i==10){clearInterval(a)}
        if ($('.x11').hasClass('c1')){
            $('.x11').removeClass('c1');
        }else{
            $('.x11').addClass('c1');
        }
        i++;
      },1000);
    }else if(cartItems.items[0]['station']==7){
      if(localStorage.getItem('d2')==ptname){
        localStorage.setItem('d2', '');
      }
      if(localStorage.getItem('d3')==ptname){
        localStorage.setItem('d3', '');
      }
      if(localStorage.getItem('d4')==ptname){
        localStorage.setItem('d4', '');
      }
      if(localStorage.getItem('d5')==ptname){
        localStorage.setItem('d5', '');
      }
      if(localStorage.getItem('d6')==ptname){
        localStorage.setItem('d6', '');
      }
      if(localStorage.getItem('d1')==ptname){
        localStorage.setItem('d1', '');
      }
      if(localStorage.getItem('d8')==ptname){
        localStorage.setItem('d8', '');
      }
      if(localStorage.getItem('d9')==ptname){
        localStorage.setItem('d9', '');
      }
      if(localStorage.getItem('d10')==ptname){
        localStorage.setItem('d10', '');
      }
      localStorage.setItem('d7', ptname);
      document.getElementById('ch7').children[1].innerText = localStorage.getItem('d7');
      $('.info').addClass('x11');

      var i = 0;
      var a = setInterval(function(){
        if(i==10){clearInterval(a)}
        if ($('.x11').hasClass('c1')){
            $('.x11').removeClass('c1');
        }else{
            $('.x11').addClass('c1');
        }
        i++;
      },1000);
    }else if(cartItems.items[0]['station']==8){
      if(localStorage.getItem('d2')==ptname){
        localStorage.setItem('d2', '');
      }
      if(localStorage.getItem('d3')==ptname){
        localStorage.setItem('d3', '');
      }
      if(localStorage.getItem('d4')==ptname){
        localStorage.setItem('d4', '');
      }
      if(localStorage.getItem('d5')==ptname){
        localStorage.setItem('d5', '');
      }
      if(localStorage.getItem('d6')==ptname){
        localStorage.setItem('d6', '');
      }
      if(localStorage.getItem('d7')==ptname){
        localStorage.setItem('d7', '');
      }
      if(localStorage.getItem('d1')==ptname){
        localStorage.setItem('d1', '');
      }
      if(localStorage.getItem('d9')==ptname){
        localStorage.setItem('d9', '');
      }
      if(localStorage.getItem('d10')==ptname){
        localStorage.setItem('d10', '');
      }

      localStorage.setItem('d8', ptname);
      document.getElementById('ch8').children[1].innerText = localStorage.getItem('d8');
      $('.info').addClass('x11');

      var i = 0;
      var a = setInterval(function(){
        if(i==10){clearInterval(a)}
        if ($('.x11').hasClass('c1')){
            $('.x11').removeClass('c1');
        }else{
            $('.x11').addClass('c1');
        }
        i++;
      },1000);
    }else if(cartItems.items[0]['station']==9){
      if(localStorage.getItem('d2')==ptname){
        localStorage.setItem('d2', '');
      }
      if(localStorage.getItem('d3')==ptname){
        localStorage.setItem('d3', '');
      }
      if(localStorage.getItem('d4')==ptname){
        localStorage.setItem('d4', '');
      }
      if(localStorage.getItem('d5')==ptname){
        localStorage.setItem('d5', '');
      }
      if(localStorage.getItem('d6')==ptname){
        localStorage.setItem('d6', '');
      }
      if(localStorage.getItem('d7')==ptname){
        localStorage.setItem('d7', '');
      }
      if(localStorage.getItem('d8')==ptname){
        localStorage.setItem('d8', '');
      }
      if(localStorage.getItem('d1')==ptname){
        localStorage.setItem('d1', '');
      }
      if(localStorage.getItem('d10')==ptname){
        localStorage.setItem('d10', '');
      }
      localStorage.setItem('d9', ptname);
      document.getElementById('ch9').children[1].innerText = localStorage.getItem('d9');
      $('.info').addClass('x11');

      var i = 0;
      var a = setInterval(function(){
        if(i==10){clearInterval(a)}
        if ($('.x11').hasClass('c1')){
            $('.x11').removeClass('c1');
        }else{
            $('.x11').addClass('c1');
        }
        i++;
      },1000);
    }else if(cartItems.items[0]['station']==10){
      if(localStorage.getItem('d2')==ptname){
        localStorage.setItem('d2', '');
      }
      if(localStorage.getItem('d3')==ptname){
        localStorage.setItem('d3', '');
      }
      if(localStorage.getItem('d4')==ptname){
        localStorage.setItem('d4', '');
      }
      if(localStorage.getItem('d5')==ptname){
        localStorage.setItem('d5', '');
      }
      if(localStorage.getItem('d6')==ptname){
        localStorage.setItem('d6', '');
      }
      if(localStorage.getItem('d7')==ptname){
        localStorage.setItem('d7', '');
      }
      if(localStorage.getItem('d8')==ptname){
        localStorage.setItem('d8', '');
      }
      if(localStorage.getItem('d9')==ptname){
        localStorage.setItem('d9', '');
      }
      if(localStorage.getItem('d1')==ptname){
        localStorage.setItem('d1', '');
      }

      localStorage.setItem('d10', ptname);
      document.getElementById('ch10').children[1].innerText = localStorage.getItem('d10');
      $('.info').addClass('x11');

      var i = 0;
      var a = setInterval(function(){
        if(i==10){clearInterval(a)}
        if ($('.x11').hasClass('c1')){
            $('.x11').removeClass('c1');
        }else{
            $('.x11').addClass('c1');
        }
        i++;
      },1000);
    }
  } 
    
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
<script type="text/javascript">
   if(localStorage.getItem('d1')==null){
    localStorage.setItem('d1','');
  }
   if(localStorage.getItem('d2')==null){
    localStorage.setItem('d2','');
  }
   if(localStorage.getItem('d3')==null){
    localStorage.setItem('d3','');
  }
   if(localStorage.getItem('d4')==null){
    localStorage.setItem('d4','');
  }
   if(localStorage.getItem('d5')==null){
    localStorage.setItem('d5','');
  }
   if(localStorage.getItem('d6')==null){
    localStorage.setItem('d6','');
  }
   if(localStorage.getItem('d7')==null){
    localStorage.setItem('d7','');
  }
   if(localStorage.getItem('d8')==null){
    localStorage.setItem('d8','');
  }
   if(localStorage.getItem('d9')==null){
    localStorage.setItem('d9','');
  }
   if(localStorage.getItem('d10')==null){
    localStorage.setItem('d10','');
  }

/*
  var users = <?php echo json_encode($priority); ?>;
  displayPT = [];
  for(i=0;i<users.length;i++){
    displayPT.push(users[i].ptname.replace(/\s+/g, ''));
  }
  
  //console.log('displayPT:',displayPT);
  d1 = localStorage.getItem('d1').replace(/\s+/g, '');
  if(displayPT.indexOf(d1) != -1){}else{localStorage.setItem('d1','');}
  d2 = localStorage.getItem('d2').replace(/\s+/g, '');
  if(displayPT.indexOf(d2) != -1){}else{localStorage.setItem('d2','');}
  d3 = localStorage.getItem('d3').replace(/\s+/g, '');
  if(displayPT.indexOf(d3) != -1){}else{localStorage.setItem('d3','');}
  d4 = localStorage.getItem('d4').replace(/\s+/g, '');
  if(displayPT.indexOf(d4) != -1){}else{localStorage.setItem('d4','');}
  d5 = localStorage.getItem('d5').replace(/\s+/g, '');
  if(displayPT.indexOf(d5) != -1){}else{localStorage.setItem('d5','');}
  d6 = localStorage.getItem('d6').replace(/\s+/g, '');
  if(displayPT.indexOf(d6) != -1){}else{localStorage.setItem('d6','');}
  d7 = localStorage.getItem('d7').replace(/\s+/g, '');
  if(displayPT.indexOf(d7) != -1){}else{localStorage.setItem('d7','');}
  d8 = localStorage.getItem('d8').replace(/\s+/g, '');
  if(displayPT.indexOf(d8) != -1){}else{localStorage.setItem('d8','');}
  d9 = localStorage.getItem('d9').replace(/\s+/g, '');
  if(displayPT.indexOf(d9) != -1){}else{localStorage.setItem('d9','');}
  d10 = localStorage.getItem('d10').replace(/\s+/g, '');
  if(displayPT.indexOf(d10) != -1){}else{localStorage.setItem('d10','');}
  */
  $('#ch1').append('<strong >'+localStorage.getItem('d1')+'</strong>');
  $('#ch2').append('<strong >'+localStorage.getItem('d2')+'</strong>');
  $('#ch3').append('<strong >'+localStorage.getItem('d3')+'</strong>');
  $('#ch4').append('<strong >'+localStorage.getItem('d4')+'</strong>');
  $('#ch5').append('<strong >'+localStorage.getItem('d5')+'</strong>');
  $('#ch6').append('<strong >'+localStorage.getItem('d6')+'</strong>');
  $('#ch7').append('<strong >'+localStorage.getItem('d7')+'</strong>');
  $('#ch8').append('<strong >'+localStorage.getItem('d8')+'</strong>');
  $('#ch9').append('<strong >'+localStorage.getItem('d9')+'</strong>');
  $('#ch10').append('<strong >'+localStorage.getItem('d10')+'</strong>');

  if (localStorage.getItem("productsInCart") === null) {
    var cartItems = {};
    var items = []
    cartItems.items = items;
    localStorage.setItem('productsInCart', JSON.stringify(cartItems));
  }else {
    var cartItems = JSON.parse(localStorage.getItem("productsInCart"));
    localStorage.setItem('productsInCart', JSON.stringify(cartItems));
  }

  if (localStorage.getItem("onbed") === null) {
    var pt = {};
    var items = []
    pt.items = items;
    localStorage.setItem('onbed', JSON.stringify(pt));
  }else {
    var pt = JSON.parse(localStorage.getItem("onbed"));
    localStorage.setItem('onbed', JSON.stringify(pt));
  }

</script>
</body>

</html>