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
    <h1 class="d-flex justify-content-center p-3">
        Gestione ordini
    </h1>

    <?php
    // Inizio sessione
    session_start();

    // Leggi il file .env
    $env = file(__DIR__ . '/.env');

    // Estrai le variabili dal file e assegnale direttamente a variabili PHP
    // Mi scorre il file .env riga per riga
    foreach ($env as $line) {
        // La funzione explode divide la riga ($line) in due parti, separando la chiave (prima dell’uguale) dal valore (dopo l’uguale).
        list($key, $value) = explode('=', $line, 2);
        //  La parte $$key è una variabile variabile, che significa che il nome della variabile sarà preso dal valore di $key. 
        // Ad esempio:
        // Se $key è DB_HOST, questo significa che stai creando una variabile chiamata $DB_HOST.
        // trim($value) rimuove eventuali spazi bianchi all’inizio o alla fine del valore.
        $$key = trim($value); // Rimuove spazi o nuove righe
    }

    $host = $DB_HOST;
    $utente = $DB_USER;
    $password = $DB_PASS;
    $nomeDb = $DB_NAME;

    // Creazione della connessione
    $conn = new mysqli($host, $utente, $password, $nomeDb);

    // Verifica della connessione
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    // Se la connessione ha avuto successo
    // echo "Connessione al database riuscita!";

    //CONNESSIONE AL DB
    // -----------------------------------------------------

    // Query per ottenere tutti i prodotti
    $prodotti = "SELECT id, nome, prezzo, quantita_disponibile FROM prodotti";
    $result = $conn->query($prodotti);

    // num_rows è una proprietà dell’oggetto $result, che ti dà il numero di righe restituite dalla query.
    if ($result->num_rows > 0) {
        echo
        "<table class='table table-hover d-flex justify-content-center'>
        <tr>
            <th> Nome </th>
            <th> Prezzo </th>
            <th> Quantità disponibile </th>
        </tr>";

        // Ciclo attraverso i risultati e stampo ogni riga della tabella
        // La funzione fetch_assoc() è un metodo utilizzato in PHP per estrarre i dati da una query MySQL e restituirli come un array associativo.
        while ($row = $result->fetch_assoc()) {
            echo

                // COMMENTI RELATIVI AL TAG <a></a> DELLA TABLE
                /* ?aggiungi=true (Indica che l'utente ha cliccato sul link per aggiungere)
                / &id=<?php echo $row[id]; ?> (Passa l'ID del prodotto)
                / &nome=<?php echo urlencode($row[nome]); ?> (Passa il nome del prodotto)
                / &prezzo=<?php echo $row[prezzo]; ?> (Passa il prezzo del prodotto)
                / Urlencode serve a codificare i dati da inviare in un URL in modo che vengano interpretati correttamente dal server (Tipo caratteri speciali che non diano errori) */

            "<tr>
                <td>" . $row['nome'] . " </td> 
                <td>" . $row['prezzo'] . "</td>
                <td>" . $row['quantita_disponibile'] . "</td>
                <td>
                    <a href='?aggiungi=true&id=" . $row['id'] . "&nome=" . urlencode($row['nome']) . "&prezzo=" . $row['prezzo'] . "' class='btn btn-primary'>
                        <i class='fa-solid fa-cart-shopping'></i>
                    </a>
                </td>
            </tr>";
        }

        echo "</table>";
    } else {
        echo "Nessun prodotto trovato";
    }

// Aggiungi il prodotto al carrello quando viene cliccato il link "AGGIUNGI"
if (isset($_GET['aggiungi'])) {
    // Controllo se i parametri sono presenti nell'URL e non sono vuoti
    if (isset($_GET['id'], $_GET['nome'], $_GET['prezzo']) && !empty($_GET['id']) && !empty($_GET['nome']) && !empty($_GET['prezzo'])) {
        // Aggiungi il prodotto al carrello nella sessione
        $_SESSION['carrello'][] = [
            'id' => $_GET['id'],
            'nome' => $_GET['nome'],
            'prezzo' => $_GET['prezzo']
        ];
    }
    // Dopo aver aggiunto il prodotto, reindirizza alla pagina del carrello
    header("Location: carrello.php");
    exit;
}

    echo
    "<div class='d-flex justify-content-center p-3'>
    <a href='carrello.php' class='btn btn-primary'> Carrello </a>
    </div>";

    // Chiudi la connessione
    $conn->close();

    ?>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

</html>