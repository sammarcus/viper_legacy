<?php
/*
Purpose: To duplicate the app/code/core/Mage/ folder
         (folders only, no files) structure
         to /app/code/local/Mage/
*/
error_reporting(E_ALL);
function dupCodeDirsNoFiles($dir) {
    global $root;
    $listing = opendir($dir);
    while(($entry = readdir($listing)) !== false) {
        if ($entry != "." && $entry != "..") {
            $coreItem = "$dir/$entry";
            if (is_dir($coreItem)) {
                $localItem=str_replace("$root/core/Mage","$root/local/Mage",$coreItem);
                if(!file_exists($localItem)){
                    echo "Creating: $localItem";
                    $old_umask = umask(0);
                    mkdir($localItem,0755,true);
                    umask($old_umask);
                } else {
                    echo "Exists: $localItem";
                }
                dupCodeDirsNoFiles($coreItem);
            }
        }
    }
}
if(file_exists(getcwd().'/app/code/core/Mage/')){
    dupCodeDirsNoFiles(getcwd().'/app/code/core/Mage');
    echo "Process Complete.";
} else {
    echo "Please verify that you have this script in the root folder of your Magento installation.";
}
?> 