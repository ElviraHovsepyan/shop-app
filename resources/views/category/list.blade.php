<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List of categories') }}
        </h2>
    </x-slot>

    <section class="vh-100" style="background-color: #eee;">
        <div class="container">
            <div class="row">
                <div class="col col-lg-12">
                    <div class="card rounded-3">
                        <div class="card-body p-4">

                            {{--<h4 class="text-center my-3 pb-3">To Do App</h4>--}}

                            <form class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2">
                                <div class="col-6">
                                    <div class="form-outline">
                                        <input type="text" id="form1" class="form-control" />
                                        {{--<label class="form-label" for="form1">Enter a task here</label>--}}
                                    </div>
                                </div>

                                <div class="col-3">
                                    <a href="{{ route('categories.create') }}"><button class="btn btn-primary" type="button">Add new</button></a>
                                </div>

                                <div class="col-3">
                                    {{--<button type="submit" class="btn btn-warning">Get tasks</button>--}}
                                </div>
                            </form>

                            <table class="table mb-4">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Category name</th>
                                    <th scope="col">Parent</th>
                                    <th scope="col">Path</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <th scope="row">{{ $category->id }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->parent ? $category->parent->name : '' }}</td>
                                    <td>{{ $category->path }}</td>
                                    <td>
                                        <a href="{{ route('categories.edit', $category->id) }}"><button type="button" class="btn btn-success ms-1">Edit</button></a>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#categoryModal">Remove</button>
                                    </td>
                                </tr>
                                @endforeach

                                {{--<ul>--}}
                                    {{--@foreach ($categories as $category)--}}
                                        {{--<li>{{ $category->name }}</li>--}}
                                        {{--<ul style="margin-left: 40px">--}}
                                            {{--@foreach ($category->childrenCategories as $childCategory)--}}
                                                {{--@include('category/child-category', ['child_category' => $childCategory])--}}
                                            {{--@endforeach--}}
                                        {{--</ul>--}}
                                    {{--@endforeach--}}
                                {{--</ul>--}}

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to remove this category?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="{{ route('categories.delete', $category->id) }}"><button type="button" class="btn btn-primary">Yes</button></a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
