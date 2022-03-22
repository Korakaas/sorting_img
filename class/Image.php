<?php
class ImageDir
{
    public function getImages($image_dir_path)
    {
        $i = 0;
        if ($handle = opendir($image_dir_path))
        {
            //var_dump($handle);
            while (false!== ($entry = readdir($handle)))
            {
                if ($entry !="." && $entry!="..")
                {
                    $i++;
                    $filename= $entry;
                    //var_dump($filename)
                    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                    $valide = 'jpg';
                    if ($extension === $valide)
                    {
                        $foldername= $this->cleanName($filename);
                        //var_dump ($foldername);
                        $foldernames['clean'][$i] =$foldername;
                        $foldernames['raw'][$i] =$filename;
                    }

                }
            }
                $msg_error = 'Il n\'y a pas d\'images à trier. ';
                
                echo $msg_error;
                closedir($handle); 
                //var_dump ($foldernames);
            if (isset($foldernames))
            {
                return $foldernames;
            }
            echo '<a href="'. $_SERVER['HTTP_REFERER'].'">Retour</a>';
        }

    }
    public function cleanName($filename)
    {
        //var_dump($filename);
        $foldername= explode('_', $filename);
        //var_dump ($foldername[0]);
        return $foldername[0];

    }
    public function createDir($foldernames)
    {
        if(!is_dir('img/'.$foldernames))
        {
            if(!mkdir('img/'.$foldernames))
            {
                $msg_error = 'Il y a eu un problème lors de la crétaion du dossier';
            }    
        }
    }
    public function copyImage($source, $destination)
    {
        if (file_exists($source))
        {
            if (!copy($source, $destination)) 
            {  
                echo "Fichier non copié";  
            }   
        } 
        else
        {
            $msg_error[] = 'Le fichier image n\'existe pas';
        }   
    }
    public function deleteImage($filename)
    {
        $path_images= IMAGE_DIR_PATH . $filename;
        if (file_exists($path_images))
        {
            if(!unlink($path_images))
            {
                $msg_error[] = 'Une erreur est survenue lors de la suppression du fichier image';
            }
        }
        else
        {
            $msg_error[] = 'Le fichier image n\'existe pas';
        }
    }
}