<title><?php echo $this->title ?></title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="center-block col-sm-6 col-md-5 col-lg-4">
            <p class="brand home-brand lead text-center">
                Green
            </p>
            <p class="lead text-left">
                <em>Your household management service.</em>
            </p>
        </div>
    </div>
</div>

<?php $this->get_include('navbar') ?>

<div class="container">
    <div class="row">
        <div class="center-block col-sm-6 col-md-5 col-lg-4" id="public-app-main">
            <form method="post" action="" id="login-form">
                <?php echo $this->context['csrf_token_input'] ?>
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
