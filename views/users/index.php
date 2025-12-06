<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to right, #d0f0f8, #f9dfff);
            min-height: 100vh;
        }

        .container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .search-form {
            max-width: 400px;
        }
        
        .role-select-user {
            background-color: #d1ecf1;
            border-color: #0c5460;
            color: #0c5460;
        }

        .role-select-user:focus {
            background-color: #d1ecf1;
            border-color: #0c5460;
            color: #0c5460;
            box-shadow: 0 0 0 0.2rem rgba(23, 162, 184, 0.25);
        }

        .role-select-admin {
            background-color: #f8d7da;
            border-color: #721c24;
            color: #721c24;
        }

        .role-select-admin:focus {
            background-color: #f8d7da;
            border-color: #721c24;
            color: #721c24;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

    </style>
</head>
<body>
    <?php include __DIR__ . '/../partials/admin_header.php'; ?>

    <div class="container mt-4">
        <div class="header-actions">
            <h2 class="text-primary mb-0"><i class="fas fa-users"></i> Quản lý người dùng</h2>
            <div class="d-flex gap-2">
                <form action="" class="d-flex search-form" method="get">
                    <input type="hidden" name="action" id="" value="indexuser">
                    <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm người dùng..."
                        value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
                    <button type="submit" class="btn btn-outline-primary ms-2"><i class="fas fa-search"></i></button>

                </form>
            </div>
            </div>
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $_SESSION['success'];
                unset($_SESSION['success']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $_SESSION['error'];
                unset($_SESSION['error']);?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-primary">
                            <tr>
                               <th>ID</th>
                                <th>Tên đăng nhập</th>
                                <th>Địa chỉ</th>
                                <th>Vai trò</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                   <td><?= htmlspecialchars($user['id']) ?></td>
                            <td><strong><?= htmlspecialchars($user['username']) ?></strong></td>
                            <td><?= htmlspecialchars($user['address'] ?? 'N/A') ?></td>
                            <td>
                                <form action="index.php?action=update_role&id=<?= $user['id'] ?>" method="post" class="d-inline">
                                    <select name="role" class="form-select form-select-sm role-select-<?= $user['role'] ?>" onchange="this.form.submit()">
                                        <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                                        <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <?php if ($user['is_locked'] == 1): ?>
                                    <span class="badge bg-secondary">Đã khóa</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Hoạt động</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($user['role'] !== 'admin'): ?>
                                    <?php if ($user['is_locked'] == 1): ?>
                                        <a href="index.php?action=lockuser&id=<?= $user['id'] ?>&status=0"
                                            class="btn btn-success btn-sm" onclick="return confirm('Mở khóa tài khoản này?');">
                                            <i class="fas fa-unlock"></i> Mở khóa
                                        </a>
                                    <?php else: ?>
                                        <a href="index.php?action=lockuser&id=<?= $user['id'] ?>&status=1"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Bạn có chắc muốn khóa tài khoản này?');">
                                            <i class="fas fa-lock"></i> Khóa
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td> 
                                </tr>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
            </div>
    </div>   
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>