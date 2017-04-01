<!DOCTYPE html>

<!--
Ernesto Murillo Lab 2
View php page
-->

<html>
    <head>
        <meta charset="UTF-8">
        <title>Actor Results</title>

        <!-- Bootstrap Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Bootstrap Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <header>
        <h1>Total Information Saved:</h1>
    </header>




    <!-- Added style 
    black border for <table>, <th>, and <td> elements
    border-collapse to set whether table borders should be collapsed into a single border
    width of the table to 100%
    horizontal alignment left of the content in <th>
    -->
    <style>
        table, td, th
        {
            border: 1px solid black;
        }
        table 
        {
            border-collapse: collapse;
            width: 100%;
        }
        th 
        {
            text-align: left;
        }

    </style>



</head>
<body>
    <?php
    /* include the data base connect file and helper functions as if we are adding the code on the page */
    include './dbconnect.php';
    include './functions.php';

    /* get and hold a database connection into the $db variable */
    $db = getDatabase();

    /* create a variable to hold the database SQL statement */
    $stmt = $db->prepare("SELECT * FROM actors");

    /* We execute the statement and make sure we got some results back */
    $results = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    ?>

    <p> Results found:</p>  
    <?php echo $stmt->rowCount(); ?>
    <br>
    <br>
    <br>

<!-- class for table style and buttons-->
    <table class="table table-striped">
        <thead>
            <tr>
                <th><a class="btn btn-warning"> ID</a></th>
                <th><a class="btn btn-warning"> First Name</a></th>
                <th><a class="btn btn-warning"> Last Name</a></th>
                <th><a class="btn btn-warning"> Date Of Birth</a></th>
                <th><a class="btn btn-warning"> Height</a></th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($results as $row): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['firstname']; ?></td>
                    <td><?php echo $row['lastname']; ?></td>  
                    <td><?php echo $row['dob']; ?></td> 
                    <td><?php echo $row['height']; ?></td> 

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <br>
    <br>

    <!-- link to go back to Index-->
    <p><a href="index.php">Back to Entering more Actor's</a></p>

</body>
</html>
