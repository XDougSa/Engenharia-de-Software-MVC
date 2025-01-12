<?php require_once ("./src/components/Layout.php");?>

<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./src/views/Dashboard/styles.css">
</head>
<body>
    <?php pageHeader() ?>
    <div id = "put">
        <form method = "POST" id = "nsecv">
            <input type = "text" placeholder = "Id" id = "id" name = "id" />
            <input type = "text" placeholder = "Nome" id = "usuario" name = "usuario" />
            <button class="btn btn-edit" type = "submit" name = "editar"> Ok </button>
        </form>
        <button id = "sumir" class = "btn btn-delete"> Fechar  </button>
    </div>
    <table id="userTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id = "dashboard" />
    </table>
    <?php Footer();?>
</body>
<script> 
    const usuarios = <?php echo ($resultado); ?>;
    const dashboard = document.getElementById ("dashboard");
    let linhas = "";
    const form = document.getElementById ("put");

    usuarios.forEach ((usuario, index) => {
        linhas += `
        <tr>
            <td>${usuario.id}</td>
            <td>${usuario.nome}</td>
            <td>${usuario.email}</td>
            <td>
                <button class="btn btn-edit" type = "submit" name = "${index}" value = "${usuario.id}" id = "editar" onclick="">Editar</button>
                <form method = "POST">
                    <button class="btn btn-delete" type = "submit" name = "excluir" value = "${usuario.id}" id = "${usuario.id}" onclick="">Apagar</button>
                </form>
            </td>
        </tr>
        `
    });
    dashboard.innerHTML = linhas;

    document.getElementById ("editar").addEventListener ("click", () => {
        const posicao = document.getElementById ("editar");
        form.style.display = "flex";
        document.getElementById ("id").value = posicao.value;
        document.getElementById ("usuario").value = usuarios [posicao.name].nome;
    });

    form.style.display = "none";

    document.getElementById ("sumir").addEventListener ("click", () => {
        form.style.display = "none";
    });
</script>  
</html>