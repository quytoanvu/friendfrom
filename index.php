<?php
/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new \Slim\Slim();
$app->config(array(
    'debug' => true,
    'templates.path' => 'templates'
));
/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, and `Slim::delete`
 * is an anonymous function.
 */

// GET route
$app->get('/', function () {
    $template = <<<EOT
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8"/>
            <title>Slim Framework for PHP 5</title>
            <style>
                html,body,div,span,object,iframe,
                h1,h2,h3,h4,h5,h6,p,blockquote,pre,
                abbr,address,cite,code,
                del,dfn,em,img,ins,kbd,q,samp,
                small,strong,sub,sup,var,
                b,i,
                dl,dt,dd,ol,ul,li,
                fieldset,form,label,legend,
                table,caption,tbody,tfoot,thead,tr,th,td,
                article,aside,canvas,details,figcaption,figure,
                footer,header,hgroup,menu,nav,section,summary,
                time,mark,audio,video{margin:0;padding:0;border:0;outline:0;font-size:100%;vertical-align:baseline;background:transparent;}
                body{line-height:1;}
                article,aside,details,figcaption,figure,
                footer,header,hgroup,menu,nav,section{display:block;}
                nav ul{list-style:none;}
                blockquote,q{quotes:none;}
                blockquote:before,blockquote:after,
                q:before,q:after{content:'';content:none;}
                a{margin:0;padding:0;font-size:100%;vertical-align:baseline;background:transparent;}
                ins{background-color:#ff9;color:#000;text-decoration:none;}
                mark{background-color:#ff9;color:#000;font-style:italic;font-weight:bold;}
                del{text-decoration:line-through;}
                abbr[title],dfn[title]{border-bottom:1px dotted;cursor:help;}
                table{border-collapse:collapse;border-spacing:0;}
                hr{display:block;height:1px;border:0;border-top:1px solid #cccccc;margin:1em 0;padding:0;}
                input,select{vertical-align:middle;}
                html{ background: #EDEDED; height: 100%; }
                body{background:#FFF;margin:0 auto;min-height:100%;padding:0 30px;width:440px;color:#666;font:14px/23px Arial,Verdana,sans-serif;}
                h1,h2,h3,p,ul,ol,form,section{margin:0 0 20px 0;}
                h1{color:#333;font-size:20px;}
                h2,h3{color:#333;font-size:14px;}
                h3{margin:0;font-size:12px;font-weight:bold;}
                ul,ol{list-style-position:inside;color:#999;}
                ul{list-style-type:square;}
                code,kbd{background:#EEE;border:1px solid #DDD;border:1px solid #DDD;border-radius:4px;-moz-border-radius:4px;-webkit-border-radius:4px;padding:0 4px;color:#666;font-size:12px;}
                pre{background:#EEE;border:1px solid #DDD;border-radius:4px;-moz-border-radius:4px;-webkit-border-radius:4px;padding:5px 10px;color:#666;font-size:12px;}
                pre code{background:transparent;border:none;padding:0;}
                a{color:#70a23e;}
                header{padding: 30px 0;text-align:center;}
            </style>
        </head>
        <body>
            <header>
                <a href="http://www.slimframework.com"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHIAAAA6CAYAAABs1g18AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAABRhJREFUeNrsXY+VsjAMR98twAo6Ao4gI+gIOIKOgCPICDoCjCAjXFdgha+5C3dcv/QfFB5i8h5PD21Bfk3yS9L2VpGnlGW5kS9wJMTHNRxpmjYRy6SycgRvL18OeMQOTYQ8HvIoJKiiz43hgHkq1zvK/h6e/TyJQXeV/VyWBOSHA4C5RvtMAiCc4ZB9FPjgRI8+YuKcrySO515a1hoAY3nc4G2AH52BZsn+MjaAEwIJICKAIR889HljMCcyrR0QE4v/q/BVBQva7Q1tAczG18+x+PvIswHEAslLbfGrMZKiXEOMAMy6LwlisQCJLPFMfKdBtli5dIihRyH7A627Iaiq5sJ1ThP9xoIgSdWSNVIHYmrTQgOgRyRNqm/M5PnrFFopr3F6B41cd8whRUSufUBU5EL4U93AYRnIWimCIiSI1wAaAZpJ9bPnxx8eyI3Gt4QybwWa6T/BvbQECUMQFkhd3jSkPFgrxwcynuBaNT/u6eJIlbGOBWSNIUDFEIwPZFAtBfYrfeIOSRSXuUYCsprCXwUIZWYnmEhJFMIocMDWjn206c2EsGLCJd42aWSyBNMnHxLEq7niMrY2qyDbQUbqrrTbwUPtxN1ZZCitQV4ZSd6DyoxhmRD6OFjuRUS/KdLGRHYowJZaqYgjt9Lchmi3QYA/cXBsHK6VfWNR5jgA1DLhwfFe4HqfODBpINEECCLO47LT/+HSvSd/OCOgQ8qE0DbHQUBqpC4BkKMPYPkFY4iAJXhGAYr1qmaqQDbECCg5A2NMchzR567aA4xcRKclI405Bmt46vYD7/Gcjqfk6GP/kh1wovIDSHDfiAs/8bOCQ4cf4qMt7eH5Cucr3S0aWGFfjdLHD8EhCFvXQlSqRrY5UV2O9cfZtk77jUFMXeqzCEZqSK4ICkSin2tE12/3rbVcE41OBjBjBPSdJ1N5lfYQpIuhr8axnyIy5KvXmkYnw8VbcwtTNj7fDNCmT2kPQXA+bxpEXkB21HlnSQq0gD67jnfh5KavVJa/XQYEFSaagWwbgjNA+ywstLpEWTKgc5gwVpsyO1bTII+tA6B7BPS+0PiznuM9gPKsPVXbFdADMtwbJxSmkXWfRh6AZhyyzBjIHoDmnCGaMZAKjd5hyNJYCBGDOVcg28AXQ5atAVDO3c4dSALQnYblfa3M4kc/cyA7gMIUBQCTyl4kugIpy8yA7ACqK8Uwk30lIFGOEV3rPDAELwQkr/9YjkaCPDQhCcsrAYlF1v8W8jAEYeQDY7qn6tNGWudfq+YUEr6uq6FZzBpJMUfWFDatLHMCciw2mRC+k81qCCA1DzK4aUVfrJpxnloZWCPVnOgYy8L3GvKjE96HpweQoy7iwVQclVutLOEKJxA8gaRCjSzgNI2zhh3bQhzBCQQPIHGaHaUd96GJbZz3Smmjy16u6j3FuKyNxcBarxqWWfYFE0tVVO1Rl3t1Mb05V00MQCJ71YHpNaMcsjWAfkQvPPkaNC7LqTG7JAhGXTKYf+VDeXAX9IvURoAwtTFHvyYIxtnd5tPkywrPafcwbeSuGVwFau3b76NO7SHQrvqhfFE8kM0Wvpv8gVYiYBlxL+fW/34bgP6bIC7JR7YPDubcHCPzIp4+cum7U6NlhZgK7lua3KGLeFwE2m+HblDYWSHG2SAfINuwBBfxbJEIuWZbBH4fAExD7cvaGVyXyH0dhiAYc92z3ZDfUVv+jgb8HrHy7WVO/8BFcy9vuTz+nwADAGnOR39Yg/QkAAAAAElFTkSuQmCC" alt="Slim"/></a>
            </header>
            <h1>Welcome to Slim!</h1>
            <p>
                Congratulations! Your Slim application is running. If this is
                your first time using Slim, start with this <a href="http://www.slimframework.com/learn" target="_blank">"Hello World" Tutorial</a>.
            </p>
            <section>
                <h2>Get Started</h2>
                <ol>
                    <li>The application code is in <code>index.php</code></li>
                    <li>Read the <a href="http://docs.slimframework.com/" target="_blank">online documentation</a></li>
                    <li>Follow <a href="http://www.twitter.com/slimphp" target="_blank">@slimphp</a> on Twitter</li>
                </ol>
            </section>
            <section>
                <h2>Slim Framework Community</h2>

                <h3>Support Forum and Knowledge Base</h3>
                <p>
                    Visit the <a href="http://help.slimframework.com" target="_blank">Slim support forum and knowledge base</a>
                    to read announcements, chat with fellow Slim users, ask questions, help others, or show off your cool
                    Slim Framework apps.
                </p>

                <h3>Twitter</h3>
                <p>
                    Follow <a href="http://www.twitter.com/slimphp" target="_blank">@slimphp</a> on Twitter to receive the very latest news
                    and updates about the framework.
                </p>
            </section>
            <section style="padding-bottom: 20px">
                <h2>Slim Framework Extras</h2>
                <p>
                    Custom View classes for Smarty, Twig, Mustache, and other template
                    frameworks are available online in a separate repository.
                </p>
                <p><a href="https://github.com/codeguy/Slim-Extras" target="_blank">Browse the Extras Repository</a></p>
            </section>
        </body>
    </html>
EOT;
    echo $template;
});

$app->get('/d3js_friends', function () {
    $template = <<<EOT
<!DOCTYPE html>
<meta charset="utf-8">
<style>

.node {
  stroke: #fff;
  stroke-width: 1.5px;
}

.link {
  stroke: #999;
  stroke-opacity: .6;
}

</style>
<body>
<script src="http://d3js.org/d3.v3.min.js"></script>
<script>

var width = 960,
    height = 500;

var color = d3.scale.category20();

var force = d3.layout.force()
    .charge(-120)
    .linkDistance(30)
    .size([width, height]);

var svg = d3.select("body").append("svg")
    .attr("width", width)
    .attr("height", height);

d3.json("miserables", function(error, graph) {
  force
      .nodes(graph.nodes)
      .links(graph.links)
      .start();

  var link = svg.selectAll(".link")
      .data(graph.links)
    .enter().append("line")
      .attr("class", "link")
      .style("stroke-width", function(d) { return Math.sqrt(d.value); });

  var node = svg.selectAll(".node")
      .data(graph.nodes)
    .enter().append("circle")
      .attr("class", "node")
      .attr("r", 5)
      .style("fill", function(d) { return color(d.group); })
      .call(force.drag);

  node.append("title")
      .text(function(d) { return d.name; });

  force.on("tick", function() {
    link.attr("x1", function(d) { return d.source.x; })
        .attr("y1", function(d) { return d.source.y; })
        .attr("x2", function(d) { return d.target.x; })
        .attr("y2", function(d) { return d.target.y; });

    node.attr("cx", function(d) { return d.x; })
        .attr("cy", function(d) { return d.y; });
  });
});

</script>
EOT;
    echo $template;
});

$app->get('/springy_friends', function () {
    $template = <<<EOT
<html>
<body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script src="templates/js/springy/springy.js"></script>
<script src="templates/js/springy/springyui.js"></script>
<script>
var graph = new Springy.Graph();

var dennis = graph.newNode({
  label: 'Dennis',
  ondoubleclick: function() { console.log("Hello!"); }
});
var michael = graph.newNode({label: 'Michael'});
var jessica = graph.newNode({label: 'Jessica'});
var timothy = graph.newNode({label: 'Timothy'});
var barbara = graph.newNode({label: 'Barbara'});
var franklin = graph.newNode({label: 'Franklin'});
var monty = graph.newNode({label: 'Monty'});
var james = graph.newNode({label: 'James'});
var bianca = graph.newNode({label: 'Bianca'});

graph.newEdge(dennis, michael, {color: '#00A0B0'});
graph.newEdge(michael, dennis, {color: '#6A4A3C'});
graph.newEdge(michael, jessica, {color: '#CC333F'});
graph.newEdge(jessica, barbara, {color: '#EB6841'});
graph.newEdge(michael, timothy, {color: '#EDC951'});
graph.newEdge(franklin, monty, {color: '#7DBE3C'});
graph.newEdge(dennis, monty, {color: '#000000'});
graph.newEdge(monty, james, {color: '#00A0B0'});
graph.newEdge(barbara, timothy, {color: '#6A4A3C'});
graph.newEdge(dennis, bianca, {color: '#CC333F'});
graph.newEdge(bianca, monty, {color: '#EB6841'});

jQuery(function(){
  var springy = window.springy = jQuery('#springydemo').springy({
    graph: graph,
    nodeSelected: function(node){
      console.log('Node selected: ' + JSON.stringify(node.data));
    }
  });
});
</script>

<canvas id="springydemo" width="640" height="480" />
</body>
</html>

EOT;
    echo $template;
});

$app->get('/miserables', function () use ($app) {
    $app->response()->header('Content-Type', 'application/json');
    echo '{
      "nodes":[
        {"name":"Myriel","group":1},
        {"name":"Napoleon","group":1},
        {"name":"Mlle.Baptistine","group":1},
        {"name":"Mme.Magloire","group":1},
        {"name":"CountessdeLo","group":1},
        {"name":"Geborand","group":1},
        {"name":"Champtercier","group":1},
        {"name":"Cravatte","group":1},
        {"name":"Count","group":1},
        {"name":"OldMan","group":1},
        {"name":"Labarre","group":2},
        {"name":"Valjean","group":2},
        {"name":"Marguerite","group":3},
        {"name":"Mme.deR","group":2},
        {"name":"Isabeau","group":2},
        {"name":"Gervais","group":2},
        {"name":"Tholomyes","group":3},
        {"name":"Listolier","group":3},
        {"name":"Fameuil","group":3},
        {"name":"Blacheville","group":3},
        {"name":"Favourite","group":3},
        {"name":"Dahlia","group":3},
        {"name":"Zephine","group":3},
        {"name":"Fantine","group":3},
        {"name":"Mme.Thenardier","group":4},
        {"name":"Thenardier","group":4},
        {"name":"Cosette","group":5},
        {"name":"Javert","group":4},
        {"name":"Fauchelevent","group":0},
        {"name":"Bamatabois","group":2},
        {"name":"Perpetue","group":3},
        {"name":"Simplice","group":2},
        {"name":"Scaufflaire","group":2},
        {"name":"Woman1","group":2},
        {"name":"Judge","group":2},
        {"name":"Champmathieu","group":2},
        {"name":"Brevet","group":2},
        {"name":"Chenildieu","group":2},
        {"name":"Cochepaille","group":2},
        {"name":"Pontmercy","group":4},
        {"name":"Boulatruelle","group":6},
        {"name":"Eponine","group":4},
        {"name":"Anzelma","group":4},
        {"name":"Woman2","group":5},
        {"name":"MotherInnocent","group":0},
        {"name":"Gribier","group":0},
        {"name":"Jondrette","group":7},
        {"name":"Mme.Burgon","group":7},
        {"name":"Gavroche","group":8},
        {"name":"Gillenormand","group":5},
        {"name":"Magnon","group":5},
        {"name":"Mlle.Gillenormand","group":5},
        {"name":"Mme.Pontmercy","group":5},
        {"name":"Mlle.Vaubois","group":5},
        {"name":"Lt.Gillenormand","group":5},
        {"name":"Marius","group":8},
        {"name":"BaronessT","group":5},
        {"name":"Mabeuf","group":8},
        {"name":"Enjolras","group":8},
        {"name":"Combeferre","group":8},
        {"name":"Prouvaire","group":8},
        {"name":"Feuilly","group":8},
        {"name":"Courfeyrac","group":8},
        {"name":"Bahorel","group":8},
        {"name":"Bossuet","group":8},
        {"name":"Joly","group":8},
        {"name":"Grantaire","group":8},
        {"name":"MotherPlutarch","group":9},
        {"name":"Gueulemer","group":4},
        {"name":"Babet","group":4},
        {"name":"Claquesous","group":4},
        {"name":"Montparnasse","group":4},
        {"name":"Toussaint","group":5},
        {"name":"Child1","group":10},
        {"name":"Child2","group":10},
        {"name":"Brujon","group":4},
        {"name":"Mme.Hucheloup","group":8}
      ],
      "links":[
        {"source":1,"target":0,"value":1},
        {"source":2,"target":0,"value":8},
        {"source":3,"target":0,"value":10},
        {"source":3,"target":2,"value":6},
        {"source":4,"target":0,"value":1},
        {"source":5,"target":0,"value":1},
        {"source":6,"target":0,"value":1},
        {"source":7,"target":0,"value":1},
        {"source":8,"target":0,"value":2},
        {"source":9,"target":0,"value":1},
        {"source":11,"target":10,"value":1},
        {"source":11,"target":3,"value":3},
        {"source":11,"target":2,"value":3},
        {"source":11,"target":0,"value":5},
        {"source":12,"target":11,"value":1},
        {"source":13,"target":11,"value":1},
        {"source":14,"target":11,"value":1},
        {"source":15,"target":11,"value":1},
        {"source":17,"target":16,"value":4},
        {"source":18,"target":16,"value":4},
        {"source":18,"target":17,"value":4},
        {"source":19,"target":16,"value":4},
        {"source":19,"target":17,"value":4},
        {"source":19,"target":18,"value":4},
        {"source":20,"target":16,"value":3},
        {"source":20,"target":17,"value":3},
        {"source":20,"target":18,"value":3},
        {"source":20,"target":19,"value":4},
        {"source":21,"target":16,"value":3},
        {"source":21,"target":17,"value":3},
        {"source":21,"target":18,"value":3},
        {"source":21,"target":19,"value":3},
        {"source":21,"target":20,"value":5},
        {"source":22,"target":16,"value":3},
        {"source":22,"target":17,"value":3},
        {"source":22,"target":18,"value":3},
        {"source":22,"target":19,"value":3},
        {"source":22,"target":20,"value":4},
        {"source":22,"target":21,"value":4},
        {"source":23,"target":16,"value":3},
        {"source":23,"target":17,"value":3},
        {"source":23,"target":18,"value":3},
        {"source":23,"target":19,"value":3},
        {"source":23,"target":20,"value":4},
        {"source":23,"target":21,"value":4},
        {"source":23,"target":22,"value":4},
        {"source":23,"target":12,"value":2},
        {"source":23,"target":11,"value":9},
        {"source":24,"target":23,"value":2},
        {"source":24,"target":11,"value":7},
        {"source":25,"target":24,"value":13},
        {"source":25,"target":23,"value":1},
        {"source":25,"target":11,"value":12},
        {"source":26,"target":24,"value":4},
        {"source":26,"target":11,"value":31},
        {"source":26,"target":16,"value":1},
        {"source":26,"target":25,"value":1},
        {"source":27,"target":11,"value":17},
        {"source":27,"target":23,"value":5},
        {"source":27,"target":25,"value":5},
        {"source":27,"target":24,"value":1},
        {"source":27,"target":26,"value":1},
        {"source":28,"target":11,"value":8},
        {"source":28,"target":27,"value":1},
        {"source":29,"target":23,"value":1},
        {"source":29,"target":27,"value":1},
        {"source":29,"target":11,"value":2},
        {"source":30,"target":23,"value":1},
        {"source":31,"target":30,"value":2},
        {"source":31,"target":11,"value":3},
        {"source":31,"target":23,"value":2},
        {"source":31,"target":27,"value":1},
        {"source":32,"target":11,"value":1},
        {"source":33,"target":11,"value":2},
        {"source":33,"target":27,"value":1},
        {"source":34,"target":11,"value":3},
        {"source":34,"target":29,"value":2},
        {"source":35,"target":11,"value":3},
        {"source":35,"target":34,"value":3},
        {"source":35,"target":29,"value":2},
        {"source":36,"target":34,"value":2},
        {"source":36,"target":35,"value":2},
        {"source":36,"target":11,"value":2},
        {"source":36,"target":29,"value":1},
        {"source":37,"target":34,"value":2},
        {"source":37,"target":35,"value":2},
        {"source":37,"target":36,"value":2},
        {"source":37,"target":11,"value":2},
        {"source":37,"target":29,"value":1},
        {"source":38,"target":34,"value":2},
        {"source":38,"target":35,"value":2},
        {"source":38,"target":36,"value":2},
        {"source":38,"target":37,"value":2},
        {"source":38,"target":11,"value":2},
        {"source":38,"target":29,"value":1},
        {"source":39,"target":25,"value":1},
        {"source":40,"target":25,"value":1},
        {"source":41,"target":24,"value":2},
        {"source":41,"target":25,"value":3},
        {"source":42,"target":41,"value":2},
        {"source":42,"target":25,"value":2},
        {"source":42,"target":24,"value":1},
        {"source":43,"target":11,"value":3},
        {"source":43,"target":26,"value":1},
        {"source":43,"target":27,"value":1},
        {"source":44,"target":28,"value":3},
        {"source":44,"target":11,"value":1},
        {"source":45,"target":28,"value":2},
        {"source":47,"target":46,"value":1},
        {"source":48,"target":47,"value":2},
        {"source":48,"target":25,"value":1},
        {"source":48,"target":27,"value":1},
        {"source":48,"target":11,"value":1},
        {"source":49,"target":26,"value":3},
        {"source":49,"target":11,"value":2},
        {"source":50,"target":49,"value":1},
        {"source":50,"target":24,"value":1},
        {"source":51,"target":49,"value":9},
        {"source":51,"target":26,"value":2},
        {"source":51,"target":11,"value":2},
        {"source":52,"target":51,"value":1},
        {"source":52,"target":39,"value":1},
        {"source":53,"target":51,"value":1},
        {"source":54,"target":51,"value":2},
        {"source":54,"target":49,"value":1},
        {"source":54,"target":26,"value":1},
        {"source":55,"target":51,"value":6},
        {"source":55,"target":49,"value":12},
        {"source":55,"target":39,"value":1},
        {"source":55,"target":54,"value":1},
        {"source":55,"target":26,"value":21},
        {"source":55,"target":11,"value":19},
        {"source":55,"target":16,"value":1},
        {"source":55,"target":25,"value":2},
        {"source":55,"target":41,"value":5},
        {"source":55,"target":48,"value":4},
        {"source":56,"target":49,"value":1},
        {"source":56,"target":55,"value":1},
        {"source":57,"target":55,"value":1},
        {"source":57,"target":41,"value":1},
        {"source":57,"target":48,"value":1},
        {"source":58,"target":55,"value":7},
        {"source":58,"target":48,"value":7},
        {"source":58,"target":27,"value":6},
        {"source":58,"target":57,"value":1},
        {"source":58,"target":11,"value":4},
        {"source":59,"target":58,"value":15},
        {"source":59,"target":55,"value":5},
        {"source":59,"target":48,"value":6},
        {"source":59,"target":57,"value":2},
        {"source":60,"target":48,"value":1},
        {"source":60,"target":58,"value":4},
        {"source":60,"target":59,"value":2},
        {"source":61,"target":48,"value":2},
        {"source":61,"target":58,"value":6},
        {"source":61,"target":60,"value":2},
        {"source":61,"target":59,"value":5},
        {"source":61,"target":57,"value":1},
        {"source":61,"target":55,"value":1},
        {"source":62,"target":55,"value":9},
        {"source":62,"target":58,"value":17},
        {"source":62,"target":59,"value":13},
        {"source":62,"target":48,"value":7},
        {"source":62,"target":57,"value":2},
        {"source":62,"target":41,"value":1},
        {"source":62,"target":61,"value":6},
        {"source":62,"target":60,"value":3},
        {"source":63,"target":59,"value":5},
        {"source":63,"target":48,"value":5},
        {"source":63,"target":62,"value":6},
        {"source":63,"target":57,"value":2},
        {"source":63,"target":58,"value":4},
        {"source":63,"target":61,"value":3},
        {"source":63,"target":60,"value":2},
        {"source":63,"target":55,"value":1},
        {"source":64,"target":55,"value":5},
        {"source":64,"target":62,"value":12},
        {"source":64,"target":48,"value":5},
        {"source":64,"target":63,"value":4},
        {"source":64,"target":58,"value":10},
        {"source":64,"target":61,"value":6},
        {"source":64,"target":60,"value":2},
        {"source":64,"target":59,"value":9},
        {"source":64,"target":57,"value":1},
        {"source":64,"target":11,"value":1},
        {"source":65,"target":63,"value":5},
        {"source":65,"target":64,"value":7},
        {"source":65,"target":48,"value":3},
        {"source":65,"target":62,"value":5},
        {"source":65,"target":58,"value":5},
        {"source":65,"target":61,"value":5},
        {"source":65,"target":60,"value":2},
        {"source":65,"target":59,"value":5},
        {"source":65,"target":57,"value":1},
        {"source":65,"target":55,"value":2},
        {"source":66,"target":64,"value":3},
        {"source":66,"target":58,"value":3},
        {"source":66,"target":59,"value":1},
        {"source":66,"target":62,"value":2},
        {"source":66,"target":65,"value":2},
        {"source":66,"target":48,"value":1},
        {"source":66,"target":63,"value":1},
        {"source":66,"target":61,"value":1},
        {"source":66,"target":60,"value":1},
        {"source":67,"target":57,"value":3},
        {"source":68,"target":25,"value":5},
        {"source":68,"target":11,"value":1},
        {"source":68,"target":24,"value":1},
        {"source":68,"target":27,"value":1},
        {"source":68,"target":48,"value":1},
        {"source":68,"target":41,"value":1},
        {"source":69,"target":25,"value":6},
        {"source":69,"target":68,"value":6},
        {"source":69,"target":11,"value":1},
        {"source":69,"target":24,"value":1},
        {"source":69,"target":27,"value":2},
        {"source":69,"target":48,"value":1},
        {"source":69,"target":41,"value":1},
        {"source":70,"target":25,"value":4},
        {"source":70,"target":69,"value":4},
        {"source":70,"target":68,"value":4},
        {"source":70,"target":11,"value":1},
        {"source":70,"target":24,"value":1},
        {"source":70,"target":27,"value":1},
        {"source":70,"target":41,"value":1},
        {"source":70,"target":58,"value":1},
        {"source":71,"target":27,"value":1},
        {"source":71,"target":69,"value":2},
        {"source":71,"target":68,"value":2},
        {"source":71,"target":70,"value":2},
        {"source":71,"target":11,"value":1},
        {"source":71,"target":48,"value":1},
        {"source":71,"target":41,"value":1},
        {"source":71,"target":25,"value":1},
        {"source":72,"target":26,"value":2},
        {"source":72,"target":27,"value":1},
        {"source":72,"target":11,"value":1},
        {"source":73,"target":48,"value":2},
        {"source":74,"target":48,"value":2},
        {"source":74,"target":73,"value":3},
        {"source":75,"target":69,"value":3},
        {"source":75,"target":68,"value":3},
        {"source":75,"target":25,"value":3},
        {"source":75,"target":48,"value":1},
        {"source":75,"target":41,"value":1},
        {"source":75,"target":70,"value":1},
        {"source":75,"target":71,"value":1},
        {"source":76,"target":64,"value":1},
        {"source":76,"target":65,"value":1},
        {"source":76,"target":66,"value":1},
        {"source":76,"target":63,"value":1},
        {"source":76,"target":62,"value":1},
        {"source":76,"target":48,"value":1},
        {"source":76,"target":58,"value":1}
      ]
    }';
});

// POST route
$app->post('/post', function () {
    echo 'This is a POST route';
});

// PUT route
$app->put('/put', function () {
    echo 'This is a PUT route';
});

// DELETE route
$app->delete('/delete', function () {
    echo 'This is a DELETE route';
});

/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();
