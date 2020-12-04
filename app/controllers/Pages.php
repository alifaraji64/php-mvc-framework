<?php
class Pages extends Controller{

    public function index() {
        $this->view('index');
    }

    public function about(){
        echo 'about';
    }
}