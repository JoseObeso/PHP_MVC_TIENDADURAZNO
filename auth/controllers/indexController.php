<?php
class indexController extends Controller
{
	public function __construct() {
		parent::__construct();
		session_start();
		if(isset($_SESSION["usuario"]["nombreusuario"])){
			header('location: app');
		}
	}

	public function index()
	{
		$this->_view->titulo = 'Tienda De Duraznos';
		$this->_view->renderizar('index',true);
	}






}
