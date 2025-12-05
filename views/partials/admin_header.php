<style>
        .admin-header {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding: 15px 40px;
        background: #0ccee3;
        color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 0;
        z-index: 1001;
        width: 100%;
        height: 70px;
        box-sizing: border-box;
    }

    .admin-header-logo-link {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        text-decoration: none;
        color: inherit;
    }

    .admin-header .logo {
        font-size: 35px;
        font-weight: bold;
        color: white;
    }

    .btn-add {
        background: linear-gradient(to right, #66b3ff, #ff99cc);
        color: white;
        padding: 8px 15px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
        transition: 0.3s;
        margin: 50px;
    }

    .btn-add:hover {
        background: linear-gradient(to right, #4da6ff, #ff66b3);
        transform: scale(1.05);
    }

    .logout-btn {
        background: linear-gradient(to right, #66b3ff, #ff99cc);
        color: white;
        padding: 8px 15px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
    }

    .logout-btn:hover {
        background: linear-gradient(to right, #4da6ff, #ff66b3);
        transform: scale(1.05);
    }

    nav.admin-nav {
        width: 100%;
        background: #00b3ffff;
        display: flex;
        justify-content: center;
        gap: 20px;
        padding: 10px 0;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 70px;
        z-index: 1000;
    }

    nav.admin-nav a {
        text-decoration: none;
        color: white;
        font-weight: bold;
        padding: 8px 15px;
        border-radius: 5px;
        transition: 0.3s;
    }

    nav.admin-nav a:hover {
        background: rgba(255, 255, 255, 0.3);
    }
</style>
<div class="admin-header">
    <a href="index.php?action=home" class="admin-header-logo-link">
        <div class="logo" ><i class="fa-solid fa-paw"></i>Petzone</div>
    </a>
    <a href="index.php?action=logout" class="logout-btn">Đăng xuất></a>
</div>
<nav class="admin-nav">
    <a href="index.php?action=indexproduct">Quản lý sản phẩm</a>
    <a href="index.php?action=categories">Quản lý danh mục</a>
    <a href="#">Quản lý người dùng</a>
    <a href="#">Quản lý bình luận</a>
</nav>