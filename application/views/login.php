<?php
    if (isset($_GET['pesan'])) {
        if ($_GET['pesan'] == "gagal") {
            echo "<div class='alert alert-danger'>Gagal masuk! Nama pengguna dan kata sandi salah.</div>";
        } else if ($_GET['pesan'] == "logout") {
            echo "<div class='alert alert-danger'>Kamu telah keluar.</div>";
        } else if ($_GET['pesan'] == "belumlogin") {
            echo "<div class='alert alert- success'>Silahkan login terlebih dahulu.</div>";
        }
    }
?>

<body class="bg-gradient-dark">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-6 col-md-9 mt-3">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center py-3">
                                <img src="<?php echo base_url() ?>assets/img/logo.png" class="w-25 px-3 rounded-circle mb-3">
                                <h1 class="h2 text-gray-900">SuperLaundry System</h1>
                                <h4 class="h4 text-primary my-3">Login</h4>
                            </div>
                            <form method="post" class="w-75 m-auto pt-3" action="<?php echo base_url()?>welcome/login">
                                <div class="form-group">
                                    <input type="text" class="form-control"
                                        id="username" aria-describedby="emailHelp"
                                        placeholder="Username" name="username">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control"
                                        id="password" placeholder="Password" name="password">
                                </div>
                                <hr class="pt-3">
                                <button href="#" class="btn btn-success btn-user btn-block" type="submit">
                                    Login
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>