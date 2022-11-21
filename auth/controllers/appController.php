<?php

class appController extends Controller
{

	public function __construct()
	{
		parent::__construct();
		session_start();
	}

	public
    function index()
    {
        $this->_view->titulo = 'Sistema App: ';
        $this->_view->setJs(array('app'));
        
        
        $this->_view->renderizar('index', false);
    }


}
