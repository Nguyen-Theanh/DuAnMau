<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Zone</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        body{
            background: linear-gradient(to right, #d0f0f8, #f9dfff);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .product-card{
            transition: tranform 0.2s;
            height: 100%;
            background-color: #c5eaefff;
            border: none;
            border-radius: 10px;
        }

        .product-card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
            .product-img {
      height: 180px;
      object-fit: contain;
      width: 100%;
      padding: 10px;
    }

    .product-title {
      font-size: 1rem;
      color: #333;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
      height: 2.5em;
    }

    footer {
      background-color: #0e93a2ff !important;
    }

    </style>
</head>
<body>
    <?php include __DIR__.'/partials/header.php';?>
    <main class="flex-grow-1">
    <div class="container my-4">
      <div class="row justify-content-center">
        <div class="col-12 col-md-10">
          <img src="uploads/banner.png" alt="Banner" class="img-fluid rounded shadow-sm w-100">
        </div>
      </div>
    </div>

    </main>
</body>
</html>