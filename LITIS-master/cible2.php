<?php
session_start();
session_unset();

include('connect_bdd.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Vérifier si un mot a été saisi dans la barre de recherche
if (isset($_POST['mot'])) {
    $mot = $_POST['mot'];
        // 
        // Vérifier d'abord si le mot existe dans la table glossaire
        // 
        $statementMot = $db->prepare("SELECT * FROM glossaire WHERE Mot = :mot");
        $statementMot->bindValue(':mot', $mot, PDO::PARAM_STR);
        $statementMot->execute();
        $resultMot = $statementMot->fetch(PDO::FETCH_ASSOC);

        if ($resultMot) {
            // Le mot est dans la table glossaire
            $mot = $resultMot['Mot'];
            $definition = $resultMot['Definition'];
            $synonyme = $resultMot['Synonyme'];

            $_SESSION['mot'] = $mot;
            $_SESSION['def'] = $definition;
            $_SESSION['synonyme'] = $synonyme;


            // Récupérer les ressources où le titre ou les mots-clés contiennent le mot saisi par l'utilisateur
            $sqlRessources = "SELECT * FROM ressource WHERE ";
            $sqlRessources .= "Titre LIKE :mot OR ";
            $sqlRessources .= "Mot_cle LIKE :mot ";
            $statementRessources = $db->prepare($sqlRessources);
            $statementRessources->bindValue(':mot', "%$mot%", PDO::PARAM_STR);
            $statementRessources->execute();
            $ressources = $statementRessources->fetchAll(PDO::FETCH_ASSOC);


            // Afficher les ressources trouvées
            if ($ressources) {
                $ressource_tab = array();
                foreach ($ressources as $ressource) {
                    // echo "<li>" . $ressource['Titre'] . "</li>";
                    $titre = $ressource['Titre'];
                    $categorie = $ressource['Categorie'];
                    $img = $ressource['Image'];
                    $id = $ressource['Id_ressource'];
                    $ressource_tab[] = array('Titre' => $titre, 'Categorie' => $categorie, 'Image' =>$img, 'Id_ressource' => $id);
                }

                // il faudrait faire une condition pour vérifier s'il y a des valeurs dans le tableau ressource_tab et faire la session
                if(!empty($ressource_tab)) {
                    $_SESSION['ressource'] = $ressource_tab;
                }
                else {
                    echo "aucune ressource trouvée pour ce mot";
                }

            } else {
                echo "Aucune ressource trouvée pour le mot '$mot'";
                
            }
        } else {
            // 
            // Si le mot n'est pas dans la table glossaire, vérifier s'il est un synonyme
            // 
            $statementSynonyme = $db->prepare("SELECT * FROM glossaire WHERE Synonyme LIKE :motRecherche");
            $motRecherche = "%$mot%";
            $statementSynonyme->bindValue(':motRecherche', $motRecherche, PDO::PARAM_STR);
            $statementSynonyme->execute();
            $resultSynonymes = $statementSynonyme->fetchAll(PDO::FETCH_ASSOC);

            if ($resultSynonymes) {
                // Récupérer tous les mots associés au synonyme
                // $motsAssocies utiliser pour la requête
                $motsAssocies = array();
                foreach ($resultSynonymes as $resultSynonyme) {
                    $mot = $resultSynonyme['Mot'];
                    $definition = $resultSynonyme['Definition'];
                    $synonymes = $resultSynonyme['Synonyme'];
                    $motsAssocies[$mot] = array('definition' => $definition, 'synonymes' => $synonymes);
                }


                // boucle pour récup le premier mot
                foreach ($motsAssocies as $mot => $details) {
                    $premierMot = $mot;
                    $detailsPremierMot = $details;
                    $_SESSION['mot'] = $mot;
                    break; // Quitter la boucle après le premier élément
                }

                // boucle pour récup la définition et les synonymes dans des variables pour les mettres dans des sessions
                foreach ($detailsPremierMot as $key => $value) {
                    $definition = $detailsPremierMot['definition'];
                    $synonyme = $detailsPremierMot['synonymes'];
                }


                // Stocker $motsAssocies dans une variable de session avec le mot et ses synonymes
                $_SESSION['motsAssocies'] = $motsAssocies;
                $_SESSION['definition'] = $definition;
                $_SESSION['synonyme'] = $synonyme;


                // 
                // Préparer la requête SQL pour les ressources
                // 
                $sqlRessources = "SELECT * FROM ressource WHERE Titre LIKE :mot OR Mot_cle LIKE :mot ";

                // Ajouter les conditions pour chaque synonyme
                $i = 0;
                foreach ($motsAssocies as $motAssocie) {
                    $sqlRessources .= "OR Titre LIKE :motAssocie$i OR Mot_cle LIKE :motAssocie$i ";
                    $i++;
                }

                $statementRessources = $db->prepare($sqlRessources);
                $statementRessources->bindValue(':mot', "%$mot%", PDO::PARAM_STR);

                // Lier chaque synonyme à la requête
                $i = 0;
                foreach ($motsAssocies as $motAssocie) {
                    $statementRessources->bindValue(":motAssocie$i", "%" . $motAssocie['synonymes'] . "%", PDO::PARAM_STR);
                    $i++;
                }

                $statementRessources->execute();
                $ressource_tab = $statementRessources->fetchAll(PDO::FETCH_ASSOC);
                
                // echo "<pre>";
                // var_dump($ressource_tab);
                // echo "</pre>";


                if(!empty($ressource_tab)) {
                    $_SESSION['ressource'] = $ressource_tab;
                }
                else {
                    echo "aucune ressource trouvée pour ce mot";
                }
            } else {
                // Si le mot n'est ni un synonyme ni un mot de la table glossaire
                header("Location: 404.php");
            }
        }

        // Redirection vers la page search.html
        header("Location: search.php");
        exit;
        
    // } catch (PDOException $e) {
    //     echo "Erreur de connexion à la base de données : " . $e->getMessage();
    // }
}
?>
