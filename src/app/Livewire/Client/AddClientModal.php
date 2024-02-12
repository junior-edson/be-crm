<?php

namespace App\Livewire\Client;

use App\Http\Requests\Client\CreateClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Models\Client;
use App\Services\Client\CreateClientService;
use App\Services\Client\UpdateClientService;
use Illuminate\View\View;
use Livewire\Component;
use Exception;

class AddClientModal extends Component
{
    public string $client_id;
    public string $name;
    public string $tax_type;
    public string $type;
    public string $registration_code;
    public string $address;
    public string $phone;
    public string $email;
    public bool $edit_mode = false;

    protected array $rules = [
        'name' => 'required|max:255',
        'type' => 'required|in:INDIVIDUAL,COMPANY',
        'tax_type' => 'required|in:TAX_21_PERCENT,SELF_LIQUIDATION,SUBCONTRACTOR',
        'registration_code' => 'required_if:type,COMPANY|max:50',
        'address' => 'required|max:255',
        'phone' => 'nullable|max:25',
        'email' => 'nullable|email|max:50',
    ];

    protected $listeners = [
        'delete_client' => 'deleteClient',
        'update_client' => 'updateClient',
        'typeUpdated' => 'typeUpdated',
    ];

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.client.add-client-modal');
    }

    /**
     * @return void
     */
    public function submit(): void
    {
        dd($this->all());
        $request = $this->validate();

        try {
            if ($this->edit_mode) {
                $request = new UpdateClientRequest($request);
                $service = new UpdateClientService();
                $service->execute($request, $this->client_id);

                $this->dispatch('success', __('Client updated'));
                $this->reset();
                return;
            }

            $request = new CreateClientRequest($request);
            $service = new CreateClientService();
            $service->execute($request);


            $this->dispatch('success', __('Client created'));
            $this->reset();
        } catch (Exception $e) {
            $this->dispatch('error', $e->getMessage());
            return;
        }
    }

    /**
     * @param string $id
     * @return void
     */
    public function deleteClient(string $id): void
    {
        Client::destroy($id);
        $this->dispatch('success', 'Client successfully deleted');
    }

    /**
     * @param string $id
     * @return void
     */
    public function updateClient(string $id): void
    {
        $this->edit_mode = true;

        $client = Client::find($id);

        $this->client_id = $client->id;
        $this->type = $client->type;
        $this->tax_type = $client->tax_type;
        $this->name = $client->name;
        $this->registration_code = $client->registration_code;
        $this->address = $client->address;
        $this->phone = $client->phone;
        $this->email = $client->email;
        $this->is_npo = $client->is_npo;
        $this->is_building_older_than_10_years = $client->is_building_older_than_10_years;
    }

    /**
     * @param $value
     * @return void
     */
    public function updatedType($value): void
    {
        $this->tax_type = '';
        $this->dispatch('typeUpdated', ['taxType' => $this->tax_type]);
    }

    /**
     * @return void
     */
    public function hydrate(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
