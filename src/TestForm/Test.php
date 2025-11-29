<?php
  echo "Tipo di richiesta: " . $_SERVER['REQUEST_METHOD'] . "<br>";
  echo "<br>";

  if ($_SERVER['REQUEST_METHOD'] === 'GET')
  {
    echo "Login Effettuato!";
  }
  elseif ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
    echo "Login Effettuato!";
  }
