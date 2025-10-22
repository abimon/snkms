<div>
    <div class="mb-4 flex justify-end">
        <flux:modal.trigger name="add-product">
            <flux:button>Add Product</flux:button>
        </flux:modal.trigger>

        <flux:modal name="add-product" class="md:w-1000">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Add Product</flux:heading>
                    <flux:text class="mt-2">Add new product to the product catalogue.</flux:text>
                </div>
                <!-- show selected image -->
                <form wire:submit="store" enctype="multipart/form-data">
                    @if($cover)
                    <img src="{{ $cover->temporaryUrl() }}" alt="Selected Image" class="w-50">
                    @endif

                    <flux:input wire:model="cover" wire:loading label="Product Image" type="file" accept="image/*" />

                    <flux:input wire:model="name" label="Product Name" placeholder="E.g Mango" />

                    <flux:select wire:model="category" label="Product Category" placeholder="Choose category...">
                        @foreach ($this->categories as $category)
                        <flux:select.option>{{$category}}</flux:select.option>
                        @endforeach
                    </flux:select>

                    <flux:input wire:model="price" label="Product Price" type="number" placeholder="E.g 1000" />

                    <flux:input wire:model="units" label="Product Quantity" type="number" placeholder="E.g 10" />

                    <flux:textarea wire:model="description" label="Product Description" placeholder="E.g Mango is a tropical fruit" />

                    <div class="flex">
                        <flux:spacer />
                        <flux:button type="submit" variant="primary">Save changes</flux:button>
                    </div>
                </form>
            </div>
        </flux:modal>
    </div>
    <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
        <table class="table w-full">
            <thead style="text-align: left;">
                <th>Product</th>
                <th>Product Category</th>
                <th>Product Price</th>
                <th>Product Quantity</th>
                <th>Product Description</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($this->products as $product)
                <tr>
                    <td>
                        <flux:avatar src="{{ $product->cover }}" alt="Product Image" size="xl" /><br>{{ $product->name }}
                    </td>
                    <td>{{ $product->category }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->units }}</td>
                    <td>{{ $product->description }}</td>
                    <td>
                        <flux:modal.trigger name="delete-{{ $product->id }}">
                            <flux:button variant="danger">Delete</flux:button>
                        </flux:modal.trigger>

                        <flux:modal name="delete-{{ $product->id }}" class="md:w-1000">
                            <div class="space-y-6">
                                <div>
                                    <flux:heading size="lg">Delete Product</flux:heading>
                                    <flux:text class="mt-2" variant="danger">Delete this product ({{ $product->name }})?. <br>Remember this once done can not be undone.</flux:text>
                                </div>
                                <!-- show selected image -->
                                <form wire:submit="delete({{ $product->id }})" enctype="multipart/form-data">
                                    <div class="flex">
                                        <flux:spacer />
                                        <flux:button type="submit" variant="danger" class="ms-5">Delete</flux:button>
                                        <flux:button wire:click="close('delete-{{ $product->id }}')" variant="primary" class="ms-5">Cancel</flux:button>
                                    </div>
                                </form>
                            </div>
                        </flux:modal>
                    </td>
                </tr>
                @endforeach
        </table>
    </div>

</div>