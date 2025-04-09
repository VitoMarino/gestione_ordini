
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

// Chiudi la connessione
$conn->close();
?>