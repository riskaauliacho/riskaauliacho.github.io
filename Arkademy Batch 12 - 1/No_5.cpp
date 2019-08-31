<?php
$data = "$ programit";
$potong = substr($data,10,-5); 
echo $potong; //$ pro
$potong = substr($data,4,-2);
echo $potong; // gram
$potong = substr($data,-2);
echo $potong; // it

echo"<br>";

$potong = substr($data,10,-2); 
echo $potong; //$ program
$potong = substr($data,-2);
echo $potong; // it

$data = "$ programmerit";
$potong = substr($data,14,-9); 
echo $potong; //$ pro
$potong = substr($data,-5,-5);
echo $potong; // gram
$potong = substr($data,-5);
echo $potong; // merit

echo"<br>";

$potong = substr($data,14,-5); 
echo $potong; //$ program
$potong = substr($data,-5);
echo $potong; // merit

echo"<br>";

$potong = substr($data,14,-2); 
echo $potong; //$ programmer
$potong = substr($data,-2);
echo $potong; // it

?>




