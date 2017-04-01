<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            include  './db.php';
            include './functions.php';
            
            
                $db = dbconnect();

                $stmt = $db->prepare("SELECT * FROM sites ORDER BY site DESC");
                $site = array();
                if ($stmt->execute() && $stmt->rowCount() > 0) {
                    $site = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                $site_id = '';
                if ( isPostRequest() ) {
                    
                    
                    $stmt = $db->prepare("SELECT * FROM sites JOIN sitelinks ON sites.site_id = sitelinks.site_id WHERE sites.site_id = :site_id");
                    $site_id = filter_input(INPUT_POST, 'site_id');
                    $binds = array(
                    ":site_id" => $site_id
                    );

                    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } else {
                        $error = 'No Results found';
                    }
                    
                    
                    
                }
                
        ?>
        
        <?php if( isset($error) ): ?>        
            <h1><?php echo $error;?></h1>
        <?php endif; ?>
            
        <form method="post" action="#">
 
            <select name="site_id">
            <?php foreach ($site as $row): ?>
                <option 
                    value="<?php echo $row['site_id']; ?>"
                    <?php if( intval($site_id) === $row['site_id']) : ?>
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
            <?php $datetime = strtotime($results[0]['date']); 
                  $formatFordatetime = date("m/d/Y g:i A", $datetime);
            ?>
            
             <h2>Site Name <?php echo $results[0]['site']; ?></h2>
            <h2>Date Entered <?php echo $formatFordatetime; ?></h2>
            <h2>Results found <?php echo count($results); ?></h2>
            
            <table border="1">        
                <tbody>
                <?php foreach ($results as $row): ?>
                    <tr>
                        <td><a href="<?php echo $row ['link']?>" target = "popup"><?php echo $row['link']; ?></a></td> 
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        <?php endif; ?>
            
            

        
        
        
    </body>
</html>