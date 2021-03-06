<?php

/*
 * Following code will list all the products
 */

// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// get all products from products table
$result = mysql_query("SELECT *FROM news") or die(mysql_error());

// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["news"] = array();
    
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $new = array();
        $new["nid"] = $row["id"];
        $new["title"] = $row["title"];
        $row["description"]=utf8_encode($row["description"]);
        $new["description"] = $row["description"];
        $new["date_create"] = $row["date_create"];
        $new["date_updated"] = $row["date_updated"];
        $new["image"] = $row["image"];

        // push single product into final response array
        array_push($response["news"], $new);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No news available.";

    // echo no users JSON
    echo json_encode($response);
}
?>
