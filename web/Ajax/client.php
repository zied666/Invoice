<?php

include 'param.php';
$link = mysqli_connect($host, $user, $passwd, $bdd) or die("erreur de connexion au serveur");

$json = array();
mysqli_query($link, "SET NAMES 'utf8'");
$requete = "SELECT * FROM ttt_clients where id=" . $_GET['id'];
$result = mysqli_query($link, $requete);

$row = mysqli_fetch_array($result);
$json['nom'] = $row['nom'] . ' ' . $row['prenom'];
$json['adresse'] = $row['adresse'];
$json['matricule'] = $row['matricule_fiscale'];
$json['tel'] = $row['tel'];
$json['email'] = $row['email'];


echo json_encode($json);
?>