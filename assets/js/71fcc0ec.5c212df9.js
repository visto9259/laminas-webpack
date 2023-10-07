"use strict";(self.webpackChunkdocs=self.webpackChunkdocs||[]).push([[455],{3905:(e,t,a)=>{a.d(t,{Zo:()=>c,kt:()=>m});var n=a(7294);function r(e,t,a){return t in e?Object.defineProperty(e,t,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[t]=a,e}function i(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,n)}return a}function o(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?i(Object(a),!0).forEach((function(t){r(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):i(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}function s(e,t){if(null==e)return{};var a,n,r=function(e,t){if(null==e)return{};var a,n,r={},i=Object.keys(e);for(n=0;n<i.length;n++)a=i[n],t.indexOf(a)>=0||(r[a]=e[a]);return r}(e,t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(e);for(n=0;n<i.length;n++)a=i[n],t.indexOf(a)>=0||Object.prototype.propertyIsEnumerable.call(e,a)&&(r[a]=e[a])}return r}var p=n.createContext({}),l=function(e){var t=n.useContext(p),a=t;return e&&(a="function"==typeof e?e(t):o(o({},t),e)),a},c=function(e){var t=l(e.components);return n.createElement(p.Provider,{value:t},e.children)},u="mdxType",d={inlineCode:"code",wrapper:function(e){var t=e.children;return n.createElement(n.Fragment,{},t)}},g=n.forwardRef((function(e,t){var a=e.components,r=e.mdxType,i=e.originalType,p=e.parentName,c=s(e,["components","mdxType","originalType","parentName"]),u=l(a),g=r,m=u["".concat(p,".").concat(g)]||u[g]||d[g]||i;return a?n.createElement(m,o(o({ref:t},c),{},{components:a})):n.createElement(m,o({ref:t},c))}));function m(e,t){var a=arguments,r=t&&t.mdxType;if("string"==typeof e||r){var i=a.length,o=new Array(i);o[0]=g;var s={};for(var p in t)hasOwnProperty.call(t,p)&&(s[p]=t[p]);s.originalType=e,s[u]="string"==typeof e?e:r,o[1]=s;for(var l=2;l<i;l++)o[l]=a[l];return n.createElement.apply(null,o)}return n.createElement.apply(null,a)}g.displayName="MDXCreateElement"},1902:(e,t,a)=>{a.r(t),a.d(t,{assets:()=>p,contentTitle:()=>o,default:()=>d,frontMatter:()=>i,metadata:()=>s,toc:()=>l});var n=a(7462),r=(a(7294),a(3905));const i={id:"laminas-webpack-guide-getting-started",position:1,title:"Getting started",sidebar_label:"Getting started"},o=void 0,s={unversionedId:"guides/laminas-webpack-guide-getting-started",id:"guides/laminas-webpack-guide-getting-started",title:"Getting started",description:"In a typical Laminas MVC application, HTML pages are rendered using views.",source:"@site/docs/guides/1-getting-started.md",sourceDirName:"guides",slug:"/guides/laminas-webpack-guide-getting-started",permalink:"/laminas-webpack/docs/guides/laminas-webpack-guide-getting-started",draft:!1,tags:[],version:"current",sidebarPosition:1,frontMatter:{id:"laminas-webpack-guide-getting-started",position:1,title:"Getting started",sidebar_label:"Getting started"},sidebar:"tutorialSidebar",previous:{title:"Integrating Laminas MVC with Webpack",permalink:"/laminas-webpack/docs/category/integrating-laminas-mvc-with-webpack"},next:{title:"Setting up Laminas MVC to use Webpack",permalink:"/laminas-webpack/docs/guides/laminas-webpack-guide-setting-up"}},p={},l=[],c={toc:l},u="wrapper";function d(e){let{components:t,...a}=e;return(0,r.kt)(u,(0,n.Z)({},c,a,{components:t,mdxType:"MDXLayout"}),(0,r.kt)("p",null,"In a typical Laminas MVC application, HTML pages are rendered using views."),(0,r.kt)("p",null,"It is also typical to enhance the rendered html using Javascript.  A typical case would be to\nuse packages like ",(0,r.kt)("a",{parentName:"p",href:"https://getbootstrap.com"},"Bootstrap")," and ",(0,r.kt)("a",{parentName:"p",href:"https://jquery.com/"},"Jquery"),"."),(0,r.kt)("p",null,"In a typical Laminas View template, you would include the following to add script loading tags\nto your head section."),(0,r.kt)("pre",null,(0,r.kt)("code",{parentName:"pre",className:"language-php"},'<?php\n$this->headscript()->appendFile("https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js");\n$this->headscript()->appendFile("https://code.jquery.com/jquery-3.4.1.slim.min.js");\n$this->headscript()->appendFile("https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js");\n')),(0,r.kt)("p",null,"When your application starts to have multiple pages and when you want to have different\nJS scripts for each page, it came become difficult to keep track of which JS packages need to\nbe loaded for a given page."),(0,r.kt)("ul",null,(0,r.kt)("li",{parentName:"ul"},"What scripts should be rendered by the layout template?"),(0,r.kt)("li",{parentName:"ul"},"What scripts should be rendered by a page view template?"),(0,r.kt)("li",{parentName:"ul"},"Where do you render you own scripts for a give page?")),(0,r.kt)("p",null,"If you are using a frontend framework like Angular or React, you know that the number of\nindividual JS files can increase tremendously.  Most probably, you are also using Webpack and transpiler\nlike Babel to compile and manage dependencies."),(0,r.kt)("p",null,"I have use RequireJS in the past to manage the dependencies between scripts\nand packages when my scripts were somewhat simple.  Now that I am moving to React, I find that\nthe number of scripts is increasing.  In order to automate everyting, I also started using Webpack."))}d.isMDXComponent=!0}}]);