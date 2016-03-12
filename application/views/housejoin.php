<title><?php echo $this->title ?></title>
</head>
<body>

<?php $this->get_include('navbar-auth') ?>

<div class="container">
    <div class="row">
        <div class="center-block col-sm-12">

            <div class="center-block col-sm-7 col-md-6 col-lg-5">
                <div class="panel panel-default">
                    <div class="panel-body col-sm-10 col-sm-offset-1">
                        <h3 class="text-center">
                            Join house
                        </h3>
                        <div id="housecreate-app" class="larger-font">
                            <form method="post" action="">
                                <div class="form-group form-group-lg">
                                    <p class="help-block text-lg">
                                        Use the token of the house you want be part of
                                        to join it instantly.
                                    </p>
                                    <label for="token-id">Token</label>
                                    <input type="text" name="token" class="form-control" id="token-id" placeholder="It is 20 characters long">
                                </div>

                                <?php foreach ($this->form_errors as $error) { ?>
                                <div class="form-group has-error">
                                    <span class="help-block"><?php echo $error ?></span>
                                </div>
                                <?php } ?>

                                <div class="form-group text-center center-block">
                                    <input type="submit" value="Join" class="btn btn-t-contrast">
                                    <a href="<?php echo Utils::url('dashboard') ?>" class="btn btn-t-plain">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>

<?php $this->get_include('scripts'); ?>
</body>
</html>
