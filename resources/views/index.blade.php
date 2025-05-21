<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container">
                        <h2 class="mb-4">Liste des Logs</h2>
                        <form method="GET" action="{{ route('logs.index') }}" class="mb-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="date" name="date" style="color:black;" class="form-control" value="{{ request('date') }}">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary" style="background-color: red; color:white; padding-left:1%; padding-right:1%;">Filtrer</button>
                                </div>
                            </div>
                        </form>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID Log</th>
                                    <th>User ID</th>
                                    <th>Action</th>
                                    <th>Idea ID</th>
                                    <th>Comment ID</th>
                                    <th>IP Address</th>
                                    <th>User Agent</th>
                                    <th>Date Création</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logs as $log)
                                    <tr>
                                        <td>{{ $log->id }}</td>
                                        <td>{{ $log->user_id }}</td>
                                        <td>{{ $log->action }}</td>
                                        <td>{{ $log->idea_id }}</td>
                                        <td>{{ $log->comment_id }}</td>
                                        <td>{{ $log->ip_address }}</td>
                                        <td>{{ $log->user_agent }}</td>
                                        <td>{{ $log->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        {{ $logs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (!Cookie::get('cookies_accepted'))
        <x-cookie-banner />
    @endif
</x-app-layout>
