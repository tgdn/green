<title><?php echo $this->title ?></title>
</head>
<body>

<?php $this->get_include('navbar-auth') ?>

<div class="container">
    <div class="row">
        <div class="center-block col-sm-12">

            <div class="center-block col-sm-8 col-md-7 col-lg-6">
                <h3 class="text-right">
                    Account&nbsp;
                    <i class="icon ion-ios-toggle-outline"></i>
                </h3>
                <div class="panel panel-default">
                    <?php $this->get_include('auth/account/subnav') ?>
                    <div class="panel-body col-sm-10 col-sm-offset-1">
                        <form method="post" action="" id="accountpassword-form">
                            <div class="form-group form-group-lg">
                                <p class="help-block text-lg">
                                    Change your password often so it remains secure.
                                </p>
                                <label for="oldpass-id">Current password <small class="text-muted"></small></label>
                                <input type="password" name="oldpass" class="form-control" id="oldpass-id" placeholder="enter your current password here ...">
                            </div>

                            <h4 class="subtitle">Enter your new password</h4>

                            <div class="form-group form-group-lg">
                                <p class="help-block text-lg">
                                    Enter a difficult password so it cannot be easily guessed.
                                </p>
                                <label>Password</label>
                                <input type="password" name="password1" class="form-control" placeholder="your new password here ...">
                            </div>

                            <div class="form-group form-group-lg">
                                <label>Password confirmation</label>
                                <input type="password" name="password2" class="form-control" placeholder="type it again here ...">
                            </div>

                            <div id="js-errors" class="form-group has-error">
                            </div>

                            <?php foreach ($this->form_errors as $error) { ?>
                            <div class="form-group has-error">
                                <span class="help-block"><?php echo $error ?></span>
                            </div>
                            <?php } ?>

                            <div class="form-group text-center center-block">
                                <input type="submit" value="Change password" class="btn btn-t-contrast">
                                <a href="" class="btn btn-t-plain">Cancel</a>
                            </div>
                            <div class="form-group text-center center-block has-success" id="result">
                            </div>
                        </form>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="clear"></div>

        </div>
    </div>
</div>

<?php $this->get_include('scripts'); ?>
<script src="<?php echo Utils::static_file('js/build/accountpassword.bundle.js') ?>" type="text/javascript"></script>
</body>
</html>
