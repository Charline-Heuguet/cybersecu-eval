### EXERCICE 1

## 1 - a)

    L'injection SQL utilisée ici est ' OR '1'='1' -- 
    Ca fait que la condition du WHERE est toujours vraie car '1'='1' est une affirmation toujours vraie.
    Donc, la requête SQL :"SELECT * FROM utilisateurs WHERE nom_utilisateur = '' OR '1'='1' -- ' AND mot_de_passe = '' OR '1'='1' -- ' "
    Littéralement, ça signifie "Sélectionne tout de la table utilisateurs où le nom d'utilisateur est vide ou 1=1 et le mot de passe est vide ou 1=1". Il y a donc toujours du vrai.

    Le ' -- ' à la fin m'a bien mise dans la sauce car je l'avais complètement oublié... C'est un commentaire SQL qui fait ignorer le reste de la requête par la bdd (pour les potentielles erreurs de syntaxe)


## 2 - b)

Comment se protéger contre l'injection SQL:
    On fait une requête préparée avec des paramètres pour éviter l'injection SQL.
    
    SELECT * FROM utilisateurs WHERE nom_utilisateur = ? AND mot_de_passe = ?
    Littéralement: Selectionne les utilisateurs qui ont le nom d'utilisateur et le mot de passe donnés par l'utilisateur.
    Liaison des paramètres: on dit que les paramètres sont des chaines de caractères et on les lie à la requête préparée.
    Bind_param lie nom_utilisateur et mot_de_passe aux 2 "?" de la requête préparée.
    MySQL remplace les ? par les valeurs de $nom_utilisateur et $mot_de_passe, mais les traite de manière à ce qu'elles ne puissent pas modifier le reste de la requête SQL.



### EXERCICE 2

## 1 Écrre une URL qui déclenche une alerte JavaScript. (Notez la en url) 

    http://localhost:8888/eval-cybersecu/exo2/index.php?search=<script>alert('Hey')</script>

    pourquoi ? 
    http://localhost:8888/eval-cybersecu/exo2/index.php = adresse de mon fichier sur mon serveur local
    ?search= = paramètre de l'url
    <script>alert('XSS')</script> = code javascript qui s'exécute dans la page
    $_GET['search'] = récupère la valeur du paramètre search dans l'url

## 2- Modifier le code pour empêcher cette vulnérabilité.

pour empecher cette faille XSS, on doit echapper les entrées qu'on reçoit via la requete GET avec htmlspecialchars.
Cette fct° convertit les caractères speciaux en entités html
On peut rajouter l'argument "ENT_QUOTES" qui va convertir les guillemets doubles et les guillemets simples.

Source: https://tecfa.unige.ch/guides/php/php5_fr/function.htmlspecialchars.html

Donc le code deviendrait: 

<?php
if (isset($_GET['search'])) {
    $searchTerm = htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8');
    echo "Résultats de la recherche pour : " . $searchTerm;
} else {
    echo "Utiliser l'url pour afficher quelque chose";
}
?>



