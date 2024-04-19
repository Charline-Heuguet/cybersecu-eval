<?php
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    echo "Résultats de la recherche pour : " . $searchTerm;
} else {
    echo "Utiliser l'url pour afficher quelque chose";
}
?>

<!-- COMBLAGE DE LA VULNERABILITE -->
<?php
if (isset($_GET['search'])) {
    $searchTerm = htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8');
    echo "Résultats de la recherche pour : " . $searchTerm;
} else {
    echo "Utiliser l'url pour afficher quelque chose";
}
?>


<!-- SOLUTION: 

<!-- COMBLER LA VULNERABILITE avec htmlspecialchars: 
htmlspecialchars() est une fonction qui convertit les caractères spéciaux en entités HTML.
1er argument : la chaine de caractères à convertir
2ème argument : quoi faire des guillemets
3ème argument : l'encodage


Aller dans le README pour l'explication de la solution

   
 -->