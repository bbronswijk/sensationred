/**
 * @author Bram Bronswijk
 */

jQuery(document).ready(function($){
		
			function widget_sponsor(){
				// Er wordt maar één hoofdsponsor per keer getoond. De rest word opgevuld met parners/subsponsoren
				
				// number of hoofdsponsors
				var number_hoofd_sponsor = $('.hoofd_sponsor img').length;
				// number of subsponsors		
				var number_sub_sponsor = $('.sub_sponsor img').length;			

				// determine the width of each hoofdsponsor image and pick the largest 
				var maxWidth_Hoofdsponsor = '0';
				
				for(i=0; i < number_hoofd_sponsor; i++ ){
					// .width() werkt niet in dit geval omdat de afbeelding niet wordt weergegeven
					var checkWidthHoofdsponsor = parseInt($('.hoofd_sponsor img').eq(i).css('width'));
					if(checkWidthHoofdsponsor > maxWidth_Hoofdsponsor){
						maxWidth_Hoofdsponsor = checkWidthHoofdsponsor;
					}
				}
				
				// set width of hoofdsponsor container to maximal width
				$('.hoofd_sponsor').css('width', maxWidth_Hoofdsponsor+'px');
				
				// extra check height all sponsor images
				var maxHeight_Hoofdsponsor = '0';
				var maxHeight_Subsponsor = '0';
								
				// determine how much width is left for the subsponsors
				var widthLeft =  $('.background_footer .container').width() - maxWidth_Hoofdsponsor - 40;
				
				var sponsoren = []; // total array
				var group = []; // array for row with images
				var wLeft = widthLeft; 
				
				// not all partners can be shown at once
				// this function sorts the subsponsoren into different groups and put them in an array
				// each group of images fill a row 			
				for( i = 0; i <= number_sub_sponsor; i++){
					// get width of current image
					widthImg = parseInt($('.sub_sponsor img').eq(i).css('width'));
										
					// check if image fits in total container ( widthLeft )
					// wLeft is the width left after containing images and shouldn't be used in this check
					// if the image is too wide for its container it won't be shown. > Important for responsiveness 
					if( widthLeft > widthImg && i < number_sub_sponsor ){				
						// check if image will fit in remaining space 
						wLeft = wLeft - widthImg - 40; 
						
						if ( wLeft >= 0 ){ // de afbeelding past naast de andere afbeeldingen > voeg toe aan de group array
							group.push(i);			
						} else{ // de afbeelding past niet naast de andere afbeeldingen
							// reset wLeft
							wLeft = widthLeft;
							// voeg group[] toe aan sponsoren[]			
							sponsoren.push(group);							
							// reset group[]
							group = [];							
							// de afbeelding die niet past opnieuw checken voor de volgende rij	
							i = i - 1;											
						}
					} else if(i === number_sub_sponsor) { // no images left
						// add last group to sponsoren
						sponsoren.push(group); // endresult should be something like [[1,2],[4,5]];		
					}
				}
																
				// shows hoofdsponsors one by one
				function fadeInHoofdsponsor(){
					// fade in new sponsor logo
					$('.hoofd_sponsor img').eq(hoofd_sponsor_fadein).fadeIn(1000,function(){
						if ( number_hoofd_sponsor > 1 ){		
							// fade out visible sponsor logo with delay
							$(this).delay(3000).fadeOut(1000);
							
							hoofd_sponsor_fadein = hoofd_sponsor_fadein + 1;
							
							// If there are no images left, reset the loop and run function again in 5100
							if ( hoofd_sponsor_fadein == number_hoofd_sponsor ){
								hoofd_sponsor_fadein = 0;
								timeout1 = window.setTimeout(fadeInHoofdsponsor, 5100 );
							}
						}
					});
				}
				
				
				// sponsoren array looks something like this: [[1,2],[5,6]];
				// shows subsponsors one by one by using array's
				var shownGroup = 0;
				var hoofd_sponsor_fadein = 0;									
				var sub_sponsor_fadein = 0;
				
				function fadeInSubsponsor(){
					// number of images in this group 
					var imagesToProcess = sponsoren[shownGroup].length;
					for(i = 0; i < imagesToProcess; ++i) {	
						// get id of current image	
						selectImage = sponsoren[shownGroup][i];			
						$('.sub_sponsor img').eq(selectImage).fadeIn(1000,function(){
							// only fade out when there are multiple groups
							if ( sponsoren[1] != undefined ){ 
								$(this).delay(2000).fadeOut(1000);							
							}
						});
					}
					if ( sponsoren[shownGroup+1] === undefined ){ // if there are no images left > reset
						shownGroup = 0 
					} else{									
						shownGroup += 1;
					}								
					
					clearTimeout(timeout1);
					timeout1 = window.setTimeout(fadeInSubsponsor, 5100 );				
				}
				
				if(window.innerWidth > 480){
					fadeInHoofdsponsor();
				}
				
				if(window.innerWidth > 880){
					fadeInSubsponsor();
				}	
			}  // widget sponsoren
			
			// loop fadein hoofd sponsor
			timeout1 = false;
			// loop fadein subsponsor
			timeout2 = false;
			
			setTimeout(widget_sponsor, 500);
				
			// only run function when user is done resizing screen
			var timeout;
			$(window).resize(function() {
				$('.sponsoren img').hide();
			    clearTimeout(timeout);
			    timeout = setTimeout(doneResizing, 500);			    
			});
				
			function doneResizing(){			
				if(timeout1 != false){
					if ( $('.hoofd_sponsor img').length > 1 ){						
						window.clearTimeout(timeout1);
			  		}
				}		
				if(timeout2 != false){
					if ( $('.sub_sponsor img').length > 1 ){
			  			window.clearTimeout(timeout2);
		  			}		
				}
			  				
			  	$('.sponsoren img').hide();
				  	
			  	widget_sponsor()				  	
			}
	
		
});