{
	"id": <?php echo $exam['id'] ?>,
	"title":"<?php echo $exam['title'] ?>",
	"date":"<?php echo $exam['testdate'] ?>",
	"tch":"<?php echo $exam['teacher'] ?>",
	"dur":<?php echo $exam['duration'] ?>,
	"aud":"<?php echo $exam['audio_url'] ?>",
	"questions":
		[
		<?php for($i=0;$i<count($questions);$i++): ?>
			{
				"id": <?php echo $questions[$i]['id'] ?>,
				"text":"<?php echo 	str_replace(array('"', '\\', '\r', '\n', '\r\n'), array('\"','\\\\',' '), $questions[$i]['text']); ?>",
				"dur": <?php echo $questions[$i]['duration'] ?>
			}
		<?php if ($i < count($questions)-1) { echo ','; } ?>
		<?php endfor ?>
		]
}