
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
      window.onload = function() {
        document.getElementById("inputValid").focus();
        document.getElementById("inputValid").value='';
      };
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
        <h3 style="color:#FFFFFF;">เรียกรับยา <?php echo getHospitalName();?></h3>
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
      <div class="row">
      
        <div class="col-md-12">
          <table  id = "channel"><!-- class="table table-bordered" -->
            <thead>
              <tr>
                <th colspan="4">
                  <div class="form-group">
                    <label class="col-form-label col-form-label-lg" for="inputLarge">HN</label>
                    <input class="form-control form-control-lg" style="direction:RTL;" id="inputValid" type="text">
                  </div>
                </th>
                
            </thead>
            <tbody>
              <tr>
                <td>
                  <a class ="c1" style="text-decoration:none ">
                  <button>
                    <img  src="<?php echo base_url();?>assets/img/1.png" height="150" width="150"> 
                  </button>
                  </a>
                </td>
                <td>
                  <a class ="c2" style="text-decoration:none ">
                    <button>
                     <img  src="<?php echo base_url();?>assets/img/2.png" height="150" width="150"> 
                    </button>
                  </a>
                </td>
                <td>
                  <a class ="c3" style="text-decoration:none ">
                    <button>
                      <img  src="<?php echo base_url();?>assets/img/3.png" height="150" width="150"> 
                    </button>
                  </a>
                </td>
                <td >
                  <!-- <a class ="c3" style="text-decoration:none "> -->
                  <button id = "clear">
                    <img  src="<?php echo base_url();?>assets/img/c.png" height="150" width="150">
                  </button> 
                  <!-- </a> -->
                </td>
              </tr>
              <tr>
                <td>
                  <a class ="c4" style="text-decoration:none ">
                    <button>
                      <img  src="<?php echo base_url();?>assets/img/4.png" height="150" width="150"> 
                    </button>
                  </a>
                </td>
                <td>
                  <a class ="c5" style="text-decoration:none ">
                    <button>
                      <img  src="<?php echo base_url();?>assets/img/5.png" height="150" width="150"> 
                    </button>
                  </a>
                </td>
                <td>
                  <a class ="c6" style="text-decoration:none ">
                    <button>
                      <img  src="<?php echo base_url();?>assets/img/6.png" height="150" width="150"> 
                    </button>
                  </a>
                </td>
                <td rowspan ="2">
                  <!-- <a class ="c3" style="text-decoration:none "> -->
                  <button id = "confirm">
                    <img  src="<?php echo base_url();?>assets/img/thai_ok.png" height="306" width="150">
                  </button> 
                  <!-- </a> -->
                </td>
              </tr>
              <tr>
                <td>
                  <a class ="c7" style="text-decoration:none ">
                    <button>
                      <img  src="<?php echo base_url();?>assets/img/7.png" height="150" width="150"> 
                    </button>
                  </a>
                </td>
                <td>
                  <a class ="c8" style="text-decoration:none ">
                    <button>
                      <img  src="<?php echo base_url();?>assets/img/8.png" height="150" width="150"> 
                    </button>
                  </a>
                </td>
                <td>
                  <a class ="c9" style="text-decoration:none ">
                    <button>
                      <img  src="<?php echo base_url();?>assets/img/9.png" height="150" width="150"> 
                    </button>
                  </a>
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
 <!--  <audio>  </audio> -->
<script> 
  var socket = io.connect( 'http://'+window.location.hostname+':3000' );
  $('#channel tr td a').click(function(){
    var cid = $(this).attr('class');
    var chanel = cid.substring(1);
    //var hn = $(this).parent().parent().parent().parent().children(0).children(0).children(0).children(0).eq(0).children(0)[1].value;
    //console.log( hn );
    var hn = document.getElementById("inputValid").value;
    if(hn != 0){
      if(hn.length == ''){
        alert('กรุณากรอก HN ');
      }else if(hn.length<localStorage.getItem('hnLen') && hn.length !=''){
        hn = hn.padStart(localStorage.getItem('hnLen'), '0');
        
        socket.emit('call_to_phama_room', {  
          hn: hn,
          chanel: chanel
        });

        /*socket.emit('call_to_phama_room2', {  
          hn: hn,
          chanel: chanel
        });*/

      }else if(hn.length == localStorage.getItem('hnLen')){

        socket.emit('call_to_phama_room', {  
          hn: hn,
          chanel: chanel
        });

        /*socket.emit('call_to_phama_room2', {  
          hn: hn,
          chanel: chanel
        });*/

      }else{
        alert('HN ไม่ถูกต้อง');
      }
    }
    

  });

  if(localStorage.getItem('hnLen')==null){
    $.ajax({
          type: "POST",
          url: base_url+"index.php/Config/hnLen",
          dataType: 'json',
          success: 
              function(data) {
                  console.log(data[0].hn_len);
                  localStorage.setItem('hnLen', data[0].hn_len);
          }
      });
  }

  $('#confirm').click(function(){
    var hn = document.getElementById("inputValid").value;
    if(hn != 0){
        hn = hn.padStart(localStorage.getItem('hnLen'), '0');
        console.log(hn);
        socket.emit('refesh_phama_queue', {  
                    refesh: 'refesh',
                    hn: hn
        });
        
      }
      document.getElementById("inputValid").value='';
      document.getElementById("inputValid").focus();
  });

  $('#clear').click(function(){
    document.getElementById("inputValid").value='';
    document.getElementById("inputValid").focus();
  });
  // 
 /* $("#inputValid").on("keyup", function() {
    if ($(this).val().length == 9) {
      
      var data = document.getElementById("inputValid").value;
      console.log(data );
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

      //$("#submit-button").trigger('click');
      //console.log(data);
    }
  });*/

  //$('#inputValid').keyup(function () {
  //  var data = document.getElementById("inputValid").value;
  //  console.log(data );
  //});
    
</script>
</body>

</html>
