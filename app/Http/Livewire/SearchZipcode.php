<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\AddressProprietiesMessagesTrait;
use App\Http\Livewire\Traits\AddressProprietiesRulesTrait;
use App\Models\Address;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class SearchZipcode extends Component
{
    use WithPagination;
    use Actions;
    use AddressProprietiesRulesTrait;
    use AddressProprietiesMessagesTrait;

    public array $data = [];

    public string $teste = '';

    public array $filters = [
        'state' => '',
        'orderBy' => '',
        'perPage' => '',
    ];

    public function updated(string $key, string $value)
    {
        if($key == 'data.zipcode'){
            $response = Http::get("https://viacep.com.br/ws/$value/json/")->json();
            if($response){
                $this->data['zipcode'] = str_replace('-', '', $response['cep']);
                $this->data['street'] = $response['logradouro'];
                $this->data['neighborhood'] = $response['bairro'];
                $this->data['city'] = $response['localidade'];
                $this->data['state'] = $response['uf'];
                $this->teste = '';
            }else{
                $this->data['zipcode'] = '';
                $this->data['street'] = '';
                $this->data['neighborhood'] = '';
                $this->data['city'] = '';
                $this->data['state'] = '';
                $this->teste = 'Insira um CEP válido';
            }
        }
    }

    public function mount(): void{
        $this->data = [
            'zipcode' => '',
            'street' => '',
            'neighborhood' => '',
            'city' => '',
            'state' => '',
        ];
    }

    public function save(): void
    {
        $this->validate();
        Address::updateOrCreate(
            ['zipcode' => $this->data['zipcode']],
            $this->data
        );
        $this->reset(); //Deixa os campos em branco
    }

    public function cancel(): void
    {
        $this->notification()->info('Cancelar', "Sua ação foi cancelada com sucesso");
    }

    public function removeAddress($value){
        $address = Address::find($value);

        $address->delete($value);

        $this->notification()->success('Excluir', "O endereço foi excluido com sucesso");
    }

    public function edit($value){
        $address = Address::find($value);

        $this->data['zipcode'] = $address->zipcode;
        $this->data['street'] = $address->street;
        $this->data['neighborhood'] = $address->neighborhood;
        $this->data['city'] = $address->city;
        $this->data['state'] = $address->state;
    }

    public function render()
    {
        $address = Address::query();

        $address->when($this->filters['state'], function ($queryBuilder){
            return $queryBuilder->where('state', $this->filters['state']);
        });
        if($this->filters['orderBy'] ?? null){
            $orderBy = $this->filters['orderBy'] == 1 ? 'ASC' : 'DESC';
            $address->orderBy('city', $orderBy);
        }

        return view('livewire.search-zipcode',['addresses' => $address->paginate($this->filters['perPage'])]);
    }
}
