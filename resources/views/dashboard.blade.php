<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Verify Bank Account Name') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <h3 class="font-semibold text-xl text-gray-800 leading-tight"></h3>

          @if (session('message'))
            <div class="font-semibold text-xl text-gray-800 leading-tight">Message: {{session('message')}}</div>
          @endif

          @if (session('user_account_name'))
            <div class="font-semibold text-xl text-gray-800 leading-tight">
              Bank Account Name: {{session('user_account_name')}}
            </div>
          @endif
        
          <form action="{{ route('verify') }}" method="POST" onsubmit="loadSpinner()">
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
            
            <img id="processing" style="display: none;" src="{{url('images/spinning.gif')}}" height="10%" width="10%" alt="loading...">
            
            <x-button id="verify">
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
  
  <script>
    function loadSpinner() {
      let processing_img = document.getElementById('processing');
      let verify_btn = document.getElementById("verify");
      if (verify_btn.style.display === "none") {
        verify_btn.style.display = "block";
      } else {
        verify_btn.style.display = "none";
        processing_img.style.display = "block";
      }
    }
  </script>
</x-app-layout>
