<?php

/**
 * Add custom variables in your content before it is parsed.
 */
class PhileContentVariables extends \Phile\Plugin\AbstractPlugin implements \Phile\EventObserverInterface {

	public function __construct() {
		\Phile\Event::registerEvent('after_parse_content', $this);
		// go and get the settings for the site
		$this->config = \Phile\Registry::get('Phile_Settings');
	}

	public function on($eventKey, $data = null) {
		if ($eventKey == 'after_parse_content') {
			// check to see if there is even a proper key set
			if (isset($this->config['variables'])) {
				// store the starting content
				$content = $data['content'];
				// find and replace each variable
				foreach ($this->config['variables'] as $key => $value) {
					// add the prepend and append the tags
					$target = $this->settings['open_tag'].$key.$this->settings['close_tag'];
					$content = str_replace($target, $value, $content);
				}
				// add the modified content back in the data
				$data['content'] = $content;
			}
		}
	}
}
