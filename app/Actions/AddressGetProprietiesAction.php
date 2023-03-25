<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Address;

class AddressGetProprietiesAction
{
    public static function save(array $data): void
    {
        Address::updateOrCreate(
            ['zipcode' => $data['zipcode']],
            $data
        );
    }

    public static function filterSave(bool $isEdit, object $zipcodeNotification): void
    {
        if ($isEdit) {
            $zipcodeNotification->success('Atualizar', "O endereço foi atualizado com sucesso");
        } else {
            $zipcodeNotification->success('Cadastrar', "O endereço foi cadastrado com sucesso");
        }
    }

    public static function edit(int $id): array
    {
        $address = Address::find($id);
        return [
            'zipcode' => $address->zipcode,
            'street' => $address->street,
            'neighborhood' => $address->neighborhood,
            'city' => $address->city,
            'state' => $address->state,
        ];
    }

    public static function getEmptyProperties(): array
    {
        return [
            'zipcode' => '',
            'street' => '',
            'neighborhood' => '',
            'city' => '',
            'state' => '',
            'teste' => '',
        ];
    }
}
