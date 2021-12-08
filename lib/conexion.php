<?php 
function Conectarse($bd) 
{ 
   //if (!($link = mysql_connect("localhost","cariocadb","TzuvbE2UQrG2"))) 
   if (!($link = mysqli_connect("localhost","root","")))
   { 
      echo "ERROR CONECTANDO A LA BASES DE DATOS."; 
      exit(); 
   } 
   if (!mysqli_select_db($link, $bd))
   { 
      echo "ERROR SELECCIONANDO LA BASE DE DATOS."; 
      exit(); 
   } 
   return $link; 
} 
?>
