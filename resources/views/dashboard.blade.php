<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <h3 class="font-semibold text-xl text-gray-800 leading-tight">Verify Bank Account Name</h3>

          @if (session('message'))
            <div>Message: {{session('message')}}</div>
          @endif

          @if (session('user_account_name'))
            <div>
              Bank Account Name: {{session('user_account_name')}}
            </div>
          @endif
        
          <form action="{{ route('verify') }}" method="POST">
            @csrf
            <div>
              <label for="user_account_name">Bank Account Name: </label>
              <input type="text" name="user_account_name" placeholder="Stand to End Rape Initiative" required value="{{old('user_account_name')}}">
            </div>
            <div >
              <label for="user_account_number">Bank Account Number: </label>
              <input type="text" name="user_account_number" placeholder="0157148304" required value="{{old('user_account_number')}}">
            </div>
            <div >
              <label for="user_bank_code">Select Bank: </label>
              <select name="user_bank_code" required>
                <option selected disabled>Select Bank</option>
                <option value="068">Standard Chartered Bank</option>
                <option value="058">GTB</option>
                <option value="057">Zenith</option>
                <option value="032">Union Bank</option>
              </select>
            </div>
            
            <x-button class="ml-3">
              {{ __('Verify') }}
            </x-button>
          </form>

          @if ($errors->any())
            @foreach ($errors->all() as $error)
              <div class="alert alert-danger" role="alert">
                <span>{{ $error }}</span>
              </div>
            @endforeach
          @endif
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
