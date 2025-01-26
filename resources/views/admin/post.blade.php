@extends('admin.components.main')

@section('main_section')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Forms</h3>
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
                        <a href="#">Forms</a>
                    </li>

                </ul>
            </div>
      
        

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Elements</div>
                        </div>
                        <form action="{{ route('post.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" value="{{ old('title') }}" />
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Content</label>
                                            <textarea class="form-control" id="content" name="content" rows="5"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label><br />
                                            <div class="d-flex">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        value="draft" id="draft" />
                                                    <label class="form-check-label" for="draft">
                                                        Draft
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        value="published" id="published" />
                                                    <label class="form-check-label" for="published">
                                                        Published
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="category">Category select</label>
                                            <select class="form-select" id="categories" name="category_id[]" multiple>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ (is_array(old('category_id')) && in_array($category->id, old('category_id'))) ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button class="btn btn-success">Submit</button>
                                <button class="btn btn-danger">Cancel</button>
                            </div>
                        </form>
                        
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
