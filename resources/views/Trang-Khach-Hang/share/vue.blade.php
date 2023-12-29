
tai_gio_hang() {
    axios.get('/khach-hang/hien-thi-ds-gio-hang')
        .then((res) => {
            this.ds_gio_hang = res.data.gio_hang;
            this.tong_tien_tat_ca = res.data.tong_tien_tat_ca;
            this.tong_so_luong = res.data.tong_so_luong;
        });
},
them_so_luong(id) {
    axios.post('/khach-hang/them-so-luong/' + id)
        .then((res) => {
            if (res.data.status) {
                toastr.success(res.data.message);
                this.tai_gio_hang();
            } else {
                toastr.error('Có lỗi không mong muốn!');
            }

        });
},
tru_so_luong(id) {
    axios
        .post('/khach-hang/tru-so-luong/' + id)
        .then((res) => {
            if (res.data.status) {
                toastr.success(res.data.message);
                this.tai_gio_hang();
            } else {
                toastr.error('Có lỗi không mong muốn!');
            }
        });
},
xoa_san_pham_gio_hang(id) {
    axios
        .post('/khach-hang/xoa-san-pham-gio-hang/' + id)
        .then((res) => {
            if (res.data.status) {
                toastr.success(res.data.message);
                this.tai_gio_hang();
            } else {
                toastr.error('Có lỗi không mong muốn!');
            }
        });
},
    formatCurrency(value) {
        const formatter = new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND',
        });
        return formatter.format(value);
    },
    
    
    gui_tim_kiem() {
        if (this.tim_kiem == "") {
            this.ds_tim_kiem = [];
            return;
        }
        axios.post('/tim-kiem-nang-cao', {
                tim_kiem: this.tim_kiem,
            })
            .then((res) => {
                if (res.data.status) {
                    console.log("Giá trị của this.tim_kiem trong kiểm tra:", this.tim_kiem);
                    this.ds_tim_kiem = res.data.ds_tim_kiem;
                } else {
                    toastr.error('Có lỗi không mong muốn!');
                }
            })
            .catch((error) => {
                toastr.error('Có lỗi khi gửi yêu cầu!');
                console.error(error);
            });
    },
