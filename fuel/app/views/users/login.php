<h2>Login</h2>
Login to your account using your username and password.
<?php echo isset($errors) ? $errors : false; ?>

<?php echo Form::open(array('action' => 'users/login', 'method' => 'post', 'id' => 'login-form')); ?>
<div class="input text required">
    <?php echo Form::label('Username', 'username'); ?>
    <?php echo Form::input('username', NULL, array('size' => 30, 'id' => 'username')); ?>
</div>
<div class="input password required">
    <?php echo Form::label('Password', 'password'); ?>
    <?php echo Form::password('password', NULL, array('size' => 30, 'id' => 'password')); ?>
</div>
<div class="input submit">
    <?php echo Form::submit('login', 'Login'); ?>
</div>
<div id="login-messages"></div>

<script type="text/javascript">
    $(document).ready(function()
    {
        // We'll catch form submission to do it in AJAX, but this works also with JS disabled
        $('#login-form').submit(function(event)
        {
            // Stop full page load
            event.preventDefault();

            // Check fields
            var login = $('#username').val();
            var pass = $('#password').val();

            if (!login || login.length == 0)
            {
                alert('Please enter a username.');
            }
            else if (!pass || pass.length == 0)
            {
                alert('Please enter a password.');
            }
            else
            {
                $('input[type=submit]', this).attr('disabled', 'disabled');

                // Request
                var data = {
                    username: login,
                    password: pass
                };

                // Start timer
                var sendTimer = new Date().getTime();

                // Send
                $.ajax({
                    url: '/q/auth/check',
                    dataType: 'json',
                    type: 'POST',
                    data: data,
                    success: function(data, textStatus, XMLHttpRequest)
                    {
                        // now, we get two important pieces of data back from our rest controller
                        // data.valid = true/false
                        // data.redirect = the page we redirect to on successful login
                        if (data.valid)
                        {
                            // Small timer to allow the 'checking login' message to show when server is too fast
                            var receiveTimer = new Date().getTime();
                            if (receiveTimer-sendTimer < 500)
                            {
                                setTimeout(function()
                                {
                                    document.location.href = data.redirect;

                                }, 500-(receiveTimer-sendTimer));
                            }
                            else
                            {
                                document.location.href = data.redirect;
                            }
                        }
                        else
                        {
                            $('#login-messages').html("Error: " + data.error);
                            $('input[type=submit]').removeAttr('disabled');
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                        $('#login-messages').html("textStatus: " + textStatus + " and errorThrown: " + errorThrown);
                        $('input[type=submit]').removeAttr('disabled');
                    }
                });

                $('#login-messages').html('Please wait, checking login...');
            }
        });
    });

</script>