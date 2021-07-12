<?php 

   function getConnection(){
      
      //Oracle DB user name
      $username = 'raridoy';

      // Oracle DB user password
      $password = 'needhelp';

      // Oracle DB connection string
      $connection_string = 'localhost/xe';

      //Connect to an Oracle database
      $conn = oci_connect($username,$password,$connection_string,'AL32UTF8');

      if (!$conn) {

         $e = oci_error();
         trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
      }

      // if (!$conn)
      //    echo 'Oops :( connection failed';
      // else
      //    echo 'Successful Oracle DB + php => OK ';

      // Close connection 
      //oci_close($conn);

      return $conn;
   }
?>