<h1>Contact</h1><br />
<div class="col-md-12">
    <form method="POST">
        <div class="form-group row">
            <div class='col-md-6'>
                <div class='input-group'>
                    <span class='input-group-addon'>E-mail</span>                
                    <input type="text" class="form-control" name="email" value="<?php echo isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : ''; ?>" placeholder="E-mail" id="email" />
                </div>
                <span class="label label-danger" id="email_alert"></span>
            </div>
        </div>
        <div class="form-group row">
            <div class='col-md-6'>
                <div class='input-group'>
                    <span class='input-group-addon'>Tekst</span>                
                    <textarea id="text" class="form-control" name="text" placeholder="Tekst"></textarea>
                </div>
                <span class="label label-danger" id="text_alert"></span>
            </div>
        </div>
        <input type="submit" id="submit" class="btn btn-primary" value='Verstuur' />
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        function checkEmail() {
            if (validateEmail($('#email').val())) {
                $('#email_alert').html('');
                return true;
            }
            else {
                $('#email_alert').html('Ongeldig e-mailadres.');
                return false;
            }
        }

        function checkText() {
            if ($('#text').val().length > 0) {
                $('#text_alert').html('');
                return true;
            }
            else {
                $('#text_alert').html('Tekst is vereist.');
                return false;
            }
        }

        $('#email').change(checkEmail);
        $('#text').change(checkText);

        $('#submit').click(function() {
            var error = false;
            if (!checkText()) {
                error = true;
            }
            if (!checkEmail()) {
                error = true;
            }
            return !error;
        });
    });
</script>