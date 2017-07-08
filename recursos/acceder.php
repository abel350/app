<?php	

$userPOST = $_POST["email"]; 
$passPOST = $_POST["password"];


# data needs to be POSTed to the Play url as JSON.
# (some code from http://www.lornajane.net/posts/2011/posting-json-data-with-php-curl)
$data = array("email" => "$userPOST", "password" => "$passPOST");
$data_string = json_encode($data);

$ch = curl_init('http://ionic2-auth-example-acm.herokuapp.com/api/auth/login');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'Content-Length: ' . strlen($data_string))
);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

//execute post
$result = curl_exec($ch);
$obj_php = json_decode($result);

 if ($result == 'Unauthorized'){
	echo 'Unauthorized';
}else
	if ($result == 'Bad Request'){
		echo "Bad Request";
	}else{
		session_start();
		$_SESSION['usuario'] = $userPOST;
		$_SESSION['estado'] = 'Autenticado';		
		$_SESSION['token'] = $obj_php->token;
		echo $result;
	}

	/*session_start();
	$_SESSION['usuario'] = $datos['username'];
	$_SESSION['estado'] = 'Autenticado';*/
?>