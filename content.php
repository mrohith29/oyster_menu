<?php

global $body;

require_once __DIR__ . '/support/lib/vendor/autoload.php';

require_once __DIR__ . '/layout.php';
require_once __DIR__ . '/head.php';

use \Approach\Render\HTML;

$body->content[] = new HTML(tag: 'div', attributes: ['class' => 'Stage']);
$body->content[] = new HTML(tag: 'div', attributes: ['id' => 'main', 'class' => 'Screen']);
$body->content[] = new HTML(tag: 'div', attributes: ['class' => 'Oyster Interface controls animate__animated animate__fadeIn']);
$body->content[] = new HTML(tag: 'section', attributes: ['class' => 'header']);
$body->content[] = new HTML(tag: 'button', attributes: ['class' => 'backBtn']);
$body->content[] = new HTML(tag: 'i', attributes: ['class' => 'expand fa fa-angle-left']);
$body->content[] = new HTML(tag: 'button', attributes: ['class' => 'btn btn-secondary current-state ms-2 animate__animated animate__slideInDown', 'id' => 'menuButton']);
$body->content[] = new HTML(tag: 'span', attributes: ['id' => 'menuButtonText'], content: 'Location');
$body->content[] = new HTML(tag: 'i', attributes: ['class' => 'fa fa-caret-down']);
$body->content[] = new HTML(tag: 'ul', attributes: ['class' => 'breadcrumbs', 'style' => 'display: none']);
$body->content[] = new HTML(tag: 'ul', attributes: ['class' => 'Toolbar']);
$body->content[] = new HTML(tag: 'div', attributes: ['class' => 'signOut']);

