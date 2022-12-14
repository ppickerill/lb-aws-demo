<?php include "../inc/dbinfo.inc"; ?>
<html>

<head>
  <title>Liquibase Employee Database</title>
  <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
</head>

<body>
  <div id="centerColumn">
    <div id="header">
      <h1>Liquibasers of the World</h1>
      <h2>Unite & Take Over</h2>
    </div>
    <!--//end #headern//-->
    <div id="nav">
      <ul>
        <li><a href-"#">Home</a></li>
        <li><a href-"#">About</a></li>
        <li><a href-"#">Gallery</a></li>
        <li><a href-"#">Contact</a></li>
      </ul>
    </div>
    <?php

    /* Connect to MySQL and select the database. */
    $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

    if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

    $database = mysqli_select_db($connection, DB_DATABASE);

    /* Ensure that the EMPLOYEES table exists. */
    VerifyEmployeesTable($connection, DB_DATABASE);

    /* If input fields are populated, add a row to the EMPLOYEES table. */
    $employee_name = htmlentities($_POST['NAME']);
    $employee_address = htmlentities($_POST['ADDRESS']);

    $employee_fav_casserole = htmlentities($_POST['FAV_CASSEROLE']);

    if (strlen($employee_name) || strlen($employee_address) || strlen($employee_fav_casserole)) {
      AddEmployee($connection, $employee_name, $employee_address, $employee_fav_casserole);

    }
    ?>

    <!-- Input form -->
    <form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
      <table border="0">
        <tr>
          <td>NAME</td>
          <td>ADDRESS</td>
          <td>FAVORITE CASSEROLE</td>
        </tr>
        <tr>
          <td>
            <input type="text" name="NAME" maxlength="45" size="30" />
          </td>
          <td>
            <input type="text" name="ADDRESS" maxlength="90" size="60" />
          </td>
          <td>
            <input type="text" name="FAV_CASSEROLE" maxlength="45" size="30" />
          </td>
          <td>
            <input type="submit" value="Add Data" />
          </td>
        </tr>
      </table>
    </form>

    <!-- Display table data. -->
    <table border="1" cellpadding="2" cellspacing="2">
      <tr>
        <td>ID</td>
        <td>NAME</td>
        <td>ADDRESS</td>
        <td>FAVORITE CASSEROLE</td>
      </tr>

      <?php

      $result = mysqli_query($connection, "SELECT * FROM EMPLOYEES");

      while ($query_data = mysqli_fetch_row($result)) {
        echo "<tr>";
        echo "<td>", $query_data[0], "</td>",
        "<td>", $query_data[1], "</td>",
        "<td>", $query_data[2], "</td>",
        "<td>", $query_data[3], "</td>";
        echo "</tr>";
      }
      ?>

    </table>

    <!-- Clean up. -->
    <?php

    mysqli_free_result($result);
    mysqli_close($connection);

    ?>
    <div id="footer">
      <h3> Brought to you by AWS CodePipeline & Liquibase </h3>
    </div>

  </div>
</body>

</html>


<?php

/* Add an employee to the table. */
function AddEmployee($connection, $name, $address, $fav_casserole)
{
  $n = mysqli_real_escape_string($connection, $name);
  $a = mysqli_real_escape_string($connection, $address);
  $c = mysqli_real_escape_string($connection, $fav_casserole);

  $query = "INSERT INTO EMPLOYEES (NAME, ADDRESS, FAV_CASSEROLE) VALUES ('$n', '$a', '$c');";

  if (!mysqli_query($connection, $query)) echo ("<p>Error adding employee data.</p>");
}

/* Check whether the table exists and, if not, create it. */
function VerifyEmployeesTable($connection, $dbName)
{
  if (!TableExists("EMPLOYEES", $connection, $dbName)) {
    echo "<h2> WHERE'S DATABASE?  IS THERE ANYONE IN THE WORLD THAT CAN HELP US?</h2>";
  }
}

/* Check for the existence of a table. */
function TableExists($tableName, $connection, $dbName)
{
  $t = mysqli_real_escape_string($connection, $tableName);
  $d = mysqli_real_escape_string($connection, $dbName);

  $checktable = mysqli_query(
    $connection,
    "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = '$t' AND TABLE_SCHEMA = '$d'"
  );

  if (mysqli_num_rows($checktable) > 0) return true;

  return false;
}
?>