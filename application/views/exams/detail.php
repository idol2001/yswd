<h1><?php echo $exam['title'] ?></h1>
<p>类别：<?php echo $exam['type'] ?></p>
<p>考试日期：<?php echo $exam['testdate'] ?></p>
<p>讲解老师：<?php echo $exam['teacher'] ?></p>
<p>讲解音频：<?php echo $exam['audio_file']. '&nbsp;'. anchor($exam['audio_url'], '播放') ?></p>
<p>时长：<?php echo $exam['duration'] ?></p>
<hr />
<?php echo anchor('questions/create/'.$exam['id'], '添加问题') ?> <br />
<?php foreach ($questions as $questions_item): ?>
<h2>片段：<?php echo $questions_item['id'] ?> &nbsp; 时长：<?php echo $questions_item['duration'] ?> </h2>
<p><?php echo $questions_item['text'] ?> <br />
</p>
<?php echo anchor('questions/edit/'.$questions_item['id'], '编辑问题') ?>
<hr />
<?php endforeach ?>
