@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Menu Group and Menu Item</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Menu Group Management</h2>

            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Menu Group List</h4>
                            <div class="card-header-action">
                                <a class="btn btn-icon icon-left btn-primary" href="{{ route('menu-group.create') }}">Create
                                    New Menu Group</a>
                                {{-- <a class="btn btn-info btn-primary active import">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                    Import dataName</a> --}}
                                {{-- <a class="btn btn-info btn-primary active" href="{{ route('menu-group.export') }}">
                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                    Export dataName</a> --}}
                                <a class="btn btn-info btn-primary active search"> <i class="fa fa-search"
                                        aria-hidden="true"></i> Search Menu Group</a>
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- <div class="show-import" style="display: none">
                                <div class="custom-file">
                                    <form action="{{ route('menu-group.import') }}" method="post"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <label class="custom-file-label" for="file-upload">Choose File</label>
                                        <input type="file" id="file-upload" class="custom-file-input" name="import_file">
                                        <br /> <br />
                                        <div class="footer text-right">
                                            <button class="btn btn-primary">Import File</button>
                                        </div>
                                    </form>
                                </div>
                            </div> --}}
                            <div class="show-search mb-3" style="display: none">
                                <form id="search" method="GET" action="{{ route('menu-group.index') }}">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="role">Group</label>
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="Group Name">
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                        <a class="btn btn-secondary" href="{{ route('menu-group.index') }}">Reset</a>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Permission</th>
                                            <th>Position</th>
                                            <th class="text-right">Action</th>
                                            <th>Up Action Position</th>
                                            {{-- <th>Down Action Position</th> --}}
                                        </tr>
                                        @foreach ($menuGroups as $key => $item)
                                            <tr>
                                                <td>{{ $menuGroups->firstItem() + $key }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->permission_name }}</td>
                                                <td>{{ $item->position }}</td>
                                                <td class="text-right">
                                                    <div class="d-flex justify-content-end">
                                                        <a href="{{ route('menu-group.edit', $item->id) }}"
                                                            class="btn btn-sm btn-info btn-icon "><i
                                                                class="fas fa-edit"></i>
                                                            Edit</a>
                                                        <form action="{{ route('menu-group.destroy', $item->id) }}"
                                                            method="POST" class="ml-2">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}">
                                                            <button class="btn btn-sm btn-danger btn-icon "><i
                                                                    class="fas fa-times"></i> Delete </button>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($key > 0)
                                                        <form action="{{ route('menu-group.move-up', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-success"><i
                                                                    class="fas fa-arrow-up"></i></button>
                                                        </form>

                                                    @endif
                                                    @if ($key < count($menuGroups) - 1)
                                                    <form action="{{ route('menu-group.move-down', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-warning" style="margin-left:50px"><i
                                                                class="fas fa-arrow-down"></i></button>
                                                    </form>
                                                @endif
                                                </td>
                                                
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{ $menuGroups->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('customScript')
    <script>
        $(document).ready(function() {
            $('.import').click(function(event) {
                event.stopPropagation();
                $(".show-import").slideToggle("fast");
                $(".show-search").hide();
            });
            $('.search').click(function(event) {
                event.stopPropagation();
                $(".show-search").slideToggle("fast");
                $(".show-import").hide();
            });
            //ganti label berdasarkan nama file
            $('#file-upload').change(function() {
                var i = $(this).prev('label').clone();
                var file = $('#file-upload')[0].files[0].name;
                $(this).prev('label').text(file);
            });
        });
    </script>
@endpush

@push('customStyle')
@endpush
