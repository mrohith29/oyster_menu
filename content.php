<?php

global $body;

require_once __DIR__ . '/support/lib/vendor/autoload.php';

require_once __DIR__ . '/layout.php';
require_once __DIR__ . '/head.php';

use \Approach\Render\HTML;

$body[] = new HTML(tag: 'div');
$stage[] = new HTML(tag:'div',attributes: ['class' => 'Stage']);
$oyster[] = new HTML(tag: 'div', attributes: ['class' => 'Oyster Interface controls animate__animated animate__fadeIn']);
$header[] = new HTML(tag: 'section', attributes: ['class' => 'header']);
$bckBtn[] = new HTML(tag: 'button', attributes: ['class' => 'backBtn']);
$expand = new HTML(tag: 'i', attributes: ['class' => 'fa fa-caret-down']);
$bckBtn[] = $expand;
$header[] = $bckBtn;
$menuButton[] = new HTML(tag: 'button', attributes: ['class' => 'btn btn-secondary current-state ms-2 animate__animated animate__slideInDown', 'id' => 'menuButton']);
$menuButtonText = new HTML(tag: 'span', attributes: ['id' => 'menuButtonText'], content: 'Location');
$menuButton[] = $menuButtonText;
$fa = new HTML(tag:'i', attributes: ['class' => 'fa fa-caret-down']);
$menuButton[] = $fa;
$header[] = $menuButton;
$breadCrumbs = new HTML(tag: 'ul', attributes: ['class' => 'breadcrumbs', 'style' => 'display: none']);
$header[] = $breadCrumbs;

$oyster[] = $header;