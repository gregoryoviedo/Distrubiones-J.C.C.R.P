<?php 
	session_start();

	if($_SESSION['nombre'] == null || $_SESSION['nombre'] == ''){
		header("Location:../../mainmenu/vista/login.html");
		exit();
	}

	require_once('../../auditoria/modelo/auditoria.class.php');
	$auditor = new auditor;
	$auditor->auditar($_SESSION['id_empleado'],$_SESSION['usuario'],'Salida','LogOut','Salida del sistema');

	session_destroy();
	header("Location:../../mainmenu/vista/login.html");
?>
