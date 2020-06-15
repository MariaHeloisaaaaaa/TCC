<?php
define('HOST', '127.0.0.1');
define('USUARIO', 'root');


define('SENHA', '');
define('DB', 'tcc');


$cadastro = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possível conectar');
mysqli_set_charset($cadastro,'utf8');

 if(!$cadastro){
 echo"Não foi possivel cadastrar-se no banco ". PHP_EOL;

 echo"Debugging erro:". mysqli_connect_error().PHP_EOL;
 exit;

 }
?>