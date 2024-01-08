<?php
// a) Créer une variable $tab de type tableau
$tab = array();

// b) Ajouter un indice 'contenu' pour ce tableau. La valeur doit être une chaîne de caractères vide
$tab['contenu'] = '';


// c) Appliquer la condition pour vérifier si "empty($_POST['choix'])" n'est pas vide
if (!empty($_POST['choix'])){
    // var_dump($_POST);

    // d) Récupérer le contenu du fichier.json en mettant dans une variable '$fichier'
    $fichier = file_get_contents('fichier.json');
    // var_dump($fichier);

    // Convertir le fichier JSON en tableau PHP en stockant dans la variable '$json'
    $json = json_decode($fichier, true);
    // var_dump($json);

    // Récupérer le nom sélectionné
    $choix = $_POST['choix'];

    // e) Utiliser 'foreach' de PHP pour parcourir le tableau $json
    // Rechercher la personne dans le tableau JSON
    foreach ($json as $ligne) {
        // var_dump($ligne);
        if ($ligne['nom'] === $choix) {

            // Dans le tableau associatif "$tab['contenu']", créer un tableau HTML
            $tab['contenu'] .= '<table style="border-collapse: collapse; width: 100%; margin-top: 35px;" border="1">';
            $tab['contenu'] .= '<tr>';

            // Dans chaque 'td' de ce tableau, ajouter les contenus de $json
            $tab['contenu'] .= '<td style="padding: 10px;">' . $ligne['nom'] . '</td>';
            // Ajouter d'autres colonnes en suivant le même modèle pour les autres données
            $tab['contenu'] .= '<td style="padding: 10px;">' . $ligne['prenom'] . '</td>';

            $tab['contenu'] .= '<td style="padding: 10px;">' . $ligne['sexe'] . '</td>';

            $tab['contenu'] .= '<td style="padding: 10px;">' . $ligne['service'] . '</td>';

            $tab['contenu'] .= '<td style="padding: 10px;">' . $ligne['dateEmbauche'] . '</td>';

            $tab['contenu'] .= '<td style="padding: 10px;">' . $ligne['salaire'] . '</td>';

            $tab['contenu'] .= '<td style="padding: 10px;">' . $ligne['idSecteur'] . '</td>';

            $tab['contenu'] .= '<td style="padding: 10px;">' . $ligne['idEmploye'] . '</td>';

            $tab['contenu'] .= '</tr>';
            $tab['contenu'] .= '</table>';
        }
    }
}

// f) Convertir le tableau '$tab' en JSON
echo json_encode($tab);
?>    