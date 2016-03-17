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
        <li role="presentation" class="<?php echo $class == 'summary' ? 'active' : '' ?>">
            <a tabindex="9" href="<?php echo Utils::url('h/' . $this->house['id'] . '/bills') ?>">Summary</a>
        </li>
    </ul>
    <ul class="nav nav-pills pull-right">
        <li role="presentation" class="<?php echo $class == 'all' ? 'active' : '' ?>">
            <a tabindex="10" href="<?php echo Utils::url('h/' . $this->house['id'] . '/bills/all') ?>">All bills</a>
        </li>
        <li role="presentation" class="<?php echo $class == 'pending' ? 'active' : '' ?>">
            <a tabindex="11" href="<?php echo Utils::url('h/' . $this->house['id'] . '/bills/pending') ?>">Pending bills</a>
        </li>
        <li role="presentation" class="<?php echo $class == 'paid' ? 'active' : '' ?>">
            <a tabindex="12" href="<?php echo Utils::url('h/' . $this->house['id'] . '/bills/paid') ?>">Paid bills</a>
        </li>
    </ul>
    <div class="clear"></div>
</div>
