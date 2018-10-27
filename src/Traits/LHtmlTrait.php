<?php 

namespace LMailTemplate\Traits;

trait LHtmlTrait {

    protected $html;

    protected function resetHtml()
    {
        $this->html = '';
    }

    protected function addHtml( $html )
    {
        $this->html.= "\n".$html;
    }

    protected function getHtml()
    {
        return $this->html;
    }
}