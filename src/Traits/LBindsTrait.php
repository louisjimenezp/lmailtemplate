<?php 

namespace LMailTemplate\Traits;

trait LBindsTrait {

    protected $binds = [];

    public function addBinds( $binds )
    {
        $this->binds = array_merge( $this->binds, $binds );
    }
}