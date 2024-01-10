<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.js"></script>
</head>
<style>
    .divider:after,
    .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
    }
</style>
<?php include "../include/function.php"; ?>

<body>
    <?= pesan($_GET['alert']) ?>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center">

                <div class="col-md-4 mt-5">
                    <div class="card">
                        <div class="card-header">
                            <center>
                                <h4>Silahkan Login</h4>
                            </center>
                        </div>
                        <div class="card-body">
                            <form class="m-3" method="POST" action="cek_login.php">
                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <input type="text" id="form1Example13" name="username" class="form-control form-control-lg" />
                                    <label class="form-label" for="form1Example13">Username</label>
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <input type="password" id="form1Example23" name="password" class="form-control form-control-lg" />
                                    <label class="form-label" for="form1Example23">Password</label>
                                </div>


                                <!-- Submit button -->
                                <center><button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button></center>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>