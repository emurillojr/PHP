<!--
Ernesto Murillo Lab 3 php assignment
Delete php page
this page links from the view page to allow user to delete the corporations information
-->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        /* include the data base connect file and helper functions as if we are adding the code on the page */
        include './dbconnect.php';
        include './functions.php';

        /* get and hold a database connection into the $db variable */
        $db = getDatabase();

        /* get id  */
        $id = filter_input(INPUT_GET, 'id');

        $stmt = $db->prepare("DELETE FROM corps where id = :id");

        $binds = array(
            ":id" => $id
        );

        $isDeleted = false;
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $isDeleted = true;
        }
        ?>

        <h1> Record 
            <?php if (!$isDeleted): ?> 
                Not
            <?php endif; ?>
            Deleted</h1>

        <p> <a href="View.php">View Page</a></p>



    </body>
</html>
