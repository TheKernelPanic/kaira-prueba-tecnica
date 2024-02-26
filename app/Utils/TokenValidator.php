<?php

namespace App\Utils;

class TokenValidator
{
    private const SQUARE_BRACKET_OPEN = '[';
    private const SQUARE_BRACKET_CLOSE = ']';
    private const CURLY_BRACKET_OPEN = '{';
    private const CURLY_BRACKET_CLOSE = '}';
    private const ROUND_BRACKET_OPEN = '(';
    private const ROUND_BRACKET_CLOSE = ')';

    /**
     * @param string $token
     */
    public function __construct(
        private readonly string $token
    )
    {}

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return !$this->patternIsInvalid() && $this->checkBracketsIsClosed();
    }

    /**
     * @return bool
     */
    private function checkBracketsIsClosed(): bool
    {
        $mapBracketsOpened = [
            self::CURLY_BRACKET_OPEN => 0,
            self::ROUND_BRACKET_OPEN => 0,
            self::SQUARE_BRACKET_OPEN => 0
        ];
        $step = 0;
        while($step < strlen($this->token)) {

            $currentChar = substr($this->token, $step, 1);
            switch ($currentChar) {
                case self::SQUARE_BRACKET_OPEN:
                case self::CURLY_BRACKET_OPEN:
                case self::ROUND_BRACKET_OPEN:
                    $mapBracketsOpened[$currentChar]++;
                    break;
                case self::SQUARE_BRACKET_CLOSE:
                    $mapBracketsOpened[self::SQUARE_BRACKET_OPEN]--;
                    break;
                case self::CURLY_BRACKET_CLOSE:
                    $mapBracketsOpened[self::CURLY_BRACKET_OPEN]--;
                    break;
                case self::ROUND_BRACKET_CLOSE:
                    $mapBracketsOpened[self::ROUND_BRACKET_OPEN]--;
                    break;
            }
            $step++;
        }
        return array_reduce($mapBracketsOpened, fn(?int $pendingBracesOpened, int $value) => $pendingBracesOpened += abs($value)) === 0;
    }

    /**
     * @return bool
     */
    private function patternIsInvalid(): bool
    {
        return preg_match('/[^\[\]\{\}\(\)]+/', $this->token);
    }
}
