
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
           
  </style>

</head>

<body class="app ">
  <!-- Navbar-->
  <header class="app-header">

    <ul class="app-nav">
      <li class="app-search">
        <h3 style="color:#FFFFFF;">รอรับยา โรงพยาบาลวานรนิวาส</h3>
      </li>
      <li class="dropdown"><a class="app-nav__item" data-toggle="modal" data-target="#myModal"><i
            class="fa fa-cogs fa-lg"></i></a>
        
      </li>
    </ul>
  </header>
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>

  <main class="app-content">
  <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="widget-small primary coloured-icon" ><i class="icon" ><strong>1</strong></i>
                <div class="info" id="ch1" style="color:#003300;font-size:50px;"><strong></strong></div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
          <div class="widget-small primary coloured-icon"><i class="icon" ><strong>2</strong></i>
              <div class="info" id="ch2" style="color:#003300;font-size:50px;"><strong></strong></div>
          </div>
        </div>
        <div class="col-md-6 col-lg-6">
          <div class="widget-small primary coloured-icon"><i class="icon" ><strong>3</strong></i>
              <div class="info" id="ch3" style="color:#003300;font-size:50px;"><strong></strong></div>
          </div>
        </div>
        <div class="col-md-6 col-lg-6">
          <div class="widget-small primary coloured-icon"><i class="icon" ><strong>4</strong></i>
              <div class="info" id="ch4" style="color:#003300;font-size:50px;"><strong></strong></div>
          </div>
         
        </div>
      </div><br />
    <div class="app-title">
    
      <!-- <div class="row">  -->
      <div class="col-md-12">

        <div class="table-responsive">
          <!-- <div class="table-responsive"></div> -->
         
          <table class="table" id="tblNormal" >
              <col style="width:15%">
              <col style="width:85%">
             
            
            <tbody>
            <?php foreach ($pt as $item):?>
              <tr id="blink_<?php echo $item->hn;?>" style="color:#FFFFFF;font-size:48px; background-color:#003300">
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
                <td><strong id ="chanel_<?php echo $item->hn;?>"></strong></td>
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
      <!--  two table -->
    
      <!--  </div> -->
      <div class="modal" id="myModal" >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Modal title</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
              <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" type="button">Save changes</button>
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            </div>
          </div>
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
        //var hn = document.getElementById("hn").value;
        console.log(document.getElementById("hn_"+data.hn).value);
        //console.log($('#tblNormal').find("tr:eq(1)").find("td:eq(0)").html())
        console.log(document.getElementById("blink_"+data.hn).children[1].children[0].innerText );
        //console.log(document.getElementById("tblNormal").children[1].children);
        var tbl = document.getElementById("tblNormal");
        var rowNum = document.getElementById("blink_"+data.hn).rowIndex;
        //$(this).parent().parent().parent().children(0).html()
        //console.log(document.getElementById("blink_"+data.hn).rowIndex );

        if(data.chanel==1){
          list = document.getElementById("ch1");
          list.removeChild(list.childNodes[0]);
          $('#ch1').append('<strong >'+ptname+'</strong>');
          //tbl.deleteRow(rowNum);
          function blink_chanel1() {
              $('#ch1').fadeOut(2000);
              $('#ch1').fadeIn(1000);
          }
          setInterval(blink_chanel1, 1000);

        }else if(data.chanel==2){
          list = document.getElementById("ch2");
          list.removeChild(list.childNodes[0]);
          $('#ch2').append('<strong >'+ptname+'</strong>');
          //tbl.deleteRow(rowNum);
          function blink_chanel2() {
              $('#ch2').fadeOut(2000);
              $('#ch2').fadeIn(1000);
          }
          setInterval(blink_chanel2, 1000);
        }else if(data.chanel==3){
          list = document.getElementById("ch3");
          list.removeChild(list.childNodes[0]);

          $('#ch3').append('<strong >'+ptname+'</strong>');
          //tbl.deleteRow(rowNum);
          function blink_chanel3() {
              $('#ch3').fadeOut(2000);
              $('#ch3').fadeIn(1000);
          }
          setInterval(blink_chanel3, 1000);
        }else if(data.chanel==4){
          list = document.getElementById("ch4");
          list.removeChild(list.childNodes[0]);

          $('#ch4').append('<strong >'+ptname+'</strong>');
          //tbl.deleteRow(rowNum);
          function blink_chanel4() {
              $('#ch4').fadeOut(2000);
              $('#ch4').fadeIn(1000);
          }
          setInterval(blink_chanel4, 1000);
        }else if(data.chanel==5){
          list = document.getElementById("ch5");
          list.removeChild(list.childNodes[0]);

          $('#ch5').append('<strong >'+ptname+'</strong>');
          //tbl.deleteRow(rowNum);
          function blink_chanel5() {
              $('#ch5').fadeOut(2000);
              $('#ch5').fadeIn(1000);
          }
          setInterval(blink_chanel5, 1000);
        }else if(data.chanel==6){
          list = document.getElementById("ch6");
          list.removeChild(list.childNodes[0]);

          $('#ch6').append('<strong >'+ptname+'</strong>');
          //tbl.deleteRow(rowNum);
          function blink_chanel6() {
              $('#ch6').fadeOut(2000);
              $('#ch6').fadeIn(1000);
          }
          setInterval(blink_chanel6, 1000);
        }else if(data.chanel==7){
          list = document.getElementById("ch7");
          list.removeChild(list.childNodes[0]);

          $('#ch7').append('<strong >'+ptname+'</strong>');
          //tbl.deleteRow(rowNum);
          function blink_chanel7() {
              $('#ch7').fadeOut(2000);
              $('#ch7').fadeIn(1000);
          }
          setInterval(blink_chanel7, 1000);
        }else if(data.chanel==8){
          list = document.getElementById("ch8");
          list.removeChild(list.childNodes[0]);

          $('#ch8').append('<strong >'+ptname+'</strong>');
          //tbl.deleteRow(rowNum);
          function blink_chanel8() {
              $('#ch8').fadeOut(2000);
              $('#ch8').fadeIn(1000);
          }
          setInterval(blink_chanel8, 1000);
        }else if(data.chanel==9){
          list = document.getElementById("ch9");
          list.removeChild(list.childNodes[0]);

          $('#ch9').append('<strong >'+ptname+'</strong>');
          //tbl.deleteRow(rowNum);
          function blink_chanel9() {
              $('#ch9').fadeOut(2000);
              $('#ch9').fadeIn(1000);
          }
          setInterval(blink_chanel9, 1000);
        }else if(data.chanel==10){
          list = document.getElementById("ch10");
          list.removeChild(list.childNodes[0]);

          $('#ch10').append('<strong >'+ptname+'</strong>');
          //tbl.deleteRow(rowNum);
          function blink_chanel10() {
              $('#ch10').fadeOut(2000);
              $('#ch10').fadeIn(1000);
          }
          setInterval(blink_chanel10, 1000);
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
      $('#chanel_'+data.hn).html( data.chanel );
      document.getElementById('blink_'+data.hn).style.backgroundColor='#800000'
      function blink_text() {
        $('#blink_'+data.hn).fadeOut(2000);
        $('#blink_'+data.hn).fadeIn(500);
      }
      setInterval(blink_text, 5000);

    })

</script>

</body>

</html>