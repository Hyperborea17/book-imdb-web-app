<?php
$server= "localhost";
$user= "root";
$password= "Covergirl17";
$dbname= "kitapyorumla";

$conn= mysqli_connect($server,$user,$password,$dbname);
if(!$conn)
{
     die("Connection Failed!".mysqli_connect_error());
}
else{
    echo "";
}
?>