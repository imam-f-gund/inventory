@extends('template.adminlte.layouts.app')

@section('content')
    <div class="container">
        <div class="modal fade" id="tambahproduct" tabindex="-1" aria-labelledby="tambahproductLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahproductLabel">Tambah Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                    </div>
                    <form method="POST" id="formTambah" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group mb-2">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" name="product_name" id="product_name_add">
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Kategori</label>
                                <select class="form-control form-select" name="category_id" id="category_id_add">
                                    <option selected>Pilih Kategori</option>
                                   
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Qty</label>
                                <input type="number" class="form-control" name="qty" id="qty_add">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Brand</label>
                                <input type="text" class="form-control" name="brand" id="brand_add">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Price</label>
                                <input type="number" class="form-control" name="price" id="price_add">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Selling Price</label>
                                <input type="number" class="form-control" name="selling_price" id="selling_price_add">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" id="image_add">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id=btnSimpan>Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="ubahproduct" tabindex="-1" aria-labelledby="ubahproductLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ubahproductLabel">Ubah Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                    </div>
                    <form action="" method="POST" id="formUbah" enctype="multipart/form-data">
                        @csrf
                       
                        <div class="modal-body">
                            <div class="form-group mb-2">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" name="product_name" id="product_name">
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Kategori</label>
                                <select class="form-control form-select" name="category_id" id="category_id">
                                    <option selected>Pilih Kategori</option>
                                  
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Qty</label>
                                <input type="number" class="form-control" name="qty" id="qty">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Price</label>
                                <input type="number" class="form-control" name="price" id="price">
                            </div>
                             <div class="form-group">
                                <label class="form-label">Selling Price</label>
                                <input type="number" class="form-control" name="selling_price" id="selling_price">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Brand</label>
                                <input type="text" class="form-control" name="brand" id="brand">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" id="image">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="btnUbah">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <h2 class="main-title my-auto">Data Produk</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col">
                            <button type="button" id="btnModals" class="btn btn-primary float-right">
                                Tambah
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table id="dataTable" class="mt-2 table table-stripped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Nama Produk</th>
                                        <th>Nama Kategori</th>
                                        <th>QTY</th>
                                        <th>Harga Item</th>
                                        <th>Harga Jual</th>
                                        <th>Brand</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="data">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="link">
                                
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('js')
    <script>
        var url = "{{ url('/api/product') }}";
        var urlCategori = "{{ url('/api/category') }}";
        var parms;
        $(document).on("click", '.next', function() {
            parms = $(this).attr("data-value");
            parms = parms.split('?')[1];
            console.log(parms);
            start(parms);
        });

        function start(parms) {
            loadingTable('#data');
           
            if (parms == null) {
                parms = '';
            }else{
                parms = '?'+parms;
            }
            
            getData(urlCategori, token).done(function(response) {
                isi = ``;
                if (response.data.length > 0) {
                    nomer = 1;
                    
                    $.each(response.data, function(i, val) {
                        
                        isi += `
                        <option value="`+val.id+`">`+val.category_name+`</option>`;
                        nomer++;
                    });
                }

                $('#category_id').html(isi);
                $('#category_id_add').html(isi);
                
            });
            getData(url+parms, token).done(function(response) {
                isi = ``;
                if (response.data.data.length > 0) {
                    nomer = 1;
                    
                    $.each(response.data.data, function(i, val) {
                        if (val.image == null) {
                            image = `<img height="200"
                            src="{{ url('images') }}/default.jpg" />`;
                        }else{
                            image = `<img height="200"
                            src="{{ url('images') }}/`+val.image+`" />`;
                        }
                       
                        isi += `
                        <tr>
                    <td>
                        `+image+`
                    </td>
                    <td>`+val.product_name+`</td>
                    <td>`+val.category.category_name+`</td>
                    <td>`+val.qty+`</td>
                    <td>Rp.`+val.price+`.000</td>
                    <td>Rp.`+val.selling_price+`.000</td>
                    <td>`+val.brand+`</td>
                    <td>
                        <button type="button" class="btn btn-warning btn-sm" data-id="`+val.id+`" id="btnModals" data-btn="edit" data-value="`+val.id+`|`+val.product_name+`|`+val.category_id+`|`+val.qty+`|`+val.brand+`|`+val.price+`|`+val.selling_price+`">
                            <i class="fa fa-edit">Edit</i>
                        </button>

                        <button class="btn btn-danger btn-sm" id="btnHapus" data-id="` + val.id + `">Hapus</button>
                    </td>
                </tr>
                `;
                        nomer++;
                    });

                    link = `<div class="d-flex justify-content-center mt-5">
                        <div class="col-2">
                            <button type="button" class="next btn btn-sm btn-secondary" data-value="`+response.data.prev_page_url+`">
                                    < Prev
                                </button>
                                
                            <button type="button" class="next btn btn-sm btn-secondary" data-value="`+response.data.next_page_url+`">
                                Next >
                            </button>
                            </div>
                                    </div>`;
                }


                $('#data').html(isi);
                $('#link').html(link);
                
            });
        }

        start(parms);


        var id = '';
        $(document).on("click", '#btnModals', function() {

            var data = $(this).attr("data-value");
            id = $(this).attr("data-id");
            console.log(data);
            parm = $(this).attr("data-btn");
            if (parm == 'edit') {
                $('#ubahproductLabel').html('Ubah Produk');
                $('.btnsimpan').html(`<button type="button" class="btn btn-primary btnsimpan" id="btnUbah">Simpan</button>`);
                $('#product_name').val(data.split('|')[1]);
                $('#category_id').val(data.split('|')[2]);
                $('#qty').val(data.split('|')[3]);
                $('#brand').val(data.split('|')[4]);
                $('#price').val(data.split('|')[5]);
                $('#selling_price').val(data.split('|')[6]);
                $('#ubahproduct').modal('show');
            }else{
                $('#form').trigger("reset");
                $('#tambahproductLabel').html('Tambah Produk');
                $('.btnsimpan').html(`<button type="button" class="btn btn-primary" id="btnSimpan">Simpan</button>`);
                $('#tambahproduct').modal('show');
            }
        });

        $(document).on("click", '#btnSimpan', function() {
            loading('#btnSimpan',true,'Simpan');
            document.getElementById("btnSimpan").disabled = true;
        
            var formData = new FormData();
            var fileberkas = $('#image_add').prop('files')[0];
            formData.append('_method', 'POST');

            formData.append('product_name', $('#product_name_add').val());
            formData.append('category_id', $('#category_id_add').val());
            formData.append('qty', $('#qty_add').val());
            formData.append('price', $('#price_add').val());
            formData.append('selling_price', $('#selling_price_add').val());
            formData.append('brand', $('#brand_add').val());
            formData.append('image',  fileberkas);
           
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                headers: {
                    'Authorization': 'Bearer ' + token
                },
                contentType: false,
                processData: false,
                success: function(response) {
                   
                if (response.status === false) {
                    var errVal = response.data.message;
                   
                    loading('#btnsimpan',false,'Simpan');
                    document.getElementById("btnsimpan").disabled = false;
                } else {
                    $('#exampleModal').modal('hide');
                    successAlert(response.message);
                    $('#tambahModal').modal('toggle');
                    start();
                    loading('#btnsimpan',false,'Simpan');
                    document.getElementById("btnsimpan").disabled = false;
                }
            },
                error: function(xhr) {
                    var data = xhr.responseJSON;
                    errorAlert(data.message);
                }
            });
        });

        $(document).on("click", '#btnUbah', function() {
            loading('#btnUbah',true,'Simpan');
            document.getElementById("btnUbah").disabled = true;
            var formData = new FormData();
            var fileberkas = $('#image').prop('files')[0];
            formData.append('_method', 'PUT');

            formData.append('product_name', $('#product_name').val());
            formData.append('category_id', $('#category_id').val());
            formData.append('qty', $('#qty').val());
            formData.append('price', $('#price').val());
            formData.append('selling_price', $('#selling_price').val());
            formData.append('brand', $('#brand').val());
            formData.append('image',  fileberkas);
           
            $.ajax({
                url: url+ '/' +id,
                type: 'POST',
                data: formData,
                headers: {
                    'Authorization': 'Bearer ' + token
                },
                contentType: false,
                processData: false,
                success: function(response) {
                   
                if (response.status === false) {
                    var errVal = response.data.message;
                   
                    loading('#btnUbah',false,'Simpan');
                    document.getElementById("btnUbah").disabled = false;
                } else {
                    $('#exampleModal').modal('hide');
                    successAlert(response.message);
                    $('#tambahModal').modal('toggle');
                    start();
                    loading('#btnUbah',false,'Simpan');
                    document.getElementById("btnUbah").disabled = false;
                }
            },
                error: function(xhr) {
                    var data = xhr.responseJSON;
                    errorAlert(data.message);
                }
            });

        });

        $(document).on("click", '#btnHapus', function() {
            id = $(this).data('id');
            Swal.fire({
                title: "Apakah kamu yakin ?",
                text: "Data akan terhapus di database",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, hapus !",
                cancelButtonText: "Tidak, batalkan !"
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteData(url + '/' + id, token).done(function(data) {
                        start();
                        successAlert(data.message);
                    }).fail(function(e) {
                        var data = e.responseJSON;
                        errorAlert(data.message);
                    });
                } else if (result.isDismissed) {
                    Swal.fire("Dibatalkan", "Data batal dihapus", "error");
                }
            });


        });
    </script>
    @endsection
