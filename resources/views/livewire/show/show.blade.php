<div>
   <table class="table-auto">
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
        <tbody>
            @foreach ($addresses as $address)
                <tr>
                    <td class="px-4 py-2">{{ $address->zipcode }}</td>
                    <td class="px-4 py-2">{{ $address->street }}</td>
                    <td class="px-4 py-2">{{ $address->neighborhood }}</td>
                    <td class="px-4 py-2">{{ $address->city }}</td>
                    <td class="px-4 py-2">{{ $address->state }}</td>
                    <td class="px-4 py-2">Teste</td>
                </tr>
            @endforeach
        </tbody>
   </table>
</div>
