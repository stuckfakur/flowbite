<?php

use Livewire\Volt\Component;

new class extends Component
{
    use \Livewire\WithPagination;
    use \Jantinnerezo\LivewireAlert\LivewireAlert;

    public $search;
    public $idUser;
    public $member_id, $orderBy, $day_id;
    public $notes;
    public $editForm = false;
    public $titleForm;

    public function with(): array
    {
        return [
            'orders' => \App\Models\Order::search($this->search)->orderBy('updated_at', 'desc')->Paginate(10),
        ];
    }
    public function getUserId($orderId)
    {
        $this->idUser = $orderId;
    }

    public function store()
    {
        $validatedData = $this->validate([
            'member_id' => 'required',
            'orderBy'   => 'nullable',
            'day_id'    => 'nullable',

        ]);
        if (!$validatedData['orderBy']){
            $validatedData['orderBy'] = '';
        }else {
            $validatedData['orderBy'] = $this->orderBy;
        }
        $order = \App\Models\Order::create($validatedData);
        $this->reset();
        $this->alert('success', 'Member created successfully');
        $this->dispatch('crud-modal');
        $this->dispatch('close-modal');

    }

    public function edit()
    {
        $this->editForm = true;
        $this->titleForm = 'Edit Member';
        $this->order = \App\Models\Order::where('id', $this->idUser)->first();
        $this->member_id = $this->order->member_id;
        $this->orderBy = $this->order->orderBy;
        $this->day_id = $this->order->day_id;
    }
    public function update()
    {
        $this->updateForm = true;
        $validatedData = $this->validate([
            'member_id'  => 'nullable',
            'orderBy' => 'nullable',
            'day_id'     => 'required',
        ]);
        if($this->member_id){
            $validatedData['member_id'] = $this->member_id;
        }else {
            unset($validatedData['regency_id']);
        }

        $order = \App\Models\Order::where('id', $this->idUser)->first();
        $order->update($validatedData);
        $this->reset();
        $this->alert('success', 'User edited successfully');
        $this->dispatch('close-modal');

    }

    #[\Livewire\Attributes\On('editNotes')]
    public function editNotes()
    {
        $this->order = \App\Models\Order::where('id', $this->idUser)->with('member')->first();
        $this->notes = $this->order->member->notes;

    }

    public function updateNotes()
    {
        $validatedData['notes'] = $this->notes;
        $order = \App\Models\Order::where('id', $this->idUser)->with('member')->first();
        $order->member->update($validatedData);
        $this->reset();
        $this->alert('success', 'Notes has edited successfully');
        $this->dispatch('close-modal');
        $this->dispatch('close-notemodal');
    }

    public function delete()
    {
        $order = \App\Models\Order::where('id', $this->idUser)->first();
        $order->delete();
        $this->alert('success', 'User deleted successfully');
        $this->dispatch('close-modal');
    }

    public function close()
    {
        $this->reset();
    }

} ?>

<div>
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto max-full px-1 lg:px-4">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input wire:model.live="search" type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search" required="">
                            </div>
                        </form>
                    </div>
                    <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <button type="button" @click="$dispatch('opencreate-membermodal')" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Add Modal
                        </button>
                        <div class="flex items-center space-x-3 w-full md:w-auto">
                            <button id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
                                <svg class="-ml-1 mr-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                </svg>
                                Actions
                            </button>
                            <div id="actionsDropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="actionsDropdownButton">
                                    <li>
                                        <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mass Edit</a>
                                    </li>
                                </ul>
                                <div class="py-1">
                                    <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete all</a>
                                </div>
                            </div>
                            <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400" viewbox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                                </svg>
                                Filter
                                <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                </svg>
                            </button>
                            <div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                                <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Choose brand</h6>
                                <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                                    <li class="flex items-center">
                                        <input id="apple" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="apple" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Apple (56)</label>
                                    </li>
                                    <li class="flex items-center">
                                        <input id="fitbit" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="fitbit" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Microsoft (16)</label>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">No</th>
                            <th scope="col" class="px-4 py-3">Name</th>
                            <th scope="col" class="px-4 py-3">Address & Phone</th>
                            <th scope="col" class="px-4 py-3">Flower</th>
                            <th scope="col" class="px-4 py-3">Total</th>
                            <th scope="col" class="px-4 py-3">City</th>
                            <th scope="col" class="px-4 py-3">Notes</th>
                            <th scope="col" class="px-4 py-3">Send at</th>
                            <th scope="col" class="px-4 py-3">Update at</th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-200">
                                <th scope="row" class="align-top px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->index + $orders->firstItem() }}</th>
                                <td class="align-top px-4 py-3">{{ $order->member->name }}
                                    @if($order->orderBy)
                                        (dari {{ $order->orderBy }})
                                    @endif
                                </td>
                                <td class="align-top px-4 py-3">
                                    <p>{{ $order->member->street }}</p>
                                        <p><b>{{ $order->member->regency->name }}, {{ $order->member->regency->city }}</b></p>
                                    <p>Telp : {{ $order->member->phone }}</p></td>
                                <td class="align-top px-4 py-3"
                                    >
                                    <div
                                        x-data="{ hover : false }"
                                        @mouseover="hover = true"
                                        @mouseleave="hover = false"
                                        class="h-40 max-h-20 hover:bg-blue-200">
                                        {{ $order->member->notes }}
                                        <button
                                            class="grid"
                                            x-show="hover">
                                            <x-icon.edit/>
                                        </button>
                                    </div>
                                </td>
                                <td class="align-top px-4 py-3">{{ $order->member->notes }}</td>
                                <td class="align-top px-4 py-3">{{ $order->member->regency->city }}</td>
                                <td class="align-top px-4 py-3">{{ $order->member->notes }}</td>
                                <td class="align-top text-center px-4 py-3">
                                        {{ $order->day->name }}
                                </td>
                                <td class="align-top px-4 py-3">{{ $order->updated_at->format('d-m-Y H:i:s') }}</td>
                                <td class="align-top px-4 py-3 flex items-center justify-end">
                                    <button
                                        wire:click="getUserId({{ $order->id }})"
                                        @click="$dispatch('openaction-membermodal{{ $order->id }}')"
                                        class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                        type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div
                                        x-data = "{ show : false }"
                                        x-show = "show"
                                        x-on:openaction-membermodal{{ $order->id }}.window = "show = true"
                                        x-on:close-modal.window = "show = false"
                                        {{--                                        @mouseleave="show = false"--}}
                                        @click.outside=" show = false"
                                        @mouseover.away="show = false"
                                        x-transition
                                        style="display:none;"
                                        class="z-20 absolute w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" >

                                            <li>
                                                <a wire:click="edit" @click="$dispatch('opencreate-membermodal')" type="button" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                            </li>
                                        </ul>
                                        <div class="py-1">
                                            <a
                                                @click="$dispatch('opendelete-modal')"
                                                class="block py-2 px-4 bg-red-600 text-white hover:bg-red-800 dark:hover:bg-red-800 dark:hover:text-white"
                                                type="button">
                                                Delete
                                            </a>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <nav class="space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                    {{ $orders->links() }}
                </nav>
            </div>
        </div>
    </section>
    <div x-data="{ open: false }" class="ml-4" @mouseleave="open = false">
        <button @mouseover="open = true" class="border border-primary-900">Category</button>
        <div x-show="open" class="h-80 bg-red-900">
            <ul>
                <li>Sub-category 1</li>
                <li>Sub-category 2</li>
            </ul>
        </div>
    </div>

    <x-modal.order
        :member_id="$member_id"
        :editForm="$editForm"
        :titleForm="$titleForm"/>
    <x-modal.delete/>

</div>
