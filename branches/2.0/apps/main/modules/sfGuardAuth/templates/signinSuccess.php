<h1>Login</h1>

<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
  <div class="form">
    <?php echo $form ?>
    
    <div class="form-row">
			<label>&nbsp;</label>
  		<input type="submit" value="sign in" />
  	</div>
  </div>
</form>

<script type="text/javascript">
	$(document).ready(function()
		{
			$('#signin_username').focus();
		}
	);
</script>
