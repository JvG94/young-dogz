<h1>Kassa</h1>
<?php if (is_array($products)): ?>
    <table id="item-list">
        <thead>
            <tr>
                <th width='200'>Titel</th>
                <th width='200'>Prijs</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['title']; ?></td>
                    <td><?= $product['price']; ?></td>
                    <td><a href='javascript:void(0);' data-id='<?= $product["id"]; ?>' data-title='<?= $product["title"]; ?>' data-price='<?= $product["price"]; ?>'>Add</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
<div style="float: right; width: 300px;" id='order-list'>
    <?php echo $this->element('counter/list'); ?>
</div>
<script type='text/javascript'>
    $('#item-list td > a').click(function() {
        $.ajax({
            type: 'POST',
            data: {
                id: $(this).attr('data-id'),
                price: $(this).attr('data-price'),
                title: $(this).attr('data-title')
            },
            url: 'counter/add',
            success: function(response) {
                $('#order-list').html(response);
            }
        });
    });
    
    $('body').on('click', '.product-remove', function() {
        $.ajax({
            type: 'POST',
            data: {
                id: $(this).attr('data-id')
            },
            url: 'counter/remove',
            success: function(response) {
                $('#order-list').html(response);
            }
        });
    });
</script>