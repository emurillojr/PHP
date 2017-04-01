<!--
Ernesto Murillo Lab 3 php assignment
CREATE php page
this page will allow the user to add a new corporation
also has a link to view the data
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

        if (isPostRequest()) {
            /* get and hold a database connection into the $db variable */
            $db = getDatabase();

            /* included MySql function to add the date and time to the date column. */
            $stmt = $db->prepare("INSERT INTO corps SET id = :id, corp = :corp, incorp_dt = now(), email = :email, zipcode = :zipcode, owner = :owner, phone = :phone");

            $id = filter_input(INPUT_POST, 'id');
            $corp = filter_input(INPUT_POST, 'corp');
            $email = filter_input(INPUT_POST, 'email');
            $zipcode = filter_input(INPUT_POST, 'zipcode');
            $owner = filter_input(INPUT_POST, 'owner');
            $phone = filter_input(INPUT_POST, 'phone');

            $binds = array
                (
                ":id" => $id,
                ":corp" => $corp,
                ":email" => $email,
                ":zipcode" => $zipcode,
                ":owner" => $owner,
                ":phone" => $phone
            );

            /* We execute the statement and make sure we got some results back */
            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                $results = '**Corp Info Added**';
            }
        }
        ?>


        <h1><?php echo $results; ?></h1>

        <h1>Add a new Corporation</h1>
        <form method="post" action="#">            
            <a class="btn btn-warning">Corporation Name: </a><br> <input type="text" value="" name="corp" size="40"/>
            <br />
            <a class="btn btn-warning">EMail: </a><br> <input type="text" value="" name="email" size="40"/>
            <br />
            <a class="btn btn-warning">Zip code: </a><br> <input type="text" value="" name="zipcode" size="40"/>
            <br />
            <a class="btn btn-warning">Owner: </a><br> <input type="text" value="" name="owner" size="40"/>
            <br />
            <a class="btn btn-warning">Phone #: </a><br> <input type="text" value="" name="phone" size="40"/> 
            <br />
            <br />
            <br />
            <br />


            <input type="submit" value="Submit" />
        </form>
        <br />

        <p><a href="View.php">View Data</a></p>


    </body>
</html>


