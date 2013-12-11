<div class="col-md-8">
    <form method="POST">
        <!--Date-->
        <div class="form-group row">
            <div class='col-md-12'>
                <div class='input-group'>
                    <span class='input-group-addon'>Datum</span>                
                    <input type="text" class="form-control" id="date" placeholder="Datum" value="" readonly='readonly' />
                </div>
                <span id='date_alert' class="label label-danger"></span>
            </div>
        </div>
        <!--Time-->
        <div class="form-group row">
            <div class='col-md-12'>
                <div class='input-group'>
                    <span class='input-group-addon'>Tijd</span>
                    <select class='form-control' id='time' disabled='disabled'>
                    </select>
                </div>
                <span id='time_alert' class="label label-danger"></span>
            </div>
        </div>
        <!--Duration-->
        <div class="form-group row">
            <div class='col-md-12'>
                <div class='input-group'>
                    <span class='input-group-addon'>Lengte</span>
                    <select id="duration"class="form-control" disabled='disabled'>
                        <?php for ($i = HOUR; $i <= HOUR * 3; $i += INTERVAL): ?>
                            <option value="<?php echo $i; ?>"><?php echo date('H:i', $i); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <span id='duration_alert' class="label label-danger"></span>
            </div>
        </div>
        <!--Amount-->
        <div class="form-group row">
            <div class='col-md-12'>
                <div class='input-group'>
                    <span class='input-group-addon'>Aantal personen</span>
                    <input type="text" class="form-control" id="amount" disabled='disabled' placeholder="Aantal personen" value="<?php echo MIN_PEOPLE_BOOKING; ?>" data-value='<?php echo MIN_PEOPLE_BOOKING; ?>' />  
                </div>
                <span id='amount_alert' class="label label-danger"></span>
            </div>
        </div>
        <!--Available spots-->
        <div class="form-group row">
            <div class='col-md-12'>
                <div class='input-group'>
                    <span class='input-group-addon'>Plekken over</span>
                    <input type="text" disabled='disabled' class="form-control" id="availableSpots" placeholder="Plekken over" value="" />  
                </div>
            </div>
        </div>
        <!--Submit-->
        <input type='button' value='Volgende' id="submit" class='submit btn btn-primary' disabled="disabled"/>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        // Sets the datepicker for the date input.
        $('#date').datepicker({
            dateFormat: "dd-mm-yy",
            minDate: 0
        });

        $('#date').change(function() {
            // If the date is changed get the new first and last possible reservation times and change the maximum amount of people that can reserve.
            $.ajax({
                url: 'reservations/json_get_schedule',
                type: 'POST',
                dataType: ' json',
                async: false,
                data: {
                    date: $(this).val()
                },
                success: function(response) {
                    // Reformat the time select.
                    $('#time').children().remove();
                    $.each(response['times'], function(key, value) {
                        $('#time').append('<option value="' + key + '">' + value + '</option>');
                    });

                    // Enable the following input fields.
                    $('#amount, #time, #duration').removeAttr('disabled');
                }
            });
        });

        $('#amount').keyup(function() {
            // If the value isn't an integer reset the value.
            if (!$.isNumeric(Math.floor($(this).val()))) {
                $('#amount').val(0);
            }

            // Run validateAmount.
            validateAmount($('#amount').val(), $('#availableSpots').val());
        });

        /**
         * 
         * @param int amount
         * @param int spots
         * @returns {undefined}
         */
        function validateAmount(amount, spots) {
            // Convert the variables to int.
            spots = parseInt(spots);
            amount = parseInt(amount);

            // If the amount of people booked is below the minimum
            if (amount < <?php echo MIN_PEOPLE_BOOKING; ?>) {
                $('#amount_alert').html('Een reservering moet uit minimaal <?php echo MIN_PEOPLE_BOOKING; ?> personen bestaan.');
                // Disable the submit.
                $('#submit').attr('disabled', 'disabled');
            }
            // If the amount of spots available is lower than the amount required by the customer.
            else if (spots < amount) {
                $('#amount_alert').html('Er zijn maar ' + spots + ' plaatsen beschikbaar.');
                // Disable the submit.
                $('#submit').attr('disabled', 'disabled');
            }
            else {
                $('#amount_alert').html('');
                $('#submit').removeAttr('disabled');
            }
        }

        // If any of the input fields change check the available spots and verify everything.
        $('#date, #time, #duration, #amount').change(function() {
            var date = $('#date').val();
            var time = $('#time').val();
            var duration = $('#duration').val();
            var amount = $('#amount').val();

            // Get the available spots.
            if (date && time && duration && amount) {
                $.ajax({
                    url: 'reservations/json_get_available_spots',
                    async: false,
                    dataType: 'json',
                    data: {
                        date: date,
                        time: time,
                        duration: duration
                    },
                    type: 'POST',
                    success: function(response) {
                        $('#availableSpots').val(response['spots']);
                        validateAmount($('#amount').val(), response['spots']);
                    }
                });
            }
        });

        // Post the data to the server and change the content based on the response.
        $('.submit').click(function() {
            $.ajax({
                url: 'reservations/add',
                async: false,
                data: {
                    amount: $('#amount').val(),
                    date: $('#date').val(),
                    time: $('#time').val(),
                    duration: $('#duration').val(),
                    form: 'availability'
                },
                type: 'POST',
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
