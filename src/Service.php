<?php

/**
 * Aurora - Framework
 *
 * Aurora is fast, simple, extensible Framework
 *
 * PHP version 6
 *
 * @category   Framework
 * @package    Aurora
 * @author     VeeeneX <veeenex@gmail.com>
 * @copyright  2015 Caroon
 * @license    MIT
 * @version    0.1.2
 * @link       http://caroon.com/Aurora
 *
 */

namespace Aurora;

/**
 * Container
 *
 * Simple Container (IoC)
 *
 * @category   Commnon
 * @package    Aurora
 * @author     VeeeneX <veeenex@gmail.com>
 * @copyright  2015 Caroon
 * @license    MIT
 * @version    0.1.2
 * @link       http://pear.php.net/package/PackageName
*/

use Aurora\Helper\StatefulTrait;

class Service
{
	/**
	 * Helper trait
	 */
	use StatefulTrait;

	/**
	 * Register a shared binding in the container
	 *
	 * @param  string  $abstract
	 * @param  \Closure|string|null  $concrete
	 * @return void
	 */
	public function singleton($key, $value = null)
	{
		$this->set($key, static function ($c) use ($value) {
			static $object;
			if (null === $object) {
				$object = $value($c);
			}
			return $object;
		});
	}

  /**
   * Protect closure from being directly invoked
   *
   * @see https://github.com/slimphp/Slim/blob/master/Slim/Helper/Set.php#L240
   * @param  \Closure $callable A closure to keep from being invoked and evaluated
   * @return \Closure
   */
	public function protect(\Closure $callable)
	{
		return function () use ($callable) {
			return $callable;
		};
  }
}
