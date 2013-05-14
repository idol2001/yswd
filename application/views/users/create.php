<h2>创建新用户</h2>
<?php echo validation_errors(); ?>

<?php echo form_open('users/create') ?>
	<label for="rule">权限：</label> 
  	<select name="rule">
		<option value="0">管理员</option>
		<option value="1">试题管理员</option>
		<option value="2">试题录入</option>
	</select><br />

  	<label for="email">电子邮件</label>
  	<input type="input" name="email" /> <br />
  	<label for="password">密码</label>
  	<input type="password" name="password" /> <br />
  	<label for="confirmpwd">确认密码</label>
  	<input type="password" name="confirmpwd" /> <br />  
  	<input type="checkbox" name="changepwd" value="changepwd" /><label for="changepwd">第一次登录需修改密码</label>
  	<hr />
  	<h3>用户信息</h3>
  	<label for="name">姓名</label>
  	<input type="input" name="name" /> <br />
  	<label for="phone">电话</label>
  	<input type="input" name="phone" /> <br />
  	
  	<input type="submit" name="submit" value="创建用户" /> 

</form>
