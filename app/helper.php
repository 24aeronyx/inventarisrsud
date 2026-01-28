<?php
function sortUrl($col, $sort, $direction)
{
    $newDirection = ($sort === $col && $direction === 'asc') ? 'desc' : 'asc';
    return request()->fullUrlWithQuery(['sort' => $col, 'direction' => $newDirection]);
}
