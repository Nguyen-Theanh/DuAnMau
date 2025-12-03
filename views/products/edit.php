<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        body {
            background: linear-gradient(to right, #d0f0f8, #f9dfff);
            min-height: 100vh;
        }

        .form-container {
            max-width: 600px;
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
                    <h4 class="mb-0 text-center"><i class="fas fa-edit"></i> Sửa sản phẩm</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $_SESSION['error'];
                            unset($_SESSION['error']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên sản phẩm</label>
                            <input type="text" name="name" id="" class="form-control"
                                value="<?= htmlspecialchars($product['name']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold"> Giá</label>
                            <div class="input-group">
                                <input type="number" name="price" id="" class="form-control"
                                    value="<?= htmlspecialchars($product['price']) ?>" required>
                                <span class="input-group-text">VNĐ</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Danh mục</label>
                            <select name="idcategory" id="" class="form-select" required>
                                <?php foreach ($categories as $cate): ?>
                                    <option value="<?= $cate['id'] ?>" <?= $cate['id'] == $product['idcategory'] ? 'selected' : '' ?>>
                                        <?= $cate['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Hình ảnh</label>
                            <div class="mb-2">
                                <img src="/BASE-DUANMAU/uploads/imgproduct/<?= htmlspecialchars(($product['image'])) ?>"
                                    alt="" width="120px" class="rounded border">
                            </div>
                            <label class="form-label">Chọn ảnh mới (nếu muốn)</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Mô tả</label>
                            <textarea name="description" id="" class="form-control" rows="4">
                            <?= htmlspecialchars($product['description']) ?>
                        </textarea>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" name="update" class="btn btn-primary flex-grow-1"><i
                                    class="fas fa-save"></i>Cập nhật</button>
                            <a href="?action=indexproduct" class="btn btn-secondary"><i
                                    class="fas fa-arrow-left"></i>Quay lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>