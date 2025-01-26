@extends('admin.components.main')

@section('main_section')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Tables</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#">
                            <i class="icon-home"></i>
                        </a>
                    </li>

                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Users</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Add Row</h4>
                               
                            @if ($authors)
                                <button class="btn btn-primary btn-round ms-auto disabled" aria-disabled="true" data-bs-toggle="modal"
                                        data-bs-target="#addRowModal">
                                    <i class="fa fa-plus"></i>
                                    Add Row
                                </button>
                            @else
                                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                        data-bs-target="#addRowModal">
                                    <i class="fa fa-plus"></i>
                                    Add Row
                                </button>
                            @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold">Author Information</span>
                                            </h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="small">
                                                Create a new author using this form, make sure you fill them all
                                            </p>
                                            <form action="{{route('author.store')}}" method="post">

                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Author Name</label>
                                                            <input  type="text" name="name"  class="form-control" placeholder="fill name" />
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Email</label>
                                                            <input type="email" name="email"  class="form-control" placeholder="fill email" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 pe-0">
                                                        <div class="form-group form-group-default">
                                                            <label>Password</label>
                                                            <input type="password" name="password" class="form-control" placeholder="fill password" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default">
                                                            <label>Confirm Password</label>
                                                            <input  type="password" name="password_confirmation" class="form-control" placeholder="fill confirm password" />
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="submit"  class="btn btn-primary">
                                                Submit
                                            </button>
                                        </div>
                                    </form>

                                    </div>
                                </div>
                            </div>

                            <!-- User Edit Modal -->
                            <div class="modal fade" id="EditUserModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold">Author Information</span>
                                            </h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="small">
                                                Create a new author using this form, make sure you fill them all
                                            </p>
                                            <form id="editForm" action="" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <input type="hidden" name="id" id="id">
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Author Name</label>
                                                            <input  type="text" name="name" id="name" class="form-control" placeholder="fill name" />
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Email</label>
                                                            <input type="email" name="email" id="email"  class="form-control" placeholder="fill email" />
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="submit"  class="btn btn-primary">
                                                Submit
                                            </button>
                                        </div>
                                    </form>

                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($authors as $author)
                                        <tr>
                                            <td>{{$author->name}}</td>
                                            <td>{{$author->email}}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <button type="button"  title=""
                                                        class="btn btn-link btn-primary btn-lg" data-bs-toggle="modal"
                                                        data-bs-target="#EditUserModal"
                                                        data-id="{{$author->id}}"
                                                        data-name="{{$author->name}}"
                                                        data-email="{{$author->email}}"
                                                        data-original-title="Edit Task">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" data-bs-toggle="tooltip" title="Remove"
                                                            class="btn btn-link btn-danger user-destroy" data-user-id="{{ $author->id }}">
                                                            <i class="fa fa-times"></i>
                                                     </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <form id="deleteUserForm" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </table>
                                <script>
                                     document.querySelectorAll('.user-destroy').forEach(button => {
                                            button.addEventListener('click', function () {
                                                const userId = this.getAttribute('data-user-id');
                                                const form = document.getElementById('deleteUserForm');
                                                
                                                form.action = `/author/${userId}`;
                                                
                                                if (confirm('Are you sure you want to delete this user?')) {
                                                    form.submit();
                                                }
                                            });
                                        });
                                </script>
                                <script>
                                    document.addEventListener('DOMContentLoaded',function(){
                                        const editModal = document.getElementById('EditUserModal');

                                        document.querySelectorAll('.btn-primary[data-bs-target="#EditUserModal"]').forEach(button=>{
                                            button.addEventListener('click',function(){
                                                const id = this.getAttribute('data-id');
                                                const name = this.getAttribute('data-name');
                                                const email = this.getAttribute('data-email');

                                                editModal.querySelector("#id").value = id;
                                                editModal.querySelector("#name").value = name;
                                                editModal.querySelector("#email").value = email;

                                                const form = editModal.querySelector('#editForm')
                                                form.action = "{{route('author.update',':id')}}".replace(':id',id);
                                            })
                                        })
                                    })
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
