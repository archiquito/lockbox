<?php
namespace Core;

use Core\Database;
use App\Models\User;

class Validation
{
    public $arrValidations = [];

    public static function validate($rules, $data)
    {
        $validation = new self;

        foreach ($rules as $field => $fieldRules) {

            foreach ($fieldRules as $rule) {
                $nRule = explode(":", $rule);
                if ($rule === 'confirmed') {
                    $validation->$rule($field, "confirm_{$field}", $data);
                } else if ($nRule[0] === 'min' || $nRule[0] === 'max' || $nRule[0] === 'strong' || $nRule[0] === 'unique') {
                    $nRuleFunc = $nRule[0];
                    $validation->$nRuleFunc($field, $data, $nRule[1]);
                } else {
                    $validation->$rule($field, $data);
                }
            }
        }

        return $validation;
    }

    private function unique($field, $data, $nRuleValue)
    {
        if ($nRuleValue === 0) return;

        $db = new Database(config('database'));
        $sql = "SELECT * FROM $nRuleValue WHERE email=:email";
        $result = $db->query(query: $sql, class: User::class, params: ['email' => $data[$field]])->fetch();
        if ($result && $data[$field] === $result->email) {
            $this->arrValidations[] = "$field já existe!";
        }
    }

    private function required($field, $data)
    {
        if (strlen($data[$field]) === 0) {
            $this->arrValidations[] = "$field é obrigatório";
        }
    }
    private function email($field, $data)
    {

        if (!filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {

            $this->arrValidations[] = "$field é inválido";
        }
    }
    private function confirmed($field, $confirmedField, $data)
    {
        if (($data[$field] !== $data[$confirmedField] || !filter_var($data[$confirmedField], FILTER_VALIDATE_EMAIL))) {

            $this->arrValidations[] = "$field de confirmação não é o mesmo";
        }
    }

    private function min($field, $data, $nRuleValue)
    {
        if (strlen($data[$field]) < $nRuleValue) {

            $this->arrValidations[] = "$field tem que ter um mínimo de 6 caracteres";
        }
    }
    private function max($field, $data, $nRuleValue)
    {
        if (strlen($data[$field]) > $nRuleValue) {

            $this->arrValidations[] = "Senha tem que ter um máximo de 30 caracteres";
        }
    }

    public function validateFail()
    {
        return sizeof($this->arrValidations) > 0;
    }
}
