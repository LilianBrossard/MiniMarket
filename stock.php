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
    <?php
        $articles[$_GET['code']][3] = $articles[$_GET['code']][3] + 10;
    ?>
    <h1>Le stock du prooduit : <?php echo $articles[$_GET['code']][0] ?> a était augmenté de 10</h1>
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