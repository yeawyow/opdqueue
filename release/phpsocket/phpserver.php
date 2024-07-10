<?php
include( "vendor/autoload.php" );
include("connection.php");

use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;
$version = new Version2x( "http://localhost:3000/" );

set_time_limit(0);

$ip = '192.168.0.168';
$port = 81;

/*
 +-------------------------------
 *    @socketcommunicateprocess
 +-------------------------------
 *    @socket_create
 *    @socket_bind
 *    @socket_listen
 *    @socket_accept
 *    @socket_read
 *    @socket_write
 *    @socket_close
 +--------------------------------
 */

if(($sock = socket_create(AF_INET,SOCK_STREAM,SOL_TCP)) < 0) {
    echo "socket_create() Fail to create:".socket_strerror($sock)."\n";
}

if(($ret = socket_bind($sock,$ip,$port)) < 0) {
    echo "socket_bind() Fail to bind:".socket_strerror($ret)."\n";
}

if(($ret = socket_listen($sock,4)) < 0) {
    echo "socket_listen() Fail to listen:".socket_strerror($ret)."\n";
}

$count = 0;

do {
    if (($msgsock = socket_accept($sock)) < 0) {
        echo "socket_accept() failed: reason: " . socket_strerror($msgsock) . "\n";
        break;
    } else {

        $msg ="Success receive from client!\n";
        socket_write($msgsock, $msg, strlen($msg));

        echo "Success\n";
        $buf = socket_read($msgsock,8192);


        $talkback = "Received Message:$buf\n";
        $ex1 = explode("\n",$buf);
        //print_r($ex1[3]);
        $ex2 = explode(";",$ex1[3]);
        $q = explode("=",$ex2[2]);
        $hn = explode("=",$ex2[3]);
        $s = explode("=",$ex2[4]);
        
        $queue = $q[1];
        $hn1= substr($hn[1],-10,-1);
        $station = substr($s[1],-2,-1);

        $sql = "SELECT fname,lname from patient where hn=$hn1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_row()) {
                for($i=0;$i<=1;$i++){
                    $text = $row[$i];
                    $lang = "th-TH";
                    $file  = $text; //md5($lang."?".urlencode($text));
                    $file = "../audio/" . $file .".mp3";
                    
                    if(!is_dir("../audio/"))
                        mkdir("../audio/");
                    else
                        if(substr(sprintf('%o', fileperms('../audio/')), -4)!="0777")
                            chmod("../audio/", 0777);
        
                    if (!file_exists($file))
                    {
                        $mp3 = file_get_contents(
                        'https://translate.google.com/translate_tts?ie=UTF-8&q='. urlencode($text) .'&tl='. $lang .'&client=tw-ob');
                        file_put_contents($file, $mp3);
                    }
                    $ptname[] = $text;

                }
                
            }
        } else {
            echo "0 results";
        }
        //$conn->close();
        $ptname = array_values($ptname);
        print_r($ptname);
        $fname = $ptname[0];
        $lname = $ptname[1];
        //array_filter($ptname);
        unset($ptname[0],$ptname[1]);

        $client = new Client( $version );
            $client->initialize();
            $client->emit( "hn",["queue"=>"$queue","HN"=>"$hn1","station"=>"$station","fname"=>"$fname","lname"=>"$lname"] );
            $client->close();
    }

    socket_close($msgsock);

} while (true);

socket_close($sock);
?>
