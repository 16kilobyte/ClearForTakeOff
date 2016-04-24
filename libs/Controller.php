<?php

class Controller
{

    protected $view;
    //protected $model;

    protected function __construct()
    {
    }

    protected function view($title = DEFAULT_TITLE, $current_page = "")
    {
        //new View($title);
        return new View($title, $current_page);
    }

    public function loadModel($name)
    {
		$path = 'models' . DS . $name.'_model.php';
		if (file_exists($path))
        {
			require $path;

			$modelName = $name . '_Model';
			$this->model = new $modelName();
		}
	}

}
