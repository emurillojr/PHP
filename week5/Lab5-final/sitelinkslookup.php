<!DOCTYPE html>
<!--
Ernesto Murillo
PHP Assignment 5
site links lookup page

-->
<html>
    <meta charset="UTF-8">
    <title>Site Links Lookup Page</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<header>
    <h1>Web-site Logger</h1>
</header>
<h3>Site Links Look Up Page </h3>
<!-- link back to url page -->
<p><a href="addURL.php">Add URL</a>           

</p>
<body>
    <?php
    require './functions/dbconnect.php';
    require './functions/functions.php';
    // get database
    $db = dbconnect();
    // bring in sites order ASC
    $stmt = $db->prepare("SELECT * FROM sites ORDER BY site ASC");
    $sites = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $sites = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    $site_id = '';
    // is post request
    if (isPostRequest()) {
        // join sites to sitelinks by site_id
        $stmt = $db->prepare("SELECT * FROM sites JOIN sitelinks ON sites.site_id = sitelinks.site_id WHERE sites.site_id = :site_id");
        $site_id = filter_input(INPUT_POST, 'site_id');
        $binds = array(
            ":site_id" => $site_id
        );
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $error = 'No Links found';
        }
    }
    ?>
    <!-- if any errors - display error messageOptional theme -->
    <?php if (isset($error)): ?>        
        <h1><?php echo $error; ?></h1>
    <?php endif; ?>
    <!-- FORM including drop down menu for site added already  -->
    <form method="post" action="#">

        <select class="form-control" name="site_id">
            <?php foreach ($sites as $row): ?>
                <option 
                    value="<?php echo $row['site_id']; ?>"
                    <?php if (intval($site_id) === $row['site_id']) : ?>
                        selected="selected"
                    <?php endif; ?>
                    >
                        <?php echo $row['site']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>
        <input type="submit" class="btn btn-primary" value="Submit" />
    </form>
    <!-- if there are any results echo site, date time added -->
    <?php if (isset($results)): ?>
        <!-- converted date / time to correct format used variable as well -->
        <?php
        $datetime = strtotime($results[0]['date']);
        $formatFordatetime = date("m/d/Y g:i A", $datetime);
        ?>

        <h3><?php echo count($results); ?> total links found on
            <?php echo $results[0]['site']; ?>. Original added on <?php echo $formatFordatetime; ?></h3>
        <!-- echo links by site -->
        <h3>List of links:</h3>
        <table class="table table-striped">        
            <tbody>
                <?php foreach ($results as $row): ?>
                    <tr>
                        <td>
                            <a href="<?php echo $row ['link'] ?>" target = "popup"><?php echo $row['link']; ?></a></td>
                        </td> 
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>
</html>
