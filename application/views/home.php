<title><?php echo $this->title ?></title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="center-block col-sm-6 col-md-5 col-lg-4">
            <p class="lead text-left">
                <br>
                <em>
                    Welcome to Green,
                    <br>
                    your household management service.
                </em>
            </p>
        </div>
    </div>
</div>

<?php $this->get_include('navbar') ?>

<div class="container">
    <div class="row">
        <div class="center-block col-sm-6 col-md-5 col-lg-4" id="public-app-main">
            <form method="post" action="" id="login-form">
                <div class="form-group form-group-lg">
                    <input type="email" name="email" class="form-control" id="email-id" placeholder="Email">
                </div>
                <div class="form-group form-group-lg">
                    <input type="password" name="password" class="form-control" id="password-id" placeholder="Password">
                </div>

                <?php foreach ($this->login_errors as $error) { ?>
                <div class="form-group has-error">
                    <span class="help-block"><?php echo $error ?></span>
                </div>
                <?php } ?>

                <div class="form-group text-center">
                    <input type="submit" value="Enter" class="btn btn-lg btn-block btn-t-plain">
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->get_include('scripts'); ?>
</body>
</html>
