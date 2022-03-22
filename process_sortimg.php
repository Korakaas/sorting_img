<?php
//var_dump($_GET);
if(!isset($_GET['formImageSorting']))
{
    $error_msg = 'Aucune donnée n\'est fournie.';
}
else
{
    $imageDir = new ImageDir;
    $foldernames = $imageDir->getImages(IMAGE_DIR_PATH);
    
    //var_dump($foldernames['clean']);
if(isset($foldernames))
{


    foreach ($foldernames['clean'] as $foldername)
    {
        //echo $foldername;
        $imageDir = $imageDir->createDir($foldername);
        foreach ($foldernames['raw'] as $filename)
        {
            $imageDir = new ImageDir;
            //echo $filename;   
            $source = IMAGE_DIR_PATH . $filename;
            $destination = $_SERVER['DOCUMENT_ROOT'] . '/' . WEB_DIR_NAME . '/img/' .$foldername . '/'. $filename;
            //var_dump($source);
            //var_dump($destination);
            $checkDirName = strpos($filename,$foldername);
            if ($checkDirName !== false)
            {
                $imageCopy = $imageDir->copyImage($source,$destination); 
                $deleteImage = $imageDir->deleteImage($filename);
                $msg_success = ' Les images ont bien été triées';
               

            }
        }       
    }

echo '<a href="'. $_SERVER['HTTP_REFERER'].'">Retour</a>';
}
}