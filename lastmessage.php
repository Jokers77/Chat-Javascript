<?php 
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

	$id = file_get_contents('message.php');
	$msg = $bdd->prepare("SELECT * FROM user WHERE id >=" . $id);
	$msg->execute();
	$message = $msg->fetchAll();

	echo json_encode($message);



?>