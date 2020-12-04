<?php
class Core {
    protected $currentController = 'Page';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){
        $url = $this->getURL();

        //look in 'controllers' folder for first value, ucwords will
        //capitilize the first letter
        if( file_exists('../app/controllers/'.ucwords($url[0]).'.php')  ){
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }
            require('../app/controllers/' . $this->currentController . '.php');
           // $this->currentController = new $this->currentController;
    }

    //returns an array containing all the parameters in url
    public function getURL(){
        if( isset($_GET['url'] )){
            //remove the last / from url
            $url = rtrim($_GET['url'],'/');
            //filter vars as string/numbers
            $url = filter_var($url,FILTER_SANITIZE_URL);
            //conver it to an array
            $url = explode('/',$url);
            return $url;
        }
    }
}