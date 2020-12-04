<?php
class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){
        $url = $this->getURL();
        //check if the first item in url array exists in 'controllers' folder
        if( file_exists('../app/controllers/'.ucwords($url[0]).'.php')  ){
            echo 'yooo';
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }
        require_once('../app/controllers/' . $this->currentController . '.php');
        $this->currentController = new $this->currentController;
        
        //check for the second item in url array
        if(isset($url[1])){
            $this->currentMethod = $url[1];
            unset($url[1]);
        }
        //params array is basically everything in $url except the first(controller) and second(method) item
        $this->params = $url ? array_values($url) : [];
        //this will call the respective class in 'controllers' 
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

        
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