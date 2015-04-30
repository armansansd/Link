		<div id="preview-template" style="display: none;">test</div>

		<script src="<?php echo URL.'/js/jquery-1.11.1.min.js' ;?>"></script>
		<script src="<?php echo URL.'/js/dropzone.js' ;?>"></script>
	    <script type="text/javascript"></script>
	    <script type="text/javascript">
	    $('.addt').click(function(){
	    	$('#rotate').toggleClass('rotate');
	    	$('.t_form').slideToggle('fast');

	    })
			var dropzone = new Dropzone(".drop", { 
				url: "#",
				autoProcessQueue: false,
				maxFilesize: 400,
				parallelUploads: 10,
			});
			$('.click').click(function(){
				dropzone.processQueue();
				window.location.assign("http://localhost:8890/rhlog/admin");
			});
			
		</script>

	</body>
</html>