<?php

namespace App\libs;


use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Hashing\AbstractHasher;


class Sha256Hasher extends AbstractHasher implements Hasher

{


    /**
     * Check the given plain value against a hash.
     *
     * @param string $value
     * @param string $hashedValue
     * @param array $options
     * @return bool
     */

    public function check ($value, $hashedValue, array $options = [])
    {
 
        return $this->make($value) === $hashedValue;

    }

    /**
     * Hash the given value.
     *
     * @param string $value
     * @return string
     */

    public function make ($value, array $options = [])
    {

        return hash('sha3-256', $value);

    }

    /**
     * Check if the given hash has been hashed using the given options.
     *
     * @param string $hashedValue
     * @param array $options
     * @return bool
     */

    public function needsRehash ($hashedValue, array $options = [])
    {

        return false;

    }


}