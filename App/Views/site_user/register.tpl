<script>
	
	$(document).ready(function() {			
		$('.phone').mask('(999) 999-9999');

		$('input[name="data[User][account_type_id]"]').click(function() {
			if ($(this).val() == 1) {
				$(".business-info").show();
			} else {
				$(".business-info").hide();
			}
		});	
		
		$('#username').blur(function() {
			$.post (
				'/users/validate_form',
				{ 
					field: $('#username').attr('id'),
					value: $('#username').val()
				},
				handleUsernameValidation
			);
		});
		
		function handleUsernameValidation(error) {
	          if (error.length > 0) {
	               if ($('#username-notEmpty').length == 0) {
	                    $('#username').after('<div id="username-notEmpty" class="error-message">' + error + '<div>');
	               }
	          }
	          else {
	               $('#username-notEmpty').remove();
	          }
	     }
	     
				
		// $("#companyNameSearch").autocomplete({
		// 	minLength: 5,
		// 	source: SITE_URL + "/companies/autoComplete",
		// 	select: function(event, ui) {
		// 		$("#companyId").val(ui.item.id);
		// 		$("#companyAddress").val(ui.item.address);
		// 		$("#companyCity").val(ui.item.city);
		// 		$("#companyState").val(ui.item.state);
		// 		$("#companyZip").val(ui.item.zip);
		// 		$("#companyPhone").val(ui.item.phone);
		// 		$("#companyFax").val(ui.item.fax);
		// 		$("#companyEmail").val(ui.item.email);
		// 		$("#companyLicense").val(ui.item.license);

		// 	}			
		// });
	});
	
				
</script>

<div id="public">
	<h1>Register</h1>
	<?php echo $this->Form->create(array('id' => 'registrationForm')); ?>
		<table class="registration ui-widget ui-widget-content ui-corner-all">
			<tr>
				<th colspan="4" align="center">Individual Info</th>
			</tr>
			<tr>	
				<td><?php echo $this->Form->input('first_name', array('type' => 'text', 'label' => 'First Name:<br>', 'size' => '28', 'id' => 'firstname')); ?></td>
				<td colspan="2"><?php echo $this->Form->input('last_name', array('type' => 'text', 'label' => 'Last Name:<br>', 'size' => '55', 'id' => 'lastname')); ?></td>
			</tr>
			<tr>
				<td colspan="3"><?php echo $this->Form->input('address', array('type' => 'text', 'label' => 'Address:<br>', 'size' => '104', 'id' => 'userAddress')); ?></td>
			</tr>
			<tr>
				<td><?php echo $this->Form->input('city', array('type' => 'text', 'label' => 'City:<br>', 'size' => '28', 'id' => 'city')); ?></td>
				<td>
					State:<br>
					<select name="data[User][state]" id="user-state">
						<option value="">Select your state...</option>
						<?php foreach ($states as $k => $s): ?>
							<option value="<?php echo $k; ?>"><?php echo $s; ?> (<?php echo $k; ?>)</option>
						<?php endforeach; ?>
					</select>
				</td>
				<td><?php echo $this->Form->input('zip', array('type' => 'text', 'label' => 'Zip Code:<br>', 'id' => 'zip')); ?></td>
				
			<tr>
				<td colspan="2"><?php echo $this->Form->input('username', array('type' => 'text', 'label' => 'Username (email address):<br>', 'size' => '50', 'id' => 'username')); ?></td>
				
				<td><?php echo $this->Form->input('phone', array('type' => 'text', 'label' => 'Phone Number:<br>', 'size' => '18', 'id' => 'phone', 'class' => 'phone')); ?></td>			
			</tr>
			<tr>
				<td><?php echo $this->Form->input('password', array('type' => 'password', 'label' => 'Password:<br>', 'id' => 'password')); ?></td>
				<td colspan="2"><?php echo $this->Form->input('verify_password', array('type' => 'password', 'label' => 'Re-enter Password:<br>', 'id' => 'verify_password')); ?></td>
			</tr>
			<tr>
				<td valign="top">Account Type: <img src="/img/information.png" alt="Information tooltip" id="account-type-tip" class="tooltip-button" /><div class="tooltip">As development of BuildCommand progresses there will be more account types available, but in the initial beta release the only available functionality will be for builders.</div></td>
				
				<td><?php echo $this->Form->input('account_type_id', array('type' => 'radio', 'options' => array(1 => 'Builder'), 'legend' => false, 'separator' => '<br>', 'id' => 'accountType')); ?>
	<!-- 				<input type="radio" name="account_type" value="contractor">Contractor -->
				</td>
	<!--
				<td>
					<input type="radio" name="account_type" value="supplier">Supplier <br>
				</td>
	-->
			</tr>
			<tr>
				<td colspan="3"><div id="register-note">NOTE: Additional user accounts can be added to the company profile after creating the first account, logging in, and going to "Account Info" -> "Add Users".</div></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</table>
	
	<br>
	<br>
	
	<table class="registration business-info  ui-widget ui-widget-content ui-corner-all">
		<tr>
			<th colspan="4" align="center">Business Info</th>
		</tr>
		<tr>
			<?php echo $this->Form->input('Company.id', array('type' => 'hidden', 'id' => 'companyId')); ?>
			<td colspan="3"><?php echo $this->Form->input('Company.name', array('label' => 'Company Name:<br>', 'size' => '80', 'type' => 'text', 'id' => 'companyNameSearch')); ?></td>
		</tr>
		<tr>
			<td colspan="3"><?php echo $this->Form->input('Company.address', array('label' => 'Street Address:<br>', 'size' => '80', 'type' => 'text', 'id' => 'companyAddress')); ?></td>
		</tr>
		<tr>
			<td><?php echo $this->Form->input('Company.city', array('label' => 'City:<br>', 'type' => 'text', 'id' => 'companyCity')); ?></td>
			<td>
				State:<br>
				<select name="data[Company][state]" id="companyState">
					<option value="">Select your state...</option>
					<?php foreach ($states as $k => $s): ?>
						<option value="<?php echo $k; ?>"><?php echo $s; ?> (<?php echo $k; ?>)</option>
					<?php endforeach; ?>
				</select>
			</td>
			<td><?php echo $this->Form->input('Company.zip', array('type' => 'text', 'size' => '14', 'id' => 'companyZip')); ?></td>
		</tr>
		<tr>
			<td><?php echo $this->Form->input('Company.phone', array('type' => 'text', 'label' => 'Phone:<br>', 'size' => '18', 'id' => 'companyPhone', 'class' => 'phone')); ?></td>
			<td><?php echo $this->Form->input('Company.fax', array('type' => 'text', 'label' => 'Fax:<br>', 'size' => '18', 'id' => 'companyFax', 'class' => 'phone')); ?></td>
			<td><?php echo $this->Form->input('Company.email', array('type' => 'text', 'label' => 'Email:<br>', 'id' => 'companyEmail', 'size' => '50')); ?></td>
		</tr>
		<tr>
			<td><?php echo $this->Form->input('Company.license_number', array('type' => 'text', 'label' => 'License #:<br>', 'size' => '18', 'id' => 'companyLicense')); ?></td>
	</table>
	
	
	
	<!-- Terms & Conditions -->
	<div class="policy">
		<h2>Terms &amp; Conditions</h2>
		<iframe src="<?php echo Router::url('/', true); ?>public/terms?is_micro=1"></iframe>
	</div>
	<div class="right" style="margin-right:10px;">
		<?php echo $this->Form->input('User.terms', array('type' => 'checkbox', 'value' => 1, 'label' => 'I have read and agree to the Terms & Conditions')); ?>
	</div>
	
	
	
	<!-- Privacy Policy -->
	<div class="policy">
		<h2>Privacy Policy</h2>
		<iframe src="<?php echo Router::url('/', true); ?>public/privacy?is_micro=1"></iframe>
	</div>
	<div class="right" style="margin-right:10px;">
		<?php echo $this->Form->input('User.privacy', array('type' => 'checkbox', 'value' => 1, 'label' => 'I have read and agree to the Privacy Policy')); ?>
	</div>
	
	<div class="submit-button">
		<?php echo $this->Form->end('Submit', array('id' => 'submit')); ?>
	</div>
</div>
<script src="<?php Router::url('/', true); ?>/js/registration.js"></script>