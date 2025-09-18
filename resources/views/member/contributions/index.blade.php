@extends('member.layouts.app')

@section('title', 'My Contributions')
@section('page-title', 'My Contributions')
@section('page-description', 'View your contribution history and payment records')

@section('content')
    <!-- Header Actions -->
    <div class="mb-6 flex justify-end space-x-4">
        <button onclick="printContributions()" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition-all duration-300">
            Print Report
        </button>
        <button onclick="exportContributions()" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg transition-all duration-300">
            Export CSV
        </button>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-100 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Contributions</p>
                    <p class="text-2xl font-bold text-gray-900">₱{{ number_format($totalContributions, 2) }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Validated Amount</p>
                    <p class="text-2xl font-bold text-gray-900">₱{{ number_format($validatedContributions, 2) }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Payments</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalCount }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 bg-purple-100 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Pending Validation</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $pendingCount }}</p>
                </div>
            </div>
        </div>
    </div>

        <!-- Filters -->
        <div class="glass-effect rounded-xl p-6 mb-6">
            <h2 class="text-xl font-bold text-white mb-4">Filter Contributions</h2>
            <form method="GET" action="{{ route('member.contributions.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-purple-200 text-sm font-medium mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-2 rounded-lg bg-white border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="validated" {{ request('status') == 'validated' ? 'selected' : '' }}>Validated</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                <div>
                    <label class="block text-purple-200 text-sm font-medium mb-2">From Date</label>
                    <input type="date" name="from_date" value="{{ request('from_date') }}" class="w-full px-4 py-2 rounded-lg bg-white border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>
                <div>
                    <label class="block text-purple-200 text-sm font-medium mb-2">To Date</label>
                    <input type="date" name="to_date" value="{{ request('to_date') }}" class="w-full px-4 py-2 rounded-lg bg-white border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-500 text-purple-900 font-semibold py-2 px-4 rounded-lg transition-all duration-300">
                        Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Contributions Table -->
        <div class="glass-effect rounded-xl p-6">
            <h2 class="text-xl font-bold text-white mb-4">Contribution History</h2>
            
            @if($contributions->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-white">
                        <thead>
                            <tr class="border-b border-white/20">
                                <th class="text-left py-3 px-4 font-semibold">Date</th>
                                <th class="text-left py-3 px-4 font-semibold">Amount</th>
                                <th class="text-left py-3 px-4 font-semibold">Payment Method</th>
                                <th class="text-left py-3 px-4 font-semibold">Reference</th>
                                <th class="text-left py-3 px-4 font-semibold">Status</th>
                                <th class="text-left py-3 px-4 font-semibold">Recorded By</th>
                                <th class="text-left py-3 px-4 font-semibold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contributions as $contribution)
                                <tr class="border-b border-white/10 hover:bg-white/5">
                                    <td class="py-3 px-4">{{ $contribution->contribution_date->format('M d, Y') }}</td>
                                    <td class="py-3 px-4 font-semibold">₱{{ number_format($contribution->amount, 2) }}</td>
                                    <td class="py-3 px-4">{{ ucfirst($contribution->payment_method) }}</td>
                                    <td class="py-3 px-4">{{ $contribution->reference_number ?? 'N/A' }}</td>
                                    <td class="py-3 px-4">
                                        <span class="px-2 py-1 rounded-full text-xs font-medium
                                            @if($contribution->status === 'validated') bg-green-500/20 text-green-300
                                            @elseif($contribution->status === 'pending') bg-yellow-500/20 text-yellow-300
                                            @elseif($contribution->status === 'rejected') bg-red-500/20 text-red-300
                                            @else bg-gray-500/20 text-gray-300 @endif">
                                            {{ ucfirst($contribution->status) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4">{{ $contribution->recordedBy->name ?? 'System' }}</td>
                                    <td class="py-3 px-4">
                                        <button onclick="viewContribution({{ $contribution->id }})" class="text-blue-400 hover:text-blue-300 transition-colors">
                                            View Details
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($contributions->hasPages())
                    <div class="mt-6">
                        {{ $contributions->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-12">
                    <div class="text-6xl mb-4">💰</div>
                    <div class="text-white text-xl mb-2">No contributions found</div>
                    <div class="text-purple-200">Your contribution history will appear here once you make payments</div>
                </div>
            @endif
        </div>

        <!-- Contribution Timeline -->
        @if($contributions->count() > 0)
            <div class="glass-effect rounded-xl p-6 mt-6">
                <h2 class="text-xl font-bold text-white mb-4">Contribution Timeline</h2>
                <div class="space-y-4">
                    @foreach($contributions->take(10) as $contribution)
                        <div class="flex items-center space-x-4">
                            <div class="w-3 h-3 rounded-full
                                @if($contribution->status === 'validated') bg-green-400
                                @elseif($contribution->status === 'pending') bg-yellow-400
                                @elseif($contribution->status === 'rejected') bg-red-400
                                @else bg-gray-400 @endif">
                            </div>
                            <div class="flex-1">
                                <div class="text-white font-medium">₱{{ number_format($contribution->amount, 2) }} - {{ $contribution->contribution_date->format('M d, Y') }}</div>
                                <div class="text-purple-200 text-sm">{{ ucfirst($contribution->status) }} • {{ $contribution->payment_method }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <script>
        function viewContribution(id) {
            // Implement modal or redirect to detailed view
            alert('View contribution details for ID: ' + id);
        }

        function printContributions() {
            window.print();
        }

        function exportContributions() {
            // Implement CSV export functionality
            alert('Export functionality will be implemented');
        }
    </script>
</body>
</html>
