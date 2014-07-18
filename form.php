<?php
function  connect_to_myDatabase() {
  $mysqluser="seaton2"; // user name used to logon to the mysql database server, this is the same login name for your lamp account
  $mysqlpasswd="seaton2_2010"; // your password is the same default password that you have been using to log on to the lamp server
  $mysqlhost="localhost"; // name of the computer of which MySQL is running , leave this as 'localhost'
  $connID = @mysql_connect($mysqlhost, $mysqluser, $mysqlpasswd);
  if ($connID) {
// set default database, there is only one database on your lamp account which has been created with the same name as your lamp logon user name  
        mysql_select_db("seaton2");
        return $connID;
  }
  else {
    echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0//EN\">
       <html><head>
       <title>Error Connecting to Database</title>
       <body><p>Sorry, connection cannot be established to database  . . .    </p>
      </head></html>\n";
    }
  }


$connID = connect_to_myDatabase();
?>

<!DOCTYPE HTML PUBLIC "-//W3C/DTD HTML 4.0//EN">
<html>
  <head>
    <title>Sean's Pictures</title>
  </head>
  <body>
  <?php
    $result = mysql_query("SELECT * FROM pictureSize");
    echo "<p>Table <i>pictureSize</i> contains ",
     mysql_result($result, 0, 0),
     "  records.</p>\n";
  ?>
  </body>
</html>