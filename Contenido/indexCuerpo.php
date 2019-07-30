<div class="ui container mt-4">
	<?php 
		for ($i=0; $i < 2; $i++) { 
			echo '<div class="row mt-3">';
			for ($j=0; $j < 4; $j++) {
				echo '	<div class="col-md-3">
							<div class="ui link card">
		  						<div class="content">
    								<!--<div class="center aligned floated author">
     								<img class="ui avatar image" src="">
    								</div>-->
    								<div class="ui center aligned header">Modulo '.$i.$j.'</div>
    								<div class="meta">
      									<span class="category">Resumen</span>
    								</div>
    								<div class="description">
      									<p>Pendiente.</p>
    								</div>
  								</div>
							</div>
						</div>';
			}
			echo '</div>';
		}
	 ?>
</div> 
 <p class="mt-5 mb-3 text-muted text-center">&copy; 2019</p>