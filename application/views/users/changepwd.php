<h2>重置密码</h2>
<?php echo validation_errors(); ?>

<?php echo form_open('users/changepwd/'.$id) ?>
  	<label for="password">密码</label>
  	<input type="password" name="password" /> <br />
  	<label for="confirmpwd">确认密码</label>
  	<input type="password" name="confirmpwd" /> <br />  
  	<input type="checkbox" name="changepwd" value="changepwd" /><label for="changepwd">第一次登录需修改密码</label>
  	
  	<input type="submit" name="submit" value="保存" />
  	
</form>
