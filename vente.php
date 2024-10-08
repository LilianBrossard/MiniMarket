<?php
    $articles = unserialize(file_get_contents("./data"));
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <title>Articles</title>
</head>

<body>
    <?php
        $page = $_GET['page'];
    ?>
    <a href="liste.php?page=<?php echo $page; ?>">&lsaquo; Retour</a>
    <h1>Combien de <?php echo $articles[$_GET['code']][0] ?> voulez vous vendre ?</h1>
    <form method="post">
        <input type="number" name="vente" min="1" required>
        <button type="submit">Vendre</button>
    </form>

    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vente = intval($_POST['vente']);
            if ($vente <= $articles[$_GET['code']][3]) {
                $articles[$_GET['code']][3] = $articles[$_GET['code']][3] - $vente;
                $articles[$_GET['code']][4] = $articles[$_GET['code']][4] + $vente;
                ?> <p>Vente réussie de $vente article!</p> <?php            
            }
            else {
                ?> <p>Il n'y a pas assez de stock!</p> <?php                
            }
        }
    ?>
    <?php
        $ser = serialize($articles);
        file_put_contents("./data",$ser);
    ?>
</body>
<style>
body {
    padding: 0 20px;
}
a{
	color: black;
	background-image: linear-gradient(to bottom, transparent 65%, #00c3ff 0);
	background-size: 0% 100%;
	background-repeat: no-repeat;
	text-decoration: none;
	transition: background-size .4s ease;
}

a:hover {
	background-size: 100% 100%;
	cursor: pointer;
}
</style>
</html>