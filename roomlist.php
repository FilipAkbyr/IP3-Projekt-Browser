<?php
include("Database.inc");
include ("Utils.inc");

?>
<!doctype html>
<html lang="en">
<head>
    <?php
    echoHeadContent();
    ?>
    <title>Seznam Místností</title>
</head>
<body class="container">
<h1>Seznam Místností</h1>
<table class="table">
    <thead>
    <tr>
        <th>Název <a href='?poradi=nazev_dolu' class=''><span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></span></a> <a href='?poradi=nazev_nahoru' class=''><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></span></a></th>
        <th>Číslo <a href='?poradi=cislo_dolu' class=''><span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></span></a> <a href='?poradi=cislo_nahoru' class=''><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></span></a></th>
        <th>Telefon <a href='?poradi=telefon_dolu' class=''><span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></span></a> <a href='?poradi=telefon_nahoru' class=''><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></span></a></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach (getRoomList() as $room) {
        echo "
<tr>
    <td><a href='room.php?roomID={$room->room_id}'>{$room->name}</a></td>
    <td>$room->no</td>
    <td>$room->phone</td>
</tr>";
    }

    ?>


</tbody>

</table>
<a href="Index.php">Zpět na prohlížeč databáze</a>
</body>
</html>