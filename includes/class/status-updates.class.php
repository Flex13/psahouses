<?php


class PostStatus
{
    //Student Insert Status
    public static function insertStatus()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            global $success, $errors;
            if (Login::isLoggedIn()) {
                $userID = Login::isLoggedIn();
                $username = DB::query('SELECT username FROM users WHERE user_id=:user_id', array(':user_id' => $userID));
                $country = DB::query('SELECT country FROM users WHERE user_id=:user_id', array(':user_id' => $userID));
            } else {
                array_push($errors, "Please Register to Post");
                Redirect::redirect_to("community.php");
            }

            global $errors;

            $status_description            = test_input($_POST['status_description']);
            $image          =   $_FILES["upload_image"]["name"];
            $tmp_image      =   $_FILES["upload_image"]["tmp_name"];
            $size_image     =   $_FILES["upload_image"]["size"];
            $datetime        = current_date();



            if (strlen($status_description) > 150) {
                array_push($errors, "Post should not be more then 250 Characters");
            } else {
                if (strlen($image) >= 1 && strlen($status_description) >= 1) {
                    global $connect;

                    $img_ext = explode(".", $image);
                    $image_ext = $img_ext['1'];
                    $image = rand(1, 000) . rand(1, 100) . time() . "." . $image_ext;

                    if ($image_ext == 'jpg' || $image_ext == 'png' || $image_ext == 'PNG' || $image_ext == 'JPG' || !empty($_FILES["image"]["name"])) {

                        DB::query('INSERT INTO status_updates VALUES (\'\', :status_description,:status_date,:user_id,:country,:image,:username)', array(':status_description' => $status_description, ':status_date' => $datetime, ':user_id' => $userID, ':country' => $country, ':image' => $image, ':username' => $username));
                    }
                        move_uploaded_file($tmp_image, "images/statusUpdates/$image");
                        array_push($success, "Status Posted");
                        Redirect::redirect_to("community.php");
                } else {

                    if ($image == '' && $status_description == '') {
                        array_push($errors, "Something Went Wrong. Please insert something");
                    } else {
                        if ($status_description == '') {

                            $img_ext = explode(".", $image);
                            $image_ext = $img_ext['1'];
                            $image = rand(1, 000) . rand(1, 100) . time() . "." . $image_ext;

                            if ($image_ext == 'jpg' || $image_ext == 'png' || $image_ext == 'PNG' || $image_ext == 'JPG' || !empty($_FILES["image"]["name"])) {

                                DB::query('INSERT INTO status_updates VALUES (\'\', :status_description,:status_date,:user_id,:country,:image,:username)', array(':status_description' => $status_description, ':status_date' => $datetime, ':user_id' => $userID, ':country' => $country, ':image' => $image, ':username' => $username));

                               
                            }
                            move_uploaded_file($tmp_image, "images/statusUpdates/$image");

                            array_push($success, "Status Posted");
                            Redirect::redirect_to("community.php");
                        } else {

                            DB::query('INSERT INTO status_updates VALUES (\'\', :status_description,:status_date,:user_id,:country,:username)', array(':status_description' => $status_description, ':status_date' => $datetime, ':user_id' => $userID, ':country' => $country, ':username' => $username));
                            array_push($success, "Status Posted");
                            Redirect::redirect_to("community.php");
                        }
                    }
                }
            }
        
    } 
    }

}

