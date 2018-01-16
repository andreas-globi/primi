<?php

namespace Smuuf\Primi\Handlers;

use \Smuuf\Primi\HandlerFactory;
use \Smuuf\Primi\ErrorException;
use \Smuuf\Primi\Context;
use \Smuuf\Primi\Helpers;

/**
 * Node fields:
 * function: Function name.
 * args: List of arguments.
 * body: Node representing contents of code to execute as a function..
 */
class ArgumentList extends \Smuuf\Primi\StrictObject implements IHandler {

	public static function handle(array $node, Context $context) {

		$list = [];

		if (isset($node['args'])) {

			Helpers::ensureIndexed($node['args']);

			foreach ($node['args'] as $a) {
				$handler = HandlerFactory::get($a['name']);
				$list[] = $handler::handle($a, $context);
			}

		}

		return $list;

	}

}