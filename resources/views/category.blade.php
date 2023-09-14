@extends('template.adminlte.layouts.app')

@section('content')
    <div class="container">

         <!-- Modal -->
        <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="form" id="form">
                            @csrf
                            <div class="form-group">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" class="form-control" name="category_name" id="category_name">
                            </div>   
                            
                        </form>
                        <div id="tmbdata"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <div class="btnsimpan"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col">
                <h2 class="main-title my-auto">Data Kategori Produk</h2>
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
                                        <th>No</th>
                                        <th>Nama Kategori</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="data">
                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('js')
    <script>
        var url = "{{ url('/api/category') }}";

        function start() {
            loadingTable('#data');
        
            getData(url, token).done(function(response) {
                isi = ``;
                if (response.data.length > 0) {
                    nomer = 1;
                    
                    $.each(response.data, function(i, val) {
                        
                        isi += `
                    <tr>
                        <td>` + nomer + `</td>
                        <td>` + val.category_name + `</td>
                        <td>
                            <button class="btn btn-warning btn-sm" id="btnModals"  data-btn="edit" data-id="` + val.id + `" data-value="`+val.category_name+`">Edit</button>
                            <button class="btn btn-danger btn-sm" id="btnHapus" data-id="` + val.id + `">Hapus</button>
                        </td>
                    </tr>
                `;
                        nomer++;
                    });
                }

                $('#data').html(isi);
                
            });
        }

        start();


        var id = '';
        $(document).on("click", '#btnModals', function() {

            id = $(this).attr("data-id");

            var data = $(this).attr("data-value");
            parm = $(this).attr("data-btn");
            if (parm == 'edit') {
                $('#exampleModalLabel').html('Ubah Kategori');
                $('.btnsimpan').html(`<button type="button" class="btn btn-primary btnsimpan" id="btnSimpanUpdate">Simpan</button>`);
                $('#category_name').val(data.split('|')[0]);
                $('#exampleModal').modal('show');
            }else{
                $('#form').trigger("reset");
                $('#exampleModalLabel').html('Tambah Kategori');
                $('.btnsimpan').html(`<button type="button" class="btn btn-primary" id="btnSimpanTambah">Simpan</button>`);
                $('#exampleModal').modal('show');
            }
        });

        $(document).on("click", '#btnSimpanTambah', function() {
            loading('#btnSimpanTambah',true,'Simpan');
            document.getElementById("btnSimpanTambah").disabled = true;
            form = $('#form');

            postData(url, token, form).done(function(response, responseText, xhr) {
                if (xhr.status === 201) {
                    var errVal = response.data.message;
                    $.each(errVal, function(i, val) {
                        $('label[for="' + i + '"]').addClass('text-danger');
                        let input = document.getElementById(i)
                        let messageInput = document.getElementById(i + "Help");
                        messageInput.style.display = "block";
                        messageInput.innerHTML = val;
                        input.classList.add('is-invalid');
                        input.classList.add('text-danger');
                    });
                    loading('#btnSimpanTambah',false,'Simpan');
                    document.getElementById("btnSimpanTambah").disabled = false;
                } else {
                    $('#exampleModal').modal('hide');
                    successAlert(response.message);
                    $('#exampleModal').modal('toggle');
                    start();
                    loading('#btnSimpanTambah',false,'Simpan');
                    document.getElementById("btnSimpanTambah").disabled = false;
                }
                // successAlert(data.message);
            }).fail(function(jqXHR, textStatus, errorThrown) {
                var err = JSON.parse(jqXHR.responseText);
                errorAlert(err.message);
                loading('#btnSimpanTambah',false,'Simpan');
                document.getElementById("btnSimpanTambah").disabled = false;
                // window.location = "{{ url('data-proyek') }}";
                // document.getElementById("btnSimpan").disabled = false;
            });
        });

        $(document).on("click", '#btnSimpanUpdate', function() {
            loading('#btnSimpanUpdate',true,'Simpan');
            document.getElementById("btnSimpanUpdate").disabled = true;
            form = $('#form');

            updateData(url+'/'+id, token, form).done(function(response, responseText, xhr) {
                if (xhr.status === 201) {
                    var errVal = response.data.message;
                
                    $.each(errVal, function(i, val) {
                        $('label[for="' + i + '"]').addClass('text-danger');
                        let input = document.getElementById(i)
                        let messageInput = document.getElementById(i + "Help");
                        messageInput.style.display = "block";
                        messageInput.innerHTML = val;
                        input.classList.add('is-invalid');
                        input.classList.add('text-danger');
                    });
                    loading('#btnSimpanUpdate',false,'Simpan');
                    document.getElementById("btnSimpanUpdate").disabled = false;
                } else {
                    successAlert(response.message);
                    $('#exampleModal').modal('toggle');
                    start();
                    loading('#btnSimpanUpdate',false,'Simpan');
                    document.getElementById("btnSimpanUpdate").disabled = false;
                }
                // successAlert(data.message);
            }).fail(function(jqXHR, textStatus, errorThrown) {
                var err = JSON.parse(jqXHR.responseText);
                errorAlert(err.message);
                $('#exampleModal').modal('toggle');
                loading('#btnSimpanUpdate',false,'Simpan');
                document.getElementById("btnSimpanUpdate").disabled = false;
                // window.location = "{{ url('data-proyek') }}";
                // document.getElementById("btnSimpanUpdate").disabled = false;
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
