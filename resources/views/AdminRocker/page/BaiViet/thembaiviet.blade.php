<div class="modal fade bd-example-modal-xl" id="themModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <form id="formbaiviet" method="post" action="/admin/baiviet" enctype="multipart/form-data">@csrf
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Thêm bài viết</h3>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <div class="form-group mt-3 d-flex justify-content-between">
              <div class="col-md-6 p-1 form-group-item">
                <label>Tiêu đề</label>
                <input name="ten_bai_viet" type="text" class="form-control" placeholder="Nhập vào Tiêu đề" required>
              </div>
              <div class="col-md-6 p-1 form-group-item">
                <label>Loại tin</label>
                <select name="loai_tin" id="" class="form-control" required>
                  <option value="1">Khuyến mãi</option>
                  <option value="2">Tin tức mới</option>
                  
                </select>
              </div>


            </div>
            <div class="form-group mt-3">
              <label>Mô tả ngắn</label>
              <div class="input-group form-group-item">
                <textarea name="mo_ta_ngan" class="form-control" id="" cols="20" rows="3"required></textarea>
              </div>
            </div>


            <div class="form-group mt-3">
              <label>Ảnh đại diện</label>
              <div class="input-group form-group-item">
                <input id="hinh_anh" class="form-control" type="file" accept="image/*" name="hinh_anh" multiple required>
              </div>
            </div>

            <div class="form-group mt-3 form-group-item">
              <label>Nội dung</label>
              <textarea name="noi_dung" id="noi_dung" class="form-control ckeditor" cols="30" rows="10" required></textarea>

            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="px-4 py-2 text-1sm font-medium leading-5 rounded-full text-black transition-colors duration-150 bg-gray-100 border border-transparent rounded-lg active:bg-gray-100 hover:bg-gray-100 focus:outline-none focus:shadow-outline-purple" data-bs-dismiss="modal">Huỷ</button>
            <button type="submit" class="px-4 py-2 text-1sm font-medium leading-5 rounded-full text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Thêm Bài Viết</button>
          </div>
        </form>
      </div>
    </div>
  </div>