<h2><?php echo $title ?></h2>
<?php echo validation_errors(); ?>
<?php if (isset($error)) { echo $error;} ?>

<?php echo form_open_multipart('exams/save_exam') ?>
	<label for="type">类别：</label> 
  	<?php echo form_dropdown('type', $type, $exam['type']); ?> <br />

  	<label for="title">名称</label>
  	<input type="input" name="title" value="<?php echo $exam['title']?>" /> <br />
  	<label for="testdate">考试日期</label>
  	<input type="date" name="testdate" value="<?php echo $exam['testdate']?>"/> <br />
  	<label for="teacher">讲解老师</label>
  	<input type="input" name="teacher" value="<?php echo $exam['teacher']?>" /> <br /> 
  	<?php if ($exam['audio_file'] !== '') { echo $exam['audio_file']. '&nbsp;'. anchor($exam['audio_url'], '播放') . '<br />'; } ?>
  	<label for="audio">上传音频</label>
  	<input type="file" name="audio" size="20" />  <br />
  	<label for="duration">讲解时长</label>
  	<input type="input" name="duration" value="<?php echo $exam['duration']?>" /> <br /> 
  	
  	<?php echo form_hidden('id', $exam['id']) ?>
  	<?php echo form_hidden('audio_file', $exam['audio_file']) ?>
   	<input type="submit" name="submit" value="保存" /> 

</form>
