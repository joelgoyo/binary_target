@push('vendor_css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
<style>
    
    .swal2-icon.swal2-success .swal2-success-ring{
        border: .25em solid #00BE54 !important;
    }
    
    .swal2-icon.swal2-success [class^=swal2-success-line]{
        background: #00BE54 !important;
    }

    #swal2-title, #swal2-content{
        color: white;
    }
</style>
@endpush

@push('page_vendor_js')
<script src="{{asset('assets/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
@endpush

@push('custom_js')
<script>
    function getlink(side) {
        var aux = document.createElement("input");
        aux.setAttribute("value", "{{route('register')}}?referred_id={{Auth::id()}}");
        document.body.appendChild(aux);
        aux.select();
        document.execCommand("copy");
        document.body.removeChild(aux);

        let lado = (side == 'I') ? 'Izquierdo' : 'Derecho'

        Swal.fire({
            title: "Link Copiado",
            text: "Ya puedes pegarlo en su navegador, Activo el Lado: "+lado,
            type: "success",
            confirmButtonClass: 'btn btn-outline-primary',
            background: '#002614',
            buttonsStyling: false,
        }).then(function(result){
                if (result.value) {
                    window.location.reload();
                }
            });
    }
</script>
@endpush
