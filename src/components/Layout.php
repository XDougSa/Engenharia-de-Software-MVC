<?php 
function pageHeader (string $nomeDoSite = "Dashboard", array $itemUm = ["link"=>"#", "nome"=>"Home"], 
array $itemDois = ["link"=>"#", "nome"=> "Sobre Nós"], array $itemTres = ["link"=>"#", "nome"=>"Contato"]) {
    if (isset($_POST ['logout'])) {
        session_destroy ();
        header ("Location: /login");
    }
    echo ("
    <header class='header'>
        <div class='logo'>".$nomeDoSite."</div>
        <nav class='nav-links'>
            <a href='".$itemUm["link"]."'>".$itemUm["nome"]."</a>
            <a href='".$itemDois["link"]."'>".$itemDois["nome"]."</a>
            <a href='".$itemTres["link"]."'>".$itemTres["nome"]."</a>
        </nav>
        <form method = 'POST'>
            <button type = 'submit' name = 'logout' class='logout-btn'>Logout</button>
        </form>
    </header>

    <style>
        .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        background-color: #007BFF;
        color: white;
        }

        .header .logo {
        font-size: 24px;
        font-weight: bold;
        }

        .header .nav-links {
        display: flex;
        gap: 20px;
        }

        .header .nav-links a {
        color: white;
        text-decoration: none;
        font-size: 16px;
        transition: color 0.3s;
        }

        .header .nav-links a:hover {
        color: #ddd;
        }

        .header .logout-btn {
        background-color: #ff4b5c;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
        }

        .header .logout-btn:hover {
        background-color: #ff2a3a;
        }
    </style>
    ");
}

function Footer (string $textoDireita = "&copy; 2023 Dashboard. Olha o royalty.", 
array $linkUm = ["nome"=>"LGPD", "link"=>"#"], array $linkDois = ["nome"=>"Termos que ninguém lê", "link"=>"#"]) {
    echo ('
    <footer style = " background-color: #007BFF; color: #cccccc; padding: 20px 0; text-align: center; bottom: 0px; width: 100%; position: fixed;">
    <div style = "display: flex; justify-content: space-between; align-items: center; max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div style = "flex: 1; text-aling: left;">'.$textoDireita.'</div>
        <div style = "flex: 1; text-align: right;">
            <ul style = "list-style: none; padding: 0; margin: 0;">
                <li style = "display: inline; margin-right: 15px;"><a style = "color: #cccccc; text-decoration: none; transition: color 0.3s;" href="'.$linkUm["link"].'">'.$linkUm["nome"].'</a></li>
                <li style = "display: inline; margin-right: 15px;"><a style = "color: #cccccc; text-decoration: none; transition: color 0.3s;" href="'.$linkDois["link"].'">'.$linkDois ["nome"].'</a></li>
            </ul>
        </div>
    </div>
</footer>
');
}
?>