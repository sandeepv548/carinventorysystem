<?php

function p($data) {
    echo "<pre>";
    print_r($data);
    die;
}

function getValue($value) {
    return trim($_REQUEST[$value]);
}

function response($status, $msg, $data = FALSE) {
    $responseData['status'] = $status;
    $responseData['message'] = $msg;
    if ($data != FALSE) {
        $responseData['data'] = $data;
    }
    return json_encode(array('response' => $responseData));
}

function formValidation($formdataArray) {
    $errorMsg = array();
    foreach ($formdataArray as $key => $validRulesArr) {
        $value = getValue($key);
        $field_name = ucwords(str_replace('_', ' ', $key));
        if (in_array('required', $validRulesArr)) {
            if (empty($value)) {
                $errorMsg[] = $field_name . " is required";
                continue;
            }
        }
       /* if (in_array('vehicle_reg_number', $validRulesArr)) {
            $pattern = "/^[a-zA-z]{2}\s[0-9]{2}\s[0-9]{4}$/i";
            if (!preg_match($pattern, $value)) {
                $errorMsg[] = "Invalid $field_name";
                continue;
            }
        } */
    };
    return $errorMsg;
}

function activeLink($uri) {
    $url = explode('/', $_GET['url']);
    return ($uri == $url[0]) ? "active" : "";
}

function mulFileUpload($Inputfilename, $dir_path, $size_limit_inkb = FALSE, $ext_lim_arr = FALSE, $dimension_lim_arr = FALSE, $resize_width = FALSE) {
 
     $dir_path=_BASE_DIR_.'/'.$dir_path;
  // p($_FILES[$Inputfilename]);
    for($i=0; $i<count($_FILES[$Inputfilename]['name']); $i++) {
            $file_name ="car_imgs".$i;
        $msgtitle = ucwords(str_replace("_", " ", $Inputfilename));
        if (!is_dir($dir_path)) {
            mkdir($dir_path, 0777, true);
        }
// echo $dir_path; die;
        $file = $_FILES[$Inputfilename]['tmp_name'][$i];
        if (isset($file)) {
            $mimetype = $_FILES[$Inputfilename]['type'];
            if ($mimetype == "application/pdf") {
                $ext = ".pdf";
                $file_size = $_FILES[$Inputfilename]['size'][$i];
            } else {
                $size = getimagesize($file);
                $file_size = filesize($file);
                $width = $size[0];
                $height = $size[1];
                $ext = image_type_to_extension($size[2]);
            }
            if ($ext_lim_arr) {
                $extension = $ext_lim_arr;
                if (!in_array($ext, $extension)) {
                    $error =$msgtitle . " should be of type" . implode(", ", $extension);
                   
                }
            }
            //echo $file_size/1024;
            if ($size_limit_inkb) {
                if (($file_size/1024)> $size_limit_inkb) {
                    $error =$msgtitle . " should be less than " . $size_limit_inkb . "kb";
                     return $error;
                }
            }
            if (!empty($dimension_lim_arr['width'] && !empty($dimension_lim_arr['height'] && $ext != ".pdf"))) {
                $wid = $dimension_lim_arr['width'];
                $heig = $dimension_lim_arr['height'];
                if ($width < $wid || $height < $heig) {
                    $error ="Minimum Size of " . $msgtitle . " Should be " . $wid . "px in Width and " . $heig . "px in height";
                  return $error;
                }
            }
//            if ($dont_del_folfiles == FALSE) {
//                $deletefiles = glob($dir_path . "*");
//                foreach ($deletefiles as $value) {
//                    unlink($value);
//                }
//            }
//            if (file_exists($dir_path . $file_name . $ext)) {
//                unlink($dir_path . $file_name . $ext);
//            }
            $transfer = move_uploaded_file($file, $dir_path . $file_name . $ext);

            if (!$transfer) {
                $error[] ="Unable to Upload " . $msgtitle;
                return $error;
            } else {
                if ($ext == ".pdf") {
                    $save = 1;
                } else {
                    $imgobj = new ImageGdCore();
                    $imgobj->load($dir_path . $file_name . $ext);
                    $w = $imgobj->getWidth();
                    $h = $imgobj->getHeight();
                    if ($resize_width) {
                        $imgobj->resizeToWidth($resize_width);
                    }
                    $save = $imgobj->save($dir_path . $file_name . $ext);
                }
                if (!$save) {
                    $error = "Unable to Upload " . $msgtitle;
                     return $error;
                }
            }
        }
    }
      return $image[]=array('inputFile' => $file, 'regeneratedFile' => $file_name . $ext);
}
