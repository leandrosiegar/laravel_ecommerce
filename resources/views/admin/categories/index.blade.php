<x-admin-layout>
    <div class="containerLSG py-12">
        @livewire('admin.create-category')

    </div>

    @push("scripts")
    <script>
        Livewire.on('deleteCategory', category_slug => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('admin.create-category', 'borrarCategoria', category_slug)
                    Swal.fire(
                        'Deleted!',
                        'Categoría borrada',
                        'success'
                    )
                }
                })
        });
    </script>
    @endpush
</x-admin-layout>
