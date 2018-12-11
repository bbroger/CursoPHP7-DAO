<?php

	require_once ("config.php");

	//seleciona todos os usuários da tabela
	/*$sql = new Sql();
	$usuarios = $sql -> select("SELECT * FROM tb_usuarios");
	echo json_encode($usuarios);*/

	//seleciona um usuário pelo ID
	/*$root = new Usuario();
	$root -> loadbyId(3);
	echo $root;*/

	//lista todos os usuários
	/*$list = Usuario :: getList();
	echo json_encode($list);*/

	//pesquisa o usuário pelo nome do login
	/*$list1 = Usuario :: search("bbroger");
	echo json_encode($list1);*/

	//carrega um usuário que tenha o login e senha validados
	$usuario = new Usuario();

	$usuario -> login("teste", "teste");

	echo $usuario;




?>