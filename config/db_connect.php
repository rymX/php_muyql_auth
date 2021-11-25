<?php

// connect to db
$connection = mysqli_connect('localhost','rym','123456Test','Application');
// check cnx
if (!$connection){
echo 'connection error : ' . mysqli_error($connection);
}

?>
