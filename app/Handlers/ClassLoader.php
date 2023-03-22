<?php
namespace Ships\ClassLoader;

use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\ClassLoader\IClassLoader;

class MyCustomClassLoader implements IClassLoader
{
  /**
   * Load class
   *
   * @param string $class
   * @return object
   * @throws NotFoundHttpException
   */
  public function loadClass(string $class)
  {
    if (\class_exists($class) === false) {
      throw new NotFoundHttpException(
        sprintf('Class "%s" does not exist', $class),
        404
      );
    }

    return new $class();
  }

  /**
   * Called when loading class method
   * @param object $class
   * @param string $method
   * @param array $parameters
   * @return object
   */
  public function loadClassMethod($class, string $method, array $parameters)
  {
    return call_user_func_array([$class, $method], array_values($parameters));
  }

  /**
   * Load closure
   *
   * @param Callable $closure
   * @param array $parameters
   * @return mixed
   */
  public function loadClosure(callable $closure, array $parameters)
  {
    return \call_user_func_array($closure, array_values($parameters));
  }
}
?>
