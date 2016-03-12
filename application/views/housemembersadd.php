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
                            Add housemate
                        </h5>

                        <div id="housemembersdelete-app" class="">
                            <form method="post" action="" id="add-housemate-form">

                                <div class="form-group form-group-lg col-sm-10 col-sm-offset-1">
                                    <p class="help-block">
                                        Add housemates as you wish simply by adding
                                        their email addresses below.
                                    </p>
                                </div>

                                <div class="email-label-group form-group form-group-lg col-sm-10 col-sm-offset-1">
                                    <label>
                                        Email address
                                        <small class="pull-right"><a href="#" id="add-another">+ Add another housemate</a></small>
                                    </label>
                                </div>

                                <div id="email-inputs">
                                    <div class="form-group form-group-lg col-sm-10 col-sm-offset-1">
                                        <input type="text" name="email[]" class="form-control" placeholder="name@domain.com">
                                        <a href="#" class="close-icon icon ion-ios-close-empty"></a>
                                    </div>
                                    <div class="form-group form-group-lg col-sm-10 col-sm-offset-1">
                                        <input type="text" name="email[]" class="form-control" placeholder="name@domain.com">
                                        <a href="#" class="close-icon icon ion-ios-close-empty"></a>
                                    </div>
                                    <div class="form-group form-group-lg col-sm-10 col-sm-offset-1">
                                        <input type="text" name="email[]" class="form-control" placeholder="name@domain.com">
                                        <a href="#" class="close-icon icon ion-ios-close-empty"></a>
                                    </div>
                                </div>

                                <div class="form-group text-center center-block">
                                    <input type="submit" value="Add members" class="btn btn-t-contrast">
                                    <a href="<?php echo Utils::url('h/' . $this->house['id'] . '/members') ?>" class="btn btn-t-plain">Cancel</a>
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
<script src="<?php echo Utils::static_file('js/vendor/bootstrap-confirmation-t.js') ?>" type="text/javascript"></script>
<script src="<?php echo Utils::static_file('js/build/addhousemates.bundle.js') ?>" type="text/javascript"></script>
</body>
</html>
