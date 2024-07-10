
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
        <h3 style="color:#FFFFFF;">เรียกเข้าห้องฉุกเฉิน <?php echo getHospitalName();?></h3>
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
      
      <!--  two table -->
      <div class="col-md-12">

        <div class="table-responsive">
          <!-- <div class="table-responsive"></div> -->
          <table class="table" id = "tblUrgent">
              <col style="width:15%">
              <col style="width:85%">
            <thead>
            <tr style="background-color: #0000b3;">
                <th colspan="3" style="color:#FFFFFF;font-size:32px; text-align: center">ผู้รอรับบริการ</th>
              </tr>
            </thead>
            <?php foreach ($priority as $pri):?>
            <tbody>
              <tr
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
                  <a class='a1' id = '<?php echo $pri->oqueue;?>'>
                    <img class="app-sidebar__user-avatar" src="<?php echo base_url();?>assets/img/speaker.png" height="42" width="42">
                  </a>
                  <a class='a2' id = '<?php echo $pri->oqueue;?>'>
                    <img class="app-sidebar__user-avatar" src="<?php echo base_url();?>assets/img/family.png" height="42" width="42">
                  </a>
                  <a class='a3' id = '<?php echo $pri->oqueue;?>'>
                    <img class="app-sidebar__user-avatar" src="<?php echo base_url();?>assets/img/hospital-bed.png" height="42" width="42">
                  </a>
                  <a class='a4' id = '<?php echo $pri->oqueue;?>'>
                    <img class="app-sidebar__user-avatar" src="<?php echo base_url();?>assets/img/home.png" height="42" width="42">
                  </a>
                  </strong>
                  
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

    $('#tblUrgent tr td a').click(function(){
      var _class = $(this).attr('class');
      console.log(_class)
      //document.getElementById(cid).style.color = "#ff0000";
      //var roomno = $(this).text();
      //alert(roomno);
      var qnum = $(this).parent().parent().parent().children(0).html().trim();
      var hn = $(this).parent().parent().parent().children(0).eq(2)[0].value;
      //console.log($(this).parent().parent().parent().children(0).html().trim() );
      console.log('hn:',hn);
      console.log('q : ',qnum);
      if(_class == 'a1'){
        socket.emit('callER_Patient', {  
          HN: hn,
          queue: qnum,
          relative: 'N'
        });
      }else if(_class == 'a2'){
        socket.emit('callER_Patient', {  
          HN: hn,
          queue: qnum,
          relative: 'Y'
        });
      }else if(_class == 'a3'){
        socket.emit('er_serv', {  
          HN: hn,
          queue: qnum,
          relative: 'S'
        });
      }else if(_class == 'a4'){
        socket.emit('er_serv', {  
          HN: hn,
          queue: qnum,
          relative: 'H'
        });
      }
      

    });
    

  



</script>
</body>

</html>