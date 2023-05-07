<?php
session_start();
session_unset();
session_destroy();

// Redireciona para a página de login após o logout
header('Location: index.html');
exit();
?>