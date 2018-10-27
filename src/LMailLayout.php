<?php 

namespace LMailTemplate;

use LMailTemplate\Traits\LBindsTrait;
use LMailTemplate\Traits\LReplaceBindsTrait;
use LMailTemplate\Traits\LHtmlTrait;

class LMailLayout {

    use LBindsTrait;
    use LReplaceBindsTrait;
    use LHtmlTrait;

    protected $cache = [];

    public function __construct()
    {
        $this->loadDefaultBinds();
        $this->loadDefaultTable();
    }

    protected function loadDefaultBinds()
    {
        $this->addBinds( [
            'layout-content' => '<!-- table render -->',
            'layout-name' => 'Louis Mail Template',
            'layout-fonts' => <<<HTML
<style>
/** your font styles **/
</style>
HTML
            ,
            'layout-background-color' => '#ffffff',
            'layout-min-width' => 320,
            'layout-max-width' => 570,
            'layout-tracking' => <<<HTML
<!-- Google Analytics using one pixel image -->
HTML
            ,
        ] );
    }

    protected function loadDefaultTable()
    {
        $table = new LMailTable();
        $table->addOptions( [
            'align' => 'center',
            'width' => '100%',
            'min-width' => '{layout-min-width}px',
            'max-width' => '{layout-max-width}px',
        ] );
        $this->cache['table'] = $table;
    }

    public function getTable()
    {
        return $this->cache['table'];
    }

    public function render()
    {
        if ( !isset( $this->cache['layout'] ) )
        {
            $this->cache['layout'] = file_get_contents(__DIR__.'/Templates/layout.htm');
        }

        $this->binds['layout-content'] = $this->cache['table']->render();
        return $this->replaceBinds( $this->cache['layout'], $this->binds );
    }

    public function print()
    {
        print $this->render()."\n";
    }

    public function setContent( $content )
    {
        $this->getTable()->addRow( [], $content );
    }
}