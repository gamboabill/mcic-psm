<div>

    <a href="{{@route('map.index')}}">
        <button
            class="absolute z-50 top-4 left-59 px-3 py-1  text-white rounded bg-black opacity-50 hover:bg-white hover:text-black hover:opacity-90 transition duration-200  ">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </button>
    </a>


    <a href="{{@route('map.view')}}">
        <button
            class="absolute z-50 top-4 left-4 px-3 py-1 rounded {{ request()->routeIs('map.view') ? 'bg-white text-black opacity-70' : 'bg-black opacity-50 text-white hover:bg-white hover:text-black hover:opacity-90' }}  transition duration-200">
            <i class="fas fa-spinner fa-spin text-blue-500"></i> Active
        </button>
    </a>


    <a href="{{@route('map.complete')}}">
        <button
            class="absolute z-50 top-4 left-27 px-3 py-1 rounded {{ request()->routeIs('map.complete') ? 'bg-white text-black opacity-70' : 'bg-black opacity-50 text-white hover:bg-white hover:text-black hover:opacity-90' }}  transition duration-200">
            <i class="fas fa-check-circle text-green-500"></i> Completed
        </button>
    </a>
</div>