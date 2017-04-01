

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
