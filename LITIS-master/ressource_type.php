<?php
try {
    include('connect_bdd.php');

    $id_ressource = isset($_GET['Id_ressource']) ? $_GET['Id_ressource'] : null;
    
    $sql = "SELECT ressource.*, ressource_type.*, etape.*, ressource.categorie AS categorie
            FROM ressource 
            JOIN ressource_type ON ressource.Id_ressource = ressource_type.ressource_id 
            JOIN etape ON ressource_type.id_ressource_type = etape.ressource_type_id 
            WHERE ressource.Id_ressource = :id_ressource 
            ORDER BY etape.numero_etape ASC";
    $query = $db->prepare($sql);
    $query->execute(['id_ressource' => $id_ressource]);

    if ($query->rowCount() > 0) {
        $ressources = $query->fetchAll(PDO::FETCH_ASSOC);
        $categorie = $ressources[0]['categorie'];
        $categorie_formate = str_replace(' ', '_', $categorie);
        $categorie_formate2 = str_replace("'", '_', $categorie_formate);
        
        // Formater vidéo Youtube
        $video_url = $ressources[0]['video'];
        if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/|.*?[&?]v=))([^"&?\/ ]{11})/', $video_url, $matches)) {
            $embed_url = 'https://www.youtube.com/embed/' . $matches[1];
        } else {
            $embed_url = null;
        }

        $download_link = $ressources[0]['lien_pdf'];
        
    } else {
        $ressources = [];
        $categorie = 'default';
        $embed_url = null;
        $download_link = '#';
    }
} catch (PDOException $e) {
    echo "Erreur SQL : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/general.css">
    <link rel="stylesheet" href="./assets/css/ressource_type.css">
    <link rel="stylesheet" href="./assets/css/style_chat.css">
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script src="https://kit.fontawesome.com/96e027db6d.js" crossorigin="anonymous"></script>
    <!-- langue -->
    <script src="https://unpkg.com/i18next@21.6.13/i18next.min.js"></script>
    <script src="https://unpkg.com/i18next-http-backend@1.4.0/i18nextHttpBackend.min.js"></script>
    <script src="https://unpkg.com/i18next-browser-languagedetector@6.1.3/i18nextBrowserLanguageDetector.min.js"></script>
    <!--  -->
    <title><?php echo htmlspecialchars($ressources[0]["Titre"]);?> | Tutoriel et étapes | Existence Numérique</title>
</head>
<body class="<?php echo htmlspecialchars($categorie_formate2); ?>">

<header id="desktop-header" class="desktop d-flex justify-content-evenly align-items-center bg-white fixed-top exclude-accessibility">
        <div class="logo d-flex justify-content-center align-items-center">
            <a href="index.php">
                <img id="logo_prin" class="img-fluid" src="./assets/images/logo/Logo_principal.png" alt="Logo principal du site existence numérique">
                <img id="logo_BW" class="img-fluid" src="./assets/images/logo/logo.png" alt="Logo principal du site existence numérique">
            </a>
        </div>
        <nav class="navbar navbar-expand-lg">
            <ul class="d-flex justify-content-center align-items-center">
                <li><a class="fs-3 menu__link fw-semibold" href="index.php" data-i18n="home">Accueil</a></li>
                <li><a class="fs-3 menu__link fw-semibold" href="about.html" data-i18n="about">A propos</a></li>
                <li><a class="fs-3 menu__link fw-semibold" href="ressource.html" data-i18n="resources">Ressources</a></li>
            </ul>
        </nav>
        <form class="search exclude-accessibility" action="cible2.php" method="post">
            <label for="search-input" class="visually-hidden">Rechercher</label>
            <input id="search-input" class="exclude-accessibility" name="mot" type="text" placeholder="Rechercher..." autocomplete="off" data-i18n="search_placeholder">
            <a href="#" aria-label="Rechercher" class="exclude-accessibility">
                <lord-icon class="icon"
                    src="https://cdn.lordicon.com/unukghxb.json"
                    trigger="loop"
                    delay="2000"
                    style="width:30px;height:30px">
                </lord-icon>
            </a>
        </form>
        <div class="burger-active exclude-accessibility" id="burger-menu">
            <button class="exclude-accessibility">
                <p class="exclude-accessibility"  data-i18n="menu">Menu</p>
                <span class="exclude-accessibility"></span>
            </button>
        </div>
        <div id="menu" class="exclude-accessibility">
            <ul>
                <li><a class="fs-3 fw-bold menu__link fw-semibold" href="index.php" data-i18n="home">Accueil</a></li>
                <li><a class="fs-3 fw-bold menu__link fw-semibold" href="about.html" data-i18n="about">A propos</a></li>
                <li><a class="fs-3 fw-bold menu__link fw-semibold" href="ressource.html" data-i18n="resources">Ressources</a></li>
            </ul>
        </div>
    </header>
    <header id="phone-header" class="phone d-flex flex-column align-items-center bg-white fixed-top exclude-accessibility">
        <div class="header-container d-flex justify-content-around align-items-center">
            <div class="logo">
                <a href="index.php"><img class="img-fluid" src="./assets/images/logo/Logo_principal.png" alt="Logo principal du site existence numérique"></a>
            </div>
            <div class="burger-active exclude-accessibility" id="burger-menu-phone">
                <button class="exclude-accessibility">
                    <p class="exclude-accessibility"  data-i18n="menu">Menu</p>
                    <span class="exclude-accessibility"></span>
                </button>
            </div>
            <div id="menu-phone" class="exclude-accessibility">
                <ul>
                    <li><a class="fs-3 fw-bold menu__link fw-semibold" href="index.php" data-i18n="home">Accueil</a></li>
                    <li><a class="fs-3 fw-bold menu__link fw-semibold" href="about.html" data-i18n="about">A propos</a></li>
                    <li><a class="fs-3 fw-bold menu__link fw-semibold" href="ressource.html" data-i18n="resources">Ressources</a></li>
                </ul>
            </div>
        </div>
        <div class="phone_bot d-flex justify-content-between exclude-accessibility">
            <form class="search exclude-accessibility" action="cible2.php" method="post">
                <label for="search-input" class="visually-hidden">Rechercher</label>
                <input type="text" id="search-input" placeholder="Rechercher...">
                <a href="#" aria-labelledby="search-input">
                    <lord-icon class="icon phone_icon"
                        src="https://cdn.lordicon.com/unukghxb.json"
                        trigger="loop"
                        delay="2000"
                        style="width:30px;height:30px">
                    </lord-icon>
                    <span class="visually-hidden">Rechercher</span>
                </a>
            </form>
        </div>
    </header>

    <div class="language-selector exclude-accessibility">
        <button class="dropbtn exclude-accessibility" id="selected-lang">FR</button>
        <div class="dropdown-content" id="language-menu">
            <a href="#" data-lang="fr">FR : Français</a>
            <a href="#" data-lang="en">EN : English</a>
            <a href="#" data-lang="es">ES : Español</a>
            <a href="#" data-lang="de">DE : Deutsch</a>
        </div>
    </div>

    <div id="access" class="access d-flex justify-content-center align-items-center exclude-accessibility">
        <i class="fa-solid fa-eye-low-vision exclude-accessibility"></i>
        <div id="access-menu" class="access-menu">
            <label class="switch mg">
                <span class="fw-bold color_v exclude-accessibility" data-i18n="access_lang">Changer l'écriture</span>
                <input type="checkbox" class="font-toggle exclude-accessibility">
                <span class="slider round exclude-accessibility"></span>
            </label>
            <label class="switch">
                <span class="fw-bold color_v exclude-accessibility" data-i18n="access_contrast">Changer le contraste</span>
                <input type="checkbox" class="bg-toggle exclude-accessibility">
                <span class="slider round exclude-accessibility"></span>
            </label>
        </div>
    </div>

     <!-- chatbot -->
     <div id="chatbot" class="chatbot d-flex justify-content-center align-items-center">
        <img id='avatar' src="./assets/images/avatar/normal.svg" alt="avatar du chatbot">
        <i id="croix" class="fa-solid fa-xmark" style="display:none"></i>
         <div id="container_chat">
            <div class="init" data-i18n="aven_chatbot"><p>Bonjour, je suis l'assistant virtuel de l'Existence Numerique.</p>
                Je peux répondre à vos questions relatives à la recherche des ressources qui ont été mises,
                sur la plateforme pour vous aider dans vos demarches en ligne. Dans les langues proposer par la plateforme.</div>
            <div id="repo"></div>
            <div class="class_input">
                <input type="text" id="question_input" placeholder="Posez votre question">
                <button id="poser_question_btn" onclick="question()"><img class="icon_send" src="assets/images/icone_chat/icone_envoye4.png" alt="" srcset=""></button>
            </div>
        </div>
   </div>


    <!-- Titre -->
    <div class="title">
        <h1><?php echo htmlspecialchars($ressources[0]["titre_video"]); ?></h1>
        <div class="underline title_underline"></div>
    </div>

    <!-- Vidéo ou Exercice -->
    <div class="tuto image_wrapper">
        <?php
        if (!empty($ressources[0]['video'])) {
            $youtube_url = htmlspecialchars($ressources[0]['video']);
            if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/|.*?[&?]v=))([^"&?\/ ]{11})/', $youtube_url, $matches)) {
                $embed_url = 'https://www.youtube.com/embed/' . $matches[1];
                ?>
                <div class="responsive-iframe-container">
                    <iframe src="<?php echo $embed_url; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <?php
            } else {
                echo "<div class='video-content'><p>Vidéo YouTube non valide.</p></div>";
            }
        }

        if (!empty($ressources[0]['exercice'])) {
            $exercice_page = htmlspecialchars($ressources[0]['exercice']);
            if (file_exists($exercice_page)) {
                ?>
                <div class="exercice-content">
                    <?php include($exercice_page); ?>
                </div>
                <?php
            } else {
                echo "<div class='exercice-content'><p>Page d'exercice non disponible.</p></div>";
            }
        }
        ?>
    </div>



    <!-- separator -->
    <div class="bar"></div>

    <!-- Étapes -->
    <div class="etape">
        <?php foreach ($ressources as $ressource): ?>
            <h2><?php echo htmlspecialchars($ressource["titre_etape"]); ?> :</h2> 
            <p><?php echo htmlspecialchars($ressource["description_etape"]); ?></p><br/><br/>
        <?php endforeach; ?>
    </div>

    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <a href="<?php echo htmlspecialchars($download_link); ?>" download><button class="btn fw-bold btn-resource" data-i18n="download">Télécharger</button></a>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer>
        <div class="d-flex flex-column align-items-center">
            <div class="link-container">
                <ul class="d-flex">
                    <li><a class="fs-4 menu__link fw-medium" href="index.php" data-i18n="home">Accueil</a></li>
                    <div class="separator"></div>
                    <li><a class="fs-4 menu__link fw-medium" href="about.html" data-i18n="about">A propos</a></li>
                    <div class="separator"></div>
                    <li><a class="fs-4 menu__link fw-medium" href="ressource.html" data-i18n="resources">Ressources</a></li>
                    <div class="separator"></div>
                    <li><a class="fs-4 menu__link fw-medium" href="politique.html" data-i18n="privacy_policy">Politique de confidentialité</a></li>
                    <div class="separator"></div>
                    <li><a class="fs-4 menu__link fw-medium" href="legal.html" data-i18n="legal_notice">Mentions légales</a></li>
                </ul>
            </div>

            <div class="link-container_992 d-flex flex-column align-items-center none">
                <div class="top">
                    <ul class="d-flex">
                        <li><a class="fs-4 menu__link fw-medium" href="index.php" data-i18n="home">Accueil</a></li>
                        <div class="separator"></div>
                        <li><a class="fs-4 menu__link fw-medium" href="about.html" data-i18n="about">A propos</a></li>
                        <div class="separator"></div>
                        <li><a class="fs-4 menu__link fw-medium" href="ressource.html" data-i18n="resources">Ressources</a></li>
                    </ul>
                </div>
                <div class="bot">
                    <ul class="d-flex">
                        <li><a class="fs-4 menu__link fw-medium" href="politique.html" data-i18n="privacy_policy">Politique de confidentialité</a></li>
                        <div class="separator"></div>
                        <li><a class="fs-4 menu__link fw-medium" href="legal.html" data-i18n="legal_notice">Mentions légales</a></li>
                    </ul>
                </div>
            </div>

            <div class="logo-container">
                <img class="img-fluid" src="./assets/images/logo/litis_logo.webp" alt="Logo du laboratoire LITIS">
                <img class="img-fluid" src="./assets/images/logo/agefiph logo.svg" alt="Logo de l'AGEFIPH">
                <img class="img-fluid" src="./assets/images/logo/logo_iut.png" alt="Logo de l'Université de Rouen">
                <img class="img-fluid" src="./assets/images/logo/iut_rouen_logo_nobg.png" alt="Logo de l'IUT de Rouen">
            </div>
        </div>
    </footer>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/script.js"></script>
    <script src="./assets/js/script_chatbot.js"></script>
    <script src="./assets/js/translate.js"></script>
</body>
</html>