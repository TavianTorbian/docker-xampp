<?php
    echo "richiesta POST";
    var_dump($_POST);
    if($_POST && isset($_POST['submit'])){
        var_dump($_FILES);
        var_dump($_FILES['file1']);

        $contenuto = file_get_contents($_FILES['file1']['tmp_name']);    

        $contenuto2=json_decode($contenuto,true);
        var_dump($contenuto2);

        foreach($contenuto2 as $key=>$value){
            var_dump($key);
            var_dump($value);
        }
    }
?>

<!DOCTYPE html>
<html>
    <body>
        <form action="" method="post" enctype="multipart/form-data">
        Select image to upload:
            <input type="file" name="file1" id="file1">
            <input type="file" name="file2" id="file2">
            <input type="submit" value="Upload Image" name="submit">
        </form>
    </body>
</html>