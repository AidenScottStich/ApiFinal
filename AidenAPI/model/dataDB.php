<?php
// this will take in all of the parameters from the method header and then transfer them into the database
function addUser($Email)
{

    $apiKey = bin2hex(random_bytes(16)); // Generates a 32-character hex string
    echo "API Key: " . $apiKey;

    global $db;
    $sql = "INSERT INTO `user` (`User_ID`, `User_Email`, `User_apikey`) VALUES (NULL, '$Email', '$apiKey');";
    // echo ($sql);
    $db->query($sql);
}

function Apikey()
{
    global $db;
    $sql = "SELECT * from user";
    $qry = $db->query($sql);  // returns PDOstatement
    // var_dump($qry);
    $result = $qry->fetchAll();

    return $result;
}
