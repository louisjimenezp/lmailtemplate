<?php 

namespace LMailTemplate\Traits;

trait LReplaceBindsTrait {

    protected function replaceBinds( $template, $binds )
    {
        $search = array_map( function( $val ){
            return '{'.$val.'}';
        }, array_keys( $binds ) );
        $replace = array_values( $binds );
        return str_replace( $search, $replace, $template );
    }
}