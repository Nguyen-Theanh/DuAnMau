<style>
  header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #0ccee3;
    padding: 10px 40px;
    height: 70px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    position: sticky;
    top: 0;
    z-index: 1001;
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
    background-color: white;
    display: flex;
    justify-content: center;
    position: sticky;
    top: 70px;
    /* Below the header */
    z-index: 1000;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);

  }

  .navbar ul {
    list-style: none;
    margin: -20px;
    padding: 0;
    display: flex;
  }

  .navbar li {
    position: relative;
  }

  .navbar>ul>li {
    padding: 20px 30px;
  }

  .navbar a {
    color: #07b3c6ff;
    ;
    text-decoration: none;
    font-weight: bold;
    padding: 10px 15px;
    display: block;
    transition: background 0.3s;
  }

  .navbar>ul>li:hover>a {
    background-color: #09b0c7;
    color: white;
    border-radius: 5px;
  }

  .navbar li ul {
    margin-top: 1px;
    position: absolute;
    top: 60px;
    background-color: white;
    display: none;
    min-width: 180px;
    z-index: 1000;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
</style>
<header>
    <a href="?action=home" style="text-decoration: none">
        <div class="logo"><i class="fa-solid fa-paw"></i>Petzone</div>
    </a>
    <div class="search-bar">
        <form action="" method="get">
            <input type="hidden" name="action" value="home">
            <input type="text" name="keyword" placeholder="Tìm kiếm..." value="<?= $_GET['keyword']??''?>"
            style="width:500px">
            <button type="submit"><i class="fa fa-searchc"></i></button>
        </form>
    </div>

    <div class="header-icons">
        <a href="#" title="Giỏ hàng"><i class="fa-solid fa-cart-shopping"></i></a>
        <a href="#" title="Đăng nhập"><i class="fa-solid fa-user"></i> </a>
    </div>
</header>
    <nav class="navbar">
        <ul>
            <li>
                <a href="?action=home">Trang chủ</a>
            </li>
            <li>
                <a href="#">Thú cưng</a>
                <ul>
                    <li><a href="#">Chó</a></li>
                    <li><a href="#">Mèo</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Sức khỏe</a>
                <ul>
                    <li><a href="#">Thức ăn cho chó</a></li>
                    <li><a href="#"></a>Thức ăn cho mèo</li>
                    <li><a href="#"></a>Vệ sinh</li>
                    <li><a href="#">Thuốc</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Phụ kiện</a>
            </li>
        </ul>
    </nav>
