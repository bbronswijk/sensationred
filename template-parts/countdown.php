
		<?php 
			$timezone = date_default_timezone_set('Europe/Amsterdam');
			$eventDate = new DateTime(get_option('date_elections').get_option('time_elections'));
			$currentDate = new DateTime();
	
			if( $eventDate > $currentDate ) : ?>	
							
							
				<div class="countdown">
						<input type="hidden" class="countdown_date" value="<?= get_option('date_elections') ?>"/>
						<input type="hidden" class="countdown_time" value="<?= get_option('time_elections') ?>"/>
						
						<h3 class="countdown-color"><?= get_option('title_elections') ?></h3>	
						<div id="clock" class="clock hasCountdown" alt=" ">							
								<span class="countdown_section countdown-color">
										<span class="countdown_amount days"></span><br>Days
								</span><span class="countdown_sep countdown-color">:</span>
								<span class="countdown_section countdown-color">
										<span class="countdown_amount hours"></span><br>Hours
								</span><span class="countdown_sep countdown-color">:</span>
								<span class="countdown_section countdown-color">
										<span class="countdown_amount minutes"></span><br>Mins
								</span><span class="countdown_sep countdown-color">:</span>
								<span class="countdown_section countdown-color">
										<span class="countdown_amount seconds"></span><br>Secs
								</span>
						</div>				
							
			</div>	
		<?php endif; ?>