	<script src="<?= base_url()?>assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url()?>assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url()?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
		$('[data-toggle="tooltip"]').tooltip();
		$(".preloader").fadeOut();
		
		<?php if($this->uri->segment('2')==null){ ?>
		
		$('#to-recover').on("click", function() {
			$("#loginform").slideUp();
			$("#recoverform").fadeIn();
		});
		$('#to-login').click(function(){
			
			$("#recoverform").hide();
			$("#loginform").fadeIn();
		});
		<?php } ?>
		
    </script>
</body>
</html>