<?php

namespace PhantomJsModule\Model;

use ArrayObject;

class Arguments extends ArrayObject
{

    /**
     * Return the options as command line options
     *
     * @return string
     */
    public function toString()
    {
        $arguments = array();

        foreach ($this as $option => $value) {
            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }

            $arguments[] = sprintf('--%s=%s', $option, $value);
        }

        return join(' ', $arguments);
    }


    /**
     * @param Arguments $other
     */
    public function merge($other)
    {
        return new Arguments(array_merge($this->getArrayCopy(), $other));
    }
}
