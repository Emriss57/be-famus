<?php

echo '<style>table,th,td{border:1px solid;border-collapse: collapse;padding: 5px;}</style>';
echo '<table>';
echo '<tr>';
echo "<th>Methods</th><th>Paths</th><th>Names</th>";
echo '</tr>';
foreach ($this->ctx['global']->getRoutes() as $route) {
    echo '<tr>';
    echo "<td>{$route[0]}</td><td>{$route[1]}</td><td>{$route[3]}</td>";
    echo '</tr>';
}
echo '</table>';
