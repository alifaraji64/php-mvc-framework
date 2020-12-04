<?php
    class Controller{
        public function __construct(){
            echo 'yo from constructorethe';
        }
        public function model($model){
            require_once('../app/models/' . $model . '.php');
            return new $model();
        }

        public function view($view, $data=[]){
            if(file_exists('../app/views/' . $view . '.php')){
                require_once('../app/views/' . $view . '.php');
            } 
            else{
                die("view doesn't exists");
            }
        }
    }