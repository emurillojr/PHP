<!--
Ernesto Murillo Lab 3 php assignment
Read php page
this page will allow the user to Read all the corps data information without making edits
links back to view page, update and delete 
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
        $id = '';
        $corp = '';
        $email = '';
        $zipcode = '';
        $owner = '';
        $phone = '';

        $stmt = $db->prepare("SELECT corp = :corp, email = :email, zipcode = :zipcode, owner = :owner, phone = :phone FROM corps WHERE id = :id");
        $binds = array
            (
            ":id" => $id,
            ":corp" => $corp,
            ":email" => $email,
            ":zipcode" => $zipcode,
            ":owner" => $owner,
            ":phone" => $phone
        );

        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            
        } else {
            $id = filter_input(INPUT_GET, 'id');

            if (!isset($id)) {
                die('Record not found');
            }

            /* function to pull in all data from id record */
            $results = getTestRecord($id);

            if (count($results) > 0) {
                $corp = $results['corp'];
                $incorp_dt = $results['incorp_dt'];
                $email = $results['email'];
                $zipcode = $results['zipcode'];
                $owner = $results['owner'];
                $phone = $results['phone'];
            
            } else {
                die('Record ' . $id . ' not found');
            }
        }
        ?>

        <h1><?php echo $result; ?></h1>
            <?php
            $datetime = strtotime($row['date']);
            $formatFordatetime = date("m/d/Y g:i A", $datetime);
            ?>
        
        <h1>Corporation Information Read Only</h1>
        <br />
        <br />
        <form action="#">            
            <a class="btn btn-default">Corporation Name: </a><br> <input type="text" value="<?php echo $corp ?>" name="corp" readonly size="40"/>
            <br />
            <a class="btn btn-default">Date / Time Added: </a><br> <input type="text" value="<?php echo $formatFordatetime ?>" name="incorp_dt" readonly size="40"/>
            <br />
            <a class="btn btn-default">EMail: </a><br> <input type="text" value="<?php echo $email ?>" name="email" readonly size="40"/>
            <br />
            <a class="btn btn-default">Zip code: </a><br> <input type="text" value="<?php echo $zipcode ?>" name="zipcode" readonly size="40"/>
            <br />
            <a class="btn btn-default">Owner: </a><br> <input type="text" value="<?php echo $owner ?>" name="owner" readonly size="40"/>
            <br />
            <a class="btn btn-default">Phone #: </a><br> <input type="text" value="<?php echo $phone ?>" name="phone" readonly size="40"/> 
            <br />
            <br />
            <br />
            <br />
            <input type="hidden" value="<?php echo $id; ?>" name="id" /> 

        </form>
        <br />

    <tr>


        <td><a class="btn btn-warning" href="Update.php?id=<?php echo $results['id']; ?>">Update</a></td>            
        <td><a class="btn btn-danger" href="Delete.php?id=<?php echo $results['id']; ?>">Delete</a></td>            
    </tr>

    <br />
    <br />
    <br />
    <p> <a href="View.php">View page</a></p>


</body>
</html>
