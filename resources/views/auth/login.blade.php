<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <div class="mb-4 font-medium text-sm text-green-600">
            Hello!
        </div>

        <div class="flex flex-col mt-8">
            <a href="{{ route('saml2_login', ['wso2is']) }}"
                class="px-4 py-2 text-sm font-semibold text-center text-white bg-blue-500 rounded hover:bg-blue-700">
                Login with WSO2IS
            </a>
        </div>

    </x-jet-authentication-card>
</x-guest-layout>
