<?php

     function getConnection(){

          $serverName = "DESKTOP-JOQNJEJ\SQLEXPRESS"; //serverName\instanceName
          $connectionInfo = array( "Database"=>"gym_management_system", "UID"=>"raridoy", "PWD"=>"needhelp");
          $conn = sqlsrv_connect( $serverName, $connectionInfo);

          if( !$conn ) {
               echo "Connection could not be established.<br />";
               die( print_r( sqlsrv_errors(), true)); 
          }

          return $conn;
     }
?>