<!DOCTYPE html>
<?php //Ernesto Murillo FINAL view page  ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>View All Page</title>
        <!-- Bootstrap Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Bootstrap Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    </head>
    <h1>View All Data</h1>
    <body>
        <?php
        include './functions/dbconnect.php';   // database connections
        include './functions/functions.php';  // functions
        $db = dbconnect();  //function for database

        $stmt = $db->prepare("SELECT * FROM account");

        $results = array();
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        ?>

        <table class="table table-striped"><!-- Created table to display all the data by title -->
            <thead>
                <tr>
                    <th>Email: </th>
                    <th>Phone: </th>
                    <th>Heard:  </th>
                    <th>Contact:  </th>
                    <th>Comments: </th>
                </tr>
            <br>
            <br>
            </thead>

            <!-- /* loop through each result to get back an array with values */  -->
            <?php foreach ($results as $row): ?>
                <tr>
                    <td><?php echo $row['email']; ?></td>            
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['heard']; ?></td>
                    <td><?php echo $row['contact']; ?></td>
                    <td><?php echo $row['comments']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>

