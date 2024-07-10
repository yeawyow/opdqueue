var express = require('express');
var app = express();
var amqp = require('amqplib/callback_api');

const port = 8081;
amqp.connect('amqp://192.168.0.163',(err,conn)=>{
    conn.createChannel((err,ch)=>{
        var queue = 'FirstQueue';
        
        var message = {type:'2',content:'Hello RabbitMQ'};

        ch.assertQueue(queue,{durable:false});
        ch.sendToQueue(queue,Buffer.from(JSON.stringify(message)));
        console.log('Message was sent');  
        
        ch.consume(queue,(message)=>{
            console.log(`Received ${message.content}`);  
        },{noAck: true});
    });

    setTimeout(()=>{
        conn.close();
       // process.exit(0);    
    
    },3000);
});
/*
conn.createChannel((err,ch)=>{
    var queue = 'FirstQueue';
    
    ch.assertQueue(queue,{durable:false});
     console.log(`Waiting for message in ${queue}`);
    ch.consume(queue,(message)=>{
        console.log(`Received ${message.content}`);  
    },{noAck: true});
      
});*/

app.listen(port, () => console.log(`App listening on port ${port}!`))