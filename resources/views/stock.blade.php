@extends('template.adminlte.layouts.app')

@section('content')
    <div class="modal fade" id="tambahStok" tabindex="-1" aria-labelledby="tambahStokLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahStokLabel">Stok Masuk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                <form action="" class="form" id="formTambahStok">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">Jumlah</label>
                            <input type="number" class="form-control" name="qty">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Note</label>
                            <input type="text" class="form-control" name="note">
                        </div>
                        <input type="hidden" name="product_id" id="product_id" value="">
                        <input type="hidden" name="category_id" id="category_id" value="">
                        <input type="hidden" name="type" id="type" value="in">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btnTambahstok">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="kurangStok" tabindex="-1" aria-labelledby="kurangStokLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kurangStokLabel">Stok Keluar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                <form action="" class="form" id="formKurangStok">
                    @csrf
                
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">Jumlah</label>
                            <input type="number" class="form-control" name="qty">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Note</label>
                            <input type="text" class="form-control" name="note">
                        </div>
                        <input type="hidden" name="product_id" id="kurang_product_id" value="">
                        <input type="hidden" name="category_id" id="kurang_category_id" value="">
                        <input type="hidden" name="type" id="type" value="out">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btnkurangstok">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card ">
                    <div class="card-body text-center my-auto">
                        <div class="py-2">
                            <h3 class="">Stok Produk</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="mt-2 table table-stripped table-bordered" style="width:100%">
                <thead>
                   
                </thead>
                <tbody id="load">
                </tbody>
            </table>
        </div>
        <div class="row" id="data">
           
        </div>
        
        <div id="link" class="mt-1">
                                    
        </div>
        <div class="mt-1">
        </div>  
    </div>
@endsection

@section('js')
<script>
    var url = "{{ url('/api/product') }}";
    var urlStock = "{{ url('/api/stock') }}";
    var parms;
    loadingTable('#load');
        $(document).on("click", '.next', function() {
            parms = $(this).attr("data-value");
            parms = parms.split('?')[1];
            start(parms);
        });
    function start(parms) {
        if (parms == null) {
                parms = '';
            }else{
                parms = '?'+parms;
            }
        getData(url+parms, token).done(function(response) {
            $('.table').html('');
            isi = ``;
            if (response.data.data.length > 0) {
                nomer = 1;
                img = '';
                $.each(response.data.data, function(i, val) {
                    if (val.image == null) {
                        img = `<img src="{{ asset('images/default.jpg') }}" class="card-img-top" alt="">`;
                        }else{
                        img = `<img src="{{ asset('images/`+val.image+`' ) }}" class="card-img-top" alt="">`;
                        }
                    isi += `
                    <div class="col-md-3 my-3">
                        <div class="card">
                            <div class="card-body">`+
                                img+`<hr>
                                <div class="row">
                                    <div class="col">
                                        `+val.product_name+`
                                    </div>
                                    <div class="col-3" style="text-align:right">
                                        `+val.qty+`
                                    </div> 
                                    
                                </div> 
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        Harga
                                    </div>
                                    <div class="" style="text-align:right">
                                        Rp.`+val.selling_price+`.000
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row mb-3">
                                    <div class="col">
                                        <button type="button" class="btn btn-warning btn-block"
                                           id="btnModals" data-btn="tambahstok" data-id="`+val.id+`" data-value="`+val.category_id+`|">
                                            Stok Masuk
                                        </button>
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-danger w-100"
                                           id="btnModals" data-btn="kurangstok" data-id="`+val.id+`" data-value="`+val.category_id+`|">
                                            Stok Keluar
                                        </button>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col text-center">
                                        <a href="{{ url('stock/' . '`+val.id+`') }}" 
                                        >
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>    
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

        id = $(this).attr("data-id");

        var data = $(this).attr("data-value");
        parm = $(this).attr("data-btn");
        if (parm == 'kurangstok') {
            $('#kurangStokLabel').html('Kurang Stok');
            $('.btnsimpan').html(`<button type="button" class="btn btn-primary btnsimpan" id="btnSimpanUpdate">Simpan</button>`);
            $('#kurang_product_id').val(id);
            $('#kurang_category_id').val(data[0]);
            $('#kurangStok').modal('show');
        }else{
            $('#form').trigger("reset");
            $('#tambahStokLabel').html('Tambah Stok');
            $('.btnsimpan').html(`<button type="button" class="btn btn-primary" id="btnSimpanTambah">Simpan</button>`);
            $('#category_id').val(data[0]);
            $('#product_id').val(id);
            $('#tambahStok').modal('show');
        }
    });

    $(document).on("click", '#btnkurangstok', function() {
        loading('#btnkurangstok',true,'Simpan');
        document.getElementById("btnkurangstok").disabled = true;
        form = $('#formKurangStok');

        postData(urlStock, token, form).done(function(response, responseText, xhr) {
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
                loading('#btnkurangstok',false,'Simpan');
                document.getElementById("btnkurangstok").disabled = false;
            } else {
                $('#exampleModal').modal('hide');
                successAlert(response.message);
                $('#exampleModal').modal('toggle');
                start();
                loading('#btnkurangstok',false,'Simpan');
                document.getElementById("btnkurangstok").disabled = false;
            }
            // successAlert(data.message);
        }).fail(function(jqXHR, textStatus, errorThrown) {
            var err = JSON.parse(jqXHR.responseText);
            errorAlert(err.message);
            loading('#btnkurangstok',false,'Simpan');
            document.getElementById("btnkurangstok").disabled = false;
            // window.location = "{{ url('data-proyek') }}";
            // document.getElementById("btnSimpan").disabled = false;
        });
    });
    
    $(document).on("click", '#btnTambahstok', function() {
        loading('#btnTambahstok',true,'Simpan');
        document.getElementById("btnTambahstok").disabled = true;
        form = $('#formTambahStok');

        postData(urlStock, token, form).done(function(response, responseText, xhr) {
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
                loading('#btnTambahstok',false,'Simpan');
                document.getElementById("btnTambahstok").disabled = false;
            } else {
                $('#exampleModal').modal('hide');
                successAlert(response.message);
                $('#exampleModal').modal('toggle');
                start();
                loading('#btnTambahstok',false,'Simpan');
                document.getElementById("btnTambahstok").disabled = false;
            }
            // successAlert(data.message);
        }).fail(function(jqXHR, textStatus, errorThrown) {
            var err = JSON.parse(jqXHR.responseText);
            errorAlert(err.message);
            loading('#btnTambahstok',false,'Simpan');
            document.getElementById("btnTambahstok").disabled = false;
            // window.location = "{{ url('data-proyek') }}";
            // document.getElementById("btnSimpan").disabled = false;
        });
    });

</script>
@endsection
