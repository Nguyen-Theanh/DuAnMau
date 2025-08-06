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
      font-size: 35px;
      font-weight: bold;
      color: white;
      margin-left: 40px;
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
    }
    .search-bar button:hover {
      background-color: #09b0c7;
      color: white;
    }

    .header-icons {
      display: flex;
      align-items: center;
      gap: 40px;
      margin-right: 40px;
    }

    .header-icons a {
      color: white;
      font-size: 30px;
      
    }

    .header-icons a:hover {
      transform: scale(1.2);
      transition: transform 0.2s;
    }
    .navbar {
      height: 50px;
      background-color: white ;
      display: flex;
      justify-content: center;
    
    }

    .navbar ul {
      list-style: none;
      margin: -10px;
      padding: 0;
      display: flex;
    }

    .navbar li {
      position: relative;
    }

    .navbar > ul > li {
      padding: 20px 30px;
    }

    .navbar a {
      color: #07b3c6ff;;
      text-decoration: none;
      font-weight: bold;
      padding: 10px 15px;
      display: block;
      transition: background 0.3s;
    }

    .navbar > ul > li:hover > a {
      background-color: #09b0c7;
      color: white;
      border-radius: 5px;
    }

    .navbar li ul {
        margin-top: 1px;
      position: absolute;
      top: 60px;
     
      background-color: white ;
      display: none;
      min-width: 180px;
 
    }

    .navbar li:hover ul {
      display: block;
      border-radius: 5px;
    }

    .navbar li ul li {
      padding: 0;
    }

    .navbar li ul a:hover {
        color: white;
      background-color: #09b0c7;
      border-radius: 5px;
    }
    .banner{
        margin: 30px auto;
        display: flex;
        justify-content: center;
    }
    .sanphams {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 70px;
  padding: 20px;
}

.sanpham {
  background-color: #c5eaefff;
  border-radius: 10px;
  padding: 15px;
  text-align: center;
  width: 200px;
  height: 300px;
  box-shadow: 0 10px 10px rgba(0,0,0,0.1);
  display: flex;
  flex-direction: column;
  box-sizing: border-box;
}

.sanpham img {
  max-width: 100%;
  max-height: 180px;
  object-fit: contain;
  margin: 0 auto 10px;
}

.sanpham h3 {
  font-size: 16px;
  margin: 5px 0;
  flex: 1;
  overflow: hidden;
}

.sanpham h4 {
  font-size: 15px;
  color: #c76300ff;
}

.sanpham:hover {
  transform: scale(1.05);
  transition: transform 0.2s;
}

    footer {
      background-color: #0ccee3;
      color: white;
      text-align: center;
      padding: 20px;
    
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
 <nav class="navbar">
    <ul>
      <li>
        <a href="#">Thú cưng</a>
        <ul>
          <li><a href="#">Chó</a></li>
          <li><a href="#">Mèo</a></li>
        </ul>
      </li>
      <li>
        <a href="#">Sản phẩm</a>
        <ul>
          <li><a href="#">Sản phẩm cho chó</a></li>
          <li><a href="#">Sản phẩm cho mèo</a></li>
        </ul>
      </li>
      <li>
        <a href="#">Sức khỏe</a>
        <ul>
          <li><a href="#">Thức ăn</a></li>
          <li><a href="#">Vệ sinh</a></li>
          <li><a href="#">Thuốc</a></li>
        </ul>
      </li>
    </ul>
  </nav>

<div class="banner">
    <img src="image/banner.png" alt="" width="950px">
</div>
<div class="spcs">
    <h1 style="display: flex; justify-content: center; color: #07b3c6ff;">Sản phẩm của shop</h1>
</div>

<div class="sanphams">
    <?php foreach ($products as $product): ?>
        <div class="sanpham">
            <img src="/PH58569/uploads/imgproduct/<?= htmlspecialchars($product['image']) ?>" width="200px">
            <h3><?= htmlspecialchars($product['name']) ?></h3>
            <h4 style="margin-top:-20px;"><?= number_format($product['price']) ?> đ</h4>
        </div>
    <?php endforeach; ?>
</div>

<footer>
    Liên hệ:037944534 <br>
    Địa chỉ: Xuân trường, Nam Định. 
</footer>
</body>
</html>
