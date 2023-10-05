<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>

    <?php include('includes/head.php') ?>
</head>
<body>
    

<div class="container mt-5">
        <div class="row">
            <!-- Tool Cards -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ceaer cipher</h5>
                        <p class="card-text">additive </p>
                        <a href="ceaser.php" class="btn btn-primary">USE</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">DES </h5>
                        <p class="card-text">Data Encryption Standard.</p>
                        <a href="des.php" class="btn btn-primary">Use</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">AES</h5>
                        <p class="card-text"> algorithm</p>
                        <a href="aes.php" class="btn btn-primary">USE</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">RSA</h5>
                        <p class="card-text"> algorithm</p>
                        <a href="rsa.php" class="btn btn-primary">USE</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">RSA DS</h5>
                        <p class="card-text"> Digital signature</p>
                        <a href="bob.php" class="btn btn-primary">USE</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">elgamel</h5>
                        <p class="card-text"> algorithm</p>
                        <a href="elgamel.php" class="btn btn-primary">USE</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">hashing algorithm</h5>
                        <p class="card-text"> sha512</p>
                        <a href="hash.php" class="btn btn-primary">USE</a>
                    </div>
                </div>
            </div>

            <!-- Add more tool cards here -->

        </div>
    </div>


<?php include('includes/foot.php') ?>

</body>
</html>