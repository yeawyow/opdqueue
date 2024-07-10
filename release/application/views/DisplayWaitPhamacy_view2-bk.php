
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
        <h3 style="color:#FFFFFF;">รอรับยา โรงพยาบาลวานรนิวาส</h3>
      </li>
      <li class="dropdown"><a class="app-nav__item" data-toggle="modal" data-target="#myModal"><i
            class="fa fa-cogs fa-lg"></i></a>
        
      </li>
    </ul>
  </header>
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>

  <main class="app-content">
    <div class="app-title">
      <!-- <div class="row">  -->
      <div class="col-md-12">

        <div class="table-responsive">
          <!-- <div class="table-responsive"></div> -->
         
          <table class="table" >
              <col style="width:15%">
              <col style="width:85%">
             
            <?php foreach ($pt as $item):?>
            <tbody>
              <tr id="blink_<?php echo $item->hn;?>" style="color:#FFFFFF;font-size:48px; background-color:#003300">
                <td><?php echo $item->oqueue;?></td>
                <td>
                  <strong>
                    <?php echo $item->ptname?>
                  </strong>&nbsp
                </td>
                <td><strong id ="chanel_<?php echo $item->hn;?>"></strong></td>
                <input type="hidden" id='hn_<?php echo $item->hn;?>' value='<?php echo $item->oqueue;?>'>
                <input type="hidden" id='vn_<?php echo $item->hn;?>' value='<?php echo $item->vn;?>'>
              </tr>
             
            </tbody>
            <?php endforeach;?>
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
          //
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

    socket.on("call_to_phama_room2",function ( data ){
        console.log(data);
        var firstname = data.hn+'.mp3';
        var queueNumber = document.getElementById("hn_"+data.hn).value+'.mp3';
        var station = 'drug_'+data.chanel+'.mp3';
        //var hn = document.getElementById("hn").value;
        console.log(document.getElementById("hn_"+data.hn).value);
      
      if(localStorage.getItem('QueueOrNameCalling')=='Y'){
        console.log('ใช้คิว');
        //var queueNumber = data.Queue+'.mp3';
        
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
       // var firstname = data.HN+'.mp3';
        //var station = data.station+'.mp3';
        //var queue = data.Queue; 
        //console.log(queue);
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
      $('#chanel_'+data.hn).html( data.chanel );

      document.getElementById('blink_'+data.hn).style.backgroundColor='#800000'
      function blink_text() {
        $('#blink_'+data.hn).fadeOut(2000);
        $('#blink_'+data.hn).fadeIn(500);
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