
const mysql = require('mysql');

var con  = mysql.createPool({
    connectionLimit : 10,
    host: "10.10.10.5",
    user: "sa",
    password: "sa",
    database: "smart_queue"
  });

module.exports = con;
