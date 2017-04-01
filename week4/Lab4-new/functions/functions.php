<?php

/** Ernesto Murillo 
 * Functions PHP Page inside functions folder 
 */

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
 * This function will return one record when we pass in an ID
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
