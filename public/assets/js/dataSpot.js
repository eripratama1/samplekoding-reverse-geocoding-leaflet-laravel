function fetchSpots() {
    const map = L.map('map').setView([51.505, -0.09], 13);
    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var markersLayer = new L.LayerGroup();
    map.addLayer(markersLayer)

    var controlSearch = new L.Control.Search({
		position:'topleft',
		layer: markersLayer,
		initial: false,
		zoom: 18,

	});

    map.addControl( controlSearch );

    /**
     * Akses endpoint untuk menampilkan semua data spot pada map
     */
    axios.get('/api/v1/spot')
        .then(function (response) {
            // console.log("result fetch data spot", response.data.data);

            const dataSpot = response.data.data

            dataSpot.map(item => {

                //console.log("marker icon", item.category.icon);

                /**
                 * Membuat custom icon marker berdasarkan kategori spot
                 */
                const markerIcon = {
                    title: item.name,
                    icon: L.icon(item.category.icon ? {
                        iconUrl: item.category.icon,
                        iconSize: [42, 42],
                        iconAnchor: [16, 32],
                        popupAnchor: [0, -32]
                    } : {
                        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
                        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                        iconSize: [25, 41],
                        iconAnchor: [12, 41],
                        popupAnchor: [1, -34],
                        shadowSize: [41, 41]
                    })
                }

                const marker = L.marker([item.lat, item.lng], markerIcon)
                    /** Menambahkan beberapa atribut data pada button show detail
                     * yang mana akan kita gunakan datanya saat modal dimuat */
                    .bindPopup(`<div>
                    <p>${item.description}</p>
                        <a class="btn btn-outline-primary btn-sm"
                         data-bs-toggle="modal"
                         data-bs-target="#exampleModal"
                         data-name="${item.name}"
                         data-slug="${item.slug}"
                         data-lat="${item.lat}"
                         data-lng="${item.lng}"
                         data-icon="${item.category.icon}"
                         data-category="${item.category.name}"
                         data-description="${item.description}"
                         data-id="${item.id}"
                            >
                            Show Detail
                        </a>
                </div>`)
                    .addTo(map)
                markersLayer.addLayer(marker);
            })
        })
        .catch(function (error) {
            console.error("Error fetch data", error);
        })

    let modalMap;

    document.addEventListener('click', function (e) {
        if (e.target.matches('[data-bs-toggle="modal"]')) {

            /**
             * Mendapatkan nilai atribut data dari button show detail
             * saat modal dimuat
             */
            const lat = e.target.getAttribute('data-lat');
            const lng = e.target.getAttribute('data-lng');
            const description = e.target.getAttribute('data-description');
            const name = e.target.getAttribute('data-name');
            const category = e.target.getAttribute('data-category');
            const icon = e.target.getAttribute('data-icon');

            // console.log("attribute lat", lat);

            if (!modalMap) {
                modalMap = L.map('modal-map').setView([lat, lng], 16);
                const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(modalMap);
            } else {
                modalMap.setView([lat, lng], 16);
            }

            const markerIconModal = {
                icon: L.icon(icon ? {
                    iconUrl: icon,
                    iconSize: [42, 42],
                    iconAnchor: [16, 32],
                    popupAnchor: [0, -32]
                } : {
                    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    shadowSize: [41, 41]
                })
            }

            L.marker([lat, lng], markerIconModal).addTo(modalMap);

            /** Menampilkan informasi data spot ke dalam modal */
            document.getElementById('modal-description').innerHTML = `<p>${description}</p>`
            document.getElementById('exampleModalLabel').innerHTML = `${name}`
            document.getElementById('modal-category').innerHTML = `${category}`

            /** Menambahkan kode invalidateSize()
             * untuk memastikan peta ditampilkan dengan ukuran yang benar setelah modal dibuka. */
            setTimeout(() => {
                modalMap.invalidateSize();
            }, 200);
        }

    })
}

function detailSpot() {
    const map = L.map('map').setView([51.505, -0.09], 13);
    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    /**
     * Ambil nilai attribute lalau gunakan
     * saat mengkases endpoint untuk detail spot
     */
    const slug = document.getElementById("imgspot")
    const getSlug = slug.getAttribute('data-slug');

    // console.log(getSlug);

    /**
     * Akses endpoint api untuk menampilkan data detail spot
     */
    axios.get('/api/v1/spot/' + getSlug).then(function (response) {
        console.log(response.data.data);

        const dataSpot = response.data.data
        dataSpot.map(item => {

            const markerIcon = {
                title: item.name,
                icon: L.icon(item.category.icon ? {
                    iconUrl: item.category.icon,
                    iconSize: [42, 42],
                    iconAnchor: [16, 32],
                    popupAnchor: [0, -32]
                } : {
                    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    shadowSize: [41, 41]
                })
            }

            const marker = L.marker([item.lat, item.lng], markerIcon).addTo(map);
            map.setView([item.lat, item.lng], 16);
        })
    }).catch(function (error) {
        console.error("Error fetch data", error);
    })
}
