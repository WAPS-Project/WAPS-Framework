<?php


namespace webapp_php_sample_class;


class build
{
    public static function copyFiles($source, $dest)
    {
        if(is_dir($source)) {
            $dir_handle=opendir($source);
            while($file=readdir($dir_handle)){
                if($file!="." && $file!=".."){
                    if(is_dir($source."/".$file)){
                        if(!is_dir($dest."/".$file)){
                            mkdir($dest."/".$file);
                        }
                        copy($source."/".$file, $dest."/".$file);
                    } else {
                        copy($source."/".$file, $dest."/".$file);
                    }
                }
            }
            closedir($dir_handle);
        } else {
            copy($source, $dest);
        }
    }

}