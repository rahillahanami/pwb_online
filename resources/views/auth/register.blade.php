<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" name="email" type="email" required
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" autocomplete="email">

            <p id="email-error" class="mt-1 text-sm text-red-600 hidden"></p>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        const emailInput = document.getElementById('email');
        const errorMsg = document.getElementById('email-error');

        emailInput.addEventListener('input', function() {
            const email = emailInput.value;
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            errorMsg.classList.add('hidden');

            // Cek format
            if (!emailPattern.test(email)) {
                errorMsg.textContent = "Format email tidak valid.";
                errorMsg.classList.remove('hidden');
                return;
            }

            // Cek ke server (AJAX)
            fetch(`/cek-email?email=${email}`)
                .then(res => res.json())
                .then(data => {
                    if (data.exists) {
                        errorMsg.textContent = "Email sudah digunakan.";
                        errorMsg.classList.remove('hidden');
                    }
                })
                .catch(() => {
                    errorMsg.textContent = "Gagal memeriksa email.";
                    errorMsg.classList.remove('hidden');
                });
        });
    </script>

</x-guest-layout>
