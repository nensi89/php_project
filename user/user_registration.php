<?php
session_start();
include 'database.php';

if (isset($_POST['register'])) {

    $user_name     = $_POST['user_name'];
    $user_email    = $_POST['user_email'];
    $user_contact  = $_POST['user_contact'];
    $user_password = $_POST['user_password'];

    // Insert Query
    $sql = "INSERT INTO user_registration
            (user_name, user_email, user_contact, user_password)

            VALUES
            ('$user_name','$user_email','$user_contact','$user_password')";

    $result = mysqli_query($conn, $sql);

    if ($result) {

        echo "<script>

            alert('User Registration Successful');

            window.location='user_login.php';

        </script>";
    } else {

        echo "<script>

            alert('Registration Failed');

        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>User Registration</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {



            font-family: Arial, Helvetica, sans-serif;
        }

        .register-card {

            width: 100%;

            max-width: 450px;

            border-radius: 20px;

            overflow: hidden;

            background: #fff;

            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.3);
        }

        .card-header-custom {

            background: #0d6efd;

            color: white;

            text-align: center;

            padding: 25px;
        }

        .card-header-custom h2 {

            margin: 0;

            font-weight: bold;
        }

        .form-control {

            border-radius: 10px;

            height: 50px;
        }

        .input-group-text {

            border-radius: 10px 0 0 10px;

            background: #0d6efd;

            color: white;

            border: none;
        }

        .btn-register {

            background: #0d6efd;

            color: white;

            border-radius: 10px;

            height: 50px;

            font-size: 18px;

            font-weight: bold;

            transition: 0.3s;
        }

        .btn-register:hover {

            background: #084298;
        }

        .login-link {

            text-align: center;

            margin-top: 20px;
        }

        .login-link a {

            text-decoration: none;

            font-weight: bold;
        }

        .footer-text {

            text-align: center;

            margin-top: 15px;

            color: #666;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .bgcolor {
            font-family: 'Inter', sans-serif;
            /* background-color: #6c757d; */
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        /* Animated background decoration */
        .bgcolor::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.15) 0%, rgba(56, 189, 248, 0) 70%);
            top: 10%;
            left: -100px;
            border-radius: 50%;
            z-index: 0;
        }

        .bgcolor::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.12) 0%, rgba(168, 85, 247, 0) 70%);
            bottom: -150px;
            right: -150px;
            border-radius: 50%;
            z-index: 0;
        }

        /* main card container */
        .auth-container {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(0px);
            border-radius: 2rem;
            box-shadow: 0 25px 45px -12px rgba(0, 0, 0, 0.35), 0 1px 2px rgba(0, 0, 0, 0.05);
            /* width: 100%; */
            /* max-width: 460px; */
            padding: 2.2rem 2rem 2.5rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border: 1px solid rgba(255, 255, 255, 0.5);
            position: relative;
            z-index: 2;
        }

        .auth-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 50px -20px rgba(0, 0, 0, 0.4);
        }

        /* heading style */
        .auth-container h2 {
            font-size: 1.9rem;
            font-weight: 700;
            background: linear-gradient(115deg, #0f2b3d, #1e3c4a);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            margin-bottom: 0.5rem;
            letter-spacing: -0.3px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .auth-container h2:before {
            content: '\f007';
            font-family: 'Font Awesome 6 Free';
            font-weight: 600;
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            font-size: 1.8rem;
        }

        /* description text */
        .auth-sub {
            color: #4b5563;
            font-size: 0.9rem;
            margin-bottom: 1.8rem;
            border-left: 3px solid #3b82f6;
            padding-left: 12px;
            font-weight: 500;
        }

        /* form group modern styling */
        .input-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1.1rem;
            transition: color 0.2s;
            pointer-events: none;
        }

        .auth-container input {
            width: 100%;
            padding: 14px 16px 14px 46px;
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
            border: 1.5px solid #e2e8f0;
            border-radius: 1.2rem;
            background-color: #fefefe;
            transition: all 0.25s ease;
            outline: none;
            font-weight: 500;
            color: #1e293b;
        }

        .auth-container input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
            background-color: #ffffff;
        }

        .auth-container input:focus+i {
            color: #3b82f6;
        }

        .auth-container input::placeholder {
            color: #cbd5e1;
            font-weight: 400;
        }

        /* button modern design */
        .btn-primary {
            background: linear-gradient(105deg, #2563eb, #4f46e5);
            border: none;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            padding: 14px 20px;
            border-radius: 2rem;
            width: 100%;
            cursor: pointer;
            transition: all 0.25s;
            font-family: 'Inter', sans-serif;
            letter-spacing: 0.3px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 8px 18px -6px rgba(37, 99, 235, 0.3);
            margin-top: 0.5rem;
        }

        .btn-primary i {
            font-size: 1rem;
            transition: transform 0.2s;
        }

        .btn-primary:hover {
            background: linear-gradient(105deg, #1d4ed8, #4338ca);
            transform: scale(1.01);
            box-shadow: 0 12px 22px -8px rgba(37, 99, 235, 0.4);
        }

        .btn-primary:hover i {
            transform: translateX(3px);
        }

        .btn-primary:active {
            transform: scale(0.98);
        }

        /* footer link */
        .auth-footer {
            text-align: center;
            margin-top: 1.8rem;
            font-size: 0.9rem;
            color: #334155;
            border-top: 1px solid #eef2ff;
            padding-top: 1.5rem;
        }

        .auth-footer a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .auth-footer a i {
            font-size: 0.8rem;
        }

        .auth-footer a:hover {
            color: #1e40af;
            text-decoration: underline;
        }

        /* alert / message popup style (if needed for demo or inline errors) */
        .message-toast {
            background: #f1f5f9;
            border-radius: 1rem;
            padding: 0.7rem 1rem;
            margin-bottom: 1.4rem;
            font-size: 0.85rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 4px solid #10b981;
            color: #065f46;
        }

        .message-error {
            border-left-color: #ef4444;
            color: #b91c1c;
            background: #fef2f2;
        }
        
         .auth-container h4 {
             font-size: 16px;
             font-weight: 700;
             color: blue;
             background-clip: text;
             text-align: center;
             margin-bottom: 20px;
             letter-spacing: -0.3px;

             gap: 10px;
         }
    </style>

</head>

<body>

    <div class="bgcolor">
        <div class="auth-container">

            <!-- Card Header -->
            <h2>
                Mahi Women Shop
            </h2>

            <h4 class="mb-0">
                User Registration Form
</h4>



            <!-- Card Body -->
            <div class="card-body p-4">

                <form method="POST">

                    <!-- User Name -->
                    <div class="mb-3">

                        <label class="form-label fw-bold">
                            User Name
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">

                                <i class="bi bi-person-fill"></i>

                            </span>

                            <input type="text"
                                name="user_name"
                                class="form-control"
                                placeholder="Enter User Name"
                                required>

                        </div>

                    </div>


                    <!-- User Email -->
                    <div class="mb-3">

                        <label class="form-label fw-bold">
                            User Email
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">

                                <i class="bi bi-envelope-fill"></i>

                            </span>

                            <input type="email"
                                name="user_email"
                                class="form-control"
                                placeholder="Enter Email Address"
                                required>

                        </div>

                    </div>


                    <!-- User Contact -->
                    <div class="mb-3">

                        <label class="form-label fw-bold">
                            User Contact
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">

                                <i class="bi bi-telephone-fill"></i>

                            </span>

                            <input type="text"
                                name="user_contact"
                                class="form-control"
                                placeholder="Enter Contact Number"
                                required>

                        </div>

                    </div>


                    <!-- User Password -->
                    <div class="mb-4">

                        <label class="form-label fw-bold">
                            User Password
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">

                                <i class="bi bi-lock-fill"></i>

                            </span>

                            <input type="password"
                                name="user_password"
                                class="form-control"
                                placeholder="Enter Password"
                                required>

                        </div>

                    </div>


                    <!-- Register Button -->
                    <div class="d-grid">

                        <button type="submit"
                            name="register"
                            class="btn-primary">

                            

                            Register Now

                        </button>

                    </div>

                </form>


                <!-- Login Link -->
                <div class="login-link">

                    Already Registered ?

                    <a href="user_login.php">

                        Login Here

                    </a>

                </div>


                <!-- Footer -->
                <div class="footer-text">

                    © 2026 Online Book Shop

                </div>

            </div>
        </div>
    </div>

</body>

</html>