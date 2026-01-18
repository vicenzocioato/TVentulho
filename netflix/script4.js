const url = "http://localhost/projetos%2026/netflix";
let card = document.getElementById('card')
const form = document.getElementById('forme')
const erro = document.getElementById('txtErro')
const body = document.getElementById('container')
form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const nome = document.getElementById('nome')
    const senha = document.getElementById('senha')

    const resposta = await fetch(`${url}/lib/Auth.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            nome: nome.value,
            senha: senha.value
        })
    });

    const result = await resposta.json();
    if (result.erro == 1) {
        card.style.display = "flex"
        erro.innerText = "Preencha os campos em branco!"
        body.style.filter = "blur(6px)";


        setTimeout(esconder, 2500)
    }
    else if (result.erro == 2) {
        body.style.filter = "blur(6px)";
        card.style.display = "flex"
        erro.innerText = "Dados incorretos!"
        form.reset()


        setTimeout(esconder, 3500)
    }
    else if (result.erro == 3) {
        body.style.filter = "blur(6px)";
        card.style.display = "flex"
        erro.innerText = "Erro no banco de dados. Tente novamente mais tarde."



        setTimeout(esconder, 3500)
        console.log("erro no banco")
    }
    else if(result.erro== 0){
        window.location.href = `${url}/web/filmes.html`;
    }

});

function esconder() {
    card.style.display = "none"
    body.style.filter = "none";

}