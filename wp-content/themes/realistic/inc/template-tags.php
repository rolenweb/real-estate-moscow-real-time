<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package realistic
 */

/*-----------------------------------------------------------------------------------*/
/*  Meta information
/*-----------------------------------------------------------------------------------*/

// Time ago format function
function realistic_time_ago() {
 
	global $post;
 
	$date = get_post_time('G', true, $post);
 
	// Array of time period chunks
	$chunks = array(
		array( 60 * 60 * 24 * 365 , __( 'year', 'realistic' ), __( 'years', 'realistic' ) ),
		array( 60 * 60 * 24 * 30 , __( 'month', 'realistic' ), __( 'months', 'realistic' ) ),
		array( 60 * 60 * 24 * 7, __( 'week', 'realistic' ), __( 'weeks', 'realistic' ) ),
		array( 60 * 60 * 24 , __( 'day', 'realistic' ), __( 'days', 'realistic' ) ),
		array( 60 * 60 , __( 'hour', 'realistic' ), __( 'hours', 'realistic' ) ),
		array( 60 , __( 'minute', 'realistic' ), __( 'minutes', 'realistic' ) ),
		array( 1, __( 'second', 'realistic' ), __( 'seconds', 'realistic' ) )
	);
 
	if ( !is_numeric( $date ) ) {
		$time_chunks = explode( ':', str_replace( ' ', ':', $date ) );
		$date_chunks = explode( '-', str_replace( ' ', '-', $date ) );
		$date = gmmktime( (int)$time_chunks[1], (int)$time_chunks[2], (int)$time_chunks[3], (int)$date_chunks[1], (int)$date_chunks[2], (int)$date_chunks[0] );
	}
 
	$current_time = current_time( 'mysql', $gmt = 0 );
	$newer_date = strtotime( $current_time );
 
	// Difference in seconds
	$since = $newer_date - $date;
 
	// Something went wrong with date calculation and we ended up with a negative date.
	if ( 0 > $since )
		return __( 'sometime', 'realistic' );

	//Step one: the first chunk
	for ( $i = 0, $j = count($chunks); $i < $j; $i++) {
		$seconds = $chunks[$i][0];
 
		// Finding the biggest chunk (if the chunk fits, break)
		if ( ( $count = floor($since / $seconds) ) != 0 )
			break;
	}
 
	// Set output var
	$output = ( 1 == $count ) ? '1 '. $chunks[$i][1] : $count . ' ' . $chunks[$i][2];
 
 
	if ( !(int)trim($output) ){
		$output = '0 ' . __( 'seconds', 'realistic' );
	}
 
	$output .= __(' ago', 'realistic');
    return $output;
}

//Prints HTML with meta information for the current post-date/time.
if ( ! function_exists( 'realistic_posted' ) ) {
    function realistic_posted() {
		$time_format = 'ago_format';
		if ( $time_format == 'traditional' ) {	
			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
			}
			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() ),
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() )
			);
			$posted = sprintf(
				_x( '%s', 'post date', 'realistic' ),
				$time_string 
			);
			return $posted;
			
		} else {
			$output = realistic_time_ago();
			return $output;
		}
	}
}

// Prints HTML with meta information for Author.
if ( ! function_exists( 'realistic_entry_author' ) ) :
function realistic_entry_author() {
    if ( 'post' == get_post_type() ) {
		$byline = sprintf(
		_x( '%s', 'post author', 'realistic' ),
		'<span class="author vcard"><span class="url fn"><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span></span>'
		);
		return $byline;
    }
}
endif;

// Prints HTML with meta information for Category.
if ( ! function_exists( 'realistic_entry_category' ) ) {
	function realistic_entry_category() { ?>
		<span class="thecategory">
			<?php     if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( '', 'realistic' ) );
		if ( $categories_list && realistic_categorized_blog() ) {
			printf( '<div class="thecategory">' . __( '%1$s', 'realistic' ) . '</div>', $categories_list );
		}
    } ?>
		</span>
	<?php }
}

// Prints HTML with meta information for Tags.
if ( ! function_exists( 'realistic_entry_tags' ) ) :
function realistic_entry_tags() {
    if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'realistic' ) );
		if ( $tags_list ) {
			printf( '<span class="thetags"><i class="icon icon-tags"></i>'. __( '%1$s', 'realistic' ) .'</span>', $tags_list );
		}
    }
}
endif;

// Prints HTML with meta information for Comments number.
if ( ! function_exists( 'realistic_entry_comments' ) ) :
function realistic_entry_comments() {
	if ( 'post' == get_post_type() ) {
		$num_comments = get_comments_number(); // get_comments_number returns only a numeric value
		if ( comments_open() ) {
			$write_comments =  $num_comments;
		} else {
			$write_comments =  0;
		}
		return $write_comments;
	}
}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( __( 'Category: %s', 'realistic' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( 'Tag: %s', 'realistic' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( __( 'Author: %s', 'realistic' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( 'Year: %s', 'realistic' ), get_the_date( _x( 'Y', 'yearly archives date format', 'realistic' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( __( 'Month: %s', 'realistic' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'realistic' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( __( 'Day: %s', 'realistic' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'realistic' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', 'realistic' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title', 'realistic' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title', 'realistic' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title', 'realistic' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title', 'realistic' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title', 'realistic' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title', 'realistic' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title', 'realistic' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title', 'realistic' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( __( 'Archives: %s', 'realistic' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s', 'realistic' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archives', 'realistic' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function realistic_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'realistic_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'realistic_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so realistic_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so realistic_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in realistic_categorized_blog.
 */
function realistic_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'realistic_categories' );
}
add_action( 'edit_category', 'realistic_category_transient_flusher' );
add_action( 'save_post',     'realistic_category_transient_flusher' );