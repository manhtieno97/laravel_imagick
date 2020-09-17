@extends(backpack_view('blank'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('success'))
                    <p class="alert alert-success">{{Session::get('success')}}</p>
                @endif
                @if (Session::has('error'))
                    <p class="alert alert-danger">{{Session::get('error')}}</p>
                @endif
                <div class="card">
                    <div class="card-header">
                        Imagick @if(!empty($info)) $info:@endif
                    </div>
                    <div class="card-body " id="imagick">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="/admin/image" method="post" class="row" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="col-md-6">
                                        <input required  id="img" type="file" class=" d-none" name="images"  multiple onchange="changeImg(this)">
                                        <img id="avatar" class="img-thumbnail " width="500px"  @if(!empty($name)) src="{{ url('images').'/'.$name }}"  @else src="{{url('img')}}/no-ig.png"   @endif >
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info @if(!empty($info)) d-block  @else d-none  @endif ">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th>Tên thông số</th>
                                                <th>Giá trị</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(!empty($info))
                                                @foreach($info as $key => $value)
                                                    <tr>
                                                        <td>{{ $key }}</td>
                                                        <td>{{ $value }}</td>

                                                    </tr>

                                                @endforeach
                                            @endif

                                            </tbody>
                                        </table>
                                        </div>
                                        <div class="image-new @if(!empty($name_new)) d-block  @else d-none  @endif ">
                                            <img id="avatar-new" class="img-thumbnail" width="500px" @if(!empty($name_new)) src="{{ url('storage/images/').'/'.$name_new }}"  @else src="{{url('img')}}/no-ig.png"   @endif  >
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <select class="form-control mb-2" name="type" id="type">
                                            <option value="">-- Chọn --</option>
                                            <option value="edit_image">Chỉnh sửa ảnh</option>
                                            <option value="boder">Border ảnh</option>
                                            <option value="info">Thông tin ảnh</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 d-none" id="edit">
                                        <div class="row mb-2">
                                            <div class="col-2">
                                                <input class="mt-2" type="checkbox" name="border" value="1"> Border  :
                                            </div>
                                            <div class="col-2">
                                                <input class="form-control" type="color" value="#563d7c" name="border_color" >
                                            </div>
                                            <div class="col-2">
                                                <input class="form-control" type="number" value="10" name="border_width" >
                                            </div>
                                            <div class="col-2">
                                                <input class="form-control" type="number" value="10" name="border_height"  >
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-2">
                                                <input class="mt-2" type="checkbox" name="rotate" value="1"> Rotate  :
                                            </div>
                                            <div class="col-2">
                                                <input class="form-control" type="color" value="#563d7c" name="rotate_color" >
                                            </div>
                                            <div class="col-2">
                                                <input class="form-control" type="number" value="90" name="rotate_number"  >
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-2">
                                                <input class="mt-2" type="checkbox" name="gotham" value="1"> Ảnh đen trắng  :
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>

                        </div>
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
        $(document).ready(function() {
            $('#avatar').click(function(){
                $('#img').click();
            });
            $('#type').change(function (){
                var type = $('#type').val();

                if($('#type').val() == 'edit_image'){
                    console.log(type);
                    $('#edit').addClass('d-block');
                    $('#edit').removeClass('d-none');
                }else {
                    $('#edit').removeClass('d-block');
                    $('#edit').addClass('d-none');
                }

            })

        });
        function changeImg(input){
            //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
            if(input.files && input.files[0]){
                var reader = new FileReader();
                //Sự kiện file đã được load vào website
                reader.onload = function(e){
                    //Thay đổi đường dẫn ảnh
                    $('#avatar').attr('src',e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
