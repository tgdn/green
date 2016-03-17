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
                            <?php echo Utils::escape($this->context['bill']['name']) ?>
                        </h3>
                        <h1 class="text-center">
                            <small>£</small>
                            <?php
                            $cost = number_format($this->context['bill']['cost'] / 100.0, 2, '.', ',');
                            echo Utils::escape($cost);
                            ?>
                        </h1>
                        <?php if ($this->context['can_pay']): ?>
                        <div class="text-center pay-block-btn">
                            <h3 class="text-muted">
                                <small>£</small>
                                <?php
                                $cost = number_format($this->context['ubill']['cost'] / 100.0, 2, '.', ',');
                                echo Utils::escape($cost);
                                ?>
                            </h3>
                            <button class="btn btn-md btn-t-contrast" id="paynow" data-id="<?php echo Utils::escape($this->context['bill']['id']) ?>">Pay now</button>
                        </div>
                        <?php endif; ?>
                        <div id="billview-app" class="larger-font">
                            <table class="table bills-table">
                                <thead>
                                    <tr>
                                        <th>Member</th>
                                        <th>Paid</th>
                                        <th>Amount <small class="text-muted">(£)</small></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php while ($bill = $this->context['user_bills']->fetchArray(SQLITE3_ASSOC)): ?>
                                    <?php
                                        /* get back to floating point */
                                        $cost = number_format($bill['cost'] / 100.0, 2, '.', ',');
                                        $full_name = $bill['user_id'] == $user->pk ? '<b>You</b>' : Utils::escape($bill['full_name']);
                                    ?>
                                    <tr>
                                        <td><?php echo $full_name ?></td>
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
            <?php $this->get_include('auth/footer') ?>
            <div class="clear"></div>
        </div>
    </div>
</div>

<?php $this->get_include('scripts'); ?>
<script src="<?php echo Utils::static_file('js/build/billview.bundle.js') ?>" type="text/javascript"></script>
</body>
</html>
