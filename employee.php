<?php
include("Utils.inc");
include("Database.inc");

$employeeID = filter_input(INPUT_GET, "employeeID", FILTER_VALIDATE_INT);
$employee = getEmployee($employeeID);
$cardname = $employee->surname." ". $employee->name;
$roomdetails = getRoom(getEmployee($employeeID)->room);
?>
<!doctype html>
<html lang="en">
<head>
    <?php
    echoHeadContent();
    ?>
    <title>Karta zaměstnance <?=$cardname?></title>
</head>
<body class="container">
<h1>Karta osoby: <?=$cardname?></h1>
<dl class='container'>
    <dt>Jméno</dt><dd><?=$employee->name?></dd>
    <dt>Příjmení</dt><dd><?=$employee->surname?></dd>
    <dt>Pozice</dt><dd><?=$employee->job?></dd>
    <dt>Mzda</dt><dd><?=$employee->wage?></dd>
    <dt>Místnost</dt>

    <dd><a href="room.php?roomID=<?php echo $roomdetails->room_id?>"><?php echo $roomdetails->name?></a></dd>


    <dt>Klíče</dt>
    <?php
    foreach(getEmployeeKeys($employeeID) as $employeeKey)
    {
            echo "<dd><a href='room.php?roomID={$employeeKey->room}'>$employeeKey->name</a></dd>";

    }
    ?>

</dl>
<a href="Index.php">Zpět na seznam zaměstnanců</a>
</body>
</html>
