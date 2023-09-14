<!-- jQuery -->
<script src="{{ asset('adminlte/js/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
<!-- Sweet alert2. -->
<script src="{{ asset('/js') }}/sweetalert2.js"></script>

<script>
    function getData(url, token) {
        return $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            headers: {
                "Authorization": "Bearer " + token,
            },
            contentType: 'application/json; charset=utf-8',
        });
    }

    function postData(url, token, form) {
        return $.ajax({
            type: 'POST',
            url: url,
            data: form.serialize(),
            headers: {
                "Authorization": "Bearer " + token,
            }
        });
    }

    function postBerkas(url, token, form) {
        return $.ajax({
            type: 'POST',
            url: url,
            cache: false,
            contentType: false,
            processData: false,
            data: form,
            headers: {
                "Authorization": "Bearer " + token,
            }
        });
    }

    function updateData(url, token, form) {
        return $.ajax({
            type: 'PUT',
            url: url,
            data: form.serialize(),
            headers: {
                "Authorization": "Bearer " + token,
            }
        });
    }

    function deleteData(url, token) {
        url = url + "?_token={{ csrf_token() }}";
        return $.ajax({
            url: url,
            type: 'DELETE',
            dataType: 'json',
            headers: {
                "Authorization": "Bearer " + token,
            },
            contentType: 'application/json; charset=utf-8',
        });
    }

    function errorAlert(message) {
        Swal.fire({
            title: 'Error !',
            text: message,
            icon: 'error',
            confirmButtonText: 'Ok'
        })
    }

    function successAlert(message) {
        Swal.fire({
            title: 'Sukses !',
            text: message,
            icon: 'success',
            confirmButtonText: 'Ok'
        })
    }

    function loading(name,boolean,message){
        if (boolean === true) {
            $(name).html(`<span>Loading...</span>`);
        }else{
            $(name).html(`<span>`+message+`</span>`);
        }
    }

    function loadingTable(name){
        
        $(name).html(`<tr>
            <td colspan="8" class="text-center">
                <div class="spinner-border spinner-grow-lg" role="status">
                </div>
                <div>
                    <p class="text-center">Loading...</p>
                </div>
            </td>  
        </tr>`);
    }

    function loadingSelect(name){
        
        $(name).html(`<option value=""> Loading... </option>`);
    }
    
</script>
