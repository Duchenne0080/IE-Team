<div class="wrap">
	<h1><?php printf(__('Manage Questions in %s', 'chained'), stripslashes($quiz->title));?> </h1>
	
	<div class="postbox-container" style="width:73%;margin-right:2%;">
	
		<p><a href="admin.php?page=chained_quizzes"><?php _e('Back to quizzes', 'chained')?></a>
			| <a href="admin.php?page=chainedquiz_results&quiz_id=<?php echo $quiz->id?>"><?php _e('Manage Results', 'chained')?></a>
			| <a href="admin.php?page=chained_quizzes&action=edit&id=<?php echo $quiz->id?>"><?php _e('Edit This Quiz', 'chained')?></a>
		</p>
		
		<p><a href="admin.php?page=chainedquiz_questions&action=add&quiz_id=<?php echo $quiz->id?>"><?php _e('Click here to add a new question', 'chained')?></a></p>
		<?php if(count($questions)):?>
			<table class="widefat">
				<thead>
				<tr><th>#</th><th><?php _e('ID', 'chained')?></th><th><?php _e('Question', 'chained')?></th><th><?php _e('Type', 'chained')?></th>
					<th><?php _e('Edit / Delete', 'chained')?></th></tr>
				</thead>
				<tbody>	
				<?php foreach($questions as $cnt=>$question):
					$class = ('alternate' == @$class) ? '' : 'alternate';?>
					<tr class="<?php echo $class?>">
						<td><?php if($count > 1 and $cnt):?>
							<a href="admin.php?page=chainedquiz_questions&quiz_id=<?php echo $quiz->id?>&move=<?php echo $question->id?>&dir=up"><img src="<?php echo CHAINED_URL."/img/arrow-up.png"?>" alt="<?php _e('Move Up', 'chained')?>" border="0"></a>
						<?php else:?>&nbsp;<?php endif;?>
						<?php if($count > $cnt+1):?>	
							<a href="admin.php?page=chainedquiz_questions&quiz_id=<?php echo $quiz->id?>&move=<?php echo $question->id?>&dir=down"><img src="<?php echo CHAINED_URL."/img/arrow-down.png"?>" alt="<?php _e('Move Down', 'chained')?>" border="0"></a>
						<?php else:?>&nbsp;<?php endif;?></td>					
						<td><?php echo $question->id?></td><td><?php echo stripslashes($question->title)?></td>
						<td><?php echo $question->qtype?></td><td><a href="admin.php?page=chainedquiz_questions&action=edit&id=<?php echo $question->id?>"><?php _e('Edit', 'chained')?></a> | <a href="#" onclick="chainedConfirmDelete(<?php echo $question->id?>);return false;"><?php _e('Delete', 'chained')?></a></td>
					</tr>
				<?php endforeach;?>	
				</tbody>
			</table>
			
			<h3><?php _e('Did you know?', 'chained');?></h3>
		
		<p>Now you can use <a href="http://blog.calendarscripts.info/chained-quiz-logic-free-add-on-for-watupro/" target="_blank">this tool</a> to transfer your quizzes to the best premium quiz plugin <a href="http://calendarscripts.info/watupro/" target="_blank">WatuPRO</a>. This will give you access to premuim support and a lot of great fatures like user registration, randomizing, categorization, super-high flexibility, lots of question types, and more.</p>
		<?php endif;?>
	
	</div>
	<div id="chained-sidebar">
			<?php include(CHAINED_PATH."/views/sidebar.html.php");?>
	</div>
</div>

<script type="text/javascript" >
function chainedConfirmDelete(qid) {
	if(confirm("<?php _e('Are you sure?', 'chained')?>")) {
		window.location = 'admin.php?page=chainedquiz_questions&quiz_id=<?php echo $quiz->id?>&del=1&id='+qid;
	}
}
</script>