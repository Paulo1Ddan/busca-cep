@push('css')
    <link rel="stylesheet" href="css/teste.css">
@endpush
<div>
    <x-notifications/>
    <form class="p-8 bg-gray-200 flex-col w-1/2 mx-auto gap-4">
        <h1>Buscador de CEP</h1>
        <div class="flex flex-col w-1/2">
            <label for="zipcode">CEP</label>
            <input class="border" type="text" id="zipcode" wire:model.lazy='data.zipcode' >
            <div wire:loading wire:target="data.zipcode">
                Bucando CEP
            </div>
            @if(isset($data['teste']))
                <p class="erro-zipcode">{{$data['teste']}}</p>
            @endif
            @error('data.zipcode')
                <p class="erro-zipcode">{{ $message }}</p>	
            @enderror
        </div>
        <div class="flex flex-col w-1/2">
            <label for="street">Rua</label>
            <input class="border" type="text" id="street" wire:model="data.street">
            @error('data.street')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex flex-col w-1/2">
            <label for="neighborhood">Bairro</label>
            <input class="border" type="text" id="neighborhood" wire:model="data.neighborhood">
            @error('data.neighborhood')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex flex-col w-1/2">
            <label for="city">Cidade</label>
            <input class="border" type="text" id="city" wire:model="data.city">
            @error('data.city')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex flex-col w-1/2">
            <label for="state">Estado</label>
            <input class="border" type="text" id="state" wire:model="data.state">
            @error('data.state')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <button type="button" class="px-4 py-2 bg-blue-500 hover:bg-blue-400 text-white rounded-md" wire:click="cancel">Cancelar</button>
            <button type="button" class="px-4 py-2 bg-green-500 hover:bg-green-400 text-white rounded-md" wire:click="save">Salvar</button>
        </div>
    </form>

    <hr>

    <div class="my-8 container mx-auto bg-gray-200">
        <div class="filter mt-3">
            <select wire:model='filters.state'>
                <option value="">Todos os estados</option>
                <option value="SP">SP</option>
                <option value="RS">RS</option>
            </select>
            <select wire:model='filters.orderBy'>
                <option value="">Ordernar por</option>
                <option value="1">A-Z</option>
                <option value="2">Z-A</option>
            </select>
            <select wire:model='filters.perPage'>
                <option value="">Por pagina</option>
                <option value="5">5</option>
                <option value="10">10</option>
            </select>
        </div>
        <table class="table table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2">CEP</th>
                    <th class="px-4 py-2">Rua</th>
                    <th class="px-4-py-2">Bairro</th>
                    <th class="px-4 py-2">Cidade</th>
                    <th class="px-4 py-2">Estado</th>
                    <th class="px-4 py-2">Acções</th>
                </tr>
            </thead>
            <div wire:loading wire:target='filter.orderBy,filters.tate,filter.perPage'>
                Carregando...
            </div>
            <tbody wire:loading.class="invisible" wire:target='filter.orderBy,filters.tate,filter.perPage'>
                @foreach ($addresses as $address)
                    <tr>
                        <td class="px-4 py-2">{{ $address->zipcode }}</td>
                        <td class="px-4 py-2">{{ $address->street }}</td>
                        <td class="px-4 py-2">{{ $address->neighborhood }}</td>
                        <td class="px-4 py-2">{{ $address->city }}</td>
                        <td class="px-4 py-2">{{ $address->state }}</td>
                        <td class="px-4 py-2">
                            <button wire:click='edit({{$address->id}})' class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="button">Editar</button>
                            <button wire:click='removeAddress({{$address->id}})' class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" type="button">Excluir</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$addresses->links()}}
    </div>
</div>
