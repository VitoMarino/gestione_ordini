<!DOCTYPE html>
<html lang="ita">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione ordini</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <h1 class="d-flex justify-content-center p-3">Carrello</h1>

    <?php
session_start();

// Verifica se la sessione 'carrello' non è ancora stata inizializzata e la inizializza come array vuoto
if (!isset($_SESSION['carrello'])) {
    $_SESSION['carrello'] = [];
}

// Il reset viene eseguito tramite un parametro GET chiamato 'reset'
if (isset($_GET['reset']) && $_GET['reset'] == 'true') {
    // Reset della sessione carrello
    $_SESSION['carrello'] = [];
}

// Se ci sono prodotti nel carrello
if (!empty($_SESSION['carrello'])) {
    echo "<ul class='list-group'>";
    foreach ($_SESSION['carrello'] as $prodotto) {
        echo "<li class='list-group-item'>Prodotto: " . ($prodotto['nome']) . " - Prezzo: €" . ($prodotto['prezzo']) . "</li>";
    }
    echo "</ul>";

    // Calcola il totale. Passo come argomento tutto il carrello
    $totale = sommaTotale($_SESSION['carrello']);
    echo "<h4 class='text-center mt-4'>Totale: €" . round($totale, 2) . "</h4>";
} else {
    echo '<h3 class="text-center">Non ci sono prodotti nel carrello.</h3>';
}

// Link per tornare alla gestione ordini
echo "<div class='d-flex justify-content-center'>
        <a href='index.php' class='btn btn-primary'>Torna alla gestione degli ordini</a>
      </div>";

// Tasto per resettare il carrello con il parametro GET
echo "<div class='d-flex justify-content-center p-3'>
        <a href='carrello.php?reset=true' class='btn btn-danger'>Svuota Carrello</a>
      </div>";

// Funzione per calcolare il totale e applicare lo sconto
function sommaTotale($prodotti) {
    $somma = 0;
    foreach ($prodotti as $prodotto) {
        $somma += $prodotto['prezzo'];
    }

    // Applica lo sconto del 10% se il totale è maggiore di 100
    if ($somma > 100) {
        // Calcolo la somma x il 10% e viene lo sconto
        $sconto = $somma * 0.10;
        // Togliamo lo sconto dalla somma
        $somma = $somma - $sconto;
        // Mostra il messaggio dello sconto
        echo "<h5 class='text-center text-success'>Sconto del 10% applicato: -€" . round($sconto, 2) . "</h5>";
    }

    return $somma;
}
?>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

</html>