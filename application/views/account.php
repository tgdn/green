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
                        <form method="post" action="" id="accountprofile-form">
                            <div class="form-group form-group-lg">
                                <p class="help-block text-lg">
                                    Here you can change your profile settings to update your details.
                                </p>
                                <label for="name-id">Full name <small class="text-muted">(use your real one so your flatmates can recognise you)</small></label>
                                <input type="text" name="fname" class="form-control" id="name-id" placeholder="First name and last name" value="<?php echo Utils::escape($user->full_name) ?>">
                            </div>

                            <h4 class="subtitle">Change your email address</h4>

                            <div class="form-group form-group-lg">
                                <p class="help-block text-lg">
                                    You might want to use a different email address.
                                </p>
                                <label>Email address</label>
                                <input type="text" name="email" class="form-control" placeholder="name@domain.com" value="<?php echo Utils::escape($user->email) ?>">
                            </div>

                            <div id="js-errors" class="form-group has-error">
                            </div>

                            <?php foreach ($this->form_errors as $error) { ?>
                            <div class="form-group has-error">
                                <span class="help-block"><?php echo $error ?></span>
                            </div>
                            <?php } ?>

                            <div class="form-group text-center center-block">
                                <input type="submit" value="Save changes" class="btn btn-t-contrast">
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
<script src="<?php echo Utils::static_file('js/build/accountprofile.bundle.js') ?>" type="text/javascript"></script>
</body>
</html>
