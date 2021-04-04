<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
            </div>

            <!-- Birthday -->
            <div>
                <x-label for="birthday" :value="__('Birthday')" />

                <x-input id="birthday" class="block mt-1 w-full" type="text" name="birthday" required autofocus />
            </div>

            <!-- Sex -->
            <div>
                <x-label for="sex" :value="__('Sex')" />

                <x-input id="sex" class="block mt-1 w-full" type="text" name="sex" required autofocus />
            </div>

            <!-- Former_job -->
            <div>
                <x-label for="former_job" :value="__('Former_job')" />

                <x-input id="former_job" class="block mt-1 w-full" type="text" name="former_job" required autofocus />
            </div>

            <!-- Job -->
            <div>
                <x-label for="job" :value="__('Job')" />

                <x-input id="job" class="block mt-1 w-full" type="text" name="job" required autofocus />
            </div>

            <!-- School_id -->
            <div>
                <x-label for="school_id" :value="__('School_id')" />

                <x-input id="school_id" class="block mt-1 w-full" type="text" name="school_id" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
