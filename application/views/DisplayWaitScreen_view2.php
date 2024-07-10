<!DOCTYPE html>
<html lang="en">
<head>
 
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/bootstrap-5.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/bootstrap-5.1.3/css/style.min.css">
  <!-- Main CSS ตัวเก่า-->
  <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/main.css">-->
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/font-awesome.min.css">
  <script src="<?php echo "http://".$_SERVER['HTTP_HOST'];?>:3000/socket.io/socket.io.js"></script> 
  
  <script type="text/javascript">
      var base_url = "<?php echo base_url();?>";
      
  </script>
  <style>
            
      tr{cursor: pointer; transition: all .25s ease-in-out}
      .selected{background-color: red; font-weight: bold; color: #FFF;}
      .ch1 .ch2 .ch3 .ch4{background-color:#FFFFFF;}
      .n1 {background-color:#00cc00}
      .p1 {background-color:#FF9900;}
      .p2 {background-color:#f00000;}
      
      
      .x11 {background-color:#FF6347;}
      .c1 {background-color:#ffffff;}

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
<body>
<div class="page-flex">

  <div class="main-wrapper">
       <!-- ! Main nav -->
       <nav class="main-nav--bg">
  <div class="container main-nav">
    <div class="main-nav-start">
      <div class="search-wrapper">
        <i data-feather="search" aria-hidden="true"></i>
        <input type="text" placeholder="Enter keywords ..." required>
      </div>
    </div>
    <div class="main-nav-end">
    
     
     
      <div class="notification-wrapper">
        <button class="gray-circle-btn dropdown-btn" title="To messages" type="button">
          <span class="sr-only">To messages</span>
          <span class="icon notification active" aria-hidden="true"></span>
        </button>
        <ul class="users-item-dropdown notification-dropdown dropdown">
          <li>
            <a href="##">
              <div class="notification-dropdown-icon info">
                <i data-feather="check"></i>
              </div>
              <div class="notification-dropdown-text">
                <span class="notification-dropdown__title">System just updated</span>
                <span class="notification-dropdown__subtitle">The system has been successfully upgraded. Read more
                  here.</span>
              </div>
            </a>
          </li>
          <li>
            <a href="##">
              <div class="notification-dropdown-icon danger">
                <i data-feather="info" aria-hidden="true"></i>
              </div>
              <div class="notification-dropdown-text">
                <span class="notification-dropdown__title">The cache is full!</span>
                <span class="notification-dropdown__subtitle">Unnecessary caches take up a lot of memory space and
                  interfere ...</span>
              </div>
            </a>
          </li>
          <li>
            <a href="##">
              <div class="notification-dropdown-icon info">
                <i data-feather="check" aria-hidden="true"></i>
              </div>
              <div class="notification-dropdown-text">
                <span class="notification-dropdown__title">New Subscriber here!</span>
                <span class="notification-dropdown__subtitle">A new subscriber has subscribed.</span>
              </div>
            </a>
          </li>
          <li>
            <a class="link-to-page" href="##">Go to Notifications page</a>
          </li>
        </ul>
      </div>
      <div class="nav-user-wrapper">
        <button href="##" class="nav-user-btn dropdown-btn" title="My profile" type="button">
          <span class="sr-only">My profile</span>
          <span class="nav-user-img">
            <picture><source srcset="./img/avatar/avatar-illustrated-02.webp" type="image/webp"><img src="./img/avatar/avatar-illustrated-02.png" alt="User name"></picture>
          </span>
        </button>
        <ul class="users-item-dropdown nav-user-dropdown dropdown">
          <li><a href="##">
              <i data-feather="user" aria-hidden="true"></i>
              <span>Profile</span>
            </a></li>
          <li><a href="##">
              <i data-feather="settings" aria-hidden="true"></i>
              <span>Account settings</span>
            </a></li>
          <li><a class="danger" href="##">
              <i data-feather="log-out" aria-hidden="true"></i>
              <span>Log out</span>
            </a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<main class="main">
<div class="container-fluid">
  <div class="row">
    <div class="col-9"> <div class="flex  p-3 my-3 text-white bg-primary rounded shadow-sm">
  <div class="row">
 <div class='col-3'><h2 class="text-center text-white">โต๊ะซักประวัติ</h2></div>
  <div class='col-9'><h2 class="text-center text-white">คิวเรียก</h2></div>
  </div>
 
<div class='row text-danger'>
      <div class="col-md-3 col-xl-3">
      <div class="my-3 p-3 bg-body rounded shadow-sm text-center">
            <p class="display-1">1</p>
      </div>
     
        </div>
        <div class="col-md-9 col-xl-9">
        <div class="my-3 p-3 bg-body rounded shadow-sm text-center">
            <p class="display-1 info ch1" id="ch1" style="color:#003300;font-size:50px;"><strong ></strong></p>
      </div>
      </div>
        </div>
  </div>
  </div>
    <div class="col-3">
    <div class="flex  p-3 my-3  bg-primary rounded shadow-sm ">
    <h2 class="text-center text-white">คิวรอรับบริการ</h2>
  
    </div>
    <div class="row stat-cards mt-3">
        
        
          <div class="col-md-12 col-xl-12">
          <table class="table" id="tblnormal" >
                <col style="width:15%">
                <col style="width:85%">
              <thead>
                <tr style="background-color: #0000b3;">
                  <th colspan="3" style="color:#FFFFFF;font-size:40px; text-align: center">ปกติ</th>
                </tr>
              </thead>
              
              <tbody>
              <?php foreach ($pt as $item):?>
               
                <tr id="<?php if($q->sub_queue == 'Y' && $q->call_queue == 'Y'){
                        echo $item->main_dep_queue;
                      }else{
                        echo $item->oqueue;
                       
                      } ?>" class="n1" style="color:#000000;font-size:42px;background-color:#00cc00">
                  <td >
                    <?php if($q->sub_queue == 'Y' && $q->call_queue == 'Y'){
                        echo $item->main_dep_queue;
                      }else{
                        echo $item->oqueue;
                      }                    
                    ?>
                    </td>
                  <td>
                    <strong class="<?php echo $item->oqueue;?>"><?php echo $item->ptname?></strong>&nbsp
                      <?php
                        if ($item->lab_count !='' && $item->report_count !=''){
                          if($item->lab_count > $item->report_count){
                              echo '<img src="'.base_url().'assets/img/flask.png" class="jrotate" height="32" width="32">';
                            }else if($item->lab_count == $item->report_count){
                              echo '<img src="'.base_url().'assets/img/flask.png" height="32" width="32">';
                          }
                        } 
                          echo '&nbsp';
                          if($item->confirm_all=='N'){
                            echo '<img src="'.base_url().'assets/img/radiation.png" class="jrotate" height="32" width="32">';
                          }else if($item->confirm_all=='Y'){
                              echo '<img class="app-sidebar__user-avatar" src="'.base_url().'assets/img/radiation.png" height="32" width="32">';  
                          }
                      ?>
                  
                  </td>
                  <td><strong id ="chanel_<?php echo $item->hn;?>" class="<?php echo $item->oqueue;?>"></strong></td>
                </tr>
              <?php endforeach;?>
              </tbody>
              
            </table>
          </div>
  </div>
  
</div>

</div>
     
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
  <audio> </audio>
<script>
  var socket = io.connect( 'http://'+window.location.hostname+':3000' );
  //setTimeout(function() {
   
  socket.on("hn",function ( data ){
    console.log(data);
    var ptname = document.getElementById(data.Queue).children[1].children[0].innerText;
    //console.log('ptname',document.getElementById(data.Queue).children[1].children[0].innerText);
    //console.log('idxx :',document.getElementById(data.Queue).className);
    if(data.Station==1){
      localStorage.setItem('d1', ptname);
      document.getElementById('ch1').children[1].innerText = localStorage.getItem('d1');
      //var _class = document.getElementById(data.Queue).className;
      /* list = document.getElementById("ch1");
      list.removeChild(list.childNodes[0]);
      $('#ch1').append('<strong >'+ptname+'</strong>'); */
     
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

    }else if(data.Station==2){
      localStorage.setItem('d2', ptname);
      document.getElementById('ch2').children[1].innerText = localStorage.getItem('d2');
      //var _class = document.getElementById(data.Queue).className;
      /* list = document.getElementById("ch2");
      list.removeChild(list.childNodes[0]);
      $('#ch2').append('<strong >'+ptname+'</strong>'); */
      $('.info').addClass('x11');
      var i = 0;
      var a = setInterval(function(){
        if(i==10){clearInterval(a)}
        if ($('.x11').hasClass('c1')){
            $('.x11').removeClass('c1');
            
            console.log('คือบ่ได้',i);
        }else{
            $('.x11').addClass('c1');
            //$('.c1').addClass('x1');
            console.log('ตายๆๆๆ',i);
        }
        i++;
      },1000);
    }else if(data.Station==3){
      localStorage.setItem('d3', ptname);
      document.getElementById('ch3').children[1].innerText = localStorage.getItem('d3');
      /* list = document.getElementById("ch3");
      list.removeChild(list.childNodes[0]);
      $('#ch3').append('<strong >'+ptname+'</strong>'); */
      $('.info').addClass('x11');
      var i = 0;
      var a = setInterval(function(){
        if(i==10){clearInterval(a)}
        if ($('.x11').hasClass('c1')){
            $('.x11').removeClass('c1');
            
            console.log('คือบ่ได้',i);
        }else{
            $('.x11').addClass('c1');
            //$('.c1').addClass('x1');
            console.log('ตายๆๆๆ',i);
        }
        i++;
      },1000);
    }else if(data.Station==4){
      /* //var _class = document.getElementById(data.Queue).className;
      list = document.getElementById("ch4");
      list.removeChild(list.childNodes[0]);
      $('#ch4').append('<strong >'+ptname+'</strong>'); */
      localStorage.setItem('d4', ptname);
      document.getElementById('ch4').children[1].innerText = localStorage.getItem('d4');
      $('.info').addClass('x11');
      var i = 0;
      var a = setInterval(function(){
        if(i==10){clearInterval(a)}
        if ($('.x11').hasClass('c1')){
            $('.x11').removeClass('c1');
            
            console.log('คือบ่ได้',i);
        }else{
            $('.x11').addClass('c1');
            //$('.c1').addClass('x1');
            console.log('ตายๆๆๆ',i);
        }
        i++;
      },1000);
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

    

  })


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

  var users = <?php echo json_encode(array_merge($pt,$priority)); ?>;
  displayPT = [];
  for(i=0;i<users.length;i++){
    displayPT.push(users[i].ptname.replace(/\s+/g, ''));
  }
  
  //console.log('displayPT:',displayPT);
 
  d1 = localStorage.getItem('d1').replace(/\s+/g, '');
  console.log('9999999:',displayPT.indexOf(d1));
  if(displayPT.indexOf(d1) != -1){}else{localStorage.setItem('d1','');}
  d2 = localStorage.getItem('d2').replace(/\s+/g, '');
  if(displayPT.indexOf(d2) != -1){}else{localStorage.setItem('d2','');}
  d3 = localStorage.getItem('d3').replace(/\s+/g, '');
  if(displayPT.indexOf(d3) != -1){}else{localStorage.setItem('d3','');}
  d4 = localStorage.getItem('d4').replace(/\s+/g, '');
  if(displayPT.indexOf(d4) != -1){}else{localStorage.setItem('d4','');}

  
  $('#ch1').append('<strong >'+localStorage.getItem('d1')+'</strong>');
  $('#ch2').append('<strong >'+localStorage.getItem('d2')+'</strong>');
  $('#ch3').append('<strong >'+localStorage.getItem('d3')+'</strong>');
  $('#ch4').append('<strong >'+localStorage.getItem('d4')+'</strong>');

  
</script>

