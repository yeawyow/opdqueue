const { createServer } = require('net');

var io = require('socket.io-client')('http://localhost:3000');

const server = createServer();
let counter = 0;
let sockets = {}

server.on('connection', socket => {
    socket.setEncoding('utf8');

    socket.id = counter++;
  
  console.log('client has connected')
 // socket.write('Please enter your name: ')

  socket.on('data', data => {
    if(!sockets[socket.id]) {
      //socket.name = data.toString().trim();
      //socket.write(`Welcome ${socket.name}!\n`);
      //sockets[socket.id] = socket;
      //return;
      console.log('HOSxPScreen :',data);
      io.emit( 'HOSxPScreen', { 
        hosxp:data
      });
    }
   /* Object.entries(sockets).forEach(([key, cs]) => {
    console.log(`${socket.id}: ${data}`)
      if (key != socket.id) {
        cs.write(`${socket.name}: `);
        cs.write(data);
      }
    })*/
    
  });
 /*  socket.on('end', data => {
    delete sockets[socket.id];
    Object.entries(sockets).forEach(([keys, sc]) => {
      sc.write(`${socket.name}: `);
      sc.write('has disconnected\n');
    })
    console.log(`${socket.name} has disconnected`)
  }) */
    process.on('uncaughtException', function(error) {
        errorManagement.handler.handleError(error);
        if(!errorManagement.handler.isTrustedError(error))
        process.exit(1)
    });

})

server.listen(8181, () => console.log('Server started'));
