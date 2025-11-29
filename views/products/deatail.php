<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm - <?= htmlspecialchars($product['name']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    body {
      background: linear-gradient(to right, #d0f0f8, #f9dfff);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .main-content {
      flex: 1;
    }

    .product-img {
      max-height: 400px;
      object-fit: contain;
      width: 100%;
    }

    .price-tag {
      color: #ff4d4f;
      font-size: 2rem;
      font-weight: bold;
    }

    .related-product-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
      transition: all 0.3s ease;
    }

    .related-img {
      height: 180px;
      object-fit: contain;
      padding: 10px;
    }
    footer {
      background-color: #0e93a2ff !important;
    }
  </style>
</head>
<body>
    <?php include __DIR__ . '/../partials/header.php'; ?>

    <div class="main-content container py-5">
        <div class="card shadow-sm border-0 mb-5">
            <div class="card-body p-4">
                <div class="row g-5">
                    <div class="col-md-5 text-center">
                        <img src="uploads/imgproduct/<?= htmlspecialchars($product['image']) ?>" 
                        class="img-fluid rounded product-img">
                    </div>

                    <div class="col-md-7">
                        <h1 class="fw-bold mb-3"><?= htmlspecialchars(($product['name']))?></h1>
                        <div class="mb-3">
                            <span class="badge bg-info text-dark fs-6">
                                <i class="fas fa-tags"></i> <?= htmlspecialchars($product['category_name']) ?>
                            </span>
                        </div>

                        <p class="price-tag mb-4"><?= number_format($product['price'],0,',','.')?> đ</p>

                        <div class="mb-4">
                            <h5 class="fw-bold text-secondary">Mô tả sản phẩm:</h5>
                            <p class="text-muted" style="white-space: pre-line;"><?= htmlspecialchars($product['description']) ?></p>
                        </div>

                        <a href="#" class="btn btn-warning btn-lg text-white px-5 rounded-pill shadow-sm">
                            <i class="fas fa-cart-plus me-2"></i> Thêm vào giỏ hàng
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow-sm border-0 mb-5">
            <div class="card-header bg-white py-3">
                <h4 class="mb-0 text-primary"><i class="fas fa-comments me-2"></i> Đánh giá sản phẩm</h4>
            </div>
            <div class="card-body p-4">
                <?php if (!empty($comments)): ?>
                    <div class="vstack gap-3 mb-4">
                       <?php foreach ($comments as $c) : ?>
                        <div class="d-flex gap-3" >
                            <div class="flex-shrink-0">
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px;">
                                <i class="fas fa-user text-secondary fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="bg-light p-3 rounded-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                   <h6 class="fw-bold mb-0"><?= htmlspecialchars($c['username'] ?? 'Khách') ?></h6> 
                                   <small class="text-muted"><i class="far fa-clock"></i>
                                        <?= htmlspecialchars($c['created_at'] ?? '') ?></small>
                                </div>
                                <p class="mb-0 text-break"><?= nl2br(htmlspecialchars($c['content'])) ?></p>
                            </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php else: ?>
                        <div class="text-center py-4 text-muted">
                            <i class="far fa-comment-dots fs-1 mb-2"></i>
                            <p>Chưa có đánh giá nào. Hãy là người đầu tiên đánh giá</p>
                        </div>
                    <?php endif; ?>

                    <hr>
                    <?php if (!empty($_SESSION['user'])): ?>
                        <form action="index.php?action=store_comment" method="post">
                            <input type="hidden" name="product_id" value="<?= intval($product['id']) ?>">
                            <div class="mb-3">
                                <label for="commentContent" class="form-label fw-bold">Viết đánh giá của bạn:</label>
                                <textarea name="content" id="commentContent" class="form-control" rows="3"
                                placeholder="Chia sẻ cảm nhận của bạn về sản phẩm..." required></textarea>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-paper-plane me-2"></i> Gửi đánh giá
                                </button>
                            </div>
                        </form>
                        <?php else: ?>
                            <div class="alert alert-warning mb-0" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i> Vui lòng <a href="index.php?action=login"
                                class="alert-link">Đăng nhập</a> để gửi đánh giá.
                            </div>
                            <?php endif; ?>
            </div>
        </div>

        <h3 class="text-center text-primary fw-bold mb-4">Các sản phẩm liên quan</h3>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 justify-content-center">
            <?php foreach ($relatedProducts as $p): ?>
                <div class="col">
                    <div class="card h-100 related-product-card shadow-sm border-0" style="background-color: #c5eaefff;">
                        <a href="index.php?action=productDetail&id=<?= $p['id'] ?>"
                            class="text-decoration-none text-dark h-100 d-flex flex-column">
                            <img src="/BASE-DUANMAU/uploads/imgproduct/<?= htmlspecialchars($p['image']) ?>" 
                            class="card-img-top related-img"
                            alt="<?= htmlspecialchars($p['name']) ?>">
                            <div class="card-body text-center d-flex flex-column">
                                <h6 class="card-title text-truncate mb-2"><?= htmlspecialchars($p['name']) ?></h6>
                                <p class="card-text fw-bold text-danger mt-auto">
                                    <?= number_format($p['price']) ?> đ
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
        </div>
    </div>
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>