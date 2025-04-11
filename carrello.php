<?php
session_start();

if(!empty($_SESSION['prodotti'])) {
    echo 'Ciao' . $_SESSION['prodotti'];
};

echo "<a href='index.php' class='btn btn-primary'> Torna alla gestione degli ordini </a>"

?>