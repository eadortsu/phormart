<?php

/*$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "phormart";*/

$cleardb_url      = parse_url(getenv("CLEARDB_DATABASE_URL"));
$dbhost   = $cleardb_url["host"];
$dbuser = $cleardb_url["user"];
$dbpass = $cleardb_url["pass"];
$dbname     = substr($cleardb_url["path"],1);



$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname );

if(mysqli_connect_errno()){
    die ("Database connection failed:  " .
        mysqli_connect_error() .
        "( " . mysqli_connect_errno() . ")"

    );
}

?>