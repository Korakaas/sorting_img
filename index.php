<?php
require('class/Image.php');
require('config.php');
require('process_sortimg.php');
if(isset ($msg_error))
{
    echo $msg_error;
}
if(isset ($msg_success))
{
    echo $msg_success;
}
?>
<form method="GET">
<input type="submit" name="formImageSorting" value="Trier les images">
</form>



