@props(['editForm', 'titleForm', 'getUserId', 'member_id'])
<div>

    <div
        x-data="{ show : false }"
        x-show="show"
        x-on:opencreate-membermodal.window="show = true"
        x-on:close-modal.window="show = false"
        x-transition
        style="display:none;"
        class="fixed z-30 inset-0">

        {{--    Blank   --}}
        <div class="fixed inset-0 bg-gray-300 opacity-40"></div>
        {{--    Form    --}}
        <div class="bg-white rounded-lg m-auto fixed inset-0 max-w-2xl max-h-28 mb-96 mt-6">
            <div class="relative overflow-y-scroll w-full max-w-2xl">
                <form wire:submit.prevent="{{ $editForm ? 'update' : 'store' }}"
                      class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="flex items-start justify-between p-2 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            {{ $titleForm ?? 'Create User' }}
                        </h3>
                        <button wire:click="close"
                                @click="$dispatch('close-modal')"
                                type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <div class="p-4 space-y-6">
                        <div class="bg-white shadow-lg rounded-lg p-4">
                            {{--  Select Name --}}
                            <div class="col-span-12 md:col-span-12 sm:col-span-6"
                                 id="formDay"
                                 x-data="{ label : 'name', placeholder: 'Type your '}"
                            >
                                <label for="day"
                                       x-text="label.charAt(0).toUpperCase() + label.slice(1)"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                </label>
                                @php
                                    $options = \App\Models\Member::orderBy('name', 'asc')->get()->toArray();
                                    $regencies = \App\Models\Regency::orderBy('city')->get();
                                @endphp
                                <x-simple-select
                                    wire:model.live="member_id"
                                    name="member"
                                    id="member"
                                    :options="$options"
                                    value-field='id'
                                    text-field='name'
                                    placeholder="Select Member"
                                    search-input-placeholder="Search Member"
                                    :searchable="true"
                                    class="form-select">
                                    <x-slot name="customOption">
                                        <span class="float-left mr-2 " x-text="option.name"></span>
                                        <span>(</span>
                                        <span x-text="option.regency_id"></span>
                                        <span>)</span>
                                    </x-slot>
                                </x-simple-select>
                                <x-input-error :messages="$errors->get('member')"/>
                            </div>
                            <div class="grid grid-cols-12 gap-6 mt-2">
                                <div class="col-span-12 md:col-span-6 sm:col-span-6"
                                     x-data="{ label : 'order by', placeholder: 'Type your '}">
                                    <label for="order_by"
                                           x-text="label.charAt(0).toUpperCase() + label.slice(1)"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    </label>
                                    <input wire:model="orderBy" type="text" name="order_by" id="order_by"
                                           class="shadow-sm bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           :placeholder="placeholder + label">
                                    <x-input-error :messages="$errors->get('order_by')"/>

                                </div>
                                <div class="col-span-12 md:col-span-6 sm:col-span-6"
                                     x-data="{ label : 'delivery day', placeholder: 'Type your '}">
                                    <label for="delivery_day"
                                           x-text="label.charAt(0).toUpperCase() + label.slice(1)"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    </label>
                                    @php
                                        $dayOptions = \App\Models\Day::whereNotBetween('id', [1,8])->get()->toArray();
                                    @endphp
                                    <x-simple-select
                                        wire:model="day_id"
                                        name="delivery_day"
                                        id="delivery_day"
                                        :options="$dayOptions"
                                        value-field='id'
                                        text-field='name'
                                        placeholder="Select Day"
                                        search-input-placeholder="Search Day"
                                        :searchable="true"
                                        class="form-select">
                                        <x-slot name="customOption">
                                            <span class="float-left mr-2 " x-text="option.name"></span>
                                            <span>(</span>
                                            <span x-text="moment(option.start_date).format('DD-MM-YYYY')"></span>
                                            <span>-</span>
                                            <span x-text="moment(option.end_date).format('DD-MM-YYYY')"></span>
                                            <span>)</span>
                                        </x-slot>
                                    </x-simple-select>
                                    <x-input-error :messages="$errors->get('delivery_day')"/>

                                </div>
                            </div>
                            @if($member_id)
                                @php
                                    $allMember = \App\Models\Member::where('id', $member_id)->first();
                                @endphp
                                {{--  View Name --}}
                                <div class="rounded bg-gray-200 shadow-lg p-2 grid grid-cols-12 gap-3 mt-2">
                                    <div class="col-span-12 md:col-span-12 sm:col-span-12">
                                        <span class="underline italic">
                                            Member Information :
                                        </span>
                                    </div>
                                    <div class="col-span-12 md:col-span-6 sm:col-span-12"
                                         x-data="{ label : 'name', placeholder: 'Type your '}">
                                        <label for="name"
                                               x-text="label.charAt(0).toUpperCase() + label.slice(1)"
                                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        </label>
                                        <input value="{{ $allMember->name }}" type="text" id="name"
                                               class="shadow-sm bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                               readonly>
                                    </div>

                                    <div class="col-span-12 md:col-span-6 sm:col-span-6"
                                         x-data="{ label : 'phone', placeholder: 'Type your '}">
                                        <label for="phone"
                                               x-text="label.charAt(0).toUpperCase() + label.slice(1)"
                                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        </label>
                                        <input value="{{ $allMember->phone }}" type="text" id="phone"
                                               class="shadow-sm bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                               readonly>
                                    </div>
                                    <div class="col-span-12 md:col-span-12 sm:col-span-6"
                                         x-data="{ label : 'street', placeholder: 'Type your '}">
                                        <label for="street"
                                               x-text="label.charAt(0).toUpperCase() + label.slice(1)"
                                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        </label>
                                        <input value="{{ $allMember->street }}" type="text" id="street"
                                               class="shadow-sm bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                               readonly>
                                    </div>
                                    <div class="col-span-12 md:col-span-12 sm:col-span-6"
                                         x-data="{ label : 'regency', placeholder: 'Type your '}">
                                        <label for="regency"
                                               x-text="label.charAt(0).toUpperCase() + label.slice(1)"
                                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        </label>
                                        <input
                                            value="{{ $allMember->regency->name . ", " . $allMember->regency->city }}"
                                            type="text" id="regency"
                                            class="shadow-sm bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            readonly>
                                    </div>
                                    <div class="col-span-12 md:col-span-12 sm:col-span-6"
                                         x-data="{ label : 'notes', placeholder: 'Type your '}">
                                        <label for="notes"
                                               x-text="label.charAt(0).toUpperCase() + label.slice(1)"
                                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        </label>
                                        <textarea id="message" rows="2"
                                                  class="block p-2.5 w-full text-sm text-gray-900 bg-gray-100 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                  placeholder="Write your thoughts here..." readonly>{{ $allMember->notes }}
                                    </textarea>
                                        @if ($editForm)
                                            <button type="button" wire:click="$dispatch('editNotes')" @click="$dispatch('edit-notemodal')"
                                                    class="flex bg-primary-600 text-white px-2 py-1 rounded mt-1">
                                                <x-icon.edit/>
                                                Edit Notes
                                            </button>
                                        @endif
                                    </div>

                                </div>
                        </div>
                        @endif

                    </div>
                    <div
                        class="flex items-center p-6 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="submit"
                                @click="$dispatch('close-modal')"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            @if($editForm)
                                Save
                            @else
                                Create
                            @endif
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div
        x-data="{ view : false }"
        x-show="view"
        x-on:edit-notemodal.window="view = true"
        x-on:close-notemodal.window="view = false"
        x-transition
        style="display:none;"
        class="fixed z-40 inset-0">
        {{--    Blank   --}}
        <div class="fixed inset-0 bg-gray-300 opacity-40"></div>
        {{--    Form    --}}
        <div class="bg-white rounded-lg m-auto fixed inset-0 max-w-2xl max-h-28 mb-96 mt-6">
            <div class="relative overflow-y-scroll w-full max-w-2xl">
                <form
                      class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="flex items-start justify-between p-2 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            {{ __('Edit Notes') }}
                        </h3>
                        <button wire:click="close"
                                @click="$dispatch('close-notemodal')"
                                type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <x-icon.x/>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <div class="p-4 space-y-6">
                            <div class="col-span-12 md:col-span-12 sm:col-span-6"
                                 x-data="{ label : 'notes', placeholder: 'Type your '}">
                                <label for="notes"
                                       x-text="label.charAt(0).toUpperCase() + label.slice(1)"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                </label>
                                <textarea id="message" rows="2"
                                          wire:model="notes"
                                          class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                          placeholder="Write your thoughts here...">
                                </textarea>
                        </div>
                    </div>
                    <div
                        class="flex items-center p-6 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button wire:click="updateNotes"
                                type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
