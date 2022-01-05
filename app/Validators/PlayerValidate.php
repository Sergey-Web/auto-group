<?php

declare(strict_types=1);

namespace App\Validators;

use Exception;
use Illuminate\Support\Facades\Validator;

class PlayerValidate
{
    /**
     * @throws Exception
     */
    public static function toCreate(array $data): void
    {

        $validation = Validator::make($data, [
            'auto' => ['required_with: display_name'],
            'display_name' => ['unique:players','string','max:100'],
        ]);

        if (!empty($validation->errors()->messages())) {
            throw new Exception(json_encode($validation->errors()->messages()));
        }
    }
}
