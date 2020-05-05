<?php
/**
 * Include this to connect. Change the dbname to match your database,
 * and make sure your login information is correct after you upload 
 * to csunix or your app will stop working.
 * 
 * Sam Scott, Mohawk College, 2019
 */
try {
    $dbh = new PDO(
        "mysql:host=localhost;dbname=cs4130_sp2020", // set name db
        "cs4130_sp2020",  // set name user db
        "ltempPWD!"  // set password user db
    );
} catch (Exception $e) {
    die("ERROR: Couldn't connect. {$e->getMessage()}");
}
