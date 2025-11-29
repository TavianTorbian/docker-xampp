<?php
  echo "Tipo di richiesta: " . $_SERVER['REQUEST_METHOD'] . "<br>";
  echo "<br>";

  echo "Visualizzazione della varabile \$_REQUEST con echo:<br>";
  echo "$_REQUEST<br>";
  echo "<br>";

  echo "Visualizzazione della varabile \$_REQUEST con print_r():<br>";
  print_r($_REQUEST);
  echo "<br><br>";

  echo "Visualizzazione della varabile \$_REQUEST con var_dump():<br>";
  var_dump($_REQUEST);
  echo "<br><br>";

  echo "Contenuto della richiesta:<br>";
  if ($_SERVER['REQUEST_METHOD'] === 'GET')
  {
    echo "GET:<br>";
    print_r($_GET);

    foreach($_GET as $key=>$value)
    {
        echo "$key=$value";
        echo "<br>";
    }
    echo "Login Effettuato!"
  }
  elseif ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
    echo "POST:<br>";
    print_r($_POST);

    foreach($_POST as $key=>$value)
    {
        echo "$key=$value";
        echo "<br>";
    }
    echo "Login Effettuato!"
  }