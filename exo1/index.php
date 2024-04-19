<?php
$servername = "localhost";
$username = "root";
$password = "root"; 
$dbname = "injectionsql";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
  die("Échec de la connexion : " . $conn->connect_error);
}

// Récupération des données utilisateur
$nom_utilisateur = $_POST['nom_utilisateur'];
$mot_de_passe = $_POST['mot_de_passe'];

// Requête SQL vulnérable à l'injection
//$query = "SELECT * FROM utilisateurs WHERE nom_utilisateur = '$nom_utilisateur' AND mot_de_passe = '$mot_de_passe'";
//echo "La requête SQL est : " . $query; // voir la requête SQL

// REQUETES PREPAREES
// Selectionne les utilisateurs qui ont le nom d'utilisateur et le mot de passe donnés par l'utilisateur.
$result = $conn->prepare("SELECT * FROM utilisateurs WHERE nom_utilisateur = ? AND mot_de_passe = ?");
// Liaison des paramètres: s = string. 
// Bind_param lie nom_utilisateur et mot_de_passe aux 2 "?" de la requête préparée.
$result->bind_param("ss", $nom_utilisateur, $mot_de_passe);

// // Exécution de la requête
// $result = $conn->query($query);

// EXECUTION DE LA REQUETE PREPAREE
$result->execute();
$result = $result->get_result();

// Vérification des résultats
if ($result->num_rows > 0) {
  echo "Utilisateur authentifié";
} else {
  echo "Nom d'utilisateur ou mot de passe incorrect";
}

// Fermeture de la connexion
$conn->close();
?>
