
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="refresh" content="240">
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
        <h3 style="color:#FFFFFF;">ส่งห้องตรวจ <?php echo getHospitalName();?></h3>
      </li>
      <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i
            class="fa fa-user fa-lg"></i></a>
        <ul class="dropdown-menu settings-menu dropdown-menu-right">
          <li><a class="dropdown-item" href="<?php echo base_url();?>index.php/UpdateRoomNo"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
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
         
          <table class="table"  id = "tblNomal">
              <col style="width:15%">
              <col style="width:85%">
            <thead>
              <tr style="background-color: #0000b3;">
                <th colspan="2" style="color:#FFFFFF;font-size:40px; text-align: center">ปกติ</th>
              </tr>
            </thead>
            <?php foreach ($pt as $item):?>
            <tbody>
              <tr class="table" style="color:#000000;font-size:25px;background-color:#00cc00">
                <td> 
                  <?php 
                    if($q->sub_queue=='Y'){
                      echo $item->main_dep_queue;
                    }else{
                      echo $item->oqueue;
                    }
                   // echo $item->oqueue;
                    
                  ?> 
                </td>
                <td><?php echo $item->ptname?>&nbsp
                  <?php 
                    if($item->lab_count !='' && $item->report_count !=''){
                      if($item->lab_count > $item->report_count){
                          echo '<img src="'.base_url().'assets/img/flask.png" class="jrotate" height="32" width="32">';
                      }else if($item->lab_count == $item->report_count){
                          echo '<img src="'.base_url().'assets/img/flask.png" height="32" width="32">';
                      }
                      echo "( ".$item->lab_count."/". $item->report_count." )"; 
                    }
                   
                    echo '&nbsp';
                    if($item->xray_send=='1' && $item->confirm_all=='N'){
                      echo '<i class="fa fa-hourglass-end  fa-spin"></i>';
                    }else if($item->xray_send=='1' && $item->confirm_all=='Y'){
                        echo '<img class="app-sidebar__user-avatar" src="'.base_url().'assets/img/radiation.png" height="32" width="32">';  
                    }
                  ?>&nbsp 
                 
                  <strong>
                  <!-- <a class='a1' id = 'a1<?php //echo $item->oqueue;?>'>1</a>&nbsp&nbsp&nbsp
                  <a class='a2' id = 'a2<?php //echo $item->oqueue;?>'>2</a>&nbsp&nbsp&nbsp -->
                  <a class='a3' id = 'a3<?php echo $item->oqueue;?>'>3</a>&nbsp&nbsp&nbsp
                  <a class='a4' id = 'a4<?php echo $item->oqueue;?>'>4</a>&nbsp&nbsp&nbsp
                  <a class='a5' id = 'a5<?php echo $item->oqueue;?>'>5</a>&nbsp&nbsp&nbsp
                  <a class='a6' id = 'a6<?php echo $item->oqueue;?>'>6</a>&nbsp&nbsp&nbsp
                  <a class='a7' id = 'a7<?php echo $item->oqueue;?>'>7</a>&nbsp&nbsp&nbsp
                  <a class='a8' id = 'a8<?php echo $item->oqueue;?>'>8</a>&nbsp&nbsp&nbsp
                  <a class='a9' id = 'a9<?php echo $item->oqueue;?>'>9</a>&nbsp&nbsp&nbsp
                  <a class='a10' id = 'a10<?php echo $item->oqueue;?>'>10</a>&nbsp
                  </strong>
                  <?php echo $item->spclty_name;?>
                  
                </td>
                <input type="hidden" id='hn' value='<?php echo $item->hn;?>'>
              </tr>
             
            </tbody>
            <?php endforeach;?>
          </table>
        </div>
      </div>
      <!--  two table -->
      <div class="col-md-6">

        <div class="table-responsive">
          <!-- <div class="table-responsive"></div> -->
          <table class="table" id = "tblUrgent">
              <col style="width:15%">
              <col style="width:85%">
            <thead>
              <tr style="background-color: #000000;">
                <th colspan="2" style="color:#FFFFFF;font-size:40px; text-align: center">เร่งด่วน</th>
              </tr>
            </thead>
            <?php foreach ($priority as $pri):?>
            <tbody>
              <tr 
                      <?php if($pri->pt_priority == 2){
                        echo 'style="color:#000000;font-size:25px;background-color:#f00000"';
                        echo ' class="p2"';
                      }else if($pri->pt_priority == 1){
                        echo 'style="color:#000000;font-size:25px;background-color:#ff9900"';
                        echo ' class="p1"';
                      }?>>
                <td><?php 
                    if($q->sub_queue=='Y'){
                      echo $pri->main_dep_queue;
                    }else{
                      echo $pri->oqueue;
                    }
                  //echo $pri->oqueue;
                  ?>
                </td>
                <td ><?php echo $pri->ptname?>&nbsp
                  <?php 
                    if($pri->lab_count !='' && $pri->report_count !=''){
                      if($pri->lab_count > $pri->report_count){
                          echo '<img src="'.base_url().'assets/img/flask.png" class="jrotate" height="32" width="32">';
                      }else if($pri->lab_count == $pri->report_count){
                          echo '<img src="'.base_url().'assets/img/flask.png" height="32" width="32">';
                      }
                      echo "( ".$pri->lab_count."/". $pri->report_count." )";  
                    }
                    echo '&nbsp';
                    if($pri->xray_send=='1' && $pri->confirm_all=='N'){
                      echo '<i class="fa fa-hourglass-end  fa-spin"></i>';
                    }else if($pri->xray_send=='1' && $pri->confirm_all=='Y'){
                      echo '<img class="app-sidebar__user-avatar" src="'.base_url().'assets/img/radiation.png" height="32" width="32">';  
                    }
                  ?>&nbsp
                   
                  <strong>
                  <!-- <a class='a1' id = 'a1<?php //echo $pri->oqueue;?>'>1</a>&nbsp&nbsp&nbsp
                  <a class='a2' id = 'a2<?php //echo $pri->oqueue;?>'>2</a>&nbsp&nbsp&nbsp -->
                  <a class='a3' id = 'a3<?php echo $pri->oqueue;?>'>3</a>&nbsp&nbsp&nbsp
                  <a class='a4' id = 'a4<?php echo $pri->oqueue;?>'>4</a>&nbsp&nbsp&nbsp
                  <a class='a5' id = 'a5<?php echo $pri->oqueue;?>'>5</a>&nbsp&nbsp&nbsp
                  <a class='a6' id = 'a6<?php echo $pri->oqueue;?>'>6</a>&nbsp&nbsp&nbsp
                  <a class='a7' id = 'a7<?php echo $pri->oqueue;?>'>7</a>&nbsp&nbsp&nbsp
                  <a class='a8' id = 'a8<?php echo $pri->oqueue;?>'>8</a>&nbsp&nbsp&nbsp
                  <a class='a9' id = 'a9<?php echo $pri->oqueue;?>'>9</a>&nbsp&nbsp&nbsp
                  <a class='a10' id = 'a10<?php echo $pri->oqueue;?>'>10</a>&nbsp
                  </strong>
                  <?php echo $pri->spclty_name;?>
                </td>
                <input type="hidden" id='hn' value='<?php echo $pri->hn;?>'>
              </tr>
             
            </tbody>
            <?php endforeach;?>
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
<script> 
  var socket = io.connect( 'http://'+window.location.hostname+':3000' );
  
    $('#tblNomal tr td a').click(function(){
      var id = $(this).attr('id');
      console.log('id',id);
      document.getElementById(id).style.color = "#ff0000";
      //document.getElementById("result").innerHTML = localStorage.getItem("eName");
      var roomno = $(this).text();
      console.log('roomno : ',roomno);

      var qnum = $(this).parent().parent().parent().children(0).html().trim();
      var hn = $(this).parent().parent().parent().children(0).eq(2)[0].value;
      //console.log($(this).parent().parent().parent().children(0).eq(2)[0].value );

      console.log('q : ',qnum );
      socket.emit('call_to_exam_room', {  
          HN: hn,
          queue: qnum,
          roomno: roomno
      });

    });

    $('#tblUrgent tr td a').click(function(){
      var cid = $(this).attr('id');
      document.getElementById(cid).style.color = "#ff0000";
      var roomno = $(this).text();
      //alert(roomno);
      var qnum = $(this).parent().parent().parent().children(0).html().trim();
      var hn = $(this).parent().parent().parent().children(0).eq(2)[0].value;
      console.log($(this).parent().parent().parent().children(0).html().trim() );
      console.log('q : ',qnum);
      socket.emit('call_to_exam_room', {  
          HN: hn,
          queue: qnum,
          roomno: roomno
      });

    });
    

  



</script>
</body>

</html>