<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php';
require_once 'dao/ItemDao.php';

Flight::register('itemDao', 'ItemDao');

Flight::route('GET /items', function(){
  $result = Flight::itemDao()->get_all();
  Flight::json($result);
});

Flight::route('GET /items/@id', function($id){
  $result = Flight::itemDao()->get_by_id($id);
  Flight::json($result);
});

Flight::route('POST /items', function(){
  $request = Flight::request();
  $data = $request->data->getData();
  $todo = Flight::itemDao()->add($data);
  Flight::json($todo);
});

Flight::route('PUT /items/@id', function($id){
  $data = Flight::request()->data->getData();
  $data['id']=$id;
  Flight::itemDao()->update($data);
  Flight::json($data);
});

Flight::route('DELETE /items/@id', function($id){
  Flight::itemDao()->delete($id);
  Flight::json(["message"=>"deleted"]);
});





Flight::start();

 ?>
