<?php 

use LMailTemplate\LMailLayout;

use PHPUnit\Framework\TestCase;

class LMailTemplateTest extends TestCase {
    
    public function testHelloWorld(){
        $lmail = new LMailLayout();
        $lmail->setContent('Hello World!!!');
        //echo $lmail->render();
        $this->assertNotRegExp('/{(.*)}/', $lmail->render());
    }
}