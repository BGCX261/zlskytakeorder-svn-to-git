<?php
abstract class View extends Base {
	abstract public function assign($key, $val);
	abstract public function display($path = '');
	abstract public function fetch($path = '');
	abstract public function includeHtml($path = '');
}