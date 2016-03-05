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
                        <h3 class="text-center">
                            Bills
                        </h3>

                        <div id="billindex-app" class="larger-font">
                            <div class="table-responsive">
                                <table class="table bills-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Paid</th>
                                            <th>Amount <small class="text-muted">(£)</small></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $tabindex = 7 ?>
                                    <?php while ($bill = $this->context['bills']->fetchArray(SQLITE3_ASSOC)): ?>
                                        <?php
                                            /* get back to floating point */
                                            $cost = number_format($bill['cost'] / 100.0, 2, '.', ',');
                                            $created_at = new DateTime($bill['created_at']);
                                            $tabindex++;
                                        ?>
                                        <tr tabindex="<?php echo $tabindex ?>" class="bill-el" data-url="<?php echo Utils::url('h/' . $this->house['id'] . '/bills/' . $bill['id']) ?>">
                                            <td><?php echo Utils::escape($bill['name']) ?></td>
                                            <td><?php echo $created_at->format('F j, Y') ?></td>
                                            <td><?php echo $bill['paid'] ? '<i class="icon has-paid ion-ios-checkmark-empty"></i>' : '' ?></td>
                                            <td><?php echo Utils::escape($cost) ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
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
