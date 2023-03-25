<?php 
declare(strict_types=1);
namespace App\Http\Livewire\Traits;
trait AddressProprietiesFiltersTrait
{
    protected function filters($address){
        $address->when($this->filters['state'], function ($queryBuilder){
            return $queryBuilder->where('state', $this->filters['state']);
        });
        if($this->filters['orderBy'] ?? null){
            $orderBy = $this->filters['orderBy'] == 1 ? 'ASC' : 'DESC';
            $address->orderBy('city', $orderBy);
        }
        return $address;
    }
}