<?php

try{
$conn = new PDO("localhost",root,"","bibliotheque");
echo "vous êtes connecté!";

if ($conn->connect_error){
	die("connection Failed!".$conn->connect_error);
}

?>