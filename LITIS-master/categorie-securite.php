<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/general.css">
    <link rel="stylesheet" href="./assets/css/style_chat.css">
    <link rel="stylesheet" href="./assets/css/categorie.css">
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script src="https://kit.fontawesome.com/96e027db6d.js" crossorigin="anonymous"></script>
    <!-- langue -->
    <script src="https://unpkg.com/i18next@21.6.13/i18next.min.js"></script>
    <script src="https://unpkg.com/i18next-http-backend@1.4.0/i18nextHttpBackend.min.js"></script>
    <script src="https://unpkg.com/i18next-browser-languagedetector@6.1.3/i18nextBrowserLanguageDetector.min.js"></script>
    <!--  -->
    <title>Ressources pour la Sécurité | Sécurité | Existence Numérique</title>
</head>
<body>
    
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
                <li><a class="active fs-3 menu__link fw-semibold" href="ressource.html" data-i18n="resources">Ressources</a></li>
            </ul>
        </nav>

        <form class="search exclude-accessibility" action="cible2.php" method="post">
            <label for="search-input" class="visually-hidden">Rechercher</label>
            <input id="search-input" class="exclude-accessibility" name="mot" type="text" data-i18n="search_placeholder" placeholder="Rechercher..." autocomplete="off">
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
                <p class="exclude-accessibility" data-i18n="menu">Menu</p>
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

    <!-- phone header -->
    <header id="phone-header" class="phone d-flex flex-column align-items-center bg-white fixed-top exclude-accessibility">
        <div class="header-container d-flex justify-content-around align-items-center">
            <div class="logo">
                <a href="index.php"><img class="img-fluid" src="./assets/images/logo/Logo_principal.png" alt="Logo principal du site existence numérique"></a>
            </div>
            
            <div class="burger-active exclude-accessibility" id="burger-menu-phone">
                <button class="exclude-accessibility">
                    <p class="exclude-accessibility" data-i18n="menu">Menu</p>
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


    <!-- langue -->
    <div class="language-selector exclude-accessibility">
        <button class="dropbtn exclude-accessibility" id="selected-lang">FR</button>
        <div class="dropdown-content" id="language-menu">
            <a class="exclude-accessibility" href="#" data-lang="fr">FR : Français</a>
            <a class="exclude-accessibility" href="#" data-lang="en">EN : English</a>
            <a class="exclude-accessibility" href="#" data-lang="es">ES : Español</a>
            <a class="exclude-accessibility" href="#" data-lang="de">DE : Deutsch</a>
        </div>
    </div>

    <!-- accessibilité -->
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


    <!-- section intro -->
    <section class="intro">
        <div class="arc-cercle">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V7.23C0,65.52,268.63,112.77,600,112.77S1200,65.52,1200,7.23V0Z" class="shape-fill exclude-accessibility BonW"></path>
            </svg>
        </div>
        <div class="intro-container d-flex flex-column align-items-center">
            <h1 class="exclude-accessibility text" data-i18n="security_cat">Sécurité</h1>
            <div class="trait"></div>
            <p class="exclude-accessibility text" data-i18n="intro_sec">Découvrez nos ressources pour renforcer votre sécurité en ligne. Avec nous, vous serez protégés contre les menaces numériques.</p>
        </div>
    </section>

    <!-- section tutoriels -->
    <section class="tutoriels">
        <?php
        include 'connect_bdd.php';

        $Id_ressource = '';

        $sql = "SELECT * FROM ressource WHERE Categorie = 'Sécurité' AND Sous_Categorie = 'Se protéger en ligne' AND Image != ''";
        $result = $db->query($sql);

        if ($result->rowCount() > 0) {
            echo "<div class='rdv'>";
            echo "<h2>Se protéger en ligne</h2>";
            echo "<div class='trait-orange exclude-accessibility'></div>";
            echo "<div class='videos'>";
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='tuto image_wrapper'>";
                echo "<a href='ressource_type.php?Id_ressource=" . $row["Id_ressource"] . "'>";
                echo "<img src='" . $row["Image"] . "' alt='" . $row["Titre"] . "'>";
                echo "<div class='overlay_4'>";
                echo "<div class='text_overlay fw-semibold'>Consulter</div>";
                echo "</div>";
                echo "</a>";
                echo "</div>";
            }
            echo "</div>";
            echo "</div>";
        } else {
            echo "Aucun résultat trouvé.";
        }
        ?>

        <?php 
        $sql_mdp = "SELECT * FROM ressource WHERE Categorie = 'Sécurité' AND Sous_Categorie = 'Mot de passe' AND Image !=' '";
        $result_mdp = $db->query($sql_mdp);

        if ($result_mdp->rowCount() > 0) {
            echo "<div class='rdv'>";
            echo "<h2>Mot de passe</h2>";
            echo "<div class='trait-orange exclude-accessibility'></div>";
            echo "<div class='videos'>";
            while ($row_mdp = $result_mdp->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='tuto image_wrapper'>";
                echo "<a href='ressource_type.php?Id_ressource=" . $row_mdp["Id_ressource"] . "'>";
                echo "<img src='" . $row_mdp["Image"] . "' alt='" . $row_mdp["Titre"] . "'>";
                echo "<div class='overlay_4'>";
                echo "<div class='text_overlay fw-semibold'>Consulter</div>";
                echo "</div>";
                echo "</a>";
                echo "</div>";
            }
            echo "</div>";
            echo "</div>";
        } else {
            echo "Aucun résultat trouvé pour la sous-catégorie 'Mot de passe'.";
        }
        ?>
    </section>


    <div class="quiz">
        <h2 data-i18n="title_quiz">Quiz</h2>
        <div class="trait-orange exclude-accessibility"></div>
        <div class="texte-img-quiz">
            <div class="texte-quiz">
                <p class="fs-4 fw-medium" data-i18n="go_exo">Il est grand temps de vous exercer afin de savoir si vous avez bien suivi les ressources de la catégorie <span class="color_sec" data-i18n="security_cat">sécurité </span>!</p>
                <button onclick="window.location.href='quiz.html?category=securite&source=categorie-securite.php'" class="btn fw-bold btn-quiz" data-i18n="go_quiz">Faire le quiz</button>
            </div>
            <div class="img-quiz">
                <img src="./assets/images/illustration/quiz2.png" alt="Illustation Quiz">
            </div>
        </div>
    </div>



        <!-- footer -->
        <footer>
            <div class="container d-flex flex-column align-items-center">
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
                            <li><a class="fs-3 menu__link fw-medium" href="index.php" data-i18n="home">Accueil</a></li>
                            <div class="separator"></div>
                            <li><a class="fs-3 menu__link fw-medium" href="about.html" data-i18n="about">A propos</a></li>
                            <div class="separator"></div>
                            <li><a class="fs-3 menu__link fw-medium" href="ressource.html" data-i18n="resources">Ressources</a></li>
                        </ul>
                    </div>
                    <div class="bot">
                        <ul class="d-flex">
                            <li><a class="fs-3 menu__link fw-medium" href="politique.html" data-i18n="privacy_policy">Politique de confidentialité</a></li>
                            <div class="separator"></div>
                            <li><a class="fs-3 menu__link fw-medium" href="legal.html" data-i18n="legal_notice">Mentions légales</a></li>
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
        <script src="./assets/js/translate.js"></script>
        <script src="./assets/js/script.js"></script>
        <script src="./assets/js/script_chatbot.js"></script>
        
    </body>
    </html>