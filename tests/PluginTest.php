<?php

namespace Phile\Plugin\Phile\ContentVariables;

use Phile\Core\Config;
use Phile\Phile;
use Phile\Test\TestCase;

class PluginTest extends TestCase
{
    public function testReplaceVariables()
    {
        $config = new Config([
            'variables' => ['foo' => 'bar'],
            'plugins' => [
                'phile\\contentVariables' => [
                    'active' => true
                ]
            ]
        ]);

        $this->createPhileCore(null, $config)->bootstrap();

        $page = (new \Phile\Model\Page('dummy'));
        $page->setContent('This is %foo% %baz%.');
        $this->assertContains('This is bar %baz%.', $page->getContent());
    }

    public function testDifferentFence()
    {
        $config = new Config([
            'variables' => ['foo' => 'bar'],
            'plugins' => [
                'phile\\contentVariables' => [
                    'active' => true,
                    'open_tag' => '{$',
                    'close_tag' => '}'
                ]
            ]
        ]);

        $this->createPhileCore(null, $config)->bootstrap();

        $page = (new \Phile\Model\Page('dummy'));
        $page->setContent('This is {$foo}.');
        $this->assertContains('This is bar.', $page->getContent());
    }
}
