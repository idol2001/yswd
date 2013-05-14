<h2>编辑用户：<?php echo $user['email'] ?></h2>
<?php echo validation_errors(); ?>

<?php echo form_open('users/edit') ?>
	<?php echo form_hidden('id', $user['id']); ?>
	<label for="rule">权限：</label> 
	<?php echo form_dropdown('rule', $rule, $user['rule']); ?>

  	<hr />
  	<h3>用户信息</h3>
  	<label for="name">姓名</label>
  	<input type="input" name="name" value="<?php echo $user['name'] ?>" /> <br />
  	<label for="phone">电话</label>
  	<input type="input" name="phone" value="<?php echo $user['phone'] ?>" /> <br />
  	
  	<input type="submit" name="submit" value="保存" />
  	
  	<hr />
  	<?php echo anchor('users/changepwd/'.$user['id'], '重置密码'); ?> 

</form>
