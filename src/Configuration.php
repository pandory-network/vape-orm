<?php
/**
 * Configuration Holder
 *
 * @author     Benjamin von Minden <github@pandory.de>
 * @copyright  2016 Benjamin von Minden
 */

namespace Vape\ORM;

use Doctrine\Common\Annotations\AnnotationRegistry;

/**
 * Class Configuration
 *
 * @package Vape\ORM
 */
class Configuration
{
    /**
     * Contains the database connection configuration and the ORM specific configuration.
     *
     * @var array
     */
    private static $config = array();

    /**
     * Are the annotations registered?
     *
     * @var bool
     */
    private static $registered = false;

    /**
     * Set configuration value.
     *
     * @param string $key
     * @param mixed $value
     */
    public static function set($key, $value)
    {
        self::$config[$key] = $value;
        // Check if we need to register the Annotations
        if (!self::$registered) {
            AnnotationRegistry::registerFile(__DIR__ . '/Structure/Annotations.php');
            self::$registered = true;
        }
    }

    /**
     * Register annotations when not yet done.
     */
    public static function registerAnnotations()
    {
        // Check if we need to register the Annotations
        if (!self::$registered) {
            AnnotationRegistry::registerFile(__DIR__ . '/Structure/Annotations.php');
            self::$registered = true;
        }
    }

    /**
     * Get configuration value.
     *
     * @param string $key
     *
     * @return mixed|null value or null
     */
    public static function get($key)
    {
        return isset(self::$config[$key]) ? self::$config[$key] : null;
    }

    /**
     * Add configuration subvalue to a array value already existing.
     *
     * @param string $key
     * @param mixed|array $value One value only.
     *
     * @return bool successful or not
     */
    public static function add($key, $value)
    {
        if (!isset(self::$config[$key]) || !is_array(self::$config[$key])) {
            return false;
        }
        array_push(self::$config[$key], $value);
        return true;
    }
}