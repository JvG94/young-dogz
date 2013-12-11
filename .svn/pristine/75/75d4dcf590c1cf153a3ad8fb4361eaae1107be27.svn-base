<div class="col-md-8">
    <form method="POST">
        <!--Menu selection-->
        <?php for ($i = 1; $i <= $amount; $i++): ?>
            <div class="panel panel-default">
                <div class='panel-heading'>Persoon <?php echo $i; ?></div>
                <div class="panel-body">
                    <div class="form-group row">
                        <div class='col-md-12'>
                            <div class='input-group'>
                                <span class='input-group-addon'>Menuselectie</span>
                                <select class="form-control menu-selection" data-index="<?php echo $i; ?>">
                                    <?php foreach ($menus as $menu): ?>
                                        <option value="<?php echo $menu->id; ?>"><?php echo $menu->title; ?> - <?php echo $menu->price; ?></option>
                                    <?php endforeach; ?>
                                </select> 
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class='col-md-12'>
                            <div class='input-group'>
                                <span class='input-group-addon'>Opmerkingen</span>
                                <textarea class="form-control comment" data-index="<?php echo $i; ?>"placeholder="Opmerkingen"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
        <!--Submit-->
        <input type='button' value='Controleer' id="submit" class='submit btn btn-primary' />
    </form>
</div>
<div class="col-md-4">
    <!--Date-->
    <div class="form-group row">
        <div class='col-md-12'>
            <div class='input-group'>
                <span class='input-group-addon'>Datum</span>                
                <input type="text" class="form-control" value="<?php echo date('d-m-Y', strtotime($date)); ?>" disabled='disabled' />
            </div>
        </div>
    </div>
    <!--Time-->
    <div class="form-group row">
        <div class='col-md-12'>
            <div class='input-group'>
                <span class='input-group-addon'>Tijd</span>
                <input type="text" class="form-control" value="<?php echo $time; ?>" disabled='disabled' />
            </div>
            <span id='time_alert' class="label label-danger"></span>
        </div>
    </div>
    <!--Duration-->
    <div class="form-group row">
        <div class='col-md-12'>
            <div class='input-group'>
                <span class='input-group-addon'>Lengte</span>
                <input type="text" class="form-control" value="<?php echo date('H:i', $duration); ?>" disabled='disabled' />
            </div>
            <span id='time_alert' class="label label-danger"></span>
        </div>
    </div>
    <!--Amount-->
    <div class="form-group row">
        <div class='col-md-12'>
            <div class='input-group'>
                <span class='input-group-addon'>Aantal personen</span>
                <input type="text" class="form-control" value="<?php echo $amount; ?>" disabled='disabled' />
            </div>
            <span id='time_alert' class="label label-danger"></span>
        </div>
    </div>
</div>
<script type='text/javascript'>
    $(document).ready(function() {
        // Set the correct variables from the previous part.
        var amount = <?php echo $amount; ?>;
        var time = "<?php echo $time; ?>";
        var duration = <?php echo $duration; ?>;
        var date = "<?php echo $date; ?>";

        /**
         * When the submit button is pressed put all the passed data into the array. 
         * The array is then along with all the other information posted to the server,
         * where it is processed. If the reservation is successfully processed the HTML is updated.
         */
        $('#submit').click(function() {
            var menus = {};
        
            // Set the menu id in the array.
            $('.menu-selection').each(function(index) {
                index = index.toString();
                
                if (typeof menus[index] === 'undefined') {
                    menus[index] = {};
                }
                menus[index]['id'] = $(this).val();
            });

            // Set the comment in the array.
            $('.comment').each(function(index) {
                index = index.toString();
                
                if (typeof menus[index] === 'undefined') {
                    menus[index] = {};
                }
                menus[index]['comment'] = $(this).val();
            });

            // Post all data to the server.
            $.ajax({
                async: false,
                url: 'reservations/add',
                type: 'POST',
                data: {
                    menus: menus,
                    amount: amount,
                    duration: duration,
                    date: date,
                    time: time,
                    form: 'menu'
                },
                dataType: 'json',
                success: function(response) {
                    // Should only happen if there is a serious error or if the user tried to manipulate the code.
                    if (response['error']) {
                        $('.response').html('Er is iets foutgegaan probeer het nogmaals.');
                    }
                    // Replace the content with the response.
                    else {
                        $('.inner-content').html(response['html']);
                    }
                }
            });
        });
    });
</script>