<?php
class UserController{
    protected $model;
    public function __construct(){
        require_once __DIR__ . '/../models/Usermodel.php';
        $this->model = new UserModel();
    }

    public function registerForm(){
        require __DIR__ . '/../views/auth/register.php';
    }

    public function registerSubmid(){
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            header("Location: index.php?action=register");
            exit;
        }

        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['confirm'] ?? '';

        if($username === ''){
            $err = "Tên tài khoản không được để trống";
            require __DIR__ . '/../views/auth/register.php';
            return;
        }
        if(mb_strlen($username) < 3 || mb_strlen($username) > 30){
            $err = "Độ dài tài khoản phải từ 3 đến 30 ký tự";
            require __DIR__ . '/../views/auth/register.php';
            return;
        }

        if($password !== $confirm){
            $err = "Mật khẩu xác nhận không khớp.";
            require __DIR__ . '/../views/auth/register.php';
            return;
        }

        $existing = $this->model->getByUsername($username);
        if($existing){
            $err = "Tên tài khoản đã tồn tịa, vui lòng sử dụng tên khác.";
            require __DIR__ . '/../views/auth/register.php';
            return;
        }

        $ok = $this->model->register($username, $password);
        if($ok){
            $_SESSION['success'] = "Đăng ký thành công!";
            header("Location: index.php?action=login");
            exit;
        } else{
            $err = "Đăng ký thất bại (username có thể đã tồn tại).";
            require __DIR__ . '/../views/auth/register.php';
        }
    }

    public function loginForm(){
        require __DIR__ . '/../views/auth/login.php';
    }

    public function loginSubmit(){
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            header("Location: index.php?action=login");
            exit;
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->model->login($username, $password);

        if($user === 'locked'){
            $error = "Tài khoản của bạn đã bị khóa.";
            require __DIR__ . '/../views/auth/login.php';
        }elseif($user){
            $_SESSION['user'] = $user;

            if($user['role'] === 'admin') {
                header('Location: index.php?action=productadmin');
            } else{
                header('Location: index.php?action=home');
            }
            exit;
        } else{
            $error = "Tên tài khoản hoặc mật khẩu không chính xác";
            require __DIR__ . '/../views/auth/login.php';
        }
    }
    public function logout(){
        session_unset();
        session_destroy();
        header("Location: index.php?action=home");
        exit;
    }

    public function account(){
        if(!isset($_SESSION['user'])){
            header('Location: index.php?action=login');
            exit;
        }
        require __DIR__ . '/../views/auth/account.php';
    }

    public function updateProFile(){
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            header('Location: index.php?action=account');
            exit;
        }

        if(!isset($_SESSION['user'])){
            header('Location: index.php?action=login');
            exit;
        }

        $id = intval($_POST['username'] ?? '');
        $username = trim($_POST['username'] ?? '');

        if($username === ''){
            $_SESSION['error'] = 'Tên không được để trống';
            header('Location: index.php?action=account');
            exit;
        }

        $existing = $this->model->getByUsername($username);
        if($existing && $existing['id'] != $id){
            $_SESSION['error'] = 'Tên đăng nhập đã tồn tại';
            header('Location: index.php?action=account');
            exit;
        }

        $role = $_SESSION['user']['role'] ?? 'user';
        $address = trim($_POST['address'] ?? '');

        $ok = $this->model->updateUser($id,$username,null,$role,$address);
        if($ok){
            $_SESSION['user']['username'] = $username;
            $_SESSION['user']['address'] = $address;
            $_SESSION['success'] = 'Cập nhật tên thành công';
        } else{
            $_SESSION['error'] = 'Cập nhật  thất bại';
        }
        header('Location: index.php?action=account');
        exit;
    }

    public function changePassword(){
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            header('Location: index.php?action=account');
            exit;
        }

        if(!isset($_SESSION['user'])){
            header('Location: index.php?action=login');
            exit;
        }

        $id = intval($_POST['id']);
        $current = $_POST['current_password'] ?? '';
        $new = $_POST['new_password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        if($new === '' || $current ===''){
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin';
            header('Location: index.php?action=account');
            exit;
        }
        if($new !== $confirm){
            $_SESSION['error'] = 'Mật khẩu xác nhận không khớp';
            header('Location: index.php?action=account');
            exit;
        }

        $userDb = $this->model->getByUsername($_SESSION['user']['username']);
        if(!$userDb){
            $_SESSION['error'] = 'Mật khẩu hiện tại không đúng.';
            header('Location: index.php?action=account');
            exit;
        }

        $role = $_SESSION['user']['role'] ?? 'user';
        $ok = $this->model->updateUser($id, $userDb['username'], $new, $role);
        if($ok){
          $_SESSION['success'] = 'Đổi mật khẩu thành công';
        } else {
            $_SESSION['error'] = 'Đổi mật khẩu thất bại';
        }
        header('Location: index.php?action=account');
        exit;
    }

    public function updateAddress(){
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?action=account');
            exit;
        }

        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $id = intval($_POST['id'] ?? 0);
        $address = trim($_POST['address'] ?? '');

        if ($id <= 0) {
            $_SESSION['error'] = 'Dữ liệu không hợp lệ';
            header('Location: index.php?action=account');
            exit;
        }

        $username = $_SESSION['user']['username'] ?? '';
        $role = $_SESSION['user']['role'] ?? 'user';

        $ok = $this->model->updateUser($id, $username, null, $role, $address );
        if($ok){
            $_SESSION['user']['address'] = $address;
            $_SESSION['success'] = 'Cập nhật địa chỉ thành công.';
        }else{
            $_SESSION['error'] = 'Cập nhật địa chỉ thất bại';
        }
        header('Location: index.php?action=account');
        exit;
    }
}