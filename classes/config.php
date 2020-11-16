<?php

require 'vendor/autoload.php';



class Config{


public $SMTP_HOST;
public $SMTP_PORT;
public $SMTP_USER;
public $SMTP_PASSWORD;
public $app_id;
public $key ;
public $secret ;
public $cluster ;

function __construct() {
    
    $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 1));
    $dotenv->load();
    
    $this->SMTP_HOST = $_ENV['SMTP_HOST'];
    $this->SMTP_PORT = $_ENV['SMTP_PORT'];
    $this->SMTP_USER = $_ENV['SMTP_USER'];
    $this->SMTP_PASSWORD = $_ENV['SMTP_PASSWORD'];
    $this->app_id=$_ENV['app_id'];
    $this->key=$_ENV['key'];
    $this->secret=$_ENV['secret'];
    $this->cluster=$_ENV['cluster'];
}
}
?>