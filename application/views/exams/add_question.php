<h2><?php echo $title ?></h2>
<?php echo validation_errors(); ?>
<?php if (isset($error)) { echo $error;} ?>

<?php echo form_open_multipart('questions/save_question') ?>
  	<label for="text">片段内容</label> <br />
  	<input type="file" name="slide" size="20" />  <br />
  	<p>请上传.html文件或.zip文件，zip文件中请包含html文件，html中使用的图片、样式等资源，请全部包含在zip文件中，并使用相对路径引用。</p>
  	<label for="duration">讲解时长</label>
  	<input type="input" name="duration" value="<?php echo $question['duration']?>" /> <br /> 
  	
  	<?php echo form_hidden('id', $question['id']) ?>
  	<?php echo form_hidden('tid', $question['tid']) ?>
   	<input type="submit" name="submit" value="保存" /> 

</form>
