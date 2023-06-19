<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            {{--<h2 class="text-lg font-medium text-gray-900">--}}
                                {{--{{ __('Profile Information') }}--}}
                            {{--</h2>--}}

                            {{--<p class="mt-1 text-sm text-gray-600">--}}
                                {{--{{ __("Update your account's profile information and email address.") }}--}}
                            {{--</p>--}}
                        </header>

                        {{--<form id="send-verification" method="post" action="{{ route('verification.send') }}">--}}
                            {{--@csrf--}}
                        {{--</form>--}}

                        <form method="post" action="{{ route('products.store') }}" class="mt-6 space-y-6"  enctype="multipart/form-data">
                            @csrf

                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"  required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="price" :value="__('Price')" />
                                <x-text-input id="price" name="price" type="text" class="mt-1 block w-full" required autocomplete="price" />
                                <x-input-error class="mt-2" :messages="$errors->get('price')" />

                            </div>

                            <div>
                                <x-input-label for="is_active" :value="__('Is active')" />
                                <input id="is_active" name="is_active" type="checkbox" checked class="mt-1 block border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" />
                                <x-input-error class="mt-2" :messages="$errors->get('is_active')" />

                            </div>

                            <div>
                                <x-input-label for="in_stock" :value="__('In stock')" />
                                <input id="in_stock" name="in_stock" type="checkbox" checked class="mt-1 block border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"/>
                                <x-input-error class="mt-2" :messages="$errors->get('in_stock')" />

                            </div>

                            <div>
                                <x-input-label for="quantity" :value="__('Quantity')" />
                                <x-text-input id="quantity" name="quantity" type="text" class="mt-1 block w-full" required autocomplete="quantity" />
                                <x-input-error class="mt-2" :messages="$errors->get('quantity')" />
                            </div>

                            <div>
                                <x-input-label for="pic" :value="__('Pic')" />
                                <input id="pic" name="pic" type="file" class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('pic')" />

                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>Save</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            {{--<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">--}}
                {{--<div class="max-w-xl">--}}
                    {{--@include('profile.partials.update-password-form')--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">--}}
                {{--<div class="max-w-xl">--}}
                    {{--@include('profile.partials.delete-user-form')--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>

</x-app-layout>
