

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

    </head>
    <body>
        <header>
            <h1>Enter URL: </h1>
        </header>

        <?php
        include './functions/functions.php';
        include './functions/dbconnect.php';
        $db=  getDatabase();
        
        $site_id = filter_input(INPUT_POST, 'site_id');
        $site = filter_input(INPUT_POST, 'site');

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $site);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        // tested curl error with "http://404.php.net/"
        if (curl_errno($curl) && isset($site)) {
            echo 'Curl error: ' . curl_error($curl);
        }
        curl_close($curl);

// validation of is valid
        $isValid = true;
        if (isPostRequest()) {
            if (filter_var($site, FILTER_VALIDATE_URL) === false) {
                $isValid = false;
            }
            if ($isValid) {
                $site = '';
            }
        }
        ?>

        <?php if (!$isValid) : ?>
            <h1>This URL is invalid</h1>
        <?php endif; ?>
        <?php
//        if (preg_match('/(http?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/', $site)) {
//        echo "Your url is ok.";
//        } else {
//        echo "Wrong url.";
//        }
        ?>
        <textarea><?php echo $output; ?></textarea>  
        <?php
//        if (preg_match('/(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/', $site))  
//        {
//        echo $site;
//        } else {
//        $site = '';
//       
//        }
//        
        if ($site === ':site') {
            echo "ERROR ALREADY IN DATABASE";
            echo $site;
        }
        ?>

















        <!-- form validation / enter URL  -->      
        <!-- *******to go to validation page.  -->

        <form method="post" action="index.php">
            Website Address:    <input type="text" name="site" size = 40 value="<?php echo $site; ?>" />
            <input type="submit" value="Submit" />
        </form>
        <br />

    </body>
</html>


