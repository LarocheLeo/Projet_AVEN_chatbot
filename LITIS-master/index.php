<?php
session_start();

include('connect_bdd.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$sql = "
    (SELECT Id_ressource, Titre, Categorie, Sous_Categorie, Mot_cle, Image
     FROM ressource
     WHERE Categorie = 'Bases d\'internet' AND Image IS NOT NULL AND Image != ''
     ORDER BY Id_ressource DESC
     LIMIT 1)
    UNION ALL
    (SELECT Id_ressource, Titre, Categorie, Sous_Categorie, Mot_cle, Image
     FROM ressource
     WHERE Categorie = 'Santé' AND Image IS NOT NULL AND Image != ''
     ORDER BY Id_ressource DESC
     LIMIT 1)
    UNION ALL
    (SELECT Id_ressource, Titre, Categorie, Sous_Categorie, Mot_cle, Image
     FROM ressource
     WHERE Categorie = 'Sécurité' AND Image IS NOT NULL AND Image != ''
     ORDER BY Id_ressource DESC
     LIMIT 1)
    UNION ALL
    (SELECT Id_ressource, Titre, Categorie, Sous_Categorie, Mot_cle, Image
     FROM ressource
     WHERE Categorie = 'Administratif' AND Image IS NOT NULL AND Image != ''
     ORDER BY Id_ressource DESC
     LIMIT 1)
    UNION ALL
    (SELECT Id_ressource, Titre, Categorie, Sous_Categorie, Mot_cle, Image
     FROM ressource
     WHERE Categorie = 'Education' AND Image IS NOT NULL AND Image != ''
     ORDER BY Id_ressource DESC
     LIMIT 1)
    UNION ALL
    (SELECT Id_ressource, Titre, Categorie, Sous_Categorie, Mot_cle, Image
     FROM ressource
     WHERE Categorie = 'Communication' AND Image IS NOT NULL AND Image != ''
     ORDER BY Id_ressource DESC
     LIMIT 1)
    ";

$statement = $db->prepare($sql);
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);

if (!$results) {
    echo "Aucun résultat trouvé";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/general.css">
    <link rel="stylesheet" href="./assets/css/style_chat.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script src="https://kit.fontawesome.com/96e027db6d.js" crossorigin="anonymous"></script>
    <!-- langue -->
    <script src="https://unpkg.com/i18next@21.6.13/i18next.min.js"></script>
    <script src="https://unpkg.com/i18next-http-backend@1.4.0/i18nextHttpBackend.min.js"></script>
    <script src="https://unpkg.com/i18next-browser-languagedetector@6.1.3/i18nextBrowserLanguageDetector.min.js"></script>
    

    <!--  -->
    <title>Existence Numérique | Accueil</title>
</head>
<body id="body">
    <header id="desktop-header" class="desktop d-flex justify-content-evenly align-items-center bg-white fixed-top exclude-accessibility">
        <div class="logo d-flex justify-content-center align-items-center">
            <a href="index.php">
                <img id="logo_prin" class="img-fluid" src="./assets/images/logo/Logo_principal.png" alt="Logo principal du site existence numérique">
                <img id="logo_BW" class="img-fluid" src="./assets/images/logo/logo.png" alt="Logo principal du site existence numérique">
            </a>
        </div>
        <nav class="navbar navbar-expand-lg">
            <ul class="d-flex justify-content-center align-items-center">
                <li><a class="active fs-3 menu__link fw-semibold" href="index.php" data-i18n="home">Accueil</a></li>
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
                <p class="exclude-accessibility">Menu</p>
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
                    <p class="exclude-accessibility">Menu</p>
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

    <section class="presentation">
        <div class="pre-container d-flex align-items-center">
            <div class="images col-xl-6 col-lg-12">
                <img class="img-fluid" src="./assets/images/illustration/galere.svg" alt="Illustration Présentation">
            </div>
            <div class="content col-xl-6 col-lg-12">
                <p class="fs-3 fs-sm-4" data-i18n="presentation">
                    Découvrez une multitude de <span class="fw-semibold color_v">ressources</span> soigneusement élaborées pour vous accompagner dans le développement de vos <span class="color_v fw-semibold">compétences numériques.</span> <br><br>Elles vous permettront ainsi de naviguer avec aisance et assurance à travers le paysage technologique en constante évolution, tout en vous donnant les outils nécessaires pour relever les <span class="color_v fw-semibold">défis numériques</span> avec confiance et succès.
                </p>
                <div class="btn-container d-flex justify-content-start">
                    <a href="ressource.html"><button class="btn fw-bold btn-resource" data-i18n="resources_btn">Accéder aux ressources</button></a>
                    <a href="about.html"><button class="btn fw-bold btn-about" data-i18n="about_btn">A propos</button></a>
                </div>
            </div>
        </div>
    </section>
    <div class="slogan d-flex justify-content-center align-items-center">
        <div class="circle d-flex justify-content-center align-items-center exclude-accessibility BonW">
            <img src="./assets/images/illustration/quotes.svg" alt="Illustration Guillemets">
        </div>
        <div class="container rounded-4 d-flex justify-content-center align-items-center exclude-accessibility">
            <img class="slogan_img slogan_gauche" src="./assets/images/illustration/slogan.svg" alt="Illustration Slogan">
            <h1 class="color_v exclude-accessibility text" data-i18n="slogan">
                La référence digitale pour naviguer vers l'inclusion en ligne
            </h1>
        </div>
    </div>
    <section class="prb">
        <h2 class="fs-1 fw-bold" data-i18n="mission">
            Quelle est notre <span class="color_v">mission</span> ?
        </h2>
        <div class="container prb-container d-flex flex-column align-items-center">
            <img class="col-xl-12 img-fluid" src="./assets/images/illustration/mission3.png" alt="Illustration des missions, une personne vise une cible avec une fléchette">
            <p class="col-xl-12 fs-3 fw-medium" data-i18n="mission_description">
                Nous nous engageons à rendre le monde numérique accessible à tous.
                <br>
                <br>
                Découvrez une multitude de ressources et de vidéos tutoriels pour renforcer vos compétences numériques. De la théorie à la pratique, notre plateforme offre des guides détaillés et des mises en situation concrètes.
                <br>
                <br>
                <span class="color_v fw-bold">Notre mission</span> : accompagner chacun vers une maîtrise confiante du digital, pour un avenir prospère et inclusif.
            </p>
        </div>
    </section>
    <section class="tutoriels">
        <h2 class="fs-1 fw-bold" data-i18n="tuto_title">
            Les <span class="color_v">tutoriels</span> à la une
        </h2>
        <div class="rdv">
            <div class="videos">
                <?php
                    if ($results) {
                        foreach ($results as $row) {
                            $minia = $row['Image'];
                            $id = $row['Id_ressource'];
                            $title = $row['Titre'];
                            echo "
                            <div class='tuto image_wrapper'>
                                <a href='ressource_type.php?Id_ressource=$id'>
                                    <img src='$minia' alt='$title'>
                                    <div class='overlay_4'>
                                        <div class='text_overlay fw-semibold'>Consulter</div>
                                    </div>
                                </a>
                            </div>";
                        }
                    } else {
                        echo "0 résultats";
                    }
                ?>
            </div>
        </div>
    </section>
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
    <script src="./assets/js/translate.js"></script>
    <script src="./assets/js/script_chatbot.js"></script>
</body>
</html>
