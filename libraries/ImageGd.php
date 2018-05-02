<?php

class ImageGdCore {

    public function __construct() {
        
    }

    public function load($filename) {
        $image_info = getimagesize($filename);
        if (empty($image_info)) {
            return "NOTAVAIL";
        }
        $this->image_type = $image_info[2];

        if ($this->image_type == IMAGETYPE_JPEG) {

            $this->image = imagecreatefromjpeg($filename);
        } elseif ($this->image_type == IMAGETYPE_GIF) {

            $this->image = imagecreatefromgif($filename);
        } elseif ($this->image_type == IMAGETYPE_PNG) {

            $this->image = imagecreatefrompng($filename);
        }
    }

    public function save($filename, $image_type = IMAGETYPE_JPEG, $compression = 75, $permissions = null) {
        if ($permissions != null) {

            chmod($filename, $permissions);
        }
        if ($image_type == IMAGETYPE_JPEG) {
            return imagejpeg($this->image, $filename, $compression);
        } elseif ($image_type == IMAGETYPE_GIF) {

            return imagegif($this->image, $filename);
        } elseif ($image_type == IMAGETYPE_PNG) {

            return imagepng($this->image, $filename);
        }
        
    }

    public function output($image_type = IMAGETYPE_JPEG) {

        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image);
        } elseif ($image_type == IMAGETYPE_GIF) {

            imagegif($this->image);
        } elseif ($image_type == IMAGETYPE_PNG) {

            imagepng($this->image);
        }
    }

    public function getWidth() {

        return imagesx($this->image);
    }

    public function getHeight() {

        return imagesy($this->image);
    }

    public function resizeToHeight($height) {

        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize($width, $height);
    }

    public function resizeToWidth($width) {
        $ratio = $width / $this->getWidth();
        $height = $this->getheight() * $ratio;
        $this->resize($width, $height);
    }

    public function scale($scale) {
        $width = $this->getWidth() * $scale / 100;
        $height = $this->getheight() * $scale / 100;
        $this->resize($width, $height);
    }

    public function resize($width, $height) {
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->image = $new_image;
    }

    public function resizeTransparentImage($width, $height) {
        $new_image = imagecreatetruecolor($width, $height);
        if ($this->image_type == IMAGETYPE_GIF || $this->image_type == IMAGETYPE_PNG) {
            $current_transparent = imagecolortransparent($this->image);
            if ($current_transparent != -1) {
                $transparent_color = imagecolorsforindex($this->image, $current_transparent);
                $current_transparent = imagecolorallocate($new_image, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
                imagefill($new_image, 0, 0, $current_transparent);
                imagecolortransparent($new_image, $current_transparent);
            } elseif ($this->image_type == IMAGETYPE_PNG) {
                imagealphablending($new_image, false);
                $color = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
                imagefill($new_image, 0, 0, $color);
                imagesavealpha($new_image, true);
            }
        }
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->image = $new_image;
    }

    public function makeUrlForImage($idimage) {
        $path = implode("/", str_split($idimage));
        if (!mkdir(_PS_IMG_DIR_ . "p/" . $path . "/", 0777, true)) {
            $this->error[] = "Failed to create folders";
        }
        return _PS_IMG_DIR_ . "p/" . $path . "/";
    }

    public function makeUrlForProfile($id) {
        $path = implode("/", str_split($id));
        if (is_dir(_PS_IMG_DIR_ . "profileimg/" . $path . "/")) {
            return _PS_IMG_DIR_ . "profileimg/" . $path . "/";
        } else {
            if (!mkdir(_PS_IMG_DIR_ . "profileimg/" . $path . "/", 0777, true)) {
                Restapi::makeJson("300", "failed to creat folder");
                die;
            }
            return _PS_IMG_DIR_ . "profileimg/" . $path . "/";
        }
    }
    
     public function makeUrlForTagDeal($id) {
        $path = implode("/", str_split($id));
        if (is_dir(_PS_IMG_DIR_ . "tagdeal/" . $path . "/")) {
            return _PS_IMG_DIR_ . "tagdeal/" . $path . "/";
        } else {
            if (!mkdir(_PS_IMG_DIR_ . "tagdeal/" . $path . "/", 0777, true)) {
                Restapi::makeJson("300", "failed to creat folder");
                die;
            }
            return _PS_IMG_DIR_ . "tagdeal/" . $path . "/";
        }
    }

    public function makeUrlForGroup($id) {
        $path = implode("/", str_split($id));
        if (is_dir(_PS_IMG_DIR_ . "groupimg/" . $path . "/")) {
            return _PS_IMG_DIR_ . "groupimg/" . $path . "/";
        } else {
            if (!mkdir(_PS_IMG_DIR_ . "groupimg/" . $path . "/", 0777, true)) {
                Restapi::makeJson("300", "failed to creat folder");
                die;
            }
            return _PS_IMG_DIR_ . "groupimg/" . $path . "/";
        }
    }

 

    public function makeUrlForChatFiles($id) {
        $path = implode("/", str_split($id));
        if (is_dir(_PS_IMG_DIR_ . "chatfiles/" . $path . "/")) {
            return _PS_IMG_DIR_ . "chatfiles/" . $path . "/";
        } else {
            if (!mkdir(_PS_IMG_DIR_ . "chatfiles/" . $path . "/", 0777, true)) {
                Restapi::makeJson("300", "Failed to create folder");
                die;
            }
            return _PS_IMG_DIR_ . "chatfiles/" . $path . "/";
        }
    }

    public function makeUrlForGroupChatFiles($id) {
        $path = implode("/", str_split($id));
        if (is_dir(_PS_IMG_DIR_ . "groupchatfiles/" . $path . "/")) {
            return _PS_IMG_DIR_ . "groupchatfiles/" . $path . "/";
        } else {
            if (!mkdir(_PS_IMG_DIR_ . "groupchatfiles/" . $path . "/", 0777, true)) {
                Restapi::makeJson("300", "Failed to create folder");
                die;
            }
            return _PS_IMG_DIR_ . "groupchatfiles/" . $path . "/";
        }
    }

    public function checkImageExtension($str) {
        $i = strrpos($str, ".");
        if (!$i) {
            return "";
        }
        $l = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return $ext;
    }

    public static function removeProductImg($id_image) {
        $sql = "DELETE FROM `" . _DB_PREFIX_ . "image` WHERE `id_image` = " . $id_image;
        $result = Db::getInstance()->execute($sql);
        $sql = "DELETE FROM `" . _DB_PREFIX_ . "image_lang` WHERE `id_image` =" . $id_image;
        $result = Db::getInstance()->execute($sql);
        $sql = "DELETE FROM `" . _DB_PREFIX_ . "image_shop` WHERE `id_image` =" . $id_image;
        $result = Db::getInstance()->execute($sql);
        return TRUE;
    }

}
