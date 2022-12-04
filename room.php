<?php
include("Utils.inc");
include("Database.inc");

$roomID = filter_input(INPUT_GET, 'roomID', FILTER_VALIDATE_INT);
$room = getRoom($roomID);

if (!$roomID ) {
    http_response_code(400);
    echo "<h1>Bad request</h1>";
    die;
}
?>
<!doctype html>
<html lang="en">
<head>
    <?php
    echoHeadContent();

    ?>
    <title>Místnost č.<?php echo $room->no; ?></title>
</head>
<body class="container">
<h1>Místnost č.<?php echo $room->no; ?></h1>
<dl class="container">

    <dt>Číslo</dt>
    <dd><?php echo $room->no ?></dd>
    <dt>Název</dt>
    <dd><?php echo $room->name ?></dd>
    <dt>Telefon</dt>
    <dd><?php echo $room->phone ?></dd>
    <dt>Lidé</dt>
    <?php foreach (getRoomEmployees($roomID) as $employee) {
        echo "<dd><a href='employee.php?employeeID={$employee->employee_id}'>$employee->name $employee->surname</a></dd>";
    }
    ?>
    <dt>Průměrná mzda</dt>
    <dd>
        <?php
        echo(getAvgWage($roomID)->avg_wage);
        ?>
    </dd>

    <dt>Klíče</dt>

        <?php
        foreach (getRoomKeys($roomID) as $employee)
        {
            echo "<dd><a href='employee.php?employeeID={$employee->employee_id}'>$employee->name $employee->surname</a></dd>";
        }
        ?>

</dl>
<a href="roomlist.php">Zpět na seznam místností</a>
<?php

?>
</body>
</html>
<?php

?>
