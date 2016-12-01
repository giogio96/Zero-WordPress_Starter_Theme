# Welcome (Back) to Zero
##### A Powerful WordPress Starter Theme build with futuristic tecnology (Based on Bones)

Hi, this is my personal starter theme for WordPress. It will help you to develop your website easily and with the last teconology. 

## About Zero

I have thing Zero in order to be easy, customizable and superfast! This is all that you have to know about Zero.

- "Bones Based" (if you don't know Bones you [look here](https://github.com/eddiemachado/bones))
- Developed with Node for coding easily and fast
- Scss/Sass core becouse I love it
- Custom stylesheet based on Template Page
- Svg to Css conversion for adhoc icon set
- Custom, easy and light grid system retina display approved
- SEO, Custom Field, Breadcrumbs, Managment,... plugin for WordPress incorpored
- More, more and more...You just have to try!

## Plugins

Zero is a Plugin-Ready Starter Theme becouse give you some usefull plugins that are ready to install easily from the WordPress backend:

* ACF Custom Field
* Contact Form 7
* Yaost SEO
* Breadcrumbs NavXT
* Duplicate Post
* Members
* CodePress Admin Column
* ...

# Installation

** Becouse Zero is made in Node you have to install it!

Becouse it is made with NodeJS, Installation is very easy and quickly:
- Create a directory and Install WordPress
- Enter on it

```sh
$ cd [my-custom-wordpress-directory]/wp-content/themes/
```

- Install Zero WordPress Starter Theme

```sh
$ git clone https://github.com/giogio96/Zero-WordPress_Starter_Theme.git
```

- Install required dependencies

```sh
$ npm install
```

- Start compiling stylesheet and javascript 

```sh
$ gulp default
```

# Scss Setting

You can easily customize your grid, color palette, padding and margin space editing the _variable.scss
#### Grid System
```sh
* $grid-columns: 12; // Number of column (default is 12)
* $wrapper_width: 800px 1000px 120pxx; // Custom Wrapper width (.wrapper_1 is 800px .wrapper_2 is 1000px etc)

/*** GRID SYSTEM ***/
* $device: d desktop 0 1024,      
           null from-tablet 1023, 
           t tablet 1023 768,
           ... 
/*
 * d - The Class Name Es .d-12 (if is 'null' element have not a class element associated)
 * desktop - @Media Query device name Es. @include device(desktop) { }
 * 0 - Device Screen max-widht (if is 0 the @menia query haven't a max-width limit) DO NOT WRITE 'px' after int
 * 1024 - Device Screen min-width (if is not set @menia query haven't a min-width limit) DO NOT WRITE 'px' after int
 */
 
 // Es: 
 // @include device(desktop) { } is like @media screen (min-width: 1024px) { }
 // @include device(from-tablet) { } is like @media screen (max-width: 1024px) { }
 // @include device(tablet) { } is like @media screen (max-width: 1023px) and (min-width: 768px) { }
 // NB: this grid have an automatic-system for work also with retina display!
 
 // Class Gris System is like <div class="d-4 t-6 m-all m2-0"></div>
 // .d-4 is like (4 / $grid-columns) width on desktop (33.33% if $grid-columns is 12)
 // .m-all is like 100% width on mobile
 // .m2-0 is dysplay none on little mobile
 
/*** PADDING & MARGIN ***/
$padding_limit: 10; // number of padding class element (Es. .p10-30 is padding: 10px 30px)
$padding_range: 10; // padding class precision - if 10 padding class go like 10 20 30... if 5 go like 5 10 15 20...
// padding class generated is $padding_limit * $padding_range

$margin_limit: 10; // number of margin class element (Es. .m10-30 is margin: 10px 30px)
$margin_range: 10; // margin class precision - if 10 margin class go like 10 20 30... if 5 go like 5 10 15 20...
// margin class generated is $margin_limit * $margin_range

```
## Cool Features

Zero is "Progressive" Template Ready, you have to set up some parameters and it is ready to work into your smartphone such as an App.

#### Header.php

You need to configure website main color:
```sh
<meta name="theme-color" content="#121212">
```
Some mobile browser (such as Chrome) use this parameter for customize the searchbar when you are on your website

#### Icon Set

In order to add your website into your smartphone home and view it Fullscreen and without Browser Frame you have to setup your icon set: 
```sh
- startup.png (/library/images/) 320px*480px ~ WebApp Splesh Screen
- win8-tile-icon.png (/library/images/) 144px*144px ~ WebApp Home Icon 144px
- apple-touch-icon.png (/library/images/) 129px*129px ~ WebApp Home Icon 129px
- win8-tile-icon-57.png (/library/images/) 57px*57px ~ WebApp Home Icon 57px
- favicon.png & favicon.ico (/) 500px*500px ~ WebSite Icon
```

