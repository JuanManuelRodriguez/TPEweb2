<?php

require('libs/Smarty.class.php');

class View{
	
	protected $smarty;
	
	public function __construct(){
		$this->smarty = new Smarty();
	}
<<<<<<< HEAD
	
=======
	function mostrarMensaje($mensaje, $tipo){
		$this->smarty->assign('mensaje',$mensaje);
		$this->smarty->assign('tipoMensaje',$tipo);
		$this->smarty->display('mensaje.tpl');
	}
>>>>>>> marco
}


?>