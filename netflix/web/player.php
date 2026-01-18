
<?php
session_start(); 
if (isset($_POST['id'])) {
    $_SESSION['imdb_id'] = $_POST['id'];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Player</title>
    <link rel="stylesheet" href="style.css">
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Afacad+Flux:wght@100..1000&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Oswald:wght@200..700&family=Outfit:wght@100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body id="player">
    <header>
        <section>
            <a href="filmes.html"><div class="hover-underline">Filmes</div></a>
            <a href="minhaLista.html"><div class="hover-underline">Minha lista</div></a>
        </section>
    </header>

    <div id="video-player"></div>

    <div id="abaCmm">
    <div>
    <i class="fa-regular fa-comment" name="a"></i>
    <label for="a">Comentários!</label>
    </div>
    <form id="comentarios">
        <textarea name="texto" placeholder="Escreva seu comentário..." maxlength="400"></textarea>
        <input type="submit" id="cmmSubmit">
    </form>

    <div id="rootCmm"></div>

</div>
    <script src="script.js"></script>
</body>
</html>