<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Cpf implements ValidationRule
{
    /**
     * Executa a regra de validação.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Remove espaços extras ou outros caracteres indesejados
        $value = trim($value);

        // Validação de CPF com ou sem formatação
        if (!preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$|^\d{11}$/', $value)) {
            $fail('O campo :attribute não é um CPF válido.');
            return;
        }

        // Lógica adicional para validar os dígitos do CPF (caso necessário)
        $cpf = preg_replace('/[^0-9]/', '', $value); // Remove a formatação para checar os dígitos

        // Verifica se o CPF tem 11 dígitos
        if (strlen($cpf) != 11 || preg_match('/^(.)\1{10}$/', $cpf)) {
            $fail('O CPF informado é inválido.');
            return;
        }

        // Valida os dígitos verificadores (1º e 2º)
        $soma = 0;
        for ($i = 0; $i < 9; $i++) {
            $soma += $cpf[$i] * (10 - $i);
        }
        $resto = $soma % 11;
        $digito1 = $resto < 2 ? 0 : 11 - $resto;

        $soma = 0;
        for ($i = 0; $i < 10; $i++) {
            $soma += $cpf[$i] * (11 - $i);
        }
        $resto = $soma % 11;
        $digito2 = $resto < 2 ? 0 : 11 - $resto;

        if ($cpf[9] != $digito1 || $cpf[10] != $digito2) {
            $fail('O CPF informado é inválido.');
        }
    }

}
