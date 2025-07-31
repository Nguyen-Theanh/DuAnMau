<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Petzone</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #d0f0f8, #f9dfff);
    }

    header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background-color: #0ccee3;
      padding: 10px 40px;
      height: 70px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .logo {
      font-size: 26px;
      font-weight: bold;
      color: white;
    }

    .search-bar {
      display: flex;
      align-items: center;
      gap: 10px;
      flex: 1;
      max-width: 600px;
      margin: 0 40px;
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
      cursor: pointer;
    }

    .header-icons {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .header-icons a {
      color: white;
      font-size: 22px;
      transition: transform 0.2s;
    }

    .header-icons a:hover {
      transform: scale(1.2);
    }
  </style>
</head>
<body>

<header>
  <div class="logo">Petzone</div>

  <div class="search-bar">
    <input type="text" placeholder="Tìm kiếm...">
    <button><i class="fa fa-search"></i></button>
  </div>

  <div class="header-icons">
    <a href="giohang.php" title="Giỏ hàng"><i class="fa-solid fa-cart-shopping"></i></a>
    <a href="taikhoan.php" title="Tài khoản"><i class="fa-solid fa-user"></i></a>
  </div>
</header>
<div class="banner">
    <img src="banner.png" alt="" width="700px">
</div>
<div class="spcs">
    <h1>Sản phẩm của shop</h1>
</div>
<div class="sanphams">
<div class="sanpham">
    <img src="" alt="">
    Bát đựng thức ăn <br>
    95.000 đ
</div>
<div class="sanpham">
    <img src="" alt="">
    Bát đựng thức ăn <br>
    95.000 đ
</div>
<div class="sanpham">
    <img src="" alt="">
    Bát đựng thức ăn <br>
    95.000 đ
</div>
<div class="sanpham">
    <img src="" alt="">
    Bát đựng thức ăn <br>
    95.000 đ
</div>
<div class="sanpham">
    <img src="" alt="">
    Bát đựng thức ăn <br>
    95.000 đ
</div>
<div class="sanpham">
    <img src="" alt="">
    Bát đựng thức ăn <br>
    95.000 đ
</div>
</div>
<footer>
    Sđt:037944534
    Địa chỉ: Xuân trường, Nam Định. 
</footer>
</body>
</html>
