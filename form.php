<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AJAX avec Json</title>
    <style>
        form {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
        }

        select {
            width: 100%;
            height: 30px;
            border: 1px solid #333;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div style="width: 1000px; margin: 0 auto; padding: 20px;">
        <!-- form>label{Choisir une personne}+select#personne[onchange="monAjax()"]>option*7^^hr+div#resultat -->

        <?php
        // 3 récupérer le contenu du tableau json en utilisant la fonction (file_get_contents) et stocker dans une variable : '$fichier'
        $fichier = file_get_contents('fichier.json');
        // var_dump($fichier);

        // 4 convertir le tableau json en tableau php (json_decode) et stocker dans une variable : $tab
        $tab = json_decode($fichier, true);
        ?>

        <!-- 5- créer une liste déroulante du formulaire html et afficher le contenu de l'indice 'nom' tableau '$tab'dans la liste -->
        <form method="POST" action="ajax.php" id="form">
            <label for="personne">Choisir une personne</label>
            <select name="choix" id="personne">
                <option>...</option>
                <!-- afficher le contenu de l'indice 'nom' tableau '$tab'dans la liste -->
                <?php
                foreach ($tab as $personne) {
                    echo "<option>{$personne['nom']}</option>";
                }
                ?>
            </select>
        </form>
        <hr>
        <div id="resultat"></div>
        
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <!-- 6- Dans la partie js du fichier 'form.php': -->
    <script>
        $(document).ready(function() {

            // a) Utiliser la fonction on('change') de jQuery pour sélectionner un nom dans la liste déroulante
            $('#personne').on('change', function() {
                
                // b) Récupérer le contenu des attributs 'action' et 'method' du formulaire
                var action = $('#form').attr('action');
                var method = $('#form').attr('method');
                
                // c) Sérialiser le contenu des champs du formulaire
                var formData = $('#form').serialize();

                //  pour déboguer
                // console.log(formData);
                
                // d) Utiliser la méthode ajax de jQuery pour l'affichage de la réponse
                $.ajax({
                    url: action,  // Le fichier cible, celui qui fera le traitement
                    type: method, // La méthode utilisée (POST, GET, etc.)
                    data: formData, // Les paramètres à fournir (champs sérialisés du formulaire)
                    dataType: 'json', // Le format des données attendues
                    success: function(response) {
        
                        // La fonction qui doit s'exécuter lors de la réussite de la communication Ajax
                        $('#resultat').html(response.contenu);

                        // Afficher la réponse dans la console (à adapter selon le besoin)
                        // console.log(response); 
                    },
                    error: function(xhr, status, error) {
                        // La fonction qui doit s'exécuter en cas d'erreur Ajax
                        console.error(xhr.responseText); // Afficher le message d'erreur dans la console
                    }
                });
            });
        });
    </script>

</body>

</html>