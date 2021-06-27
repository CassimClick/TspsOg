<?php
$pageSession = \CodeIgniter\Config\Services::session();
?>

<?php if ($pageSession->getFlashdata('Success')) : ?>
<div id="message" class="alert alert-success text-center" role="alert">
    <?= $pageSession->getFlashdata('Success'); ?>
</div>
<?php endif; ?>
<?php if ($pageSession->getFlashdata('error')) : ?>
<div id="message" class="alert alert-danger text-center" role="alert">
    <?= $pageSession->getFlashdata('error'); ?>
</div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css">
    <title>Log in</title>
    <style>
    html,
    body {
        height: 100%;
    }

    .global-container {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f5f5f5;
    }

    .login-form {
        /* background: green; */
        width: 30%;
    }

    input {
        padding: 24px;
    }
    </style>
</head>

<body>

    <div class="global-container">
        <div class="card login-form">
            <div class="card-body">

                <div class="card-text">
                    <!--
			<div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div> -->
                    <form>
                        <!-- to error: add class "has-danger" -->
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="email" class="form-control form-control-sm" name="email"
                                aria-describedby="emailHelp">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control form-control-sm" name="email"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <!-- <a href="#" style="float:right;font-size:12px;">Forgot password?</a> -->
                            <input type="password" class="form-control form-control-sm" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Log in</button>

                        <div class="sign-up">
                            Do you have an account? <a href="<?=base_url()?>/login">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>