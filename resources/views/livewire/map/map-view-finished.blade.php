@section('title', config('app.name').' |'.' '.$title)

<div>

    <livewire:map.map-links />

    <button
        class="absolute z-50 top-4 right-4 px-3 py-1 text-white rounded bg-black opacity-30 hover:bg-black hover:opacity-100 transition duration-200"
        id="toggleLabels">
        Show All Projects
    </button>


    <div class="absolute inset-0 z-0" id="map" style="width: 100%; height: 1000px;">
    </div>

    <link href="https://unpkg.com/maplibre-gl@2.4.0/dist/maplibre-gl.css" rel="stylesheet" />
    <script src="https://unpkg.com/maplibre-gl@2.4.0/dist/maplibre-gl.js"></script>

    <script>
        const projects = @json($projects);

let labelsVisible = false;
const labelElements = []; // store labels for toggling

const map = new maplibregl.Map({
    container: 'map',
    style: 'https://basemaps.cartocdn.com/gl/dark-matter-gl-style/style.json',
    center: [121.7740, 12.8797],
    zoom: 6
});

projects.forEach(project => {
    // Container (hitbox + pin + label)
    const container = document.createElement('div');
    container.style.position = 'relative'; // for absolute positioning of children
    container.style.width = '0px';
    container.style.height = '0px';
    container.style.cursor = 'pointer';

    // LABEL (start hidden)
    const label = document.createElement('div');
    label.textContent = project.name;
    label.style.fontSize = '12px';
    label.style.color = 'black';
    label.style.background = 'white';
    label.style.padding = '1px 4px';
    label.style.borderRadius = '3px';
    label.style.position = 'absolute';
    label.style.bottom = '10px'; // above the dot
    label.style.left = '50%';
    label.style.transform = 'translateX(-50%)';
    label.style.whiteSpace = 'nowrap';
    label.style.display = 'none'; // hidden by default
    container.appendChild(label);
    labelElements.push(label);

    // PIN (small visual dot)
    const pin = document.createElement('div');
    pin.style.width = '5px';
    pin.style.height = '5px';
    pin.style.backgroundColor = 'green';
    pin.style.borderRadius = '50%';
    pin.style.border = '1px solid white';
    pin.style.boxShadow = '0 0 4px #000';
    pin.style.position = 'absolute';
    pin.style.bottom = '0';
    pin.style.left = '50%';
    pin.style.transform = 'translateX(-50%)';
    container.appendChild(pin);

    // HITBOX (larger clickable area)
    const hitbox = document.createElement('div');
    hitbox.style.position = 'absolute';
    hitbox.style.bottom = '0';
    hitbox.style.left = '-10px'; // extend left
    hitbox.style.width = '30px';  // 30px wide hitbox
    hitbox.style.height = '30px'; // 30px tall hitbox
    hitbox.style.background = 'transparent';
    container.appendChild(hitbox);

    // ADD MARKER
    const marker = new maplibregl.Marker({
        element: container,
        anchor: 'bottom'
    })
    .setLngLat([project.longitude, project.latitude])
    .addTo(map);

    // POPUP
    const popup = new maplibregl.Popup({
        offset: 10,
        closeButton: true,
        closeOnMove: false
    }).setHTML(`
     <strong>${project.name ?? ''}</strong><br>
        <p>${project.description}</p>
       
    `);

    // Click listener on hitbox
    hitbox.addEventListener('click', (e) => {
        e.stopPropagation();
        popup.setLngLat([project.longitude, project.latitude]).addTo(map);
    });
});

// BUTTON TO TOGGLE LABELS
document.getElementById('toggleLabels').addEventListener('click', () => {
    labelsVisible = !labelsVisible;

    labelElements.forEach(label => {
        label.style.display = labelsVisible ? 'block' : 'none';
    });

    document.getElementById('toggleLabels').innerText =
        labelsVisible ? 'Hide All Projects' : 'Show All Projects';
});
    </script>
</div>