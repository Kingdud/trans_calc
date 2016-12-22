<?php

$private_rng_seed = NULL;
include 'constants.php';

function DestroyCurrentSession()
{
	#This removes the session and all data.
	if (ini_get("session.use_cookies"))
	{
		$params = session_get_cookie_params();
		setcookie( session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"] );
	}

	session_destroy();
}

#Returns the $_GET value as an array if the variable is set. False otherwise.
#[0] = PHP/HTML escaped
#[1] = mysql escaped
function get_GETValue($mysql,$name)
{
	$tmp=array("","");
	if( isset($_GET["$name"]) )
	{
		$tmp[0] = htmlspecialchars($_GET["$name"]);
		$tmp[1] = mysqli_real_escape_string($mysql,$_GET["$name"]);
		if( $tmp[0] === "" && $tmp[1] === "" ) { return false; }
		return $tmp;
	}
	return false;
}

#Returns the $_POST value as an array if the variable is set. False otherwise.
#[0] = PHP/HTML escaped
function get_POSTValue($name)
{
	$tmp=array("","");
	if( isset($_POST["$name"]) )
	{
		$tmp[0] = htmlspecialchars($_POST["$name"]);
		if( $tmp[0] === "" ) { return false; }
		return $tmp;
	}
	return false;
}

function my_srand($seed)
{
	global $private_rng_seed;

	$private_rng_seed = (int)$seed;
}

function getSeed()
{
	global $private_rng_seed;
	return $private_rng_seed;
}

function my_rand()
{
	global $private_rng_seed;

	if($private_rng_seed === NULL)
	{
		print("Error, seed not set.");
		exit;
	}
	$private_rng_seed = $private_rng_seed * 16807 % (2147483646 + 1);
	#$private_rng_seed = $private_rng_seed * 16807 % (getrandmax() + 1);
	return $private_rng_seed;
}

function my_range($min,$max)
{
	return my_rand() % ($max - $min + 1) + $min;
}

?>
