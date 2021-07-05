<div>
    <header class="bg-white shadow">
        <div class="w-max-7xl py-6 mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center ">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">Productos</h1>

                <x-jet-danger-button wire:click="$emit('deleteProduct')">Eliminar</x-jet-danger-button>
            </div>
        </div>
    </header>

    <div class="w-max-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
        <h1 class="text-3xl text-center font-semibold mb-8">Modificar producto</h1>
        <!-- wire:ignore para q cada vez q se renderice la pag por cualquier cambio este div no se toque -->
        <div class="mb-4" wire:ignore>
            <form action="{{ route('admin.product.files', $product) }}"
            method="POST"

            class="dropzone"
            id="my-awesome-dropzone">
            </form>
        </div>

        @if ($product->images->count())
            <section class="bg-white shadow-xl rounded-lg p-6 mb-4">
                <h1 class="text-2xl text-center font-semibold mb-2">Imágenes del producto</h1>
                <ul class="flex flex-wrap">
                    @foreach ($product->images as $image)
                        <li class="relative" wire:key="imagen-{{ $image->id }}">
                            <img class="w-32 h-20 object-cover" src="{{ Storage::url($image->url) }}">
                            <x-jet-danger-button
                                class="absolute right-2 top-2"
                                wire:click="deleteImagen({{ $image->id }})"
                                wire:loading.attr="disabled"
                                wire:target="deleteImagen({{ $image->id }})"
                                >
                                X
                            </x-jet-danger-button>
                        </li>
                    @endforeach

                </ul>
            </section>
        @endif

        @livewire('admin.status-product', ['product' => $product], key("status-product-".$product->id))



        <div class="bg-white shadow-xl rounded-lg p-6">
            <div class="grid grid-cols-2 gap-6">
                <!-- CATEGORIAS -->
                <div>
                    <x-jet-label value="Categorías"></x-jet-label>
                    <select class="w-full form-control" wire:model="category_id">
                        <option value="" disabled selected>Seleccione una categoría</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"> {{ $category->name }}</option>

                        @endforeach
                    </select>

                    <x-jet-input-error for="category_id"></x-jet-input-error>
                </div>

                <!-- SUBCATEGORIAS -->
                <div>
                    <x-jet-label value="Subcategorías"></x-jet-label>
                    <select class="w-full form-control" wire:model="product.subcategory_id">
                        <option value="" disabled selected>Seleccione una subcategoría</option>
                        @foreach ($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}"> {{ $subcategory->name }}</option>

                        @endforeach
                    </select>
                    <x-jet-input-error for="product.subcategory_id"></x-jet-input-error>
                </div>
            </div>

            <!-- NOMBRE -->
            <div class="mb-4 mt-2">
                <x-jet-label value="Nombre"></x-jet-label>
                <x-jet-input type="text"
                    class="w-full"
                    wire:model="product.name"
                    placeholder="Ingrese nombre del producto">
                </x-jet-input>
                <x-jet-input-error for="product.name"></x-jet-input-error>
            </div>

            <!-- SLUG -->
            <div class="mb-4">
                <x-jet-label value="Slug"></x-jet-label>
                <x-jet-input type="text"
                    class="w-full bg-gray-200"
                    disabled
                    wire:model="product.slug"
                    placeholder="Ingrese slug del producto">
                </x-jet-input>
                <x-jet-input-error for="product.slug"></x-jet-input-error>
            </div>

            <!--- DESCRIPTION -->
            <div class="mb-4" >
                <!-- wire:ignore hace q cuando se renderice la página este apartado no se renderice, así no se pierde el ckeditor -->
                <div wire:ignore>
                    <x-jet-label value="Descripción"></x-jet-label>
                    <textarea
                        class="w-full form-control"
                        wire:model="product.description"
                        x-data="" x-init="ClassicEditor.create($refs.editorLSG)
                        .then(function(editor) {
                                editor.model.document.on('change:data', () => {
                                    @this.set('product.description', editor.getData())
                                })
                        })
                        .catch( error => {
                            console.error( error );
                        });"
                        x-ref="editorLSG"
                        rows=4>
                    </textarea>
                </div>
                <x-jet-input-error for="product.description"></x-jet-input-error>
            </div>

            <div class="mb-4 grid grid-cols-2 gap-6">
                <!-- MARCA -->
                <div >
                    <x-jet-label value="Marca"></x-jet-label>
                    <select class="form-control w-full" wire:model="product.brand_id">
                        <option value="" selected disabled>Seleccione una marca</option>
                        @foreach ($brands as $brand)
                            <option value="{{$brand->id}}"> {{$brand->name}}</option>

                        @endforeach
                    </select>
                    <x-jet-input-error for="product.brand_id"></x-jet-input-error>
                </div>
                <!-- PRECIO -->
                <div>
                    <x-jet-label>Precio</x-jet-label>
                    <x-jet-input type="number" wire:model="product.price" step=".01" class="w-full"></x-jet-input>
                    <x-jet-input-error for="product.price"></x-jet-input-error>
                </div>

                @if ($this->subcategory)
                    <!-- $this->subcategory llama al método getXXXProperty, a mí esta forma no me gusta se puede liar con otras propiedades -->
                    @if (!$this->subcategory->color && !$this->subcategory->size) <!-- ambos están a cero -->
                        <div>
                            <x-jet-label>Cantidad</x-jet-label>
                            <x-jet-input type="number" wire:model="product.quantity" class="w-full"></x-jet-input>
                            <x-jet-input-error for="product.quantity"></x-jet-input-error>
                        </div>
                    @endif
                @endif


            </div>

            <div class="flex justify-end items-center mt-4">
                <x-jet-action-message class="mr-3" on="guardado">
                    Actualizado
                </x-jet-action-message>

                <x-jet-button
                    wire:loading.attr="disabled"
                    wire:target="guardar"
                    wire:click="guardar"
                >
                       Actualizar producto
                </x-jet-button>
            </div>
        </div>

        @if ($this->subcategory)

            @if ($this->subcategory->size)
                @livewire("admin.size-product", ['product' => $product], key("size-produc-".$product->id))
            @elseif ($this->subcategory->color)
                @livewire("admin.color-product", ['product' => $product], key("color-product-".$product->id))
            @endif
        @endif


    </div>

    @push("scripts")
            <script>
                Dropzone.options.myAwesomeDropzone = {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    paramName: "fichero",
                    dictDefaultMessage: "Arrastra aquí las imágenes que quieras subir",
                    acceptedFiles: "image/*",
                    maxFilesize: 2, // MB
                    maxFiles: 4,
                    complete: function(fichero) {
                        this.removeFile(fichero);
                    },
                    queuecomplete: function() {
                        Livewire.emit('refreshProduct');
                    },
                    accept: function(file, done) {
                        if (file.name == "justinbieber.jpg") {
                        done("Naha, you don't.");
                        }
                        else { done(); }
                    }
                };

                Livewire.on("deleteSize", sizeId => {
                    Swal.fire({
                        title: 'Seguro de borrar esta talla?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            // emitTo en vez de emit para q SOLO lo escuche admin.size-product y no todos los demás
                            Livewire.emitTo('admin.size-product','borrarTalla', sizeId);
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        }
                    })
                });

                Livewire.on("deleteProduct", () => {
                    Swal.fire({
                        title: 'Seguro de borrar este Producto?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            // emitTo en vez de emit para q SOLO lo escuche admin.size-product y no todos los demás
                            Livewire.emitTo('admin.edit-product','borrarProducto');
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        }
                    })
                });

                Livewire.on('deletePivot', pivotId => {
                    Swal.fire({
                    title: 'seguro de borrar el Pivot?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // emitTo en vez de emit para q SOLO lo escuche admin.color-product y no todos los demás
                            Livewire.emitTo('admin.color-product','borrar', pivotId)
                            Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                            )
                        }
                    })
                });

                Livewire.on('deleteColorSize', pivotId => {
                    Swal.fire({
                    title: 'seguro de borrar el Pivot?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // emitTo en vez de emit para q SOLO lo escuche admin.color-product y no todos los demás
                            Livewire.emitTo('admin.color-size','borrar', pivotId)
                            Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                            )
                        }
                    })
                });
            </script>
        @endpush
</div>

