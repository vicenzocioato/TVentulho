const url = "http://localhost/projetos%2026/netflix";
const coment = document.getElementById('rootCmm');
let id = null;

async function api() {
    try {
        const resposta = await fetch(`${url}/pesquisa.php`);

        if (!resposta.ok) {
            console.log('Erro no servidor:', resposta.status);
            return;
        }

        const obj = await resposta.json();
        console.log(obj)
        if (obj.id) {
                const filme = document.createElement('iframe');
                filme.src = `https://vidsrc.to/embed/movie/${obj.id}`;
                filme.width = "100%";
                filme.height = "500";
                filme.style.border = "none";
                filme.allowFullscreen = true;

               document
                    .getElementById('video-player')
                    .appendChild(filme);

            id = obj.id;
            await carregarComentarios();
        }

    } catch (erro) {
        console.log('Erro de rede ou JSON inválido:', erro);
    }
}

async function carregarComentarios() {
    try {
        const resposta = await fetch(`${url}/api/comentarios.php`);
        const dados = await resposta.json();

        console.log(dados);

        const usuarioLogadoId = dados.SessionId;
        const comentarios = dados.comentarios;

        if (!Array.isArray(comentarios)) {
            console.error("Erro na API:", dados);
            return;
        }

        coment.innerHTML = "";

        comentarios.forEach(comentario => {

            if (String(comentario.obra) === String(id)) {

                const nome = document.createElement('label');
                nome.innerText = comentario.autor + " • " + comentario.data;
                nome.style.fontWeight = "bolder";
                nome.style.display = "block";
                nome.style.marginTop = "3dvh";

                coment.appendChild(nome);

                const txt = document.createElement('div');
                txt.textContent = comentario.texto;
                coment.appendChild(txt);

                if (comentario.userId === usuarioLogadoId) {
                    const btn = document.createElement('button');
                    btn.innerHTML = "<i class='fa-solid fa-trash'></i>"
                    btn.style.backgroundColor = "transparent"
                    btn.style.border = "none"
                    btn.style.color = "white"
                    btn.onclick = e => {
                        e.preventDefault();
                        deletarComentario(comentario.id);
                    };

                    coment.appendChild(btn);
                }
            }
        });

    } catch (erro) {
        console.error("Erro ao carregar comentários:", erro);
    }

    
}


const form = document.getElementById('comentarios');

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const texto = form.querySelector('textarea').value;

    const resposta = await fetch(`${url}/lib/comentarios.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            texto: texto,
            ObraId: id
        })
    });

    const result = await resposta.json();
    console.log(result);

    form.reset();
    carregarComentarios();
});






async function deletarComentario(idCmm) {
    const resposta = await fetch(`${url}/lib/comentarios.php`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            CmmId: idCmm
        })
    });
    carregarComentarios()
}

api()
