<?php

include 'param.php';

$link = mysqli_connect($host, $user, $passwd, $bdd) or die("erreur de connexion au serveur");

$json = array();
mysqli_query($link,"SET NAMES 'utf8'");
$requete = "SELECT * FROM ttt_clients";
$result = mysqli_query($link, $requete);

while ($row = mysqli_fetch_array($result))
{
    $json[$row['id']][] = $row['nom'] . ' ' . $row['prenom'];
}

echo json_encode($json);
?>