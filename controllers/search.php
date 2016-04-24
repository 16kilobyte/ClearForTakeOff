<?php

/**
 *
 */
class Search extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function suggest()
    {
        $this->model->suggest();
    }

    public function go()
    {
        $this->view("Flight Status Prediction - Clear to Take Off", "")->render("search/go");
    }

}
