<?
require_once('./assets/includes/authentification.php');
require_once('assets/includes/connection.php');

$logged_in = false; 
if(!is_logged_in()){
        $logged_in = false; 
        include('header-start.php');
}else{
        $logged_in = true;
        include('header.php');
}
$code = $_GET["code"];
$user	= $_GET["user"];

?>


<div class="container rightband">
	<div class="row-fluid">
		<div class="span6 offset2">

			<h3><?php echo $index_reset_password ?><span class="extra-title muted"></span></h3>

		  <form class="form" id="reset-password-form" accept-charset="UTF-8">
		  	<div class="control-group">
		      <div class="controls">
		  			<input id="code" name="code" type="hidden" class="input" value="<? echo $code; ?>"/>
		  		</div>
	      </div>
		  	<div class="control-group">
		  		<div class="controls">
		  			<input id="password" name="user" type="hidden" class="input" value="<? echo $user; ?>"/>
		  		</div>
		  	</div>
		  	
	      <div class="control-group">
		  		<label for="password"><? echo $newPassword; ?></label>
		      <div class="controls">
		  			<input data-validation-minlength-message="<?php echo $password_validation_message ?>" minlength="6" id="password" name="password" type="password" class="input" placeholder="<? echo $newPassword; ?>"/>
		  		</div>
	      </div>
	      
	      <div class="control-group">
	  			<label for="passwordRepeat"><? echo $passwordRepeat; ?></label>
		      <div class="controls">
		  			<input data-validation-match-message="<?php echo $password_match_validation_message ?>" data-validation-match-match="password" id="passwordRepeat" name="passwordRepeat" type="password" class="input" placeholder="<? echo $passwordRepeat; ?>"/>
	        </div>
	      </div>

		    <div class="control-group">
		      <div class="controls">    
		        <button type="button" class="btn btn-primary" onclick="submitForm()"><?php echo $index_submit ?></button>
		      </div>
		    </div>
	  	</form>
		</div>
	</div>
</div>


<?
  include('footer.php');
?>