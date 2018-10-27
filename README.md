# LMailTemplate
Template to create the HTML to send by email. This HTML is supported for the mayor of mail clients. You can test it using your Litmus account.

# How to use
## Create your LMailLayout

```php
<?php

namespace LMailTemplate\Emails;

use LMailTemplate\LMailTable;
use LMailTemplate\LMailLayout;

class Demo1Email extends LMailLayout {

    public function loadDefaultTable(){
        parent::loadDefaultTable();

        $this->addHeader();
        $this->addBody();
        $this->addFooter();
    }
}
```

## Create your Header
```php
    protected function addHeader(){
        $table = $this->getTable(); // body table
        $options = [
            'height' => 72, // integer
            'bgcolor' => '{color-orange}', // background-color
            'align' => 'center' // td align
        ];
        
        $table->addRow(['height' => 40]); // row with height 64
        $table->addRow($options, $this->renderHeader());
    }
```

## Create your renderHeader
```php
    protected function renderHeader(){
        $table = $this->getTable(); // body table
        return $table->renderLink([ // create tag <a>
            'href' => '{href-site}',
            'html' => $table->renderImage([ // create tag <img>
                'src' => '{src-logo}',
                'height' => 34
            ])
        ]);
    }
```
