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

	    //METODOS PARA PESQUISA
	    //metodo que retorna um usuário a partir do ID

	    public function loadById($id){

	    	$sql = new Sql();

	    	$results = $sql -> select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(

	    		":ID" => $id

	    	));

	    	if (count($results) > 0) {

	    		$row = $results[0];

	    		$this -> setData($results[0]);
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

	    		$this -> setData($results[0]);
	    		
	    	} else {

	    		throw new Exception("Login ou senha inválidos");
	    		
	    	}
	    }

	    //metodo para receber os resultados das query

	    public function setData($dados){

	    		$this -> setIdusuario($dados['idusuario']);
	    		$this -> setDeslogin($dados['deslogin']);
	    		$this -> setDessenha($dados['dessenha']);
	    		$this -> setDtcadastro(new DateTime($dados['dtcadastro']));

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

	    //METODO INSERT

	    //metodo para inserir dados no banco de dados

	    public function insert(){

	    	$sql = new Sql();

	    	$results = $sql -> select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(

	    		':LOGIN' => $this -> getDeslogin(),
	    		':PASSWORD' => $this -> getDessenha()

	    	));

	    	if (count($results) > 0) {

	    		$this -> setData($results[0]);
	    	}
	    }

	    //inserção de dados no banco e apresentação das informações na tela por meio de metodo construtor

	    public function __construct($login = "", $password = ""){

	    	$this -> setDeslogin($login);
	    	$this -> setDessenha($password);
	    }

	    //METODO UPDATE

	    public function update($login, $password){

	    	$this -> setDeslogin($login);
	    	$this -> setDessenha($password);

	    	$sql = new Sql();

	    	$sql -> query ("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(

	    		':LOGIN' => $this -> getDeslogin(),
	    		':PASSWORD' => $this -> getDessenha(),
	    		':ID' => $this -> getIdusuario()

	    	));
	    }

	}

?>