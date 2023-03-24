<?php 
declare(strict_types=1);
namespace App\Http\Livewire\Traits;
trait AddressProprietiesRulesTrait
{
    protected array $rules = [
        'data.zipcode' => ['required', 'min:8'],
        'data.city' => ['required'],
        'data.street' => ['required'],
        'data.neighborhood' => ['required'],
        'data.state' => ['required', 'max:2'],
    ];
}