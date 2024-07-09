<?php 
session_start();

include('connect_bdd.php');

$query = "SELECT * FROM glossaire ORDER BY Mot ASC";
$statement = $db->prepare($query);
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);

// if ($results) {
//     foreach ($results as $result) {
//         echo $result['Definition'];
//         echo "<br>";
//     }
// }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/general.css">
    <link rel="stylesheet" href="./assets/css/style_chat.css">
    <link rel="stylesheet" href="./assets/css/glossaire.css">
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script src="https://kit.fontawesome.com/96e027db6d.js" crossorigin="anonymous"></script>
    <!-- langue -->
    <script src="https://unpkg.com/i18next@21.6.13/i18next.min.js"></script>
    <script src="https://unpkg.com/i18next-http-backend@1.4.0/i18nextHttpBackend.min.js"></script>
    <script src="https://unpkg.com/i18next-browser-languagedetector@6.1.3/i18nextBrowserLanguageDetector.min.js"></script>
    <!--  -->
    <title>Termes du numérique | Glossaire | Existence Numérique</title>
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
                <li><a class="fs-3 menu__link fw-semibold" href="index.php" data-i18n="home">Accueil</a></li>
                <li><a class="fs-3 menu__link fw-semibold" href="about.html" data-i18n="about">A propos</a></li>
                <li><a class="active fs-3 menu__link fw-semibold" href="ressource.html" data-i18n="resources">Ressources</a></li>
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
            <a href="#" data-lang="fr">FR : Français</a>
            <a href="#" data-lang="en">EN : English</a>
            <a href="#" data-lang="es">ES : Español</a>
            <a href="#" data-lang="de">DE : Deutsch</a>
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




    <!-- titre -->
    <section class="container title d-flex flex-column align-items-center">
        <h1 data-i18n="title_glossary">Glossaire</h1>
        <p class="fs-4" data-i18n="dico">Ici, vous pouvez accéder, apprendre et découvrir tous les termes en lien avec le web.</p>
        <div class="big_search exclude-accessibility">
            <input type="text" id="big-search-input" placeholder="Rechercher..." class="exclude-accessibility">
            <a href="#" aria-labelledby="search-input">
                <lord-icon class="icon"
                    src="https://cdn.lordicon.com/unukghxb.json"
                    trigger="loop"
                    delay="2000"
                    style="width:30px;height:30px">
                </lord-icon>
                <span class="visually-hidden">Rechercher</span>
            </a>
        </div>
        <div id="search-error" style="color: red; display: none;"></div>
    </section>


    <section class="container glossaire d-flex flex-column align-items-center">
        <ul class="filtre d-flex justify-content-center align-items-center">
            <li class="list filtre-active" data-filter="All" data-i18n="all">Tout</li>
            <li class="list" data-filter="A">A</li>
            <li class="list" data-filter="B">B</li>
            <li class="list" data-filter="C">C</li>
            <li class="list" data-filter="D">D</li>
            <li class="list" data-filter="E">E</li>
            <li class="list" data-filter="F">F</li>
            <li class="list" data-filter="G">G</li>
            <li class="list" data-filter="H">H</li>
            <li class="list" data-filter="I">I</li>
            <li class="list" data-filter="J">J</li>
            <li class="list" data-filter="K">K</li>
            <li class="list" data-filter="L">L</li>
            <li class="list" data-filter="M">M</li>
            <li class="list" data-filter="N">N</li>
            <li class="list" data-filter="O">O</li>
            <li class="list" data-filter="P">P</li>
            <li class="list" data-filter="Q">Q</li>
            <li class="list" data-filter="R">R</li>
            <li class="list" data-filter="S">S</li>
            <li class="list" data-filter="T">T</li>
            <li class="list" data-filter="U">U</li>
            <li class="list" data-filter="V">V</li>
            <li class="list" data-filter="W">W</li>
            <li class="list" data-filter="X">X</li>
            <li class="list" data-filter="Y">Y</li>
            <li class="list" data-filter="Z">Z</li>
        </ul>

        <div class="container glossaire-container d-flex justify-content-center align-items-center">
            <?php
                foreach ($results as $row) {
                $mot = htmlspecialchars($row['Mot']);
                $def = htmlspecialchars($row['Definition']);
                $syn = htmlspecialchars($row['Synonyme']);
                $firstLetter = strtoupper($mot[0]); 

                echo "
                    <div class= \"exclude-accessibility BonW mot-box $firstLetter\" id=\"".strtolower($mot)."\">
                        <p class= \"exclude-accessibility text mot\">$mot</p>
                        <p class= \"exclude-accessibility text def\">$def</p>
                    </div>";
            }
            ?>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <script>
        $(document).on('click', '.filtre li', function() {
            $(this).addClass('filtre-active').siblings().removeClass('filtre-active');
        })

        $(document).ready(function() {
            $('.list').click(function() {
                const value = $(this).attr('data-filter');
                if (value == 'All') {
                    $('.mot-box').show('1000');
                }
                else {
                    $('.mot-box').not('.' + value).hide('1000');
                    $('.mot-box').filter('.' + value).show('1000');
                }
            })
        })




        $(document).ready(function() {
            $('#big-search-input').on('keypress', function(e) {
                // Vérifie si la touche Entrée est pressée
                if (e.which === 13) {
                    e.preventDefault();  // Empêche le formulaire de s'envoyer
                    var searchWord = $(this).val().toLowerCase();

                    // Réinitialiser la mise en évidence et cacher les messages d'erreur précédents
                    $('.mot-box').removeClass('highlight');
                    $('#search-error').hide();

                    if (searchWord) {
                        var target = $('#' + searchWord);
                        if (target.length) {
                            // Défiler vers le mot spécifique si trouvé
                            $('html, body').animate({
                                scrollTop: target.offset().top - 350
                            }, 1000, function() {
                                // Ajouter la classe de mise en évidence une fois le défilement terminé
                                target.addClass('highlight');
                            });
                        } else {
                            // Afficher un message d'erreur si le mot n'est pas trouvé
                            $('#search-error').text("Aucun résultat trouvé pour '" + searchWord + "'.").show();
                        }
                    }
                }
            });
        });
    </script>




    
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
    <script src="./assets/js/script_chatbot.js"></script>
    <script src="./assets/js/translate.js"></script>
    <script src="./assets/js/script.js"></script>
  </body>

</html>