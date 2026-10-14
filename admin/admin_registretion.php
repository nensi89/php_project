 <?php
    include 'database.php';

    if (isset($_POST['register'])) {
        $admin_name = $_POST['admin_name'];
        $admin_email = $_POST['admin_email'];
        $admin_contact = $_POST['admin_contact'];
        $admin_password = $_POST['admin_password'];

        $sql = "INSERT INTO admin_registration 
    (admin_name, admin_email, admin_contact, admin_password)
    VALUES 
    ('$admin_name','$admin_email','$admin_contact','$admin_password')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>alert('Registration Successful');
        window.location='admin_login.php';
        </script>";
        } else {
            echo "<script>alert('Registration Failed');</script>";
        }
    }
    ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Book Shop Admin Registration</title>

     <!-- Bootstrap CSS -->
     <link href="./css/bootstrap-grid.min.css" rel="stylesheet">

     <!-- Bootstrap Icons -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

     <style>
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
             padding: 20px 35px;
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

             background-clip: text;

             margin-bottom: 20px;
             letter-spacing: -0.3px;
             display: flex;
             align-items: center;
             gap: 10px;
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
             margin-bottom: 20px;
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
          .register-link {

            text-align: center;

            margin-top: 20px;
        }

        .register-link a {

            text-decoration: none;

            font-weight: bold;
        }
     </style>

 </head>

 <body>

     <div class="bgcolor">
        <div class="auth-container">
             <div class="card-header-custom">
                 <h2><i class="bi bi-book-half"></i>Mahi  Women Shop</h2>
                 <h4>Admin Registration Form</h4>
             </div>



             <form method="POST">

                 <!-- Admin Name -->
                 <div class="mb-3">
                     <!-- <label class="form-label fw-bold">Admin Name</label> -->
<label class="form-label fw-bold">
                            Admin Name
                        </label>
                     <div class="input-group">
                         
                         <input type="text"
                             name="admin_name"
                             class="form-control"
                             placeholder="Enter Admin Name"
                             required>
                     </div>
                 </div>

                 <!-- Admin Email -->
                 <div class="mb-3">
                     <!-- <label class="form-label fw-bold">Admin Email</label> -->

                        <label class="form-label fw-bold">
                            Admin Email
                        </label>
                     <div class="input-group">
                         

                         <input type="email"
                             name="admin_email"
                             class="form-control"
                             placeholder="Enter Email Address"
                             required>
                     </div>
                 </div>

                 <!-- Admin Contact -->
                 <div class="mb-3">
                     <!-- <label class="form-label fw-bold">Admin Contact</label> -->
<label class="form-label fw-bold">
                            Admin Contact
                        </label>
                     <div class="input-group">
                          

                         <input type="text"
                             name="admin_contact"
                             class="form-control"
                             placeholder="Enter Contact Number"
                             required>
                     </div>
                 </div>

                 <!-- Admin Password -->
                 <div class="mb-4">
                     <!-- <label class="form-label fw-bold">Admin Password</label> -->

                        <label class="form-label fw-bold">
                            Admin Password
                        </label>

                     <div class="input-group">
                         <span class="input-group-text">
                             <i class="bi bi-lock-fill"></i>
                         </span>

                         <input type="password"
                             name="admin_password"
                             class="form-control"
                             placeholder="Enter Password"
                             required>
                     </div>
                 </div>

                 <!-- Register Button -->
                 <div class="d-grid">
                     <button type="submit" name="register" class="btn btn-primary "><i class="bi bi-person-plus-fill"></i>Register Now</button>
                 </div>

             </form>

             <!-- Login Link -->
             <div class="register-link">Already Registered ? <a href="./admin_login.php">Login Here</a></div>

 
         </div>

     </div>

 </body>

 </html>