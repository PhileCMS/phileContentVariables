<?php
/**
 * Plugin class
 */
namespace Phile\Plugin\Phile\ContentVariables;

use Phile\Core\Container;

/**
 * Add custom variables in your content before it is parsed.
 */
class Plugin extends \Phile\Plugin\AbstractPlugin
{
    protected $events = ['after_parse_content' => 'onAfterParseContent'];

    public function onAfterParseContent($data)
    {
        $variables = Container::getInstance()->get('Phile_Config')->get('variables');
        if (empty($variables)) {
            return;
        }

        // store the starting content
        $content = $data['content'];
        // find and replace each variable
        foreach ($variables as $key => $value) {
            // add the prepend and append the tags
            $target = $this->settings['open_tag'] . $key . $this->settings['close_tag'];
            $content = str_replace($target, $value, $content);
        }
        // add the modified content back in the data
        $data['content'] = $content;
    }
}
