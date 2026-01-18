const erro = document.getElementById('txtErro')
const body = document.getElementById('container')
let card = document.getElementById('card')

const url = "http://localhost/projetos%2026/netflix";
//criar conta
form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const nome = document.getElementById('nome').value
    const senha = document.getElementById('senha').value

    const resposta = await fetch(`${url}/api/CriaConta.php`, {
        method: 'POST',
         headers: {
             'Content-Type': 'application/json'
         },
        body: JSON.stringify({
            nome: nome,
            senha: senha
        })
    });
    const dados = await resposta.json()
    console.log(dados)
    if(dados.status==3){
        window.location.href = `${url}/index.html`;
    }
    else if(dados.status==1){
        card.style.display = "flex"
        erro.innerText = "Preencha os campos em branco!"
        body.style.filter = "blur(6px)";

        setTimeout(esconder, 2500)
    }
    else if(dados.status==2){
         card.style.display = "flex"
        erro.innerText = "Nome de usuário já em uso!"
        body.style.filter = "blur(6px)";

        setTimeout(esconder, 2500)
    }
});


function esconder() {
    card.style.display = "none"
    body.style.filter = "none";

}