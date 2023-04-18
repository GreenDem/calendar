<?php

try
{
	$db = new PDO('mysql:host=localhost;dbname=date_calendar;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

$months = array('', 'Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
if (isset($_GET['month']) && isset($_GET['years'])) {
    $userMonth = $_GET['month'];
    $userYears = $_GET['years'];
}
function calendar($userYears, $userMonth)
{
    $date =  new DateTime("$userYears-$userMonth");
    $date2 = new DateTime("$userYears-$userMonth-01");
    $weekDays = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
    $lastDiv =  0;
    $monthStart = $date2->format('w');
    $totalDay = $date->format('t');
    $date4 = new DateTime("$userYears-$userMonth-$totalDay");



    foreach ($weekDays as $key => $weekDay) {
        echo "<div class='cal red bold'><div class='weekDay'><p class='pday'>" . $weekDay . "</p></div></div>";
    }
    if ($monthStart == 0) {
        for ($sunday = 6; $sunday > 0; $sunday--) {
            $date2 = new DateTime("$userYears-$userMonth-01");
            $date3 = $date2->modify('-' . $sunday . 'days');
            echo  '<div class="cal empty"><p>' . $date3->format('d') . '</p></div>';
            $lastDiv = $lastDiv + 1;
        }
    } else {
        for ($blankBlock = ($monthStart - 1); $blankBlock > 0; $blankBlock--) {
            $date2 = new DateTime("$userYears-$userMonth-01");
            $date3 = $date2->modify('-' . $blankBlock . 'days');
            echo  '<div class="cal empty">' . $date3->format('d') . '</div>';
            $date2 = new DateTime("$userYears-$userMonth-01");

            $lastDiv = $lastDiv + 1;
        }
    }
    for ($monthDay = 1; $monthDay <= $date->format('t'); $monthDay++) {
        echo '<div class ="cal"><p>' . $monthDay . '</p></div>';
        $lastDiv = $lastDiv + 1;
    }
    for ($lastDiv; $lastDiv % 7 != 0; $lastDiv = $lastDiv + 1) {
        $date5 = $date4->modify('+1 days');
        echo  '<div class="cal empty"><p>'. $date5->format('d') .'</p></div>';
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
    <?php if (!isset($_GET['month']) && !isset($_GET['years'])) { ?>
        <h2>POUR AFFICHER LE CALENDRIER VEUILLEZ D'ABORD SELECTIONNER UN MOIS ET UNE ANNEE</h2>
        <?php } ?>
        <form>
            <select name="month">
                <?php foreach ($months as $indexmonth => $month) {
                    if ($indexmonth === 0) { ?>
                        <option value="" disabled>---- Choissez un mois -----</option>
                    <?php } elseif ($month == $months[$userMonth]) { ?>
                        <option selected="selected" value="<?= $indexmonth ?>"><?= $month ?></option>
                    <?php } else { ?>
                        <option value="<?= $indexmonth ?>"><?= $month ?></option>
                <?php }
                } ?>
            </select>
            <select name="years">
                <option value="" disabled>---- Choissez une année -----</option>
                <?php for ($i = 1970; $i <= 2070; $i++) {
                    if ($i == $userYears) { ?>
                        <option selected="selected" value="<?= $i ?>"><?= $i ?></option>
                    <?php } else { ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
            <button>CALENDRIER</button>
        </form>
        <?php if (isset($_GET['month']) && isset($_GET['years'])) { ?>
            <div class="subcontainer">
                <h1><?= $months[$userMonth] . " " . $userYears ?></h1>
            </div>
            <div class="container">
                <?= calendar($userYears, $userMonth) ?>
            </div>
        <?php } ?>

        <!-- <option value="01">Janvier</option>
<option value="02">Fevrier</option>
<option value="03">Mars</option>
<option value="04">Avril</option>
<option value="05">Mai</option>
<option value="06">juin</option>
<option value="07">Juillet</option>
<option value="08">Aout</option>
<option value="09">Septembre</option>
<option value="10">Octobre</option>
<option value="11">Novembre</option>
<option value="12">Decembre</option> -->




    </main>

    <script src="script.js"></script>

</body>

</html>