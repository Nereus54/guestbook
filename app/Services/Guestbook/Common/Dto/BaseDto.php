<?php

namespace App\Services\Guestbook\Common\Dto;

use App\Services\Guestbook\Exception\ValidationException;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Description of BaseDto
 *
 * @author marcelbobak
 */
class BaseDto implements Arrayable
{
    /**
     * Validation rules
     *
     * @var Array
     */
    protected static $rules = [];

    /**
     * Custom messages
     *
     * @var Array
     */
    protected static $messages = [];

    /**
     * Validator instance
     *
     * @var Validator
     */
    protected $validator;

    /**
     * Internal storage of all  parameters.
     *
     * @var \Symfony\Component\HttpFoundation\ParameterBag
     */
    protected $parameters;
    
    /**
     *
     * @param array $parameters An array of parameters to set on the new object
     */
    public function __construct($parameters = null)
    {
        $this->initialize($parameters);

        $this->validator = $this->getValidationFactory();
    }
    
    /**
     * Get a validation factory instance.
     *
     * @return \Illuminate\Contracts\Validation\Factory
     */
    protected function getValidationFactory()
    {
        return app('validator');
    }
    
    /**
     * Initialize the object with parameters.
     *
     * If any unknown parameters passed, they will be ignored.
     *
     * @param array $parameters An associative array of parameters
     * @return $this
     */
    protected function initialize($parameters = null)
    {
        $this->parameters = new ParameterBag();

        if (is_array($parameters)) {
            foreach ($parameters as $key => $value) {
                $method = 'set' . ucfirst($key);
                if (method_exists($this, $method)) {
                    $this->$method($value);
                }
            }
        }

        return $this;
    }

    /**
     * Get all parameters.
     *
     * @return array An associative array of parameters.
     */
    public function getParameters()
    {
        return $this->parameters->all();
    }

    /**
     * Get one parameter.
     *
     * @return mixed A single parameter value.
     */
    protected function getParameter($key)
    {
        return $this->parameters->get($key);
    }

    /**
     * Set one parameter.
     *
     * @param string $key Parameter key
     * @param mixed $value Parameter value
     * @return $this
     */
    protected function setParameter($key, $value)
    {
        $this->parameters->set($key, $value);
        return $this;
    }

    /**
     * Validates current attributes against rules
     */
    public function validate()
    {
        $params = $this->getParameters();
        $v = $this->validator->make($params, static::$rules, static::$messages);

        if ($v->passes()) {
            foreach ($params as $key => $value) {
                if (method_exists($value, 'validate')) {
                    $value->validate();
                }
            }

            return;
        }

        throw new ValidationException($v->messages()->first());
    }

    public function toArray()
    {
        return $this->getParameters();
    }

    function __toString()
    {
        return json_encode($this->getParameters());
    }
}
