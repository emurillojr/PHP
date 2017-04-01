<?php

// Ernesto Murillo Final  - functions page

function insertINTOdbUSERS() {
    $results = '';
    $db = dbconnect();
    $email = filter_input(INPUT_POST, 'email');
    $phone = filter_input(INPUT_POST, 'phone');
    $heard = filter_input(INPUT_POST, 'heard');
    $contact = filter_input(INPUT_POST, 'contact');
    $comments = filter_input(INPUT_POST, 'comments');
    $stmt = $db->prepare("INSERT INTO account SET email = :email, phone = :phone, heard = :heard, contact = :contact, comments = :comments");
    $binds = array(
        ":email" => $email,
        ":phone" => $phone,
        ":heard" => $heard,
        ":contact" => $contact,
        ":comments" => $comments
    );
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = 'All accepted.  Thank you.';
    }echo $results;
}
