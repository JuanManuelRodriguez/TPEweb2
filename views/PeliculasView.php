<?php
include_once('View.php');

class PeliculasView extends View
{

  function agregarError($error){
    $this->smarty->assign('error',$error);
  }

<<<<<<< HEAD
  function mostrarMensaje($mensaje, $tipo){
    $this->smarty->assign('mensaje',$mensaje);
    $this->smarty->assign('tipoMensaje',$tipo);
    $this->smarty->display('mensaje.tpl');
  }

=======
>>>>>>> marco
  function mostrar($peliculas,$generos){
    $this->smarty->assign('peliculas',$peliculas);
    $this->smarty->assign('generos',$generos);
    $this->smarty->display('index.tpl');
  }

<<<<<<< HEAD
  function mostrarPeliculasDelGenero($peliculas,$generos){
    $this->smarty->assign('peliculas',$peliculas);
    $this->smarty->assign('generos',$generos);
    $this->smarty->display('lista.tpl');
  }

=======
>>>>>>> marco
  function mostrarPrincipal($peliculas,$generos){
    $this->smarty->assign('peliculas',$peliculas);
    $this->smarty->assign('generos',$generos);
    $this->smarty->display('principal.tpl');
  }

  function getLista($peliculas){
    $this->smarty->assign('peliculas',$peliculas);
    $this->smarty->display('lista.tpl');
  }
  
<<<<<<< HEAD
  function getListaParaAdmin($peliculas){
    $this->smarty->assign('peliculas',$peliculas);
    $this->smarty->display('adminlista.tpl');
  }

  function mostrarPelicula($pelicula,$generos){//muestra una pelicula, traida por id, al template editarPelicula para editarla
    $this->smarty->assign('pelicula',$pelicula);
    $this->smarty->assign('generos',$generos);
    $this->smarty->display('editarPelicula.tpl');
  }
  
  function getPelicula($pelicula){
    $this->smarty->assign('pelicula',$pelicula);
    $this->smarty->display('detallesPelicula.tpl');
  }

  function mostrarAdministradorDePeliculas($peliculas,$generos){
    $this->smarty->assign('peliculas',$peliculas);
    $this->smarty->assign('generos',$generos);
    $this->smarty->display('Admin.tpl');
  }
=======
>>>>>>> marco
}

 ?>