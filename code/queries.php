<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Queries</title>
</head>
<body>
    
    <?php
        require_once "config.php";
        try {
            $db = new PDO("pgsql:host=".dbconfig::$host.";dbname=".dbconfig::$dbname, dbconfig::$dbuser, dbconfig::$dbpass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (\Throwable $th) {
            echo "<pre>" . $th . "</pre>";
        }
        
    ?>

    <h1>Queries:</h1>

    <h3>Вывести возраст пациентов клиники:</h3> 
    <div class="code">
        <code>
        select *, age(date_of_birth) as age from patients;
        </code>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>phone_number</th>
                <th>date_of_birth</th>
                <th>age</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = "select *, age(date_of_birth) as age from patients;";
                $res = $db->query($query);
                while ($row = $res->fetch()) {
                    echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['phone_number'] . "</td>";
                        echo "<td>" . $row['date_of_birth'] . "</td>";
                        echo "<td>" . $row['age'] . "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

    <h3>Вывести цены услуг:</h3> 
    <div class="code">
        <code>select * from price_list;</code>
    </div>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>service</th>
                <th>price</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = "select * from price_list;";
                $res = $db->query($query);
                while ($row = $res->fetch()) {
                    echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['service'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

    <h3>Вывести данные о приёмах, проводившихся в 1-ом кабинете:</h3>
    <div class="code">
        <code>
        select date from appointments where office_id = 1;
        </code> 
    </div>
    <table>
        <thead>
            <tr>
                <th>date</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = "select date from appointments where office_id = 1;";
                $res = $db->query($query);
                while ($row = $res->fetch()) {
                    echo "<tr>";  
                        echo "<td>" . $row['date'] . "</td>";  
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

    <h3>Вернуть список рейсов, совершенных в 2021 году:</h3> 
    <div class="code">
        <code>
        select upper(name) as na from doctors;
        </code>
    </div>
    <table>
        <thead>
            <tr>
                <th>upper(name)</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = "select upper(name) as na from doctors;";
                $res = $db->query($query);
                while ($row = $res->fetch()) {
                    echo "<tr>";
                        echo "<td>" . $row['na'] . "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

    <h3>Выбрать сотрудника с возрастом 30 лет и опытом работы 3 года:</h3> 
    <div class="code">
        <code>select doctors.id, doctors.name, count(distinct patients.name) as c from appointments
            inner join doctors on (appointments.doctor_id = doctors.id)
            inner join patients on (appointments.patient_id = patients.id)
            group by doctors.id;</code>
    </div>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>count(patients.name)</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = "select doctors.id, doctors.name, count(distinct patients.name) as c from appointments
                inner join doctors on (appointments.doctor_id = doctors.id)
                inner join patients on (appointments.patient_id = patients.id)
                group by doctors.id;";
                $res = $db->query($query);
                while ($row = $res->fetch()) {
                    echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['c'] . "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

<style>
table th, td {
	padding: 10px;
	border: 1px solid #001;
    font-size: 120%; 
    font-family: Verdana, Arial, Helvetica, sans-serif;
    color: #900020;
}
.code {
    margin-bottom: 6px;
    padding: 4px;
    color: blue;
}
</style>

</body>
</html>