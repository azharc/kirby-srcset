<?php 

// create srcset images
function img($image, $options = array()) {
	// defaults
	$defaults = array(
		"alt" => $image->alt()->or(''),
		"widths" => [100, 100, 100],
		"class" => "",
		"lazy" => false,
		"attr" => array()
		);

	// merge
	$settings = array_merge($defaults, $options);
	
	// set local variables
	$alt = $settings['alt'];
	$widths = $settings['widths'];
	$class = $settings['class'];
	$lazy = $settings['lazy'];

	// configure sizes
	$breakpoints = array(640, 1280, 1920);
	
	// get image width
	$width = $image->width();

	// create an image for each breakpoint
	$thumbs = array();
	foreach ($breakpoints as $point) {
		// don't upsize images
		if ($width >= $point) {
			array_push($thumbs, thumb($image, array('width' => $point), false) . " {$point}w");
		} else {
			array_push($thumbs, $image->url() . " {$width}w");
		}
	}

	// string it together
	$srcset = "";
	$count = 1;
	foreach ($thumbs as $thumb) {
		$srcset .= $thumb;
		if ($count < count($thumbs)) {
			$srcset .= ", ";
		}
		$count++;
	}

	// default source for image
	$src = thumb($image, array('width' => 1000), false);

	// convert sizes into proper formatting
	$sizes = "";
	$count = 1;
	foreach ($widths as $width) {
		switch ($count) {
			// small
			case 1:
				$sizes .= "(max-width: 768px) {$width}vw, ";
				break;
			// medium
			case 2:
				$sizes .= "(min-width: 768px) {$width}vw, ";
				break;
			// large
			case 3:
				$sizes .= "(min-width: 1024px) {$width}vw";
				break;
			default:
				# code...
				break;
		}
		$count++;
	}

	// alignment
	$vertical = $image->vertical()->or('center');
	$horizontal = $image->horizontal()->or('center');
	$align = "object-position: $vertical $horizontal";

	// build attributes
	$attr = array(
		'alt' => $alt,
		$lazy ? 'data-src' : 'src' => $src,
		$lazy ? 'data-srcset' : 'srcset' => $srcset,
		'sizes' => $sizes,
		'class' => $lazy ? "lazy $class" : $class,
		'style' => $align
		);

	$attr = array_merge($attr, $settings['attr']);

	return html::tag('img', null, $attr);
}
 ?>