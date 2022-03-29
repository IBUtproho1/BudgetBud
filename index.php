<?php
require 'vendor/autoload.php';

Flight::route('/', function(){
  echo 'Welcome to BudgetBud';
});

Flight::start();

?>
