<!DOCTYPE html>
<html lang="en">


<head>
    <title>Mentor - Bootstrap 4 Admin Dashboard Template</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Admin template that can be used to build dashboards for CRM, CMS, etc." />
    <meta name="author" content="Potenza Global Solutions" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- app favicon -->
    <link rel="shortcut icon" href="admin/assets/img/favicon.ico">
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <!-- plugin stylesheets -->
    <link rel="stylesheet" type="text/css" href="admin/assets/css/vendors.css" />
    <!-- app style -->
    <link rel="stylesheet" type="text/css" href="admin/assets/css/style.css" />
</head>

<body>
    <!-- begin app -->
    <div class="app">
        <!-- begin app-wrap -->
        <div class="app-wrap">
            <!-- begin pre-loader -->
            <div class="loader">
                <div class="h-100 d-flex justify-content-center">
                    <div class="align-self-center">
                        <img src="admin/assets/img/loader/loader.svg" alt="loader">
                    </div>
                </div>
            </div>
            <!-- end pre-loader -->
            <!-- begin app-header -->
            @include('admin.includes.header')
            <!-- end app-header -->
            <!-- begin app-container -->
            <div class="app-container">
                <!-- begin app-nabar -->
                <aside class="app-navbar">
                    <!-- begin sidebar-nav -->
                    @include('admin.includes.sidebar')
                    <!-- end sidebar-nav -->
                </aside>
                <!-- end app-navbar -->
                <!-- begin app-main -->
                @yield('content')
                <!-- end app-main -->
            </div>
            <!-- end app-container -->
            <!-- begin footer -->
            @include('admin.includes.footer')
            <!-- end footer -->
        </div>
        <!-- end app-wrap -->
    </div>
    <!-- end app -->

    <!-- plugins -->
    <script src="admin/assets/js/vendors.js"></script>

    <!-- custom app -->
    <script src="admin/assets/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Add this in your layout (before closing </body> tag) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let successAlert = document.getElementById("success-alert");
            let errorAlert = document.getElementById("error-alert");

            if (successAlert) {
                setTimeout(function() {
                    successAlert.classList.remove("show");
                    successAlert.classList.add("fade");
                    setTimeout(() => successAlert.remove(), 500);
                }, 3000); // 3 seconds
            }

            if (errorAlert) {
                setTimeout(function() {
                    errorAlert.classList.remove("show");
                    errorAlert.classList.add("fade");
                    setTimeout(() => errorAlert.remove(), 500);
                }, 3000); // 3 seconds
            }
        });
    </script>


</body>


</html>