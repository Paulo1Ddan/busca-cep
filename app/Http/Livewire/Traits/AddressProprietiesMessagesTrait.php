<?php 
declare(strict_types=1);
namespace App\Http\Livewire\Traits;
trait AddressProprietiesMessagesTrait
{
    
    protected array $messages = [
        'data.zipcode' => [
            'required' => 'O campo CEP é obrigatorio',
            'min' => 'O campo precisa ter no minimo 8 caracteres',
        ],
        'data.street' => [
            'required' => 'O campo Rua é obrigatorio',
        ],
        'data.city' => [
           'required' => 'O campo Cidade é obrigatorio',
        ],
        'data.neighborhood' => [
           'required' => 'O campo Bairro é obrigatorio',
        ],
       'data.state' => [
           'required' => 'O campo Estado é obrigatorio',
           'max' => 'O campo deve ter no maximo 2 caracteres'
        ],
    ];
}