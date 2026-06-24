<?php
function renderSectionHeader(string $subtitle, string $title, string $extraClass = ''): string
{
    $titleClass = 'section-title' . ($extraClass ? ' ' . $extraClass : '');
    $lineClass  = 'section-line'  . ($extraClass ? ' ' . str_replace('text-white', 'bg-white', $extraClass) : '');

    return '<div class="section-header text-center reveal">'
         . '<span class="section-subtitle">' . htmlspecialchars($subtitle) . '</span>'
         . '<h2 class="' . $titleClass . '">' . htmlspecialchars($title) . '</h2>'
         . '<div class="' . $lineClass . '"></div>'
         . '</div>';
}
