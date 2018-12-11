<?php

	class Usuario {

		private $idusuario;
		private $deslogin;
		private $dessenha;
		private $dtcadastro;

	    /**
	     * @return mixed
	     */
	    public function getIdusuario()
	    {
	        return $this->idusuario;
	    }

	    /**
	     * @param mixed $idusuario
	     *
	     * @return self
	     */
	    public function setIdusuario($idusuario)
	    {
	        $this->idusuario = $idusuario;

	        return $this;
	    }

	    /**
	     * @return mixed
	     */
	    public function getDeslogin()
	    {
	        return $this->deslogin;
	    }

	    /**
	     * @param mixed $deslogin
	     *
	     * @return self
	     */
	    public function setDeslogin($deslogin)
	    {
	        $this->deslogin = $deslogin;

	        return $this;
	    }

	    /**
	     * @return mixed
	     */
	    public function getDessenha()
	    {
	        return $this->dessenha;
	    }

	    /**
	     * @param mixed $dessenha
	     *
	     * @return self
	     */
	    public function setDessenha($dessenha)
	    {
	        $this->dessenha = $dessenha;

	        return $this;
	    }

	    /**
	     * @return mixed
	     */
	    public function getDtcadastro()
	    {
	        return $this->dtcadastro;
	    }

	    /**
	     * @param mixed $dtcadastro
	     *
	     * @return self
	     */
	    public function setDtcadastro($dtcadastro)
	    {
	        $this->dtcadastro = $dtcadastro;

	        return $this;
	    }

	    //metodo que retorna um usuário a partir do ID

	    public function loadById($id){

	    	$sql = new Sql();

	    	$results = $sql -> select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(

	    		":ID" => $id

	    	));

	    	if (count($results) > 0) {

	    		$row = $results[0];

	    		$this -> setIdusuario($row['idusuario']);
	    		$this -> setDeslogin($row['deslogin']);
	    		$this -> setDessenha($row['dessenha']);
	    		$this -> setDtcadastro(new DateTime($row['dtcadastro']));
	    	}

	    }

	    //metodo para busca do usuario pelo login

	     public static function search($login){

	    	$sql = new Sql();

	    	return $sql -> select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(

	    		':SEARCH' => "%" . $login . "%",

	    	));

	    }

	    //metodo para listar todos os usuários do sistema em ordem alfabetica do login

	    public static function getList(){

	    	$sql = new Sql();

	    	return $sql -> select("SELECT * FROM tb_usuarios ORDER BY deslogin");

	    }

	    //metodo para imprimir os dados de login e senha validados

	    public function login($login, $password){

	    	$sql = new Sql();

	    	$results = $sql -> select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(

	    		":LOGIN" => $login,
	    		":PASSWORD" => $password

	    	));

	    	if (count($results) > 0) {

	    		$row = $results[0];

	    		$this -> setIdusuario($row['idusuario']);
	    		$this -> setDeslogin($row['deslogin']);
	    		$this -> setDessenha($row['dessenha']);
	    		$this -> setDtcadastro(new DateTime($row['dtcadastro']));
	    	} else {

	    		throw new Exception("Login ou senha inválidos");
	    		
	    	}
	    }

	    //metodo para imprimir os dados da pesquisa em formato de String
	    
	    public function __toString(){

	    	return json_encode(array(

	    		"idusuario" => $this -> getIdusuario(),
	    		"deslogin" => $this -> getDeslogin(),
	    		"dessenha" => $this -> getDessenha(),
	    		"dtcadastro" => $this -> getDtcadastro() -> format("d/m/Y H:i:s")

	    	));
	    }

	}

?>