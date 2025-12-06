<?php if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] ?? '') !== 'admin') {
    header('Location: index.php?action=login');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý bình luận</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
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
    </style>
</head>

<body>
    <?php include __DIR__ . '/../partials/admin_header.php'; ?>

    <div class="container mt-4">
        <div class="header-actions">
            <h2 class="text-primary mb-0"><i class="fas fa-comments"></i> Quản lý bình luận</h2>
            <form class="d-flex search-form" method="get">
                <input type="hidden" name="action" value="managecomments">
                <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm bình luận..."
                    value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
                <button type="submit" class="btn btn-outline-primary ms-2"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </div>
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['success'] ?>
            <?php unset($_SESSION['success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_SESSION['error'] ?>
            <?php unset($_SESSION['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Sản phẩm</th>
                    <th>Người dùng</th>
                    <th>Nội dung</th>
                    <th>Thời gian</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comments as $c): ?>
                    <tr>
                        <td><?= htmlspecialchars($c['id']) ?></td>
                        <td><?= htmlspecialchars($c['product_name'] ?? '—') ?></td>
                        <td><?= htmlspecialchars($c['username'] ?? 'Khách') ?></td>
                        <td><?= nl2br(htmlspecialchars($c['content'])) ?></td>
                        <td><?= htmlspecialchars($c['created_at']) ?></td>
                        <td>
                            <?php if (!empty($c['is_hidden'])): ?>
                                <span class="badge bg-secondary">Đã ẩn</span>
                            <?php else: ?>
                                <span class="badge bg-success">Hiện</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <?php if (!empty($c['is_hidden'])): ?>
                                    <a href="index.php?action=commenttoggle&id=<?= $c['id'] ?>&toggle=show"
                                        class="btn btn-sm btn-success" title="Hiện">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                <?php else: ?>
                                    <a href="index.php?action=commenttoggle&id=<?= $c['id'] ?>&toggle=hide"
                                        class="btn btn-sm btn-warning" title="Ẩn">
                                        <i class="fas fa-eye-slash"></i>
                                    </a>
                                <?php endif; ?>

                                <a href="index.php?action=commentdelete&id=<?= $c['id'] ?>" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Xóa bình luận?')" title="Xóa">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($comments)): ?>
                    <tr>
                        <td colspan="7" class="text-center py-3">Chưa có bình luận nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>