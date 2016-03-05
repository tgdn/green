<link rel="stylesheet" type="text/css" href="<?php echo Utils::static_file('css/darktooltip.min.css') ?>">
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
                            Bill
                        </h5>

                        <div id="billview-app" class="larger-font">
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
<script src="<?php echo Utils::static_file('js/vendor/bootstrap-confirmation-t.js') ?>" type="text/javascript"></script>
<script src="<?php echo Utils::static_file('js/dashboard.js') ?>" type="text/javascript"></script>
</body>
</html>
