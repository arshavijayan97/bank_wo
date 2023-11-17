<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('transfer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <!-- resources/views/invoice_form.blade.php -->
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Enter The Details') }}
        </h2>

    </header>

    <form id="myForm" method="post" action="{{ route('transfer') }}" class="mt-6 space-y-6">
        @csrf
 @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

        
    
    <div>
            <x-input-label for="price" :value="__('Amount')" />
            <x-text-input id="price" name="amount" type="text" class="mt-1 block w-full" autocomplete="amount" required   pattern="[0-9]+" title="Please enter a valid number" max="1000000"/>
            <span id="amountError" class="error-message"></span>
            

              @error('quantity')
        <span class="text-danger">{{ $message }}</span>
           @enderror
           <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" autocomplete="email" required   title="Please enter a valid email" />
            <span id="amountError" class="error-message"></span>
            
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

        </div>
    </form>
</section>
                </div>
            </div>
        </div>
    </div>

 

@if(session('success'))
    <script>
        setTimeout(function() {
            document.querySelector('.alert').style.display = 'none';
        }, 1800); 
        
    </script>
@endif
</x-app-layout>















