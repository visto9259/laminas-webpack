---
id: laminas-webpack-guide-getting-started
position: 1
title: Getting started
sidebar_label: Getting started
---
In a typical Laminas MVC application, HTML pages are rendered using views.

It is also typical to enhance the rendered html using Javascript.  A typical case would be to
use packages like [Bootstrap](https://getbootstrap.com) and [Jquery](https://jquery.com/).

In a typical Laminas View template, you would include the following to add script loading tags
to your head section.

````php
<?php
$this->headscript()->appendFile("https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js");
$this->headscript()->appendFile("https://code.jquery.com/jquery-3.4.1.slim.min.js");
$this->headscript()->appendFile("https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js");
````

When your application starts to have multiple pages and when you want to have different
JS scripts for each page, it came become difficult to keep track of which JS packages need to
be loaded for a given page.

* What scripts should be rendered by the layout template?
* What scripts should be rendered by a page view template?
* Where do you render you own scripts for a give page?

If you are using a frontend framework like Angular or React, you know that the number of
individual JS files can increase tremendously.  Most probably, you are also using Webpack and transpiler 
like Babel to compile and manage dependencies.

I have use RequireJS in the past to manage the dependencies between scripts
and packages when my scripts were somewhat simple.  Now that I am moving to React, I find that
the number of scripts is increasing.  In order to automate everyting, I also started using Webpack.

 


 

 
 
