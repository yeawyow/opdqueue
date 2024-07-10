var express = require('express');
var app = module.exports = express();

var server = require('http').createServer(app);

// Hook Socket.io into Express
var io = require('socket.io').listen(server);



app.get('/',function(req,res){
  res.end('Hello World\n');
});

io.on('connection', function(socket){

  socket.on( 'hn', function( data ) {
    console.log(data);
    io.sockets.emit( 'hn', { 
      HN:data.HN,
      Queue:data.queue,
      Station:data.station,
      fname:data.fname,
      lname:data.lname
      
    });
  });

  socket.on( 'call_to_exam_room', function( data ) {
    console.log(data);
    io.sockets.emit( 'call_to_exam_room', { 
      fname:data.fname,
      lname:data.lname,
      station:data.roomno
    });
  });

  socket.on( 'call_to_phama_room', function( data ) {
    console.log(data);
    io.sockets.emit( 'call_to_phama_room', { 
      fname:data.fname,
      lname:data.lname,
      station:data.roomno
    });
  });

  socket.on( 'call_to_phama_room2', function( data ) {
    console.log(data);
    io.sockets.emit( 'call_to_phama_room2', { 
      fname:data.fname,
      lname:data.lname,
      station:data.roomno
    });
  });

  socket.on('refesh_phama_queue', function( data ) {
    console.log(data);
    io.sockets.emit( 'refesh_phama_queue', { 
      refesh:data.refesh
    });
  });


});

server.listen(3000, function() {
  console.log("Express server listening on port %d in %s mode", this.address().port, app.settings.env);
});


