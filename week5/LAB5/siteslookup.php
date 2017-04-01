<!DOCTYPE html>
<!--
DROPDOWN FOR SITES
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sites Lookup</title>
    </head>
    <body>
        <?php
        // put your code here
        require './functions/dbconnect.php';
        require './functions/until.php';


        $db = dbconnect();

        $stmt = $db->prepare("SELECT * FROM sites ORDER BY site DESC");
        $states = array();
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $states = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        $site_id = '';
        if (isPostRequest()) {


            $stmt = $db->prepare("SELECT * FROM sites WHERE site_id = :site_id");
            $site_id = filter_input(INPUT_POST, 'site_id');
            $site = filter_input(INPUT_POST, 'site');
            $binds = array(
                //Trial 1
                ":site_id" => $site_id,  //...failed
                //":site" => $site //...failed causes error PDOStatement::execute()_:SQLSTATE[HY093]
               
                
                
            );

            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $error = ' No Results found';
            }
        }
        //TRIAL TO POPULATE DROPDOWN.....
        //FIRST TRY $site_id....fail
        //SECOND TRY $site...fail
        //THIRD TRY $sites...fail
        
        ?>
            <?php if( isset($error) ): ?>        
            <h1><?php echo $error;?></h1>
        <?php endif; ?>
            
        <form method="post" action="#">
 
            <select name="sites">
            <?php foreach ($site as $row): ?>
                <option 
                    value="<?php echo $row['site']; ?>"
                    <?php if( intval($site_id) === $row['site']) : ?>
                        selected="selected"
                    <?php endif; ?>
                >
                    <?php echo $row['site']; ?>
                </option>
            <?php endforeach; ?>
            </select>

            <input type="submit" value="Submit" />
        </form>
        
        
        
        
        <?php if( isset($results) ): ?>
 
            <h2>Results found <?php echo count($results); ?></h2>
            <table border="1">        
                <tbody>
                <?php foreach ($results as $row): ?>
                    <tr>
                        <td><?php echo $row['site']; ?></td> 
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        <?php endif; ?>
    </body>
</html>
