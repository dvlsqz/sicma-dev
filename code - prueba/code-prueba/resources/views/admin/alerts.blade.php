<!-- Alertas de confirmación -->
<script>
    $('.product-edit').submit(function(e){
        e.preventDefault();
        Swal.fire({
        title: 'Está seguro de editar el producto?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Si, Editar`,
        confirmButtonColor: '#36B420',
        denyButtonText: `Cancelar`,
        }).then((result) => {

            if (result.isConfirmed) {
                this.submit();
            }
            /* BASE PARA GENERAL LAS OTRAS ALERTAS SE SUCCES E INFO
            if (result.isConfirmed) {
            Swal.fire('Saved!', '', 'success')
            } else if (result.isDenied) {
            Swal.fire('Changes are not saved', '', 'info')
            }*/
        });
    });

    $('.product-add').submit(function(e){
        e.preventDefault();
        Swal.fire({
        title: 'Está seguro de agregar el producto?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Si, Agregar`,
        confirmButtonColor: '#36B420',
        denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });

    $('.income-product-add').submit(function(e){
        e.preventDefault();
        Swal.fire({
        title: 'Está seguro de registrar el ingreso?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Si, Registrar`,
        confirmButtonColor: '#36B420',
        denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });

    $('.egress-product-add').submit(function(e){
        e.preventDefault();
        Swal.fire({
        title: 'Está seguro de registrar el egreso?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Si, Registrar`,
        confirmButtonColor: '#36B420',
        denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });

    $('.kardex-add').submit(function(e){
        e.preventDefault();
        Swal.fire({
        title: 'Está seguro de agregar el producto?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Si, Agregar`,
        confirmButtonColor: '#36B420',
        denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });

    $('.income-kardex-add').submit(function(e){
        e.preventDefault();
        Swal.fire({
        title: 'Está seguro de registrar el ingreso?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Si, Registrar`,
        confirmButtonColor: '#36B420',
        denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });

    $('.egress-kardex-add').submit(function(e){
        e.preventDefault();
        Swal.fire({
        title: 'Está seguro de registrar el egreso?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Si, Registrar`,
        confirmButtonColor: '#36B420',
        denyButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });

</script>
