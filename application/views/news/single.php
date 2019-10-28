<div id="gtco-main">
		<div class="container">
			<div class="row row-pb-md">
				<div class="col-md-12">
					<div class="post">
						<div class="post__title">
							<h2><?php echo $news['title']; ?></h2>
						</div>
						<div class="post__image">
							<img src="<?php echo base_url('assets'); ?>/uploads/<?php echo $news['image']; ?>" />
						</div>
						<div class="post__content">
							<?php echo $news['text']; ?>
						</div>
						<div class="post__info">
							Created by: <span><?php echo $news['title']; ?></span>, <?php echo $news['created_at']; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>