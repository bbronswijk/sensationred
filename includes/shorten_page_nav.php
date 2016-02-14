<?php
    function filter_shorten_linktext($linkstring,$link) {
		$characters = 45;
		preg_match('/<a.*?>(.*?)<\/a>/is',$linkstring,$matches);
		$displayedTitle = $matches[1];
		$newTitle = shorten_with_ellipsis($displayedTitle,$characters);
		return str_replace('>'.$displayedTitle.'<','>'.$newTitle.'<',$linkstring);
	}

	function shorten_with_ellipsis($inputstring,$characters) {
	  return (strlen($inputstring) >= $characters) ? substr($inputstring,0,($characters-3)) . '...' : $inputstring;
	}

	// This adds filters to the next and previous links, using the above functions
	// to shorten the text displayed in the post-navigation bar. The last 2 arguments
	// are necessary; the last one is the crucial one. Saying "2" means the function
	// "filter_shorten_linktext()" takes 2 arguments. If you don't say so here, the
	// hook won't pass them when it's called and you'll get a PHP error.
	add_filter('previous_post_link','filter_shorten_linktext',10,2);
	add_filter('next_post_link','filter_shorten_linktext',10,2);
?>