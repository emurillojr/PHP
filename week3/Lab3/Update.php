<!--
Ernesto Murillo Lab 3 php assignment
Update php page
this page will allow the user to update the corporations information
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

        <!-- Added style - margin set the box-sizing property to border-box  -->
        <style>
            input[type=text] 
            {
                margin: 8px 0;
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

        /* variables used */
        $result = '';
        $corp = '';
        $email = '';
        $zipcode = '';
        $owner = '';
        $phone = '';

        /* see fuctions.php for clarification on this function */
        if (isPostRequest()) {
            $id = filter_input(INPUT_POST, 'id');
            $corp = filter_input(INPUT_POST, 'corp');
            $email = filter_input(INPUT_POST, 'email');
            $zipcode = filter_input(INPUT_POST, 'zipcode');
            $owner = filter_input(INPUT_POST, 'owner');
            $phone = filter_input(INPUT_POST, 'phone');

            $stmt = $db->prepare("UPDATE corps SET corp = :corp, email = :email, zipcode = :zipcode, owner = :owner, phone = :phone WHERE id = :id");
            $binds = array
                (
                ":id" => $id,
                ":corp" => $corp,
                ":email" => $email,
                ":zipcode" => $zipcode,
                ":owner" => $owner,
                ":phone" => $phone
            );

            $message = 'Update failed';
            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                $message = 'Update Complete';
            }
        } else {
            $id = filter_input(INPUT_GET, 'id');

            if (!isset($id)) {
                die('Record not found');
            }

            $stmt = $db->prepare("SELECT * FROM corps where id = :id");
            $binds = array
                (
                ":id" => $id
            );
            $results = array();
            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                $results = $stmt->fetch(PDO::FETCH_ASSOC);
                $corp = $results['corp'];
                $email = $results['email'];
                $zipcode = $results['zipcode'];
                $owner = $results['owner'];
                $phone = $results['phone'];
            } else {
                header('Location:view.php');
                die('ID not found');
            }
        }
        ?>

        <p>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
        </p>

        <h1>Update Corporation Data Information</h1>
        <br />
        <br />
        <form method="post" action="#">            
            <a class="btn btn-success">Corporation Name: </a><br> <input type="text" value="<?php echo $corp ?>" name="corp" size="40"/>
            <br />
            <a class="btn btn-success">EMail: </a><br> <input type="text" value="<?php echo $email ?>" name="email" size="40"/>
            <br />
            <a class="btn btn-success">Zip code: </a><br> <input type="text" value="<?php echo $zipcode ?>" name="zipcode" size="40"/>
            <br />
            <a class="btn btn-success">Owner: </a><br> <input type="text" value="<?php echo $owner ?>" name="owner" size="40"/>
            <br />
            <a class="btn btn-success">Phone #: </a><br> <input type="text" value="<?php echo $phone ?>" name="phone" size="40"/> 
            <br />
            <br />
            <br />
            <br />
            <input type="hidden" value="<?php echo $id; ?>" name="id" /> 
            <input type="submit" value="Update" />
        </form>
        <br />
        <br />
        <br />
        <p> <a href="View.php">View page</a></p>

    </body>
</html>
