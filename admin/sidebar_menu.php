
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Book Shop Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #f5f7fb;
         
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background-color: #3d035f ;
        }

        .main-wrapper {
            margin-left: 260px;
        }

        .menu-link {
            border-radius: 10px;
            padding: 12px 15px;
            transition: 0.3s;
        }

        .menu-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .dashboard-card {
            border: none;
            border-radius: 18px;
            transition: 0.3s;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
        }

        .card-icon {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        @media(max-width: 768px) {

            .sidebar {
                width: 100%;
                min-height: auto;
                position: relative !important;
            }

            .main-wrapper {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar  text-white position-fixed p-3">

        <div class="text-center mb-4">
            <i class="bi bi-book-half display-4"></i>
            <h3 class="fw-bold mt-2">Women Shop</h3>
        </div>

        <ul class="nav flex-column gap-2">

            <li class="nav-item">
                <a href="./Admin_Dashboard.php"
                    class="nav-link text-white menu-link bg-primary">
                    <i class="bi bi-house-door-fill me-2"></i>
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a href="./view_book_product.php"
                    class="nav-link text-white menu-link">
                    <i class="bi bi-book-fill me-2"></i>
                    Women Product
                </a>
            </li>

            <li class="nav-item">
                <a href="./view_brand_detail.php"
                    class="nav-link text-white menu-link">
                    <i class="bi bi-tags-fill me-2"></i>
                    Women Brand
                </a>
            </li>

            <li class="nav-item">
                <a href="./view_categories.php"
                    class="nav-link text-white menu-link">
                    <i class="bi bi-grid-fill me-2"></i>
                    Categories
                </a>
            </li>

           
            </li>

            <li class="nav-item">
                <a href="./view_purchase.php"
                    class="nav-link text-white menu-link">
                    <i class="bi bi-basket-fill me-2"></i>
                    Purchase
                </a>
            </li>

            
<li class="nav-item">
                <a href="./view_stock.php"
                    class="nav-link text-white menu-link">
                    <i class="bi bi-box-seam-fill me-2"></i>
                    Stock
                </a>
            </li>
            <li class="nav-item">
                <a href="./view_order.php"
                    class="nav-link text-white menu-link">
                    <i class="bi bi-cart-check-fill me-2"></i>
                    Orders
                </a>
            </li>

            <li class="nav-item mt-3">
                <a href="./admin_logout.php"
                    class="nav-link text-white bg-danger menu-link">
                    <i class="bi bi-box-arrow-left me-2"></i>
                    Logout
                </a>
            </li>

        </ul>

    </div>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg bg-white shadow-sm px-4 py-3">

            <div class="container-fluid">

                <h4 class="fw-bold text-primary mb-0  ">
                  Admin Dashboard
                </h4>

                <div class="d-flex align-items-center gap-3">

                  

                    <div class="d-flex align-items-center">
                        <img src="../Image/japan.jpg"
                            class="rounded-circle border border-2 border-primary"
                            width="45" height="45">

                        <div class="ms-2">
                            <h6 class="mb-0 fw-bold">Admin</h6>
                            <small class="text-muted">Administrator</small>
                        </div>
                    </div>

                </div>

            </div>

        </nav>

        <!-- Main Content -->
        <div class="container-fluid p-4">

            

        </div>

    </div>

    <script src="./js/bootstrap.bundle.min.js"></script>

</body>

</html>