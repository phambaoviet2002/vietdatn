<div class="modal fade bd-example-modal-xl" id="show{{$baiviet->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Xem bài viết</h3>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h1>{{$baiviet->ten_bai_viet}}</h1>
                <em>Ngày đăng: {{$baiviet->created_at}}</em>
                <img height="50px" max-width="100px" src="{{ asset('img/') }}/{{$baiviet->hinh_anh}}" title="{{$baiviet->hinh_anh}}">

                {!! html_entity_decode($baiviet->noi_dung) !!}
            </div>
        </div>
    </div>
</div>