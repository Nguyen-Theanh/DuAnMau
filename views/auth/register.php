<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - Petzone</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #d0f0f8, #f9dfff);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .form-container {
            background: #fff;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            animation: fadeIn 0.4s ease-in-out;
        }

        .logo {
            text-align: center;
            font-size: 35px;
            font-weight: bold;
            color: #0ccee3;
            margin-bottom: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #444;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            outline: none;
            transition: border-color 0.3s;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #66b3ff;
        }

        button {
            width: 100%;
            padding: 10px;
            background: linear-gradient(to right, #66b3ff, #ff99cc);
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: linear-gradient(to right, #4da6ff, #ff66b3);
            transform: scale(1.02);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    
    </style>
</head>
<body>
    <div class="form-container">
        <a href="?action=home" style="text-decoration: none;">
            <div class="logo"><i class="fa-solid fa-paw"></i>Petzone</div>
        </a>
        <h2>Đăng ký tài khoản</h2>
        <?php if (!empty($err)) :?>
            <p style="color: red;"><?= htmlspecialchars($err) ?></p>
            <?php endif; ?>
        <form action="index.php?action=register_submit" method="post">
            <label>Tên tài khoản</label><br>
            <input type="text" name="username" required><br>
            <label>Mật khẩu</label><br>
            <input type="password" name="password" required><br>
            <label>Xác nhận lại mật khẩu</label><br>
            <input type="password" name="confirm" required><br><br>
            <button type="submit">Đăng ký</button>
        </form>
        <div style="display: flex; justify-content: center; margin-top: 15px;">
            <p style="margin: 0;">Đã có tài khoản <a href="index.php?action=login"
                    style="color: #66b3ff; text-decoration: none; font-weight: bold;"> Đăng nhập</a></p>
        </div>
        <?php if(!empty($error))
        echo "<p style='color:red;'>$error</p>"; ?>
    </div>
</body>
</html>