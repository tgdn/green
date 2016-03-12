<title><?php echo $this->title ?></title>
</head>
<body>

<?php $this->get_include('navbar-auth') ?>
<?php $is_you = (int)$this->context['member']['id'] == (int)$user->pk ? true : false; ?>

<div class="container">
    <div class="row">
        <div class="center-block col-sm-12">
            <?php $this->get_include('auth/houseview-sidebar') ?>

            <div class="col-sm-8 col-md-8 col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3 class="text-center">
                        <?php if ($is_you): ?>
                            Leave <span class="text-muted"><?php echo Utils::escape($this->house['name']) ?></span> ?
                        <?php else: ?>
                            Remove <?php echo Utils::escape($this->context['member']['full_name']) ?> from <span class="text-muted"><?php echo Utils::escape($this->house['name']) ?></span> ?
                        <?php endif; ?>
                        </h3>

                        <div id="housesettings-app" class="larger-font">

                            <form method="post" action="">
                                <div class="form-group form-group-lg">
                                    <p class="help-block text-lg">
                                        <span class="text-muted"><?php echo $is_you ? 'You' : 'He/she'; ?> will still be able to join this house using the house token.</span>
                                        <br>
                                        <b>token:</b> <kbd><?php echo Utils::escape($this->house['token']) ?></kbd>
                                    </p>
                                    <input type="hidden" name="remove_confirmation" value="1">
                                </div>

                                <div class="form-group text-center center-block">
                                    <input type="submit" value="Confirm" class="btn btn-t-red-outline">
                                    <a href="<?php echo Utils::url('h/' . $this->house['id'] . '/members') ?>" class="btn btn-t-plain">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->get_include('auth/footer') ?>
            <div class="clear"></div>
        </div>
    </div>
</div>

<?php $this->get_include('scripts'); ?>
</body>
</html>
