<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fonction de nettoyage des entrées
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Initialiser les variables et les erreurs
    $prenom = $email = $objet = $message = "";
    $prenomErr = $emailErr = $objetErr = $messageErr = "";

    $isValid = true;

    // Validation du prénom
    if (empty($_POST["prenom"])) {
        $prenomErr = "Le prénom est requis";
        $isValid = false;
    } else {
        $prenom = test_input($_POST["prenom"]);
        if (!preg_match("/^[A-Za-zÀ-ÿ\s\-]+$/", $prenom)) {
            $prenomErr = "Seules les lettres, les espaces et les traits d'union sont autorisés";
            $isValid = false;
        }
    }

    // Validation de l'email
    if (empty($_POST["email"])) {
        $emailErr = "L'adresse mail est requise";
        $isValid = false;
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Format d'adresse mail invalide";
            $isValid = false;
        }
    }

    // Validation de l'objet
    if (empty($_POST["objet"])) {
        $objetErr = "L'objet est requis";
        $isValid = false;
    } else {
        $objet = test_input($_POST["objet"]);
        if (!preg_match("/^[A-Za-z0-9À-ÿ\s\-\,.\"!?\(\)]+$/", $objet)) {
            $objetErr = "Caractères non autorisés dans l'objet";
            $isValid = false;
        }
    }

    // Validation du message
    if (empty($_POST["message"])) {
        $messageErr = "Le message est requis";
        $isValid = false;
    } else {
        $message = test_input($_POST["message"]);
    }

    // Si toutes les validations sont passées
    if ($isValid) {
        // Envoyer le mail
        // Remplacez par votre adresse e-mail contact@existence-numerique.fr
        $to = "contact@existence-numerique.fr"; 
        $subject = $objet;
        $body = "Prénom: $prenom\nEmail: $email\n\nMessage:\n$message";
        $headers = "From: $email";

        if (mail($to, $subject, $body, $headers)) {
            echo "Le message a été envoyé avec succès.";
        } else {
            echo "Échec de l'envoi du message.";
        }
    } else {
        echo "Des erreurs ont été trouvées dans le formulaire. Veuillez les corriger et réessayer.";
        // Afficher les erreurs pour chaque champ
        echo $prenomErr ? "<br>$prenomErr" : "";
        echo $emailErr ? "<br>$emailErr" : "";
        echo $objetErr ? "<br>$objetErr" : "";
        echo $messageErr ? "<br>$messageErr" : "";
    }
} else {
    echo "Méthode de requête invalide.";
}
?>
