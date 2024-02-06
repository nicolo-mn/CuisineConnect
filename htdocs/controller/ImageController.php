<?php

require_once "./core/Controller.php";
class ImageController extends Controller{
    private const UPLOAD_DIR = "pub/media/";

    public function addImage($image) {
        var_dump($image);
        $imageName = hash_file("sha256", $image["tmp_name"]);
        $path = self::UPLOAD_DIR.$imageName.".".pathinfo($image["name"], PATHINFO_EXTENSION);

        $maxKB = 5000;
        $acceptedExtensions = array("jpg", "jpeg", "png", "gif");
        $result = 0;
        $msg = "";
        //Controllo se immagine è veramente un'immagine
        $imageSize = getimagesize($image["tmp_name"]);
        if($imageSize === false) {
            $msg .= "File caricato non è un'immagine! ";
        }
        //Controllo dimensione dell'immagine < 500KB
        if ($image["size"] > $maxKB * 1024) {
            $msg .= "File caricato pesa troppo! Dimensione massima è $maxKB KB. ";
        }

        echo "filename 1 ".$path;
        //Controllo estensione del file
        $imageFileType = strtolower(pathinfo($image["name"],PATHINFO_EXTENSION));
        if(!in_array($imageFileType, $acceptedExtensions)){
            $msg .= "Accettate solo le seguenti estensioni: ".implode(",", $acceptedExtensions);
        }

        //Controllo se esiste file con stesso nome ed eventualmente lo rinomino
        if (file_exists($path)) {
            $i = 1;
            do{
                $i++;
                $imageName = pathinfo(basename($image["name"]), PATHINFO_FILENAME)."_$i.".$imageFileType;
            }
            while(file_exists($path.$imageName));
        }
        echo "filename 1 ".$path;
        //Se non ci sono errori, sposto il file dalla posizione temporanea alla cartella di destinazione
        if(strlen($msg)==0){
            if(!move_uploaded_file($image["tmp_name"], $path)){
                $msg.= "Errore nel caricamento dell'immagine.";
            }
            else{
                $result = 1;
                $msg = $path;
            }
        }
        return array($result, $msg);
    }
}