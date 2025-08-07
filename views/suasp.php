<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Petzone</title>
  <style>
    body {
      margin: auto;
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #d0f0f8, #f9dfff);
      display: flex;
      flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    </style>
</head>
<body>
<h2>Sửa sản phẩm</h2>
<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $product['id'] ?>">
    
    <label>Tên sản phẩm:</label><br>
    <input type="text" name="name" value="<?= $product['name'] ?>"><br><br>

    <label>Giá:</label><br>
    <input type="text" name="price" value="<?= $product['price'] ?>"><br><br>

    <div>
        <label>Ảnh hiện tại:</label><br>
        <img src="<?= $product['image'] ?>" width="120px"><br>
        <label>Chọn ảnh mới (nếu muốn):</label>
        <input type="file" name="image">
    </div>

    <label>Mô tả:</label><br>
    <textarea name="description"><?= $product['description'] ?></textarea><br><br>

    <label>ID danh mục:</label><br>
    <input type="text" name="idcategory" value="<?= $product['idcategory'] ?>"><br><br>

    <button type="submit" name="update">Cập nhật</button>
    </form>
</body>
</html>