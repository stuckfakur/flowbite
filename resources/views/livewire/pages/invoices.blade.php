<?php

    use Livewire\Volt\Component;

new class extends Component{

    public function with():array
    {
        return [
            'regencies' => \App\Models\Regency::all()
        ];
    }
}



?>




<div x-data="{ selectedCity: '' }" x-init="select2Alpine">
    <select x-ref="select" data-placeholder="Select a City">
        <option></option>
        @foreach($regencies as $regency)
            <option value="{{ $regency->id }}">{{ $regency->name }}</option>
        @endforeach
    </select>
</div>




@push('script')
    <script>
        function select2Alpine() {
            this.select2 = $(this.$refs.select).select2();
            this.select2.on("select2:select", (event) => {
                this.selectedCity = event.target.value;
            });
            this.$watch("selectedCity", (value) => {
                this.select2.val(value).trigger("change");
            });
        }
    </script>
@endpush
