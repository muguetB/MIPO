<?php

if ( !isset($_REQUEST['term']) )
    exit;


     $servername = "127.0.0.1";
     $username = "root";
     $password = "";
     $dbname = "app";
     
     $dblink = mysql_connect($servername, $username, $password);
      mysql_select_db($dbname);

  $rs = mysql_query('select login from users where login like "'. mysql_real_escape_string($_REQUEST['term']) .'%" order by login', $dblink);

$data = array();
if ( $rs && mysql_num_rows($rs) )
{
    while( $row = mysql_fetch_array($rs, MYSQL_ASSOC) )
    {
        $data[] = array(
            'label' => $row['login'],
            'value' => $row['login']
        );
    }
}

echo json_encode($data);
flush();
