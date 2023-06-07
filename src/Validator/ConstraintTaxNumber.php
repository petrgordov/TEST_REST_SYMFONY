<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class ConstraintTaxNumber extends Constraint
{

    public string $message = 'The string "{{ string }}" contains an illegal character: taxNumber format may be FRYYXXXXXXXXX or DEXXXXXXXXX for sample.';

    #[HasNamedArguments]
    public function __construct(
        public string $mode,
        array $groups = null,
        mixed $payload = null,
    ) {
        parent::__construct([], $groups, $payload);
    }


}