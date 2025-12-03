<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petzone - Quản lý sản phẩm</title>
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
            box-shadow: 0 4px 15px black;
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
            <h2 class="text-primary mb-0"><i class="fas fa-box"></i> Quản lý sản phẩm</h2>
            <div class="d-flex gap -2">
                <form class="d-flex search-form" action="" method="get">
                    <input type="hidden" name="action" value="indexproduct">
                    <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm sản phẩm..."
                    value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
                    <button type="submit" class="btn btn-outline-primary ms-2"><i class="fas fa-search"></i></button>
                    </form>
                <a href="?action=createproduct" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm sản phẩm</a>
            </div>
        </div>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['success'];
                unset($_SESSION['success']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $_SESSION['error'];
                unset($_SESSION['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Giá</th>
                        <th>Hình ảnh</th>
                        <th>Mô tả</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($products)) {
                        foreach ($products as $product): ?>
                            <tr>
                                <td><?= htmlspecialchars($product['id']) ?></td>
                                <td><strong><?= htmlspecialchars($product['name']) ?></strong></td>
                                <td><img src="/BASE-DUANMAU/uploads/imgproduct/<?= htmlspecialchars($product['image']) ?>"
                                        width="80px" class="rounded border"></td>
                                <td class="text-danger fw-bold"><?= number_format($product['price'], 0, ',', '.') ?> VNĐ</td>
                                <td><?= htmlspecialchars($product['category_name'] ?? 'Chưa phân loại') ?></td>
                                <td><small><?= htmlspecialchars(mb_strimwidth($product['description'], 0, 100, "...")) ?></small>
                                </td>
                                <td>
                                    <a href="?action=editproduct&id=<?= $product['id'] ?>" class="btn btn-sm btn-warning mb-1"><i
                                            class="fa fa-edit"></i> Sửa</a>
                                    <a href="?action=deleteproduct&id=<?= $product['id'] ?>" class="btn btn-sm btn-danger mb-1"
                                        onclick="return confirm('Xác nhận xoá sản phẩm này?');"><i class="fa fa-trash"></i>
                                        Xoá</a>
                                </td>
                            </tr>
                        <?php endforeach;
                    } else { ?>
                        <tr>
                            <td colspan="7" class="text-center">Không có sản phẩm nào.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>