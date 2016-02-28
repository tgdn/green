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
                        <h3 class="text-center">
                            Delete house?
                        </h3>

                        <div id="housesettings-app" class="larger-font">

                            <form method="post" action="">
                                <div class="form-group form-group-lg">
                                    <p class="help-block text-lg">
                                        <span class="text-muted">This action will delete your house and all data related to it.</span>
                                        <br>
                                        <b class="text-dark">It cannot be undone.</b>
                                    </p>
                                    <input type="hidden" name="confirmdelete" value="1">
                                </div>

                                <div class="form-group text-center center-block">
                                    <input type="submit" value="Confirm delete" class="btn btn-t-red-outline">
                                    <a href="<?php echo Utils::url('h/' . $this->house['id'] . '/settings') ?>" class="btn btn-t-plain">Cancel</a>
                                </div>
                            </form>
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
</body>
</html>
