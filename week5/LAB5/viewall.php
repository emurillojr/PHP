<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>View</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    </head>
    </head>
    <header>
    <h1>Web-site Logger</h1>
    </header>
    <h3>View All Added Page </h3>
    <p><a href="addURL.php">Add URL</a> &nbsp;&nbsp;&nbsp;            
    <a href="sitelinkslookup.php">Site Links</a> &nbsp;&nbsp;&nbsp;            
    </p>
    <body>
        <?php
        
            include './functions/dbconnect.php';
            include './functions/functions.php';
            $db = dbconnect();

            $stmt = $db->prepare("SELECT * FROM sitelinks JOIN sites ON sites.site_id = sitelinks.site_id");
            $results = array();
            if ($stmt->execute() && $stmt->rowCount() > 0) {
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            
            //print_r($results);
        ?>
        
            <h2>Results found <?php echo count($results); ?></h2>
            <table border="1">        
                <tbody>
                <?php foreach ($results as $index => $row): ?>
                    <tr>
                        <td><?php echo ($index+1); ?></td> 
                        <td><?php echo $row['site']; ?></td> 
                        <td><?php echo $row['link']; ?></td> 
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        
            
        
    </body>
</html>
