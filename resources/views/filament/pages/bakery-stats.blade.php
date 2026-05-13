<x-filament-panels::page>
    <div class="grid grid-cols-1 gap-4">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <h2 class="text-lg font-bold mb-4">Top 5 Best Selling Items </h2>

            <table class="w-full text-left">
                <thead>
                    <tr class="border-b text-gray-500">
                        <th class="pb-2">Product Name</th>
                        <th class="pb-2">Total Sold</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($this->getStats()['top_products'] as $item)
                    <tr class="border-b last:border-0">
                        <td class="py-3 font-medium">{{ $item->product->name }}</td>
                        <td class="py-3">{{ $item->total_sold }} units</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-sm border mt-6">
    <h2 class="text-lg font-bold mb-4">System Activity Log</h2>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead>
                <tr class="border-b bg-gray-50">
                    <th class="p-3">User</th>
                    <th class="p-3">Action</th>
                    <th class="p-3">Description</th>
                    <th class="p-3">Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($this->getActivities() as $activity)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-3 font-medium">{{ $activity->user->name }}</td>
                    <td class="p-3">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">
                            {{ $activity->action }}
                        </span>
                    </td>
                    <td class="p-3 text-gray-600">{{ $activity->description }}</td>
                    <td class="p-3 text-gray-400">{{ $activity->created_at->diffForHumans() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</x-filament-panels::page>
