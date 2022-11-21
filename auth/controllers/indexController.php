<?php
class indexController extends Controller
{
	public function __construct() {
		parent::__construct();
		session_start();
		if(isset($_SESSION["sesion_de_usuario"]["dni"])){
			header('location: app');
		}
	}

	public function index()
	{
		$this->_view->titulo = 'Tienda De Duraznos';
		$this->_view->renderizar('index',true);
	}






}
