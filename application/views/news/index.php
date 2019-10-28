<div id="gtco-main">
		<div class="container">
			<div class="row row-pb-md">
				<div class="col-md-12">
					<ul id="gtco-post-list">
						<?php foreach ($news as $post): ?>
							<li class="one-half entry animate-box" data-animate-effect="fadeIn"> 
								<a href="news/<?php echo $post['id']; ?>">
									<div class="entry-img" style="background-image: url(<?php echo base_url('assets'); ?>/uploads/<?php echo $post['image']; ?>"></div>
									<div class="entry-desc">
										<h3><?php echo $post['title']; ?></h3>
										<p><?php echo $post['text']; ?></p>
									</div>
								</a>
								<a href="#" class="post-meta"><?php echo $post['author']; ?>  <span class="date-posted"><?php echo $post['created_at']; ?></span></a>
							</li>
						<?php endforeach; ?>
					</ul>	
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<nav aria-label="Page navigation">
						<div class="pagination">
							<?php echo $links; ?>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</div>