<body>
<?php

if (isset($_POST['submit'])){

  $nowalinia = "\n";
    $cmd=$_POST['cmd'];
$string_h = htmlspecialchars($cmd);

    @$plik=fopen('linie.txt','a');
    if (!$plik)
    {
      echo 'Wystąpił błąd podczas otwierania pliku!';
      exit;
    }

    if (!flock($plik, LOCK_EX))
    {
      echo 'Wystapił błąd podczas zakładania blokady pliku!';
      fclose($plik);
      exit;
    }

    fwrite($plik,$string_h);
    fwrite($plik,$nowalinia);
    flock($plik, LOCK_UN);
    fclose($plik);
    echo 'Operacja zapisywania danych zakończona sukcesem!';
echo "<meta http-equiv=\"refresh\" content=\"1\" >";
}

else {


echo  '<form action="index.php" method="post">
    <input type="text" name="cmd" />
    <input type="submit" name="submit"  value="Add task" />
  </form>';

}




$file = file('linie.txt');
$handle = fopen('linie.txt', "w");
$linia =  $_GET['del'];
$liniaplus = $linia - 1;

unset($file[$liniaplus]);

$newFileContent = implode("\r", $file);
fwrite($handle, $newFileContent);
fclose($handle);

echo "<table>\n";
echo "<tr><td>Nr</td><td>Task</td><td>Del</td></tr>\n";


      $plik = 'linie.txt';


      $tekst = file($plik);


  $i=1;


      foreach ($tekst as $linijka) {



      $kolorowo = "<tr><td>" . $i . ":</td><td>" . str_replace("\n", "", $linijka) . "</td><td> => <a href=index.php?del=$i>del</a></td></tr>\n";

       $i++;
 echo $kolorowo;
      }


echo "</table>";


      ?>
</body>
