<table cellspacing="0">
<?php echo form_tag('/security/login'); ?>
	<h2>Please Login</h2>
	
	<?php if ($sf_request->hasErrors()): ?>
		<tr>
			<td class="error_header" colspan="2">
			 	There were errors processing your login
			</td>
			<?php foreach($sf_request->getErrors() as $error): ?>
				<tr>
					<td colspan="2" style="background-color: #f4a9a9;"><?php echo $error; ?></td>
				</tr>
			<?php endforeach; ?>
		</tr>
	<?php endif; ?>
	
	<tr>
		<td class="first"><?php echo label_for('username', 'User'); ?></td>
		<td class="second"><?php echo input_tag('username'); ?></td>
	</tr>
	
	<tr>
		<td class="first"><?php echo label_for('password', 'Password'); ?></td>
		<td class="second"><?php echo input_password_tag('password'); ?></td>
	</tr>
	
	<tr>
		<td><?php echo submit_tag('Login'); ?></td>
	</tr>
	
</form>
</table>