<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý danh mục</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
</head>
<body>
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

        @media (max-width: 768px) {
            .header-actions {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>

</body>
   <?php include __DIR__ . '/../partials/admin_header.php'; ?>
        <div class="container mt-4">
            <div class="header-actions">
                <h2 class="mb-0 text-primary"><i class="fas fa-folder"></i>Quản lý danh mục</h2>
                <div class="d-flex gap-2 align-items-center">
                    <form class="search-form d-flex" method="get">
                        <input type="hidden" name="action" value="categories">
                    <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm danh mục..."
                        value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
                    <button type="submit" class="btn btn-outline-primary ms-2">
                        <i class="fas fa-search"></i>
                    </button>
                    </form>
                    <a href="index.php?action=createcategory" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Thêm danh mục
                    </a>
                </div>
            </div>

            <?php if(isset($_SESSION['success'])) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> <?= $_SESSION['success'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> <?= $_SESSION['error'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <?php if (!empty($categories)) : ?>
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Tên danh mục</th>
                            <th>Mô tả</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td><?= htmlspecialchars($category['id']) ?></td>
                                <td><strong><?= htmlspecialchars($category['name']) ?></strong></td>
                                <td><?= htmlspecialchars($category['description'] ?? 'Không có mô tả') ?></td>
                                <td>
                                    <a href="index.php?action=editcategory&id=<?= $category['id'] ?>"
                                        class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <a href="index.php?action=deletecategory&id=<?= $category['id'] ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục <?= htmlspecialchars($category['name']) ?>?')">
                                        <i class="fas fa-trash"></i> Xóa
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                    </tbody>
        </div>
        <?php else: ?>
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i>
                <?= isset($_GET['keyword']) && $_GET['keyword'] !== ''
                    ? 'Không tìm thấy danh mục nào phù hợp với từ khóa "' . htmlspecialchars($_GET['keyword']) . '"'
                    : 'Không có danh mục nào trong hệ thống.' ?>
            </div>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>