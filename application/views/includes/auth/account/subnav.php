<?php
global $user;

if (isset($this) && isset($this->context['subnav'])) {
    $class = $this->context['subnav'];
} else {
    $class = null;
}
?>

<div class="panel-heading has-nav">
    <ul class="nav nav-pills pull-left">
        <li role="presentation" class="<?php echo $class == 'profile' ? 'active' : '' ?>">
            <a tabindex="8" href="<?php echo Utils::url('account/') ?>">Profile</a>
        </li>
        <li role="presentation" class="<?php echo $class == 'password' ? 'active' : '' ?>">
            <a tabindex="9" href="<?php echo Utils::url('account/password') ?>">Password</a>
        </li>
        <!-- <li role="presentation" class="<?php echo $class == 'notifications' ? 'active' : '' ?>">
            <a tabindex="10" href="<?php echo Utils::url('account/notifications') ?>">Notifications</a>
        </li> -->
    </ul>
    <div class="clear"></div>
</div>
