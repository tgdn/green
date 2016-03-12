<title><?php echo $this->title ?></title>
</head>
<body>

<?php $this->get_include('navbar-auth') ?>

<div class="container">
    <div class="row">
        <div class="center-block col-sm-12">
            <?php $this->get_include('auth/houseview-sidebar') ?>
            <div class="col-sm-8 col-md-8 col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h5>
                            House Preferences
                        </h5>
                        <div id="housesettings-app" class="larger-font">
                            <form method="post" action="" id="house-settings-form">
                                <div class="form-group form-group-lg">
                                    <p class="help-block">
                                        <b class="text-dark">You can change your house name.</b> And reflect changes in your lifestyle.
                                    </p>
                                </div>
                                <div class="form-group form-group-lg">
                                    <label for="name-id">House name</label>
                                    <input type="text" name="name" class="form-control" id="name-id" placeholder="Ex. Flat 16, Home, Summer camp ..." value="<?php echo Utils::escape($this->house['name']) ?>">
                                </div>

                                <?php foreach ($this->form_errors as $error): ?>
                                <div class="form-group has-error">
                                    <span class="help-block"><?php echo $error ?></span>
                                </div>
                                <?php endforeach; ?>

                                <div class="form-group text-center center-block">
                                    <input type="submit" value="Save changes" class="btn btn-t-contrast">
                                </div>
                            </form>
                            <hr>
                            <p class="text-left">
                                <span class="help-block text-lg">
                                    <b class="text-dark">Token</b>
                                    <br>
                                    Share this token so housemates can join instantly.
                                </span>
                                <kbd id="token"><?php echo Utils::escape($this->house['token']) ?></kbd>
                                &nbsp;
                                <a href="#" data-href="<?php echo Utils::url('h/' . $this->house['id'] . '/settings/gentoken') ?>" id="gen-token-link">
                                    <i class="icon ion-ios-loop-strong fa"></i>
                                    Generate new token
                                </a>
                            </p>
                            <hr>
                            <div class="text-left">
                                <p class="help-block text-lg">
                                    <b class="text-dark">Danger Zone</b>
                                    <br>
                                    Here you can delete your house and all its data
                                    (including bills and different notifications).
                                </p>
                                <a class="btn btn-t-red-outline" href="<?php echo Utils::url('h/' . $this->house['id'] . '/delete') ?>">
                                    Delete house
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-4 col-lg-offset-0 col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul class="list-inline footer-list">
                            <li>CS139 - University of Warwick</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<?php $this->get_include('scripts'); ?>
<script src="<?php echo Utils::static_file('js/build/tokengen.bundle.js') ?>" type="text/javascript"></script>
</body>
</html>
