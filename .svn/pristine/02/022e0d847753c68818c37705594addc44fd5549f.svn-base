<?php if (is_array($items)): ?>
    <table>
        <thead>
            <tr>
                <th>Titel</th>
                <th>Prijs</th>
                <th>Aantal</th>
                <th>Totaal</th>
            </tr>
        </thead>
        <tbody>            
            <?php foreach ($items as $item): ?>
            <tr>
                <td><?=$item['title'];?></td>
                <td><?=$item['price'];?></td>
                <td><?=$item['amount'];?></td>
                <td><?=$item['amount'] * $item['price'];?></td>
                <td><a href='javascript:void(0);' data-id='<?=$item['id'];?>' class='product-remove'>x</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
<?php endif; ?>