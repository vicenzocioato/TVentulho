const url = "http://localhost/projetos%2026/netflix";



function renderizarLista(lista, sessao) {
    const container = document.getElementById("lista");
    container.innerHTML = "";

    if (!Array.isArray(lista)) {
        console.error("lista não é um array", lista);
        return;
    }

    lista.forEach(item => {
        if(item.userId == sessao){
        const divItem = document.createElement("div");
        divItem.classList.add("item");

        divItem.innerHTML = `
            <div>${item.texto}</div>
            <div>
                <i class="fa-solid fa-trash"
                   onclick="deletar(${item.id})"
                   style="cursor:pointer; color:red; padding: 5px;"></i>
            </div>
        `;

        container.appendChild(divItem);
        }
        
    });
}


async function carregarLista() {
    try {
        const resposta = await fetch(`${url}/api/lista.php`);
        const data = await resposta.json();
        console.log("retorno:", data);

        renderizarLista(data.Items, data.sessionId);
    } catch (erro) {
        console.error("Erro ao carregar lista:", erro);
    }
}





function abrirModal() {
    const fundo = document.createElement("div");
    fundo.classList.add("modal-fundo");

    const modal = document.createElement("div");
    modal.classList.add("modal-caixa");

    modal.innerHTML = `
        <form id="modal-form">
            <input type="text" placeholder="Nome da obra..." name="nome" id="nome" required style="width: 100%; margin-bottom: 15px; padding: 8px;">
            <div style="display: flex; gap: 10px; justify-content: center;">
                <button type="submit">OK</button>
                <button type="button" class="cancelar">Cancelar</button>
            </div>
        </form>
    `;

    fundo.appendChild(modal);
    document.body.appendChild(fundo);

    modal.querySelector(".cancelar").onclick = () => fundo.remove();

    

    modal.querySelector("form").onsubmit = async (e) => {
        e.preventDefault();
        let input = document.getElementById('nome')
        const texto = input.value

        const resposta = await fetch(`${url}/api/lista.php`, {
            method: "POST",
             headers: {
            'Content-Type': 'application/json'
        },
            body: JSON.stringify({
            texto: texto,
        })
        });

        const lista = await resposta.json();
        carregarLista();
        fundo.remove();
    };
}



async function deletar(nome) {
    try {
        const res = await fetch(`${url}/api/lista.php`, {
            method: "DELETE",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ itemId: nome })
        });

        if (!res.ok) throw new Error("Erro ao apagar");

        const dados = await res.json();
        carregarLista();
    } catch (erro) {
        console.error("Erro na exclusão:", erro);
    }
}




carregarLista();