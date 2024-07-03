const indicateurs = document.querySelector('.indicateurs');
const input = document.querySelector('input');
const faible = document.querySelector('.indicateurs span:nth-child(1)');
const moyen = document.querySelector('.indicateurs span:nth-child(2)');
const fort = document.querySelector('.indicateurs span:nth-child(3)');
const icon = document.querySelector('.box span');
const comment = document.getElementById('comment');
const indication = document.getElementById('indication');


let regexFaible = /[a-zA-Z]/;
let regexMedium = /\d+/;
let regexFort = /[!,@,#,%,^,&,*,?,_,-,(,),]/;

function trigger() {
    if (input.value != "") {
        indicateurs.style.display = "block";
        indicateurs.style.display = "flex";
        icon.style.display = "block";


        if (regexFaible.test(input.value)) {
            faible.classList.add('active');
            comment.textContent = "Bravo !! Mais votre mot de passe est encore un peu faible.";
            indication.textContent = "Ajouter plusieurs chiffres."
        }
        else {
            faible.classList.remove('active');
        }

        if (regexMedium.test(input.value)) {
            moyen.classList.add('active');
            comment.textContent = "Bien joué !! Vous avez maintenant un mot de passe moyen, mais on peut encore l'améliorer !";
            indication.textContent = "Ajouter des caractères spéciaux (!, @, #, ^, &, *, ?, _, -, (, )";
        }
        else {
            moyen.classList.remove('active');
        }

        if (regexFort.test(input.value)) {
            fort.classList.add('active');
            comment.textContent = "Formidable !! Vous avez maintenant un mot de passe Fort.";
            indication.textContent = "Vous pouvez utiliser ce mot de passe si vous en avez besoin."
        }
        else {
            fort.classList.remove('active');
        }
    }
    else {
        indicateurs.style.display="none";
        icon.style.display="none";
        faible.classList.remove('active');
        moyen.classList.remove('active');
        fort.classList.remove('active');
        comment.textContent = "Suivez la première indication pour commencer."
        indication.textContent = "Commencer par utiliser des lettres, en utilisant au miminum 1 Majuscule.";
    }
}


icon.addEventListener('click', () => {
    const type= input.getAttribute('type') === "password" ? 'text' : 'password';
    input.setAttribute('type', type);
    icon.classList.toggle('active');
})