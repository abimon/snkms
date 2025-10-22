<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 ">
                <div class="flex justify-center items-center h-full">
                    <div class="text-center">
                        <flux:separator text="Orders" />
                        <div class="grid grid-flow-col grid-rows-3 gap-4">
                            <div class="row-span-3 flex justify-center items-center">
                                <div class="text-8xl"><i class="fa fa-chart-bar"></i></div>
                            </div>
                            <div class="col-span-2 text-left">
                                <div class="">
                                    <span class="text-2xl font-bold m-2">{{App\Models\Order::all()->count()}}</span>
                                    <span class="text-sm font-medium">Total Orders</span>
                                </div>
                            </div>
                            <div class="col-span-2 text-left">
                                <div class="">
                                    <span class="text-2xl font-bold m-2">{{App\Models\Order::where('isPaid', true)->count()}}</span>
                                    <span class="text-sm font-medium">Paid Orders</span>
                                </div>
                            </div>
                            <div class="col-span-2 text-left">
                                <div class="">
                                    <span class="text-2xl font-bold m-2">{{App\Models\Order::where('isDelivered', true)->count()}}</span>
                                    <span class="text-sm font-medium">Delivered</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="flex justify-center items-center h-full">
                    <div class="text-center">
                        <flux:separator text="Cooking Classes" />
                        <div class="grid grid-flow-col grid-rows-3 gap-4">
                            <div class="row-span-3 flex justify-center items-center">
                                <div class="text-8xl"><i class="fa fa-chalkboard"></i></div>
                            </div>
                            <div class="col-span-2 text-left">
                                <div class="">
                                    <span class="text-2xl font-bold m-2">0</span>
                                    <span class="text-sm font-medium">Total Enrollments</span>
                                </div>
                            </div>
                            <div class="col-span-2 text-left">
                                <div class="">
                                    <span class="text-2xl font-bold m-2">0</span>
                                    <span class="text-sm font-medium">Lessons</span>
                                </div>
                            </div>
                            <div class="col-span-2 text-left">
                                <div class="">
                                    <span class="text-2xl font-bold m-2">0</span>
                                    <span class="text-sm font-medium">Completed</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="flex justify-center items-center h-full">
                    <div class="text-dark text-center">
                        <div class="text-5xl"><i class="fa fa-chart-line"></i></div>
                        <div class="text-2xl font-bold">{{App\Models\Order::where('isDelivered', true)->get()->sum(fn($item) => $item->quantity * $item->product->price)}}</div>
                        <div class="text-sm font-medium">Total Delivered</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative h-full flex-1">
            <div class="grid grid-flow-col grid-rows-3 gap-4">
                <div class="row-span-3 rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-2">
                    <div class="w-full h-full">
                        <div class="">
                            <flux:navlist variant="outline">
                                <flux:separator text="Notifications" />
                                <flux:navlist.group class="grid">
                                    @foreach (App\Models\Notification::orderBy('updated_at', 'desc')->take(10)->get() as $notification)
                                    <flux:navlist.item class="mb-2" icon="{{$notification->type=='Order'?'shopping-cart':''}}" :href="route('dashboard')">{{$notification->message}}</flux:navlist.item>
                                    @endforeach
                                </flux:navlist.group>
                            </flux:navlist>
                        </div>
                    </div>
                </div>
                <div class="row-span-3 rounded-xl border border-neutral-200 dark:border-neutral-700  dark:bg-neutral-800 p-2">
                    <div class="w-full h-full">
                        @include('calender')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>