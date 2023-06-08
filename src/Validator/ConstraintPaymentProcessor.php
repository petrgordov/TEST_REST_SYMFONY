<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class ConstraintPaymentProcessor extends Constraint
{

    public string $message = 'The string "{{ string }}" contains an illegal character.';

    #[HasNamedArguments]
    public function __construct(
        public string $mode,
        array $groups = null,
        mixed $payload = null,
    ) {
        parent::__construct([], $groups, $payload);
    }


}