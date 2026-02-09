<?php
    echo "richiesta POST";
    var_dump($_POST);

    if($_POST && isset($_POST['submit']) && isset($_FILES)){

        var_dump($_FILES);

        if(isset($_FILES['file1'])){
            var_dump($_FILES['file1']);
            $path = $_FILES['file1']['tmp_name'];

            if(file_exists($path)){
                $contenuto = file_get_contents($_FILES['file1']['tmp_name']);    

                $contenuto2=json_decode($contenuto,true);
                var_dump($contenuto2);
    
                foreach ($contenuto2 as $key => $value){
                    var_dump($key);
                    var_dump($value);
                }
            }else{
                echo "File 1 non trovato!";
            }
        }
        if(isset($_FILES['file2'])){
            var_dump($_FILES['file2']);
            $path = $_FILES['file2']['tmp_name'];

            if(file_exists($path)){

                move_uploaded_file($path,'./mtcars');

            }else{
                echo "File 2 non trovato!";
            }
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