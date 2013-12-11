<div class='col-md-6'>
    <form method="POST">
        <!--E-mail-->
        <div class="form-group row">
            <div class='col-md-12'>
                <div class='input-group'>
                    <span class='input-group-addon'>E-mail</span>                
                    <input type="text" class="form-control" id="email" placeholder="E-mail" value="" />
                </div>
            </div>
        </div>
        <!--Password-->
        <div class="form-group row">
            <div class='col-md-12'>
                <div class='input-group'>
                    <span class='input-group-addon'>Wachtwoord</span>                
                    <input type="password" class="form-control" id="password" placeholder="Wachtwoord" value="" />
                </div>
            </div>
        </div>
        <input type="button" id="submit" class="btn btn-default" value="Aanmelden" />&nbsp;<input id="register" type="button" class="btn btn-success pull-right" value="Registreren" />
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#submit').click(function() {
            var email = $('#email').val();
            var password = $('#password').val();
            if (email.length > 0 && password.length > 0) {

                $.ajax({
                    url: 'users/login',
                    async: false,
                    data: {
                        email: email,
                        password: password
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        if (!response['success']) {
                            $('#response').html('Onbekende gegevens.');
                        }
                        else {
                            window.location.href = window.location.href;
                        }
                    }
                });
            }
            else {
                $('#response').html('Onbekende gegevens.');
            }
        });

        $('#register').click(function() {
            window.location.href = 'users/register';
        });
    });
</script>