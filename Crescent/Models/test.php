<?php

declare(strict_types=1);

require_once dirname(__FILE__) . '/News.php';

echo '<pre>';
print_r((new News())->all());
echo '</pre>';