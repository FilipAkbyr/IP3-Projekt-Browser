<?php
$config = parse_ini_file("config.ini");
$host = $config['host'];
$db = $config['db'];
$user = $config['user'];
$pass = $config['pass'];
$charset = $config['charset'];

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    PDO::ATTR_EMULATE_PREPARES => false,];

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass, $options);


function example()
{
    global $pdo;
    $stmt = $pdo->query('SELECT name FROM room');
    if ($stmt->rowcount() == 0) {
        echo "záznam neobsahuje žádná data";
    } else {
        while ($row = $stmt->fetch()) { //nebo foreach ($stmt as $row)
            var_dump($row['name']);
        }
    }
}

function getRoomList()
{
    global $pdo;
    $sorting_smer = "";
    $orderpodle = "";
    $poradi = filter_input(INPUT_GET, "poradi");

    if ($poradi) {
        switch ($poradi) {
            case "nazev_nahoru":
                $sorting_smer = "ASC";
                $orderpodle = "name";
                break;
            case "nazev_dolu":
                $sorting_smer = "DESC";
                $orderpodle = "name";
                break;
            case "cislo_nahoru":
                $sorting_smer = "ASC";
                $orderpodle = "no";
                break;
            case "cislo_dolu":
                $sorting_smer = "DESC";
                $orderpodle = "no";
                break;
            case "telefon_nahoru":
                $sorting_smer = "ASC";
                $orderpodle = "phone";
                break;
            case "telefon_dolu":
                $sorting_smer = "DESC";
                $orderpodle = "phone";
                break;
        }
    } else {
        $stmt = $pdo->query("select * from room");
    }

    if ($poradi) {
        $stmt = $pdo->query("select * from room order by $orderpodle $sorting_smer");
    };

    /* $stmt = $pdo->query("select * from room order by room.no DESC");*/

    return $stmt->fetchAll();
}

function getRoom($room_id)
{
    global $pdo;
    $stmt = $pdo->query("select * from room where room_id = {$room_id}");
    return $stmt->fetch();
}

function getRoomEmployees($room_id)
{
    global $pdo;
    $stmt = $pdo->query("select * from employee where room = {$room_id}");
    return $stmt->fetchAll();
}

function getEmployees()
{
    global $pdo;
    $sorting_smer = "";
    $orderpodle = "";
    $poradi = filter_input(INPUT_GET, "poradi");

    if ($poradi) {
        switch ($poradi) {
            case "jmeno_nahoru":
                $sorting_smer = "ASC";
                $orderpodle = "name";
                break;
            case "jmeno_dolu":
                $sorting_smer = "DESC";
                $orderpodle = "name";
                break;
            case "mistnost_nahoru":
                $sorting_smer = "ASC";
                $orderpodle = "room.no";
                break;
            case "mistnost_dolu":
                $sorting_smer = "DESC";
                $orderpodle = "room.no";
                break;
            case "telefon_nahoru":
                $sorting_smer = "ASC";
                $orderpodle = "room.phone";
                break;
            case "telefon_dolu":
                $sorting_smer = "DESC";
                $orderpodle = "room.phone";
                break;
            case "pozice_nahoru":
                $sorting_smer = "ASC";
                $orderpodle = "job";
            case "pozice_dolu":
                $sorting_smer = "DESC";
                $orderpodle = "job";
        }

    } else {
        $stmt = $pdo->query("select employee_id, employee.name, surname, job, room.name as 'room_name', room.phone as 'room_phone' from employee join `room` on employee.room=room.room_id");
    }
    if ($poradi) {
        $stmt = $pdo->query("select employee_id, employee.name, surname, job, room.name as 'room_name', room.phone as 'room_phone' from employee join `room` on employee.room=room.room_id order by $orderpodle $sorting_smer");
    };
    /*$stmt = $pdo->query("select employee_id, employee.name, surname, job, room.name as 'room_name', room.phone as 'room_phone' from employee join `room` on employee.room=room.room_id");*/
    return $stmt->fetchAll();
}

function getEmployee($employee_id)
{
    global $pdo;
    $stmt = $pdo->query("select employee.name, surname, job, wage, employee.room from employee where employee_id = {$employee_id}");
    return $stmt->fetch();
}

function getAvgWage($room_id)
{
    global $pdo;
    $stmt = $pdo->query("select avg(wage) as avg_wage from employee where room = {$room_id}");
    return $stmt->fetch();
}

function getRoomKeys($room_id)
{
    global $pdo;
    global $db;
    $stmt = $pdo->query("select employee from $db.key where room = {$room_id}");
    $emps = [];
    while ($keyobj = $stmt->fetch()) {
        array_push($emps, $keyobj->employee);
    }
    $in = implode(',', $emps);
    $stmt = $pdo->query("select * from employee where employee_id in ($in)");
    return $stmt->fetchAll();
}

function getEmployeeKeys($employee_id)
{
    global $pdo;
    global $db;
    $stmt = $pdo->query("select * from room join `key` on `key`.room=room.room_id where .employee=$employee_id");
    return $stmt->fetchAll();
}

function getEmployeeList()
{
    global $pdo;
    $stmt = $pdo->query("select * from employee ");
    return $stmt->fetchAll();
}


?>
