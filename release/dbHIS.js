
const mysql = require('mysql');

var con  = mysql.createPool({
    connectionLimit : 50,
    host: "xxx.xxx.xxx",
    user: "xxx",
    password: "xxx",
    database: "xxx"
  });

module.exports = con;
