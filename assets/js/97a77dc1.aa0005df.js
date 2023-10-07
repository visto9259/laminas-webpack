"use strict";(self.webpackChunkdocs=self.webpackChunkdocs||[]).push([[150],{3905:(e,n,t)=>{t.d(n,{Zo:()=>u,kt:()=>h});var a=t(7294);function o(e,n,t){return n in e?Object.defineProperty(e,n,{value:t,enumerable:!0,configurable:!0,writable:!0}):e[n]=t,e}function i(e,n){var t=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);n&&(a=a.filter((function(n){return Object.getOwnPropertyDescriptor(e,n).enumerable}))),t.push.apply(t,a)}return t}function r(e){for(var n=1;n<arguments.length;n++){var t=null!=arguments[n]?arguments[n]:{};n%2?i(Object(t),!0).forEach((function(n){o(e,n,t[n])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(t)):i(Object(t)).forEach((function(n){Object.defineProperty(e,n,Object.getOwnPropertyDescriptor(t,n))}))}return e}function l(e,n){if(null==e)return{};var t,a,o=function(e,n){if(null==e)return{};var t,a,o={},i=Object.keys(e);for(a=0;a<i.length;a++)t=i[a],n.indexOf(t)>=0||(o[t]=e[t]);return o}(e,n);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(e);for(a=0;a<i.length;a++)t=i[a],n.indexOf(t)>=0||Object.prototype.propertyIsEnumerable.call(e,t)&&(o[t]=e[t])}return o}var p=a.createContext({}),s=function(e){var n=a.useContext(p),t=n;return e&&(t="function"==typeof e?e(n):r(r({},n),e)),t},u=function(e){var n=s(e.components);return a.createElement(p.Provider,{value:n},e.children)},c="mdxType",d={inlineCode:"code",wrapper:function(e){var n=e.children;return a.createElement(a.Fragment,{},n)}},m=a.forwardRef((function(e,n){var t=e.components,o=e.mdxType,i=e.originalType,p=e.parentName,u=l(e,["components","mdxType","originalType","parentName"]),c=s(t),m=o,h=c["".concat(p,".").concat(m)]||c[m]||d[m]||i;return t?a.createElement(h,r(r({ref:n},u),{},{components:t})):a.createElement(h,r({ref:n},u))}));function h(e,n){var t=arguments,o=n&&n.mdxType;if("string"==typeof e||o){var i=t.length,r=new Array(i);r[0]=m;var l={};for(var p in n)hasOwnProperty.call(n,p)&&(l[p]=n[p]);l.originalType=e,l[c]="string"==typeof e?e:o,r[1]=l;for(var s=2;s<i;s++)r[s]=t[s];return a.createElement.apply(null,r)}return a.createElement.apply(null,t)}m.displayName="MDXCreateElement"},179:(e,n,t)=>{t.r(n),t.d(n,{assets:()=>p,contentTitle:()=>r,default:()=>d,frontMatter:()=>i,metadata:()=>l,toc:()=>s});var a=t(7462),o=(t(7294),t(3905));const i={id:"laminas-webpack-guide-setting-up",title:"Setting up Laminas MVC to use Webpack",sidebar_label:"Setting up Laminas MVC to use Webpack"},r=void 0,l={unversionedId:"guides/laminas-webpack-guide-setting-up",id:"guides/laminas-webpack-guide-setting-up",title:"Setting up Laminas MVC to use Webpack",description:"This is not a guide on setting up a Webpack environment.  I got inspired by this excellent answer",source:"@site/docs/guides/2-setting-up.md",sourceDirName:"guides",slug:"/guides/laminas-webpack-guide-setting-up",permalink:"/laminas-webpack/docs/guides/laminas-webpack-guide-setting-up",draft:!1,tags:[],version:"current",sidebarPosition:2,frontMatter:{id:"laminas-webpack-guide-setting-up",title:"Setting up Laminas MVC to use Webpack",sidebar_label:"Setting up Laminas MVC to use Webpack"},sidebar:"tutorialSidebar",previous:{title:"Getting started",permalink:"/laminas-webpack/docs/guides/laminas-webpack-guide-getting-started"},next:{title:"Setting up the Webpack bundler",permalink:"/laminas-webpack/docs/guides/laminas-webpack-guide-setting-webpack"}},p={},s=[{value:"Setting up your Laminas application",id:"setting-up-your-laminas-application",level:2},{value:"Setting up your JS files",id:"setting-up-your-js-files",level:2},{value:"Sharing entry points",id:"sharing-entry-points",level:2},{value:"Using the bundles in Laminas MVC",id:"using-the-bundles-in-laminas-mvc",level:2}],u={toc:s},c="wrapper";function d(e){let{components:n,...t}=e;return(0,o.kt)(c,(0,a.Z)({},u,t,{components:n,mdxType:"MDXLayout"}),(0,o.kt)("blockquote",null,(0,o.kt)("p",{parentName:"blockquote"},"This is not a guide on setting up a Webpack environment.  I got inspired by this excellent ",(0,o.kt)("a",{parentName:"p",href:"https://stackoverflow.com/questions/43436754/using-webpack-with-an-existing-php-and-js-project"},"answer"),"\non Stackoverflow by ",(0,o.kt)("a",{parentName:"p",href:"https://github.com/Loilo"},"Loilo"),".  Further investigations led me to the\nWebpack plugin ",(0,o.kt)("a",{parentName:"p",href:"https://github.com/castiron/webpack-php-manifest"},"castiron/webpack-php-manifest"),".")),(0,o.kt)("blockquote",null,(0,o.kt)("p",{parentName:"blockquote"},"This is not a guide on setting up a Laminas MVC application either.  The Laminas MVC Skeleton is a good place to start\nand this is what I used for my own application.")),(0,o.kt)("h2",{id:"setting-up-your-laminas-application"},"Setting up your Laminas application"),(0,o.kt)("p",null," So here's a typical Laminas MVC directory structure:"),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre"},".\n+--config\n|   +--autoload\n|   application.config.php\n+--data\n+--module\n|  +--Application\n|  |  +--config\n|  |  +--src\n|  |  +--view\n|  +--AnotherModule\n+--public\n|  +--js\n|  +--css\n+--vendor\ncomposer.json\ncomposer.lock\n")),(0,o.kt)("p",null,"So where's the best place to hold all your JS sources?  That's up to you.  I personally\ndecided to have all my JS sources in a ",(0,o.kt)("inlineCode",{parentName:"p"},"browser")," subfolder of the root directory.  "),(0,o.kt)("p",null,"Then I followed the guidelines provided by ",(0,o.kt)("a",{parentName:"p",href:"https://github.com/Loilo"},"Loilo")," in his Stackoverflow ",(0,o.kt)("a",{parentName:"p",href:"https://stackoverflow.com/questions/43436754/using-webpack-with-an-existing-php-and-js-project"},"answer"),"\nand created ",(0,o.kt)("inlineCode",{parentName:"p"},"src")," and ",(0,o.kt)("inlineCode",{parentName:"p"},"build")," folders under ",(0,o.kt)("inlineCode",{parentName:"p"},"browser")," like this: "),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre"},".\n+--browser\n|  +--build\n|  +--src\n+--config\n|   +--autoload\n|   application.config.php\n+--data\n+--module\n|  +--Application\n|  |  +--config\n|  |  +--src\n|  |  +--view\n|  +--AnotherModule\n+--public\n|  +--js\n|  +--css\n+--vendor\ncomposer.json\ncomposer.lock\n")),(0,o.kt)("p",null,"I also decided that the root folder would also be where the ",(0,o.kt)("inlineCode",{parentName:"p"},"node")," modules would be located.\nIt could have been anywhere but it allows you to use all kinds of ",(0,o.kt)("inlineCode",{parentName:"p"},"node")," tools and automation\nin the project. So once you initialize your ",(0,o.kt)("inlineCode",{parentName:"p"},"node")," environment, you end up with this:"),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre"},".\n+--browser\n|  +--build\n|  +--src\n+--config\n|   +--autoload\n|   application.config.php\n+--data\n+--module\n|  +--Application\n|  |  +--config\n|  |  +--src\n|  |  +--view\n|  +--AnotherModule\n+--node_modules\n+--public\n|  +--js\n|  +--css\n+--vendor\ncomposer.json\ncomposer.lock\npackage.json\n")),(0,o.kt)("h2",{id:"setting-up-your-js-files"},"Setting up your JS files"),(0,o.kt)("p",null," How you want to set up your JS source files is up to you.  "),(0,o.kt)("p",null," I personally wanted to have some level of structure and organization in source files that\nmatches the structure of my application's pages.  Since each page rendered by the application\nis its own frontend JS app, my ",(0,o.kt)("inlineCode",{parentName:"p"},"src")," folder matches the ",(0,o.kt)("inlineCode",{parentName:"p"},"module/controller-action/view")," structure.     "),(0,o.kt)("p",null," In addition, you can share common JS modules using a ",(0,o.kt)("inlineCode",{parentName:"p"},"lib")," folder within the ",(0,o.kt)("inlineCode",{parentName:"p"},"src")," folder."),(0,o.kt)("p",null," For example, if you have a module called ",(0,o.kt)("inlineCode",{parentName:"p"},"mymodule")," with a controller called ",(0,o.kt)("inlineCode",{parentName:"p"},"mycontroller"),"\nand the following actions ",(0,o.kt)("inlineCode",{parentName:"p"},"index"),", ",(0,o.kt)("inlineCode",{parentName:"p"},"edit"),", ",(0,o.kt)("inlineCode",{parentName:"p"},"detail")," with corresponding view templates, then you\ncan use a structure like this:"),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre"},".\n+--browser\n|  +--build\n|  +--src\n|    +--lib\n|    |  common-code.js\n|    +--mymodule\n|       +--mycontroller\n|          index.js\n|          details.js\n|          edit.js\n+--...\n")),(0,o.kt)("p",null,"The important concept here is that ",(0,o.kt)("inlineCode",{parentName:"p"},"index.js"),", ",(0,o.kt)("inlineCode",{parentName:"p"},"details.js")," and ",(0,o.kt)("inlineCode",{parentName:"p"},"edit.js")," are ",(0,o.kt)("em",{parentName:"p"},"entry points"),"\nfor the JS scripts that the corresponding view template will need to load.    "),(0,o.kt)("p",null,"This means that ",(0,o.kt)("inlineCode",{parentName:"p"},"index.js")," will\nneed to ",(0,o.kt)("em",{parentName:"p"},"require")," or ",(0,o.kt)("em",{parentName:"p"},"import")," all the libraries and modules that it needs to rendered the frontend\npart of the page such that Webpack can create a bundle of scripts for the view."),(0,o.kt)("p",null,"As example, if you need Bootstrap in your page, then ",(0,o.kt)("inlineCode",{parentName:"p"},"index.js")," could look like:"),(0,o.kt)("pre",null,(0,o.kt)("code",{parentName:"pre",className:"language-javascript"},"/**\n * This imports Bootstrap JS and its css\n */\nimport 'bootstrap';\nimport 'bootstrap/dist/css/bootstrap.min.css';\n\n/*\n    you own code go here\n*/\n")),(0,o.kt)("p",null,"Webpack will include Bootstrap's dependencies ",(0,o.kt)("inlineCode",{parentName:"p"},"Jquery")," and ",(0,o.kt)("inlineCode",{parentName:"p"},"popper.js")," in the bundle."),(0,o.kt)("h2",{id:"sharing-entry-points"},"Sharing entry points"),(0,o.kt)("p",null,"Obviously, if you follow strictly my proposed structure, you would end up with as many JS files\nas you have pages in your application."),(0,o.kt)("p",null,"To avoid this, I usually have a ",(0,o.kt)("em",{parentName:"p"},"common")," entry point for all pages that use the same bundle like\nthe ",(0,o.kt)("inlineCode",{parentName:"p"},"Bootstrap")," bundle above.  This is useful when the only thing your page needs is ",(0,o.kt)("inlineCode",{parentName:"p"},"Bootstrap"),"."),(0,o.kt)("h2",{id:"using-the-bundles-in-laminas-mvc"},"Using the bundles in Laminas MVC"),(0,o.kt)("p",null,"Laminas Skeleton application expects the ",(0,o.kt)("inlineCode",{parentName:"p"},"public")," folder to hold all ",(0,o.kt)("em",{parentName:"p"},"Internet-facing")," assets.\nTherefore, all the bundles generated by Webpack from the ",(0,o.kt)("inlineCode",{parentName:"p"},"src")," files should go somewhere under the ",(0,o.kt)("inlineCode",{parentName:"p"},"public")," folder.\nI personally use a ",(0,o.kt)("inlineCode",{parentName:"p"},"public/dist")," folder to hold the generated bundles.  "),(0,o.kt)("p",null,"Depending on how you set up Webpack, there will be many bundles generated in your ",(0,o.kt)("inlineCode",{parentName:"p"},"public/dist")," folder.  You will need\nto make sure that your Laminas view template loads all the scripts of an entry point's bundle which\ncan very quickly become complex unless you automate the development process."),(0,o.kt)("p",null,"More on this in the ",(0,o.kt)("a",{parentName:"p",href:"/laminas-webpack/docs/guides/laminas-webpack-guide-setting-webpack"},"next page")," of this guide."))}d.isMDXComponent=!0}}]);