<?php


namespace App\Service\Traits;


trait DynamicFunctionCallTrait
{
    /** @var array $mapDynamicFunctions */
    protected $mapDynamicFunctions = [];

    public function __construct()
    {
        $this->setMapDynamicFunctions();
    }

    public function __call($name, $arguments)
    {
        if (array_key_exists($name, $this->mapDynamicFunctions)) {
            $object = $this->mapDynamicFunctions[$name]();

            return (
            count($arguments) > 0
                ? call_user_func_array([$object, $name], $arguments)
                : $object->$name()
            );
        }
    }

    protected function addDynamicFunction(string $functionName, callable $object): self
    {
        $this->mapDynamicFunctions[$functionName] = $object;

        return $this;
    }

    abstract function setMapDynamicFunctions(): void;
}