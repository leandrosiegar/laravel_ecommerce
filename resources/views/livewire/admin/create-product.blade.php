<div class="w-max-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
    <h1 class="text-3xl text-center font-semibold mb-8">Complete este formulario para crear un producto</h1>

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
            <select class="w-full form-control" wire:model="subcategory_id">
                <option value="" disabled selected>Seleccione una subcategoría</option>
                @foreach ($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}"> {{ $subcategory->name }}</option>

                @endforeach
            </select>
            <x-jet-input-error for="subcategory_id"></x-jet-input-error>
        </div>
    </div>

    <!-- NOMBRE -->
    <div class="mb-4 mt-2">
        <x-jet-label value="Nombre"></x-jet-label>
        <x-jet-input type="text"
            class="w-full"
            wire:model="name"
            placeholder="Ingrese nombre del producto">
        </x-jet-input>
        <x-jet-input-error for="name"></x-jet-input-error>
    </div>

    <!-- SLUG -->
    <div class="mb-4">
        <x-jet-label value="Slug"></x-jet-label>
        <x-jet-input type="text"
            class="w-full bg-gray-200"
            disabled
            wire:model="slug"
            placeholder="Ingrese slug del producto">
        </x-jet-input>
        <x-jet-input-error for="slug"></x-jet-input-error>
    </div>

    <!--- DESCRIPTION -->

    <div class="mb-4" >
        <!-- wire:ignore hace q cuando se renderice la página este apartado no se renderice, así no se pierde el ckeditor -->
        <div wire:ignore>
            <x-jet-label value="Descripción"></x-jet-label>
            <textarea
                class="w-full form-control"
                wire:model="description"
                x-data="" x-init="ClassicEditor.create($refs.editorLSG)
                .then(function(editor) {
                        editor.model.document.on('change:data', () => {
                            @this.set('description', editor.getData())
                        })
                })
                .catch( error => {
                    console.error( error );
                });"
                x-ref="editorLSG"
                rows=4>
            </textarea>
        </div>
        <x-jet-input-error for="description"></x-jet-input-error>
    </div>

    <div class="mb-4 grid grid-cols-2 gap-6">
        <!-- MARCA -->
        <div >
            <x-jet-label value="Marca"></x-jet-label>
            <select class="form-control w-full" wire:model="brand_id">
                <option value="" selected disabled>Seleccione una marca</option>
                @foreach ($brands as $brand)
                    <option value="{{$brand->id}}"> {{$brand->name}}</option>

                @endforeach
            </select>
            <x-jet-input-error for="brand_id"></x-jet-input-error>
        </div>
        <!-- PRECIO -->
        <div>
            <x-jet-label>Precio</x-jet-label>
            <x-jet-input type="number" wire:model="price" step=".01" class="w-full"></x-jet-input>
            <x-jet-input-error for="price"></x-jet-input-error>
        </div>

        @if ($subcategory_id)
            <!-- $this->subcategory llama al método getXXXProperty, a mí esta forma no me gusta se puede liar con otras propiedades -->
            @if (!$this->subcategory->color && !$this->subcategory->size) <!-- ambos están a cero -->
                <div>
                    <x-jet-label>Cantidad</x-jet-label>
                    <x-jet-input type="number" wire:model="quantity" class="w-full"></x-jet-input>
                    <x-jet-input-error for="quantity"></x-jet-input-error>
                </div>
           @endif
        @endif
    </div>

    <div class="flex mt-4">
        <x-jet-button class="ml-auto"
            wire:loading.attr="disabled"
            wire:target="guardar"
            wire:click="guardar"
        >
                Crear producto
        </x-jet-button>
    </div>






</div>
