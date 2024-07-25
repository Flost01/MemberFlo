<?php

session_start();
require 'config.php';

 if(isset($_GET['id_tache'])){
    $ide = $_GET['id_tache'];
    $date =  date('Y-m-d H:i:s');
    $user_id =$_SESSION['user_id'];
    $idp = $_GET['id_projet'];
    $stmt = $pdo->query("UPDATE `tache` SET `statut`='En cours' WHERE `id_tache`=$ide");

    $tache=$pdo->query("SELECT * FROM `tache` JOIN `users` ON tache.id=users.id WHERE `id_tache`=$ide AND tache.id=$user_id");
    $taches=$tache->fetch();

    if($taches['id']==$user_id){
      $sts=$taches['nom_tache'];
      $st=$taches['statut'];
      $use=$taches['name'];
      $text ="Le status de la tache $sts a ete modifier a $st par $use";
    }else{
      $tache=$pdo->query("SELECT * FROM `tache` WHERE `id_tache`=$ide");
      $taches=$tache->fetch();
      $sts=$taches['nom_tache'];
      $st=$taches['statut'];
      $text ="Le status de la tache $sts a ete modifier a $st par le chef";
    }
    
    $req= $pdo->prepare("INSERT INTO `history`(`description`, `create_at`) VALUES (?,?)");
    $req->execute(array($text,$date));
    header("Location: tache.php?id_projet= $idp");
 }