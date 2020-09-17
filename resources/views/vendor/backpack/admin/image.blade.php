@extends(backpack_view('blank'))

@section('content')
    <div class="card-header">
        <a href="http://cover.todo.com/admin/cover" class="btn btn-sm btn-danger">Back</a> Get Cover
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form class="form" method="POST" action="{{ backpack_url('post-image') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Nhập địa chỉ folder: </label>
                            <input type="text" name="ulr" id="" class="form-control mb-2" placeholder="">
                            <input id="upload" name="content" type="file" value="Input" directory webkitdirectory/>
                        </div>
                        <div class="d-flex">
                            <select class="form-control" name="type" id="type">
                                <option value="again">Quét lại từ đầu</option>
                                <option value="continue">Quét tiếp</option>
                            </select>
                            <input type="number" name="number" id="" class="form-control ml-3 " placeholder="Giớ hạn file">
                            <button type="submit" class="btn btn-primary ml-3 w-50">Quét</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    <div>
                        <table class="bg-white table table-striped table-hover nowrap rounded shadow-xs border-xs mt-2 dataTable dtr-inline">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Đường dẫn</th>
                                <th>Ảnh</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($items))
                                @foreach($items as $key => $value)
                                    <tr>
                                        <td >{{ $key+1 }}</td>
                                        <td>{{ $value['file'] }}</td>
                                        <td><img width="60px"  src="{{ asset($value['avatar']) }}" alt=""></td>
                                        <td><button data-id="{{ $key }}"  data-file="{{ $value['file'] }}" data-avatar="{{ asset($value['avatar']) }}" id="push-post-new"  class="push-post btn btn-primary btn-sm" style="color:#fff">Đăng wp</button></td>
                                    </tr>

                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        @if(!empty($items))
                            {!! $items->links() !!}
                        @endif
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection

@section('after_styles')

@endsection

@section('after_scripts')
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"  ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
    <script type="text/javascript">

    </script>
@endsection
