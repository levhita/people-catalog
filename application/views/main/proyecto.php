<div class="row">
	<div id="carusel-proyecto">
		<?php $counter=0; foreach($project->images AS $image): ?>
			<div class="image<?php echo ($counter++==0)?' active':'';?>">
				<img src="/project_uploads/<?php echo $image->url?>"/>
				<hr class="visible-xs-block inter"/>
			</div>
		<?php endforeach; ?>

		<?php foreach($project->videos AS $video): ?>
			<div class="video<?php echo ($counter++==0)?' active':'';?>">
				<iframe width="100%" src="https://www.youtube.com/embed/<?php echo $video->video_id?>?controls=2&amp;theme=dark&amp;color=white&amp;fs=0&amp;modestbranding=1&amp;rel=0&amp;showinfo=0&amp;autohide=1" frameborder="0" allowfullscreen>
				</iframe>
				<hr class="visible-xs-block inter"/>
			</div>
		<?php endforeach; ?>
	</div>
</div>
<hr class="hidden-xs"/>
<div class="row" id="navigation_row">
	<div class="thumbnails">

	<?php $counter=0; foreach($project->videos AS $video): ?>
	<?php $path_parts = pathinfo($video->thumbnail); 	$basename = basename($path_parts['basename'],".{$path_parts['extension']}"); ?>
		<div class="video_li"><span></span><img src="/project_uploads/<?php echo $basename."-mini-thumb.jpg";?>" width="130px"/></div>
	<?php endforeach; ?>
	<?php foreach($project->images AS $image): ?>
	<?php $path_parts = pathinfo($image->url); 	$basename = basename($path_parts['basename'],".{$path_parts['extension']}"); ?>
		<div><img src="/project_uploads/<?php echo $basename."-mini-thumb.jpg";?>" width="130px"/></div>
	<?php endforeach; ?>
	</div>
</div>
<hr class="hidden-xs"/>
<div class="row details">
	<div class="col-sm-8 border-right">
		<h4><strong>Proyecto: <?php echo htmlspecialchars($project->name); ?></strong></h4>
		<div id="description"><?php echo $project->description?></div>
		<hr/>
		<div class="categories">
		<?php $count=0; foreach( $project->categories AS $category): ?>
			<?php if($count>0) echo "<strong>/</strong>";?>
			<a href="/proyectos#order=time&amp;category=<?php echo $category->id_category?>"><?php echo htmlspecialchars($category->name)?></a>
			<?php $count++?>
		<?php endforeach; ?>
		</div>
	</div>
	<div  class="col-sm-4">
		<div class="share">
			<h4><strong>Comparte nuestro trabajo</strong></h4>
			<span class='st_twitter_custom' displayText='Tweet'></span>
			<span class='st_facebook_custom' displayText='Facebook'></span>
			<span class='st_linkedin_custom' displayText='LinkedIn'></span>
			<span class='st_pinterest_custom' displayText='Pinterest'></span>
		</div>
		<hr/>
		<div class="credits"><?php echo $project->credits?></div>
	</div>
</div>

<div id="side_pagers">
	<div class="previous"><a href="<?php echo $prev_link?>"><span>Anterior</span></a></div>
	<div class="next"><a href="<?php echo $prev_link?>"><span>Siguiente</span></a></div>
</div>

<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "50c51b8e-16d7-4dd5-acd0-963f52dc5594", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
