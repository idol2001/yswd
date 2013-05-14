<h1>试题列表</h1>
<?php echo anchor('exams/create', '新建试题'); ?>
<table cellspacing="0" cellpadding="0" border="1">
<theadx><tr><th>ID</th><th>名称</th><th>类别</th><th>考试日期</th><th>讲解老师</th>
	<th>创建时间</th><th>创建者</th><th>时长</th><th>&nbsp;</th></tr></thead>
<tbody>
	<?php foreach ($exams as $exams_item): ?>
	<tr><td><?php echo $exams_item['id'] ?></td>
		<td><?php echo anchor('exams/detail/'.$exams_item['id'], $exams_item['title']) ?></td>
		<td><?php echo $exams_item['type'] ?></td>
		<td><?php echo $exams_item['testdate'] ?></td>
		<td><?php echo $exams_item['teacher'] ?></td>
		<td><?php echo $exams_item['createtime'] ?></td>
		<td><?php echo $exams_item['createname'] ?></td>
		<td><?php echo $exams_item['duration'] ?>秒</td>
		<td><?php echo anchor('exams/edit/'.$exams_item['id'],'编辑') ?> | 
		<?php echo anchor('exams/delete/'.$exams_item['id'],'删除') ?></td>
	</tr>
<?php endforeach ?>
</tbody>
</table>
