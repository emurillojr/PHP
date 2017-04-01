<?php





//function validate() {
//       
//        $site = filter_input(INPUT_POST, 'site');
//        
//        // validation of is valid
//        $isValid=true;
//        if (isPostRequest()) {
//            if (filter_var($site, FILTER_VALIDATE_URL) === false) {
//                $isValid = false;
//            }
//            if ($isValid) {
//                $site = '';
//            }
//            
//        }
//}





/**
 * A method to check if a Post request has been made.
 *   * @return boolean
 */
function isPostRequest() {
    return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
}

/**
 * A method to check if a Get request has been made.
 *    
 * @return boolean
 */
function isGetRequest() {
    return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET' );
}

/**
 * This fuction will return one record when we pass in an ID
 * @param int $id
 * @return array
 */
function getTestRecord($id) {
    $db = getDatabase();

    $stmt = $db->prepare("SELECT * FROM corps");
    $binds = array
        (
        ":id" => $id
    );
    $results = array();
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    return $results;
}

/** This fuction is to update @param type $id, $corp, $email, $zipcode, $owner, $phone
 * @return bool
 */
function updateRecord($id, $corp, $email, $zipcode, $owner, $phone) {
    $db = getDatabase();

    $stmt = $db->prepare("UPDATE corps SET corp = :corp, email = :email, zipcode = :zipcode, owner = :owner, phone = :phone WHERE id = :id");
    $binds = array
        (
        ":id" => $id,
        ":corp" => $corp,
        ":email" => $email,
        ":zipcode" => $zipcode,
        ":owner" => $owner,
        ":phone" => $phone
    );

    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        return true;
    }

    return false;
}

/* Function to get all data from database  */
function getAllData() {
    $db = getDatabase();

    $stmt = $db->prepare("SELECT * FROM corps");

    $results = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return $results;
}

/* Function to search by variable column and searchWord  
 * also return result count and messages if result / no results  */
function searchAllbySelect($column, $searchWord) {
    $db = getDatabase();
    $stmt = $db->prepare("SELECT * FROM corps WHERE $column LIKE :search");
    
    $search = '%' . $searchWord . '%';
    $binds = array(
        ":search" => $search
    );
    $results = array();
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
    return $results;

    
    }

/* Function to link key with value  */
function columns() {
    return array('corp' => 'Corporation Name', 'incorp_dt' => 'Date', 'email' => 'EMail', 'zipcode' => 'Zip Code', 'owner' => 'Owner Name', 'phone' => 'Phone #');
}

/* Function to get list of columns by ASC DESC order */
function sortorder($column, $order) {
    $db = getDatabase();

    $stmt = $db->prepare("SELECT * FROM corps ORDER BY $column $order");

    $results = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
}

function curlsite($output1){
        
    
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
        return $output1;
}



//
//function url_exists()
//{
//    $query = "SELECT * FROM sites WHERE site = '$site'";
//    $url_data  = mysqli_query($db, $query);
//    if ($site = mysqli_fetch_assoc($url_data)){
//        return $site;
//    } else {   
//    return null;
//}
//}


function checkURLexists() {
    $db = getDatabase();
    $site = filter_input(INPUT_POST, 'site');
    $stmt = $db->prepare("SELECT site FROM sites WHERE site = '$site'");
    $binds = array
        (
        "site" => $site
        );
    $results = array();
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) 
        {
        return true;
        }
        
    }
    
    
    function checkURL() {
    $db = dbconnect();
    $url = filter_input(INPUT_POST, 'site');
    
    $stmt = $db->prepare("SELECT * FROM sites WHERE site = '$url'");
    $binds = array
        (
        ":site" => $url
        );
    $results = array();
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) 
        {
        return true;
        }
      
        else {

        $stmt = $db->prepare("INSERT INTO sites SET site_id = :site_id, site = :site, date = now()");
        
        $binds = array(":site_id" => $site_id, ":site" => $url);
        
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        
        echo $results = ' Data Added';
        }
        }
    }
    
    
    
//    function urlcheck() {
//    $db = getDatabase();
//    $stmt = $db->prepare("SELECT * FROM sites WHERE $site LIKE :site");
//    
//   $binds = array(
//        ":site" => $site
//    );
//    $results = array();
//    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
//        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//    }
//   
//    return TRUE;
//   
//    }
    
    
    
    function usernameCheck($site) {
        $db = getDatabase();
    $stmt = $db->prepare("SELECT site FROM sites WHERE site = :site");
    $stmt->bindParam(':site', $site);
    $stmt->execute();

    if($stmt->rowCount() > 1){
        echo "exists!";
    } else {
        echo "non existant";
    }
}