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

                            <form method="post" action="{{ route('categories.filtered') }}" class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2" >
                                <div class="col-6">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search" value="{{ old('search') }}" id="search">
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                                </div>

                                <div class="col-3">
                                    <a href="{{ route('categories.create') }}"><button class="btn btn-primary" type="button">Add new</button></a>
                                </div>

                                <div class="col-3">
                                    {{--<button type="submit" class="btn btn-warning">Get tasks</button>--}}
                                </div>

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
                                </tbody>
                            </table>
                                @if($count > 1)

                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item">
                                                <button class="page-link"  type="submit" name="page" value="1" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;&laquo;</span>
                                                    <span class="sr-only">Previous</span>
                                                </button>
                                            </li>
                                            <li class="page-item">
                                                <button class="page-link"  type="submit" name="page" value="{{ old('page') > 1 ? old('page') - 1 : 1 }}" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                    <span class="sr-only">Previous</span>
                                                </button>
                                            </li>

                                            @for($x = 1; $x <= $count; $x++)
                                                <li class="page-item {{ old('page', 1) == $x ? 'active' : ''}}"><button class="page-link" type="submit" name="page" value="{{ $x }}">{{ $x }}</button></li>
                                            @endfor

                                            <li class="page-item">
                                                <button class="page-link"  type="submit" name="page" value="{{ old('page') < $count ? old('page') + 1 : $count }}" aria-label="Previous">
                                                    <span aria-hidden="true">&raquo;</span>
                                                    <span class="sr-only">Previous</span>
                                                </button>
                                            </li>
                                            <li class="page-item">
                                                <button class="page-link"  type="submit" name="page" value="{{ $count }}"  aria-label="Next">
                                                    <span aria-hidden="true">&raquo;&raquo;</span>
                                                    <span class="sr-only">Next</span>
                                                </button>
                                            </li>
                                        </ul>
                                    </nav>

                                @endif
                            </form>

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
