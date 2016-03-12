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
        <?php
            $tabindex = 11;
            $billscount = 0;
        ?>
        <?php while ($bill = $this->context['bills']->fetchArray(SQLITE3_ASSOC)): ?>
            <?php
                /* get back to floating point */
                $cost = number_format($bill['cost'] / 100.0, 2, '.', ',');
                $created_at = new DateTime($bill['created_at']);
                $tabindex++;
                $billscount++;
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
    <?php if ($billscount == 0): ?>
        <h3 class="text-center text-muted">No bills</h3>
    <?php endif; ?>
</div>
