<?php 
class Usermodel{
    protected $pdo;

    public function __construct(){
        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8mb4', DB_HOST, DB_NAME);
        try{
            $this->pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD, DB_OPTIONS );
        } catch (PDOException $e){
            die("Kết nối cơ sở dữ liệu thất bại: " . $e->getMessage());
        }
    }

    public function register($username, $password, $role = 'user'){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password, role) 
                VALUES (:username, :password, :role)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':username' => $username,
            ':password' => $hash,
            ':role' => $role
        ]);
    }

    public function login($username, $password){
        $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user){
            if($user['is_locked'] == 1){
                return 'locked';
            }
            if(password_verify($password,$user['password'])){
                unset($user['password']);
                return $user;
            }
        }
        return false;
    }

    public function getByUsername($username){
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers(){
        $sql = "SELECT id, username, role, created_at, address, is_locked 
                FROM users 
                ORDER BY created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);      
    }

    public function getUserById($id){
        $sql= "SELECT id,username, role, created_at, address 
                FROM users
                WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function updateUser($id, $username, $password = null, $role = 'user'){
        $args = func_get_args();
        $address = '';
        if(isset($args[4])){
            $address = $args[4];
            $addressProvided = true;
        }

        if(!$addressProvided){
            $stmtAddr = $this->pdo->prepare("SELECT address FROM users WHERE id = ?");
            $stmtAddr->execute(([$id]));
            $rowAddr = $stmtAddr->fetch(PDO::FETCH_ASSOC);
            $address = $rowAddr['address'] ?? '';
        }

        if($password){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET username = :username, password = :password, role = :role, address = :address
                    WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                ':username' => $username,
                ':password' => $hash,
                ':role' => $role,
                ':address' => $address,
                ':id' => $id
            ]);
        }else{
            $sql = "UPDATE users SET username = :username, role = :role, address = :address 
                    WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                ':username' => $username,
                ':role' => $role,
                ':address' => $address,
                ':id' => $id
            ]);
        }
    }
    
}