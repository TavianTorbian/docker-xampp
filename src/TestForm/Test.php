<?php
  echo "Tipo di richiesta: " . $_SERVER['REQUEST_METHOD'] . "<br>";
  echo "<br>";

  echo "Contenuto della richiesta:<br>";
  if ($_SERVER['REQUEST_METHOD'] === 'GET')
  {
    echo "GET: ";
    print_r($_GET);

    //visualizza i dati ricevuti dalla post/get
    //iterando gli elementi dell'array associativo
    foreach($_GET as $key=>$value)
    {
        echo "$key=$value";
        echo "<br>";
    }
  }
  elseif ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
    echo "POST: ";
    print_r($_POST);

    //visualizza i dati ricevuti dalla post/get
    //iterando gli elementi dell'array associativo
    foreach($_POST as $key=>$value)
    {
        echo "$key=$value";
        echo "<br>";
    }
  }