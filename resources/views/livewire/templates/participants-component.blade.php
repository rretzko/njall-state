<div class="text-center pb-4">
    @foreach($event->ensembles AS $ensemble)
        <header style="font-weight: bold;">{{ $ensemble->name }} Participants</header>
        <ul>
            @forelse($ensemble->instrumentations AS $instrumentation)
                <li>{{ $instrumentation->descr }}</li>
            @empty
                <li>No instrumentation found</li>
            @endforelse
        </ul>
    @endforeach
</div>
