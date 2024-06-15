<?php

namespace Oyster;

use \Approach\Render\HTML;
use \Oyster\Render\Header;
use \Oyster\Render\Oyster;
use \Oyster\Render\Pearl;
use \Oyster\Render\Visual;
use \Oyster\Render\Attribute;

require_once __DIR__ . '/support/lib/vendor/autoload.php';
require_once __DIR__ . '/layout.php';
require_once __DIR__ . '/head.php';

function createVisualsAndPearls($array, $pearl) {
    $visual = [];
    $pearls = [];

    foreach($dict as $key => $value) {
        $visuals[] = new Visual(title: $key);

        if (is_array($value)) {
            foreach ($value as $item) {
                if (is_array($item)) {
                    $result = createVisualsAndPearls($item, $pearl);
                    $visuals = array_merge($visuals, $result['visuals']);
                    $pearls = array_merge($pearls, $result['pearls']);
                } else {
                    $visuals[] = new Visual(title: $item);
                }
            }
        } else {
            $pearls[] = $pearl;
        }
    }

    return ['visuals' => $visuals, 'pearls' => $pearls];
}

global $body;

// Create the main stage container
$body[] = $stage = new HTML(tag: 'div', classes: ['Stage']);

// Create header with breadcrumbs
$newHeader = new Header(crumbs: ['Home', 'About', 'Contact']);

// Create Visual objects
$visualProcedures = new Visual(title: 'Procedures');
$visualCorporateOffices = new Visual(title: 'Corporate Offices');
$visualTexas = new Visual(title: 'Texas');
$visualNewJersey = new Visual(title: 'New Jersey');
$visualNewYork = new Visual(title: 'New York');
$visualEmployeeManagement = new Visual(title: 'Employee Management');
$visualChild1 = new Visual(title: 'Child Item Name 1');
$visualChild2 = new Visual(title: 'Child Item Name 2');
$visualChild3 = new Visual(title: 'Child Item Name 3');
$visualIncidentReports = new Visual(title: 'Incident Reports');
$visualReport1 = new Visual(title: 'Report 1');
$visualReport2 = new Visual(title: 'Report 2');
$visualReport3 = new Visual(title: 'Report 3');
$visualReport4 = new Visual(title: 'Report 4');

// Create pearls for the structure
$pearlTexas = new Pearl(
    visual: $visualTexas,
    label: 'Texas',
    attributes:[
        'class' => 'control',
        'data-api' => '/server.php',
        'data-api-method' => 'POST',
        'data-intent' => '{ "REFRESH": { "Climb" : "Issues" } }',
        'data-context' => '{ "_response_target": "#some_content > div", "climb_id": "31", "owner": "newtoallofthis123", "repo": "test_for_issues"}'
    ]
);

$pearlNewJersey = new Pearl(
    visual: $visualNewJersey,
    label: 'New Jersey',
    attributes:[
        'class' => 'control',
        'data-api' => '/server.php',
        'data-api-method' => 'POST',
        'data-intent' => '{ "REFRESH": { "Climb" : "Issues" } }',
        'data-context' => '{ "_response_target": "#some_content > div", "climb_id": "32", "owner": "newtoallofthis123", "repo": "test_for_issues"}'
    ]
);

$pearlNewYork = new Pearl(
    visual: $visualNewYork,
    label: 'New York',
    attributes:[
        'class' => 'control',
        'data-api' => '/server.php',
        'data-api-method' => 'POST',
        'data-intent' => '{ "REFRESH": { "Climb" : "View" } }',
        'data-context' => '{ "_response_target": "#some_content > div", "climb_id": "millionaire"}'
    ]
);

$pearlCorporateOffices = new Pearl(
    visual: $visualCorporateOffices,
    label: 'Corporate Offices',
    children: [$pearlTexas, $pearlNewJersey, $pearlNewYork]
);

$pearlChild1 = new Pearl(visual: $visualChild1, label: 'Child Item Name 1');
$pearlChild2 = new Pearl(visual: $visualChild2, label: 'Child Item Name 2');
$pearlChild3 = new Pearl(visual: $visualChild3, label: 'Child Item Name 3');

$pearlEmployeeManagement = new Pearl(
    visual: $visualEmployeeManagement,
    label: 'Employee Management',
    children: [$pearlChild1, $pearlChild2, $pearlChild3]
);

$pearlProcedures = new Pearl(
    visual: $visualProcedures,
    label: 'Procedures',
    children: [$pearlCorporateOffices, $pearlEmployeeManagement]
);

$pearlReport1 = new Pearl(visual: $visualReport1, label: 'Report 1');
$pearlReport2 = new Pearl(
    visual: $visualReport2,
    label: 'Report 2',
    children: [$pearlChild1, $pearlChild2, $pearlChild3]
);
$pearlReport3 = new Pearl(visual: $visualReport3, label: 'Report 3');
$pearlReport4 = new Pearl(
    visual: $visualReport4,
    label: 'Report 4',
    children: [$pearlChild1, $pearlChild2, $pearlChild3]
);

$pearlIncidentReports = new Pearl(
    visual: $visualIncidentReports,
    label: 'Incident Reports',
    children: [$pearlReport1, $pearlReport2, $pearlReport3, $pearlReport4]
);

// Create the oyster
$oyster = new Oyster(
    header: $newHeader,
    pearls: [$pearlProcedures, $pearlIncidentReports]
);

// Add the oyster to the stage
$stage[] = $oyster;

// Add the Viewport
$viewport = new HTML(tag: 'div', attributes: ['class' => 'Viewport']);
$someContent = new HTML(tag: 'div', attributes: ['id' => 'some_content']);
$someContentInner = new HTML(tag: 'div');
$someContent[] = $someContentInner;
$viewport[] = $someContent;

$result = new HTML(tag: 'div', attributes: ['id' => 'result']);
$viewport[] = $result;

// Add the viewport to the main structure
$oyster[] = $viewport;

// Complete the stage and body
$stage[] = $oyster;
$body[] = $stage;

// Render the webpage
echo $webpage->render();
