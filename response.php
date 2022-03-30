<?php
//include connection file 
include_once("conecta.php");

$db = new dbObj();
$connString =  $db->getConnstring();

$params = $_REQUEST;
$action = $params['action'] !='' ? $params['action'] : '';
$empCls = new Employee($connString);

switch($action) {
 case 'login':
	$empCls->login();
 break;
 case 'logout':
	$empCls->logout();
 break;
 default:
 return;
}


class Employee {
	protected $conn;
	protected $data = array();
	function __construct($connString) {
		$this->conn = $connString;
	}
	
	function login() {
		if(isset($_POST['login-submit'])) {
			$user_email = $_POST['username'];
			$user_password = $_POST['password'];
			$sql = "SELECT * FROM usuario WHERE usr_nome='$user_email'";
			$resultset = mysqli_query($this->conn, $sql) or die("database error:". mysqli_error($this->conn));
			$row = mysqli_fetch_assoc($resultset);
			if((mysqli_num_rows($resultset) == 1) && (sha1($user_password) == $row['usr_senha'])){
				if($row["usr_tipo"]==5){
					echo "Usuário Bloqueado.";
				}else{
					$_SESSION['username'] = $row['usr_nome'];
					$_SESSION["id_usuario"]= $row["usr_id"];
					$_SESSION["nome_usuario"] = explode(" ",$row["usr_nomeFull"])[0];
					$_SESSION["nome_usuarioFull"] = $row["usr_nomeFull"];
					$_SESSION["permissao"]= $row["usr_tipo"];
					echo "1";
				}
				
			} else {
				echo "Dados inválidos."; // wrong details
			}
		}
	}
	function logout() {
		unset($_SESSION['user_session']);
		if(session_destroy()) {
			header("Location: index.php");
		}
	}
}
?>
	