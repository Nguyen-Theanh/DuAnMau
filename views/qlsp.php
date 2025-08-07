<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Petzone</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    body {
      margin: auto;
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #d0f0f8, #f9dfff);
              justify-content: center;
    }
        .logo {
      font-size: 35px;
      font-weight: bold;
      color: white;
      margin-left: 40px;
      width: 300px;
      height: 100px;
      background-color: #0ccee3;
      display: flex;
      align-items: center;
        justify-content: center;
    }
    .header{
        display: flex;
        align-items: center;
    justify-content: space-around ;
    margin: 20px;
    }
    .rectangle {
      width: 150px;
      height: 50px;
      background-color: #0ccee3;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 20px;
      margin-bottom: 20px;
      text-decoration: none;
    }
    .rectangle:hover {
      background-color: white;
      color: #0ccee3;
    }
        .search-bar {    
      display: flex;
      gap: 10px;
      flex: 1;
      max-width: 400px;
      margin-left: -100px;
    }

    .search-bar input {
      flex: 1;
      height: 36px;
      border-radius: 20px;
      border: none;
      padding: 0 15px;
      outline: none;
    }

    .search-bar button {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      border: none;
      background-color: white;
      color: #0ccee3;
    }
    .search-bar button:hover {
      background-color: #09b0c7;
      color: white;
    }


    </style>
    </head>
    <body>
        <div class="header">
        <div class="logo">
        <h1>Petzone</h1>
           </div>
           </div>
    <div class="header">
  <div class="search-bar">
    <form action="" method="get">
    <input type="hidden" name="action" id="" value="qlsp">
    <input type="text" name="keyword" placeholder="Tìm kiếm..." value="<?= $_GET['keyword'] ?? '' ?>">
    <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
          <a href="" class="rectangle">Thêm sản phẩm</a>

  </div>
  <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-top: 20px; text-align: center;">
    <tr>
      <th>ID</th>
      <th>Tên sản phẩm</th>
        <th>Hình ảnh</th>
      <th>Giá</th>
       <th>Danh mục</th>
         <th>Mô tả</th>
      <th>Hành động</th>
    </tr>
    <?php
    foreach ($products as $product) { ?>
        <tr>
        <td><?= $product['id'] ?></td>
        <td><?= $product['name'] ?></td>
        <td><img src="/PH58569/uploads/imgproduct/<?= $product['image'] ?>" width="100px"></td>
        <td><?= $product['price'] ?></td>
        <td><?= $product['idcategory'] ?></td>
        <td style="width: 500px;"><?= $product['description'] ?></td>
        <td><a href="?action=suasp&id=<?= $product['id'] ?>">Sửa sản phẩm</a> </br>
        <a href="?action=xoasp&id=<?= $product['id'] ?>" onclick="return confirm('Xác nhận xoá sản phẩm này?');">Xoá sản phẩm</a></td>
        </tr>
        <?php } ?>
  </table>
    </body>
    </html>
    