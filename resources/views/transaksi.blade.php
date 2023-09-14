@extends('template.adminlte.layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <h2 class="main-title my-auto" id="title_product">Transaksi</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    
                    <div class="col">
                            <label for="" class="mt-3">Tanggal</label>
                            <div class="form-group">
                                <input type="date" name="start_date" id="start_date" class="form-control" placeholder="start date" />
                            </div>
                        
                       
                            <div class="form-group">
                                <input type="date" name="end_date" id="end_date" class="form-control" placeholder="end date" />
                            </div>

                            
                        <button type="button" id="date" class="btn btn-primary float-right">
                            Filter
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-stripped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width: 15%">Tanggal</th>
                                        <th>Brand</th>
                                        <th>Produk</th>
                                        <th>Harga Produk</th>
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
        var parmas  = window.location.href.split('-').reverse()[0];
        var url = "{{ url('/api/transaksi') }}";
        var title;
        if (parmas == 'in') {
            title = 'Masuk';
            
        }else{
            title = 'Keluar';
        }
        $('#title_product').html('Transaksi '+title)
        var date ='';
        $('#date').click(function(){
            var $start = $('#start_date').val();

            var $end = $('#end_date').val();
           
            
            if ($start != '' && $end != '') {
                date = '&start_date='+$start+'&end_date='+$end;
            }else{
                date = '';
            }
            start(date);
        });
        
        function start(date) {
            loadingTable('#data');
        
            getData(url+'?type='+parmas+date, token).done(function(response) {
                isi = ``;

                if (response.data.stock.length > 0) {
                    nomer = 1;
                    type = '';
                    sum = 0;
                    sumqty = 0;
                    data='';
                    $.each(response.data.stock, function(i, val) {
                        sum += val.product.price*val.qty;
                        sumqty += val.qty;
                        if(val.type == 'in'){
                            type = `<span class="badge text-bg-success">Masuk</span>`;
                        }else{
                            type = `<span class="badge text-bg-danger">Keluar</span>`;
                        }

                        isi += `
                        <tr>
                            <td>`+val.date+`</td>
                            <td>`+val.product.brand+`</td>
                            <td>`+val.product.product_name+`</td>
                            <td>Rp.`+val.product.price+`.000 / item</td>
                            <td>
                                `+type+`
                            </td>
                            <td>`+val.qty+`</td>
                            <td>Rp.`+val.product.price*val.qty+`.000</td>
                            <td>`+val.note+`</td>
                        </tr>
                        `;
                        nomer++;
                    });
                    
                }
                if (response.data.stock.length > 0) {
                    data = `<tr>
                                        <td><span class="badge text-bg-success">Total Produk `+title+`</span></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><span class="badge text-bg-success">`+sumqty+`</span></td>
                                        <td><span class="badge text-bg-success">Rp.`+sum.toString().split("-")+`.000</span></td>
                                        <td></td>
                                    </tr>`;
                }else{
                    data='';
                }
                $('#data').html(isi+data);
                
            });
        }

        start(date);

    </script>
    @endsection
