<?php

/**
 * Registry. (Variables Journal)
 * 
 * Deytron Framework
 *
 * @license:
 * 
 * Copyright (c) <2012> Myroslaw Sosulja. All Rights Reserved.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
 * ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
 * ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @author Myroslaw <diwms@yandex.ua>
 * @copyright &copy; Myroslaw Sosulja <2012>
 * @category Deytron
 * @package Core
 * @link http://diwms.com/
 * @version 0.3
 ТЫ ОХУЕЛ??? Стока папок?? убейся ап стену??!!
 */

namespace Deytron;

final class Registry
{

    /**
     * Singleton instance
     *
     * @var object contains object of class. Default Null
     * @access private
     * @staticvar
     */
    private static $_instance = NULL;

    /**
     * Variables array
     *
     * @var array contains many variables and values. Defualt empty array
     * @access private
     * @staticvar
     */
    private static $_variables = array();

    /**
     * Constructor should never be overridden. Class is Singleton!
     *
     * @access private
     * @final
     * @return void
     */
    final private function __construct()
    {
        
    }

    /**
     * No clone, should never be overridden. Class is Singleton!
     *
     * @access private
     * @final
     * @return void
     */
    final private function __clone()
    {
        
    }

    /**
     * Magic method
     *
     * How to use:
     *
     * <code>
     *
     * <?php
     * // Get class object
     * $registry = Registry::getInstance();
     * //Use magic method
     * $registry->myVar = 'Test. Just Test...';
     * //Then we just call needed var and get value. For example:
     * echo $registry->myVar;
     * //--> In output we have string "Test. Just Test..."
     * ?>
     *
     * </code>
     *
     * @access public
     * @method void
     * @return void
     */
    public function __set($name, $value)
    {
        static::set($name, $value);
    }

    /**
     * Magic method. Support unset() overloading
     *
     * @param string $name
     * @method boolean
     * @return boolean FALSE If variable are not found - how we can delete?
     */
    public function __unset($name)
    {
        if (isset(self::$_variables[$name]))
        {
            unset(self::$_variables[$name]);
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Magic method. Get variable value
     *
     * 
     * @see magic method __set()
     * @access public
     * @param mixed $name
     * @method void
     * @return mixed NULL If variable are not found
     */
    public function __get($name)
    {
        return static::get($name);
    }

    /**
     * Magic method. Support isset() overloading
     *
     * @method boolean
     * @param string $name
     * @return boolean
     */
    public function __isset($name)
    {
        return isset(self::$_variables[$name]);
    }

    /**
     * Clean variables array
     *
     * @access public
     * @method void
     * @return void
     */
    public function __destruct()
    {
        self::$_variables = NULL;
    }

    /**
     * Set variable name and value into variables array
     *
     * @see magic method __set()
     * 
     * Lazy use:
     * <code>
     * 
     * <?php
     * Registry::set('myVar', 'TEST');
     * echo Registry::get('myVar');
     * ?>
     * 
     * </code>
     * 
     * @param mixed $name
     * @param mixed $value
     * @return void
     */
    public static function set($name, $value)
    {
        self::$_variables[$name] = $value;
    }

    /**
     * Get variable value from variables array
     *
     * @see magic method __get()
     * @param mixed $name
     * @return mixed NULL If variable are not found 
     */
    public static function get($name)
    {
        return isset(self::$_variables[$name]) ? self::$_variables[$name] : NULL;
    }

    /**
     * Return full variables array
     * 
     * @return array
     */
    public static function getAll()
    {
        return self::$_variables;
    }

    /**
     * Return singleton instance
     *
     * @static
     * @return Singleton instance
     */
    public static function getInstance()
    {
        return self::$_instance === NULL ? self::$_instance = new self() : self::$_instance;
    }

    /**
     * Reset the singleton instance
     *
     * @return void
     */
    public static function resetInstance()
    {
        self::$_instance = NULL;
    }

}