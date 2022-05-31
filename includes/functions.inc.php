<?php

function db_connect(){
    // static means we are declaring a variable as Global. So it preserves previous connection.
    static $connection;
 
    if(! isset($connection)){
        $config =  parse_ini_file('config.ini');
        $connection = mysqli_connect(
            $config['host'],
            $config['username'],
            '',
            $config['db_name'],
            $config['db_port']
        );
    }

    if($connection === false){
        return mysqli_connect_error(); 

    }
    return $connection;
}

function db_query($query) {
    // call to db_connect function which returns connection.
    $connection = db_connect();

    $result = mysqli_query($connection, $query);
    // here mysqli_query will return a table.
    
    return $result;
}
function db_error() {
    $connection = db_connect();
    return mysqli_error($connection);
}
/**
 * @return false if result is not fetched
 * @return multi-dimensional array with the result if the result is not found 
 */
//  this db_select function will accept the query as parameter
//  and pass the query to db_query function.
 function db_select($query){
     $rows = array();
    //  call to db_query which returns result ie. table 
    $result = db_query($query);
    if($result === false){
         return false;
    }
    // mysqli_fetch_assoc will return each row in the form of associative array.
    while ($row = mysqli_fetch_assoc($result)){
         $rows[] = $row;
    }
    return $rows;
}

function dd($data) {
    die(var_dump($data));
}

function myDate($d,$format='Y-m-d'){
    return date($format, strtotime($d));

}
function getOldValue($data,$key,$defaultValue = "")
{
    if(isset($data[$key]))
    {
        return $data[$key];
    }
    return $defaultValue;
}



    


function redirect($url){
    header("Location: $url");
}