<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\AddressProprietiesFiltersTrait;
use App\Http\Livewire\Traits\AddressProprietiesMessagesTrait;
use App\Http\Livewire\Traits\AddressProprietiesRulesTrait;
use App\Models\Address;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;
use App\Services\ViaCep\ViaCepService;
use App\Actions\AddressGetProprietiesAction;

class SearchZipcode extends Component
{
    use WithPagination;
    use Actions;
    use AddressProprietiesRulesTrait;
    use AddressProprietiesMessagesTrait;
    use AddressProprietiesFiltersTrait;

    public array $data = [];

    public bool $isEdit = false;

    public array $filters = [
        'state' => '',
        'orderBy' => '',
        'perPage' => '',
    ];

    public function mount(): void{
        $this->data = AddressGetProprietiesAction::getEmptyProperties();
    }

    public function updated(string $key, string $value)
    {
        if($key == 'data.zipcode'){
            $this->data = ViaCepService::handle($value);
        }
    }


    public function save(): void
    {
        $this->validate();
        
        AddressGetProprietiesAction::save($this->data);

        $this->reset('data'); //Deixa os campos em branco

        AddressGetProprietiesAction::filterSave($this->isEdit, $this->notification());
        $this->isEdit = false;
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
        $this->data = AddressGetProprietiesAction::edit($value);
        $this->isEdit = true;
    }

    public function render()
    {
        $address = Address::query();

        $address = $this->filters($address);

        return view('livewire.search-zipcode',['addresses' => $address->paginate($this->filters['perPage'])]);
    }
}