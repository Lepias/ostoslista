<?php

header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, DELETE, GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Max-Age: 3600');
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'));
$id = filter_var($input->id,FILTER_SANITIZE_SPECIAL_CHARS);

try{
    $db = new PDO('mysql:host=localhost;dbname=shoppinglist;charset=utf8','root','');
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
    $query = $db->prepare('delete from item where id=(:id)');
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    $query->execute();

    header('HTTP/1.1 200 OK');
    $data = array('id' => $id);
    print json_encode($data);
    }

    
    catch (PDOException $pdoex) {
        header('HTTP/1.1 500 Internal Server Error');
        $error = array ('error' => $pdoex->getMessage());
        print json_encode($error);
    }
    