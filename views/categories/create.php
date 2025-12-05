<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm danh mục</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to right, #d0f0f8, #f9dfff);
            min-height: 100vh;
        }

        .form-container {
            max-width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../partials/admin_header.php'; ?>
            <div class="container mt-5">
        <div class="form-container">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 text-center"><i class="fas fa-folder-plus"></i> Thêm Danh mục</h4>
                </div>
                <div class="card-body p-4">
                    <?php if (isset($_SESSION['error'])): ?>
                       <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i> <?= $_SESSION['error'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>
                    <form method="POST" action="index.php?action=storecategory">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Tên danh mục <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required
                                placeholder="Nhập tên danh mục">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Mô tả</label>
                            <textarea class="form-control" id="description" name="description" rows="4"
                                placeholder="Nhập mô tả danh mục (không bát buộc)"></textarea>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-fill">
                                <i class="fas fa-save"></i> Thêm danh mục
                            </button>
                            <a href="index.php?action=categories" class="btn btn-secondary">
                                <i class="fas fa-times"></i>Hủy
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>