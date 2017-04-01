<!DOCTYPE html>
<!--
Ernesto Murillo
Lab 5 PHP Assignment
Add URL Page
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add URL Page</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    </head>
    <header>
        <h1>Web-site Logger</h1>
    </header>
    <h3>Add URL Page</h3>
    <!-- link to go back to sites lookup -->
    <p><a href="sitelinkslookup.php">Site Links</a>          
    </p>
    <body>
        <?php
        include './functions/dbconnect.php';
        include './functions/functions.php';
        $results = '';
        $db = dbconnect();
        $errors = array();
        $site = filter_input(INPUT_POST, 'site');
        // if post has been made = $site
        if (isPostRequest($site)) {
            //start of error messages
            // error if nothing posted
            if (empty($site)) {
                $errors[] = ' Invalid:  Cannot be blank entry';
            }
            // error if filter var URL fails
            if (filter_var($site, FILTER_VALIDATE_URL) === false) {
                $errors[] = ' Invalid Url:  format needs to be http://www.example.com ';
            }
            // prepare to check if posted url matches database
            $stmt = $db->prepare("SELECT site FROM sites WHERE site = :site");
            $binds = array(
                ":site" => $site
            );
            //if post matches database - error  
            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                $errors[] = ' Error:  URL has already been added to the database';
            }
            // if not errors and variables
            // function - run a curl on posted site and save as $data
            // function - run regex match all and remove dups save as $filterresults 
            if (count($errors) == 0) {
                $data = curlUrl($site);
                $filterResults = filterUrl($data);
                // add url to database
                $stmt = $db->prepare("INSERT INTO sites SET site = :site, date = now()");
                $binds = array(":site" => $site);
                if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                    $results = ' URL was added to database.';
                    $site_id = $db->lastInsertId();
                    $stmt = $db->prepare("INSERT INTO sitelinks SET site_id = :site_id, link = :link");
                    foreach ($filterResults as $link) {
                        $binds = array(
                            ":site_id" => $site_id,
                            ":link" => $link);
                        $stmt->execute($binds);
                    }
                }
            }
        }echo $results;
        ?>
        <!-- display errors if there are any -->
        <?php if (isset($errors) && is_array($errors)) : ?>
            <ul>           
                <?php foreach ($errors as $error): ?>            
                    <li><?php echo $error; ?></li>            
                <?php endforeach; ?>        
            </ul>
        <?php endif; ?>
        <!-- form to enter URL -->
        <form  method="post" action="addURL.php">
            Enter URL Address to add:    <input class="form-control" type="text" name="site" size = 40 value="<?php echo $site; ?>" />
            <br>
            <input type="submit" class="btn btn-primary" value="Submit" />
        </form>
        <br />
        <!-- when new URL is added show URL and all links from curl and regex added as well -->
        <?php if (isset($filterResults)): ?>
            <h3>Links Added:</h3>
            <ul>            
                <?php foreach ($filterResults as $link): ?>
                    <li>
                        <?php echo $link; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </body>
</html>
