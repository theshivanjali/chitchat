<?php 


$str= 'abcdefghi012';
$enc = sha1($str);
echo $enc."<br>";

$dec = 'abcdefghi012';
$cdr = sha1($dec);
echo $cdr."<br>";

echo "<br>"."MD5". "<br>";

$str= 'abcdefghi012';
$enc = md5($str);
echo $enc."<br>";

$dec = 'abcdefghi012';
$cdr = md5($dec);
echo $cdr."<br>";


?>