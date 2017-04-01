<!DOCTYPE html>
<!--



-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>View</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    </head>

    <body>
        <header>
            <h1>Enter URL: </h1>
        </header>
        <?php
        include './functions/dbconnect.php';
        include './functions/functions.php';

        //$site = filter_input(INPUT_POST, 'site');

        $results = '';
        $db = getDatabase();
        $site_id = filter_input(INPUT_POST, 'site_id');
        $site = filter_input(INPUT_POST, 'site');

        // create curl resource 
        $curl = curl_init();
        // set url 
        curl_setopt($curl, CURLOPT_URL, $site);
        //return the transfer as a string 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // $output contains the output string 
        $output = curl_exec($curl);

        if (curl_errno($curl) && isset($site)) {
        //$error = 'Curl Failed' . curl_error($curl);
        //echo $error;
        }
        curl_close($curl);
        
       
      if (!filter_var($site, FILTER_VALIDATE_URL)){
        $error = "Enter a  valid URL";
        
}



if(!isset($error)){
//no error

$stmt = $db->prepare("SELECT site FROM sites WHERE site = :site");
$binds = array
            (":site" => $site);
//$stmt->bindParam(':site', $site);
//$stmt->execute();

if($stmt->execute($binds) && $stmt->rowCount() > 0){
    echo "URL already exists! CANNOT insert";
} else {
    //Securly insert into database
     $stmt = $db->prepare("INSERT INTO sites SET site_id = :site_id, site = :site, date = now()");

            $site_id = filter_input(INPUT_POST, 'site_id');
            $site = filter_input(INPUT_POST, 'site');
            
            $binds = array
                (
                ":site_id" => $site_id,
                ":site" => $site
            );
             if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                $results = 'URL Added********';
                echo $results;
            }
            else {
            echo 'ERROR occured: ' . $error;
        }
       
}
}



            
            
            
            
        
?>
        <?php echo $output; ?>  

        <form method="post" action="view.php">
            Website Address:    <input type="text" name="site" size = 40 value="<?php echo $site; ?>" />
    
            <input type="submit" value="Submit" />
        </form>
        <br />

    </body>
</html>


