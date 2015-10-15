<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

if (isset($_POST['nom']) && isset($_POST['message'])){

	$rq = $bdd->prepare("INSERT INTO user (nom, message) VALUES (:name, :message)");
	$rq->bindParam(':name', $_POST['nom']);
	$rq->bindParam(':message', $_POST['message']);
	$rq->execute();

	$id = $bdd->prepare('SELECT id FROM user ORDER BY id DESC LIMIT 1');
	$id->execute();
	$idLast = $id->fetch();

	file_put_contents('message.php', $idLast['id']);

}


	$msg = $bdd->prepare("SELECT * FROM user");
	$msg->execute();
	$message = $msg->fetchAll();

	echo json_encode($message);



?>