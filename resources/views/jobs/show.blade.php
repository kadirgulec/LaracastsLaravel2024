<x-layout>
    <x-slot:heading>
        Job Listing
    </x-slot:heading>

    <h2 class="font-bold text-lg">{{ $job->title }}</h2>
    <p>
        This job pays {{$job->salary }} per Year
    </p>

    @can('edit',$job)
        <p>
            <x-button href="/jobs/{{$job->id}}/edit">Edit Job</x-button>
        </p>
    @endcan
</x-layout>
