const map = L.map('map').setView([51.505, -0.09], 13);
const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

/**
 * Akses endpoint untuk menampilkan semua data spot pada map
 */
axios.get('/api/v1/spot').then(function (response) {
    console.log("result fetch data spot", response.data.data);

    const dataSpot = response.data.data

    dataSpot.map(item => {

        console.log("marker icon", item.category.icon);

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

        const marker = L.marker([item.lat, item.lng], markerIcon).bindPopup(item.name).addTo(map)
    })
})
