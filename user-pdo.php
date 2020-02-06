<?php
session_start();
class userpdo
{
	private	$id ;
	public $login;
	private	$password;
	public $email;
	public $firstname;
	public $lastname;

	public function register($login,$password, $email, $firstname, $lastname)
	{	
		$bd = new PDO('mysql:host=localhost;dbname=class-php;charset=utf8', 'root','');
		$req="INSERT INTO user (login,password,email,firstname,lastname) VALUES ('".$login."', '".$password."','".$email."','".$firstname."','".$lastname."')";
		$res = $bd->query($req);
		$array = 
		array
		(
    		"login" =>$login ,
    		"password" => $password,
    		"firstname" => $firstname,
    		"lastname" => $lastname,
    		"email" => $email
    	);
    	return $array;
	}

	public function connect($login, $password)
	{
		$bd=new PDO('mysql:host=localhost;dbname=class-php;charset=utf8', 'root','');
		$req="SELECT * FROM user WHERE login='".$login."' && password='".$password."'";
		$res = $bd->query($req);
		$aff= $res->fetch();
	
		if(!empty($aff))
		{
			$this->id = $aff['id'];
			$this->login = $aff['login'];
			$this->password = $aff['password'];
			$this->email = $aff['email'];
			$this->firstname = $aff['firstname'];
			$this->lastname = $aff['lastname'];

		}
		else
		{
			echo "erreur dans la connexion";
		}	
	}

	public function disconnect()
	{
		session_destroy();
	}

	public function delete()
	{	
		$bd=new PDO('mysql:host=localhost;dbname=class-php;charset=utf8', 'root','');
		$req="DELETE FROM `user` WHERE `id` = ".$this->id.";";
		$res = $bd->query($req);
		session_destroy();
	}

	public function update($login, $email, $firstname, $lastname)
	{
		$bd=new PDO('mysql:host=localhost;dbname=class-php;charset=utf8', 'root','');
		$req="UPDATE user SET login = '".$login."' , email = '".$email."' , firstname = '".$firstname."' , lastname = '".$lastname."' WHERE `id` = ".$this->id.";";
		$res = $bd->query($req);
	}
	public function isConnected()
	{
		if(empty($this->id))
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	public function getAllInfos()
	{
		$array = 
		array
		(
    		"id" =>$this->id ,
    		"login" =>$this->login ,
    		"password" => $this->password,
    		"firstname" => $this->firstname,
    		"lastname" => $this->lastname,
    		"email" => $this->email
    	);
    	return $array;
	}

	public function getLogin()
	{
		return $this->login;
	}
	public function getEmail()
	{
		return $this->email;
	}

	public function getFirstname()
	{
		return $this->firstname;
	}
	public function getLastname()
	{
		$this->lastname;		
	}

	public function refresh()
	{
		
		

		$bd=new PDO('mysql:host=localhost;dbname=class-php;charset=utf8', 'root','');
		$req="SELECT * FROM user WHERE id='".$this->id."';";
		$res = $bd->query($req);
		$aff= $res->fetch();

			$this->id = $aff['id'];
			$this->login = $aff['login'];
			$this->password = $aff['password'];
			$this->email = $aff['email'];
			$this->firstname = $aff['firstname'];
			$this->lastname = $aff['lastname'];		
	}

}


if(!isset($_SESSION['test']))
	{
		$_SESSION['test'] = new userpdo;
	}	

?>