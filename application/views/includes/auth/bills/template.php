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
                    <?php $this->get_include('auth/bills/subnav') ?>
                    <div class="panel-body">

                        <div id="billindex-app" class="larger-font">
                            <?php $this->get_include('auth/bills/billtable') ?>
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
<script type="text/javascript">
    $(document).ready(function() {

        $('.bill-el').bind('click keydown', function(e) {
            /* only carry on if we pressed enter */
            if (e.type == 'keydown' && e.keyCode != 13) {
                return;
            }

            var url = $(this).data('url');

            if ( (navigator.platform == 'MacIntel' && e.metaKey) || (navigator.platform != 'MacIntel' && e.ctrlKey) ) {
                var win = window.open(url, '_blank');
                win.focus();
            } else {
                window.location = $(this).data('url');
            }
        })
    });
</script>
</body>
</html>
