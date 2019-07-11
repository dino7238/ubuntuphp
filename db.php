<?php
 $db = new mysqli("127.0.0.1","root","qudvlf","0811member");
 $db->set_charset("utf8");

 function mq($sql){
   global $db;
   return $db->query($sql);
 }

 ?>
