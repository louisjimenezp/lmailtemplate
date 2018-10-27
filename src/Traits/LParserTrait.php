<?php 

namespace LMailTemplate\Traits;

trait LParserTrait {

    protected function parseAttribute($attribute, $value)
    {
        return $attribute.'="'.$value.'"';
    }

    protected function parseStyle($attribute, $value)
    {
        return $attribute.': '.$value;
    }

    protected function parseTableOption( \stdClass $tag, $attribute, $value )
    {
        switch ($attribute) {
            case 'width':
            case 'cellpadding':
            case 'cellspacing':
                $tag->attributes[] = $this->parseAttribute($attribute, $value);
                break;

            case 'min-width':
            case 'max-width':
                $tag->styles[] = $this->parseStyle($attribute, $value);
                break;

            case 'html':
                $tag->html = $value;
                break;
        }
    }

    protected function parseTableDataOption( \stdClass $tag, $attribute, $value )
    {
        switch ($attribute) {
            case 'bgcolor': 
                $tag->attributes[] = $this->parseAttribute($attribute, $value);
                $tag->styles[] = $this->parseStyle('background-color', $value);
                break;

            case 'align':
            case 'height':
            case 'width':
            case 'colspan':
                $tag->attributes[] = $this->parseAttribute($attribute, $value);
                break;

            case 'font-family': 
            case 'font-size':
            case 'color':
                $tag->styles[] = $this->parseStyle($attribute, $value);
                break;

            case 'html':
                $tag->html = $value;
                break;
        }
    }

    public function parseLinkOption( \stdClass $tag, $attribute, $value )
    {
        switch ($attribute) {
            case 'href':
                $tag->attributes[] = $this->parseAttribute($attribute, $value);
                break;

            case 'color':
            case 'text-decoration':
                $tag->styles[] = $this->parseStyle($attribute, $value);
                break;

            case 'html':
                $tag->html = $value;
                break;
        }
    }

    public function parseImageOption( \stdClass $tag, $attribute, $value )
    {
        switch ($attribute) {
            case 'src':
            case 'width':
            case 'height':
            case 'border':
                $tag->attributes[] = $this->parseAttribute($attribute, $value);
                break;
        }
    }
}