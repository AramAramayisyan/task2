<?php

class Registration extends Validate
{
    public $replyBack;
    public function start($post = null, $file = null)
    {
        if ($post != null) {
            $this->replyBack['name'] = $this->nameValidate($post['name']);
            $this->replyBack['email'] = $this->emailValidate($post['email']);
            $this->replyBack['password'] = $this->passwordValidate($post['password'], $post['confirm_password']);
        }
        if ($file != null) {
            $this->replyBack['image'] = $this->imageUpload($file['image']);
        }
        $this->sendMessage($this->replyBack);
    }
}

class Validate
{
    private $hasName = false;
    private $hasEmail = false;
    private $hasPass = false;

    public function nameValidate($name)
    {
        if (!empty($name)) {
            $_SESSION['name'] = $name;
            if (strlen($name) < 64) {
                $this->hasName = true;
                return null;
            } else {
                return 'name is too long';
            }
        } else {
            return 'name is required';
        }
    }

    public function emailValidate($email) {
        if (!empty($email)) {
            $_SESSION['email'] = $email;
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->hasEmail = true;
                return null;
            } else {
                return 'email is invalid';
            }
        } else {
            return 'email is required';
        }
    }

    public function passwordValidate($password, $confirm_password)
    {
        if (empty($password)) {
            $this->hasPass = true;
            return 'password is required';
        }

        if (empty($confirm_password)) {
            $this->hasPass = true;
            return 'confirm password is required';
        }

        if (!$this->hasPass) {
            $_SESSION['password'] = $password;
            $_SESSION['confirm_password'] = $confirm_password;
            if (strlen($password) >= 8) {
                if (preg_match('/[A-Z]/', $password)) {
                    if (preg_match('/[a-z]/', $password)) {
                        if (preg_match('/[0-9]/', $password)) {
                            if ($password == $confirm_password) {
                                $this->hasPass = true;
                                return null;
                            } else {
                                return 'password must match';
                            }
                        } else{
                            return 'password must contain at least one number';
                        }
                    } else {
                        return 'password must contain at least one lowercase letter';
                    }
                } else {
                    return 'password must contain at least one uppercase letter';
                }
            } else {
                return 'The number of characters must be greater than eight.';
            }
        }
    }

    public function imageUpload($image)
    {
        if (!empty($image['name'])) {
            $filename = $image['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if ($ext == 'jpg' || $ext == 'png') {
                if ($image['size'] <= 512000) {
                    $imageName = md5(date("Y-m-d H:i:s") . $filename) . '.' . $ext;
                    $path = dirname(__FILE__) . '/uploads/';
                    $src = $path . $imageName;
                    if ($this->hasName && $this->hasEmail && $this->hasPass) {
                        if (move_uploaded_file($image['tmp_name'], $src)) {
                            $_SESSION['image'] = $imageName;
                            $_SESSION['success'] = true;
                        } else {
                            return 'image no upload';
                        }
                    }
                } else {
                    return 'Invalid image size';
                }
            } else {
                return 'Invalid image form';
            }
        } else {
            return 'image required';
        }
    }

    protected function sendMessage($message) {
        $_SESSION['message'] = $message;
        if ($_SESSION['success']) {
            header('Location: http://localhost:8000/user.php');

        } else {
            header('Location: http://localhost:8000/index.php');
        }
    }
}

if (isset($_POST['submit'])) {
    session_unset();
    $registration = new Registration();
    $registration->start($_POST, $_FILES);

}
