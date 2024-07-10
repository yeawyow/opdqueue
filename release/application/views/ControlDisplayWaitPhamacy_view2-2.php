
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
        <h3 style="color:#FFFFFF;">รอรับยา โรงพยาบาลวานรนิวาส</h3>
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
        <div class="col-md-6">
          <div class="table-responsive">
            <table  class = "table" id = "tblNomal">
                <col style="width:20%">
              <thead>
                <tr>
                  <th  style="color:#FFFFFF;font-size:40px; text-align: center">
                    <input id="inputValid" type="text" width="9" height="78">
                    <button id="submit-button"></button>
                  </th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>

        <div class="col-md-6">
          <div class="table-responsive">
            <table  id = "channel">
                <col style="width:100%">
              <thead>
                <tr >
                  <th  style="color:#FFFFFF;font-size:40px;">
                    <input  type="text" height="78"  placeholder="ช่องจ่ายยา." disabled="">
                    
                  </th>
                  <th style="color:#FFFFFF;font-size:40px;"><button id="submit-phama">OK</button></th>
                </tr>
              </thead>
              <tbody>
                <tr  style="color:#FFFFFF;font-size:50px;background-color:#003399">
                  <td colspan="2" >
                    <strong style="color:#FFFFFF;font-size:50px">&nbsp&nbsp&nbsp
                    <a class='c1'>1</a>&nbsp&nbsp&nbsp
                    <a class='c2'>2</a>&nbsp&nbsp&nbsp
                    <a class='c3'>3</a>&nbsp&nbsp&nbsp
                    <a class='c4'>4</a>&nbsp&nbsp&nbsp
                    <a class='c5'>5</a>&nbsp&nbsp&nbsp
                    <a class='c6'>6</a>&nbsp&nbsp&nbsp
                    <a class='c7'>7</a>&nbsp&nbsp&nbsp
                    </strong>
                  </td>

                </tr>
              
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
    $('#submit-phama').click(function(){
      var ptname = $('#tblNomal tr td').parent().parent().children().children(0).html(); //OK
      var res = ptname.split(" ");
      console.log(res[2]);
      $.ajax({
          type: "POST",
          url: base_url+"index.php/ControlDisplayWaitPhamacy/updateDispense",
          dataType: 'json',
          data: {vn:res[2]},
          success: 
              function(data) {
                if(data==1){
                 
                  socket.emit('refesh_phama_queue', {  
                    refesh: 'refesh'
                  });
                  location.reload();
                }
              }
      });

    });

    $('#channel tr td a').click(function(){
      var cid = $(this).attr('class');
        //alert(cid);
      var roomno = $(this).text();
        console.log(roomno);
      //var qnum = $(this).parent().parent().parent().children(0).html(); 
      var ptname = $('#tblNomal tr td').parent().parent().children().children(0).html(); //OK
      var res = ptname.split(" ");
      //console.log(res[2]);
      

      socket.emit('call_to_phama_room2', {  
          fname: res[0],
          lname: res[1],
          roomno: roomno
      });

    });

  window.onload = function() {
    document.getElementById("inputValid").focus();
  };

  $("#inputValid").on("keyup", function() {
    if ($(this).val().length == 9) {
      
      var data = document.getElementById("inputValid").value;
      $.ajax({
          type: "POST",
          url: base_url+"index.php/ControlDisplayWaitPhamacy/getPatientName",
          dataType: 'json',
          data: {hn:data},
          success: 
              function(data) {
                  console.log(data);
                  $(".table").append("<tr style='color:#FFFFFF;font-size:50px;background-color:#003399'><td>"+data[0].fname+" "+ data[0].lname+" "+data[0].vn+"</td></tr> ");
          }
      });

      $("#submit-button").trigger('click');
      console.log(data);
    }
  });



</script>
</body>

</html>