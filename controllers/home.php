<?php

class Home extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view("Home - Clear to Take Off", "")->render("index" . DS . "index");
    }

}
