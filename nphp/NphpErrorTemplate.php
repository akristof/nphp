<?php

/*
 * This file is part of the nphp package.
*
* (c) Aleš Krištof <ales.kristof@gmail.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>nphp error: <?= $message ?></title>
        <style type="text/css">

            *, body, html {
                margin: 0;
                padding: 0;
                border: 0;
                font-size: 13px;
                font-family: Verdana, Helvetica, Arial, sans-serif;
                color: #000;
            }

            body {
                background-color: #ddd;
            }

            #content {
                margin: 20px;
                background-color: white;
                padding: 20px;
                border: 1px solid #999;
                overflow: auto;
                min-width: 800px;
            }

            #above, #above strong {
                font-size: 10px;
                color: #999;
            }

            h1 {
                font-size: 25px;
                font-weight: bold;
                margin: 0 0 20px;
            }

            h2 {
                font-size: 20px;
                font-weight: bold;
                margin: 10px 0;
            }

            ul {
                list-style: none;
            }

            .hidden {
                display: none;
            }

            #info li span {
                display: inline-block;
                width: 200px;
                text-align: right;
                color: #999;
                line-height: 25px;
            }

            pre, pre code {
                color: #eee;
            }

            pre code {
                word-wrap: normal;
            }

            #traceback {
                list-style: none;
                display: block;
                margin-bottom: 20px;
            }

                #traceback li {
                    display: block;
                    margin: 15px;
                }

                #traceback li .filename {
                    display: block;
                    margin-bottom: 10px;
                }

            p.disclaimer {
                font-size: 10px;
                color: #999;
                text-align: center;
                padding: 5px;
            }

            p.disclaimer span {
                font-size: 10px;
                color: #666;
            }

            /**
             * Tomorrow Night theme
             *
             * @author Chris Kempson
             * @author skim
             * @version 1.0.0
             */
            pre {
                background-color: #1d1f21;
                word-wrap: break-word;
                margin: 0px;
                padding: 0 10px;
                color: #c5c8c6;
                font-size: 14px;
                margin-bottom: 20px;
            }

            pre, code {
                font-family: 'Monaco', courier, monospace;
            }

            pre .comment {
                color: #969896;
            }

            pre .variable.global, pre .variable.class, pre .variable.instance {
                color: #cc6666; /* red */
            }

            pre .constant.numeric, pre .constant.language, pre .constant.hex-color, pre .keyword.unit {
                color: #de935f; /* orange */
            }

            pre .constant, pre .entity, pre .entity.class, pre .support {
                color: #f0c674; /* yellow */
            }

            pre .constant.symbol, pre .string {
                color: #b5bd68; /* green */
            }

            pre .entity.function, pre .support.css-property, pre .selector {
                color: #81a2be; /* blue */
            }

            pre .keyword, pre .storage {
                color: #b294bb; /* purple */
            }

            /* theme overrides */

            pre {
                padding-top: 0;
                padding-bottom: 0;
                cursor: default;
                color: #efefef;
                margin: 0;
            }

            pre, code, pre code span {
                font-family: 'Consolas', 'Monaco', courier, monospace;
                color: #efefef;
            }

            pre.highlight {
                background-color: #323538;
            }

            pre.traceback_code:hover, pre.extended_code:hover {
                cursor: pointer;
            }

            pre.spacing {
                padding-top: 10px;
                padding-bottom: 10px;
            }

            pre.spacing_top {
                padding-top: 10px;
            }

            pre.spacing_bottom {
                padding-bottom: 10px;
            }

            a {
                color: #999;
                display: block;
                margin-bottom: 10px;
                padding: 3px;
                padding-left: 20px;
            }

            a:hover {
                color: #000;
                background-color: #eee;
            }

            div.hidden_info div {
                margin: 0 20px;
            }

            table {
                text-align: left;
                border: 1px solid #999;
            }

            table td, table th {
                padding: 2px 5px;
                /*background-color: #efefef;*/
                border-top: 1px solid #999;
                margin: 0;
            }

            table th {
                border: 0;
                background-color: #efefef;
            }

        </style>
        <script type= "text/javascript">
            <!--

                /* Rainbow v1.1.8 rainbowco.de | included languages: generic, php */
                window.Rainbow=function(){function q(a){var b,c=a.getAttribute&&a.getAttribute("data-language")||0;if(!c){a=a.attributes;for(b=0;b<a.length;++b)if("data-language"===a[b].nodeName)return a[b].nodeValue}return c}function B(a){var b=q(a)||q(a.parentNode);if(!b){var c=/\blang(?:uage)?-(\w+)/;(a=a.className.match(c)||a.parentNode.className.match(c))&&(b=a[1])}return b}function C(a,b){for(var c in e[d]){c=parseInt(c,10);if(a==c&&b==e[d][c]?0:a<=c&&b>=e[d][c])delete e[d][c],delete j[d][c];if(a>=c&&a<e[d][c]||
                b>c&&b<e[d][c])return!0}return!1}function r(a,b){return'<span class="'+a.replace(/\./g," ")+(l?" "+l:"")+'">'+b+"</span>"}function s(a,b,c,h){var f=a.exec(c);if(f){++t;!b.name&&"string"==typeof b.matches[0]&&(b.name=b.matches[0],delete b.matches[0]);var k=f[0],i=f.index,u=f[0].length+i,g=function(){function f(){s(a,b,c,h)}t%100>0?f():setTimeout(f,0)};if(C(i,u))g();else{var m=v(b.matches),l=function(a,c,h){if(a>=c.length)h(k);else{var d=f[c[a]];if(d){var e=b.matches[c[a]],i=e.language,g=e.name&&e.matches?
                e.matches:e,j=function(b,d,e){var i;i=0;var g;for(g=1;g<c[a];++g)f[g]&&(i=i+f[g].length);d=e?r(e,d):d;k=k.substr(0,i)+k.substr(i).replace(b,d);l(++a,c,h)};i?n(d,i,function(a){j(d,a)}):typeof e==="string"?j(d,d,e):w(d,g.length?g:[g],function(a){j(d,a,e.matches?e.name:0)})}else l(++a,c,h)}};l(0,m,function(a){b.name&&(a=r(b.name,a));if(!j[d]){j[d]={};e[d]={}}j[d][i]={replace:f[0],"with":a};e[d][i]=u;g()})}}else h()}function v(a){var b=[],c;for(c in a)a.hasOwnProperty(c)&&b.push(c);return b.sort(function(a,
                b){return b-a})}function w(a,b,c){function h(b,k){k<b.length?s(b[k].pattern,b[k],a,function(){h(b,++k)}):D(a,function(a){delete j[d];delete e[d];--d;c(a)})}++d;h(b,0)}function D(a,b){function c(a,b,h,e){if(h<b.length){++x;var g=b[h],l=j[d][g],a=a.substr(0,g)+a.substr(g).replace(l.replace,l["with"]),g=function(){c(a,b,++h,e)};0<x%250?g():setTimeout(g,0)}else e(a)}var h=v(j[d]);c(a,h,0,b)}function n(a,b,c){var d=m[b]||[],f=m[y]||[],b=z[b]?d:d.concat(f);w(a.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/&(?![\w\#]+;)/g,
                "&amp;"),b,c)}function o(a,b,c){if(b<a.length){var d=a[b],f=B(d);return!(-1<(" "+d.className+" ").indexOf(" rainbow "))&&f?(f=f.toLowerCase(),d.className+=d.className?" rainbow":"rainbow",n(d.innerHTML,f,function(k){d.innerHTML=k;j={};e={};p&&p(d,f);setTimeout(function(){o(a,++b,c)},0)})):o(a,++b,c)}c&&c()}function A(a,b){var a=a&&"function"==typeof a.getElementsByTagName?a:document,c=a.getElementsByTagName("pre"),d=a.getElementsByTagName("code"),f,e=[];for(f=0;f<d.length;++f)e.push(d[f]);for(f=0;f<
                c.length;++f)c[f].getElementsByTagName("code").length||e.push(c[f]);o(e,0,b)}var j={},e={},m={},z={},d=0,y=0,t=0,x=0,l,p;return{extend:function(a,b,c){1==arguments.length&&(b=a,a=y);z[a]=c;m[a]=b.concat(m[a]||[])},b:function(a){p=a},a:function(a){l=a},color:function(a,b,c){if("string"==typeof a)return n(a,b,c);if("function"==typeof a)return A(0,a);A(a,b)}}}();window.addEventListener?window.addEventListener("load",Rainbow.color,!1):window.attachEvent("onload",Rainbow.color);Rainbow.onHighlight=Rainbow.b;
                Rainbow.addClass=Rainbow.a;Rainbow.extend([{matches:{1:{name:"keyword.operator",pattern:/\=/g},2:{name:"string",matches:{name:"constant.character.escape",pattern:/\\('|"){1}/g}}},pattern:/(\(|\s|\[|\=|:)(('|")([^\\\1]|\\.)*?(\3))/gm},{name:"comment",pattern:/\/\*[\s\S]*?\*\/|(\/\/|\#)[\s\S]*?$/gm},{name:"constant.numeric",pattern:/\b(\d+(\.\d+)?(e(\+|\-)?\d+)?(f|d)?|0x[\da-f]+)\b/gi},{matches:{1:"keyword"},pattern:/\b(and|array|as|bool(ean)?|c(atch|har|lass|onst)|d(ef|elete|o(uble)?)|e(cho|lse(if)?|xit|xtends|xcept)|f(inally|loat|or(each)?|unction)|global|if|import|int(eger)?|long|new|object|or|pr(int|ivate|otected)|public|return|self|st(ring|ruct|atic)|switch|th(en|is|row)|try|(un)?signed|var|void|while)(?=\(|\b)/gi},
                {name:"constant.language",pattern:/true|false|null/g},{name:"keyword.operator",pattern:/\+|\!|\-|&(gt|lt|amp);|\||\*|\=/g},{matches:{1:"function.call"},pattern:/(\w+?)(?=\()/g},{matches:{1:"storage.function",2:"entity.name.function"},pattern:/(function)\s(.*?)(?=\()/g}]);Rainbow.extend("php",[{name:"support",pattern:/\becho\b/g},{matches:{1:"variable.dollar-sign",2:"variable"},pattern:/(\$)(\w+)\b/g},{name:"constant.language",pattern:/true|false|null/ig},{name:"constant",pattern:/\b[A-Z0-9_]{2,}\b/g},{name:"keyword.dot",pattern:/\./g},{name:"keyword",pattern:/\b(continue|break|die|end(for(each)?|switch|if)|case|require(_once)?|include(_once)?)(?=\(|\b)/g},{matches:{1:"keyword",2:{name:"support.class",pattern:/\w+/g}},pattern:/(instanceof)\s([^\$].*?)(\)|;)/g},{matches:{1:"support.function"},
                pattern:/\b(array(_key_exists|_merge|_keys|_shift)?|isset|count|empty|unset|printf|is_(array|string|numeric|object)|sprintf|each|date|time|substr|pos|str(len|pos|tolower|_replace|totime)?|ord|trim|in_array|implode|end|preg_match|explode|fmod|define|link|list|get_class|serialize|file|sort|mail|dir|idate|log|intval|header|chr|function_exists|dirname|preg_replace|file_exists)(?=\()/g},{name:"variable.language.php-tag",pattern:/(&lt;\?(php)?|\?&gt;)/g},{matches:{1:"keyword.namespace",2:{name:"support.namespace",
                pattern:/\w+/g}},pattern:/\b(namespace)\s(.*?);/g},{matches:{1:"storage.modifier",2:"storage.class",3:"entity.name.class",4:"storage.modifier.extends",5:"entity.other.inherited-class"},pattern:/\b(abstract|final)?\s?(class)\s(\w+)(\sextends\s)?([\w\\]*)?\s?\{?(\n|\})/g},{name:"keyword.static",pattern:/self::|static::/g},{matches:{1:"storage.function",2:"support.magic"},pattern:/(function)\s(__.*?)(?=\()/g},{matches:{1:"keyword.new",2:{name:"support.class",pattern:/\w+/g}},pattern:/\b(new)\s([^\$].*?)(?=\)|\(|;)/g},
                {matches:{1:{name:"support.class",pattern:/\w+/g},2:"keyword.static"},pattern:/([\w\\]*?)(::)(?=\b|\$)/g},{matches:{2:{name:"support.class",pattern:/\w+/g}},pattern:/(\(|,\s?)([\w\\]*?)(?=\s\$)/g}]);


                window.onload = function() {

                    var show_code = function() {
                        var code = this.parentNode.getElementsByClassName("traceback_code");
                        if (code[0].className === "traceback_code spacing") {
                            code[0].className = "traceback_code highlight";
                        } else {
                        	code[0].className = "traceback_code spacing";
                        }
                        var hidden = this.parentNode.getElementsByClassName("extended_code");
                        for (var j = 0; j <= hidden.length-1; j++) {
                            if (hidden[j].className === "extended_code hidden spacing_bottom") {
                                hidden[j].className = "extended_code spacing_bottom";
                            } else if (hidden[j].className === "extended_code hidden spacing_top") {
                                hidden[j].className = "extended_code spacing_top";
                            } else if (hidden[j].className === "extended_code spacing_bottom") {
                                hidden[j].className = "extended_code hidden spacing_bottom";
                            } else if (hidden[j].className === "extended_code spacing_top") {
                                hidden[j].className = "extended_code hidden spacing_top";
                            }
                        }
                    }

                    // show/hide traceback code
                    var traceback_code = document.getElementsByClassName("traceback_code");
                    for (var i = 0; i <= traceback_code.length-1; i++) {
                        traceback_code[i].onclick = show_code;
                    }
                    var extended_code = document.getElementsByClassName("extended_code");
                    for (var i = 0; i <= extended_code.length-1; i++) {
                    	extended_code[i].onclick = show_code;
                    }

                    // show/hide variables, info, ...
                    var hidden_info = document.getElementsByClassName("hidden_info");
                    for (var i = 0; i <= hidden_info.length-1; i++) {
                    	hidden_info[i].getElementsByTagName("a")[0].nextSibling.nextSibling.style.display = "none";
                    	hidden_info[i].getElementsByTagName("a")[0].onclick = function() {
                            if (this.nextSibling.nextSibling.style.display === "none") {
                                this.nextSibling.nextSibling.style.display = "block";
                                this.innerHTML = "hide";
                            } else {
                            	this.nextSibling.nextSibling.style.display = "none";
                            	this.innerHTML = "show";
                            }
                            return false;
                    	}
                    }

                }
            -->
        </script>
    </head>
    <body>
        <div id="content">
            <p id="above"><strong>nphp</strong> error:</p>
            <h1><?= $message ?><?php if ($code) { echo $code; } ?> (<?= $type ?>)</h1>

            <ul id="info">
                <li><span>Request method:</span> <?= $method ?></li>
                <li><span>Request URL:</span> <?= $url ?></li>
                <li><span>Exception type:</span> <?= $type ?></li>
                <li><span>Exception message:</span> <?= $message ?></li>
                <?php if ($code): ?><li><span>Exception code:</span> <?= $code ?></li><?php endif; ?>
                <li><span>Exception location:</span> <?= $file ?> (line <?= $line ?>)</li>
                <li><span>PHP version:</span> <?= $php ?></li>
                <li><span>Server time:</span> <?= date("r"); ?></li>
            </ul>

            <h2>Traceback:</h2>
            <ul id="traceback">
            <?php

            function get_source($file, $line) {
                $lines_before = Array();
                $lines_after = Array();
                $main_line = "";
                $source_file = file($file);
                $start = $line - 6;
                $end = $line + 6;
                if ($start < 0) {
                    $start = 0;
                }
                if ($end > sizeof($source_file)) {
                    $end = sizeof($source_file);
                }

                for ($i = $start; $i <= $end; $i++) {
                    if ($i < $line) {
                        $lines_before[] = Array($i, htmlspecialchars($source_file[$i-1]));
                    } elseif ($i == $line) {
                        $main_line = htmlspecialchars($source_file[$i-1]);
                    } else {
                        $lines_after[] = Array($i, htmlspecialchars($source_file[$i-1]));
                    }
                }
                return Array($main_line, $lines_before, $lines_after);
            }

            function line_number_pad($number) {
                $number = $number.".";
                $number = str_pad($number, 7, " ", STR_PAD_RIGHT);
                //$number = str_replace(" ", "&nbsp;", $number);
                return $number;
            }

            $file = "";
            $line_nr = 0;
            foreach ($trace as $line) {
                if ($line['function'] == "php_error_handler") {
                    if (array_key_exists("line", $line)) {
                        $line_nr = $line['line'];
                    }
                    if (array_key_exists("file", $line)) {
                        $file = $line['file'];
                    }
                    continue;
                }
                if (array_key_exists("line", $line)) {
                    $line_nr = $line['line'];
                }
                if (array_key_exists("file", $line)) {
                    $file = $line['file'];
                }
                if (array_key_exists("class", $line)) {
                    $in = "{$line['class']}::{$line['function']}()";
                } else {
                    $in = "{$line['function']}()";
                }
                $source = get_source($file, (int) $line_nr);
                echo "<li>\n<span class=\"filename\">{$file} in {$in}</span>\n";
                echo "<pre class=\"extended_code hidden spacing_top\"><code data-language=\"php\">";
                foreach ($source[1] as $line) {
                    echo line_number_pad($line[0]).$line[1];
                }
                echo "</code></pre>";
                echo "<pre class=\"traceback_code spacing\"><code data-language=\"php\">".line_number_pad($line_nr).$source[0]."</code></pre>";
                echo "<pre class=\"extended_code hidden spacing_bottom\"><code data-language=\"php\">";
                foreach ($source[2] as $line) {
                    echo line_number_pad($line[0]).$line[1];
                }
                echo "</code></pre>\n</li>";
            }

            ?>
            </ul>

            <h2>Request object</h2>
            <div class="hidden_info">
                <a href="#">show</a>
                <div id="vars" class="hidden">
                    <pre><code data-language="php">
<?php print_r($request); ?>
                    </code></pre>
                </div>
            </div>

            <h2>Variables</h2>
            <div class="hidden_info">
                <a href="#">show</a>
                <div id="vars" class="hidden">
                    <pre><code data-language="php">
<?php foreach ($vars as $var => $val) {
    echo "{$var} = ";
    print_r($val);
    echo "\n";
} ?>
                    </code></pre>
                </div>
            </div>

            <h2>Loaded extensions</h2>
            <div class="hidden_info">
                <a href="#">show</a>
                <div class="hidden">
                    <?= implode(", ", $extensions) ?>
                </div>
            </div>

            <h2>PHP info</h2>
            <div class="hidden_info">
                <a href="#">show</a>
                <table cellspacing="0" cellpadding="0" id="phpinfo" class="hidden">
                    <tr>
                        <th>Setting</th>
                        <th>Global value</th>
                        <th>Local value</th>
                        <th>Access</th>
                    </tr>
                <?php foreach ($phpini as $ini => $settings): ?>
                    <tr>
                        <td><?= $ini ?></td>
                        <?php foreach ($settings as $name => $setting): ?>
                        <td><?= $setting ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
                </table>
            </div>

            <p class="disclaimer">You're seeing this because you have <span>"debug"</span> setting in your Nphp_Application object set to <span>TRUE</span>.</p>
        </div>
    </body>
</html>