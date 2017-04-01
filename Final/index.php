<!DOCTYPE html>
<?php // Ernesto Murillo Final Exam ?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Mailing List</title> 
        <!-- Bootstrap Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Bootstrap Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    </head>
    <body>
        <div>
            <h1>Account Sign Up</h1>
            <a href="view.php">View All Records</a>

            <?php
            include './functions/functions.php'; // all functions
            include './functions/dbconnect.php';  // database connection function
            include './functions/until.php'; // isPost function
            $db = dbconnect();  //database connection function   
            $errors = array();  // errors array
            $email = filter_input(INPUT_POST, 'email'); //variables needed
            $phone = filter_input(INPUT_POST, 'phone'); //variables needed
            $heard = filter_input(INPUT_POST, 'heard'); //variables needed
            $contact = filter_input(INPUT_POST, 'contact'); //variables needed
            $comments = filter_input(INPUT_POST, 'comments'); //variables needed

            if (isPostRequest()) {
                // error check to see if email is blank
                if (empty($email)) {
                    $errors[] = ' Invalid:  Email cannot be blank entry';
                }
                // error if filter var email fails
                if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                    $errors[] = ' Invalid Email: not correct format';
                }
                // error check to see if phone is blank
                if (empty($phone)) {
                    $errors[] = ' Invalid:  Phone number cannot be blank entry';
                }
                // if no errors
                if (count($errors) == 0) {
                    insertINTOdbUSERS();  //function to insert new into database
                }
            }
            ?>
            <?php if (isset($errors) && is_array($errors)) : //if and foreach for errors and array errors to echo them out
                ?>
                <ul>           
                    <?php foreach ($errors as $error): ?>            
                        <li><?php echo $error; ?></li>            
                    <?php endforeach; ?>

                </ul>
            <?php endif; ?>

            <form action="" method="post">

                <fieldset>
                    <legend>Account Information</legend>
                    <label>E-Mail:</label>
                    <input type="text" name="email" value="<?php echo $email; ?>" class="textbox"/>
                    <br />

                    <label>Phone Number:</label>
                    <input type="text" name="phone" value="<?php echo $phone; ?>" class="textbox"/>
                </fieldset>

                <fieldset>
                    <legend>Settings</legend>

                    <p>How did you hear about us?</p>

                    <input type="radio" name="heard"  checked="checked" value="Search Engine" />
                    Search engine<br />
                    <input type="radio" name="heard"  checked="checked" value="Friend" />
                    Word of mouth<br />
                    <input type=radio name="heard"   checked="checked" value="Other" />
                    Other<br />

                    <p>Contact via:</p>
                    <select name="contact">
                        <option value="email">Email</option>
                        <option value="text">Text Message</option>
                        <option value="phone">Phone</option>
                    </select>

                    <p>Comments: (optional)</p>
                    <textarea name="comments" rows="4" cols="50"></textarea>
                </fieldset>

                <input type="submit" value="Submit" />

            </form>
            <br />
        </div>

        <?php
        if (count($errors) == 0) {  // again if no errors - data inserted   echo all
            echo " <br> $email </br>";
            echo " <br> $phone </br>";
            echo " <br> $heard </br>";
            echo " <br> $contact </br>";
            echo " <br> $comments </br>";
        }
        ?>
    </body>
</html>