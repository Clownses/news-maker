<div class="modal fade" id="modalCreateNewsForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Create news</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open_multipart('createNews', ['class' => 'createNews-form']); ?>
        <div class="form__errors"></div>
	      <div class="modal-body mx-3">
	        <div class="md-form mb-5">
	        	<?php echo form_input(['type' => 'text', 'class' => 'form-control validate', 'name' => 'title', 'placeholder' => 'Title']); ?>
	        </div>

	        <div class="md-form mb-4">
	        	<?php echo form_textarea(['class' => 'form-control validate', 'name' => 'text', 'placeholder' => 'Text']); ?>
	        </div>

	        <div class="md-form mb-4">
	        	<?php echo form_upload(['class' => 'form-control validate', 'id' => 'news-image', 'name' => 'news-image']); ?>
	        	<div id="image-uploaded"></div>
	        	<div id="remove-image" class="btn btn-danger btn-sm" style="display: none;">Remove Image</div>
	        </div>

	      </div>
	      <div class="modal-footer d-flex justify-content-center">
	      	<?php echo form_submit(['class' => 'btn btn-default', 'id' => 'news-create', 'value' => 'Create']); ?>
	      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<footer id="gtco-footer" role="contentinfo">
		<div class="container">
			<div class="row copyright">
				<div class="col-md-12 text-center">
					<p>
						<small class="block">&copy; 2019. All Rights Reserved.</small> 
					</p>
					<p>
						<ul class="gtco-social-icons">
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-linkedin"></i></a></li>
							<li><a href="#"><i class="icon-dribbble"></i></a></li>
						</ul>
					</p>
				</div>
			</div>

		</div>
	</footer>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.cookie.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.easing.1.3.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.waypoints.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.stellar.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/fileupload.js'); ?>"></script>
	<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	</body>
</html>