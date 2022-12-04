<?php
include("Database.inc");
include ("Utils.inc");
$employeeID = filter_input(INPUT_GET, "employeeID", FILTER_VALIDATE_INT);
?>
<!doctype html>
<html lang="en">
<head>
    <?php
        echoHeadContent();
    ?>
    <title>Seznam zaměstnanců</title>
</head>
<body class="container">
<h1>Seznam zaměstnanců</h1>
<table class="table">
    <thead>
    <tr>
        <th>Jméno <a href='?poradi=jmeno_dolu' class=''><span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></span></a> <a href='?poradi=jmeno_nahoru' class=''><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></span></a></th>
        <th>Místnost <a href='?poradi=mistnost_dolu' class=''><span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></span></a> <a href='?poradi=mistnost_nahoru' class=''><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></span></a></th>
        <th>Telefon <a href='?poradi=telefon_dolu' class=''><span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></span></a> <a href='?poradi=telefon_nahoru' class=''><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></span></a></th>
        <th>Pozice <a href='?poradi=pozice_dolu' class=''><span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></span></a> <a href='?poradi=pozice_nahoru' class=''><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></span></a></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach(getEmployees() as $employees)
    {
        echo "
        <tr>
        <td><a href='employee.php?employeeID={$employees->employee_id}'>{$employees->name} {$employees->surname}</a></td>
        <td>$employees->room_name</td>
        <td>$employees->room_phone</td>
        <td>$employees->job</td>
        </tr>
        ";

    }
    ?>
    </tbody>
</table>
<a href="Index.php">Zpět na Prohlížeč databáze</a>
<?php

?>
</body>
</html>