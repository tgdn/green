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
                    <div class="panel-body col-sm-10 col-sm-offset-1">
                        <h3 class="text-center">
                            Create new bill
                        </h3>

                        <div id="billcreate-app" class="larger-font">

                            <form method="post" action="" id="bills-create-form">
                                <div class="form-group form-group-lg">
                                    <p class="help-block">
                                        <b class="text-dark">Create a bill to split between your housemates.</b>
                                        <br>
                                        And never forget where your money went.
                                    </p>
                                </div>
                                <div class="form-group form-group-lg">
                                    <label for="name-id">Description</label>
                                    <input tabindex="8" type="text" name="name" class="form-control" id="name-id" placeholder="Ex. Gas September, Restaurant, July's rent ..." value="<?php echo Utils::escape(isset($_POST['name']) ? $_POST['name'] : '' ) ?>">
                                </div>

                                <div class="form-group form-group-lg">
                                    <label for="cost-id">Amount</label>
                                    <input tabindex="9" type="number" min="0.0" step="0.01" name="cost" class="form-control" id="cost-id" placeholder="Ex. 12.5, 7.0 ..." value="">
                                </div>

                                <div class="form-group form-group-lg">
                                    <p class="help-block">
                                        Split equally or select ratio?
                                    </p>

                                    <div class="text-center bills-create_members-option-radio">
                                        <div class="visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block">
                                            <label class="radio-inline">
                                                <input tabindex="10" type="radio" name="billopt" id="billopt1" value="split" checked> Split equally
                                            </label>
                                            <label class="radio-inline">
                                                <input tabindex="11" type="radio" name="billopt" id="billopt2" value="select"> Select ratio
                                            </label>
                                        </div>
                                    </div>

                                    <p class="help-block">
                                        <b class="text-dark">Next, select members.</b>
                                    </p>

                                    <div class="row">
                                        <div class="bills-create_members-select-list col-sm-12 col-md-10 center-block">
                                        <?php $tabindex = 11 ?>
                                        <?php while ($member = $this->context['members']->fetchArray(SQLITE3_ASSOC)): ?>
                                            <?php $tabindex++; $is_you = (int)$member['id'] == (int)$user->pk ? true : false; ?>
                                            <div class="checkbox">
                                                <label>
                                                    <input tabindex="<?php echo $tabindex ?>" type="checkbox" name="userselect" class="sr-only" value="<?php echo $member['id'] ?>">
                                                    <span>
                                                        <i class="icon checked ion-ios-checkmark-outline"></i>
                                                        <i class="icon unchecked ion-ios-circle-outline"></i>
                                                        <?php echo $is_you ? 'You' : Utils::escape($member['full_name']) ?>
                                                    </span>
                                                </label>
                                                <div class="cost-container">
                                                    <input type="text" name="<?php echo "user-{$member['id']}-cost" ?>" disabled value="0.0" />
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                        </div>
                                    </div>
                                </div>

                                <div id="js-errors" class="form-group has-error">
                                </div>

                                <?php foreach ($this->form_errors as $error): ?>
                                <div class="form-group has-error">
                                    <span class="help-block"><?php echo $error ?></span>
                                </div>
                                <?php endforeach; ?>

                                <div class="form-group text-center center-block">
                                    <input type="submit" value="Create" class="btn btn-t-contrast">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <?php $this->get_include('auth/footer') ?>
            <div class="clear"></div>
        </div>
    </div>
</div>

<?php $this->get_include('scripts'); ?>
<script src="<?php echo Utils::static_file('js/build/createbill.bundle.js') ?>" type="text/javascript"></script>
</body>
</html>
