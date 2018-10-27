<?php 

namespace LMailTemplate;

use LMailTemplate\Traits\LReplaceBindsTrait;
use LMailTemplate\Traits\LHtmlTrait;
use LMailTemplate\Traits\LParserTrait;
use LMailTemplate\Traits\LRenderTrait;

class LMailTable {

    use LReplaceBindsTrait;
    use LHtmlTrait;
    use LParserTrait;
    use LRenderTrait;

    protected $options;

    public function __construct()
    {
        $this->resetOptions();
        $this->resetHtml();
    }

    public function resetOptions(){
        $this->options = [];
    }

    public function addOptions( $options )
    {
        $this->options = array_merge( $this->options, $options);
    }

    public function addRow( $options, $html = '&nbsp;' )
    {
        if (!isset($options['html'])){
            $options['html'] = $html;
        }
        $this->addColumns([
            $options
        ]);

        return $this;
    }

    public function addColumns( $columns ){

        $defaultOptions = [
            'html' => '&nbsp;',
        ];

        $this->addHtml('<tr>');
        foreach ($columns as $col ) {
            $this->addHtml( $this->renderElement('td', 'parseTableDataOption', $col, $defaultOptions) );
        }
        $this->addHtml('</tr>');

        return $this;
    }

    public function render()
    {
        $this->options['html'] = $this->html;
        $defaultOptions = [
            'cellpadding' => 0,
            'cellspacing' => 0,
            'width' => '100%'
        ];
        return $this->renderElement('table', 'parseTableOption', $this->options, $defaultOptions );
    }

}