const express = require('express');
const gTTS = require('gtts');
const fs = require("fs");
var pool = require('./dbHIS');
var conq = require('./dbQueue');
const jong = require("gtts.js").gTTS;
const moment = require('moment');

var app = module.exports = express();

var server = require('http').createServer(app);

var io = require('socket.io').listen(server);


var CallQueue = '';
var SubQ = '';
var DrugQ = '';
conq.query("SELECT call_queue,sub_queue,drug_queue FROM `sys_configs`", function (err, result, fields) {
    // if any error while executing above query, throw error
    if (err) throw err;
    // if there is no error, you have the result
    CallQueue = result[0].call_queue;
    SubQ = result[0].sub_queue;
    DrugQ = result[0].drug_queue;
    console.log('CallQueue : ',CallQueue);
    console.log('SubQ : ',SubQ);
    console.log('DrugQ : ',DrugQ);
});
conq.end();

io.on('connection', function(socket){

    socket.on('HOSxPScreen', function (data) {
        console.log('HOSxP Send :',data.hosxp.split('\n')[3])
        var a = data.hosxp;
        var b = a.split('\n');
        var c = b.pop();
        var d = c.split(';');
        var queue = d[2].split('=')[1];
        var h = d[3].split('=')[1].substring(2);
        var hn = h.substring(0,h.length-1);
        var s = d[4].split('=')[1].substring(2); 
        var station = s.substring(0,s.length-1);

        var checkRename = 'SELECT COUNT(*)AS cc FROM patient_nc WHERE hn=?';

        var ptname = 'SELECT CONCAT("เชิญคุณ",fname,lname)AS ptname FROM patient WHERE hn=?';

        var ptRename = `SELECT CONCAT("เชิญคุณ",a.fname,a.lname)AS pname,b.new_fname,b.new_lname,CAST(b.cdate AS char)as cdate,
        IF(CONCAT(a.fname,a.lname)=CONCAT(b.new_fname,b.new_lname),'1','0')AS chk
        FROM  patient a
        INNER JOIN (SELECT hn,new_fname,new_lname,cdate FROM patient_nc WHERE hn=`+hn+` ORDER BY cdate  DESC LIMIT 1)AS b ON a.hn=b.hn
        where a.hn=?`;
        
        if(CallQueue == 'Y'&& SubQ=='N'){
            fs.exists('audio/'+queue+'.mp3', function(exists) {
                if(exists==false){
                    const tts = new jong('เชิญหมายเลข'+queue,'th');
                    tts.save('audio/'+queue+'.mp3')
                        .then(() => {
                            console.log('load Queue number mp3',queue);
                            io.sockets.emit( 'hn', { 
                                HN:hn,
                                Queue:queue,
                                Station:station,
                                CallQueue:'Y'
                            });
                        })
                        .catch((err) => {
                            console.log('failed :'+queue);
                        });

                }else{
                    io.sockets.emit( 'hn', { 
                        HN:hn,
                        Queue:queue,
                        Station:station,
                        CallQueue:'Y'
                    });
                }
            })
            
        }else if(CallQueue == 'Y' && SubQ =='Y'){
            var y = dThai();
            console.log(y);
            var sq = `SELECT v.main_dep_queue FROM ovst v  
            WHERE v.vstdate='`+y+`' AND hn=?`;
            pool.getConnection(function(err, con) {
                con.query(sq,[hn], function(err, rows) {
                    if (err) throw err;
                    console.log('xxxxxxxxx',rows);
                    Object.keys(rows).forEach(function(key) {
                        var row = rows[key];
                        console.log('row.main_dep_queue :',row.main_dep_queue);
                        io.sockets.emit( 'hn', { 
                            HN:hn,
                            Queue:row.main_dep_queue,
                            Station:station,
                            CallQueue:'Y'
                        });
                       // console.log('99999999');
                    });
                    con.release();
                });
            });

        }else{
            pool.getConnection(function(err, con) {
                con.query(checkRename,[hn], function(err, rows) {
                    if (err) throw err;
                    Object.keys(rows).forEach(function(key) {
                        var row = rows[key];
                        if(row.cc==0){
                            if (fs.existsSync('audio/'+hn+'.mp3')) {
                                console.log('มีไฟล์แล้ว');
                                io.sockets.emit( 'hn', { 
                                    HN:hn,
                                    Queue:queue,
                                    Station:station,
                                    CallQueue:'N'
                                });

                            }else{
                                pool.getConnection(function(err, con) {
                                    con.query("SET NAMES UTF8");
                                    con.query(ptname,[hn], function(err, rows) {
                                        if (err) throw err;
                                        Object.keys(rows).forEach(function(key) {
                                            var row = rows[key];
                                            const tts = new jong(row.ptname,'th');
                                            tts.save('audio/'+hn+'.mp3')
                                                .then(() => {
                                                    console.log('โหลดไฟล์ใหม่ ชื่อ-นามสกุล mp3',hn);
                                                    io.sockets.emit( 'hn', { 
                                                        HN:hn,
                                                        Queue:queue,
                                                        Station:station,
                                                        CallQueue:'N'
                                                    });
                                                })
                                                .catch((err) => {
                                                    console.log('failed :'+hn);
                                                });

                                        }); 
                                        //console.log(rows); 
                                    });
                                    con.release();
                                });
                            }
                            
                        }else{
                            pool.getConnection(function(err, con) {
                                con.query("SET NAMES UTF8");
                                con.query(ptRename,[hn], function(err, result) {
                                    if (err) throw err;
                                    Object.keys(result).forEach(function(key) {
                                        var row = result[key];
                                        console.log(row.cdate);
                                        fs.exists('audio/'+hn+'.mp3', function(exists) {
                                            console.log("file exists ? " + exists);
                                            if(exists==false){
                                                const tts = new jong(row.pname,'th');
                                                tts.save('audio/'+hn+'.mp3')
                                                    .then(() => {
                                                        console.log('เปลี่ยนชื่อโหลดไฟล์ใหม่  mp3',hn);
                                                        io.sockets.emit( 'hn', { 
                                                            HN:hn,
                                                            Queue:queue,
                                                            Station:station,
                                                            CallQueue:'N'
                                                        });
                                                    })
                                                    .catch((err) => {
                                                        console.log('failed :'+hn);
                                                    });
                                            }else{
                                                var cf = createdDate('audio/'+hn+'.mp3');
                                                compFile = new Date(cf).toISOString().replace(/T/, ' ').replace(/\..+/, '');  
                                                getDate = compFile.split(' '); 
                                                console.log(getDate[0]);
                                                if(row.cdate>getDate[0]){
                                                    const tts = new jong(row.pname,'th');
                                                    tts.save('audio/'+hn+'.mp3')
                                                        .then(() => {
                                                            console.log('เปลี่ยนชื่อโหลดไฟล์ใหม่  mp3',hn);
                                                            io.sockets.emit( 'hn', { 
                                                                HN:hn,
                                                                Queue:queue,
                                                                Station:station,
                                                                CallQueue:'N'
                                                            });
                                                        })
                                                        .catch((err) => {
                                                            console.log('failed :'+hn);
                                                        });
                                                }else{
                                                    console.log('เคยเปลี่ยนชื่อใช้ไฟล์เดิม');
                                                    io.sockets.emit( 'hn', { 
                                                        HN:hn,
                                                        Queue:queue,
                                                        Station:station,
                                                        CallQueue:'N'
                                                    });
                                                }
                                            }
                                        }); 
                                        
                                    }); 
                                    // console.log(result); 
                                });
                            con.release();
                            });
                        }
                    }); 
                    //console.log(rows); 
                });
                con.release();
            });
           
        }
       
    }); //end HOSxPScreen

    // start HOSxPPhama
    socket.on('HOSxPPhama', function (data) {

        // Print received client data and length.
        //console.log('Receive client send data : ' + data + ', data size : ' + client.bytesRead);
        var a = data.hosxp;
        var b = a.split('\n');
        var c = b.pop();
        var d = c.split(';');
        var queue = d[2].split('=')[1];
        var h = d[3].split('=')[1].substring(2);
        var hn = h.substring(0,h.length-1);
        var s = d[4].split('=')[1].substring(2); 
        var station = s.substring(0,s.length-1);

        var checkRename = 'SELECT COUNT(*)AS cc FROM patient_nc WHERE hn=?';

        var ptname = 'SELECT CONCAT("เชิญคุณ",fname,lname)AS ptname FROM patient WHERE hn=?';

        var ptRename = `SELECT CONCAT("เชิญคุณ",a.fname,a.lname)AS pname,b.new_fname,b.new_lname,CAST(b.cdate AS char)as cdate,
        IF(CONCAT(a.fname,a.lname)=CONCAT(b.new_fname,b.new_lname),'1','0')AS chk
        FROM  patient a
        INNER JOIN (SELECT hn,new_fname,new_lname,cdate FROM patient_nc WHERE hn=`+hn+` ORDER BY cdate  DESC LIMIT 1)AS b ON a.hn=b.hn
        where a.hn=?`;
        
        if(CallQueue == 'Y' && DrugQ == '1'){
            fs.exists('audio/'+queue+'.mp3', function(exists) {
                if(exists==false){

                    const tts = new jong('เชิญหมายเลข'+queue,'th');
                    tts.save('audio/'+queue+'.mp3')
                        .then(() => {
                            console.log('load Queue number mp3',queue);
                            io.sockets.emit( 'call_to_phama_room', { 
                                hn:hn,
                                Queue:queue,
                                chanel:station,
                                CallQueue:'Y'
                            });
                            io.sockets.emit( 'call_to_phama_room2', { 
                                hn:hn,
                                Queue:queue,
                                chanel:station,
                                CallQueue:'Y'
                            });
                        })
                        .catch((err) => {
                            console.log('failed :'+queue);
                        });

                }else{
                    io.sockets.emit( 'call_to_phama_room', { 
                        hn:hn,
                        Queue:queue,
                        chanel:station,
                        CallQueue:'Y'
                    });
                    io.sockets.emit( 'call_to_phama_room2', { 
                        hn:hn,
                        Queue:queue,
                        chanel:station,
                        CallQueue:'Y'
                    });
                }
            })
            
        }else if(CallQueue == 'Y' && DrugQ == '2'){
            var y = dThai();
            var _rxq = `SELECT rx_queue FROM ovst WHERE vstdate='`+y+`' AND hn=?`;
            var rx_queue = '';
            pool.getConnection(function(err, con) {
                con.query(_rxq,[hn], function(err, rows) {
                    if (err) throw err;
                    Object.keys(rows).forEach(function(key) {
                        var row = rows[key];
                        rx_queue = row.rx_queue;
                    });
                });
                con.release();
            });

            fs.exists('audio/'+rx_queue+'.mp3', function(exists) {
                if(exists==false){
                    const tts = new jong('เชิญหมายเลข'+rx_queue,'th');
                    tts.save('audio/'+rx_queue+'.mp3')
                        .then(() => {
                            console.log('load Queue number mp3',rx_queue);
                            io.sockets.emit( 'call_to_phama_room', { 
                                hn:hn,
                                Queue:rx_queue,
                                chanel:station,
                                CallQueue:'Y'
                            });
                            io.sockets.emit( 'call_to_phama_room2', { 
                                hn:hn,
                                Queue:rx_queue,
                                chanel:station,
                                CallQueue:'Y'
                            });
                        })
                        .catch((err) => {
                            console.log('failed :'+rx_queue);
                        });

                }else{
                    io.sockets.emit( 'call_to_phama_room', { 
                        hn:hn,
                        Queue:rx_queue,
                        chanel:station,
                        CallQueue:'Y'
                    });
                    io.sockets.emit( 'call_to_phama_room2', { 
                        hn:hn,
                        Queue:rx_queue,
                        chanel:station,
                        CallQueue:'Y'
                    });
                }
            })
        }else{
            pool.getConnection(function(err, con) {
                con.query(checkRename,[hn], function(err, rows) {
                    if (err) throw err;
                    Object.keys(rows).forEach(function(key) {
                        var row = rows[key];
                        if(row.cc==0){
                            if (fs.existsSync('audio/'+hn+'.mp3')) {
                                console.log('มีไฟล์แล้ว');
                                io.sockets.emit( 'call_to_phama_room', { 
                                    hn:hn,
                                    Queue:queue,
                                    chanel:station,
                                    CallQueue:'N'
                                });
                                io.sockets.emit( 'call_to_phama_room2', { 
                                    hn:hn,
                                    Queue:queue,
                                    chanel:station,
                                    CallQueue:'N'
                                });

                            }else{
                                pool.getConnection(function(err, con) {
                                    con.query("SET NAMES UTF8");
                                    con.query(ptname,[hn], function(err, rows) {
                                        if (err) throw err;
                                        Object.keys(rows).forEach(function(key) {
                                            var row = rows[key];
                                            
                                            /*var gtts = new gTTS(row.ptname, 'th');
                                            gtts.save('audio/'+hn+'.mp3', function (err, result) {
                                                if(err) { throw new Error(err) }
                                                console.log('โหลดไฟล์ใหม่!');
                                                io.sockets.emit( 'hn', { 
                                                    HN:hn,
                                                    Queue:queue,
                                                    Station:station,
                                                    CallQueue:'N'
                                                });
                                            });*/
                                            const tts = new jong(row.ptname,'th');
                                            tts.save('audio/'+hn+'.mp3')
                                                .then(() => {
                                                    console.log('โหลดไฟล์ใหม่ ชื่อ-นามสกุล mp3',hn);
                                                    io.sockets.emit( 'call_to_phama_room', { 
                                                        hn:hn,
                                                        Queue:queue,
                                                        chanel:station,
                                                        CallQueue:'N'
                                                    });
                                                    io.sockets.emit( 'call_to_phama_room2', { 
                                                        hn:hn,
                                                        Queue:queue,
                                                        chanel:station,
                                                        CallQueue:'N'
                                                    });
                                                })
                                                .catch((err) => {
                                                    console.log('failed :'+hn);
                                                });

                                        }); 
                                        //console.log(rows); 
                                    });
                                con.release();
                                }); 
                            }
                            
                        }else{
                            pool.getConnection(function(err, con) {
                                con.query("SET NAMES UTF8");
                                con.query(ptRename,[hn], function(err, result) {
                                    if (err) throw err;
                                    Object.keys(result).forEach(function(key) {
                                        var row = result[key];
                                        console.log(row.cdate);
                                        fs.exists('audio/'+hn+'.mp3', function(exists) {
                                            console.log("file exists ? " + exists);
                                            if(exists==false){
                                                
                                                /*var gtts = new gTTS(row.pname, 'th');
                                                gtts.save('audio/'+hn+'.mp3', function (err, res) {
                                                    if(err) { throw new Error(err) }
                                                    console.log('gtts x:', gtts)
                                                    console.log('เปลี่ยนชื่อโหลดไฟล์ใหม่');
                                                    io.sockets.emit( 'hn', { 
                                                        HN:hn,
                                                        Queue:queue,
                                                        Station:station,
                                                        CallQueue:'N'
                                                    });
                                                });*/

                                                const tts = new jong(row.pname,'th');
                                                tts.save('audio/'+hn+'.mp3')
                                                    .then(() => {
                                                        console.log('เปลี่ยนชื่อโหลดไฟล์ใหม่  mp3',hn);
                                                        io.sockets.emit( 'call_to_phama_room', { 
                                                            hn:hn,
                                                            Queue:queue,
                                                            chanel:station,
                                                            CallQueue:'N'
                                                        });
                                                        io.sockets.emit( 'call_to_phama_room2', { 
                                                            hn:hn,
                                                            Queue:queue,
                                                            chanel:station,
                                                            CallQueue:'N'
                                                        });
                                                    })
                                                    .catch((err) => {
                                                        console.log('failed :'+hn);
                                                    });
                                            }else{
                                                var cf = createdDate('audio/'+hn+'.mp3');
                                                compFile = new Date(cf).toISOString().replace(/T/, ' ').replace(/\..+/, '');  
                                                getDate = compFile.split(' '); 
                                                console.log(getDate[0]);
                                                if(row.cdate>getDate[0]){

                                                /* var gtts = new gTTS(row.pname, 'th');
                                                    gtts.save('audio/'+hn+'.mp3', function (err, res) {
                                                        console.log('gtts y :', gtts)
                                                        if(err) { throw new Error(err) }
                                                        console.log('เปลี่ยนชื่อโหลดไฟล์ใหม่');
                                                        io.sockets.emit( 'hn', { 
                                                            HN:hn,
                                                            Queue:queue,
                                                            Station:station,
                                                            CallQueue:'N'
                                                        });
                                                    });*/
                                                    const tts = new jong(row.pname,'th');
                                                    tts.save('audio/'+hn+'.mp3')
                                                        .then(() => {
                                                            console.log('เปลี่ยนชื่อโหลดไฟล์ใหม่  mp3',hn);
                                                            io.sockets.emit( 'call_to_phama_room', { 
                                                                hn:hn,
                                                                Queue:queue,
                                                                chanel:station,
                                                                CallQueue:'N'
                                                            });
                                                            io.sockets.emit( 'call_to_phama_room2', { 
                                                                hn:hn,
                                                                Queue:queue,
                                                                chanel:station,
                                                                CallQueue:'N'
                                                            });
                                                        })
                                                        .catch((err) => {
                                                            console.log('failed :'+hn);
                                                        });
                                                }else{
                                                    console.log('เคยเปลี่ยนชื่อใช้ไฟล์เดิม');
                                                    io.sockets.emit( 'call_to_phama_room', { 
                                                        hn:hn,
                                                        Queue:queue,
                                                        chanel:station,
                                                        CallQueue:'N'
                                                    });
                                                    io.sockets.emit( 'call_to_phama_room2', { 
                                                        hn:hn,
                                                        Queue:queue,
                                                        chanel:station,
                                                        CallQueue:'N'
                                                    });
                                                }
                                            }
                                        }); 
                                        
                                    }); 
                                    // console.log(result); 
                                });
                            con.release();
                            });
                        }
                    }); 
                    //console.log(rows); 
                });
            con.release()
            });
        }

    });
    //end HOSxPPhama
    
    socket.on('HOSxPNCD', function (data) {
        console.log('HOSxP Send :',data.hosxp.split('\n')[3])
        var a = data.hosxp;
        var b = a.split('\n');
        var c = b.pop();
        var d = c.split(';');
        var queue = d[2].split('=')[1];
        var h = d[3].split('=')[1].substring(2);
        var hn = h.substring(0,h.length-1);
        var s = d[4].split('=')[1].substring(2); 
        var station = s.substring(0,s.length-1);

        var checkRename = 'SELECT COUNT(*)AS cc FROM patient_nc WHERE hn=?';

        var ptname = 'SELECT CONCAT("เชิญคุณ",fname,lname)AS ptname FROM patient WHERE hn=?';

        var ptRename = `SELECT CONCAT("เชิญคุณ",a.fname,a.lname)AS pname,b.new_fname,b.new_lname,CAST(b.cdate AS char)as cdate,
        IF(CONCAT(a.fname,a.lname)=CONCAT(b.new_fname,b.new_lname),'1','0')AS chk
        FROM  patient a
        INNER JOIN (SELECT hn,new_fname,new_lname,cdate FROM patient_nc WHERE hn=`+hn+` ORDER BY cdate  DESC LIMIT 1)AS b ON a.hn=b.hn
        where a.hn=?`;
        
        if(CallQueue == 'Y'&& SubQ=='N'){
            fs.exists('audio/'+queue+'.mp3', function(exists) {
                if(exists==false){
                    const tts = new jong('เชิญหมายเลข'+queue,'th');
                    tts.save('audio/'+queue+'.mp3')
                        .then(() => {
                            console.log('load Queue number mp3',queue);
                            io.sockets.emit( 'ncd', { 
                                HN:hn,
                                Queue:queue,
                                Station:station,
                                CallQueue:'Y'
                            });
                        })
                        .catch((err) => {
                            console.log('failed :'+queue);
                        });

                }else{
                    io.sockets.emit( 'ncd', { 
                        HN:hn,
                        Queue:queue,
                        Station:station,
                        CallQueue:'Y'
                    });
                }
            })
            
        }else if(CallQueue == 'Y' && SubQ =='Y'){
            var y = dThai();
            console.log(y);
            var sq = `SELECT v.main_dep_queue FROM ovst v  
            WHERE v.vstdate='`+y+`' AND hn=?`;
            pool.getConnection(function(err, con) {
                con.query(sq,[hn], function(err, rows) {
                    if (err) throw err;
                    console.log('xxxxxxxxx',rows);
                    Object.keys(rows).forEach(function(key) {
                        var row = rows[key];
                        console.log('row.main_dep_queue :',row.main_dep_queue);
                        io.sockets.emit( 'ncd', { 
                            HN:hn,
                            Queue:row.main_dep_queue,
                            Station:station,
                            CallQueue:'Y'
                        });
                       // console.log('99999999');
                    });
                    con.release();
                });
            });

        }else{
            pool.getConnection(function(err, con) {
                con.query(checkRename,[hn], function(err, rows) {
                    if (err) throw err;
                    Object.keys(rows).forEach(function(key) {
                        var row = rows[key];
                        if(row.cc==0){
                            if (fs.existsSync('audio/'+hn+'.mp3')) {
                                console.log('มีไฟล์แล้ว');
                                io.sockets.emit( 'ncd', { 
                                    HN:hn,
                                    Queue:queue,
                                    Station:station,
                                    CallQueue:'N'
                                });

                            }else{
                                pool.getConnection(function(err, con) {
                                    con.query("SET NAMES UTF8");
                                    con.query(ptname,[hn], function(err, rows) {
                                        if (err) throw err;
                                        Object.keys(rows).forEach(function(key) {
                                            var row = rows[key];
                                            const tts = new jong(row.ptname,'th');
                                            tts.save('audio/'+hn+'.mp3')
                                                .then(() => {
                                                    console.log('โหลดไฟล์ใหม่ ชื่อ-นามสกุล mp3',hn);
                                                    io.sockets.emit( 'ncd', { 
                                                        HN:hn,
                                                        Queue:queue,
                                                        Station:station,
                                                        CallQueue:'N'
                                                    });
                                                })
                                                .catch((err) => {
                                                    console.log('failed :'+hn);
                                                });

                                        }); 
                                        //console.log(rows); 
                                    });
                                    con.release();
                                });
                            }
                            
                        }else{
                            pool.getConnection(function(err, con) {
                                con.query("SET NAMES UTF8");
                                con.query(ptRename,[hn], function(err, result) {
                                    if (err) throw err;
                                    Object.keys(result).forEach(function(key) {
                                        var row = result[key];
                                        console.log(row.cdate);
                                        fs.exists('audio/'+hn+'.mp3', function(exists) {
                                            console.log("file exists ? " + exists);
                                            if(exists==false){
                                                const tts = new jong(row.pname,'th');
                                                tts.save('audio/'+hn+'.mp3')
                                                    .then(() => {
                                                        console.log('เปลี่ยนชื่อโหลดไฟล์ใหม่  mp3',hn);
                                                        io.sockets.emit( 'ncd', { 
                                                            HN:hn,
                                                            Queue:queue,
                                                            Station:station,
                                                            CallQueue:'N'
                                                        });
                                                    })
                                                    .catch((err) => {
                                                        console.log('failed :'+hn);
                                                    });
                                            }else{
                                                var cf = createdDate('audio/'+hn+'.mp3');
                                                compFile = new Date(cf).toISOString().replace(/T/, ' ').replace(/\..+/, '');  
                                                getDate = compFile.split(' '); 
                                                console.log(getDate[0]);
                                                if(row.cdate>getDate[0]){
                                                    const tts = new jong(row.pname,'th');
                                                    tts.save('audio/'+hn+'.mp3')
                                                        .then(() => {
                                                            console.log('เปลี่ยนชื่อโหลดไฟล์ใหม่  mp3',hn);
                                                            io.sockets.emit( 'ncd', { 
                                                                HN:hn,
                                                                Queue:queue,
                                                                Station:station,
                                                                CallQueue:'N'
                                                            });
                                                        })
                                                        .catch((err) => {
                                                            console.log('failed :'+hn);
                                                        });
                                                }else{
                                                    console.log('เคยเปลี่ยนชื่อใช้ไฟล์เดิม');
                                                    io.sockets.emit( 'ncd', { 
                                                        HN:hn,
                                                        Queue:queue,
                                                        Station:station,
                                                        CallQueue:'N'
                                                    });
                                                }
                                            }
                                        }); 
                                        
                                    }); 
                                    // console.log(result); 
                                });
                            con.release();
                            });
                        }
                    }); 
                    //console.log(rows); 
                });
                con.release();
            });
           
        }
       
    }); //end HOSxPNCD

    socket.on( 'call_to_exam_room', function( data ) {
        console.log(data);
        var q = 'select concat("เชิญคุณ",fname,lname)as ptname from patient where hn=?'
        if (fs.existsSync('audio/'+data.HN+'.mp3')) {
            console.log('ห้องยามีไฟล์แล้ว');
            io.sockets.emit( 'call_to_exam_room', { 
                HN:data.HN,
                Queue:data.queue,
                station:data.roomno
            });
        }else{
            pool.getConnection(function(err, con) {
                con.query("SET NAMES UTF8");
                con.query(q,[data.HN], function(err, rows) {
                    if (err) throw err;
                    Object.keys(rows).forEach(function(key) {
                        var row = rows[key];
                        const tts = new jong(row.ptname,'th');
                        tts.save('audio/'+data.HN+'.mp3')
                            .then(() => {
                                console.log('call_to_exam_room โหลดไฟล์ใหม่ ',data.HN);
                                io.sockets.emit( 'call_to_exam_room', { 
                                    HN:data.HN,
                                    Queue:data.queue,
                                    station:data.roomno
                                });
                            })
                            .catch((err) => {
                                console.log('failed call_to_exam_room โหลดไฟล์ใหม่ :'+data.HN);
                            });
                    }); 
                    //console.log(rows); 
                }); 
            con.release();
            });
        }
    });

    socket.on( 'call_to_phama_room', function( data ) {
        console.log("JONG call_to_phama_room : ",data);
        var q = 'select concat("เชิญคุณ",fname,lname)as ptname from patient where hn=?'
        if (fs.existsSync('audio/'+data.hn+'.mp3')) {
            console.log('ห้องยามีไฟล์แล้ว');
            io.sockets.emit( 'call_to_phama_room', { 
                hn:data.hn,
                //queue:queue,
                chanel:data.chanel
            });
        }else{
            pool.getConnection(function(err, con) {
                console.log('query:xxx');
                con.query("SET NAMES UTF8");
                con.query(q,[data.hn], function(err, rows) {
                    if (err) throw err;
                    Object.keys(rows).forEach(function(key) {
                        var row = rows[key];
                        const tts = new jong(row.ptname,'th');
                        tts.save('audio/'+data.hn+'.mp3')
                            .then(() => {
                                console.log('call_to_phama_room โหลดไฟล์ใหม่ ',data.hn);
                                io.sockets.emit( 'call_to_phama_room', { 
                                    hn:data.hn,
                                    //queue:queue,
                                    chanel:data.chanel
                                });
                            })
                            .catch((err) => {
                                console.log('Internet connection failed ไม่สามารถโหลด mp3:'+data.hn);
                            });
                    });     
                    //console.log(rows); 
                });
            con.release();
            }); 
        }

    });
    
    socket.on( 'call_to_phama_room2', function( data ) {
        console.log(data);
        var q = 'select concat("เชิญคุณ",fname,lname)as ptname from patient where hn=?'
        if (fs.existsSync('audio/'+data.hn+'.mp3')) {
            console.log('ห้องยามีไฟล์แล้ว');
            io.sockets.emit( 'call_to_phama_room2', { 
                hn:data.hn,
                //queue:queue,
                chanel:data.chanel
            });
        }else{
            pool.getConnection(function(err, con) {
                con.query("SET NAMES UTF8");
                con.query(q,[data.hn], function(err, rows) {
                    if (err) throw err;
                    Object.keys(rows).forEach(function(key) {
                        var row = rows[key];
                        const tts = new jong(row.ptname,'th');
                        tts.save('audio/'+data.hn+'.mp3')
                            .then(() => {
                                console.log('call_to_phama_room2 โหลดไฟล์ใหม่ ',data.hn);
                                io.sockets.emit( 'call_to_phama_room2', { 
                                    hn:data.hn,
                                    //queue:queue,
                                    chanel:data.chanel
                                });
                            })
                            .catch((err) => {
                                console.log('Internet connection failed ไม่สามารถโหลด mp3 :'+data.hn);
                            });
                    }); 
                    //console.log(rows); 
                }); 
            con.release();
            });
        }
       
    });

    socket.on('refesh_phama_queue', function( data ) {
        console.log(data);
        io.sockets.emit( 'refesh_phama_queue', { 
            refesh:data.refesh,
            hn:data.hn
        });
    });

    socket.on('loadFile', function( data ) {
        console.log(data);
        if(data.number=='num'){
            for(var i=0;i<=1000;i++){
                const tts = new jong('เชิญหมายเลข'+i,'th');
                tts.save('audio/'+i+'.mp3')
                    .then(() => {
                        console.log(i);
                    })
                    .catch((err) => {
                        console.log('failed :'+i);
                    });
            }
            
        }else if(data.number=='name'){
            /*var fname = `SELECT a.hn,CONCAT('เชิญคุณ',fname,b.lname)AS ptname FROM vn_stat a
            LEFT JOIN patient b ON a.hn=b.hn
            WHERE a.vstdate BETWEEN"2019-01-05"AND"2019-01-05" 
            AND b.lname REGEXP "^[ก-๏\s]+$"
            AND b.death<>"Y"
            GROUP BY a.hn`;*/
            var fname = `SELECT b.hn,CONCAT('เชิญคุณ',fname,b.lname)AS ptname 
            FROM patient b
            WHERE b.lname REGEXP "^[ก-๏\s]+$"
            AND b.death<>"Y" ORDER BY hn LIMIT 2000,500`;
            pool.getConnection(function(err, con) {
                con.query("SET NAMES UTF8");
                con.query(fname, function(err, rows) {
                    if (err) throw err;
                    Object.keys(rows).forEach(function(key) {
                        var row = rows[key];
                        if (fs.existsSync('hn/'+row.hn+'.mp3')) {
                            console.log('มีไฟล์แล้ว')
                        }else{
                            const tts = new jong(row.ptname,'th');
                            tts.save('hn/'+row.hn+'.mp3')
                                .then(() => {
                                    console.log(row.hn);
                                })
                                .catch((err) => {
                                    console.log('failed :'+row.hn);
                                });
                        }
                    }); 
                    console.log(rows); 
                });
            con.release();
            }); 
        }
    });
    

}); //end io connection

function createdDate (file) {  
    const { birthtime } = fs.statSync(file)
  
    return birthtime
}

function dThai (){
    var d = moment().format('YYYY-MM-DD');
    return d;
}


server.listen(3000, function() {
    console.log("Express server listening on port %d in %s mode", this.address().port, app.settings.env);
});