<?php

namespace Aurora;

use Aurora\Helper\StatefulTrait;

class ServiceLocator
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
