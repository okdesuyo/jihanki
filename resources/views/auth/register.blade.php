<x-guest-layout>
  <div class="text-center text-lg">ユーザー新規登録画面</div>

  <form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
    {{-- <div>
      <x-input-label for="name" :value="__('Name')" />
      <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus
        autocomplete="name" />
      <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div> --}}

    <!-- Email Address -->
    <div class="mt-4">
      <x-input-label for="email" :value="__('メールアドレス')" />
      <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
        autocomplete="username" />
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
      <x-input-label for="password" :value="__('パスワード')" />

      <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
        autocomplete="new-password" />

      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Confirm Password -->
    {{-- <div class="mt-4">
      <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

      <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"
        required autocomplete="new-password" />

      <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div> --}}

    <div class="flex items-center justify-end mt-8">
      <a href="{{ route('login') }}">
        <x-secondary-button class=" ml-4">
          {{ __('戻る') }}
        </x-secondary-button>
      </a>

      <x-primary-button class="ml-4">
        {{ __('新規登録') }}
      </x-primary-button>
    </div>
  </form>
</x-guest-layout>