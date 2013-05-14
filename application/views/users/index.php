<h1>用户</h1>
<?php echo anchor('users/create','添加用户') ?>
<table cellspacing="0" cellpadding="0" border="1">
<theadx><tr><th>ID</th><th>姓名</th><th>状态</th><th>角色</th><th>电子邮件</th>
	<th>电话</th><th>创建时间</th><th>最后登录</th><th>&nbsp;</th></tr></thead>
<tbody>
	<?php foreach ($users as $users_item): ?>
	<tr><td><?php echo $users_item['id'] ?></td>
		<td><?php echo $users_item['name'] ?></td>
		<td><?php echo $users_item['status'] ?></td>
		<td><?php echo $users_item['rule'] ?></td>
		<td><?php echo $users_item['email'] ?></td>
		<td><?php echo $users_item['phone'] ?></td>
		<td><?php echo $users_item['createtime'] ?></td>
		<td><?php echo $users_item['logintime'] ?></td>
		<td><?php echo anchor('users/edit/'.$users_item['id'],'编辑') ?> | 
		<?php
		if ($users_item['status'] === 'disabled') 
		{
			$status = 'nomal';
			$button = '启用';
		} 
		else 
		{ 
			$status = 'disabled';
			$button = '禁用';
		} 
		echo anchor('users/disable/'.$users_item['id'].'/'.$status, $button) ?> | 
		<?php echo anchor('#','删除', 'onclick="delconfirm('.$users_item['id'].'); return false;"') ?></td>
	</tr>
<?php endforeach ?>
</tbody>
</table>

<script> 
function delconfirm(id){ 
    question = confirm("你确认删除用户吗？") 
    if (question != "0"){ 
        window.open("<?=site_url()?>/users/delete/"+id, "_self") 
    } 
} 
</script>