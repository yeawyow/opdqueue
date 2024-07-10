const { createServer } = require('net');

var io = require('socket.io-client')('http://localhost:3000');

const server = createServer();
let counter = 0;
let sockets = {}

server.on('connection', socket => {
  socket.setEncoding('utf8');
  socket.id = counter++;
  
  console.log('client has connected')

  socket.on('data', data => {
    if(!sockets[socket.id]) {
      console.log('call_to_exam_room:',data);
      io.emit( 'call_to_exam_room', { 
        hosxp:data
      });
    }
  });

  process.on('uncaughtException', function(error) {
      errorManagement.handler.handleError(error);
      if(!errorManagement.handler.isTrustedError(error))
      process.exit(1)
  });

})

server.listen(8188, () => console.log('Server started'));
