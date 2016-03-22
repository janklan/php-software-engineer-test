<?php

echo '<ul style="width:600px;margin:20px auto;padding:5px;list-style-type:none">';
foreach (glob('*.php') as $file) {
    echo '<li><a href="'.basename($file).'">'.$file.'</a></li>';
}
echo '</ul>';

echo '<hr>';

show_source(__FILE__);

echo '<hr>';

phpinfo();

