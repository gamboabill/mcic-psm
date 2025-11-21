<section>

    <a href="{{@route('map.view')}}">
        <button class="px-2 py-2 rounded text-white bg-blue-500 hover:bg-blue-700">View Map</button>
    </a>

    <table>
        <tr>
            <th>name</th>
        </tr>
        @forelse($projects as $project)
        <tr>
            <td>{{$project->name}}</td>
        </tr>
        @empty

        @endforelse
    </table>

</section>