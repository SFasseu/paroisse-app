@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
                        <div class="mb-3 mb-sm-0">
                            <h4 class="card-title fw-semibold">Person</h4>
                            <p class="card-subtitle">All people</p>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle text-nowrap mb-0">
                            <thead>
                                <tr class="text-muted fw-semibold">
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="border-top">
                                @foreach ($people as $key => $person)
                                    <tr>
                                        <td>
                                            <p class="mb-0 fs-3">{{ ++$key }}</p>
                                        </td>
                                        <td>
                                            <p class="fs-3 text-dark mb-0">{{ $person->firstname .' '. $person->lastname }}</p>
                                        </td>
                                        <td>
                                            <p class="fs-3 text-dark mb-0">{{ $person->email }}</p>
                                        </td>
                                        <td>
                                            <a href="{{ route('person.show',['person'=>$person->id]) }}"><span class="badge fw-semibold py-1 w-85 bg-primary-subtle text-primary">Show</span></a>
                                            <a href="{{ route('person.edit',['person'=>$person->id]) }}"><span class="badge fw-semibold py-1 w-85 bg-warning-subtle text-warning">Edit</span></a>
                                            <form action="" method="post">
                                                <button href=""><span class="badge fw-semibold py-1 w-85 bg-danger-subtle text-danger">Delete</span></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection