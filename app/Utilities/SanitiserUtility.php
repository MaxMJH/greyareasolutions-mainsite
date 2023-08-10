<?php

namespace App\Utilities;

/**
 * This class acts as a further form of validation.
 *
 * To allow easy accessibility, methods can be chained,
 * and the sanitised outputs can be accessed via the string
 * returned get method.
 *
 * @package App\Utilities
 *
 * @author Max Harris <MaxHarrisMJH@gmail.com>
 *
 * @since v0.0.1
 *
 * @version v0.0.1
 */
class SanitiserUtility
{
    /**
     * @var array $inputs Storage array for the sanitised inputs.
     */
    private $inputs;

    /**
     * Constructs an instance of the SanitiserUtility class.
     *
     * @param array $inputs Array containing to-be sanitised inputs.
     */
    public function __construct(array $inputs)
    {
        $this->inputs = $inputs;
    }

    /**
     * Destrcuts an instance of the SanitiserUtility class.
     */
    public function __destruct()
    {}

    /**
     * Strips HTML tags from inputs.
     *
     * @return $this Returns the same instance of SanitiserUtility for chaining.
     */
    public function strip(): SanitiserUtility
    {
        // Iterate through all inputs (assuming they are strings), and remove tags.
        foreach ($this->inputs as $key => $value) {
            $this->inputs[$key] = $this->removeMaliciousTags($value);
        }

        return $this;
    }

    /**
     * Trims proceeding and preceeding characters from inputs.
     *
     * @return $thid Returns the same instance of SanitiserUtility for chaining.
     */
    public function trim(): SanitiserUtility
    {
        // Iterate through all inputs (assuming they are strings), and remove any un-needed characters.
        foreach ($this->inputs as $key => $value) {
            $this->inputs[$key] = trim($value);
        }

        return $this;
    }

    /**
     * Converts all inputs to lowercase.
     *
     * @return $this Returns the same instance of SanitiserUtility for chaining.
     */
    public function forceToLower(): SanitiserUtility
    {
        // Iterate through all inputs (assuming they are strings), and force them to lowercase.
        foreach ($this->inputs as $key => $value) {
            $this->inputs[$key] = mb_strtolower($value);
        }

        return $this;
    }

    /**
     * Converts all inputs to uppercase.
     *
     * @return $this Returns the same instance of SanitiserUtility for chaining.
     */
    public function forceToUpper(): SanitiserUtility
    {
        // Iterate through all inputs (assuming they are strings), and force them to uppercase.
        foreach ($this->inputs as $key => $value) {
            $this->inputs[$key] = mb_strtoupper($value);
        }

        return $this;
    }

    /**
     * Returns the sanitised inputs.
     *
     * @return array Returns the same sanitised inputs.
     */
    public function getSanitisedInputs(): array
    {
        return $this->inputs;
    }

    /**
     * Used to strip any HTML tags from inputs. This is a further deterrent against XSS attacks,
     *
     * @param string $input A string which could potentially contain malicious HTML tags.
     *
     * @return string       A sanitised version of the string that has been neutralised.
     */
    private function removeMaliciousTags(string $input): string
    {
        // Loop until the temporary variable and the input are equal after preg_replace.
        do {
            $temp = $input;

            // This could be computationally expensive, and the RegEx might miss some cases.
            $string = preg_replace('/(<\w*>)|(<\/\w*>)|(<[\w\s\d\`\¬\!\"\£\$\%\^\&\*\(\)\-\_\+\=\[\]\{\}\;\:\'\@\#\~\|\\\,\.\/\?\||\&&]*?>)/is', '', $temp);
        } while ($temp !== $input);

        return $string;
    }
}
