<?php
session_start();
class user
{
	private	$id ;
	public $login;
	private	$password;
	public $email;
	public $firstname;
	public $lastname;

	public function register($login,$password, $email, $firstname, $lastname)
	{
		$bd=mysqli_connect("localhost","root","","class-php");
		$req="INSERT INTO user (login,password,email,firstname,lastname) VALUES ('".$login."', '".$password."','".$email."','".$firstname."','".$lastname."')";
		mysqli_query($bd,$req);
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
		$bd=mysqli_connect("localhost","root","","class-php");
		$req="SELECT * FROM user WHERE login='".$login."' && password='".$password."'";
		$quer=mysqli_query($bd,$req);
		$res=mysqli_fetch_all($quer);
		if(!empty($res))
		{
			$this->id = $res[0][0];
			$this->login = $res[0][1];
			$this->password = $res[0][2];
			$this->email = $res[0][3];
			$this->firstname = $res[0][4];
			$this->lastname = $res[0][5];

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
		$bd=mysqli_connect("localhost","root","","class-php");
		$req="DELETE FROM `user` WHERE `id` = ".$this->id.";";
		echo $req;
		$quer=mysqli_query($bd,$req);
		session_destroy();
	}

	public function update($login, $email, $firstname, $lastname)
	{
		$bd=mysqli_connect("localhost","root","","class-php");
		$req="UPDATE user SET login = '".$login."' , email = '".$email."' , firstname = '".$firstname."' , lastname = '".$lastname."' WHERE `id` = ".$this->id.";";
		$quer=mysqli_query($bd,$req);
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
		$bd=mysqli_connect("localhost","root","","class-php");
		$req="SELECT * FROM user WHERE id='".$this->id."';";
		$quer=mysqli_query($bd,$req);
		$res=mysqli_fetch_all($quer);

			$this->id = $res[0][0];
			$this->login = $res[0][1];
			$this->password = $res[0][2];
			$this->email = $res[0][3];
			$this->firstname = $res[0][4];
			$this->lastname = $res[0][5];			
	}

}
if(!isset($_SESSION['test']))
	{
		$_SESSION['test'] = new user;
	}	
//$_SESSION['test']->register("","","","","");
//$_SESSION['test']->connect("pute","pp");
//$_SESSION['test']->disconnect();
//$_SESSION['test']->delete();
//$_SESSION['test']->update('','','','');
//$_SESSION['test']->isConnected();
//$_SESSION['test']->getAllInfos();
//$_SESSION['test']->refresh();

?>