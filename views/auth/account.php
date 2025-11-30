<?php
if(!isset($_SESSION['user'])){
    header('Location: index.php?action=login');
    exit;
}
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý tài khoản - <?= htmlspecialchars($user['username']) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<style>
        body {
            font-family: Arial, sans-serif;
            background: #f6f9fc;
            margin: 0;
        }

        .card {
            max-width: 700px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        }

        h2 {
            margin-top: 0;
            color: #333;
            margin-bottom: 20px;
        }

        h3 {
            margin-top: 0;
            margin-bottom: 15px;
            color: #444;
        }

        label {
            display: block;
            margin: 15px 0 6px;
            color: #555;
            font-weight: bold;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            box-sizing: border-box;
        }

        input[type=text]:focus,
        input[type=password]:focus {
            outline: none;
            border-color: #0ccee3;
            box-shadow: 0 0 0 2px rgba(12, 206, 227, 0.2);
        }

        button {
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            background: #0ccee3;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
            transition: background 0.3s;
        }

        button:hover {
            background: #0ab7cc;
        }

        .danger {
            background: #e74c3c;
        }

        .danger:hover {
            background: #c0392b;
        }

        .row {
            display: flex;
            gap: 12px;
            margin-top: 15px;
        }

        .hint {
            color: #666;
            font-size: 13px;
            margin-top: 5px;
            font-style: italic;
        }

        .section {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .message-success {
            background: #d4edda;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .message-error {
            background: #f8d7da;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .toggle-btn {
            background: #6c757d;
            margin-bottom: 15px;
        }

        .toggle-btn:hover {
            background: #5a6268;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .logout-section {
            text-align: right;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../partials/header.php'; ?>

    <div class="card">
        <h2>Quản lý tài khoản</h2>

        <?php if (!empty($_SESSION['success'])) : ?>
            <div class="message-success">
                <?= htmlspecialchars($_SESSION['success']) ?>
            </div>
            <?php unset($_SESSION['success']); endif; ?>

        <?php if (!empty($_SESSION['error'])) : ?>
            <div class="message-error">
                <?= htmlspecialchars(($_SESSION['error'])) ?>
            </div>
            <?php unset($_SESSION['error']); endif; ?>

        <h3>Thông tin tài khoản</h3>
        <form action="index.php?action=update_profile" method="post">
            <div class="form-group">
                <label for="username">Tên hiển thị</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
                <input type="hidden" name="id" value="<?= intval($user['id']) ?>">
                <button type="submit">Cập nhật tên</button>
            </div>
        </form>
        <div class="row" style="margin-bottom: 20px;">
            <button id="toggleAddress" class="toggle-btn" type="button" style="margin-top:0;">Chỉnh sửa địa chỉ</button>
            <button id="togglePassword" class="toggle-btn" type="button" style="margin-top:0;">Đổi mật khẩu</button>
        </div>

        <div id="addressSection" class="section" style="display:none; margin-top:0;">
            <form action="index.php?action=update_address" method="post">
                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <input type="text" id="address" name="address"
                        value="<?= isset($user['address']) ? htmlspecialchars($user['address']) : '' ?>">
                        <input type="hidden" name="id" value="<?= intval($user['id']) ?>">
                    <button type="submit">Cập nhật địa chỉ</button>
                </div>
            </form>
        </div>
        <div id="passwordSection" class="section" style="display:none; margin-top:0;">
            <h3>Đổi mật khẩu</h3>
            <form action="index.php?action=change_password" method="post">
                <input type="hidden" name="id" value="<?=intval($user['id']) ?>">

                <div class="form-group">
                    <label for="current_password">Mật khẩu hiện tại</label>
                    <input type="password" id="current_password" name="current_password" required>
                </div>

                <div class="form-group">
                    <label for="new">Mật khẩu mới</label>
                    <input type="password" name="new_password" id="new" required>
                </div>

                <div class="form-group">
                    <label for="confirm">Xác nhận mật khẩu mới</label>
                    <input type="password" id="confirm" name="confirm_password" required>
                </div>

                <div>
                    <button type="submit">Đổi mật khẩu</button>
                </div>
            </form>
        </div>
        <div class="section logout-section">
            <a href="index.php?action=logout"><button class="danger">Đăng xuất</button></a>
        </div>

    <script>
        document.getElementById('toggleAddress').addEventListener('click', function() {
            var section = document.getElementById('addressSection');
            if (section.style.display === 'none' || section.style.display === '') {
                section.style.display = 'block';
                this.textContent = 'Ẩn địa chỉ';
            } else {
                section.style.display = 'none';
                this.textContent = 'Chỉnh sửa địa chỉ';
            }
        });

        document.getElementById('togglePassword').addEventListener('click',function() {
            var section = document.getElementById('passwordSection');
            if(section.style.display === 'none' || section.style.display === ''){
                section.style.display = 'block';
                this.textContent = 'Ẩn đổi mật khẩu';
            } else {
                section.style.display = 'none';
                this.textContent = 'Đổi mật khẩu';
            }
        });
        </script>
    </div>
</body>
</html>