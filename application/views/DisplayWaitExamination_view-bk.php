
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
        <h3 style="color:#FFFFFF;">รอพบแพทย์ โรงพยาบาลวานรนิวาส</h3>
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

        <div class="table-responsive">
          <!-- <div class="table-responsive"></div> -->
         
          <table class="table" >
              <col style="width:15%">
              <col style="width:85%">
              
            <thead>
              <tr style="background-color: #130ff8;">
                <th colspan="3" style="color:#FFFFFF;font-size:40px; text-align: center">ปกติ</th>
              </tr>
              <!-- <tr class="table-danger" style="font-size:25px; ">
                <th>หมายเลข</th>
                <th>ชื่อ - สกุล</th>
                <th>Lab</th>
                <th>X-Ray</th>
              </tr>-->
            </thead>
            
            <tbody>
            <?php foreach ($pt as $item):?>
              <tr id="tr_<?php echo $item->oqueue;?>" style="color:#FFFFFF;font-size:42px; background-color:#003300">
                <td >
                  <?php 
                    if($q->sub_queue=='Y'){
                      echo $item->main_dep_queue;
                    }else{
                      echo $item->oqueue;
                    }
                  ?>
                </td>
                <td><strong><?php echo $item->ptname?></strong>&nbsp
                  <?php 
                    if($item->lab_count=='1' && $item->report_count=='0'){
                          echo '<i class="fa fa-flask fa-spin"></i>';
                      }else if($item->lab_count=='1' && $item->report_count=='1'){
                          echo '<i class="fa fa-flask "></i>';
                      }
                      echo '&nbsp';
                      if($item->xray_send=='1' && $item->confirm_all=='N'){
                        echo '<i class="fa fa-hourglass-end  fa-spin"></i>';
                      }else if($item->xray_send=='1' && $item->confirm_all=='Y'){
                          echo '<img class="app-sidebar__user-avatar" src="'.base_url().'assets/img/radiation.png" height="32" width="32">';  
                      }
                      
                  ?>
                </td>
                <td><strong id ="roomno_<?php echo $item->oqueue;?>"></strong></td>
              </tr>
              <?php endforeach;?>
            </tbody>
          </table>
        </div>
      </div>
      <!--  two table -->
      <div class="col-md-6">

        <div class="table-responsive">
          <!-- <div class="table-responsive"></div> -->
          <table class="table" >
              <col style="width:15%">
              <col style="width:85%">
              
            <thead>
              <tr style="background-color: #db0e30;">
                <th colspan="3" style="color:#FFFFFF;font-size:40px; text-align: center">เร่งด่วน</th>
              </tr>
              <!-- <tr class="table-danger" style="font-size:25px;">
                <th>หมายเลข</th>
                <th>ชื่อ - สกุล</th>
                <th>Lab</th>
                <th>X-Ray</th>
              </tr>-->
            </thead>
            <tbody>
            <?php foreach ($priority as $pri):?>
              <tr id="tr_<?php echo $pri->oqueue;?>" style="color:#FFFFFF;font-size:42px;background-color:#2a2222">
                <td>
                  <?php
                  if($q->sub_queue=='Y'){
                    echo $pri->main_dep_queue;
                  }else{
                    echo $pri->oqueue;
                  }
                   
                  ?>
                </td>
                <td><strong><?php echo $pri->ptname?></strong>&nbsp
                  <?php if($pri->lab_count=='1' && $pri->report_count=='0'){
                          echo '<i class="fa fa-flask fa-spin"></i>';
                      }else if($pri->lab_count=='1' && $pri->report_count=='1'){
                          echo '<i class="fa fa-flask "></i>';
                      } 
                      echo '&nbsp';
                      if($pri->xray_send=='1' && $pri->confirm_all=='N'){
                        echo '<i class="fa fa-hourglass-end  fa-spin"></i>';
                      }else if($pri->xray_send=='1' && $pri->confirm_all=='Y'){
                          echo '<img class="app-sidebar__user-avatar" src="'.base_url().'assets/img/radiation.png" height="32" width="32">';  
                      }
                  ?>
                </td>
                <td><strong id ="roomno_<?php echo $pri->oqueue;?>"></strong></td>
              </tr>
              <?php endforeach;?>
            </tbody>
          </table>
        </div>
      </div>
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
    socket.on("call_to_exam_room",function ( data ){
      console.log(data);
      //var rows = $('#tblNormal tr ').hide().filter(":contains('1')").show();
      //console.log(rows.['prevObject'].find('2'););

      //$("#tblNormal tr").each(function(){
        //console.log($('#tblNormal').find("tr:eq(1)").find("td:eq(0)").html());
      //})
      var station = 'exam_'+data.station+'.mp3';
      var queue = data.Queue; 

      if(localStorage.getItem('QueueOrNameCalling')=='Y'){
        console.log('ใช้คิว');
        var queueNumber = data.Queue+'.mp3';
        
        console.log(queueNumber);
        var source =[ 
            //base_url+"audio/welcomeNumber.mp3",
            base_url+"audio/"+queueNumber, 
            //base_url+"audio/"+lastname,
            //base_url+"audio/screen.mp3",
            base_url+"audio/"+station
            //base_url+"audio/ka.mp3"
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


      }else{
        console.log('ใช้ชื่อ');
        var firstname = data.HN+'.mp3';
        //var station = data.station+'.mp3';
        //var queue = data.Queue; 
        console.log(queue);
        var source =[ 
            base_url+"audio/"+firstname, 
            base_url+"audio/"+station
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
      $('#roomno_'+queue).html( data.station );
    
      document.getElementById('tr_'+queue).style.backgroundColor='#000099'
      function blink_text() {
        $('#tr_'+queue).fadeOut(2500);
        $('#tr_'+queue).fadeIn(500);
      }
      setInterval(blink_text, 5000);

      

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
</body>

</html>