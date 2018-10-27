<?php 

namespace LMailTemplate\Traits;

use LMailTemplate\LMailTable;

trait LRenderTrait {

    protected function newTag( $name )
    {
        $tag = new \stdClass();
        $tag->name = $name;
        $tag->attributes = [];
        $tag->styles = [];
        return $tag;
    }

    protected function renderTag( \stdClass $tag )
    {
        if ( count( $tag->styles ) > 0  ){
            $tag->attributes[] = 'style="'.implode(';', $tag->styles).';"';
        }
        if ( in_array( $tag->name, ['img'] ) )
        {
            return sprintf('<%s%s />',
                $tag->name,
                count($tag->attributes)>0?' '.implode(' ', $tag->attributes):''
            );
        }
        else {
            return sprintf('<%s%s>%s</%s>',
                $tag->name,
                count($tag->attributes)>0?' '.implode(' ', $tag->attributes):'',
                $tag->html,
                $tag->name
            );
        }
    }

    protected function renderElement( $tag, $parser, $options, $defaultOptions = [])
    {
        $options = array_merge( $defaultOptions, $options );

        $tag = $this->newTag($tag);
        foreach ( $options as $attr => $val )
        {
            $this->$parser( $tag, $attr, $val );
        }
        $content = $this->renderTag( $tag );

        return $this->replaceBinds( $content, $options );
    }

    public function renderButton( $options )
    {
        $defaultOptions = [
            'name' => 'Submit',
            'href' => '#',
            'height' => 60,
            'width' => 200,
            'color' => 'inherit',
            'bgcolor' => 'inherit',
            'font-size' => 'inherit',
            'font-family' => 'inherit'
        ];
        $options = array_merge( $defaultOptions, $options );
        $content = <<<HTML
<!--[if mso]>
<v:rect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="{href}" style="height:{height}px;v-text-anchor:middle;width:{width};" strokecolor="{color}" fillcolor="{bgcolor}">
<w:anchorlock/>
<center style="color:{color};font-family:{font-family};font-size:{font-size};"><strong>{name}</strong></center>
</v:rect>
<![endif]-->

<a href="{href}" style="background-color: {bgcolor}; color: {color}; display: inline-block; font-size:{font-size}; font-family: {font-family}; line-height:{height}px; text-align:center; text-decoration: none; width:{width}px; mso-hide:all;">
    <strong>{name}</strong>
</a>
HTML;
        $button = $this->replaceBinds( "\n".$content."\n", $options );

        $table = new LMailTable();
        $table->addOptions([
            'width' => $options['width'],
        ]);
        $table->addRow(['height' => $options['height']], $button);
        return $table->render();
    }

    public function renderLink( $options )
    {
        $defaultOptions = [
            'text-decoration' => 'none'
        ];
        return $this->renderElement('a', 'parseLinkOption', $options, $defaultOptions);
    }

    public function renderImage( $options )
    {
        $defaultOptions = [
            'border' => '0',
        ];
        return $this->renderElement('img', 'parseImageOption', $options, $defaultOptions);
    }
}