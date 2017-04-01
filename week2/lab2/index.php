<!DOCTYPE html>
<!--
Ernesto Murillo Lab 2
index php page
-->

<html>
    <head>
        <meta charset="UTF-8">
        <title>Actors Information</title>

        <!-- Bootstrap Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Bootstrap Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        
        <header>
        <h1>Enter Actors Information:</h1>
        </header>
        
    <!-- Added style 
    margin 
    set the box-sizing property to border-box
    -->
        <style>
    input[type=text] 
    {
    margin: 8px 0;
    box-sizing: border-box;
    }
    </style>
             
        
    </head>
    <body>
        <?php
     
        /* include the data base connect file and helper functions as if we are adding the code on the page */
        include './dbconnect.php';
        include './functions.php';

        $results = '';

        if (isPostRequest()) 
        {
            /* get and hold a database connection into the $db variable */
            $db = getDatabase();
       
            $stmt = $db->prepare("INSERT INTO actors SET firstname = :firstname, lastname = :lastname, dob = :dob, height = :height");

            $firstname = filter_input(INPUT_POST, 'firstname');
            $lastname = filter_input(INPUT_POST, 'lastname');
            $dob = filter_input(INPUT_POST, 'dob');
            $height = filter_input(INPUT_POST, 'height');

            $binds = array
                (
                ":firstname" => $firstname,
                ":lastname" => $lastname,
                ":dob" => $dob,
                ":height" => $height
                );
            
            /* We execute the statement and make sure we got some results back */
            if ($stmt->execute($binds) && $stmt->rowCount() > 0) 
                {
                $results = 'Data Added';
                }
        }
        ?>


        <h1><?php echo $results; ?></h1>

        <form method="post" action="#">            
            <a class="btn btn-warning">First Name: </a><br> <input type="text" value="" name="firstname" />
            <br />
            <a class="btn btn-warning">Last Name: </a><br> <input type="text" value="" name="lastname" />
            <br />
            <a class="btn btn-warning">Date of Birth: </a><br> <input type="date" value="" name="dob" />
            <br />
            <a class="btn btn-warning">Height: </a><br> <input type="text" value="" name="height" />
            <br />
            <input type="submit" value="Submit" />
        </form>
        
        <br>
        <br>
        <br>
        
        <!-- link to go view page-->
        <p><a href="view.php">See Total Actor's so far</a></p>
        
        
    </body>
</html>
