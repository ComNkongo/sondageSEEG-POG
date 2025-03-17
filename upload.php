<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Traitement des données de texte
    $nom = isset($_POST['nom']) ? $_POST['nom'] : 'Non spécifié';
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $temps_utilisation = $_POST['temps_utilisation'];
    $compteur = isset($_POST['compteur']) ? $_POST['compteur'] : 'Non spécifié';
    $arrondissement = $_POST['arrondissement'];
    $quartier = $_POST['quartier'];
    $date = $_POST['date'];
    $qualite_electricite = $_POST['qualite_electricite'];
    $coupures = $_POST['coupures'];
    $qualite_eau = $_POST['qualite_eau'];
    $appareils_endommages = isset($_POST['appareils_endommages']) ? $_POST['appareils_endommages'] : [];
    $appareil_autre = isset($_POST['appareil_autre']) ? $_POST['appareil_autre'] : 'Non spécifié';
    $quantite_appareils_endommages = $_POST['quantite_appareils_endommages'];
    $commentaires = $_POST['commentaires'];

    // Gérer les fichiers téléchargés
    if (isset($_FILES['images_appareil'])) {
        $image_files = $_FILES['images_appareil'];
        $upload_dir = 'uploads/images/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        // Traitement de chaque image téléchargée
        foreach ($image_files['name'] as $key => $filename) {
            $file_tmp_path = $image_files['tmp_name'][$key];
            $file_destination = $upload_dir . basename($filename);
            move_uploaded_file($file_tmp_path, $file_destination);
        }
    }

    if (isset($_FILES['documents'])) {
        $document_files = $_FILES['documents'];
        $upload_dir = 'uploads/documents/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        // Traitement de chaque document téléchargé
        foreach ($document_files['name'] as $key => $filename) {
            $file_tmp_path = $document_files['tmp_name'][$key];
            $file_destination = $upload_dir . basename($filename);
            move_uploaded_file($file_tmp_path, $file_destination);
        }
    }

    // Crée le contenu de l'email
    $subject = "Sondage SEEG - Nouveau formulaire soumis";
    $message = "
    <html>
    <head>
    <title>Sondage SEEG - Nouveau formulaire soumis</title>
    </head>
    <body>
    <h2>Détails du formulaire :</h2>
    <p><strong>Nom :</strong> $nom</p>
    <p><strong>Email :</strong> $email</p>
    <p><strong>Téléphone :</strong> $telephone</p>
    <p><strong>Temps d'utilisation :</strong> $temps_utilisation</p>
    <p><strong>Numéro du compteur :</strong> $compteur</p>
    <p><strong>Arrondissement :</strong> $arrondissement</p>
    <p><strong>Quartier :</strong> $quartier</p>
    <p><strong>Date du problème :</strong> $date</p>
    <p><strong>Qualité de l'électricité :</strong> $qualite_electricite</p>
    <p><strong>Coupures fréquentes :</strong> $coupures</p>
    <p><strong>Qualité de l'eau :</strong> $qualite_eau</p>
    <p><strong>Appareils endommagés :</strong> " . implode(", ", $appareils_endommages) . " $appareil_autre</p>
    <p><strong>Quantité d'appareils endommagés :</strong> $quantite_appareils_endommages</p>
    <p><strong>Commentaires :</strong> $commentaires</p>
    </body>
    </html>";

    // En-têtes de l'email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";

    // Adresse email de destination (changer à l'email voulu)
    $to = "comnkongo@gmail.com";

    // Envoie l'email
    if (mail($to, $subject, $message, $headers)) {
        echo "<h3>Merci pour votre participation !</h3>";
        echo "<p>Votre formulaire a été envoyé avec succès.</p>";
    } else {
        echo "<h3>Erreur dans l'envoi de votre formulaire.</h3>";
    }
}
?>
