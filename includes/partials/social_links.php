<?php
function renderSocialLinks(array $links, string $cssClass = 'social-link'): string
{
    $html = '';
    foreach ($links as $link) {
        $target = $link['target'] ? ' target="' . $link['target'] . '"' : '';
        $html .= '<a href="' . htmlspecialchars($link['url']) . '" class="' . $cssClass . '"' . $target . '>'
               . '<i class="' . htmlspecialchars($link['icon']) . '"></i></a>' . "\n";
    }
    return $html;
}
