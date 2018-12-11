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
	/*$usuario = new Usuario();
	$usuario -> login("teste", "teste");
	echo $usuario;*/

	//inserção de dados no banco e apresentação das informações na tela
	/*$aluno = new Usuario();
	$aluno -> setDeslogin("aluno");
	$aluno -> setDessenha("123");
	$aluno -> insert();
	echo $aluno;*/

	//inserção de dados no banco e apresentação das informações na tela por meio de metodo construtor
	/*$aluno = new Usuario("maisumaluno", "123456");
	$aluno -> insert();
	echo $aluno;*/

	//alterando os dados de usuario
	$usuario = new Usuario();
	$usuario -> loadbyId(16);
	$usuario -> update("professor", "professor");

	echo $usuario;
?>