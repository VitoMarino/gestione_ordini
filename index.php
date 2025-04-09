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
// Dati di connessione
$host = "localhost";
$utente = "root";
$password = "root";
$nomeDatabase = "ordini";

// Creazione della connessione
$conn = new mysqli($host, $utente, $password, $nomeDatabase);

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Se la connessione ha avuto successo
// echo "Connessione al database riuscita!";

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
        "<tr>
            <td>" . $row['nome'] . " </td> 
            <td>" . $row['prezzo'] . "</td>
            <td>" . $row['quantita_disponibile'] . "</td>
            <td>" . "<i class='fa-solid fa-cart-shopping'></i>" . "</td>
        </tr>";
    }

    "</table>";
} else {
    echo "Nessun prodotto trovato";
}

// Chiudi la connessione
$conn->close();
?>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

</html>

