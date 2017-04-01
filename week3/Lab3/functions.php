<?php

/**
 * A method to check if a Post request has been made.
 *    
 * @return boolean
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
 * This function will return one record when we pass in an ID
 * @param int $id
 * @return array
 * 
 * 
 */
function getTestRecord($id) {
    $db = getDatabase();

    $stmt = $db->prepare("SELECT * FROM corps where id = :id");
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

/** This function is to update @param type $id, $corp, $email, $zipcode, $owner, $phone
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
