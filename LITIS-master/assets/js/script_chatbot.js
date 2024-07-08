function question(){
    
    var icone_user=document.createElement('img')
    icone_user.id="icon_user"
    icone_user.src="assets/images/icone_chat/user3.png"
    icone_user.alt=""
    var icone_chat=document.createElement('img')
    icone_chat.id="icon_chat"
    icone_chat.src="assets/images/avatar/normal.svg"
    icone_chat.alt="chat"
    var divContainer = document.getElementById("repo")
    let paragraphe_user = document.createElement("p");
    paragraphe_user.setAttribute("id","paragraphe_user")
    let user=document.createElement("span")
    user.setAttribute("id","span_user")
    let message=document.createElement("span")
    message.setAttribute("id","message_user")
    user.appendChild(icone_user)
    message.textContent=document.getElementById("question_input").value
    paragraphe_user.appendChild(user)
    paragraphe_user.appendChild(message)
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            let paragraphe_chat = document.createElement("p");
            paragraphe_chat.setAttribute("id","paragraphe_chat")
            rep=JSON.parse(this.responseText).split(':')
            if (rep.length>1)
            {
                reponse=rep[0]
                lien=rep[1].concat(":").concat(rep[2])
                balise_line=document.createElement("a")
                balise_line.href=lien
                balise_line.textContent="vous pouvez cliquer directement sur ce lien"
                balise_line.style.color="red"
                balise_line.style.fontweight="bold"
                balise_line.style.fontstyle="italic"
                balise_line.target="_blank"
            }
            else{
                reponse=JSON.parse(this.responseText)
            }
            let chat=document.createElement("span")
            let reponse_ch=document.createElement("span")
            reponse_ch.setAttribute("id","reponse_chat")
            chat.appendChild(icone_chat)
            reponse_ch.textContent=reponse
            if (rep.length>1){
                reponse_ch.appendChild(balise_line)
            }
            paragraphe_chat.appendChild(chat)
            paragraphe_chat.appendChild(reponse_ch)
            divContainer.appendChild(paragraphe_user);
            divContainer.appendChild(paragraphe_chat);
            document.getElementById("question_input").value=""
        }
    }
    var userInput = document.getElementById("question_input").value;
    var data = JSON.stringify({ question: userInput });
    xhr.open("POST", "https://chatbot-cimhpvexea-od.a.run.app/myapi");                         
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(data);
}
document.getElementById("question_input").addEventListener("keydown", function(event) {
    if (event.key === "Enter") {
        event.preventDefault(); 
        document.getElementById("poser_question_btn").click();
    }
});
