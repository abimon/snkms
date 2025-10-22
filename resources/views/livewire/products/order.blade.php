<div>
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">Orders</h1>
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full text-center">
                        <thead class="border-b bg-gray-800">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                    Order ID
                                </th>
                                <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                    User ID
                                </th>
                                <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                    Product
                                </th>
                                <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                    Total Amount
                                </th>
                                <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                    Status
                                </th>
                                <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $order->receipt_no }}</td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ $order->user->name }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ $order->product->name }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    Ksh {{ ($order->quantity)*($order->product->price) }}.00
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ $order->isDelivered ? 'Delivered' : ($order->isPaid? 'Paid' : 'Pending') }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    <flux:button wire:click="processOrder({{ $order->id }})" variant="primary" color="{{ $order->isDelivered ? 'lime' : ($order->isPaid? 'teal' : 'emerald') }}" size="sm">
                                        {{ $order->isDelivered ? 'Paid & Delivered' : ($order->isPaid? 'Confirm Delivery' : 'Prompt Pay') }}
                                    </flux:button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>