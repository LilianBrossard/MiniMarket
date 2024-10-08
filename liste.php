
<?php
    $articles = unserialize(file_get_contents("./data"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <title>Articles</title>
</head>

<body>
    <h1 class="minimarcket">Minimarcket</h1>
    <?php
    if(!isset($_GET['page'])){
        $page = 1;
    }
    else {
        $page = $_GET['page'];
    }
    ?>
    <table>
        <tr>
            <th class="centre">
                Code
            </th>
            <th class="Libelle">
                Libellé
            </th>
            <th class="droite">
                Prix HT
            </th>
            <th class="droite">
                Taux TVA
            </th>
            <th class="droite">
                Montant TVA
            </th>
            <th class="TTC droite">
                Prix TTC
            </th>
            <th class="centre">
                Stock
            </th>
            <th class="centre">
                Vendu
            </th>
            <th class="action">
                Action
            </th>
        </tr>
        <?php
        $nbArticle = 8;
        $cpt = 0;
        foreach ($articles as $ketArticle => $valueArticle) {
            if (($cpt >= ($page*$nbArticle-$nbArticle)) && ($cpt < ($page*$nbArticle))) {
                ?>
        <tr>
            <td class="centre">
                <?php echo htmlentities($ketArticle); ?>
            </td>
            <td class="Libelle">
                <?php echo htmlentities($valueArticle[0]); ?>
            </td>
            <td class="droite">
                <?php echo htmlentities(round(($valueArticle[1]), 2)); ?>
                €
            </td>
            <td class="droite">
                <?php echo htmlentities($valueArticle[2]); ?>
                %
            </td>
            <td class="droite">
                <?php echo htmlentities(round(($valueArticle[2] / 100 * $valueArticle[1]), 2)); ?>
                €
            </td>
            <td class="TTC droite">
                <?php echo htmlentities(round(($valueArticle[1] + $valueArticle[2] / 100 * $valueArticle[1]), 2)); ?>
            </td>
            <td class="centre">
                <?php echo htmlentities($valueArticle[3]); ?>
            </td>
            <td class="centre">
                <?php echo htmlentities($valueArticle[4]); ?>
            </td>
            <td class="around">
                <a href="stock.php?page=<?php echo $page;?>&code=<?php echo $ketArticle;?>">+10</a>
                <a href="vente.php?page=<?php echo $page;?>&code=<?php echo $ketArticle;?>">vente</a>
            </td>
            <?php }$cpt ++;} ?>
        </tr>
    </table>

    <div class="nav">
        <!-- TODO -->
        <?php if($page > 1){?>
            <a href="liste.php?page=<?php echo $page - 1; ?>">&lsaquo; prec</a>
        <?php }
        else {
            ?><div></div><?php
        }
        if($cpt / $nbArticle> $page){?>
            <a href="liste.php?page=<?php echo $page + 1; ?>">suiv &rsaquo;</a>
        <?php }
        else {
            ?><div></div><?php
        }
        ?>
    </div>

    <!-- calcul des tautaux  -->
    <?php
    $valHT =0;
    $valStock=0;
    $valTTC=0;
    $valVendus=0;
    foreach ($articles as $ketArticle => $valueArticle) {
        $valHT = $valHT + round(($valueArticle[1]), 2) * $valueArticle[3];
        $valStock = $valStock + $valueArticle[3];
        $valTTC = $valTTC + (round(($valueArticle[1] + $valueArticle[2] / 100 * $valueArticle[1]), 2) * $valueArticle[4]);
        $valVendus = $valVendus + $valueArticle[4];
    }
    ?>
    <table>
        <tr>
            <th>
                Valeur total HT du Stock
            </th>
            <th>
                Quandtité total du Stock
            </th>
            <th>
                Valeur total TTC Vendu
            </th>
            <th>
                Quantité total vendus
            </th>
        </tr>
        <tr>
            <td class="centre">
                <?php echo htmlentities($valHT); ?>
                €
            </td>
            <td class="centre">
                <?php echo htmlentities($valStock); ?>
            </td>
            <td class="centre">
                <?php echo htmlentities($valTTC); ?>
                €
            </td>
            <td class="centre">
                <?php echo htmlentities($valVendus); ?>
            </td>
        </tr>
    </table>
</body>
<style>
    
a {
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

.action{
    display : flex;
    justify-content : space-around;
    flex-direction : row;
}

body {
    padding: 0 20px;
}

.nav{
    display : flex;
    justify-content : space-between;
    flex-direction : row;
    width: 100px;
}

td {
    border: #00c3ff solid 1px;
    min-width: 80px;
    padding: 3px;
}

.Libelle,
.TTC {
    background-color: #fcfcfc;
}

.Libelle {
    text-align: left;
}

.centre {
    text-align: center;
}

.droite {
    text-align: right;
}
</style>

</html>