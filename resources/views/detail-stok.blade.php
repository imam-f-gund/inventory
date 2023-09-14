@extends('template.adminlte.layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <h2 class="main-title my-auto" id="title_product"></h2>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-stripped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width: 15%">Tanggal</th>
                                        <th>Jenis</th>
                                        <th>Qty</th>
                                        <th>Nilai</th>
                                        <th>Note</th>
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
        var url = "{{ url('/api/stock') }}";
        var id_parm  = window.location.href.split('/').reverse()[0]
       
        function start() {
            loadingTable('#data');
        
            getData(url+'/'+id_parm, token).done(function(response) {
                isi = ``;

                $('#title_product').html('Data History Stok '+response.data.product.product_name);
                if (response.data.stock.length > 0) {
                    nomer = 1;
                    type = '';
                    $.each(response.data.stock, function(i, val) {
                        
                        if(val.type == 'in'){
                            type = `<span class="badge text-bg-success">Masuk</span>`;
                        }else{
                            type = `<span class="badge text-bg-danger">Keluar</span>`;
                        }

                        isi += `
                        <tr>
                            <td>`+val.date+`</td>
                            <td>
                                `+type+`
                            </td>
                            <td>`+val.qty+`</td>
                            <td>Rp.`+response.data.product.price*val.qty+`.000</td>
                            <td>`+val.note+`</td>
                        </tr>
                        `;
                        nomer++;
                    });
                }

                $('#data').html(isi);
                
            });
        }

        start();

    </script>
    @endsection
