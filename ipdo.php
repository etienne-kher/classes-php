<?php 
session_start();
class ipdo
{
	private $localhost;
	private $user;
	private $password;
	private $bd;
	private $con;
	private $query;
	private $res;

	public function constructeur($db,$host="localhost", $username="root", $password="")
	{
		$this->localhost=$host;
		$this->user=$username;
		$this->password=$password;
		$this->bd=$db;
		$this->con=mysqli_connect($this->localhost,$this->user,$this->password,$this->bd);
	}
   public function connect($db,$host="localhost", $username="root", $password="")
   {
		if (!empty($this->con)) 
		{
		   		mysqli_close($this->con);
		}   	
   		$this->localhost=$host;
		$this->user=$username;
		$this->password=$password;
		$this->bd=$db;
		$this->con=mysqli_connect($this->localhost,$this->user,$this->password,$this->bd);
   }
	public function destructeur()
	{
		mysqli_close($this->con);
	}
    public function close()

    {
    	mysqli_close($this->con);
    }
	public function execute($query)
	{
		$this->query=$query;
		$a=mysqli_query($query);
		$rep=mysqli_fetch_all($a);
		$this->res=$rep;
		return $rep;
	}
	public function getLastQuery()
	{
		if (!empty($this->query)) 
		{
			return $this->query;
		}
		else
		{
			return false;
		}
	}
	public function getLastResult()
	{
		if (!empty($this->res)) 
		{
			return $this->res;
		}
		else
		{
			return false;
		}
	}
	public function getTables()
	{
		$req="SELECT table_name FROM INFORMATION_SCHEMA.TABLES WHERE table_schema = '".$this->bd."' ";
		$rep= mysqli_query($this->con,$req);
		$res=mysqli_fetch_all($rep);
		return $res;
	}
	public function getFields($table)
	{
		$req="SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE table_schema = '".$this->bd."' AND table_name='".$table."'";
		$rep= mysqli_query($this->con,$req);
		$res=mysqli_fetch_all($rep);
		return $res;
	}
}
