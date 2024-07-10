
const mysql = require('mysql');

var conq = mysql.createConnection({
    host: "xxx.xxx.xxx",
    user: "xxx",
    password: "xxx",
    database: "smart_queue"
});

conq.connect(function(err) {
    if (err) throw err;
});

module.exports = conq;
