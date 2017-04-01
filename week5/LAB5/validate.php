

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

    </head>
    <body>

        <?php
        include './functions/dbconnect.php';
        include './functions/functions.php';
        //$site_id = filter_input(INPUT_POST, 'site_id');
        $site = filter_input(INPUT_POST, 'site');
        echo $site;
        
        //$url = "validate.php";
        
        // create curl resource 
        $curl = curl_init(); 
        // set url 
        curl_setopt($curl, CURLOPT_URL, $site); 
        //return the transfer as a string 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
        // $output contains the output string 
        $output = curl_exec($curl); 
        // close curl resource to free up system resources 
        
        // tested curl error with "http://404.php.net/"
        if(curl_errno($curl))
        {
        echo 'Curl error: ' . curl_error($curl); 
        }
        curl_close($curl);    
          
        if (preg_match('/(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/', $site)) {
        echo "Your url is ok.";
        } else {
        echo "Wrong url.";
        }
        
        ?>
        <textarea><?php echo $output; ?></textarea>
        
        
        
        
       
        
        
       
        
       <?php 
        //verification of post 
//        if (isPostRequest()) {
//            $site_id = filter_input(INPUT_POST, 'site_id');
//            $site = filter_input(INPUT_POST, 'site');
//        }
//        // validation of is valid
//        $isValid = true;
//        if (isPostRequest()) {
//            if (filter_var($site, FILTER_VALIDATE_URL) === false) {
//                $isValid = false;
//            }
//
//            if ($isValid) {
//                $site = '';
//            $db=  getDatabase();
//            $site_id = filter_input(INPUT_POST, 'site_id');
//            $site = filter_input(INPUT_POST, 'site');
//            $stmt = $db->prepare("INSERT INTO sites SET site_id = :site_id, site = :site, date = now()");
//
//            $binds = array
//                (
//                ":site_id" => $site_id,
//                ":site" => $site
//               );
//
//            /* We execute the statement and make sure we got some results back */
//            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
//                $results = '**Corp Info Added**';
//            } 
//                
//            
//            }
//            
//        }
// /       
//              ?>
        <!-- linking $site to user post site -->
       
       <?php// $site = filter_input(INPUT_POST, 'site') ?>
       <?php //if (!$isValid) : ?>
<!--            <h1>This URL is invalid</h1>       -->
       <?php //endif; ?>
  
            
            
        <!-- form validation / enter URL  -->      
        <!-- *******to go to validation page.  -->
     <!--   <h1>Add a new website</h1>
                <form method="post" action="index">
            URL:  <input type="text" name="site" size = 40 value="<?php echo $site; ?>" />
            <input type="submit" value="Submit" />
        </form>

        <br />
      -->
    </body>
</html>


