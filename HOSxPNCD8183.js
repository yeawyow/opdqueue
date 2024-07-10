const { createServer } = require('net');

var io = require('socket.io-client')('http://localhost:3000');

const server = createServer();
let counter = 0;
let sockets = {}

server.on('connection', socket => {

    socket.setEncoding('utf8');

    socket.setTimeout(1000);

    socket.id = counter++;
    
    console.log('client has connected')

    socket.on('data', data => {
        if(!sockets[socket.id]) {
        console.log('HOSxPNCD :',data);
        io.emit( 'HOSxPNCD', { 
            hosxp:data
        });
        }
        
    });

    process.on('uncaughtException', function(error) {
        errorManagement.handler.handleError(error);
        if(!errorManagement.handler.isTrustedError(error))
        process.exit(1)
    });

    socket.on('timeout', function () {
        console.log('Client request time out. ');
    })

})

server.listen(8183, () => console.log('Server started'));