<div>
    <table class="table w-full table-responsive">
        <thead style="text-align: left;">
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <flux:dropdown>
                        <flux:button icon:trailing="chevron-down">Options</flux:button>

                        <flux:menu>
                            <flux:menu.separator />
                            <flux:menu.submenu heading="Change Role To">
                                <flux:menu.radio.group wire:model="role">
                                    @foreach ($this->roles as $rol)
                                    <flux:menu.radio wire:click='onChangeRole({{ $user->id }})'>{{$rol}}</flux:menu.radio>
                                    @endforeach
                                </flux:menu.radio.group>
                            </flux:menu.submenu>

                            <flux:menu.submenu heading="View">
                                <flux:menu.checkbox>Profile</flux:menu.checkbox>
                                <flux:menu.checkbox>Orders</flux:menu.checkbox>
                                <flux:menu.checkbox>classes</flux:menu.checkbox>
                            </flux:menu.submenu>

                            <flux:menu.separator />

                            <flux:menu.item variant="danger" icon="trash">Delete</flux:menu.item>
                        </flux:menu>
                    </flux:dropdown>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>