<?php
/* Smarty version 3.1.30, created on 2016-10-17 03:59:06
  from "C:\xampp\htdocs\web2\TPEweb2\templates\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5804306a422773_13695390',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b9f02006e3d3056ecac6a536fa6e429db7e54979' => 
    array (
      0 => 'C:\\xampp\\htdocs\\web2\\TPEweb2\\templates\\index.tpl',
      1 => 1476669529,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:principal.tpl' => 1,
  ),
),false)) {
function content_5804306a422773_13695390 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Peliculas</title>
  <link href="libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Generos <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Accion</a></li>
            <li><a href="#">Aventura</a></li>
            <li><a href="#">Comedia</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Drama</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Animada</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Administrar</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container">
  <?php $_smarty_tpl->_subTemplateRender("file:principal.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</div>

<?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="libs/bootstrap/js/bootstrap.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="js/peliculas.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
