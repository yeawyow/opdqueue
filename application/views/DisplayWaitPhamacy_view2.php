
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
      .ch1 .ch2 .ch3 .ch4{background-color:#FFFFFF;}
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
        <h3 style="color:#FFFFFF;">รอรับยา <?php echo getHospitalName();?></h3>
      </li>
      <li class="dropdown"><a class="app-nav__item" data-toggle="modal" data-target="#myModal"><i
            class="fa fa-cogs fa-lg"></i></a>
        
      </li>
    </ul>
  </header>
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>

  <main class="app-content">
    <div class="app-title">
      <div class="col-md-6 col-lg-6">
        <div class="widget-small primary coloured-icon" ><i class="icon" ><strong>5</strong></i>
            <div class="info ch5" id="ch5" style="color:#003300;font-size:50px;"><strong></strong></div>
        </div>
        <div class="widget-small primary coloured-icon"><i class="icon" ><strong>6</strong></i>
            <div class="info ch6" id="ch6" style="color:#003300;font-size:50px;"><strong></strong></div>
        </div>
        <div class="widget-small primary coloured-icon"><i class="icon" ><strong>7</strong></i>
            <div class="info ch7" id="ch7" style="color:#003300;font-size:50px;"><strong></strong></div>
        </div>
        <div class="widget-small primary coloured-icon"><i class="icon" ><strong>8</strong></i>
            <div class="info ch8" id="ch8" style="color:#003300;font-size:50px;"><strong></strong></div>
        </div>
        <div class="table-responsive">
          <table class="table" id="tblNormal" >
            <col style="width:15%">
            <col style="width:60%">
            <thead>
              <tr style="background-color: #000000;">
              <th colspan="3" style="color:#FFFFFF;font-size:40px; text-align: center">เร่งด่วน</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($priority as $pri):?>
                <tr id="blink_<?php echo $pri->hn;?>"
                  <?php if($pri->pt_priority == 2){
                      echo 'style="color:#000000;font-size:42px;background-color:#f00000"';
                      echo ' class="p2"';
                  }else if($pri->pt_priority == 1){
                      echo 'style="color:#000000;font-size:42px;background-color:#ff9900"';
                      echo ' class="p1"';
                  }?>
                >
                  <td>
                    <?php 
                    if($q->drug_queue=='2'){
                      echo $pri->rx_queue;
                    }else{
                      echo $pri->oqueue;
                    }
                    // echo $pri->oqueue;
                    ?>
                  </td>
                  <td>
                    <strong>
                      <?php echo $pri->ptname?>
                    </strong>&nbsp
                  </td>
                  <td style="color:#000000;font-size:32px;">
                  <?php
                  echo '<img src="'.base_url().'assets/img/drug.png" class="jrotate" height="32" width="32">';
                  echo "  ".$pri->cc." (รายการ)";
                  ?>
                  
                  </td>
                  <input type="hidden" id='hn_<?php echo $pri->hn;?>' value='<?php
                    if($q->drug_queue=='2'){
                      echo $pri->rx_queue;
                    }else{
                      echo $pri->oqueue;
                    }

                 
                  ?>'>
                  
                  <input type="hidden" id='vn_<?php echo $pri->hn;?>' value='<?php echo $pri->vn;?>'>
                </tr>
              <?php endforeach;?>
            </tbody>
          </table>
        </div>
      </div>
      <div  class="col-md-6 col-lg-6"> <!-- div6 -->
      <div class="table-responsive">
          <table class="table" id="tblNormal" >
            <col style="width:15%">
            <col style="width:60%">
            <thead>
              <tr style="background-color: #0000b3;">
              <th colspan="3" style="color:#FFFFFF;font-size:40px; text-align: center">ปกติ</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($pt as $item):?>
                <tr id="blink_<?php echo $item->hn;?>"  class="n1" style="color:#000000;font-size:42px;background-color:#00cc00">
                  <td>
                    <?php 
                    if($q->drug_queue=='2'){
                      echo $item->rx_queue;
                    }else{
                      echo $item->oqueue;
                    }
                    // echo $item->oqueue;
                    ?>
                  </td>
                  <td>
                    <strong>
                      <?php echo $item->ptname?>
                    </strong>&nbsp
                  </td>
                  <td style="color:#FFFFFF;font-size:32px;">
                  <?php
                  echo '<img src="'.base_url().'assets/img/drug.png" class="jrotate" height="32" width="32">';
                  echo "  ".$item->cc." (รายการ)";
                  ?>
                  </td>
                  <input type="hidden" id='hn_<?php echo $item->hn;?>' value='<?php
                    if($q->drug_queue=='2'){
                      echo $item->rx_queue;
                    }else{
                      echo $item->oqueue;
                    }
                  //echo $item->oqueue;
                  ?>'>
                  <input type="hidden" id='vn_<?php echo $item->hn;?>' value='<?php echo $item->vn;?>'>
                </tr>
              <?php endforeach;?>
            </tbody>
          </table>
        </div>
      </div>
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
      console.log(data);  
      if(data.refesh=='refesh'){
          //location.reload();
          console.log("xxxxxxx",document.getElementById("vn_"+data.hn).value);
          console.log("yyyyy",document.getElementById("blink_"+data.hn));
          //document.getElementById("blink_"+data.hn).remove();
          $.ajax({
            type: "POST",
            url: base_url+"index.php/ControlDisplayWaitPhamacy/updateDispense",
            dataType: 'json',
            data: {vn:document.getElementById("vn_"+data.hn).value},
            success: 
                function(res) {
                  if(res==1){
                    //document.getElementById("blink_"+data.hn).remove();
                    location.reload();
                  }
                }
          });
        }
    })

    if(localStorage.getItem('QueueOrNameCalling')==null ||  localStorage.getItem('DrugQueue')==null){
        $.ajax({
              type: "POST",
              url: base_url+"index.php/Config/QueueOrNameCalling",
              dataType: 'json',
              success: 
                  function(data) {
                      console.log(data);
                      localStorage.setItem('QueueOrNameCalling', data[0].call_queue);
                      localStorage.setItem('DrugQueue',data[0].drug_queue)
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
                if(localStorage.getItem('QueueOrNameCalling')!==data[0].call_queue ||localStorage.getItem('DrugQueue')!==data[0].drug_queue){
                  localStorage.setItem('QueueOrNameCalling', data[0].call_queue);
                  localStorage.setItem('DrugQueue',data[0].drug_queue)
                }
        }
      });
    }
    


    //xxxxxxxxxxx

    socket.on("call_to_phama_room2",function ( data ){
      console.log(data);
      var firstname = data.hn+'.mp3';
      var queueNumber = document.getElementById("hn_"+data.hn).value+'.mp3';
      var station = 'drug_'+data.chanel+'.mp3';
      var ptname = document.getElementById("blink_"+data.hn).children[1].children[0].innerText;
      var tbl = document.getElementById("tblNormal");
      var rowNum = document.getElementById("blink_"+data.hn).rowIndex;

      if(data.chanel==5){
        localStorage.setItem('d5', ptname);
        document.getElementById('ch5').children[1].innerText = localStorage.getItem('d5');

        /* console.log('data.chanel:',data.chanel);
        list = document.getElementById("ch5");
        list.removeChild(list.childNodes[0]);
        $('#ch5').append('<strong >'+ptname+'</strong>'); */
      
        $('.ch5').addClass('x1');

        var i = 0;
        var a = setInterval(function(){
          if(i==10){clearInterval(a)}
          if ($('.x1').hasClass('c1')){
              $('.x1').removeClass('c1');
          }else{
              $('.x1').addClass('c1');
          }
          i++;
        },1000);

      }else if(data.chanel==6){
        localStorage.setItem('d6', ptname);
        document.getElementById('ch6').children[1].innerText = localStorage.getItem('d6');

        /* list = document.getElementById("ch6");
        list.removeChild(list.childNodes[0]);
        $('#ch6').append('<strong >'+ptname+'</strong>'); */
        $('.ch6').addClass('x2');
        var i = 0;
        var a = setInterval(function(){
          if(i==10){clearInterval(a)}
          if ($('.x2').hasClass('c2')){
              $('.x2').removeClass('c2');
          }else{
              $('.x2').addClass('c2');
          }
          i++;
        },1000);
      }else if(data.chanel==7){
        localStorage.setItem('d7', ptname);
        document.getElementById('ch7').children[1].innerText = localStorage.getItem('d7');

       /*  list = document.getElementById("ch7");
        list.removeChild(list.childNodes[0]);
        $('#ch7').append('<strong >'+ptname+'</strong>'); */
        $('.ch7').addClass('x3');
        var i = 0;
        var a = setInterval(function(){
          if(i==10){clearInterval(a)}
          if ($('.x3').hasClass('c3')){
              $('.x3').removeClass('c3');
          }else{
              $('.x3').addClass('c3');
          }
          i++;
        },1000);
      }else if(data.chanel==8){
        localStorage.setItem('d8', ptname);
        document.getElementById('ch8').children[1].innerText = localStorage.getItem('d8');

        /* list = document.getElementById("ch8");
        list.removeChild(list.childNodes[0]);
        $('#ch8').append('<strong >'+ptname+'</strong>'); */
        $('.ch8').addClass('x4');
        var i = 0;
        var a = setInterval(function(){
          if(i==10){clearInterval(a)}
          if ($('.x4').hasClass('c4')){
              $('.x4').removeClass('c4');
          }else{
              $('.x4').addClass('c4');
          }
          i++;
        },1000);
      }
        
        

      if(localStorage.getItem('DrugQueue')=='2'||localStorage.getItem('DrugQueue')=='1'){ 
        console.log('ใช้คิว');
        
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
        var source =[ 
            base_url+"audio/"+firstname, 
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

      }
  
      function play(a, callback) {
        var audio = document.createElement("audio");
        audio.autoplay = true;
        audio.src = a;
        console.log(a);
        audio.addEventListener("load", function() {audio.play();}, true);
        audio.addEventListener('ended', callback);
      }
      /*
      $('#chanel_'+data.hn).html( data.chanel );
      document.getElementById('blink_'+data.hn).style.backgroundColor='#800000'
      function blink_text() {
        $('#blink_'+data.hn).fadeOut(2000);
        $('#blink_'+data.hn).fadeIn(500);
      }
      setInterval(blink_text, 5000);
      */
    })

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


  var users = <?php echo json_encode(array_merge($pt,$priority)); ?>;
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
</script>
</body>

</html>
