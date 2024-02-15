<?php
namespace Oyster\Render;

require_once __DIR__ . '/../../support/lib/vendor/autoload.php';

use \Approach\Render\HTML;
use \Approach\Render\Node;
use \Approach\Render\Stream;
use \Approach\Render\Attribute;
use \Stringable;

/* 
 * Oyster
 *
 * The Oyster is the sole representation of the Oyster Menu. It is responsible for holding and rendering the header, pearls, and shell
 * It is a subclass of the HTML class and has various checks and so for the content and classes
 *
 * ## Explanation
 *
 * - Header: The header is the top section of the Oyster and is used to hold the dynamic pearl menu and the signout button
 * - Pearl: A Pearl is a self expanding list item that can be used to create a visual representation of a list in a Oyster
 * - Shell: The shell is the toolbar that holds the pearls
 *
 * The Oyster Menu is expandable while providing all the necessary integrity checks.
 * 
 * @see Header
 * @see Pearl
 * @see HTML
 *
 * @param Header|null $header - the header of the oyster
 * @param Pearl|null $pearls - the pearls of the oyster
 *
 * @param string|null $id - the id of the oyster
 * @param string|array|Node|Attribute|null $classes - the classes of the oyster
 * @param array|Attribute|null $attributes - the attributes of the oyster
 * @param string|Stringable|Stream|null $content - the content of the oyster
 * @param array $styles - the styles of the oyster
 * @param bool $prerender - whether or not to prerender the oyster
 * @param bool $selfContained - whether or not the oyster is self contained
 *
 *
 * @return Oyster
 * */
class Oyster extends HTML{
    public ?Header $header;
    public ?Pearl $pearls;
    public HTML $shell;
    
    public function __construct(
        null|Header $header = null,
        null|Pearl $pearls = null,

        public null|string|Stringable $id = null,
        null|string|array|Node|Attribute $classes = null,
        public null|array|Attribute $attributes = new Attribute,
        public null|string|Stringable|Stream|self $content = null,
        public array $styles = [],
        public bool $prerender = false,
        public bool $selfContained = false,
    ){
        $header = $header ?? new Header;  // uses default constructor, if these have required args fill them
        $pearls = $pearls ?? new Pearl;   // uses default constructor, if these have required args fill them

        if($classes === null){
            $classes = [];
        }

        parent::__construct(
            tag: 'div',
            id: $id,
            classes: (array)$classes,
            styles: $styles,
            prerender: $prerender,
            selfContained: $selfContained
        );

        // Add header to the Oyster 
        $this->nodes[] = $header;
        $this->header = &$this->nodes[0];

        // Add shell to the Oyster 
        $shell = new HTML(tag: 'ul', classes: ['Shell ', 'Toolbar']);
        $this->header->nodes[] = $shell;
        $this->shell = &$this->header->nodes[0];

        // Add pearls to the shell
        $index = count($this->shell); 
        foreach($pearls as $pearl){ 
            $this->shell[] = $pearl;
            $this->pearls[ $pearl->label ] = $this->shell->nodes[$index];
            $index++;
        }        
    }
} 
