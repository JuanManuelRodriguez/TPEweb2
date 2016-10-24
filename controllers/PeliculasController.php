<?php
include('models/PeliculasModel.php');
include_once('views/PeliculasView.php');
include_once('views/PeliculasFiltradasXGeneroView.php');
require_once('views/DetallesPeliculaView.php');
require_once('views/AdministradorPeliculaView.php');

class PeliculasController
{
  private $vista;
  private $vistaPeliculasXgenero;
  private $vistaDetallesPelicula;
  private $modelo;
  private $generosController;

  function __construct($generosController)
  {
    $this->modelo = new PeliculasModel();
    $this->vista = new PeliculasView();
    $this->vistaPeliculasXgenero = new PeliculasFiltradasXGeneroView();
    $this->vistaDetallesPelicula = new DetallesPeliculaView();
    $this->vistaAdministradorPelicula = new AdministradorPeliculaView();
    $this->generosController=$generosController;
  }

  function iniciar(){
    $peliculas = $this->modelo->getPeliculas();
    $generos= $this->generosController->getModelo()->getGeneros();
    $this->vista->mostrar($peliculas,$generos);
  }

  function actualizarLista(){
    $peliculas = $this->modelo->getPeliculas();
    $this->vistaAdministradorPelicula->getListaParaAdmin($peliculas);
  }

  function getImagenVerificada($imagen){
      if($imagen['size']>0 && $imagen['type']=="image/jpeg"){
          return $imagen;
      }
  }

  function guardar(){
    if(isset($_FILES['imagen'])&&isset($_POST['titulo'])&&isset($_POST['link'])&&isset($_POST['descripcion'])&&isset($_POST['generos'])){
      $titulo = $_POST['titulo'];
      $link = $_POST['link'];
      $descripcion = $_POST['descripcion'];
      $generos = $_POST['generos'];
      $imagenVerificada = $this->getImagenVerificada($_FILES['imagen']);
      if((count($imagenVerificada)>0) && (count($generos)>0)){
        $id_generos=$this->generosController->getModelo()->getIdGenerosSegunArregloGeneros($generos);
        $this->modelo->crearPelicula($titulo,$link,$descripcion,$imagenVerificada,$id_generos);
        $this->vista->mostrarMensaje("La pelicula se creo con imagen y todo!", "success");
      }
      else{
        $this->vista->mostrarMensaje("Error con las imagenes", "danger");
      }
    }
    else{
      $this->vista->mostrarMensaje("Error. uno o mas campos no completados","danger");
    }

    $this->actualizarLista();

  }

  function eliminar(){
    $key = $_GET['id_pelicula'];
    $this->modelo->eliminarPelicula($key);
    $peliculas = $this->modelo->getPeliculas();
    $this->vistaAdministradorPelicula->getListaParaAdmin($peliculas);
  }

  function peliculaAEditar(){
    $key = $_GET['id_pelicula'];
    $pelicula=$this->modelo->getPeliculaXId($key);
    $generos = $this->generosController->getModelo()->getGeneros();//$this->modelo->getGeneros();
    $this->vistaAdministradorPelicula->mostrarPelicula($pelicula,$generos);
  }

  function mostrarVistaAdmnistradorPeliculas(){//despues de editar se carga el tpl adminlista para mostrar las peliculas
    $peliculas = $this->modelo->getPeliculas();
    $generos = $this->generosController->getModelo()->getGeneros();
    $this->vistaAdministradorPelicula->mostrarAdministradorDePeliculas($peliculas,$generos);
  }
  
  function mostrarVistaPeliculas(){
    $peliculas = $this->modelo->getPeliculas();
    $this->vista->getLista($peliculas);
  }

  function updateGenerosPelicula($generos,$id_pelicula){//cuando edito compruebo los generos que ya existen en esa pelicula, para no modificarlos, los que no existen, para crearlos y los que ya no estan, borrarlos
    $todosLosGeneros=$this->generosController->getModelo()->getGeneros();
    $generosAnterioresDePelicula=$this->modelo->getGenerosSegunIdPelicula($id_pelicula);
    foreach ($todosLosGeneros as $unGenero){//por cada genero que exista en la tabla Genero
      if (in_array($unGenero['titulo'],$generos)){//si el usuario eligio este genero, compruebo si los tiene la pelicula
        if (!in_array($unGenero['titulo'],$generosAnterioresDePelicula)){ //si el genero seleccionado no esta en la tabla de relacion Genero_Pelicula, lo agrego
          $this->modelo->crearGeneroPelicula($this->modelo->getIdGenero($unGenero['titulo']),$id_pelicula);
        }
      }
      else if (in_array($unGenero['titulo'],$generosAnterioresDePelicula)){// si el genero no esta seleccionado, pero pertenece a la tabla de realcion genero_pelicula, lo elimino
        $this->modelo->eliminarUnGeneroDePelicula($this->modelo->getIdGenero($unGenero['titulo']),$id_pelicula);
      }
    }
  }

  function editar(){
    if(isset($_POST['id_pelicula'])&&isset($_POST['titulo'])&&isset($_POST['link'])&&isset($_POST['descripcion'])&&isset($_POST['generos'])){
      $id_pelicula=$_POST['id_pelicula'];
      $titulo = $_POST['titulo'];
      $link = $_POST['link'];
      $descripcion = $_POST['descripcion'];
      $generos = $_POST['generos'];
      if(!empty($_FILES['imagen']['name'])){  //si se agrego una imagen al formulalrio para cambiar la actual
        $imagenVerificada = $this->getImagenVerificada($_FILES['imagen']);
        if((count($imagenVerificada)>0) && (count($generos)>0)){
          $pelicula=$this->modelo->getPeliculaXId($id_pelicula);
          $this->modelo->desvincularImgAnterior($pelicula['imagen']);
          $imagen=$this->modelo->imagenUpload($imagenVerificada);
          $this->updateGenerosPelicula($generos,$id_pelicula);
          $this->modelo->editarPelicula($titulo,$link,$descripcion,$imagen,$id_pelicula);
          $this->mostrarVistaAdmnistradorPeliculas();
        }
        else if(count($generos)>0){ //pelicula editada, pero conservando la imagen anterior porque no paso la verificacion
          $this->updateGenerosPelicula($generos,$id_pelicula);
          $this->modelo->editarPeliculaSinImagen($titulo,$link,$descripcion,$id_pelicula);
          $this->mostrarVistaAdmnistradorPeliculas();
        }
        else{
          $this->vista->mostrarMensaje("Error con los generos", "danger");
          $this->mostrarVistaAdmnistradorPeliculas();
        }
      }
      else {
        if(count($generos)>0){//pelicula editada, pero conservando la imagen anterior porque no se agrego al formulario
          $this->updateGenerosPelicula($generos,$id_pelicula);
          $this->modelo->editarPeliculaSinImagen($titulo,$link,$descripcion,$id_pelicula);
          $this->mostrarVistaAdmnistradorPeliculas();
        }
        else{
          $this->vista->mostrarMensaje("Error con los generos", "danger");
          $this->mostrarVistaAdmnistradorPeliculas();
        }
      }
    }
    else{
      $this->vista->mostrarMensaje("Error. uno o varios campos no completados", "danger");
      $this->mostrarVistaAdmnistradorPeliculas();
    }
  }

  function getPelicula(){
    $id_pelicula=$_GET['id_pelicula'];
    $pelicula=$this->modelo->getPeliculaXId($id_pelicula);
    $this->vistaDetallesPelicula->getPelicula($pelicula);
  }

  function mostrarPeliculasXGenero(){
    $tituloGenero=$_GET['titulo'];
    $id_genero=$this->modelo->getIdGenero($tituloGenero);
    $generos=$this->generosController->getModelo()->getGeneros();
    $peliculasXgenero=$this->modelo->getPeliculasXGenero($id_genero);
    if(empty($peliculasXgenero)){
      $this->vista->mostrarMensaje("No existen peliculas con ese genero", "danger");
    }
    else{
      $this->vistaPeliculasXgenero->mostrarPeliculasDelGenero($peliculasXgenero,$generos);
    }

  }
  function irAAdministradorDePeliculas(){
    $peliculas = $this->modelo->getPeliculas();
    $generos = $this->generosController->getModelo()->getGeneros();
    $this->vistaAdministradorPelicula->mostrarAdministradorDePeliculas($peliculas,$generos);
  }
}
 ?>
