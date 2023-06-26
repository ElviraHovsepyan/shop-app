<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add category') }}
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

                        <form method="post"  class="mt-6 space-y-6"  enctype="multipart/form-data">
                            @csrf

                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"  required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <ul class="list-group">
                                @foreach ($categories as $category)
                                    <li class="list-group-item">
                                        <input id="in_stock" name="checkboxes" type="radio" data-id="{{ $category->id }}" class="mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"/>
                                        <span style="margin-left: 10px">{{ $category->name }}</span>
                                    </li>
                                    <ul style="margin-left: 40px" class="list-group">
                                        @foreach ($category->childrenCategories as $childCategory)
                                            @include('category/child-category', ['child_category' => $childCategory, 'type' => 'radio'])
                                        @endforeach
                                     </ul>
                                @endforeach
                                </ul>
                            </div>

                            <div class="flex items-center gap-4">
                                <button id="saveCategory" type="button">Save</button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
