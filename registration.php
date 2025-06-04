<?php

$replyBack = '';
session_unset();

if (isset($_POST['register']) && isset($_FILES['image']['name'])) {
    $replyBack = 'all is ok';
    unset($_POST['register']);
    if (!empty($_POST['name'])) {

        if (strlen($_POST['name']) <= 64) {
            $_SESSION['name'] = $_POST['name'];

            if (!empty($_POST['email'])) {

                if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['email'] = $_POST['email'];

                    if (!empty($_POST['password'])) {

                        if (strlen($_POST['password']) >= 8) {

                            if (preg_match('/[A-Z]/', $_POST['password'])) {

                                if (preg_match('/[a-z]/', $_POST['password'])) {

                                    if (preg_match('/[0-9]/', $_POST['password'])) {
                                        $_SESSION['password'] = $_POST['password'];

                                        if ($_POST['password'] === $_POST['confirm_password']) {
                                            $_SESSION['confirm_password'] = $_POST['confirm_password'];

                                            if (!empty($_FILES['image']['name'])) {
                                                $filename = $_FILES['image']['name'];
                                                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                                                if ($ext == 'jpg' || $ext == 'png') {

                                                    if ($_FILES['image']['size'] <= 512000) {
                                                        $imgName = md5(date("Y-m-d H:i:s") . $filename) . '.' . $ext;
                                                        $path = dirname(__FILE__) . '/uploads/';
                                                        $src = $path . $imgName;

                                                        if (move_uploaded_file($_FILES['image']['tmp_name'], $src)) {
                                                            session_unset();
                                                            $replyBack = 'upload file';
                                                        } else {
                                                            $replyBack = 'image no upload';
                                                        }
                                                    } else {
                                                        $replyBack = 'Invalid image size';
                                                    }
                                                } else {
                                                    $replyBack = 'Invalid image form';
                                                }
                                            } else {
                                                $replyBack = 'image field empty';
                                            }
                                        } else {
                                            $replyBack = 'password must match';
                                        }
                                    } else {
                                        $replyBack = 'password must contain at least one number';
                                    }
                                } else {
                                    $replyBack = 'password must contain at least one lowercase letter';
                                }
                            } else {
                                $replyBack = 'password must contain at least one uppercase letter';
                            }
                        } else {
                            $replyBack = 'password length < 8';
                        }
                    } else {
                        $replyBack = 'password empty';
                    }
                } else {
                    $replyBack = 'email is wrong';
                }
            } else {
                $replyBack = 'email field empty';
            }
        } else {
            $replyBack = 'name is too long';
        }
    } else {
        $replyBack = 'name field empty';
    }
    $_SESSION['message'] = $replyBack;
    header('Location: http://localhost:8000/index.php');
}