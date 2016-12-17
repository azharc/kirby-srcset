# kirby-srcset

Automatically generates srcset tags and all the images needed. 

Since it generates a lot of thumbnails, it is strongly recommended to use this with the excellent [ImageKit](https://github.com/fabianmichael/kirby-imagekit) plugin *(requires license)*.

## Installation

Download and place in:  
 `site > plugins > srcset`

Or clone using submodule:  
 `git submodule add https://github.com/azharc/kirby-srcset.git site/plugins/srcset`
 
## Usage

To create a new tag:  
`img($image, $options)`

Where `$image` is a Kirby Image Object and `$options` is an array of options. 

## Options

An example array of options using the default set:

```
array(
	"alt" => "",	
	"widths" => [100, 100, 100],
	"class" => "",
	"lazy" => false,
	"attr" => array(),
	)
```

#### alt
String to use in the `alt` attribute, will fallback to the `alt` filefield.

#### widths
The viewport width that the image will appear on mobile, tablet and desktop screen sizes. 

#### class
The value for the `class` attribute. 

#### lazy
If set to true, `data-src` and `data-srcset` tags will be used instead of `src` and `data-srcset`. Use when lazy loading images. 

#### attr
Any additional attributes for the tag, passed as key and value. 

## Object-Fit Alignment

The plugin will pull the `vertical` and `horizontal` file field values from the image to set `object-position` alignment as an inline style. Defaults to `center center`. 


