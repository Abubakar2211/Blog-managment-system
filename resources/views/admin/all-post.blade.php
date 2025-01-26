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
                                <a class="btn btn-primary btn-round ms-auto"  href="{{route('post.create')}}"><i class="fa fa-plus"></i> Create user</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold"> New</span>
                                                <span class="fw-light"> Row </span>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="small">
                                                Create a new row using this form, make sure you
                                                fill them all
                                            </p>
                                            <form>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Name</label>
                                                            <input id="addName" type="text" class="form-control"
                                                                placeholder="fill name" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 pe-0">
                                                        <div class="form-group form-group-default">
                                                            <label>Position</label>
                                                            <input id="addPosition" type="text" class="form-control"
                                                                placeholder="fill position" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default">
                                                            <label>Office</label>
                                                            <input id="addOffice" type="text" class="form-control"
                                                                placeholder="fill office" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" id="addRowButton" class="btn btn-primary">
                                                Add
                                            </button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Content</th>
                                            <th>Author</th>
                                            <th>Status</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Content</th>
                                            <th>Author</th>
                                            <th>Status</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @php $i = 1; @endphp
                                        @foreach ($posts as $post)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$post->title}}</td>
                                            <td>{{$post->content}}</td>
                                            <td>{{$post->user->name}}</td>
                                            <td>{{$post->status}}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a class="btn btn-link btn-primary " href="{{ route('post.edit', $post) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="button" data-bs-toggle="tooltip" title="Delete"
                                                        class="btn btn-link btn-danger post-destroy" data-post-id="{{ $post->id }}">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <form id="deletePost" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <script>
                                    document.querySelectorAll('.post-destroy').forEach(button => {
                                        button.addEventListener('click', function() {
                                            const postId = this.getAttribute('data-post-id');
                                            const form = document.getElementById('deletePost');
                                
                                            form.action = `/post/${postId}`; 
                                            form.submit();
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
