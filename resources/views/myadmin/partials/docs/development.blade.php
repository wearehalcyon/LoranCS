<?php
    $red = '#c74c4c';
    $green = '#6ea228';
    $orange = '#bf9840';
?>

<h2>Theme Development</h2>
<p>This is main theme development documentation.</p>
<!-- -->
<h3>Core</h3>
<span>This is Core function can be used in any theme or plugin template.</span>
<code>
    <strong>Core::METHODNAME()</strong>
</code>

<!-- -->
<h3>Methods</h3>
<span>Methods - this is Core class public/static functions.</span>
<pre>
    <strong style="color: {{ $red }};">public static function</strong> <strong style="color: {{ $green }};">myMethod</strong>(){
        <strong style="color: {{ $red }};">echo true;</strong>
    }
</pre>
<p>Than in template you can use it as:</p>
<code>
    <strong>Core::myMethod();</strong> <span>// as native PHP or Laravel Blade. But we recommend to use Laravel Blade.</span>
</code>
<br>
<br>
<br>
<h2>Get Started</h2>
<p>Let's start to work with all Core methods</p>
