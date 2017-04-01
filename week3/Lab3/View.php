<!--
Ernesto Murillo Lab 3 php assignment
View php page
this page will allow the user to view all the corporations listed
-->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

        <!-- Bootstrap Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Bootstrap Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    </head>
    <body>
        <?php
        /* include the data base connect file and helper functions as if we are adding the code on the page */
        include './dbconnect.php';
        include './functions.php';

        /* get and hold a database connection into the $db variable */
        $db = getDatabase();

        /* create a variable to hold the database SQL statement */
        $stmt = $db->prepare("SELECT * FROM corps");

        /* We execute the statement and make sure we got some results back */
        $results = array();
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        ?>

        <p><a href="Create.php">Add a new Corporation</a></p> 

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Corporation Name: </th>
            <br>
            <br>
            </tr>
            </thead>

            <!-- /* loop through each result to get back an array with values */  -->

            <?php foreach ($results as $row): ?> 
                <tr>
                    <td><?php echo $row['corp']; ?></td>

                    <td><a class="btn btn-default" href="Read.php?id=<?php echo $row['id']; ?>">Read</a></td>            
                    <td><a class="btn btn-success" href="Update.php?id=<?php echo $row['id']; ?>">Update</a></td>            
                    <td><a class="btn btn-danger" href="Delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>            

                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>
